<?php

namespace App\Repositories;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InventoryRepository
{
    protected $inventory;

    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    // public function getInventories()
    // {
    //     return Product::with([
    //             'category',
    //             'brand',
    //             'salesOrderItems',
    //             'purchaseOrderItems',
    //             'inventories.inventoryDetails',
    //             'inventories.location',
    //             'inventories.supplier',
    //         ])    ->whereHas('inventories', function ($query) {
    //         $query->where(function ($subQuery) {
    //             $subQuery->where('quantity', '>', 0)
    //                      ->orWhere('quantity_on_order', '>', 0);
    //         });
    //     });
    // }

    //     public function getInventories()
    // {
    //     return Product::with([
    //         'category',
    //         'brand',
    //         'salesOrderItems',
    //         'purchaseOrderItems',
    //         'inventories' => function ($query) {
    //             $query->whereHas('inventoryDetails', function ($query) {
    //                 $query->where('quantity', '>', 0)
    //                       ->orWhere('quantity_on_order', '>', 0);
    //             });
    //         },
    //         'inventories.inventoryDetails',
    //         'inventories.location',
    //         'inventories.supplier',
    //     ]);
    // }

    public function getInventories()
    {
        $inventories = Inventory::with([
                   'product',
                   'product.category',
                   'product.brand',
                   'location',
                   'supplier',
               ])
               ->where('quantity', '>', 0)
               ->orWhere('quantity_on_order', '>', 0)
               ->get()
               ->groupBy('product_id');

        return $inventories;
    }

    public function entryInventory($data)
    {
        try {
            $productId = $data['product_id'];
            $product = Product::findOrFail($productId);

            $entryCostPrice = isset($data['cost_price']) ? (float) $data['cost_price'] : 0.0;
            $currentCostPrice = $product->cost_price;

            if ($currentCostPrice !== $entryCostPrice) {
                $updatedCostPrice = $this->calculateNewCost($product, $data);
                $product->cost_price = $updatedCostPrice;
            }
          

            $entrySellPrice = isset($data['sell_price']) ? (float) $data['sell_price'] : 0.0;
            $currentUnitPrice = $product->unit_price;

            if ($currentUnitPrice !== $entrySellPrice) {
                $updatedUnitPrice = $this->calculateNewUnitPrice($product, $data);
                $product->unit_price = $updatedUnitPrice;
            }

            // Inicia la transacción
            DB::transaction(function () use ($product, $data) {
                $product->qty = $this->calculateUpdatedQuantity($product, $data);
                $product->save();

                return Inventory::create($data);
            });
          
        return  Inventory::latest()->first();

        } catch (\Exception $e) {
           
throw new \Exception($e->getMessage());

        }
    }

    private function calculateUpdatedQuantity($product, $entryData)
    {
        // Ensure quantity from entry data is a valid integer
        $entryQuantity = isset($entryData['quantity']) ? (int) $entryData['quantity'] : 0;

        return $product->qty + $entryQuantity;
    }

    private function calculateNewUnitPrice($product, $entryData)
    {
        // Calculate initial inventory value
        $initialInventoryValue = $product->qty * $product->unit_price;

        // Ensure quantity and cost price from entry data are valid
        $entryQuantity = isset($entryData['quantity']) ? (int) $entryData['quantity'] : 0;
        $entrySellPrice = isset($entryData['sell_price']) ? (float) $entryData['sell_price'] : 0.0;

        // Avoid division by zero
        if ($entryQuantity > 0 && $entrySellPrice > 0) {
            $newEntryValue = $entryQuantity * $entrySellPrice;
            $totalInventoryValue = $initialInventoryValue + $newEntryValue;

            // Calculate total quantity of inventory
            $totalInventoryQuantity = $this->calculateUpdatedQuantity($product, $entryData);

            // Avoid division by zero
            if ($totalInventoryQuantity > 0) {
                $weightedAverageCost = $totalInventoryValue / $totalInventoryQuantity;

                return round($weightedAverageCost, 2);
            }
        }

        // Return current cost price if no valid new cost can be calculated
        return $product->cost_price;
    }

    private function calculateNewCost($product, $entryData)
    {
        // Calculate initial inventory value
        $initialInventoryValue = $product->qty * $product->cost_price;

        // Ensure quantity and cost price from entry data are valid
        $entryQuantity = isset($entryData['quantity']) ? (int) $entryData['quantity'] : 0;
        $entryCostPrice = isset($entryData['cost_price']) ? (float) $entryData['cost_price'] : 0.0;

        // Avoid division by zero
        if ($entryQuantity > 0 && $entryCostPrice > 0) {
            $newEntryValue = $entryQuantity * $entryCostPrice;
            $totalInventoryValue = $initialInventoryValue + $newEntryValue;

            // Calculate total quantity of inventory
            $totalInventoryQuantity = $this->calculateUpdatedQuantity($product, $entryData);

            // Avoid division by zero
            if ($totalInventoryQuantity > 0) {
                $weightedAverageCost = $totalInventoryValue / $totalInventoryQuantity;

                return round($weightedAverageCost, 2);
            }
        }

        // Return current cost price if no valid new cost can be calculated
        return $product->cost_price;
    }
}

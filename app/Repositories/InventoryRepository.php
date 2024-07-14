<?php

namespace App\Repositories;

use App\Models\Inventory;
use App\Models\Product;

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
}

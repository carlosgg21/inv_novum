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

    public function getInventories()
    {
        return Product::with([
                'category',
                'brand',
                'salesOrderItems',
                'purchaseOrderItems',
                'inventories.inventoryDetails',
                'inventories.location',
                'inventories.supplier',
            ])  ->whereHas('inventories', function ($query) {
            $query->where('quantity', '>', 0)
                  ->orWhere('quantity_on_order', '>', 0);
        });
    }
}

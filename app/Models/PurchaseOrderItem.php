<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrderItem extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'purchase_order_id',
        'quantity',
        'unit_price',
        'total_price',
        'qty_received',
        'noted',
        'inventory_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'purchase_order_items';

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}

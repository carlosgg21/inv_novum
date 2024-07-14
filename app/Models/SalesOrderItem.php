<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrderItem extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_order_id',
        'quantity',
        'unit_price',
        'total_price',
        'notes',
        'inventory_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_order_items';

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}

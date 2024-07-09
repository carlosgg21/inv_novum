<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'image',
        'name',
        'description',
        'unit',
        'unit_price',
        'cost_price',
        'size',
        'category_id',
        'brand_id',
        'qty',
        'notes',
        'min_qty',
        'max_qty',
        'on_order',
    ];

    protected $searchableFields = ['*'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}

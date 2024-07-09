<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'product_id',
        'location_id',
        'quantity',
        'min_qty',
        'max_qty',
        'quantity_on_order',
        'supplier_id',
    ];

    protected $searchableFields = ['*'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function inventoryDetails()
    {
        return $this->hasMany(InventoryDetail::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

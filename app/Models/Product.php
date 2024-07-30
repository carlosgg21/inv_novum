<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'image',
        'name',
        'description',
        'unit_price',
        'cost_price',
        'size',
        'category_id',
        'brand_id',
        'unit_id',
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

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByBrand($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeAvailable($query)
    {
        return $query->where('qty', '>', 0)
                        ->whereNotNull('qty');
    }

    public function scopeUnavailable($query)
    {
        return $query->where(function ($query) {
            $query->where('qty', '<=', 0)
                ->orWhereNull('qty');
        });
    }

    public function scopeBelowMinQty($query)
    {
        return $query->whereColumn('qty', '<', 'min_qty');
    }

    public function scopeAboveMaxQty($query)
    {
        return $query->whereColumn('qty', '>', 'max_qty');
    }

    // Accesor para total_revenue
    public function getTotalRevenueAttribute()
    {
        return $this->unit_price * $this->qty;
    }

    // Accesor para total_cost
    public function getTotalCostAttribute()
    {
        return $this->cost_price * $this->qty;
    }

    // Accesor para total price
    public function getTotalPriceAttribute()
    {
        return $this->unit_price * $this->qty;
    }

    // Accesor para average_margin
    public function getAverageMarginAttribute()
    {
        $totalRevenue = $this->total_revenue; // Utiliza el accesor total_revenue
        $totalCost = $this->total_cost; // Utiliza el accesor total_cost

        // Evitar división por cero
        return $totalRevenue > 0 ? (($totalRevenue - $totalCost) / $totalRevenue) * 100 : 0;
    }
}

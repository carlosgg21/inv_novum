<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Inventory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'product_id',
        'quantity',
        'quantity_on_order',
        'sell_price',
        'cost_price',
        'supplier_id',
        'location_id',
        'batch_number',
        'expire_date',
        'shipping_cost',
        'shipping_tracking_number',
        'received_date',
        'billable',
        'payment_method_id',
        'payment_term_id',
        'created_by',
        'notes',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'expire_date'   => 'date',
        'received_date' => 'date',
        'date_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($inventory) {
            $inventory->created_by = Auth::id();
            $inventory->date_at = now();
            $inventory->notes = self::updateNotes($inventory->notes);
        });

        static::updating(function ($inventory) {
            $inventory->created_by = Auth::id();

            $inventory->notes = self::updateNotes($inventory->notes);
        });
    }

    private static function updateNotes($currentNotes)
    {
        if (trim($currentNotes) === '') {
            return $currentNotes; // Devuelve el valor original si está vacío
        }

        $userName = Auth::user() ? Auth::user()->name : '';
        $timestamp = now()->format('Y-m-d H:i:s');

        return trim($currentNotes)."\n[$timestamp] $userName: ".$currentNotes;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}

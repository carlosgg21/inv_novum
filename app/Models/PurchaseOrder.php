<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'number',
        'order_date',
        'total_amount',
        'status',
        'supplier_id',
        'taxes',
        'discount',
        'miscellaneous',
        'shipping_date',
        'shipping_cost',
        'shippin_tracking_number',
        'received_date',
        'payment_method_id',
        'payment_term_id',
        'condition_id',
        'billable',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'purchase_orders';

    protected $casts = [
        'order_date' => 'date',
        'shipping_date' => 'date',
        'received_date' => 'date',
        'billable' => 'boolean',
    ];

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function paymentMades()
    {
        return $this->hasMany(PaymentMade::class);
    }
}

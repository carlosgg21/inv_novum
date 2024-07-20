<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrder extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'number',
        'prefix',
        'order_date',
        'invoice_date',
        'status',
        'taxes',
        'discount',
        'miscellaneous',
        'freight',
        'order_total',
        'customer_id',
        'payment_method_id',
        'payment_term_id',
        'notes',
        'internal_notes',
        'sold_by',
        'approved_by',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_orders';

    protected $casts = [
        'order_date' => 'date',
        'invoice_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function soldBy()
    {
        return $this->belongsTo(Employee::class, 'sold_by');
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class);
    }

     // Accessor for full_number
    public function getFullNumberAttribute()
    {
        $prefix = $this->prefix;

        return $prefix ? $prefix.' '.$this->number : $this->number;
    }
}

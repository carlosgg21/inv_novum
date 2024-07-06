<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentsReceived extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'payment_method_id',
        'payment_term_id',
        'invoice_id',
        'sales_order_id',
        'date',
        'notes',
        'customer_id',
        'received_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'payments_receiveds';

    protected $casts = [
        'date' => 'date',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'received_id');
    }
}

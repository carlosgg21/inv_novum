<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMade extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'payment_method_id',
        'payment_term_id',
        'amount',
        'reference_number',
        'date',
        'purchase_order_id',
        'created_by',
        'aproved_by',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'payment_mades';

    protected $casts = [
        'date' => 'date',
    ];

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

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}

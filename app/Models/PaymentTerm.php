<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTerm extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['description', 'day', 'code'];

    protected $searchableFields = ['*'];

    protected $table = 'payment_terms';

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function paymentMades()
    {
        return $this->hasMany(PaymentMade::class);
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class);
    }
}

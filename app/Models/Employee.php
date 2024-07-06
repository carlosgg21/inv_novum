<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'identification',
        'name',
        'last_name',
        'phone',
        'email',
        'image',
        'hiddeng_date',
        'discharge_date',
        'company_id',
        'brithday',
        'observation',
        'charge_id',
        'qr_code',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'hiddeng_date' => 'date',
        'discharge_date' => 'date',
        'brithday' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class, 'sold_by');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentMades()
    {
        return $this->hasMany(PaymentMade::class, 'created_by');
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class, 'received_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}

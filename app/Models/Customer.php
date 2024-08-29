<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'address'];

    protected $searchableFields = ['*'];

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class);
    }

    public function bankAccounts()
    {
        return $this->morphMany(BankAccount::class, 'bank_accountable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    
     public function getDefaultContact()
    {
        return $this->contacts()->where('default', true)->first();
    }


    public function getAllContacts()
    {
        return $this->contacts;
    }
}

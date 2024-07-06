<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'phone', 'email', 'address'];

    protected $searchableFields = ['*'];

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class);
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    public function bankAccounts()
    {
        return $this->morphMany(BankAccount::class, 'bank_accountable');
    }
}

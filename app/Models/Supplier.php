<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'note',
        'address',
        'country_id',
    ];

    protected $searchableFields = ['*'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function paymentMades()
    {
        return $this->hasMany(PaymentMade::class);
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

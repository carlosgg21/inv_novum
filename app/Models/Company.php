<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'acronym',
        'logo',
        'slogan',
        'phone',
        'email',
        'web_site',
        'social_media',
        'address',
        'qr_code',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'social_media' => 'array',
    ];

    public function companyContacts()
    {
        return $this->hasMany(CompanyContact::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function bankAccounts()
    {
        return $this->morphMany(BankAccount::class, 'bank_accountable');
    }

    public function addresses()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}

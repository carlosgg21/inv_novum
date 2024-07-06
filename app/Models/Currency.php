<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['acronym', 'name', 'sign', 'code', 'flag'];

    protected $searchableFields = ['*'];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}

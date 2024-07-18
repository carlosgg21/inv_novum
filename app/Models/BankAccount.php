<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class BankAccount extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'number',
        'type',
        'bank_accountable_id',
        'bank_accountable_type',
        'bank_id',
        'currency_id',
        'default',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_accounts';

    protected $casts = [
        'default' => 'boolean',
    ];

    public function getNumberAttribute()
    {
        return Crypt::decrypt($this->attributes['number']);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function bank_accountable()
    {
        return $this->morphTo();
    }

    public function getMaskedNumberAttribute()
    {
        $number = Crypt::decrypt($this->attributes['number']);

        $length = strlen($number);
        $maskedNumber = substr($number, 0, 4).'-'.str_repeat('*', 4).'-'.str_repeat('*', 4).'-'.substr($number, -4);

        return $maskedNumber;
    }
}

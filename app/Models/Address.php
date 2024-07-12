<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'address',
        'zip_code',
        'township_id',
        'city_id',
        'country_id',
        'addressable_id',
        'addressable_type',
        'default',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'default' => 'boolean',
    ];

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'identification',
        'name',
        'last_name',
        'phone',
        'email',
        'address',
        'contactable_id',
        'contactable_type',
        'township_id',
        'city_id',
        'country_id',
        'zip_code',
        'default',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'default' => 'boolean',
    ];

    protected $appends = ['full_name'];

     protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name . ' ' . $this->last_name,
        );
    }


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

    public function contactable()
    {
        return $this->morphTo();
    }

    
}

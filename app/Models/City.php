<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['code', 'name', 'acronym', 'country_id', 'zip_code'];

    protected $searchableFields = ['*'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

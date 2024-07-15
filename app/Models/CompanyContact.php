<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'social_media',
        'title',
        'company_id',
        'charge_id',
        'boss',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'company_contacts';
    
    protected $appends = ['full_name'];
    
    protected $casts = [
        'social_media' => 'array',
        'boss'         => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name.' '.$this->last_name,
        );
    }
}

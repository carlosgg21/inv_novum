<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $casts = [
        'social_media' => 'array',
        'boss' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class);
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prefix extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'display',
        'description',
        'used_in',
        'star_number',
        'position',
    ];

    protected $searchableFields = ['*'];
}

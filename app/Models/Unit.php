<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
  use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',    
        'description',   
    ];

    protected $searchableFields = ['*'];

     public function products()
    {
        return $this->hasMany(Product::class);
    }
}

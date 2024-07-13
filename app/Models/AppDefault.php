<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class AppDefault extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'module',
        'name',
        'display_name',
        'value',
        'description',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'app_defaults';

       protected static function boot()
    {
        parent::boot();

        static::saved(function ($appDefault) {
            $cacheKey = "app_default{$appDefault->module}_{$appDefault->name}";
            Cache::forget($cacheKey);
        });

        static::deleted(function ($appDefault) {
            $cacheKey = "app_default{$appDefault->module}_{$appDefault->name}";
            Cache::forget($cacheKey);
        });
    }
}

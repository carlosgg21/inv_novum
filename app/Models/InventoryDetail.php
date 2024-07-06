<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'inventory_id',
        'batch_number',
        'expire_date',
        'unit_cost',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'inventory_details';

    protected $casts = [
        'expire_date' => 'date',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'number',
        'date',
        'sales_order_id',
        'total_amount',
        'status',
        'year',
        'mount',
        'employee_id',
        'currency_id',
        'notes',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class);
    }
}

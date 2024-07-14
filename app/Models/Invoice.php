<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'number',
        'prefix',
        'date',
        'sales_order_id',
        'total_amount',
        'status',
        'year',
        'month',
        'employee_id',
        'currency_id',
        'notes',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->number = self::generateInvoiceNumber();
        });

        static::updating(function ($invoice) {
            if (!$invoice->number) {
                $invoice->number = self::generateInvoiceNumber();
            }
        });
    }

    public static function generateInvoiceNumber()
    {
        $invoiceNumberStart = setting('invoice.start_with_default_value')
            ? app_default('invoice.invoice_number_start')
            : 1;

        $lastInvoice = self::latest('id')->first();
        $lastNumber = $lastInvoice ? intval($lastInvoice->number) : intval($invoiceNumberStart) - 1;

        return str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    }

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

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeExcludeStatuses($query, array $statuses)
    {
        return $query->whereNotIn('status', $statuses);
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    // Accessor for prefix
    public function getPrefixAttribute()
    {
        return app_default('invoice.invoice_prefix', '');
    }

    // Accessor for full_number
    public function getFullNumberAttribute()
    {
        $prefix = $this->prefix;

        return $prefix ? $prefix.' '.$this->number : $this->number;
    }
}

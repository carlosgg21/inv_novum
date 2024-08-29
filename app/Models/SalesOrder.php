<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'number',
        'prefix',
        'order_date',
        'invoice_date',
        'status',
        'taxes',
        'discount',
        'miscellaneous',
        'freight',
        'order_total',
        'customer_id',
        'payment_method_id',
        'payment_term_id',
        'notes',
        'internal_notes',
        'sold_by',
        'approved_by',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_orders';

    protected $casts = [
        'order_date'   => 'date',
        'invoice_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($salesOrder) {
            // Generar el número de orden
            $salesOrder->number = self::generateOrderNumber();
            $salesOrder->prefix = self::getOrderPrefix();
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function soldBy()
    {
        return $this->belongsTo(Employee::class, 'sold_by');
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class);
    }

    // Accessor for full_number
    public function getFullNumberAttribute()
    {
        $prefix = $this->prefix;

        return $prefix ? $prefix.' '.$this->number : $this->number;
    }

    private static function generateOrderNumber()
    {
        // $prefix = 'SO'; // Prefijo de la orden
        $date = now()->format('Ymd'); // Fecha actual en formato YYYYMMDD

        // Obtener el último número de orden del mismo día
        $lastOrder = self::whereDate('created_at', now())->orderBy('created_at', 'desc')->first();

        // Si no hay órdenes del mismo día, iniciar con 1
        $sequence = $lastOrder ? (int) substr($lastOrder->number, -4) + 1 : 1;

        // Si se alcanza el límite de 9999, puedes manejarlo como prefieras (reiniciar, lanzar un error, etc.)
        if ($sequence > 9999) {
            throw new \Exception('Se ha alcanzado el límite máximo de órdenes para el día.');
        }

        // Formatear el número de orden
        return "{$date}-".str_pad($sequence, 4, '0', STR_PAD_LEFT);
        // return "{$prefix}-{$date}-" . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    private static function getOrderPrefix()
    {
        if (!setting('sales_order.used_prefix')) {
            return ''; // Retorna vacío si el ajuste no está activo
        }

        $prefix = Prefix::where('used_in', 'sales_order')->first();

        return $prefix ? $prefix->display : ''; // Retorna el prefijo o vacío si no se encuentra
    }

    public function getConditionAttribute()
    {
        return $this->invoice_date ? 'invoiced' : 'pending';
    }

    public function getIsInvoicedAttribute()
    {
        return !is_null($this->invoice_date);
    }

    public function scopeInvoiced($query)
    {
        return $query->whereNotNull('invoice_date');
    }

    public function scopePending($query)
    {
        return $query->whereNull('invoice_date');
    }
}

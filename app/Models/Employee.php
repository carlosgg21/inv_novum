<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Employee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'identification',
        'name',
        'last_name',
        'phone',
        'email',
        'image',
        'hiddeng_date',
        'discharge_date',
        'company_id',
        'brithday',
        'observation',
        'charge_id',
        'qr_code',
    ];

    //TODO camabiar hiring_date birthday
    protected $searchableFields = ['*'];

    protected $casts = [
        'hiddeng_date' => 'date',
        'discharge_date' => 'date',
        'brithday' => 'date',
    ];

     protected $appends = ['full_name'];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->company_id = 1;
        });

        static::updating(function ($employee) {
            $employee->company_id = 1;
        });
    }

  /**
     * Scope a query to only include active employees.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('discharge_date');
    }


    /**
     * Scope a query to only include inactive employees.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->whereNotNull('discharge_date');
    }

    /**
     * Determine if the employee is active.
     *
     * @return bool
     */
    public function getIsActiveAttribute(): bool
    {
        return is_null($this->discharge_date);
    }

    /**
     * Get the employee's status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_active ? 'Active' : 'Inactive',
        );
    }

     protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name . ' ' . $this->last_name,
        );
    }



    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function charge()
    {
        return $this->belongsTo(Charge::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class, 'sold_by');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentMades()
    {
        return $this->hasMany(PaymentMade::class, 'created_by');
    }

    public function paymentsReceiveds()
    {
        return $this->hasMany(PaymentsReceived::class, 'received_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
/*
Estas modificaciones agregan:
Un scope active() que filtra los empleados sin fecha de baja.
Un scope inactive() que filtra los empleados con fecha de baja.
Un atributo is_active que determina si un empleado está activo.
Un atributo status que devuelve "Active" o "Inactive" basado en la presencia de discharge_date.
Un atributo years_of_service que calcula los años de servicio del empleado.
Ahora puedes usar estas funciones así:
php
// Obtener todos los empleados activos
$activeEmployees = Employee::active()->get();

// Obtener todos los empleados inactivos
$inactiveEmployees = Employee::inactive()->get();

// Verificar si un empleado está activo
$employee = Employee::find(1);
if ($employee->is_active) {
    // ...
}

// Obtener el estado de un empleado
echo $employee->status; // "Active" o "Inactive"

// Obtener los años de servicio de un empleado
echo $employee->years_of_service;*/
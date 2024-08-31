<?php

namespace App\Traits;


trait HasAddresses
{
    // Método para obtener la dirección por defecto (primera dirección)
    public function getDefaultAddress()
    {
        return $this->addresses()->with(['city', 'country', 'township'])->first(); // Devuelve la primera dirección
    }

    // Método para obtener todas las direcciones
    public function getAllAddresses()
    {
        return $this->addresses; // Devuelve todas las direcciones
    }
}
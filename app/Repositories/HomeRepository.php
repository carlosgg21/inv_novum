<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class HomeRepository
{
    /**
     * Obtener productos disponibles en la categoría especificada
     *
     * @param [type] $categoryId
     * @return Collection
     */
    // public function getAvailableProductsByCategory($categoryId) :Collection
    // {
    //     return Product::byCategory($categoryId)
    //                     ->available()
    //                     ->get();
    // }
}

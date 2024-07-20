<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function cantProductAviable() :int
    {
        return Product::available()->count();
    }

    public function totalProduct() :int
    {
        return Product::get()->count();
    }

	
    /**
     * Obtener productos con cantidad por debajo del mínimo
     *
     * @return Collection
     */
    public function getProductsBelowMinQty() : Collection
    {
        return Product::available()
						->belowMinQty()
						->get();
    }

    /**
     * Calcular el valor total del inventario
     *
     * Valor Total del Inventario: Es el valor monetario total de todos los productos en stock, calculado multiplicando el costo unitario de cada producto por la cantidad en stock y sumando todos los resultados.
     *Inversión Total de Capital en el Inventario: Es la cantidad total de capital que has invertido en el inventario actual. Dado que el inventario es un activo, el valor total del inventario también representa la inversión total de capital
     * @return float
     */
    public function totalInventoryValue() : float
    {
        return Product::available()->get()->sum(function ($product) {
            return $product->cost_price * $product->qty;
        });
    }


/**
     * Calcular el margen de ganancia bruta promedio para cada producto
     *
	 * Este método obtiene todos los productos y calcula el margen de ganancia bruta promedio para cada uno.
 * Para cada producto, calcula:
 * Total de Ingresos: unit_price * qty
 * Total de Costos: cost_price * qty
 * Margen de Ganancia Promedio:
 * Devuelve una colección con el ID del producto, nombre, margen promedio, ingresos totales y costos totales.
     * @return Collection
     */
    public function averageGrossMarginPerProduct() : Collection
    {
        return Product::all()->map(function ($product) {
            $totalRevenue = $product->unit_price * $product->qty;
            $totalCost = $product->cost_price * $product->qty;

            // Evitar división por cero
            $averageMargin = $totalRevenue > 0 ? (($totalRevenue - $totalCost) / $totalRevenue) * 100 : 0;

            return [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'average_margin' => $averageMargin,
                'total_revenue' => $totalRevenue,
                'total_cost' => $totalCost,
            ];
        });
    }

    /**
     * Identificar los productos con mayor ganancia bruta total
     *
	 * Este método también obtiene todos los productos y calcula la ganancia bruta total para cada uno.
 * Para cada producto, calcula:
*Ganancia Bruta: Total de Ingresos - Total de Costos
*Devuelve una colección de los productos ordenados por ganancia bruta en
* orden descendente, limitando el resultado a los primeros 5 productos (puedes ajustar el límite según tus necesidades).
     * @return Collection
     */
    public function topGrossProfitProducts(int $limit = 5) : Collection
    {
        return Product::all()->map(function ($product) {
            $totalRevenue = $product->unit_price * $product->qty;
            $totalCost = $product->cost_price * $product->qty;
            $grossProfit = $totalRevenue - $totalCost;

            return [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'gross_profit' => $grossProfit,
            ];
        })->sortByDesc('gross_profit')->take($limit);
    }


// -------------------
// CATAGORIA
// -------------
	
    /**
     * Obtener productos disponibles en por categoría
     *
     * @param [type] $categoryId
     * @return Collection
     */
    public function getAvailableProductsByCategory() :Collection
    {
        $products = Product::available()->with('category')->get();

        return $products->groupBy(function ($product) {
            return $product->category->name;
        });
    }

    /**
     * Calcular el margen de ganancia bruta promedio por categoría
     *
	 * Este método obtiene todos los productos junto con sus categorías.
*Agrupa los productos por category_id.
*Para cada grupo de productos, calcula:
*Total de Costo: Suma de cost_price multiplicado por qty.
*Total de Ingresos: Suma de unit_price multiplicado por qty.
*Margen de Ganancia Promedio: Calcula el margen de ganancia bruta promedio usando la fórmula:
*Devuelve una colección con el margen promedio y el nombre de la categoría.
     * @return Collection
     */
    public function averageGrossMarginByCategory() : Collection
    {
        return Product::with('category')
            ->get()
            ->groupBy('category_id')
            ->map(function ($products) {
                $totalCost = $products->sum(function ($product) {
                    return $product->cost_price * $product->qty;
                });

                $totalRevenue = $products->sum(function ($product) {
                    return $product->unit_price * $product->qty;
                });

                // Evitar división por cero
                $averageMargin = $totalRevenue > 0 ? (($totalRevenue - $totalCost) / $totalRevenue) * 100 : 0;

                return [
                    'average_margin' => $averageMargin,
                    'category_id'    => $products->first()->category_id,
                    'category_name'  => $products->first()->category->name,
                ];
            });
    }

    /**
     * Identificar las categorías más rentables
     *
     * Este método utiliza averageGrossMarginByCategory() para obtener el margen de ganancia promedio por categoría.
     *Ordena las categorías por margen de ganancia promedio en orden descendente y devuelve las más rentables
	 * (en este caso, las 5 más rentables, pero puedes ajustar este número según tus necesidades).
     * @return Collection
     */
    public function mostProfitableCategories() : Collection
    {
        return $this->averageGrossMarginByCategory()
            ->sortByDesc('average_margin')
            ->take(5); // Puedes ajustar el número de categorías que deseas mostrar
    }
}

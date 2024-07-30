<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProdcutReportController extends Controller
{
    /**
     * retornoa el lsitado de productos
     * si stock true : devule solo el lsitadod e productos con stock
     *si stock false :devulve los prodcutos csin stock
     * si es null devuelve todos los productos
     * @param [type] $stok
     * @return void
     */
    public function productList(Request $request, $stock = null)
    {
        $products = match ($stock) {
            '1'     => Product::with(['category', 'brand', 'unit'])->available()->get(),
            '0'     => Product::with(['category', 'brand', 'unit'])->unavailable()->get(),
            default => Product::with(['category', 'brand', 'unit'])->get(),
        };

        $title = match ($stock) {
            '1'     => 'Products with Stock',
            '0'     => 'Products Out Of Stock', 
            default => 'Products List',
        };

        $data = [
                'title'    => $title,
                'date'     => date('m/d/Y'),
                'products' => $products,

            ];

        if ($request->has('view')) {
            return view('reports.products-list', $data);
        }

        return generatePDF('reports.products-list', $data, 'product_report.pdf');
    }
}

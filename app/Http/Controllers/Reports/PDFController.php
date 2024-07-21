<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Product;

class PDFController extends Controller
{



    public function generatePDF()
    {
        $products = Product::get();

        $data = [

            'title' => 'We478',

            'date' => date('m/d/Y'),

            'users' => $products,

        ];

       
        return generatePDF('reports.myPDF', $data, 'product_report.pdf');

    }
}

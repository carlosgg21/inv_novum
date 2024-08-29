<?php


use App\Http\Controllers\Reports\PDFController;
use App\Http\Controllers\Reports\ProdcutReportController;
use App\Http\Controllers\Reports\SalesOrderReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('reports')->group(function () {        
    
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])
        ->name('reports.generate-pdf');
        // ->middleware('can:generate-pdf'); 

Route::get('/product-list/{stock?}', [ProdcutReportController::class, 'productList'])
        ->name('reports.products')
    ->where('stock', '1|0|null');

Route::get('/invoice/{id}', [SalesOrderReportController::class, 'salesOrder'])
    ->name('reports.sales_order');

});

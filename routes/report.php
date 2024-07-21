<?php


use App\Http\Controllers\Reports\PDFController;
use Illuminate\Support\Facades\Route;

Route::prefix('reports')->group(function () {        
    
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])
        ->name('reports.generate-pdf');
        // ->middleware('can:generate-pdf'); 


});

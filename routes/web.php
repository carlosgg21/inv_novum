<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AppDefaultController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentMadeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentsReceivedController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/report.php';


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('app-defaults', AppDefaultController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('locations', LocationController::class);
        Route::resource('currencies', CurrencyController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('charges', ChargeController::class);
        Route::resource('conditions', ConditionController::class);
        Route::resource('payment-methods', PaymentMethodController::class);
        Route::resource('payment-terms', PaymentTermController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('banks', BankController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('bank-accounts', BankAccountController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('addresses', AddressController::class);
        Route::resource('prefixes', PrefixController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('townships', TownshipController::class);
        Route::resource('products', ProductController::class);
        Route::resource('sales-orders', SalesOrderController::class);
        Route::resource('purchase-orders', PurchaseOrderController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('payment-mades', PaymentMadeController::class);
        Route::resource(
            'payments-receiveds',
            PaymentsReceivedController::class
        );
    });

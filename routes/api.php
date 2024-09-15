<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ChargeController;
use App\Http\Controllers\Api\PrefixController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\TownshipController;
use App\Http\Controllers\Api\ConditionController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\AppDefaultController;
use App\Http\Controllers\Api\SalesOrderController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PaymentTermController;
use App\Http\Controllers\Api\BankAccountController;
use App\Http\Controllers\Api\PaymentMadeController;
use App\Http\Controllers\Api\CityContactsController;
use App\Http\Controllers\Api\BrandProductsController;
use App\Http\Controllers\Api\CityTownshipsController;
use App\Http\Controllers\Api\CityAddressesController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\CountryCitiesController;
use App\Http\Controllers\Api\CompanyContactController;
use App\Http\Controllers\Api\SalesOrderItemController;
use App\Http\Controllers\Api\ChargeEmployeesController;
use App\Http\Controllers\Api\CountryContactsController;
use App\Http\Controllers\Api\CurrencyInvoicesController;
use App\Http\Controllers\Api\CategoryProductsController;
use App\Http\Controllers\Api\CompanyEmployeesController;
use App\Http\Controllers\Api\BankBankAccountsController;
use App\Http\Controllers\Api\EmployeeInvoicesController;
use App\Http\Controllers\Api\TownshipContactsController;
use App\Http\Controllers\Api\CountrySuppliersController;
use App\Http\Controllers\Api\CountryAddressesController;
use App\Http\Controllers\Api\PaymentsReceivedController;
use App\Http\Controllers\Api\CurrencyCountriesController;
use App\Http\Controllers\Api\TownshipAddressesController;
use App\Http\Controllers\Api\PurchaseOrderItemController;
use App\Http\Controllers\Api\ProductInventoriesController;
use App\Http\Controllers\Api\SalesOrderInvoicesController;
use App\Http\Controllers\Api\LocationInventoriesController;
use App\Http\Controllers\Api\CustomerSalesOrdersController;
use App\Http\Controllers\Api\EmployeeSalesOrdersController;
use App\Http\Controllers\Api\SupplierInventoriesController;
use App\Http\Controllers\Api\CurrencyBankAccountsController;
use App\Http\Controllers\Api\EmployeePaymentMadesController;
use App\Http\Controllers\Api\SupplierPaymentMadesController;
use App\Http\Controllers\Api\ChargeCompanyContactsController;
use App\Http\Controllers\Api\PaymentTermSalesOrdersController;
use App\Http\Controllers\Api\CompanyCompanyContactsController;
use App\Http\Controllers\Api\SupplierPurchaseOrdersController;
use App\Http\Controllers\Api\ConditionPurchaseOrdersController;
use App\Http\Controllers\Api\PaymentTermPaymentMadesController;
use App\Http\Controllers\Api\PaymentMethodSalesOrdersController;
use App\Http\Controllers\Api\InventorySalesOrderItemsController;
use App\Http\Controllers\Api\InvoicePaymentsReceivedsController;
use App\Http\Controllers\Api\PaymentMethodPaymentMadesController;
use App\Http\Controllers\Api\PaymentTermPurchaseOrdersController;
use App\Http\Controllers\Api\CustomerPaymentsReceivedsController;
use App\Http\Controllers\Api\EmployeePaymentsReceivedsController;
use App\Http\Controllers\Api\SalesOrderSalesOrderItemsController;
use App\Http\Controllers\Api\PurchaseOrderPaymentMadesController;
use App\Http\Controllers\Api\PaymentMethodPurchaseOrdersController;
use App\Http\Controllers\Api\InventoryPurchaseOrderItemsController;
use App\Http\Controllers\Api\SalesOrderPaymentsReceivedsController;
use App\Http\Controllers\Api\PaymentTermPaymentsReceivedsController;
use App\Http\Controllers\Api\PaymentMethodPaymentsReceivedsController;
use App\Http\Controllers\Api\PurchaseOrderPurchaseOrderItemsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get-product-details/{productId}', [ProductController::class, 'getProductDetails']);
Route::get('/get-townships-by-city/{cityId}', [TownshipController::class, 'TownshipsByCity'])
->name('api.get-townships-by-city');

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('settings', SettingController::class);

        Route::apiResource('app-defaults', AppDefaultController::class);

        Route::apiResource('brands', BrandController::class);

        // Brand Products
        Route::get('/brands/{brand}/products', [
            BrandProductsController::class,
            'index',
        ])->name('brands.products.index');
        Route::post('/brands/{brand}/products', [
            BrandProductsController::class,
            'store',
        ])->name('brands.products.store');

        Route::apiResource('locations', LocationController::class);

        // Location Inventories
        Route::get('/locations/{location}/inventories', [
            LocationInventoriesController::class,
            'index',
        ])->name('locations.inventories.index');
        Route::post('/locations/{location}/inventories', [
            LocationInventoriesController::class,
            'store',
        ])->name('locations.inventories.store');

        Route::apiResource('currencies', CurrencyController::class);

        // Currency Countries
        Route::get('/currencies/{currency}/countries', [
            CurrencyCountriesController::class,
            'index',
        ])->name('currencies.countries.index');
        Route::post('/currencies/{currency}/countries', [
            CurrencyCountriesController::class,
            'store',
        ])->name('currencies.countries.store');

        // Currency Invoices
        Route::get('/currencies/{currency}/invoices', [
            CurrencyInvoicesController::class,
            'index',
        ])->name('currencies.invoices.index');
        Route::post('/currencies/{currency}/invoices', [
            CurrencyInvoicesController::class,
            'store',
        ])->name('currencies.invoices.store');

        // Currency Bank Accounts
        Route::get('/currencies/{currency}/bank-accounts', [
            CurrencyBankAccountsController::class,
            'index',
        ])->name('currencies.bank-accounts.index');
        Route::post('/currencies/{currency}/bank-accounts', [
            CurrencyBankAccountsController::class,
            'store',
        ])->name('currencies.bank-accounts.store');

        Route::apiResource('categories', CategoryController::class);

        // Category Products
        Route::get('/categories/{category}/products', [
            CategoryProductsController::class,
            'index',
        ])->name('categories.products.index');
        Route::post('/categories/{category}/products', [
            CategoryProductsController::class,
            'store',
        ])->name('categories.products.store');

        Route::apiResource('cities', CityController::class);

        // City Townships
        Route::get('/cities/{city}/townships', [
            CityTownshipsController::class,
            'index',
        ])->name('cities.townships.index');
        Route::post('/cities/{city}/townships', [
            CityTownshipsController::class,
            'store',
        ])->name('cities.townships.store');

        // City Addresses
        Route::get('/cities/{city}/addresses', [
            CityAddressesController::class,
            'index',
        ])->name('cities.addresses.index');
        Route::post('/cities/{city}/addresses', [
            CityAddressesController::class,
            'store',
        ])->name('cities.addresses.store');

        // City Contacts
        Route::get('/cities/{city}/contacts', [
            CityContactsController::class,
            'index',
        ])->name('cities.contacts.index');
        Route::post('/cities/{city}/contacts', [
            CityContactsController::class,
            'store',
        ])->name('cities.contacts.store');

        Route::apiResource('charges', ChargeController::class);

        // Charge Employees
        Route::get('/charges/{charge}/employees', [
            ChargeEmployeesController::class,
            'index',
        ])->name('charges.employees.index');
        Route::post('/charges/{charge}/employees', [
            ChargeEmployeesController::class,
            'store',
        ])->name('charges.employees.store');

        // Charge Company Contacts
        Route::get('/charges/{charge}/company-contacts', [
            ChargeCompanyContactsController::class,
            'index',
        ])->name('charges.company-contacts.index');
        Route::post('/charges/{charge}/company-contacts', [
            ChargeCompanyContactsController::class,
            'store',
        ])->name('charges.company-contacts.store');

        Route::apiResource('conditions', ConditionController::class);

        // Condition Purchase Orders
        Route::get('/conditions/{condition}/purchase-orders', [
            ConditionPurchaseOrdersController::class,
            'index',
        ])->name('conditions.purchase-orders.index');
        Route::post('/conditions/{condition}/purchase-orders', [
            ConditionPurchaseOrdersController::class,
            'store',
        ])->name('conditions.purchase-orders.store');

        Route::apiResource('payment-methods', PaymentMethodController::class);

        // PaymentMethod Purchase Orders
        Route::get('/payment-methods/{paymentMethod}/purchase-orders', [
            PaymentMethodPurchaseOrdersController::class,
            'index',
        ])->name('payment-methods.purchase-orders.index');
        Route::post('/payment-methods/{paymentMethod}/purchase-orders', [
            PaymentMethodPurchaseOrdersController::class,
            'store',
        ])->name('payment-methods.purchase-orders.store');

        // PaymentMethod Sales Orders
        Route::get('/payment-methods/{paymentMethod}/sales-orders', [
            PaymentMethodSalesOrdersController::class,
            'index',
        ])->name('payment-methods.sales-orders.index');
        Route::post('/payment-methods/{paymentMethod}/sales-orders', [
            PaymentMethodSalesOrdersController::class,
            'store',
        ])->name('payment-methods.sales-orders.store');

        // PaymentMethod Payment Mades
        Route::get('/payment-methods/{paymentMethod}/payment-mades', [
            PaymentMethodPaymentMadesController::class,
            'index',
        ])->name('payment-methods.payment-mades.index');
        Route::post('/payment-methods/{paymentMethod}/payment-mades', [
            PaymentMethodPaymentMadesController::class,
            'store',
        ])->name('payment-methods.payment-mades.store');

        // PaymentMethod Payments Receiveds
        Route::get('/payment-methods/{paymentMethod}/payments-receiveds', [
            PaymentMethodPaymentsReceivedsController::class,
            'index',
        ])->name('payment-methods.payments-receiveds.index');
        Route::post('/payment-methods/{paymentMethod}/payments-receiveds', [
            PaymentMethodPaymentsReceivedsController::class,
            'store',
        ])->name('payment-methods.payments-receiveds.store');

        Route::apiResource('payment-terms', PaymentTermController::class);

        // PaymentTerm Purchase Orders
        Route::get('/payment-terms/{paymentTerm}/purchase-orders', [
            PaymentTermPurchaseOrdersController::class,
            'index',
        ])->name('payment-terms.purchase-orders.index');
        Route::post('/payment-terms/{paymentTerm}/purchase-orders', [
            PaymentTermPurchaseOrdersController::class,
            'store',
        ])->name('payment-terms.purchase-orders.store');

        // PaymentTerm Sales Orders
        Route::get('/payment-terms/{paymentTerm}/sales-orders', [
            PaymentTermSalesOrdersController::class,
            'index',
        ])->name('payment-terms.sales-orders.index');
        Route::post('/payment-terms/{paymentTerm}/sales-orders', [
            PaymentTermSalesOrdersController::class,
            'store',
        ])->name('payment-terms.sales-orders.store');

        // PaymentTerm Payment Mades
        Route::get('/payment-terms/{paymentTerm}/payment-mades', [
            PaymentTermPaymentMadesController::class,
            'index',
        ])->name('payment-terms.payment-mades.index');
        Route::post('/payment-terms/{paymentTerm}/payment-mades', [
            PaymentTermPaymentMadesController::class,
            'store',
        ])->name('payment-terms.payment-mades.store');

        // PaymentTerm Payments Receiveds
        Route::get('/payment-terms/{paymentTerm}/payments-receiveds', [
            PaymentTermPaymentsReceivedsController::class,
            'index',
        ])->name('payment-terms.payments-receiveds.index');
        Route::post('/payment-terms/{paymentTerm}/payments-receiveds', [
            PaymentTermPaymentsReceivedsController::class,
            'store',
        ])->name('payment-terms.payments-receiveds.store');

        Route::apiResource('companies', CompanyController::class);

        // Company Company Contacts
        Route::get('/companies/{company}/company-contacts', [
            CompanyCompanyContactsController::class,
            'index',
        ])->name('companies.company-contacts.index');
        Route::post('/companies/{company}/company-contacts', [
            CompanyCompanyContactsController::class,
            'store',
        ])->name('companies.company-contacts.store');

        // Company Employees
        Route::get('/companies/{company}/employees', [
            CompanyEmployeesController::class,
            'index',
        ])->name('companies.employees.index');
        Route::post('/companies/{company}/employees', [
            CompanyEmployeesController::class,
            'store',
        ])->name('companies.employees.store');

        Route::apiResource('banks', BankController::class);

        // Bank Bank Accounts
        Route::get('/banks/{bank}/bank-accounts', [
            BankBankAccountsController::class,
            'index',
        ])->name('banks.bank-accounts.index');
        Route::post('/banks/{bank}/bank-accounts', [
            BankBankAccountsController::class,
            'store',
        ])->name('banks.bank-accounts.store');

        Route::apiResource('contacts', ContactController::class);

        Route::apiResource('bank-accounts', BankAccountController::class);

        Route::apiResource('customers', CustomerController::class);

        // Customer Sales Orders
        Route::get('/customers/{customer}/sales-orders', [
            CustomerSalesOrdersController::class,
            'index',
        ])->name('customers.sales-orders.index');
        Route::post('/customers/{customer}/sales-orders', [
            CustomerSalesOrdersController::class,
            'store',
        ])->name('customers.sales-orders.store');

        // Customer Payments Receiveds
        Route::get('/customers/{customer}/payments-receiveds', [
            CustomerPaymentsReceivedsController::class,
            'index',
        ])->name('customers.payments-receiveds.index');
        Route::post('/customers/{customer}/payments-receiveds', [
            CustomerPaymentsReceivedsController::class,
            'store',
        ])->name('customers.payments-receiveds.store');

        Route::apiResource('employees', EmployeeController::class);

        // Employee Sales Orders
        Route::get('/employees/{employee}/sales-orders', [
            EmployeeSalesOrdersController::class,
            'index',
        ])->name('employees.sales-orders.index');
        Route::post('/employees/{employee}/sales-orders', [
            EmployeeSalesOrdersController::class,
            'store',
        ])->name('employees.sales-orders.store');

        // Employee Invoices
        Route::get('/employees/{employee}/invoices', [
            EmployeeInvoicesController::class,
            'index',
        ])->name('employees.invoices.index');
        Route::post('/employees/{employee}/invoices', [
            EmployeeInvoicesController::class,
            'store',
        ])->name('employees.invoices.store');

        // Employee Payment Mades
        Route::get('/employees/{employee}/payment-mades', [
            EmployeePaymentMadesController::class,
            'index',
        ])->name('employees.payment-mades.index');
        Route::post('/employees/{employee}/payment-mades', [
            EmployeePaymentMadesController::class,
            'store',
        ])->name('employees.payment-mades.store');

        // Employee Payments Receiveds
        Route::get('/employees/{employee}/payments-receiveds', [
            EmployeePaymentsReceivedsController::class,
            'index',
        ])->name('employees.payments-receiveds.index');
        Route::post('/employees/{employee}/payments-receiveds', [
            EmployeePaymentsReceivedsController::class,
            'store',
        ])->name('employees.payments-receiveds.store');

        Route::apiResource('addresses', AddressController::class);

        Route::apiResource('prefixes', PrefixController::class);

        Route::apiResource('suppliers', SupplierController::class);

        // Supplier Purchase Orders
        Route::get('/suppliers/{supplier}/purchase-orders', [
            SupplierPurchaseOrdersController::class,
            'index',
        ])->name('suppliers.purchase-orders.index');
        Route::post('/suppliers/{supplier}/purchase-orders', [
            SupplierPurchaseOrdersController::class,
            'store',
        ])->name('suppliers.purchase-orders.store');

        // Supplier Payment Mades
        Route::get('/suppliers/{supplier}/payment-mades', [
            SupplierPaymentMadesController::class,
            'index',
        ])->name('suppliers.payment-mades.index');
        Route::post('/suppliers/{supplier}/payment-mades', [
            SupplierPaymentMadesController::class,
            'store',
        ])->name('suppliers.payment-mades.store');

        // Supplier Inventories
        Route::get('/suppliers/{supplier}/inventories', [
            SupplierInventoriesController::class,
            'index',
        ])->name('suppliers.inventories.index');
        Route::post('/suppliers/{supplier}/inventories', [
            SupplierInventoriesController::class,
            'store',
        ])->name('suppliers.inventories.store');

        Route::apiResource('townships', TownshipController::class);

        // Township Addresses
        Route::get('/townships/{township}/addresses', [
            TownshipAddressesController::class,
            'index',
        ])->name('townships.addresses.index');
        Route::post('/townships/{township}/addresses', [
            TownshipAddressesController::class,
            'store',
        ])->name('townships.addresses.store');

        // Township Contacts
        Route::get('/townships/{township}/contacts', [
            TownshipContactsController::class,
            'index',
        ])->name('townships.contacts.index');
        Route::post('/townships/{township}/contacts', [
            TownshipContactsController::class,
            'store',
        ])->name('townships.contacts.store');

        Route::apiResource('products', ProductController::class);

        // Product Inventories
        Route::get('/products/{product}/inventories', [
            ProductInventoriesController::class,
            'index',
        ])->name('products.inventories.index');
        Route::post('/products/{product}/inventories', [
            ProductInventoriesController::class,
            'store',
        ])->name('products.inventories.store');

        Route::apiResource('sales-orders', SalesOrderController::class);

        // SalesOrder Sales Order Items
        Route::get('/sales-orders/{salesOrder}/sales-order-items', [
            SalesOrderSalesOrderItemsController::class,
            'index',
        ])->name('sales-orders.sales-order-items.index');
        Route::post('/sales-orders/{salesOrder}/sales-order-items', [
            SalesOrderSalesOrderItemsController::class,
            'store',
        ])->name('sales-orders.sales-order-items.store');

        // SalesOrder Invoices
        Route::get('/sales-orders/{salesOrder}/invoices', [
            SalesOrderInvoicesController::class,
            'index',
        ])->name('sales-orders.invoices.index');
        Route::post('/sales-orders/{salesOrder}/invoices', [
            SalesOrderInvoicesController::class,
            'store',
        ])->name('sales-orders.invoices.store');

        // SalesOrder Payments Receiveds
        Route::get('/sales-orders/{salesOrder}/payments-receiveds', [
            SalesOrderPaymentsReceivedsController::class,
            'index',
        ])->name('sales-orders.payments-receiveds.index');
        Route::post('/sales-orders/{salesOrder}/payments-receiveds', [
            SalesOrderPaymentsReceivedsController::class,
            'store',
        ])->name('sales-orders.payments-receiveds.store');

        Route::apiResource('purchase-orders', PurchaseOrderController::class);

        // PurchaseOrder Purchase Order Items
        Route::get('/purchase-orders/{purchaseOrder}/purchase-order-items', [
            PurchaseOrderPurchaseOrderItemsController::class,
            'index',
        ])->name('purchase-orders.purchase-order-items.index');
        Route::post('/purchase-orders/{purchaseOrder}/purchase-order-items', [
            PurchaseOrderPurchaseOrderItemsController::class,
            'store',
        ])->name('purchase-orders.purchase-order-items.store');

        // PurchaseOrder Payment Mades
        Route::get('/purchase-orders/{purchaseOrder}/payment-mades', [
            PurchaseOrderPaymentMadesController::class,
            'index',
        ])->name('purchase-orders.payment-mades.index');
        Route::post('/purchase-orders/{purchaseOrder}/payment-mades', [
            PurchaseOrderPaymentMadesController::class,
            'store',
        ])->name('purchase-orders.payment-mades.store');

        Route::apiResource('invoices', InvoiceController::class);

        // Invoice Payments Receiveds
        Route::get('/invoices/{invoice}/payments-receiveds', [
            InvoicePaymentsReceivedsController::class,
            'index',
        ])->name('invoices.payments-receiveds.index');
        Route::post('/invoices/{invoice}/payments-receiveds', [
            InvoicePaymentsReceivedsController::class,
            'store',
        ])->name('invoices.payments-receiveds.store');

        Route::apiResource('countries', CountryController::class);

        // Country Suppliers
        Route::get('/countries/{country}/suppliers', [
            CountrySuppliersController::class,
            'index',
        ])->name('countries.suppliers.index');
        Route::post('/countries/{country}/suppliers', [
            CountrySuppliersController::class,
            'store',
        ])->name('countries.suppliers.store');

        // Country Cities
        Route::get('/countries/{country}/cities', [
            CountryCitiesController::class,
            'index',
        ])->name('countries.cities.index');
        Route::post('/countries/{country}/cities', [
            CountryCitiesController::class,
            'store',
        ])->name('countries.cities.store');

        // Country Addresses
        Route::get('/countries/{country}/addresses', [
            CountryAddressesController::class,
            'index',
        ])->name('countries.addresses.index');
        Route::post('/countries/{country}/addresses', [
            CountryAddressesController::class,
            'store',
        ])->name('countries.addresses.store');

        // Country Contacts
        Route::get('/countries/{country}/contacts', [
            CountryContactsController::class,
            'index',
        ])->name('countries.contacts.index');
        Route::post('/countries/{country}/contacts', [
            CountryContactsController::class,
            'store',
        ])->name('countries.contacts.store');

        Route::apiResource('payment-mades', PaymentMadeController::class);

        Route::apiResource(
            'payments-receiveds',
            PaymentsReceivedController::class
        );

        Route::apiResource('inventories', InventoryController::class);

        // Inventory Sales Order Items
        Route::get('/inventories/{inventory}/sales-order-items', [
            InventorySalesOrderItemsController::class,
            'index',
        ])->name('inventories.sales-order-items.index');
        Route::post('/inventories/{inventory}/sales-order-items', [
            InventorySalesOrderItemsController::class,
            'store',
        ])->name('inventories.sales-order-items.store');

        // Inventory Purchase Order Items
        Route::get('/inventories/{inventory}/purchase-order-items', [
            InventoryPurchaseOrderItemsController::class,
            'index',
        ])->name('inventories.purchase-order-items.index');
        Route::post('/inventories/{inventory}/purchase-order-items', [
            InventoryPurchaseOrderItemsController::class,
            'store',
        ])->name('inventories.purchase-order-items.store');
    });

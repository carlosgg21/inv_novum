<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://vemto.app/favicon.png" alt="Vemto Logo" class="brand-image bg-white img-circle">
        <span class="brand-text font-weight-light">inNovum</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-apps"></i>
                        <p>
                            Apps
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Setting::class)
                            <li class="nav-item">
                                <a href="{{ route('settings.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\AppDefault::class)
                            <li class="nav-item">
                                <a href="{{ route('app-defaults.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Defaults</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Brand::class)
                            <li class="nav-item">
                                <a href="{{ route('brands.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Brands</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Location::class)
                            <li class="nav-item">
                                <a href="{{ route('locations.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Locations</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Currency::class)
                            <li class="nav-item">
                                <a href="{{ route('currencies.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Currencies</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Category::class)
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\City::class)
                            <li class="nav-item">
                                <a href="{{ route('cities.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Cities</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Charge::class)
                            <li class="nav-item">
                                <a href="{{ route('charges.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Charges</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Condition::class)
                            <li class="nav-item">
                                <a href="{{ route('conditions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Conditions</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\PaymentMethod::class)
                            <li class="nav-item">
                                <a href="{{ route('payment-methods.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Payment Methods</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\PaymentTerm::class)
                            <li class="nav-item">
                                <a href="{{ route('payment-terms.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Payment Terms</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Company::class)
                            <li class="nav-item">
                                <a href="{{ route('companies.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Companies</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Bank::class)
                            <li class="nav-item">
                                <a href="{{ route('banks.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Banks</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Contact::class)
                            <li class="nav-item">
                                <a href="{{ route('contacts.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Contacts</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\BankAccount::class)
                            <li class="nav-item">
                                <a href="{{ route('bank-accounts.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Bank Accounts</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Customer::class)
                            <li class="nav-item">
                                <a href="{{ route('customers.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Customers</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Employee::class)
                            <li class="nav-item">
                                <a href="{{ route('employees.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Employees</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Address::class)
                            <li class="nav-item">
                                <a href="{{ route('addresses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Addresses</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Prefix::class)
                            <li class="nav-item">
                                <a href="{{ route('prefixes.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Prefixes</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Supplier::class)
                            <li class="nav-item">
                                <a href="{{ route('suppliers.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Suppliers</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Township::class)
                            <li class="nav-item">
                                <a href="{{ route('townships.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Townships</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Product::class)
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\SalesOrder::class)
                            <li class="nav-item">
                                <a href="{{ route('sales-orders.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Sales Orders</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\PurchaseOrder::class)
                            <li class="nav-item">
                                <a href="{{ route('purchase-orders.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Purchase Orders</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Invoice::class)
                            <li class="nav-item">
                                <a href="{{ route('invoices.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Invoices</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Country::class)
                            <li class="nav-item">
                                <a href="{{ route('countries.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Countries</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\PaymentMade::class)
                            <li class="nav-item">
                                <a href="{{ route('payment-mades.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Payment Mades</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\PaymentsReceived::class)
                            <li class="nav-item">
                                <a href="{{ route('payments-receiveds.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Payments Receiveds</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Inventory::class)
                            <li class="nav-item">
                                <a href="{{ route('inventories.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Inventories</p>
                                </a>
                            </li>
                            @endcan
                    </ul>
                </li>

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            Access Management
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endauth

                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1//index.html" target="_blank" class="nav-link">
                        <i class="nav-icon icon ion-md-help-circle-outline"></i>
                        <p>Docs</p>
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="index.html" aria-expanded="false"><i
                            class="icon-speedometer">
                        </i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="index.html" aria-expanded="false">
                        <i class="fas fa-dolly"></i><span class="hide-menu">Purchase Orders</span>
                        {{-- <i class="ti-truck"></i><span class="hide-menu">Purchase Orders</span> --}}
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="index.html" aria-expanded="false"><i
                            class="ti-shopping-cart">
                            {{-- class=" ti-shopping-cart-full"> --}}
                        </i><span class="hide-menu">Sale Orders</span>
                    </a>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            {{-- class=" fas fa-dolly-flatbed"></i><span class="hide-menu">Inventory Manager </span></a> --}}
                            class="ti-dropbox"></i><span class="hide-menu">Inventory Manager </span></a>
                    <!-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Inventory Manager </span></a> -->
                    <ul aria-expanded="false" class="collapse">
                        @can('view-any', App\Models\Product::class)
                            <li><a href="{{ route('products.index') }}">Products </a></li>
                        @endcan
                        @can('view-any', App\Models\Inventory::class)
                             <li><a href="{{ route('inventories.index') }}">Inventory</a></li>
                        @endcan
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            {{-- class="ti-credit-card"></i><span class="hide-menu">Accounting</span></a> --}}
                            class="fas fa-donate"></i><span class="hide-menu">Accounting</span></a>
{{--                            class="ti-wallet"></i><span class="hide-menu">Accounting</span></a>--}}
                    <!-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-bookmark-alt"></i><span class="hide-menu">Accounting</span></a> -->
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">Payment In</a></li>
                        <li><a href="app-chat.html">Payment Out</a></li>
                        @can('view-any', App\Models\Invoice::class)
                            <li><a href="{{ route('invoices.index') }}">Invoice</a></li>
                        @endcan
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-stack-overflow"></i><span class="hide-menu">Manager System</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @can('view-any', App\Models\Customer::class)
                             <li><a href="{{ route('customers.index') }}">Customers</a></li>
                        @endcan
                        @can('view-any', App\Models\Supplier::class)
                            <li><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
                        @endcan
                        @can('view-any', App\Models\Employee::class)
                         <li><a href="{{ route('employees.index') }}">Employees</a></li>
                        @endcan
                        <li class="nav-small-cap">LISTS</li>
                        @can('view-any', App\Models\Brand::class)
                            <li><a href="{{ route('brands.index') }}" >Brands</a></li>
                        @endcan
                        @can('view-any', App\Models\Category::class)
                            <li><a href="{{ route('categories.index') }}">Product Categories</a></li>
                        @endcan
                        @can('view-any', App\Models\Charge::class)
                            <li><a href="{{ route('charges.index') }}">Charges</a></li>
                        @endcan
                        @can('view-any', App\Models\Location::class)
                        <li><a href="{{ route('locations.index') }}">Locations</a></li>
                        @endcan
                        @can('view-any', App\Models\Country::class)
                            <li><a href="{{ route('countries.index') }}">Countries</a></li>
                        @endcan
                        @can('view-any', App\Models\City::class)
                            <li><a href="{{ route('cities.index') }}">Cities</a></li>
                        @endcan
                        @can('view-any', App\Models\Township::class)
                            <li><a href="{{ route('townships.index') }}">Townships</a></li>
                        @endcan
                        @can('view-any', App\Models\Currency::class)
                            <li><a href="{{ route('currencies.index') }}">Currencies</a></li>
                        @endcan
                        @can('view-any', App\Models\PaymentTerm::class)
                            <li><a href="{{ route('payment-terms.index') }}">Payment Terms</a></li>
                        @endcan
                        @can('view-any', App\Models\PaymentMethod::class)
                            <li><a href="{{ route('payment-methods.index') }}">Payment Methods</a></li>
                        @endcan
                        @can('view-any', App\Models\Bank::class)
                            <li><a href="{{ route('banks.index') }}">Bank</a></li>
                        @endcan
                      @can('view-any', App\Models\AppDefault::class)
                            <li><a href="{{ route('app-defaults.index') }}">Default</a></li>
                        @endcan

                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-lock"></i><span class="hide-menu">Security</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="ui-cards.html">User</a></li>
                        <li><a href="ui-user-card.html">Roles</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-panel"></i><span class="hide-menu">System</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('companies.index') }}"></i>Company</a></li>
                        <li><a href="ui-user-card.html">App Defaults</a></li>
                        <li><a href="ui-user-card.html">Settings</a></li>
                        <li><a href="ui-user-card.html">Prefixes</a></li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Dashboard"></x-breadcrumb>

@endsection
@section('content')

<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
{{-- <div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="icon-screen-desktop"></i></h3>
                            <p class="text-muted">MYNEW CLIENTS</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-primary">23</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="icon-note"></i></h3>
                            <p class="text-muted">NEW PROJECTS</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-cyan">169</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="icon-doc"></i></h3>
                            <p class="text-muted">NEW INVOICES</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-purple">157</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <h3><i class="icon-bag"></i></h3>
                            <p class="text-muted">All PROJECTS</p>
                        </div>
                        <div class="ml-auto">
                            <h2 class="counter text-success">431</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- ============================================================== -->
<!-- End Info box -->
<!-- ============================================================== -->

<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-2">
        <div class="card">
            <div class="box bg-megna text-center">
                <h1 class="font-light text-white">{{ $productData['product_total'] }}</h1>
                <h6 class="text-white">Products</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-2">
        <div class="card">
            <div class="box bg-primary text-center">
                <h1 class="font-light text-white">{{ $productData['product_aviable'] }}</h1>
                <h6 class="text-white">Products Aviable</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-2">
        <div class="card">
            <div class="box bg-info text-center">
                <h1 class="font-light text-white">{{ format_money($productData['inventory_value']) }}</h1>
                <h6 class="text-white">Inventory Value</h6>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>

                        <h6 class="card-subtitle">Product Below Min Qty </h6>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-hover no-wrap table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">
                
                                </th>
                                <th class="text-left">
                                    Product
                                </th>
                                <th class="text-center">
                                    Min Stock
                                </th>
                                <th>In Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productData['product_below_min_qty'] as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="text-muted"><small>{{ $item->code }}</small></span>
                
                                    {{ $item->name }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-dark">{{ $item->min_qty }}</span>
                                </td>
                                <td class="text-center text-danger">
                
                                    {{ $item->qty }} <i class="fas fa-caret-down"></i>
                                </td>
                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         



        </div>

    </div>
    <div class="col-lg-3 col-md-6">
    </div>
</div>
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ORDER RECEIVED</h4>
                <div class="text-right"> <span class="text-muted">Todays Order</span>
                    <h1 class="font-light"><sup><i class="ti-arrow-up text-success"></i></sup> 12,000</h1>
                </div>
                <span class="text-success">20%</span>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 20%; height: 6px;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TAX DEDUCATION</h4>
                <div class="text-right"> <span class="text-muted">Monthly Deduction</span>
                    <h1 class="font-light"><sup><i class="ti-arrow-up text-primary"></i></sup> $5,000</h1>
                </div>
                <span class="text-primary">30%</span>
                <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 30%; height: 6px;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">REVENUE STATS</h4>
                <div class="text-right"> <span class="text-muted">Todays Income</span>
                    <h1 class="font-light"><sup><i class="ti-arrow-down text-info"></i></sup> $8,000</h1>
                </div>
                <span class="text-info">60%</span>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%; height: 6px;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">YEARLY SALES</h4>
                <div class="text-right"> <span class="text-muted">Yearly Income</span>
                    <h1 class="font-light"><sup><i class="ti-arrow-up text-inverse"></i></sup> $12,000</h1>
                </div>
                <span class="text-inverse">80%</span>
                <div class="progress">
                    <div class="progress-bar bg-inverse" role="progressbar" style="width: 80%; height: 6px;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-40 align-items-center no-block">
                    <h5 class="card-title ">YEARLY SALES</h5>
                    <div class="ml-auto">
                        <ul class="list-inline font-12">
                            <li><i class="fa fa-circle text-cyan"></i> Iphone</li>
                            <li><i class="fa fa-circle text-primary"></i> Ipad</li>
                            <li><i class="fa fa-circle text-purple"></i> Ipod</li>
                        </ul>
                    </div>
                </div>
                <div id="morris-area-chart" style="height: 340px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">FEEDS</h5>
                <ul class="feeds mt-3">
                    <li>
                        <div class="bg-info"><i class="far fa-bell"></i></div> You have 4 pending tasks. <span
                            class="text-muted ml-auto">Just Now</span>
                    </li>
                    <li>
                        <div class="bg-success"><i class="ti-server"></i></div> Server #1 overloaded.<span
                            class="text-muted ml-auto">2 Hours ago</span>
                    </li>
                    <li>
                        <div class="bg-warning"><i class="ti-shopping-cart"></i></div> New order received.<span
                            class="text-muted ml-auto">31 May</span>
                    </li>
                    <li>
                        <div class="bg-danger"><i class="ti-user"></i></div> New user registered.<span
                            class="text-muted ml-auto">30 May</span>
                    </li>
                    <li>
                        <div class="bg-dark"><i class="far fa-bell"></i></div> New Version just arrived. <span
                            class="text-muted ml-auto">27 May</span>
                    </li>
                    <li>
                        <div class="bg-info"><i class="far fa-bell"></i></div> You have 4 pending tasks. <span
                            class="text-muted ml-auto">Just Now</span>
                    </li>
                    <li class="py-1">
                        <div class="bg-danger"><i class="ti-user"></i></div> New user registered.<span
                            class="text-muted ml-auto">30 May</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Column -->

@endsection
@section('css')

<link href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/pages/dashboard1.css') }}" rel="stylesheet">

@endsection

@section('js')

<script src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('assets/node_modules/morrisjs/morris.min.js') }}"></script>

<script src="{{ asset('assets/dist/js/dashboard1.js') }}"></script>
<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>

@endsection
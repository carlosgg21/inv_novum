@extends('layouts.app')
@section('title', 'Products')
@section('page-title', 'Products List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Products List"></x-breadcrumb>
<x-new-record route="products.create"></x-new-record>
@endsection

@section('content')

<div class="searchbar mt-0 mb-4">
    <div class="row">
        <x-table-bar :search="$search">
            <a href="{{ route('products.index') }}" type="button" class="btn btn-primary btn-sm">
                Clear Search
            </a>

        </x-table-bar>
        <div class="col-sm-6 mt-0 mb-4">
            <div class="float-right">
                <div class="dropdown ">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <span class="fas fa-file-alt"></span> Reports
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('reports.products', ['stock' => 1]) }}"
                            target="_blank">Products With Stok</a>
                        <a class="dropdown-item" href="{{ route('reports.products', ['stock' => 0]) }}"
                            target="_blank">Products Out Of Stock</a>
                        <a class="dropdown-item" href="{{ route('reports.products') }}" target="_blank">Products
                            List</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
     

        <div class="table-responsive">
            <table class="table table-borderless table-hover table-sm table-striped">
                <thead class="table-heard">
                    <tr>
                        <th class="text-left">
                            @lang('crud.products.inputs.code')
                        </th>
                        <th class="text-left">
                            @lang('crud.products.inputs.name')
                        </th>

                        <th class="text-center">
                            Stock
                        </th>
                        {{-- <th class="text-left">
                            @lang('crud.products.inputs.category_id')
                        </th> --}}



                        {{-- <th class="text-left">
                            @lang('crud.products.inputs.description')
                        </th> --}}
                        <th class="text-left">
                            @lang('crud.products.inputs.unit')
                        </th>
                        <th class="text-right">
                            @lang('crud.products.inputs.unit_price')
                        </th>
                        <th class="text-right">
                            @lang('crud.products.inputs.cost_price')
                        </th>

                        <th class="text-center">
                            Average Margin
                        </th>
                        <th class="text-center">
                           Stock Limits
                             {{-- Limites de stock --}}
                        </th>
                        <th class="text-center">
                            @lang('crud.common.actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>


                        <td>{{ $product->code ?? '-' }}</td>


                        <td>
                            {{-- <span class="text-muted"><small> {{ $product->category->name }} </small></span><br>
                            <span class="font-weight-bold"> {{ $product->name ?? '-' }}</span><br>
                            <span class="text-primary"> {{ $product->brand?->name }}</span> --}}


                            <span class="font-weight-bold"> {{ $product->name ?? '-' }}</span><br>
                            <span class="text-muted"><small> {{ $product->category->name }} </small></span> <span
                                class="text-primary"> {{ $product->brand?->name }}</span>

                        </td>
                        <td class="text-center font-weight-bold"> {{ $product->qty ?? 0 }}<br>
                            {{-- <span class="text-muted"><small> {{ $product->min_qty ?? 0 }} - {{
                                    $product->max_qty ?? 0 }} </small></span> --}}

                        </td>

                        <td>
                            {{ $product->unit->name ?? '-' }}<br>
                            <span class="text-muted"><small> {{ $product->size ?? '-' }}</small></span>


                        </td>
                        <td class="text-right">{{ $product->unit_price ? format_money($product->unit_price):
                            '0.00'}}</td>
                        <td class="text-right">{{ $product->cost_price ? format_money($product->cost_price):
                            '0.00'}}</td>

                        <td class="text-center {{ $product->average_margin < 10 ? 'text-danger' : '' }}">
                            {{ $product->average_margin != 0 ? format_percentage($product->average_margin) : '-' }}
                        </td>
                        <td>                           
                           @if(!empty($product->min_qty))
                                <span class="badge badge-warning">{{ $product->min_qty }}</span>                           
                           @endif
                           @if(!empty($product->max_qty))
                              <span class="badge badge-info">{{ $product->max_qty }}</span>
                           @endif                         
                        </td>

                        <x-action-buttons :model="$product" routePrefix="products" />
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13">
                            @lang('crud.common.no_items_found')
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td class="pagination-sm" colspan="13">{!! $products->render() !!}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')
@section('title', 'Products')
@section('page-title', 'Products List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Products List"></x-breadcrumb>
<x-new-record route="products.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('products.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.products.index_title')</h4>
            </div>

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

                            <td>{{ $product->unit ?? '-' }}<br>
                                <span class="text-muted"><small> {{ $product->size ?? '-' }}</small></span>


                            </td>
                            <td class="text-right">{{ $product->unit_price ? format_money($product->unit_price): '0.00'}}</td>
                            <td class="text-right">{{ $product->cost_price ? format_money($product->cost_price): '0.00'}}</td>
                         
                                <td class=" text-center {{ $product->average_margin < 10 ? 'text-danger' : '' }}">
                                    {{ $product->average_margin != 0 ? format_percentage($product->average_margin) : '-' }}
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
</div>
@endsection
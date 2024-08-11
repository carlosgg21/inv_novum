@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Show Product')
@section('breadcrumb')
<x-breadcrumb route="products.index" home="Products List" title="Show Product"></x-breadcrumb>
@endsection

@section('content')
<div class="card">
    <div class="card-body">


        <div class="col-sm-12">
            <h4 class="box-title m-t-5"><small>{{ $product->code }}</small> <br>{{ $product->name }} </h4>
            <h6 class="box-title">{{ $product->brand?->name }} <small><span class="badge badge-pill badge-dark">{{
                        $product->category?->name }}</span></small></h6>


            <h5 class="box-title m-t-15">Product description</h5>
            <p>{{ $product->description }}</p>

            <div class="row">
                <div class="col-12  m-t-30">
                 
                    <h1 class="text-info">{{ $product->qty }} <small>IN STOCK</small></h1>
                    <p class="text-muted"> {{ $product->unit->name ?? '-'
                            }} {{ $product->size ?? '-' }}</p>
                </div>
            </div>

            <div class="row">
              
                <div class="col-md-3 col-sm-12 ">
                    <h2 class="card-title">{{ $product->unit_price ? format_money($product->unit_price) : '0.00' }}</h2>
                    <p class="card-text">@lang('crud.products.inputs.unit_price')</p>
                </div>
                <div class="col-md-3 col-sm-12 ">
                    <h2 class="card-title">{{ $product->cost_price ? format_money($product->cost_price) : '0.00' }}</h2>
                    <p class="card-text">@lang('crud.products.inputs.cost_price')</p>
                </div>
                <div class="col-md-2 col-sm-12 ">
                    <h2 class="card-title {{ $product->average_margin < 10 ? 'text-danger' : 'text-success' }}">
                        {{ $product->average_margin != 0 ? format_percentage($product->average_margin) : '-' }}
                    </h2>
                    <p class="card-text">Average Margin</p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h2 class="card-title">
                        @if(!empty($product->min_qty ))
                        <i class="fas fa-arrow-circle-down text-warning"></i> {{ $product->min_qty }}
                        @endif
                        @if(!empty($product->max_qty))
                        <i class="fas fa-arrow-circle-up text-info ml-2"></i> {{ $product->max_qty }}
                        @endif
                    </h2>
                    @if(!empty($product->min_qty ) || !empty($product->max_qty))
                        <p class="card-text">Stock Limits</p>
                    @endif
                </div>
            </div>

        </div>

{{--    
        <h3 class="box-title m-t-40">Key Highlights</h3>
        <ul class="list-unstyled">
            <li><i class="fa fa-check text-success"></i> Sturdy structure</li>
            <li><i class="fa fa-check text-success"></i> Designed to foster easy portability</li>
            <li><i class="fa fa-check text-success"></i> Perfect furniture to flaunt your wonderful collectibles
            </li>
        </ul> --}}
    </div>


</div>
</div>


@endsection
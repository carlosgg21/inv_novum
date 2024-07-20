@extends('layouts.app')
@section('title', 'Sale Order')
@section('page-title', 'Sale Order')
@section('breadcrumb')
<x-breadcrumb route="sales-orders.index" home="Sales Orders" title="Sale Order Details"></x-breadcrumb>
@endsection

@section('content')
<h4 class="card-title">
    Number<br>
    <span>{{ $salesOrder->full_number ?? '-' }}</span>
</h4>

<div class="row">
        <div class="col">        
    
            <div class="ribbon-wrapper card">
                <div class="ribbon ribbon-default">Sales Order</div>
                 Order Date
                <span>{{ $salesOrder->order_date ? format_date($salesOrder->order_date, 'd/m/y') : '-' }}</span>
            </div>
    
        </div>
        <div class="col">
           <div class="ribbon-wrapper card">
                <div class="ribbon ribbon-default">Customer</div>
              @lang('crud.sales_orders.inputs.customer_id')
             <span>{{ optional($salesOrder->customer)->name ?? '-'}}</span>
             Contact
            <span>{{ $defaultContact->full_name }}</span>
            </div>
        </div>
        <div class="col">
            <h4>Payment</h4>
        </div>
    
    </div>
<div class="card">
    <div class="card-body">
      


  
        <div class="mt-4">
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.number')</h5>
                <span>{{ $salesOrder->number ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.order_date')</h5>
                <span>{{ $salesOrder->order_date ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.customer_id')</h5>
                <span>{{ optional($salesOrder->customer)->name ?? '-'}}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.status')</h5>
                <span>{{ $salesOrder->status ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.prefix')</h5>
                <span>{{ $salesOrder->prefix ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.invoice_date')</h5>
                <span>{{ $salesOrder->invoice_date ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.taxes')</h5>
                <span>{{ $salesOrder->taxes ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.discount')</h5>
                <span>{{ $salesOrder->discount ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.miscellaneous')</h5>
                <span>{{ $salesOrder->miscellaneous ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.freight')</h5>
                <span>{{ $salesOrder->freight ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.order_total')</h5>
                <span>{{ $salesOrder->order_total ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.sold_by')</h5>
                <span>{{ optional($salesOrder->soldBy)->name ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.payment_method_id')</h5>
                <span>{{ optional($salesOrder->paymentMethod)->name ?? '-'
                    }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.payment_term_id')</h5>
                <span>{{ optional($salesOrder->paymentTerm)->description ??
                    '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.notes')</h5>
                <span>{{ $salesOrder->notes ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.internal_notes')</h5>
                <span>{{ $salesOrder->internal_notes ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5>@lang('crud.sales_orders.inputs.approved_by')</h5>
                <span>{{ $salesOrder->approved_by ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('sales-orders.index') }}" class="btn btn-light">
                <i class="icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\SalesOrder::class)
            <a href="{{ route('sales-orders.create') }}" class="btn btn-light">
                <i class="icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@can('view-any', App\Models\SalesOrderItem::class)
<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title w-100 mb-2">Sales Order Items</h4>

        <livewire:sales-order-sales-order-items-detail :salesOrder="$salesOrder" />
    </div>
</div>
@endcan
@endsection
@section('css')
<link href="{{ asset('assets/dist/css/pages/ribbon-page.css') }}" rel="stylesheet">
@endsection

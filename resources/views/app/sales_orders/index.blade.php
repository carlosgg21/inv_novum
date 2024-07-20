@extends('layouts.app')
@section('title', 'Sale Orders')
@section('page-title', 'Sale Orders')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Sale Orders"></x-breadcrumb>
@can('create', App\Models\SalesOrder::class)
<x-new-record route="sales-orders.create"></x-new-record>
@endcan
@endsection

@section('content')
<div class="container">
<x-searchbar :search="$search">
        <a href="{{ route('sales-orders.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-borderless table-hover table-sm table-striped">
                    <thead class="table-heard">
                        <tr>
                            <th class="text-left" >
                                @lang('crud.sales_orders.inputs.number')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.order_date')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.customer_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.sales_orders.inputs.status')
                            </th>
                         
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.invoice_date')
                            </th>
                     
                            <th class="text-right">
                                @lang('crud.sales_orders.inputs.order_total')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.sold_by')
                            </th>
                            {{-- <th class="text-left">
                                @lang('crud.sales_orders.inputs.payment_method_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.payment_term_id')
                            </th> --}}
                      
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salesOrders as $salesOrder)
                        <tr>
                            <td>{{ $salesOrder->full_number ?? '-' }}</td>
                            <td>{{ $salesOrder->order_date ? format_date($salesOrder->order_date , 'd/m/Y') : '-' }}</td>
                            <td>
                                {{ optional($salesOrder->customer)->name ?? '-' }}
                            </td>
                            {{-- <td>{{ $salesOrder->status ?? '-' }}</td> --}}
               <td style="text-align: center; vertical-align: middle;">
                <span class="badge {{ $salesOrder->status == "entered" ? 'badge-primary badge-pill' : 'badge-dark badge-pill' }}">
                    {{ $salesOrder->status == "entered" ? "Entered" : "Not Entered"}}
                </span>
            </td>
                
                            <td>{{ $salesOrder->invoice_date ? format_date($salesOrder->invoice_date , 'd/m/Y') : '-' }}</td>
                        
                            <td class="text-right">
                          
                            {{ $salesOrder->order_total ? format_money($salesOrder->order_total, 'CUP') : '-' }}
                        </td>
                            <td>
                                {{ optional($salesOrder->soldBy)->name ?? '-' }}
                            </td>
                            {{-- <td>
                                {{ optional($salesOrder->paymentMethod)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{
                                optional($salesOrder->paymentTerm)->description
                                ?? '-' }} --}}
                            </td>
                            {{-- <td>{{ $salesOrder->notes ?? '-' }}</td>
                            <td>{{ $salesOrder->internal_notes ?? '-' }}</td>
                            <td>{{ $salesOrder->approved_by ?? '-' }}</td> --}}
                            <x-action-buttons :model="$salesOrder" routePrefix="sales-orders" module="sales-order" />
                           
                        </tr>
                        @empty
                        <tr>
                            <td colspan="18">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="18">{!! $salesOrders->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
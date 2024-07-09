@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('sales-orders.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.sales_orders.show_title')
            </h4>

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
                    <span
                        >{{ optional($salesOrder->customer)->name ?? '-'
                        }}</span
                    >
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
                    <span
                        >{{ optional($salesOrder->soldBy)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.sales_orders.inputs.payment_method_id')</h5>
                    <span
                        >{{ optional($salesOrder->paymentMethod)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.sales_orders.inputs.payment_term_id')</h5>
                    <span
                        >{{ optional($salesOrder->paymentTerm)->description ??
                        '-' }}</span
                    >
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
                <a
                    href="{{ route('sales-orders.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\SalesOrder::class)
                <a
                    href="{{ route('sales-orders.create') }}"
                    class="btn btn-light"
                >
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

            <livewire:sales-order-sales-order-items-detail
                :salesOrder="$salesOrder"
            />
        </div>
    </div>
    @endcan
</div>
@endsection

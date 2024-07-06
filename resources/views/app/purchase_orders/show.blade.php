@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('purchase-orders.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.purchase_orders.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.supplier_id')</h5>
                    <span
                        >{{ optional($purchaseOrder->supplier)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.number')</h5>
                    <span>{{ $purchaseOrder->number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.order_date')</h5>
                    <span>{{ $purchaseOrder->order_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.total_amount')</h5>
                    <span>{{ $purchaseOrder->total_amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.status')</h5>
                    <span>{{ $purchaseOrder->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.taxes')</h5>
                    <span>{{ $purchaseOrder->taxes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.discount')</h5>
                    <span>{{ $purchaseOrder->discount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.miscellaneus')</h5>
                    <span>{{ $purchaseOrder->miscellaneus ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.shipping_date')</h5>
                    <span>{{ $purchaseOrder->shipping_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.purchase_orders.inputs.shippin_tracking_number')
                    </h5>
                    <span
                        >{{ $purchaseOrder->shippin_tracking_number ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.shipping_cost')</h5>
                    <span>{{ $purchaseOrder->shipping_cost ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.received_date')</h5>
                    <span>{{ $purchaseOrder->received_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.purchase_orders.inputs.payment_method_id')
                    </h5>
                    <span
                        >{{ optional($purchaseOrder->paymentMethod)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.purchase_orders.inputs.payment_term_id')
                    </h5>
                    <span
                        >{{ optional($purchaseOrder->paymentTerm)->description
                        ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.condition_id')</h5>
                    <span
                        >{{ optional($purchaseOrder->condition)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.purchase_orders.inputs.billable')</h5>
                    <span>{{ $purchaseOrder->billable ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('purchase-orders.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\PurchaseOrder::class)
                <a
                    href="{{ route('purchase-orders.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\PurchaseOrderItem::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Purchase Order Items</h4>

            <livewire:purchase-order-purchase-order-items-detail
                :purchaseOrder="$purchaseOrder"
            />
        </div>
    </div>
    @endcan
</div>
@endsection

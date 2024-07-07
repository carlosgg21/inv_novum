@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\PurchaseOrder::class)
                <a
                    href="{{ route('purchase-orders.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.purchase_orders.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.supplier_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.number')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.order_date')
                            </th>
                            <th class="text-right">
                                @lang('crud.purchase_orders.inputs.total_amount')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.status')
                            </th>
                            <th class="text-right">
                                @lang('crud.purchase_orders.inputs.taxes')
                            </th>
                            <th class="text-right">
                                @lang('crud.purchase_orders.inputs.discount')
                            </th>
                            <th class="text-right">
                                @lang('crud.purchase_orders.inputs.miscellaneous')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.shipping_date')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.shippin_tracking_number')
                            </th>
                            <th class="text-right">
                                @lang('crud.purchase_orders.inputs.shipping_cost')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.received_date')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.payment_method_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.payment_term_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.condition_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.purchase_orders.inputs.billable')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchaseOrders as $purchaseOrder)
                        <tr>
                            <td>
                                {{ optional($purchaseOrder->supplier)->name ??
                                '-' }}
                            </td>
                            <td>{{ $purchaseOrder->number ?? '-' }}</td>
                            <td>{{ $purchaseOrder->order_date ?? '-' }}</td>
                            <td>{{ $purchaseOrder->total_amount ?? '-' }}</td>
                            <td>{{ $purchaseOrder->status ?? '-' }}</td>
                            <td>{{ $purchaseOrder->taxes ?? '-' }}</td>
                            <td>{{ $purchaseOrder->discount ?? '-' }}</td>
                            <td>{{ $purchaseOrder->miscellaneous ?? '-' }}</td>
                            <td>{{ $purchaseOrder->shipping_date ?? '-' }}</td>
                            <td>
                                {{ $purchaseOrder->shippin_tracking_number ??
                                '-' }}
                            </td>
                            <td>{{ $purchaseOrder->shipping_cost ?? '-' }}</td>
                            <td>{{ $purchaseOrder->received_date ?? '-' }}</td>
                            <td>
                                {{ optional($purchaseOrder->paymentMethod)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($purchaseOrder->paymentTerm)->description
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($purchaseOrder->condition)->name ??
                                '-' }}
                            </td>
                            <td>{{ $purchaseOrder->billable ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $purchaseOrder)
                                    <a
                                        href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $purchaseOrder)
                                    <a
                                        href="{{ route('purchase-orders.show', $purchaseOrder) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $purchaseOrder)
                                    <form
                                        action="{{ route('purchase-orders.destroy', $purchaseOrder) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="17">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="17">
                                {!! $purchaseOrders->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

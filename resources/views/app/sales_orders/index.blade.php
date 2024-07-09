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
                @can('create', App\Models\SalesOrder::class)
                <a
                    href="{{ route('sales-orders.create') }}"
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
                    @lang('crud.sales_orders.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.number')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.order_date')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.customer_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.status')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.prefix')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.invoice_date')
                            </th>
                            <th class="text-right">
                                @lang('crud.sales_orders.inputs.taxes')
                            </th>
                            <th class="text-right">
                                @lang('crud.sales_orders.inputs.discount')
                            </th>
                            <th class="text-right">
                                @lang('crud.sales_orders.inputs.miscellaneous')
                            </th>
                            <th class="text-right">
                                @lang('crud.sales_orders.inputs.freight')
                            </th>
                            <th class="text-right">
                                @lang('crud.sales_orders.inputs.order_total')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.sold_by')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.payment_method_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.payment_term_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.notes')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.internal_notes')
                            </th>
                            <th class="text-left">
                                @lang('crud.sales_orders.inputs.approved_by')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($salesOrders as $salesOrder)
                        <tr>
                            <td>{{ $salesOrder->number ?? '-' }}</td>
                            <td>{{ $salesOrder->order_date ?? '-' }}</td>
                            <td>
                                {{ optional($salesOrder->customer)->name ?? '-'
                                }}
                            </td>
                            <td>{{ $salesOrder->status ?? '-' }}</td>
                            <td>{{ $salesOrder->prefix ?? '-' }}</td>
                            <td>{{ $salesOrder->invoice_date ?? '-' }}</td>
                            <td>{{ $salesOrder->taxes ?? '-' }}</td>
                            <td>{{ $salesOrder->discount ?? '-' }}</td>
                            <td>{{ $salesOrder->miscellaneous ?? '-' }}</td>
                            <td>{{ $salesOrder->freight ?? '-' }}</td>
                            <td>{{ $salesOrder->order_total ?? '-' }}</td>
                            <td>
                                {{ optional($salesOrder->soldBy)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($salesOrder->paymentMethod)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{
                                optional($salesOrder->paymentTerm)->description
                                ?? '-' }}
                            </td>
                            <td>{{ $salesOrder->notes ?? '-' }}</td>
                            <td>{{ $salesOrder->internal_notes ?? '-' }}</td>
                            <td>{{ $salesOrder->approved_by ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $salesOrder)
                                    <a
                                        href="{{ route('sales-orders.edit', $salesOrder) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $salesOrder)
                                    <a
                                        href="{{ route('sales-orders.show', $salesOrder) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $salesOrder)
                                    <form
                                        action="{{ route('sales-orders.destroy', $salesOrder) }}"
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

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
                @can('create', App\Models\PaymentsReceived::class)
                <a
                    href="{{ route('payments-receiveds.create') }}"
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
                    @lang('crud.payments_receiveds.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.payments_receiveds.inputs.amount')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.payment_method_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.payment_term_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.invoice_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.sales_order_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.date')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.notes')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.customer_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.payments_receiveds.inputs.received_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentsReceiveds as $paymentsReceived)
                        <tr>
                            <td>{{ $paymentsReceived->amount ?? '-' }}</td>
                            <td>
                                {{
                                optional($paymentsReceived->paymentMethod)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($paymentsReceived->paymentTerm)->description
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($paymentsReceived->invoice)->number
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($paymentsReceived->salesOrder)->number
                                ?? '-' }}
                            </td>
                            <td>{{ $paymentsReceived->date ?? '-' }}</td>
                            <td>{{ $paymentsReceived->notes ?? '-' }}</td>
                            <td>
                                {{ optional($paymentsReceived->customer)->name
                                ?? '-' }}
                            </td>
                            <td>
                                {{ optional($paymentsReceived->employee)->name
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $paymentsReceived)
                                    <a
                                        href="{{ route('payments-receiveds.edit', $paymentsReceived) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $paymentsReceived)
                                    <a
                                        href="{{ route('payments-receiveds.show', $paymentsReceived) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $paymentsReceived)
                                    <form
                                        action="{{ route('payments-receiveds.destroy', $paymentsReceived) }}"
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
                            <td colspan="10">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                {!! $paymentsReceiveds->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

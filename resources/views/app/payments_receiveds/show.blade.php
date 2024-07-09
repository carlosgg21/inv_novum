@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('payments-receiveds.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.payments_receiveds.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.payments_receiveds.inputs.amount')</h5>
                    <span>{{ $paymentsReceived->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.payments_receiveds.inputs.payment_method_id')
                    </h5>
                    <span
                        >{{ optional($paymentsReceived->paymentMethod)->name ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.payments_receiveds.inputs.payment_term_id')
                    </h5>
                    <span
                        >{{
                        optional($paymentsReceived->paymentTerm)->description ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payments_receiveds.inputs.invoice_id')</h5>
                    <span
                        >{{ optional($paymentsReceived->invoice)->number ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.payments_receiveds.inputs.sales_order_id')
                    </h5>
                    <span
                        >{{ optional($paymentsReceived->salesOrder)->number ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payments_receiveds.inputs.date')</h5>
                    <span>{{ $paymentsReceived->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payments_receiveds.inputs.notes')</h5>
                    <span>{{ $paymentsReceived->notes ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payments_receiveds.inputs.customer_id')</h5>
                    <span
                        >{{ optional($paymentsReceived->customer)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payments_receiveds.inputs.received_id')</h5>
                    <span
                        >{{ optional($paymentsReceived->employee)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('payments-receiveds.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\PaymentsReceived::class)
                <a
                    href="{{ route('payments-receiveds.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

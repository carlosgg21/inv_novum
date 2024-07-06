@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('payment-mades.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.payment_mades.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.supplier_id')</h5>
                    <span
                        >{{ optional($paymentMade->supplier)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.payment_mades.inputs.payment_method_id')
                    </h5>
                    <span
                        >{{ optional($paymentMade->paymentMethod)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.payment_term_id')</h5>
                    <span
                        >{{ optional($paymentMade->paymentTerm)->description ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.amount')</h5>
                    <span>{{ $paymentMade->amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.reference_number')</h5>
                    <span>{{ $paymentMade->reference_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.date')</h5>
                    <span>{{ $paymentMade->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.payment_mades.inputs.purchase_order_id')
                    </h5>
                    <span
                        >{{ optional($paymentMade->purchaseOrder)->number ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.created_by')</h5>
                    <span
                        >{{ optional($paymentMade->employee)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_mades.inputs.aproved_by')</h5>
                    <span>{{ $paymentMade->aproved_by ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('payment-mades.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\PaymentMade::class)
                <a
                    href="{{ route('payment-mades.create') }}"
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

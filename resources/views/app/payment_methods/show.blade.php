@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('payment-methods.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.payment_methods.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.payment_methods.inputs.code')</h5>
                    <span>{{ $paymentMethod->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_methods.inputs.name')</h5>
                    <span>{{ $paymentMethod->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.payment_methods.inputs.description')</h5>
                    <span>{{ $paymentMethod->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('payment-methods.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\PaymentMethod::class)
                <a
                    href="{{ route('payment-methods.create') }}"
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

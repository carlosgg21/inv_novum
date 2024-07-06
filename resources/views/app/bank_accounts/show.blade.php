@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('bank-accounts.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.bank_accounts.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.bank_accounts.inputs.number')</h5>
                    <span>{{ $bankAccount->number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.bank_accounts.inputs.bank_id')</h5>
                    <span>{{ optional($bankAccount->bank)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.bank_accounts.inputs.type')</h5>
                    <span>{{ $bankAccount->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.bank_accounts.inputs.currency_id')</h5>
                    <span
                        >{{ optional($bankAccount->currency)->name ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('bank-accounts.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\BankAccount::class)
                <a
                    href="{{ route('bank-accounts.create') }}"
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

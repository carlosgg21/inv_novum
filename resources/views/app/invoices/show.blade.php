@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('invoices.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.invoices.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.sales_order_id')</h5>
                    <span
                        >{{ optional($invoice->salesOrder)->number ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.number')</h5>
                    <span>{{ $invoice->number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.date')</h5>
                    <span>{{ $invoice->date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.status')</h5>
                    <span>{{ $invoice->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.total_amount')</h5>
                    <span>{{ $invoice->total_amount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.employee_id')</h5>
                    <span>{{ optional($invoice->employee)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.currency_id')</h5>
                    <span>{{ optional($invoice->currency)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.year')</h5>
                    <span>{{ $invoice->year ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.mount')</h5>
                    <span>{{ $invoice->mount ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.invoices.inputs.notes')</h5>
                    <span>{{ $invoice->notes ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('invoices.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Invoice::class)
                <a href="{{ route('invoices.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Invoices')
@section('page-title', 'Invoices List')
@section('breadcrumb')
    <x-breadcrumb route="home" home="Home" title="Invoices List"></x-breadcrumb>
    <x-new-record route="invoices.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('invoices.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.number')
                            </th>
                            <th class="text-left">
                               Invoice Date
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.sales_order_id')
                            </th>


                            <th class="text-left">
                                @lang('crud.invoices.inputs.status')
                            </th>
                            <th class="text-right">
                                @lang('crud.invoices.inputs.total_amount')
                            </th>
                            <th class="text-left">
                                @lang('crud.invoices.inputs.employee_id')
                            </th>



                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->_full_number ?? '-' }}</td>
                            <td>{{ $invoice->date ? format_date($invoice->date , 'd/m/Y') : '-'}}</td>
                            <td>
                                {{ optional($invoice->salesOrder)->number ?? '-'
                                }}
                            </td>
                            {{-- <td>{{ $invoice->status ?? '-' }}</td> --}}
                            <x-table-td-invoice-status :status="$invoice->status" />
                            <td>
                                <i class="flag-icon {{ $invoice->currency->flag ?? '-' }}"></i>
                                {{ $invoice->total_amount ? format_money($invoice->total_amount, $invoice->currency->acronym )  : '-' }}
                            </td>
                            <td>
                                {{ optional($invoice->employee)->name ?? '-' }}
                            </td>

                            <x-action-buttons :model="$invoice" routePrefix="invoices" />
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11">{!! $invoices->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')

    <link href="{{ asset('assets/node_modules/flag-icons/css/flag-icons.min.css') }}" rel="stylesheet">

@endsection

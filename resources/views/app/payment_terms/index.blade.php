@extends('layouts.app')
@section('title', 'Payment Terms')
@section('page-title', 'Payment Terms List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Payment Terms List"></x-breadcrumb>
<x-new-record route="payment-terms.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('payment-terms.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">         

            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm table-striped">
                     <thead class="table-heard">
                        <tr>
                            <th class="text-left">
                             Code
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_terms.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.payment_terms.inputs.day')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentTerms as $paymentTerm)
                        <tr>
                            <td class="text-left">{{ $paymentTerm->code ?? '-' }}</td>
                            <td>{{ $paymentTerm->description ?? '-' }}</td>
                            <td class="text-center">{{ $paymentTerm->day ?? '-' }}</td>
                             <x-action-buttons :model="$paymentTerm" routePrefix="payment-terms" />
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pagination-sm" colspan="3">{!! $paymentTerms->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
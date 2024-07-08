@extends('layouts.app')
@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Payment Methods List"></x-breadcrumb>
<x-new-record route="payment-methods.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('payment-methods.index') }}" type="button" class="btn btn-primary btn-sm">
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
                                @lang('crud.payment_methods.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.payment_methods.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentMethods as $paymentMethod)
                        <tr>
                            <td>{{ $paymentMethod->name ?? '-' }}</td>
                            <td>{{ $paymentMethod->description ?? '-' }}</td>
                            <x-action-buttons :model="$paymentMethod" routePrefix="payment-methods" />
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pagination-sm" colspan="4">
                                {!! $paymentMethods->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
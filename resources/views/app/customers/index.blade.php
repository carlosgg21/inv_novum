@extends('layouts.app')
@section('title', 'Customers')
@section('page-title', 'Customers List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Customers List"></x-breadcrumb>
<x-new-record route="customers.create"></x-new-record>
@endsection

@section('content')
    <x-searchbar :search="$search">
        <a href="{{ route('customers.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.customers.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.customers.inputs.phone')
                            </th>
                            <th class="text-left">
                                @lang('crud.customers.inputs.email')
                            </th>
                            {{-- <th class="text-left">
                                @lang('crud.customers.inputs.address')
                            </th> --}}
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name ?? '-' }}</td>
                            <td>{{ $customer->phone ?? '-' }}</td>
                            <td>{{ $customer->email ?? '-' }}</td>
                            {{-- <td>{{ $customer->address ?? '-' }}</td> --}}
                          {{-- <x-action-buttons :model="$customer" routePrefix="customers" /> --}}
                          <x-table-action :model="$customer" routePrefix="customers" />
                        
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{!! $customers->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
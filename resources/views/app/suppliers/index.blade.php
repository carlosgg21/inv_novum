@extends('layouts.app')
@section('title', 'Supliers')
@section('page-title', 'Supliers List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Suppliers List"></x-breadcrumb>
<x-new-record route="suppliers.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('suppliers.index') }}" type="button" class="btn btn-primary btn-sm">
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
                                @lang('crud.suppliers.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.suppliers.inputs.phone')
                            </th>
                            <th class="text-left">
                                @lang('crud.suppliers.inputs.email')
                            </th>
                            {{-- <th class="text-left">
                                @lang('crud.suppliers.inputs.note')
                            </th> --}}
                            {{-- <th class="text-left">
                                @lang('crud.suppliers.inputs.address')
                            </th> --}}
                            <th class="text-left">
                                @lang('crud.suppliers.inputs.country_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                        
                        <tr>
                            <td>{{ $supplier->name ?? '-' }}</td>
                            <td>{{ $supplier->phone ?? '-' }}</td>
                            <td>{{ $supplier->email ?? '-' }}</td>
                            {{-- <td>{{ $supplier->note ?? '-' }}</td> --}}
                            {{-- <td>{{ $supplier->address ?? '-' }}</td> --}}
                            <td>
                                {{ optional($supplier->country)->name ?? '-' }}
                            </td>
                          <x-action-buttons :model="$supplier" routePrefix="suppliers" />
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{!! $suppliers->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
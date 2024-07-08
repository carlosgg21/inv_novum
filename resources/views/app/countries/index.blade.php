@extends('layouts.app')
@section('title', 'Countries Categories')
@section('page-title', 'Countries List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Countries List"></x-breadcrumb>
<x-new-record route="categories.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('countries.index') }}" type="button" class="btn btn-primary btn-sm mr-2">
            Clear Search
        </a>     
    </x-searchbar>


    <div class="card">

        <div class="table-responsive">
            <table class="table table-borderless table-hover table-sm table-striped">
                <thead class="table-heard">
                    <tr>
                        <th class="text-left">
                            @lang('crud.countries.inputs.name')
                        </th>
                        <th class="text-left">
                            @lang('crud.countries.inputs.code')
                        </th>
                        <th class="text-left">
                            @lang('crud.countries.inputs.iso')
                        </th>
                        <th class="text-left">
                           Status
                        </th>
                        <th class="text-left">
                            @lang('crud.countries.inputs.time_zone')
                        </th>

                        <th class="text-left">
                            @lang('crud.countries.inputs.currency_id')
                        </th>
                        <th class="text-center">
                            @lang('crud.common.actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                    <tr>
                        <td>
                            <i class="flag-icon {{ $country->flag ?? '-' }}"></i>
                            {{ $country->name ?? '-' }}

                        </td>
                        <td>{{ $country->code ?? '-' }}</td>
                        <td>{{ $country->iso ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $country->isActive() ? 'badge badge-pill badge-primary' : 'badge badge-pill badge-dark' }}">
                                {{ $country->isActive() ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>{{ $country->time_zone ?? '-' }}</td>

                        <td>
                            {{ optional($country->currency)->name ?? '-' }}
                        </td>
                        <x-action-buttons :model="$country" routePrefix="countries" />
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
                        <td class="pagination-sm" colspan="7">{!! $countries->render() !!}</td>
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
@extends('layouts.app')
@section('title', 'Cities')
@section('page-title', 'Cities List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Cities List"></x-breadcrumb>
<x-new-record route="cities.create"></x-new-record>
@endsection

@section('content')
<div class="container">
<x-searchbar :search="$search">
    <a href="{{ route('cities.index') }}" type="button" class="btn btn-primary btn-sm">
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
                                @lang('crud.cities.inputs.country_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.cities.inputs.code')
                            </th>
                            <th class="text-left">
                                @lang('crud.cities.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.cities.inputs.acronym')
                            </th>
                            <th class="text-left">
                                @lang('crud.cities.inputs.zip_code')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cities as $city)
                        <tr>
                            <td>{{ optional($city->country)->name ?? '-' }}</td>
                            <td>{{ $city->code ?? '-' }}</td>
                            <td>{{ $city->name ?? '-' }}</td>
                            <td>{{ $city->acronym ?? '-' }}</td>
                            <td>{{ $city->zip_code ?? '-' }}</td>
                         <x-action-buttons :model="$city" routePrefix="cities" />
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pagination-sm" colspan="6">{!! $cities->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
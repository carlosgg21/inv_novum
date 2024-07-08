@extends('layouts.app')
@section('title', 'Locations')
@section('page-title', 'Locations List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Locations List"></x-breadcrumb>
<x-new-record route="locations.create"></x-new-record>
@endsection

@section('content')
<x-searchbar :search="$search">
    <a href="{{ route('locations.index') }}" type="button" class="btn btn-primary btn-sm">
        Clear Search
    </a>
</x-searchbar>

<div class="card">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between;">
            <h4 class="card-title">@lang('crud.locations.index_title')</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless table-hover table-sm table-striped">
                <thead class="table-heard">
                    <tr>
                        <th class="text-left">
                            @lang('crud.locations.inputs.name')
                        </th>
                        <th class="text-left">
                            @lang('crud.locations.inputs.description')
                        </th>
                        <th class="text-center">
                            @lang('crud.common.actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                    <tr>
                        <td>{{ $location->name ?? '-' }}</td>
                        <td>{{ $location->description ?? '-' }}</td>
                        <x-action-buttons :model="$location" routePrefix="locations" />
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
                     <td class="pagination-sm" colspan="3">{!! $locations->render() !!}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
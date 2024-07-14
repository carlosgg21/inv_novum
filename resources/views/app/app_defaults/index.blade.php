@extends('layouts.app')
@section('title', 'Defaults')
@section('page-title', 'Defaults List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Defaults List"></x-breadcrumb>
<x-new-record route="app-defaults.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('app-defaults.index') }}" type="button" class="btn btn-primary btn-sm">
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
                                @lang('crud.defaults.inputs.module')
                            </th>
                            <th class="text-left">
                                @lang('crud.defaults.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.defaults.inputs.display_name')
                            </th>
                            <th class="text-left">
                                @lang('crud.defaults.inputs.value')
                            </th>
                            <th class="text-left">
                                @lang('crud.defaults.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appDefaults as $default)
                        <tr>
                            <td>{{ $default->module ?? '-' }}</td>
                            <td>{{ $default->name ?? '-' }}</td>
                            <td>{{ $default->display_name ?? '-' }}</td>
                            <td>{{ $default->value ?? '-' }}</td>
                            <td>{{ $default->description ?? '-' }}</td>
                            <x-action-buttons :model="$default" routePrefix="app-defaults" />
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
                            <td colspan="6">{!! $appDefaults->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Banks')
@section('page-title', 'Banks List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Banks List"></x-breadcrumb>
<x-new-record route="banks.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('banks.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.banks.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm table-striped">
                    <thead class="table-heard">
                        <tr>
                            <th class="text-left">
                                @lang('crud.banks.inputs.logo')
                            </th>
                            <th class="text-left">
                                @lang('crud.banks.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.banks.inputs.acronym')
                            </th>
                            <th class="text-left">
                                @lang('crud.banks.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banks as $bank)
                        <tr>
                            <td>
                                <x-partials.thumbnail src="{{ $bank->logo ? \Storage::url($bank->logo) : '' }}"
                                    alt="{{ $bank->name }}" />
                            </td>
                            <td>{{ $bank->name ?? '-' }}</td>
                            <td>{{ $bank->acronym ?? '-' }}</td>
                            <td>{{ $bank->description ?? '-' }}</td>
                            <x-action-buttons :model="$bank" routePrefix="banks" />
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
                            <td class="pagination-sm" colspan="5">{!! $banks->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Townships')
@section('page-title', 'Townships List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Townships List"></x-breadcrumb>
<x-new-record route="townships.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('charges.index') }}" type="button" class="btn btn-primary btn-sm">
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
                                @lang('crud.townships.inputs.city_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.townships.inputs.code')
                            </th>
                            <th class="text-left">
                                @lang('crud.townships.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.townships.inputs.zip_code')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($townships as $township)
                        <tr>
                            <td>
                                {{ optional($township->city)->name ?? '-' }}
                            </td>
                            <td>{{ $township->code ?? '-' }}</td>
                            <td>{{ $township->name ?? '-' }}</td>
                            <td>{{ $township->zip_code ?? '-' }}</td>
                            <x-action-buttons :model="$township" routePrefix="townships" />
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
                          <td class="pagination-sm" colspan="5">{!! $townships->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

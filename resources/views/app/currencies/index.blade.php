@extends('layouts.app')
@section('title', 'Currencies')
@section('page-title', 'Currencies List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Currencies List"></x-breadcrumb>
<x-new-record route="currencies.create"></x-new-record>
@endsection

@section('content')
<div class="container">
   <x-searchbar :search="$search">
    <a href="{{ route('currencies.index') }}" type="button" class="btn btn-primary btn-sm">
        Clear Search
    </a>
</x-searchbar>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.currencies.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm table-striped">
                        <thead class="table-heard">
                        <tr>
                           
                            <th class="text-left">
                                @lang('crud.currencies.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.currencies.inputs.acronym')
                            </th>
                            <th class="text-left">
                                @lang('crud.currencies.inputs.sign')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($currencies as $currency)
                        <tr>
                            <td>{{ $currency->name ?? '-' }}</td>
                            <td>
                                <i class="flag-icon {{ $currency->flag ?? '-' }}"></i>
                                {{ $currency->acronym ?? '-' }}
                            </td>
                            <td>{{ $currency->sign ?? '-' }}</td>                            
                            <x-action-buttons :model="$currency" routePrefix="currencies" />
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
                            <td class="pagination-sm" colspan="6">{!! $currencies->render() !!}</td>
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
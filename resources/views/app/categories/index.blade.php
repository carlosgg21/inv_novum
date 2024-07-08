@extends('layouts.app')
@section('title', 'Categories')
@section('page-title', 'Categories List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Product Categories List"></x-breadcrumb>
<x-new-record route="categories.create"></x-new-record>
@endsection

@section('content')
<div class="container">

    <x-searchbar :search="$search">
        <a href="{{ route('categories.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.categories.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover table-sm table-striped">
                    <thead class="table-heard">
                        <tr>
                            <th class="text-left">
                                @lang('crud.categories.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.categories.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name ?? '-' }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <x-action-buttons :model="$category" routePrefix="categories" />
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
                            <td class="pagination-sm" colspan="3">{!! $categories->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
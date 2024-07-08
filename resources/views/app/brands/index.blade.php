@extends('layouts.app')
@section('title', 'Brands')
@section('page-title', 'Brands List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Brands List"></x-breadcrumb>
<x-new-record route="brands.create"></x-new-record>
@endsection

@section('content')
<div class="container">
<x-searchbar :search="$search">
  <a href="{{ route('brands.index') }}" type="button" class="btn btn-primary btn-sm">
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
                                @lang('crud.brands.inputs.image')
                            </th>
                            <th class="text-left">
                                @lang('crud.brands.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.brands.inputs.description')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                        <tr>
                            <td>
                                <x-partials.thumbnail src="{{ $brand->image ? \Storage::url($brand->image) : '' }}" />
                            </td>
                            <td>{{ $brand->name ?? '-' }}</td>
                            <td>{{ $brand->description ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div role="group" aria-label="Row Actions" class="btn-group">
                                    @can('update', $brand)
                                    <a href="{{ route('brands.edit', $brand) }}">
                                        <button type="button" class="btn btn-light">
                                       <i class="icon-note"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $brand)
                                    <a href="{{ route('brands.show', $brand) }}">
                                        <button type="button" class="btn btn-light">
                                     <i class="ti-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $brand)
                                    <form action="{{ route('brands.destroy', $brand) }}" method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-light text-danger">
                                         <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pagination-sm" colspan="4">{!! $brands->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
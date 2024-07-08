@extends('layouts.app')
@section('title', 'Products')
@section('page-title', 'Products List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Products List"></x-breadcrumb>
<x-new-record route="products.create"></x-new-record>
@endsection

@section('content')
<div class="container">
   <x-searchbar :search="$search">
    <a href="{{ route('products.index') }}" type="button" class="btn btn-primary btn-sm">
        Clear Search
    </a>
</x-searchbar>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.products.index_title')</h4>
            </div>

            <div class="table-responsive">
               <table class="table table-borderless table-hover table-sm table-striped">
                    <thead class="table-heard">
                        <tr>
                          
                            <th class="text-left">
                                @lang('crud.products.inputs.brand_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.category_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.code')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.supplier_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.description')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.unit')
                            </th>
                            <th class="text-right">
                                @lang('crud.products.inputs.unit_price')
                            </th>
                            <th class="text-right">
                                @lang('crud.products.inputs.cost_price')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.size')
                            </th>
                            <th class="text-left">
                                @lang('crud.products.inputs.notes')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                           
                           
                            <td>{{ $product->code ?? '-' }}</td>
                            <td>
                                {{ optional($product->supplier)->name ?? '-' }}
                            </td>
                            
                            <td>{{ $product->name ?? '-' }}</td>
                            <td>{{ $product->description ?? '-' }}</td>
                            <td>{{ $product->unit ?? '-' }}</td>
                            <td>{{ $product->unit_price ?? '-' }}</td>
                            <td>{{ $product->cost_price ?? '-' }}</td>
                            <td>{{ $product->size ?? '-' }}</td>
                            <td>{{ $product->notes ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div role="group" aria-label="Row Actions" class="btn-group">
                                    @can('update', $product)
                                    <a href="{{ route('products.edit', $product) }}">
                                        <button type="button" class="btn btn-light">
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $product)
                                    <a href="{{ route('products.show', $product) }}">
                                        <button type="button" class="btn btn-light">
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $product)
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-light text-danger">
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pagination-sm" colspan="13">{!! $products->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
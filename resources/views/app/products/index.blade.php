@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Product::class)
                <a
                    href="{{ route('products.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.products.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.products.inputs.image')
                            </th>
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
                            <th class="text-right">
                                @lang('crud.products.inputs.qty_stock')
                            </th>
                            <th class="text-right">
                                @lang('crud.products.inputs.qty_on_order')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $product->image ? \Storage::url($product->image) : '' }}"
                                />
                            </td>
                            <td>
                                {{ optional($product->brand)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($product->category)->name ?? '-' }}
                            </td>
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
                            <td>{{ $product->qty_stock ?? '-' }}</td>
                            <td>{{ $product->qty_on_order ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $product)
                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $product)
                                    <a
                                        href="{{ route('products.show', $product) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $product)
                                    <form
                                        action="{{ route('products.destroy', $product) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="15">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="15">{!! $products->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

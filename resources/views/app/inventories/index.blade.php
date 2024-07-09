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
                @can('create', App\Models\Inventory::class)
                <a
                    href="{{ route('inventories.create') }}"
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
                <h4 class="card-title">
                    @lang('crud.inventories.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.inventories.inputs.supplier_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.inventories.inputs.product_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.inventories.inputs.location_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.inventories.inputs.quantity')
                            </th>
                            <th class="text-right">
                                @lang('crud.inventories.inputs.min_qty')
                            </th>
                            <th class="text-right">
                                @lang('crud.inventories.inputs.max_qty')
                            </th>
                            <th class="text-right">
                                @lang('crud.inventories.inputs.quantity_on_order')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventories as $inventory)
                        <tr>
                            <td>
                                {{ optional($inventory->supplier)->name ?? '-'
                                }}
                            </td>
                            <td>
                                {{ optional($inventory->product)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($inventory->location)->name ?? '-'
                                }}
                            </td>
                            <td>{{ $inventory->quantity ?? '-' }}</td>
                            <td>{{ $inventory->min_qty ?? '-' }}</td>
                            <td>{{ $inventory->max_qty ?? '-' }}</td>
                            <td>{{ $inventory->quantity_on_order ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $inventory)
                                    <a
                                        href="{{ route('inventories.edit', $inventory) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $inventory)
                                    <a
                                        href="{{ route('inventories.show', $inventory) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $inventory)
                                    <form
                                        action="{{ route('inventories.destroy', $inventory) }}"
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
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">{!! $inventories->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

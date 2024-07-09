@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('inventories.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.inventories.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.supplier_id')</h5>
                    <span
                        >{{ optional($inventory->supplier)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.product_id')</h5>
                    <span
                        >{{ optional($inventory->product)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.location_id')</h5>
                    <span
                        >{{ optional($inventory->location)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.quantity')</h5>
                    <span>{{ $inventory->quantity ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.min_qty')</h5>
                    <span>{{ $inventory->min_qty ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.max_qty')</h5>
                    <span>{{ $inventory->max_qty ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.inventories.inputs.quantity_on_order')</h5>
                    <span>{{ $inventory->quantity_on_order ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('inventories.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Inventory::class)
                <a
                    href="{{ route('inventories.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('addresses.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.addresses.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.address')</h5>
                    <span>{{ $address->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.zip_code')</h5>
                    <span>{{ $address->zip_code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.country_id')</h5>
                    <span>{{ optional($address->country)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.addressable_id')</h5>
                    <span>{{ $address->addressable_id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.city_id')</h5>
                    <span>{{ optional($address->city)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.addressable_type')</h5>
                    <span>{{ $address->addressable_type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.township_id')</h5>
                    <span>{{ optional($address->township)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.zip_code')</h5>
                    <span>{{ $address->zip_code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.addresses.inputs.default')</h5>
                    <span>{{ $address->default ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('addresses.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Address::class)
                <a href="{{ route('addresses.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

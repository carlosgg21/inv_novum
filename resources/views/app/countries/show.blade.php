@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('countries.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.countries.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.countries.inputs.code')</h5>
                    <span>{{ $country->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.countries.inputs.name')</h5>
                    <span>{{ $country->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.countries.inputs.iso')</h5>
                    <span>{{ $country->iso ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.countries.inputs.time_zone')</h5>
                    <span>{{ $country->time_zone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.countries.inputs.flag')</h5>
                    <span>{{ $country->flag ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.countries.inputs.currency_id')</h5>
                    <span>{{ optional($country->currency)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('countries.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Country::class)
                <a href="{{ route('countries.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

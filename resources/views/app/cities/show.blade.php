@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('cities.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.cities.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.cities.inputs.country_id')</h5>
                    <span>{{ optional($city->country)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.cities.inputs.code')</h5>
                    <span>{{ $city->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.cities.inputs.name')</h5>
                    <span>{{ $city->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.cities.inputs.acronym')</h5>
                    <span>{{ $city->acronym ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.cities.inputs.zip_code')</h5>
                    <span>{{ $city->zip_code ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('cities.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\City::class)
                <a href="{{ route('cities.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

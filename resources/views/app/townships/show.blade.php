@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('townships.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.townships.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.townships.inputs.city_id')</h5>
                    <span>{{ optional($township->city)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.townships.inputs.code')</h5>
                    <span>{{ $township->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.townships.inputs.name')</h5>
                    <span>{{ $township->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.townships.inputs.zip_code')</h5>
                    <span>{{ $township->zip_code ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('townships.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Township::class)
                <a href="{{ route('townships.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

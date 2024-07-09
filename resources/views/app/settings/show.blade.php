@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('settings.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.settings.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.settings.inputs.group')</h5>
                    <span>{{ $setting->group ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.settings.inputs.name')</h5>
                    <span>{{ $setting->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.settings.inputs.value')</h5>
                    <span>{{ $setting->value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.settings.inputs.manager_by')</h5>
                    <span>{{ $setting->manager_by ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.settings.inputs.type')</h5>
                    <span>{{ $setting->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.settings.inputs.description')</h5>
                    <span>{{ $setting->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('settings.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Setting::class)
                <a href="{{ route('settings.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

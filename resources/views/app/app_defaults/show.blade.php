@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('app-defaults.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.defaults.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.defaults.inputs.module')</h5>
                    <span>{{ $appDefault->module ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.defaults.inputs.name')</h5>
                    <span>{{ $appDefault->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.defaults.inputs.display_name')</h5>
                    <span>{{ $appDefault->display_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.defaults.inputs.value')</h5>
                    <span>{{ $appDefault->value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.defaults.inputs.description')</h5>
                    <span>{{ $appDefault->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('app-defaults.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\AppDefault::class)
                <a
                    href="{{ route('app-defaults.create') }}"
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('prefixes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.prefixes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.prefixes.inputs.name')</h5>
                    <span>{{ $prefix->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prefixes.inputs.display')</h5>
                    <span>{{ $prefix->display ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prefixes.inputs.used_in')</h5>
                    <span>{{ $prefix->used_in ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prefixes.inputs.star_number')</h5>
                    <span>{{ $prefix->star_number ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.prefixes.inputs.description')</h5>
                    <span>{{ $prefix->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('prefixes.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Prefix::class)
                <a href="{{ route('prefixes.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

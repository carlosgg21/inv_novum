@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('banks.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.banks.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.banks.inputs.logo')</h5>
                    <x-partials.thumbnail
                        src="{{ $bank->logo ? \Storage::url($bank->logo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.banks.inputs.name')</h5>
                    <span>{{ $bank->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.banks.inputs.acronym')</h5>
                    <span>{{ $bank->acronym ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.banks.inputs.description')</h5>
                    <span>{{ $bank->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('banks.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Bank::class)
                <a href="{{ route('banks.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

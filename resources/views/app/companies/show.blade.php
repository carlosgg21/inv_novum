@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('companies.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.companies.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.logo')</h5>
                    <x-partials.thumbnail
                        src="{{ $company->logo ? \Storage::url($company->logo) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.code')</h5>
                    <span>{{ $company->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.name')</h5>
                    <span>{{ $company->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.acronym')</h5>
                    <span>{{ $company->acronym ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.slogan')</h5>
                    <span>{{ $company->slogan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.phone')</h5>
                    <span>{{ $company->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.email')</h5>
                    <span>{{ $company->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.web_site')</h5>
                    <span>{{ $company->web_site ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.social_media')</h5>
                    <pre>{{ json_encode($company->social_media) ?? '-' }}</pre>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.address')</h5>
                    <span>{{ $company->address ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.companies.inputs.qr_code')</h5>
                    <x-partials.thumbnail
                        src="{{ $company->qr_code ? \Storage::url($company->qr_code) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('companies.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Company::class)
                <a href="{{ route('companies.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\CompanyContact::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Company Contacts</h4>

            <livewire:company-company-contacts-detail :company="$company" />
        </div>
    </div>
    @endcan
</div>
@endsection

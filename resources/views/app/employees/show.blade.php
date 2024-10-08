@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('employees.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.employees.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $employee->image ? \Storage::url($employee->image) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.identification')</h5>
                    <span>{{ $employee->identification ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.name')</h5>
                    <span>{{ $employee->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.last_name')</h5>
                    <span>{{ $employee->last_name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.charge_id')</h5>
                    <span>{{ optional($employee->charge)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.phone')</h5>
                    <span>{{ $employee->phone ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.email')</h5>
                    <span>{{ $employee->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.hiddeng_date')</h5>
                    <span>{{ $employee->hiddeng_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.discharge_date')</h5>
                    <span>{{ $employee->discharge_date ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.brithday')</h5>
                    <span>{{ $employee->brithday ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.qr_code')</h5>
                    <x-partials.thumbnail
                        src="{{ $employee->qr_code ? \Storage::url($employee->qr_code) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.employees.inputs.observation')</h5>
                    <span>{{ $employee->observation ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('employees.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Employee::class)
                <a href="{{ route('employees.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

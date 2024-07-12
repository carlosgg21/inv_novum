@extends('layouts.app')
@section('title', 'Employees')
@section('page-title', 'Employees List')
@section('breadcrumb')
<x-breadcrumb route="home" home="Home" title="Employees List"></x-breadcrumb>
<x-new-record route="employees.create"></x-new-record>
@endsection

@section('content')
<div class="container">
    <x-searchbar :search="$search">
        <a href="{{ route('employees.index') }}" type="button" class="btn btn-primary btn-sm">
            Clear Search
        </a>
    </x-searchbar>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            {{-- <th class="text-left">
                                @lang('crud.employees.inputs.image')
                            </th> --}}
                            <th class="text-left">
                                @lang('crud.employees.inputs.identification')
                            </th>
                            <th class="text-left">
                                @lang('crud.employees.inputs.name')
                            </th>
                            {{-- <th class="text-left">
                                @lang('crud.employees.inputs.last_name')
                            </th> --}}
                            {{-- <th class="text-left">
                                @lang('crud.employees.inputs.charge_id')
                            </th> --}}
                            {{-- <th class="text-left">
                                @lang('crud.employees.inputs.phone')
                            </th>
                            <th class="text-left">
                                @lang('crud.employees.inputs.email')
                            </th> --}}
                            <th>Status</th>
                            <th>Contact</th>
                            {{-- <th class="text-left">
                                @lang('crud.employees.inputs.hiddeng_date')
                            </th> --}}
                            {{-- <th class="text-left">
                                @lang('crud.employees.inputs.discharge_date')
                            </th>
                            <th class="text-left">
                                @lang('crud.employees.inputs.brithday')
                            </th>
                            <th class="text-left">
                                @lang('crud.employees.inputs.qr_code')
                            </th>
                            <th class="text-left">
                                @lang('crud.employees.inputs.observation')
                            </th> --}}
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            {{-- <td>
                                <x-partials.thumbnail
                                    src="{{ $employee->image ? \Storage::url($employee->image) : '' }}" />
                            </td> --}}
                            <td>{{ $employee->identification ?? '-' }}</td>
                            <td>{{ $employee->name ?? '-' }}<br>
                                <span class="small font-weight-bold">{{ optional($employee->charge)->name ?? '-' }}</span>
                               
                            </td>
                            {{-- <td>{{ $employee->name ?? '-' }}</td>
                            <td>{{ $employee->last_name ?? '-' }}</td> --}}
                            {{-- <td>
                                {{ optional($employee->charge)->name ?? '-' }}
                            </td> --}}
                            {{-- <td>{{ $employee->phone ?? '-' }}</td>
                            <td>{{ $employee->email ?? '-' }}</td> --}}
                          <x-status-badge :status="$employee->status" />
                            <td>
                                <i class="fa fa-phone-square" aria-hidden="true"></i> {{ $employee->phone ?? '-' }}<br>
                                <i class="fa fa-envelope" aria-hidden="true"></i> {{ $employee->email ?? '-' }}
                            </td>
                            {{-- <td>{{$employee->hiddeng_date ? format_date($employee->hiddeng_date, 'd/M/Y'): '-'}}</td> --}}
                            {{-- <td>{{ $employee->discharge_date ?? '-' }}</td>
                            <td>{{ $employee->brithday ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $employee->qr_code ? \Storage::url($employee->qr_code) : '' }}" />
                            </td> --}}
                            {{-- <td>{{ $employee->observation ?? '-' }}</td> --}}
                            <x-action-buttons :model="$employee" routePrefix="employees" />
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="13">{!! $employees->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
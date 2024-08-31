@extends('layouts.app')
@section('title', 'Customers')
@section('page-title', 'Create Customers')
@section('breadcrumb')
<x-breadcrumb route="customers.index" home="Customer" title="Create List"></x-breadcrumb>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
           

            <x-form method="POST" action="{{ route('customers.store') }}" class="mt-4">
                @include('app.customers.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('customers.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>

@endsection
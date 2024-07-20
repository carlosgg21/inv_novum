@extends('layouts.app')
@section('title', 'Product')
@section('page-title', 'Edit Product')
@section('breadcrumb')
<x-breadcrumb route="products.index" home="Products List" title="Edit Product"></x-breadcrumb>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-form method="PUT" action="{{ route('products.update', $product) }}" has-files class="mt-4">
            @include('app.products.form-inputs')

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">
                    <i class="icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <a href="{{ route('products.create') }}" class="btn btn-light btn-sm">
                    <i class="icon ion-md-add text-primary"></i>
                    @lang('crud.common.create')
                </a>

                <button type="submit" class="btn btn-primary float-right btn-sm">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.update')
                </button>
            </div>
        </x-form>
    </div>
</div>
@endsection

@section('css')
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('js')
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function () {          
        // For select 2
        $(".select2").select2();
            
  });
</script>
@endsection
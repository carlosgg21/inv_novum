@extends('layouts.app')
@section('title', 'Inventory')
@section('page-title', 'Inventory Entry')
@section('breadcrumb')
<x-breadcrumb route="inventories.index" home="Inventory" title="Inventory Entry"></x-breadcrumb>
@endsection

@section('content')

<div class="card">
    <div class="card-body">


        <x-form method="POST" action="{{ route('inventories.store') }}">
            @include('app.inventories.form-inputs')

            <div class="mt-4">
                <a href="{{ route('inventories.index') }}" class="btn btn-light btn-sm">
                    <i class="icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <button type="submit" class="btn btn-primary float-right btn-sm">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.create')
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
<script src="{{ asset('assets/node_modules//inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>

<script>
    $(function () {          
        // For select 2
        $(".select2").select2();
            
  });


  $(document).ready(function() {


       

        $('#product_id').on('change', function() {
        var productId = $(this).val();

            $.ajax({
                url: '/api/get-product-details/' + productId,
                type: 'GET',
                success: function(response) {
                    console.log(response.data)
                    $('#cost_price').val(response.data.cost_price);
                    $('#sell_price').val(response.data.unit_price);
                    $('#productHelpBlock').text('Product Description: ' + response.data.description);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Error retrieving product details. Please try again.');
                }
            });
        });
    });
</script>
@endsection
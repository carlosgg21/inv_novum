@extends('layouts.app')
@section('title', 'Customers')
@section('page-title', 'Edit Customers')
@section('breadcrumb')
<x-breadcrumb route="customers.index" home="Customer" title="Edit List"></x-breadcrumb>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <x-form method="PUT" action="{{ route('customers.update', $customer) }}">
            @include('app.customers.form-inputs')


            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-location-pin"></i></span> <span class="hidden-xs-down">Address</span></a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab"><span class="hidden-sm-up"><i class="icon-people"></i></span> <span class="hidden-xs-down">Contacts</span></a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="icons-ATM"></i></span> <span class="hidden-xs-down">Banck
                            Account</span></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane  p-20" id="home2" role="tabpanel">

                    @foreach ($customer->bankAccounts as $index =>$item)
                    <div class="row mt-4 column-separator">
                        <div class="col-sm-4">
                            <label for="select1">Bank {{ $item->bank_id   }} {{ $item->currency_id }}</label>
                            <div>
                                <select id="select1" name="banks[]" class="form-control form-control-sm">
                                    @foreach ($banks as $key => $bank)
                                     <option value="{{ $key }}" {{ $item->bank_id == $key ? 'selected' : '' }}> {{ $bank }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="select1">Currency</label>
                            <div>
                                <select id="select1" name="currencies[]" class="form-control form-control-sm">
                                    @foreach ($currencies as $key => $currency)
                                        @if($key == $item->currency_id)
                                         <option value="{{ $key }}" selected> {{ $currency }}</option>
                                        @endif
                                         <option value="{{ $key }}"> {{ $currency }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="text">Account Number</label>
                                <input id="text" name="number[]" type="text" value="{{ $item->number }}" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Checkboxes</label>
                            <div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="default[]" id="checkbox_{{ $index+1 }}" type="checkbox" class="custom-control-input"  {{ $item->default ? 'checked': ''  }} >
                                    <label for="checkbox_{{ $index+1 }}" class="custom-control-label">Default</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @for ($i = 0; $i < 2-$customer->bankAccounts->count(); $i++)
                        <div class="row mt-4 column-separator">
                            <div class="col-sm-4">
                                <label for="select1">Bank</label>
                                <div>
                                    <select id="select1" name="banks[]" class="form-control form-control-sm">
                                        <option value="">---Select option---</option>
                                        @foreach ($banks as $key => $bank)
                                        <option value="{{ $key }}"> {{ $bank }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="select1">Currency</label>
                                <div>
                                    <select id="select1" name="currencies[]" class="form-control form-control-sm">
                                        <option value="">---Select option---</option>
                                        @foreach ($currencies as $key => $currencie)
                                        <option value="{{ $key }}"> {{ $currencie }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="text">Account Number</label>
                                    <input id="text" name="number[]" type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label>default</label>
                                <div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input name="default[]" id="checkbox_{{ $customer->bankAccounts->count() + $i + 1 }}" type="checkbox" class="custom-control-input">
                                        <label for="checkbox_{{ $customer->bankAccounts->count() + $i + 1 }}" class="custom-control-label">Default</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor






                </div>
                <div class="tab-pane active  p-20" id="profile2" role="tabpanel">
                   <div class="row">

                    <div class="col-sm-4">
                        <label for="select1">Country</label>
                        <div>
                            <select id="countries" name="countries" class="form-control form-control-sm">
                                @foreach ($countries as $key => $country)
                                @if(!($customer->getDefaultAddress()))
                                     <option value="{{ $key }}" {{ $key==53 ? 'selected' : '' }}> {{ $country }}</option>
                                   @else
                                   <option value="{{ $key }}"> {{ $country }}</option>
                                 @endif                                
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="select1">City</label>
                        <div>
                            <select id="cities" name="cities" class="form-control form-control-sm">
                                <option>--Select city--</option>
                                @foreach ($cities as $key => $city)
                                <option value="{{ $key }}"> {{ $city }}</option>                                
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="select1">Township</label>
                        <div>
                            <select id="townships" name="townships" class="form-control form-control-sm" disabled>
                                <option>--Select city--</option>
                              
                            </select>
                        </div>
                    </div>
                 

                   </div>
                   <div class="row mt-2">
                        <div class="col-sm-8">
                            <label for="text">Address</label>
                            <input id="text" name="address" type="text" class="form-control form-control-sm">
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="text">Zip Code</label>
                                <input id="text" name="zip_code" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                   </div>

                </div>
                <div class="tab-pane p-20" id="messages2" role="tabpanel">
                    <div class="column-separator" style="padding-bottom: 2%; margin-bottom: 1">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="text">Identification No.</label>
                                <input id="text" name="identifications[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Name</label>
                                <input id="text" name="names[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Last Name</label>
                                <input id="text" name="lasts_name[]" type="text" class="form-control form-control-sm">
                            </div>
                        
                        </div>
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <label for="text">Charge</label>
                                <input id="text" name="charges[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Phone</label>
                                <input id="text" name="phones[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Email</label>
                                <input id="email" name="emails[]" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="text">Identification No.</label>
                                <input id="text" name="identifications[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Name</label>
                                <input id="text" name="names[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Last Name</label>
                                <input id="text" name="lasts_name[]" type="text" class="form-control form-control-sm">
                            </div>
                        
                        </div>
                        <div class="row ">                        
                            <div class="col-sm-4">
                                <label for="text">Charge</label>
                                <input id="text" name="charges[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Phone</label>
                                <input id="text" name="phones[]" type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-sm-4">
                                <label for="text">Email</label>
                                <input id="email" name="emails[]" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                 
      
                </div>
            </div>


            <div class="mt-4">
                <a href="{{ route('customers.index') }}" class="btn btn-light btn-sm">
                    <i class="icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <a href="{{ route('customers.create') }}" class="btn btn-light btn-sm">
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
@section('js')
<script>
    $(document).ready(function() {
        $('#countries').change(function() {
         var selectedValue = $(this).val();
          if (selectedValue != 53) {
            $('#cities').prop('disabled', true); // Deshabilitar el select de ciudades
            } else {
            $('#cities').prop('disabled', false); // Habilitar el select de ciudades
            }
            });


            $('#cities').change(function() {
            var cityId = $(this).val();
            console.log('Ciudad seleccionada: ' + cityId);

            if (cityId) {
            // Habilitar el select de townships
            $('#townships').prop('disabled', false);

            // Limpiar opciones anteriores
            $('#townships').empty();
            $('#townships').append('<option value="">--Select township--</option>');

            // Realizar la solicitud AJAX para obtener los townships
            $.ajax({
            url: '{{ url("api/get-townships-by-city") }}/' + cityId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
            // Agregar las opciones de townships al select
            $.each(data, function(key, value) {
            $('#townships').append('<option value="' + key + '">' + value + '</option>');
            });
            },
            error: function(xhr, status, error) {
            console.error('Error al obtener los townships:', error);
            }
            });
            } else {
            // Si no hay ciudad seleccionada, deshabilitar el select de townships
            $('#townships').prop('disabled', true);
            $('#townships').empty();
            $('#townships').append('<option value="">--Select township--</option>');
            }
            });

    });
</script>
@endsection

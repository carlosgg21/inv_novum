@extends('layouts.app')
@section('title', 'Sales Order')
@section('page-title', 'Create Sales Orders')
@section('breadcrumb')
    <x-breadcrumb route="sales-orders.index" home="Sales Order" title="Create Sales Orders"></x-breadcrumb>
    {{-- <x-new-record route="sales_orders.create"></x-new-record> --}}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <x-form method="POST" action="{{ route('sales-orders.store') }}" class="mt-4">
                @include('app.sales_orders.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('sales-orders.index') }}" class="btn btn-light btn-sm">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary btn-sm float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .add-one {
            color: #333;
            cursor: pointer;
        }

        .add-one:hover {
            color: #03A9F3;
        }
    </style>
@endsection
@section('js')
    <script>
        // Función para calcular el subtotal de cada fila
        function calculateSubtotal(input) {
            var row = $(input).closest('.row');
            var qtyInput = row.find('.qty-input');
            var unitPriceInput = row.find('.unit-price-input');
            var subTotalInput = row.find('.sub-total-input');

            var qty = parseFloat(qtyInput.val()) || 0;
            var unitPrice = parseFloat(unitPriceInput.val()) || 0;
            var subTotal = qty * unitPrice;

            subTotalInput.val(subTotal.toFixed(2));
            calculateOrderTotal(); // Llama a la función para actualizar el total de la orden
        }


        // Función para calcular el total de la orden
        function calculateOrderTotal() {
            let totalSubtotal = 0;

            // Sumar todos los subtotales
            $('.sub-total-input').each(function() {
                totalSubtotal += parseFloat($(this).val()) || 0;
            });

            // Obtener valores de otros campos
            const freight = parseFloat($('input[name="freight"]').val()) || 0;
            const miscellaneous = parseFloat($('input[name="miscellaneous"]').val()) || 0;
            const taxes = parseFloat($('input[name="taxes"]').val()) || 0;
            const discount = parseFloat($('input[name="discount"]').val()) || 0;

            // Calcular el total de la orden
            const orderTotal = totalSubtotal + freight + miscellaneous + taxes - discount;

            // Actualizar el campo de total de la orden
            $('input[name="order_total"]').val(orderTotal.toFixed(2));
        }

        $(document).ready(function() {


            // Clone the hidden element and shows it
            $('.add-one').click(function() {
                $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
                attach_delete();
            });

            $('form').on('submit', function(e) {
                // Elimina solo el primer elemento oculto antes de enviar el formulario
                $('.dynamic-element').first().remove(); // Elimina solo el elemento oculto


                var isValid = true;

                // Verifica si hay algún select de productos vacío
                $('select[name="products[]"]').each(function() {
                    if ($(this).val() === '') {
                        isValid = false; // Marca como inválido
                        $(this).focus(); // Mueve el foco al primer campo inválido
                        return false; // Sale del bucle
                    }
                });

                if (!isValid) {
                    e.preventDefault(); // Previene el envío del formulario
                    alert("Por favor, completa todos los campos requeridos.");
                }

            });

            // Attach functionality to delete buttons
            function attach_delete() {
                $('.delete').off().click(function() {
                    $(this).closest('.form-group').remove();
                    calculateOrderTotal(); // Recalculate the order total after deletion
                });
            }

            // Event delegation for dynamically added product selects
            $('.dynamic-stuff').on('change', '.product-select', function() {
                var selectedOption = $(this).find('option:selected');
                var description = selectedOption.data('description');
                var price = selectedOption.data('price');
                var qty = selectedOption.data('qty');

                // Actualiza la descripción
                $(this).siblings('.product-description').text(description);

                // Actualiza el precio unitario
                $(this).closest('.row').find('.unit-price-input').val(price);

                // Limita la cantidad máxima
                var qtyInput = $(this).closest('.row').find('.qty-input');
                qtyInput.attr('max', qty);
                qtyInput.val(0); // Limpia el campo qty al cambiar el producto
            });






            // Evento para calcular el subtotal al cambiar cantidad o precio unitario
            $(document).on('input', '.qty-input, .unit-price-input', function() {
                calculateSubtotal(this);
            });


            // Evento para recalcular el total de la orden al cambiar otros campos
            $(document).on('input',
                'input[name="freight"], input[name="miscellaneous"], input[name="taxes"],input[name="discount"]',
                function() {
                    calculateOrderTotal();
                });

            // Calcular el total al cargar la página
            calculateOrderTotal();



            $('#customer_id').change(function() {
                var selectedOption = $(this).find('option:selected');
                var paymentMethodId = selectedOption.data('method');
                var paymentTermId = selectedOption.data('term');

                // Actualiza el campo Payment Method
                $('#payment_method_id').val(paymentMethodId);

                // Actualiza el campo Payment Term
                $('#payment_term_id').val(paymentTermId);
            });


        });
    </script>
@endsection

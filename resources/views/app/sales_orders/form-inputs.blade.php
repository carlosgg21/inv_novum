@php $editing = isset($salesOrder) @endphp

<div class="row">


    <x-inputs.group class="col-sm-4">
        <label for="order_date">Order Date <span class="required-field">*</span> </label>
        <x-inputs.date name="order_date"
            value="{{ old('order_date', $editing ? optional($salesOrder->order_date)->format('Y-m-d') : '') }}"
            max="255" required></x-inputs.date>
    </x-inputs.group>
    <x-inputs.group class="col-sm-4">
        <label for="sold_by">Sold By<span class="required-field">*</span> </label>
        <x-inputs.select name="sold_by">
            @php $selected = old('sold_by', ($editing ? $salesOrder->sold_by : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach ($employees as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="approved_by">Approved By </label>
        <x-inputs.select name="approved_by">
            @php $selected = old('approved_by', ($editing ? $salesOrder->approved_by : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach ($authorizedEmployee as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="customer_id">Customer<span class="required-field">*</span> </label>
        <x-inputs.select name="customer_id">
            @php $selected = old('customer_id', ($editing ? $salesOrder->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach ($customers as $value)
                <option value="{{ $value->id }}" {{ $selected == $value->id ? 'selected' : '' }}
                    data-term="{{ $value->payment_term_id }}" data-method="{{ $value->payment_method_id }}">
                    {{ $value->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="payment_method_id">Payment Method<span class="required-field">*</span> </label>
        <x-inputs.select name="payment_method_id">
            @php $selected = old('payment_method_id', ($editing ? $salesOrder->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach ($paymentMethods as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="payment_term_id">Payment Term<span class="required-field">*</span> </label>
        <x-inputs.select name="payment_term_id">
            @php $selected = old('payment_term_id', ($editing ? $salesOrder->payment_term_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Term</option>
            @foreach ($paymentTerms as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <!-- HIDDEN DYNAMIC ELEMENT TO CLONE -->
    <div class="form-group dynamic-element" style="display:none">
        <div class="row">
            <div class="col-sm-3">
                <select class="form-control form-control-sm product-select" name="products[]">
                    <option value="">--Select Product---</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}"
                            data-description="{{ $product->description }}" data-qty="{{ $product->qty }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                <small class="product-description form-text text-muted">Descripción del producto</small>
            </div>
            <div class="col-sm-2">
                <input type="number" class="form-control form-control-sm qty-input" min="1" name="qty[]"
                    placeholder="Qty" oninput="calculateSubtotal(this)">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-sm unit-price-input" name="unit_price[]"
                    placeholder="Unit Price" oninput="calculateSubtotal(this)">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control form-control-sm sub-total-input" name="sub_total[]"
                    placeholder="Sub Total" disabled>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger delete btn-sm"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </div>
    <!-- END OF HIDDEN ELEMENT -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="title">Sales Order Details</h4>
            </div>
            <div class="col-sm-2 text-right">
                <button type="button" class="btn btn-sm add-one">
                    <i class="fas fa-plus-square"></i> Add Product
                </button>
            </div>
        </div>
        <div class="form-horizontal">
            <div class="dynamic-stuff">
            </div>
            <p class="text-center add-one text-primary "><strong> Product to Sales Order Datails</strong></p>
        </div>
    </div>

    <x-inputs.group class="col-sm-12 col-lg-3">
        <label for="taxes">Taxes </label>
        <x-inputs.number name="taxes" label="Taxes" :value="old('taxes', $editing ? $salesOrder->taxes : '')" max="255" step="1"
            placeholder="Taxes"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-3">
        <label for="discount">Discount </label>
        <x-inputs.number name="discount" label="Discount" :value="old('discount', $editing ? $salesOrder->discount : '')" max="255" step="0.01"
            placeholder="Discount"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-3">
        <label for="miscellaneous">Miscellaneous </label>
        <x-inputs.number name="miscellaneous" label="Miscellaneous" :value="old('miscellaneous', $editing ? $salesOrder->miscellaneous : '')" max="255" step="0.01"
            placeholder="Miscellaneous"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-3">
        <label for="freight">Freight </label>
        <x-inputs.number name="freight" label="Freight" :value="old('freight', $editing ? $salesOrder->freight : '')" max="255" step="0.01"
            placeholder="Freight"></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <div class="text-right">
            <label for="order_total">Order Total </label>
            <x-inputs.number name="order_total" class="text-right" :value="old('order_total', $editing ? $salesOrder->order_total : '')" max="255" step="0.01"
                placeholder="Order Total" readonly></x-inputs.number>
        </div>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <label for="notes">Notes </label>
        <x-inputs.textarea name="notes" label="Notes"
            maxlength="255">{{ old('notes', $editing ? $salesOrder->notes : '') }}</x-inputs.textarea>
    </x-inputs.group>


</div>

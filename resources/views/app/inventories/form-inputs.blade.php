@php $editing = isset($inventory) @endphp

<div class="row border border-primary">

    <x-inputs.group class="col-sm-12 m-t-5">
        <label for="Product">Product<span class="required-field">* </span> </label>
        <x-inputs.select2 name="product_id" required style="width: 100%; height:36px;">
            @php $selected = old('product_id', ($editing ? $inventory->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product</option>
            @foreach($products as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select2>
        <small id="productHelpBlock" class="form-text text-muted">
           Product Description: 
        </small>
    </x-inputs.group>



    <x-inputs.group class="col-sm-4">
        <label for="Quantity">Quantity<span class="required-field">* </span> </label>
        <x-inputs.number name="quantity" :value="old('quantity', ($editing ? $inventory->quantity : ''))" min="1"
            max="10000" placeholder="Quantity">
        </x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="CostPrice">Cost Price</label>
        <x-inputs.number name="cost_price" id="cost_price" :value="old('cost_price', ($editing ? $inventory->cost_price : ''))"
            max="10000" min="1" step="0.01" placeholder="Cost Price"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4 ">
        <label for="SellPrice">Sell Price</label>
        <x-inputs.number name="sell_price" id="sell_price" :value="old('sell_price', ($editing ? $inventory->sell_price : ''))"
            max="10000" min="1" step="0.01" placeholder="Sell Price" required></x-inputs.number>
    </x-inputs.group>


</div>

<hr>
<h5 class="box-title font-weight-bold">Entry Details</h5>
<hr>
<div class="row m-t-5">
    <x-inputs.group class="col-sm-12">
        <label for="Supplier">Supplier </label>
        <x-inputs.select2 name="supplier_id" label="Supplier">
            @php $selected = old('supplier_id', ($editing ? $inventory->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select2>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="Location">Location</label>
        <x-inputs.select name="location_id" required>
            @php $selected = old('location_id', ($editing ? $inventory->location_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Location</option>
            @foreach($locations as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>



    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.number name="quantity_on_order" label="Quantity On Order"
            :value="old('quantity_on_order', ($editing ? $inventory->quantity_on_order : ''))" max="255"
            placeholder="Quantity On Order"></x-inputs.number>
    </x-inputs.group> --}}

    <x-inputs.group class="col-sm-12 col-lg-4">
        <label for="BatchNumber">Batch Number</label>
        <x-inputs.text name="batch_number" :value="old('batch_number', ($editing ? $inventory->batch_number : ''))"
            maxlength="255" placeholder="Batch Number"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <label for="Expire Date">Expire Date</label>
        <x-inputs.date name="expire_date"
            value="{{ old('expire_date', ($editing ? optional($inventory->expire_date)->format('Y-m-d') : '')) }}"
            max="255"></x-inputs.date>
    </x-inputs.group>
</div>
<hr>
<h5 class="box-title font-weight-bold">Shipping Information</h5>
<hr>
<div class="row m-t-5">

    <x-inputs.group class="col-sm-4">
        <label for="ShippingCost">Shipping Cost</label>
        <x-inputs.number name="shipping_cost" :value="old('shipping_cost', ($editing ? $inventory->shipping_cost : ''))"
            max="10000" min="1" step="0.01" placeholder="Shipping Cost"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4 ">
        <label for="ShippingTrakignNumber">Shipping Tracking Number</label>
        <x-inputs.text name="shipping_tracking_number"
            :value="old('shipping_tracking_number', ($editing ? $inventory->shipping_tracking_number : ''))"
            maxlength="255" placeholder="Shipping Tracking Number"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="ReceivedDate">Received Date</label>
        <x-inputs.date name="received_date"
            value="{{ old('received_date', ($editing ? optional($inventory->received_date)->format('Y-m-d') : '')) }}"
            max="255"></x-inputs.date>
    </x-inputs.group>

</div>
<div class="row">

    <x-inputs.group class="col-sm-4">

        <div class="custom-control custom-checkbox mr-sm-2 mb-3">
            <input type="checkbox" class="custom-control-input" id="billable" name="billable" value="1" checked>
            <label class="custom-control-label" for="billable">Billable</label>
        </div>

    </x-inputs.group>



    <x-inputs.group class="col-sm-4">
        <label for="PayementMethod">Payement Method</label>
        <x-inputs.select name="payment_method_id">
            @php $selected = old('payment_method_id', ($editing ? $inventory->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethod as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-4">
        <label for="PayementTerm">Payement Term</label>
        <x-inputs.select name="payment_term_id">
            @php $selected = old('payment_term_id', ($editing ? $inventory->payment_term_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Term</option>
            @foreach($paymentTerm as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="Notes">Notes</label>
        <x-inputs.textarea name="notes" maxlength="255">{{ old('notes', ($editing ? $inventory->notes : ''))}}
        </x-inputs.textarea>
    </x-inputs.group>
</div>
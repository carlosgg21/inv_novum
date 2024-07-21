@php $editing = isset($inventory) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <label for="Product">Product<span class="required-field">* </span> </label>
        <x-inputs.select2 name="product_id" label="Product" required>
            @php $selected = old('product_id', ($editing ? $inventory->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product</option>
            @foreach($products as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select2>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="Supplier">Supplier<span class="required-field">* </span> </label>
        <x-inputs.select2 name="supplier_id" label="Supplier">
            @php $selected = old('supplier_id', ($editing ? $inventory->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select2>
    </x-inputs.group>

    <fieldset>
        ggf
    </fieldset>
    <x-inputs.group class="col-sm-12">
        <label for="Quantity">Quantity<span class="required-field">* </span> </label>
        <x-inputs.number name="quantity" label="Quantity" :value="old('quantity', ($editing ? $inventory->quantity : ''))"
            min="0" max="10000"  placeholder="Quantity"></x-inputs.number>
    </x-inputs.group>
    

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="location_id" label="Location" required>
            @php $selected = old('location_id', ($editing ? $inventory->location_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Location</option>
            @foreach($locations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="quantity_on_order"
            label="Quantity On Order"
            :value="old('quantity_on_order', ($editing ? $inventory->quantity_on_order : ''))"
            max="255"
            placeholder="Quantity On Order"
        ></x-inputs.number>
    </x-inputs.group> --}}

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="batch_number"
            label="Batch Number"
            :value="old('batch_number', ($editing ? $inventory->batch_number : ''))"
            maxlength="255"
            placeholder="Batch Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.date
            name="expire_date"
            label="Expire Date"
            value="{{ old('expire_date', ($editing ? optional($inventory->expire_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>

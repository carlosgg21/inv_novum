@php $editing = isset($inventory) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="supplier_id" label="Supplier" required>
            @php $selected = old('supplier_id', ($editing ? $inventory->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="product_id" label="Product" required>
            @php $selected = old('product_id', ($editing ? $inventory->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product</option>
            @foreach($products as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
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

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="quantity"
            label="Quantity"
            :value="old('quantity', ($editing ? $inventory->quantity : ''))"
            max="255"
            placeholder="Quantity"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="min_qty"
            label="Min Qty"
            :value="old('min_qty', ($editing ? $inventory->min_qty : ''))"
            max="255"
            placeholder="Min Qty"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="max_qty"
            label="Max Qty"
            :value="old('max_qty', ($editing ? $inventory->max_qty : ''))"
            max="255"
            placeholder="Max Qty"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="quantity_on_order"
            label="Quantity On Order"
            :value="old('quantity_on_order', ($editing ? $inventory->quantity_on_order : ''))"
            max="255"
            placeholder="Quantity On Order"
        ></x-inputs.number>
    </x-inputs.group>
</div>

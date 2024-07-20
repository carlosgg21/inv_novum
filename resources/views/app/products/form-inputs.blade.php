@php $editing = isset($product) @endphp

<div class="row">

    <x-inputs.group class="col-sm-12">
            <label for="Code">Code</label>
            <x-inputs.text name="code" label="Code" :value="old('code', ($editing ? $product->code : ''))" maxlength="255"
                placeholder="Code"></x-inputs.text>
        </x-inputs.group>
        
        <x-inputs.group class="col-sm-12">
            <label for="Name">Name</label>
            <x-inputs.text name="name" label="Name" :value="old('name', ($editing ? $product->name : ''))" maxlength="255"
                placeholder="Name" required></x-inputs.text>
        </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="Brand">Brand</label>
        <x-inputs.select2 name="brand_id" label="Brand">
            @php $selected = old('brand_id', ($editing ? $product->brand_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Brand</option>
            @foreach($brands as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select2>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="Category">Category</label>
        <x-inputs.select2 name="category_id" label="Category">
            @php $selected = old('category_id', ($editing ? $product->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category</option>
            @foreach($categories as $value => $label)
            <option value="{{ $value }}" {{ $selected==$value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select2>
    </x-inputs.group>

@if($editing)

   {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="description" label="Description" maxlength="255">{{ old('description', ($editing ?
            $product->description : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>  --}}
    
   <x-inputs.group class="col-sm-12 col-lg-12">
    <label for="Stock">Stock</label>
        <x-inputs.number name="qty" label="Qty" :value="old('qty', ($editing ? $product->qty : ''))" max="255"
            placeholder="Qty" disabled></x-inputs.number>
    </x-inputs.group>
    
    {{-- <x-inputs.group class="col-sm-12 col-lg-6">
        <label for="Stock">On Order</label>
        <x-inputs.number name="on_order" label="On Order" :value="old('on_order', ($editing ? $product->on_order : ''))"
            max="255" placeholder="On Order"></x-inputs.number>
    </x-inputs.group> --}}
@endif
 

    <x-inputs.group class="col-sm-12 col-lg-6">
        <label for="Unit">Unit</label>
        <x-inputs.text name="unit" label="Unit" :value="old('unit', ($editing ? $product->unit : ''))" maxlength="255" 
            placeholder="Unit"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <label for="Size">Size</label>
        <x-inputs.text name="size" label="Size" :value="old('size', ($editing ? $product->size : ''))" maxlength="255"
            placeholder="Size"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <label for="UnitPrice">Unit Price</label>
        <x-inputs.number name="unit_price" label="Unit Price"
            :value="old('unit_price', ($editing ? $product->unit_price : ''))" max="10000" min="1" step="0.01"
            placeholder="Unit Price" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-6">
        <label for="CostPrice">Cost Price</label>
        <x-inputs.number name="cost_price" label="Cost Price"
            :value="old('cost_price', ($editing ? $product->cost_price : ''))" max="10000" min="1" step="0.01"
            placeholder="Cost Price"></x-inputs.number>
    </x-inputs.group>    

    <x-inputs.group class="col-sm-12 col-lg-6">
        <label for="MinQty">Min Qty</label>
        <x-inputs.number name="min_qty" label="Min Qty" :value="old('min_qty', ($editing ? $product->min_qty : ''))"
            max="10000" min="1" placeholder="Min Qty"></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <label for="MaxQty">Max Qty</label>
        <x-inputs.number name="max_qty" label="Max Qty" :value="old('max_qty', ($editing ? $product->max_qty : ''))"
            max="10000" min="1" placeholder="Max Qty"></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <label for="Notes">Notes</label>
        <x-inputs.textarea name="notes" label="Notes" maxlength="255">{{ old('notes', ($editing ? $product->notes : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>
</div>
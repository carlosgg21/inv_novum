@php $editing = isset($product) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $product->image ? \Storage::url($product->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="brand_id" label="Brand">
            @php $selected = old('brand_id', ($editing ? $product->brand_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Brand</option>
            @foreach($brands as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="category_id" label="Category">
            @php $selected = old('category_id', ($editing ? $product->category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category</option>
            @foreach($categories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $product->code : ''))"
            maxlength="255"
            placeholder="Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $product->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ? $product->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="qty"
            label="Qty"
            :value="old('qty', ($editing ? $product->qty : ''))"
            max="255"
            placeholder="Qty"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="on_order"
            label="On Order"
            :value="old('on_order', ($editing ? $product->on_order : ''))"
            max="255"
            placeholder="On Order"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="unit"
            label="Unit"
            :value="old('unit', ($editing ? $product->unit : ''))"
            maxlength="255"
            placeholder="Unit"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="unit_price"
            label="Unit Price"
            :value="old('unit_price', ($editing ? $product->unit_price : ''))"
            max="255"
            step="1"
            placeholder="Unit Price"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="cost_price"
            label="Cost Price"
            :value="old('cost_price', ($editing ? $product->cost_price : ''))"
            max="255"
            step="0.01"
            placeholder="Cost Price"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="size"
            label="Size"
            :value="old('size', ($editing ? $product->size : ''))"
            maxlength="255"
            placeholder="Size"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $product->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="min_qty"
            label="Min Qty"
            :value="old('min_qty', ($editing ? $product->min_qty : ''))"
            max="255"
            placeholder="Min Qty"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="max_qty"
            label="Max Qty"
            :value="old('max_qty', ($editing ? $product->max_qty : ''))"
            max="255"
            placeholder="Max Qty"
        ></x-inputs.number>
    </x-inputs.group>
</div>

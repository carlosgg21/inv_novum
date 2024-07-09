@php $editing = isset($prefix) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $prefix->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="display"
            label="Display"
            :value="old('display', ($editing ? $prefix->display : ''))"
            maxlength="255"
            placeholder="Display"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="used_in" label="Used In">
            @php $selected = old('used_in', ($editing ? $prefix->used_in : '')) @endphp
            <option value="invoice" {{ $selected == 'invoice' ? 'selected' : '' }} >Invoice</option>
            <option value="sales_order" {{ $selected == 'sales_order' ? 'selected' : '' }} >Sales order</option>
            <option value="purchase_order" {{ $selected == 'purchase_order' ? 'selected' : '' }} >Purchase order</option>
            <option value="customer" {{ $selected == 'customer' ? 'selected' : '' }} >Customer</option>
            <option value="employee" {{ $selected == 'employee' ? 'selected' : '' }} >Employee</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="star_number"
            label="Star Number"
            :value="old('star_number', ($editing ? $prefix->star_number : ''))"
            max="255"
            placeholder="Star Number"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ? $prefix->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>

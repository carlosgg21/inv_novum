@php $editing = isset($address) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="address"
            label="Address"
            maxlength="255"
            required
            >{{ old('address', ($editing ? $address->address : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="zip_code"
            label="Zip Code"
            :value="old('zip_code', ($editing ? $address->zip_code : ''))"
            maxlength="255"
            placeholder="Zip Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="addressable_id"
            label="Addressable Id"
            :value="old('addressable_id', ($editing ? $address->addressable_id : ''))"
            maxlength="255"
            placeholder="Addressable Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="addressable_type"
            label="Addressable Type"
            :value="old('addressable_type', ($editing ? $address->addressable_type : ''))"
            maxlength="255"
            placeholder="Addressable Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="zip_code"
            label="Zip Code"
            :value="old('zip_code', ($editing ? $address->zip_code : ''))"
            maxlength="255"
            placeholder="Zip Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="default"
            label="Default"
            :checked="old('default', ($editing ? $address->default : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    @livewire('selects.country-id-city-id-township-id-dependent-select',
    ['address' => $editing ? $address->id : null])
</div>

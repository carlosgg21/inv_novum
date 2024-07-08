@php $editing = isset($township) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="city_id" label="City">
            @php $selected = old('city_id', ($editing ? $township->city_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the City</option>
            @foreach($cities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $township->code : ''))"
            maxlength="255"
            placeholder="Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $township->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="zip_code"
            label="Zip Code"
            :value="old('zip_code', ($editing ? $township->zip_code : ''))"
            maxlength="255"
            placeholder="Zip Code"
        ></x-inputs.text>
    </x-inputs.group>
</div>

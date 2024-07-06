@php $editing = isset($country) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $country->code : ''))"
            maxlength="255"
            placeholder="Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $country->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="iso"
            label="Iso"
            :value="old('iso', ($editing ? $country->iso : ''))"
            maxlength="255"
            placeholder="Iso"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="time_zone"
            label="Time Zone"
            :value="old('time_zone', ($editing ? $country->time_zone : ''))"
            maxlength="255"
            placeholder="Time Zone"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="flag"
            label="Flag"
            :value="old('flag', ($editing ? $country->flag : ''))"
            maxlength="255"
            placeholder="Flag"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="currency_id" label="Currency">
            @php $selected = old('currency_id', ($editing ? $country->currency_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Currency</option>
            @foreach($currencies as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>

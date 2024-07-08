@php $editing = isset($currency) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="acronym"
            label="Acronym"
            :value="old('acronym', ($editing ? $currency->acronym : ''))"
            maxlength="255"
            placeholder="Acronym"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $currency->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="sign"
            label="Sign"
            :value="old('sign', ($editing ? $currency->sign : ''))"
            maxlength="255"
            placeholder="Sign"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $currency->code : ''))"
            maxlength="255"
            placeholder="Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="flag"
            label="Flag"
            :value="old('flag', ($editing ? $currency->flag : ''))"
            maxlength="255"
            placeholder="Flag"
        ></x-inputs.text>
    </x-inputs.group>
</div>

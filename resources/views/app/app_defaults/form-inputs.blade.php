@php $editing = isset($appDefault) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="module" label="Module" maxlength="255" required
            >{{ old('module', ($editing ? $appDefault->module : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $appDefault->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="display_name"
            label="Display Name"
            :value="old('display_name', ($editing ? $appDefault->display_name : ''))"
            maxlength="255"
            placeholder="Display Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="value" label="Value" maxlength="255" required
            >{{ old('value', ($editing ? $appDefault->value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ? $appDefault->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>

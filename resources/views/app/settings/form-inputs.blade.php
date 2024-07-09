@php $editing = isset($setting) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="group"
            label="Group"
            :value="old('group', ($editing ? $setting->group : ''))"
            maxlength="255"
            placeholder="Group"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $setting->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="value" label="Value" maxlength="255" required
            >{{ old('value', ($editing ? $setting->value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="manager_by"
            label="Manager By"
            :value="old('manager_by', ($editing ? $setting->manager_by : ''))"
            max="255"
            placeholder="Manager By"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $setting->type : '')) @endphp
            <option value="string" {{ $selected == 'string' ? 'selected' : '' }} >String</option>
            <option value="json" {{ $selected == 'json' ? 'selected' : '' }} >Json</option>
            <option value="boolean" {{ $selected == 'boolean' ? 'selected' : '' }} >Boolean</option>
            <option value="integer" {{ $selected == 'integer' ? 'selected' : '' }} >Integer</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ? $setting->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>

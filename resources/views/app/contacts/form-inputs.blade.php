@php $editing = isset($contact) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="identication"
            label="Identication"
            :value="old('identication', ($editing ? $contact->identication : ''))"
            maxlength="255"
            placeholder="Identication"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $contact->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="last_name"
            label="Last Name"
            :value="old('last_name', ($editing ? $contact->last_name : ''))"
            maxlength="255"
            placeholder="Last Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="Phone"
            :value="old('phone', ($editing ? $contact->phone : ''))"
            maxlength="255"
            placeholder="Phone"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $contact->email : ''))"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="address" label="Address" maxlength="255"
            >{{ old('address', ($editing ? $contact->address : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    @livewire('selects.country-id-city-id-township-id-dependent-select',
    ['contact' => $editing ? $contact->id : null])
</div>

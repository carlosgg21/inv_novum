@php $editing = isset($paymentTerm) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $paymentTerm->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="day"
            label="Day"
            :value="old('day', ($editing ? $paymentTerm->day : ''))"
            max="255"
            placeholder="Day"
        ></x-inputs.number>
    </x-inputs.group>
</div>

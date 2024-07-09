@php $editing = isset($bankAccount) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="number"
            label="Number"
            :value="old('number', ($editing ? $bankAccount->number : ''))"
            maxlength="255"
            placeholder="Number"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="bank_id" label="Bank">
            @php $selected = old('bank_id', ($editing ? $bankAccount->bank_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Bank</option>
            @foreach($banks as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="type"
            label="Type"
            :value="old('type', ($editing ? $bankAccount->type : ''))"
            maxlength="255"
            placeholder="Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="currency_id" label="Currency">
            @php $selected = old('currency_id', ($editing ? $bankAccount->currency_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Currency</option>
            @foreach($currencies as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>

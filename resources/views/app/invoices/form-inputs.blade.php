@php $editing = isset($invoice) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sales_order_id" label="Sales Order" required>
            @php $selected = old('sales_order_id', ($editing ? $invoice->sales_order_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sales Order</option>
            @foreach($salesOrders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="number"
            label="Number"
            :value="old('number', ($editing ? $invoice->number : 'str'))"
            maxlength="255"
            placeholder="Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($invoice->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $invoice->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total_amount"
            label="Total Amount"
            :value="old('total_amount', ($editing ? $invoice->total_amount : ''))"
            max="255"
            step="0.01"
            placeholder="Total Amount"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="employee_id" label="Employee">
            @php $selected = old('employee_id', ($editing ? $invoice->employee_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach($employees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.hidden
        name="year"
        :value="old('year', ($editing ? $invoice->year : ''))"
    ></x-inputs.hidden>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="currency_id" label="Currency" required>
            @php $selected = old('currency_id', ($editing ? $invoice->currency_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Currency</option>
            @foreach($currencies as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.hidden
        name="month"
        :value="old('month', ($editing ? $invoice->month : ''))"
    ></x-inputs.hidden>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $invoice->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="prefix"
            label="Prefix"
            :value="old('prefix', ($editing ? $invoice->prefix : ''))"
            maxlength="255"
            placeholder="Prefix"
        ></x-inputs.text>
    </x-inputs.group>
</div>

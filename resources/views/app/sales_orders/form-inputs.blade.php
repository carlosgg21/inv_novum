@php $editing = isset($salesOrder) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="number"
            label="Number"
            :value="old('number', ($editing ? $salesOrder->number : ''))"
            maxlength="255"
            placeholder="Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="order_date"
            label="Order Date"
            value="{{ old('order_date', ($editing ? optional($salesOrder->order_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="customer_id" label="Customer">
            @php $selected = old('customer_id', ($editing ? $salesOrder->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $salesOrder->status : 'not entered')) @endphp
            <option value="entered" {{ $selected == 'entered' ? 'selected' : '' }} >Entered</option>
            <option value="not entered" {{ $selected == 'not entered' ? 'selected' : '' }} >Not entered</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="prefix"
            label="Prefix"
            :value="old('prefix', ($editing ? $salesOrder->prefix : ''))"
            maxlength="255"
            placeholder="Prefix"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="invoice_date"
            label="Invoice Date"
            value="{{ old('invoice_date', ($editing ? optional($salesOrder->invoice_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="taxes"
            label="Taxes"
            :value="old('taxes', ($editing ? $salesOrder->taxes : ''))"
            max="255"
            step="1"
            placeholder="Taxes"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="discount"
            label="Discount"
            :value="old('discount', ($editing ? $salesOrder->discount : ''))"
            max="255"
            step="0.01"
            placeholder="Discount"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="miscellanues"
            label="Miscellanues"
            :value="old('miscellanues', ($editing ? $salesOrder->miscellanues : ''))"
            max="255"
            step="0.01"
            placeholder="Miscellanues"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="freight"
            label="Freight"
            :value="old('freight', ($editing ? $salesOrder->freight : ''))"
            max="255"
            step="0.01"
            placeholder="Freight"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="order_total"
            label="Order Total"
            :value="old('order_total', ($editing ? $salesOrder->order_total : ''))"
            max="255"
            step="0.01"
            placeholder="Order Total"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sold_by" label="Sold By">
            @php $selected = old('sold_by', ($editing ? $salesOrder->sold_by : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach($employees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="payment_method_id" label="Payment Method">
            @php $selected = old('payment_method_id', ($editing ? $salesOrder->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="payment_term_id" label="Payment Term">
            @php $selected = old('payment_term_id', ($editing ? $salesOrder->payment_term_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Term</option>
            @foreach($paymentTerms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $salesOrder->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="internal_notes"
            label="Internal Notes"
            maxlength="255"
            >{{ old('internal_notes', ($editing ? $salesOrder->internal_notes :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="approved_by"
            label="Approved By"
            :value="old('approved_by', ($editing ? $salesOrder->approved_by : ''))"
            maxlength="255"
            placeholder="Approved By"
        ></x-inputs.text>
    </x-inputs.group>
</div>

@php $editing = isset($paymentsReceived) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="amount"
            label="Amount"
            :value="old('amount', ($editing ? $paymentsReceived->amount : ''))"
            max="255"
            step="0.01"
            placeholder="Amount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="payment_method_id" label="Payment Method">
            @php $selected = old('payment_method_id', ($editing ? $paymentsReceived->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="payment_term_id" label="Payment Term">
            @php $selected = old('payment_term_id', ($editing ? $paymentsReceived->payment_term_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Term</option>
            @foreach($paymentTerms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="invoice_id" label="Invoice">
            @php $selected = old('invoice_id', ($editing ? $paymentsReceived->invoice_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Invoice</option>
            @foreach($invoices as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sales_order_id" label="Sales Order">
            @php $selected = old('sales_order_id', ($editing ? $paymentsReceived->sales_order_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sales Order</option>
            @foreach($salesOrders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($paymentsReceived->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $paymentsReceived->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="customer_id" label="Customer">
            @php $selected = old('customer_id', ($editing ? $paymentsReceived->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="received_id" label="Employee">
            @php $selected = old('received_id', ($editing ? $paymentsReceived->received_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach($employees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>

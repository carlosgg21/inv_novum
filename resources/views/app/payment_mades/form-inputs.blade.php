@php $editing = isset($paymentMade) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="supplier_id" label="Supplier">
            @php $selected = old('supplier_id', ($editing ? $paymentMade->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="payment_method_id" label="Payment Method">
            @php $selected = old('payment_method_id', ($editing ? $paymentMade->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="payment_term_id" label="Payment Term">
            @php $selected = old('payment_term_id', ($editing ? $paymentMade->payment_term_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Term</option>
            @foreach($paymentTerms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="amount"
            label="Amount"
            :value="old('amount', ($editing ? $paymentMade->amount : ''))"
            max="255"
            step="0.01"
            placeholder="Amount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="reference_number"
            label="Reference Number"
            :value="old('reference_number', ($editing ? $paymentMade->reference_number : ''))"
            maxlength="255"
            placeholder="Reference Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($paymentMade->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="purchase_order_id" label="Purchase Order">
            @php $selected = old('purchase_order_id', ($editing ? $paymentMade->purchase_order_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Purchase Order</option>
            @foreach($purchaseOrders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="created_by" label="Employee">
            @php $selected = old('created_by', ($editing ? $paymentMade->created_by : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach($employees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="aproved_by"
            label="Aproved By"
            :value="old('aproved_by', ($editing ? $paymentMade->aproved_by : ''))"
            maxlength="255"
            placeholder="Aproved By"
        ></x-inputs.text>
    </x-inputs.group>
</div>

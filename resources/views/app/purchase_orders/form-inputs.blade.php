@php $editing = isset($purchaseOrder) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="supplier_id" label="Supplier" required>
            @php $selected = old('supplier_id', ($editing ? $purchaseOrder->supplier_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Supplier</option>
            @foreach($suppliers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="number"
            label="Number"
            :value="old('number', ($editing ? $purchaseOrder->number : ''))"
            maxlength="255"
            placeholder="Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="order_date"
            label="Order Date"
            value="{{ old('order_date', ($editing ? optional($purchaseOrder->order_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total_amount"
            label="Total Amount"
            :value="old('total_amount', ($editing ? $purchaseOrder->total_amount : ''))"
            max="255"
            step="0.01"
            placeholder="Total Amount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $purchaseOrder->status : 'not entered')) @endphp
            <option value="entered" {{ $selected == 'entered' ? 'selected' : '' }} >Entered</option>
            <option value="not entered" {{ $selected == 'not entered' ? 'selected' : '' }} >Not entered</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="taxes"
            label="Taxes"
            :value="old('taxes', ($editing ? $purchaseOrder->taxes : ''))"
            max="255"
            step="0.01"
            placeholder="Taxes"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="discount"
            label="Discount"
            :value="old('discount', ($editing ? $purchaseOrder->discount : ''))"
            max="255"
            step="0.01"
            placeholder="Discount"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="miscellaneus"
            label="Miscellaneus"
            :value="old('miscellaneus', ($editing ? $purchaseOrder->miscellaneus : ''))"
            max="255"
            step="0.01"
            placeholder="Miscellaneus"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="shipping_date"
            label="Shipping Date"
            value="{{ old('shipping_date', ($editing ? optional($purchaseOrder->shipping_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="shippin_tracking_number"
            label="Shippin Tracking Number"
            :value="old('shippin_tracking_number', ($editing ? $purchaseOrder->shippin_tracking_number : ''))"
            maxlength="255"
            placeholder="Shippin Tracking Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.number
            name="shipping_cost"
            label="Shipping Cost"
            :value="old('shipping_cost', ($editing ? $purchaseOrder->shipping_cost : ''))"
            max="255"
            step="0.01"
            placeholder="Shipping Cost"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="received_date"
            label="Received Date"
            value="{{ old('received_date', ($editing ? optional($purchaseOrder->received_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="payment_method_id" label="Payment Method">
            @php $selected = old('payment_method_id', ($editing ? $purchaseOrder->payment_method_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Method</option>
            @foreach($paymentMethods as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="payment_term_id" label="Payment Term">
            @php $selected = old('payment_term_id', ($editing ? $purchaseOrder->payment_term_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment Term</option>
            @foreach($paymentTerms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="condition_id" label="Condition" required>
            @php $selected = old('condition_id', ($editing ? $purchaseOrder->condition_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Condition</option>
            @foreach($conditions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.checkbox
            name="billable"
            label="Billable"
            :checked="old('billable', ($editing ? $purchaseOrder->billable : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>

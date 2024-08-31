@php $editing = isset($customer) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <label for="name">Customer<span class="required-field">*</span> </label>
        <x-inputs.text name="name" :value="old('name', ($editing ? $customer->name : ''))" maxlength="255"
            placeholder="Name" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-3">
        <label for="phone">Phone <span class="required-field">*</span> </label>
        <x-inputs.text name="phone"  :value="old('phone', ($editing ? $customer->phone : ''))"
            maxlength="255" placeholder="Phone" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <label for="email">Email <span class="required-field">*</span> </label>
        <x-inputs.email name="email" :value="old('email', ($editing ? $customer->email : ''))"
            maxlength="255" placeholder="Email" required></x-inputs.email>
    </x-inputs.group>

    <div class="col-sm-12 col-lg-2 ">
        <label for="payemntType">Payment Method </label>
        <div>
            <select id="paymentMethod" name="payment_method_id" class="form-control form-control-sm">
                <option >--Select Option--</option>
                @foreach ($paymentMethods as $key => $paymentMethod)
                 <option value="{{ $key }}" {{ $editing ? ($customer->payment_method_id == $key ? 'selected' : '') : '' }}> {{ $paymentMethod }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3 ">
            <label for="payemntType">Payment Term </label>
            <div>
                <select id="paymentTerm" name="payment_term_id" class="form-control form-control-sm">
                    <option>--Select Option--</option>
                    @foreach ($paymentTerms as $paymentTerm)             
                    <option value="{{ $paymentTerm->id }}" {{ $editing ?($customer->payment_term_id == $paymentTerm->id ? 'selected' : ''): '' }}> {{ $paymentTerm->description }}
                    </option>
                    @endforeach
                </select>
            </div>
    </div>

    <x-inputs.group class="col-sm-12">
        <label for="payemntType">Notes</label>
        <x-inputs.textarea name="notes" maxlength="255">{{ old('notes', ($editing ?
            $customer->notes : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>
</div>
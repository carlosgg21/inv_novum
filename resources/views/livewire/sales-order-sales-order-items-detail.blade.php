<div>
    <div class="mb-4">
        @can('create', App\Models\SalesOrderItem::class)
        <button class="btn btn-primary" wire:click="newSalesOrderItem">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\SalesOrderItem::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="sales-order-sales-order-items-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="salesOrderItem.quantity"
                            label="Quantity"
                            wire:model="salesOrderItem.quantity"
                            max="255"
                            placeholder="Quantity"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="salesOrderItem.unit_price"
                            label="Unit Price"
                            wire:model="salesOrderItem.unit_price"
                            max="255"
                            step="1"
                            placeholder="Unit Price"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="salesOrderItem.total_price"
                            label="Total Price"
                            wire:model="salesOrderItem.total_price"
                            max="255"
                            step="0.01"
                            placeholder="Total Price"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="salesOrderItem.notes"
                            label="Notes"
                            wire:model="salesOrderItem.notes"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="salesOrderItem.product_id"
                            label="Product"
                            wire:model="salesOrderItem.product_id"
                        >
                            <option value="null" disabled>Please select the Product</option>
                            @foreach($productsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-right">
                        @lang('crud.sales_order_sales_order_items.inputs.quantity')
                    </th>
                    <th class="text-right">
                        @lang('crud.sales_order_sales_order_items.inputs.unit_price')
                    </th>
                    <th class="text-right">
                        @lang('crud.sales_order_sales_order_items.inputs.total_price')
                    </th>
                    <th class="text-left">
                        @lang('crud.sales_order_sales_order_items.inputs.notes')
                    </th>
                    <th class="text-left">
                        @lang('crud.sales_order_sales_order_items.inputs.product_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($salesOrderItems as $salesOrderItem)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $salesOrderItem->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-right">
                        {{ $salesOrderItem->quantity ?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $salesOrderItem->unit_price ?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $salesOrderItem->total_price ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $salesOrderItem->notes ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($salesOrderItem->product)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $salesOrderItem)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editSalesOrderItem({{ $salesOrderItem->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">{{ $salesOrderItems->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

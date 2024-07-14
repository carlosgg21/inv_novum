<div>
    <div class="mb-4">
        @can('create', App\Models\PurchaseOrderItem::class)
        <button class="btn btn-primary" wire:click="newPurchaseOrderItem">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\PurchaseOrderItem::class)
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

    <x-modal
        id="purchase-order-purchase-order-items-modal"
        wire:model="showingModal"
    >
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
                            name="purchaseOrderItem.quantity"
                            label="Quantity"
                            wire:model="purchaseOrderItem.quantity"
                            max="255"
                            placeholder="Quantity"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="purchaseOrderItem.qty_received"
                            label="Qty Received"
                            wire:model="purchaseOrderItem.qty_received"
                            max="255"
                            placeholder="Qty Received"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="purchaseOrderItem.unit_price"
                            label="Unit Price"
                            wire:model="purchaseOrderItem.unit_price"
                            max="255"
                            step="0.01"
                            placeholder="Unit Price"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="purchaseOrderItem.total_price"
                            label="Total Price"
                            wire:model="purchaseOrderItem.total_price"
                            max="255"
                            step="0.01"
                            placeholder="Total Price"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="purchaseOrderItem.noted"
                            label="Noted"
                            wire:model="purchaseOrderItem.noted"
                            maxlength="255"
                        ></x-inputs.textarea>
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
                        @lang('crud.purchase_order_purchase_order_items.inputs.quantity')
                    </th>
                    <th class="text-right">
                        @lang('crud.purchase_order_purchase_order_items.inputs.qty_received')
                    </th>
                    <th class="text-right">
                        @lang('crud.purchase_order_purchase_order_items.inputs.unit_price')
                    </th>
                    <th class="text-right">
                        @lang('crud.purchase_order_purchase_order_items.inputs.total_price')
                    </th>
                    <th class="text-left">
                        @lang('crud.purchase_order_purchase_order_items.inputs.noted')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($purchaseOrderItems as $purchaseOrderItem)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $purchaseOrderItem->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-right">
                        {{ $purchaseOrderItem->quantity ?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $purchaseOrderItem->qty_received ?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $purchaseOrderItem->unit_price ?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $purchaseOrderItem->total_price ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $purchaseOrderItem->noted ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $purchaseOrderItem)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editPurchaseOrderItem({{ $purchaseOrderItem->id }})"
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
                    <td colspan="6">{{ $purchaseOrderItems->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

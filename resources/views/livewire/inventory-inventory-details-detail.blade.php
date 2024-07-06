<div>
    <div class="mb-4">
        @can('create', App\Models\InventoryDetail::class)
        <button class="btn btn-primary" wire:click="newInventoryDetail">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\InventoryDetail::class)
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

    <x-modal id="inventory-inventory-details-modal" wire:model="showingModal">
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
                        <x-inputs.text
                            name="inventoryDetail.batch_number"
                            label="Batch Number"
                            wire:model="inventoryDetail.batch_number"
                            maxlength="255"
                            placeholder="Batch Number"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="inventoryDetailExpireDate"
                            label="Expire Date"
                            wire:model="inventoryDetailExpireDate"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="inventoryDetail.unit_cost"
                            label="Unit Cost"
                            wire:model="inventoryDetail.unit_cost"
                            max="255"
                            step="0.01"
                            placeholder="Unit Cost"
                        ></x-inputs.number>
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
                    <th class="text-left">
                        @lang('crud.inventory_inventory_details.inputs.batch_number')
                    </th>
                    <th class="text-left">
                        @lang('crud.inventory_inventory_details.inputs.expire_date')
                    </th>
                    <th class="text-right">
                        @lang('crud.inventory_inventory_details.inputs.unit_cost')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($inventoryDetails as $inventoryDetail)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $inventoryDetail->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">
                        {{ $inventoryDetail->batch_number ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $inventoryDetail->expire_date ?? '-' }}
                    </td>
                    <td class="text-right">
                        {{ $inventoryDetail->unit_cost ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $inventoryDetail)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editInventoryDetail({{ $inventoryDetail->id }})"
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
                    <td colspan="4">{{ $inventoryDetails->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

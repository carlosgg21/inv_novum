<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Inventory;
use Livewire\WithPagination;
use App\Models\InventoryDetail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InventoryInventoryDetailsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Inventory $inventory;
    public InventoryDetail $inventoryDetail;
    public $inventoryDetailExpireDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New InventoryDetail';

    protected $rules = [
        'inventoryDetail.batch_number' => ['nullable', 'max:255', 'string'],
        'inventoryDetailExpireDate' => ['nullable', 'date'],
        'inventoryDetail.unit_cost' => ['nullable', 'numeric'],
    ];

    public function mount(Inventory $inventory): void
    {
        $this->inventory = $inventory;
        $this->resetInventoryDetailData();
    }

    public function resetInventoryDetailData(): void
    {
        $this->inventoryDetail = new InventoryDetail();

        $this->inventoryDetailExpireDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newInventoryDetail(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.inventory_inventory_details.new_title');
        $this->resetInventoryDetailData();

        $this->showModal();
    }

    public function editInventoryDetail(InventoryDetail $inventoryDetail): void
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.inventory_inventory_details.edit_title'
        );
        $this->inventoryDetail = $inventoryDetail;

        $this->inventoryDetailExpireDate = optional(
            $this->inventoryDetail->expire_date
        )->format('Y-m-d');

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->inventoryDetail->inventory_id) {
            $this->authorize('create', InventoryDetail::class);

            $this->inventoryDetail->inventory_id = $this->inventory->id;
        } else {
            $this->authorize('update', $this->inventoryDetail);
        }

        $this->inventoryDetail->expire_date = \Carbon\Carbon::make(
            $this->inventoryDetailExpireDate
        );

        $this->inventoryDetail->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', InventoryDetail::class);

        InventoryDetail::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetInventoryDetailData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->inventory->inventoryDetails as $inventoryDetail) {
            array_push($this->selected, $inventoryDetail->id);
        }
    }

    public function render(): View
    {
        return view('livewire.inventory-inventory-details-detail', [
            'inventoryDetails' => $this->inventory
                ->inventoryDetails()
                ->paginate(20),
        ]);
    }
}

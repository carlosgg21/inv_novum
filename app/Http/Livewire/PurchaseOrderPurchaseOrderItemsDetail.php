<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PurchaseOrderPurchaseOrderItemsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public PurchaseOrder $purchaseOrder;
    public PurchaseOrderItem $purchaseOrderItem;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New PurchaseOrderItem';

    protected $rules = [
        'purchaseOrderItem.quantity' => ['required', 'numeric'],
        'purchaseOrderItem.qty_received' => ['nullable', 'numeric'],
        'purchaseOrderItem.unit_price' => ['required', 'numeric'],
        'purchaseOrderItem.total_price' => ['required', 'numeric'],
        'purchaseOrderItem.noted' => ['required', 'max:255', 'string'],
    ];

    public function mount(PurchaseOrder $purchaseOrder): void
    {
        $this->purchaseOrder = $purchaseOrder;
        $this->resetPurchaseOrderItemData();
    }

    public function resetPurchaseOrderItemData(): void
    {
        $this->purchaseOrderItem = new PurchaseOrderItem();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPurchaseOrderItem(): void
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.purchase_order_purchase_order_items.new_title'
        );
        $this->resetPurchaseOrderItemData();

        $this->showModal();
    }

    public function editPurchaseOrderItem(
        PurchaseOrderItem $purchaseOrderItem
    ): void {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.purchase_order_purchase_order_items.edit_title'
        );
        $this->purchaseOrderItem = $purchaseOrderItem;

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

        if (!$this->purchaseOrderItem->purchase_order_id) {
            $this->authorize('create', PurchaseOrderItem::class);

            $this->purchaseOrderItem->purchase_order_id =
                $this->purchaseOrder->id;
        } else {
            $this->authorize('update', $this->purchaseOrderItem);
        }

        $this->purchaseOrderItem->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', PurchaseOrderItem::class);

        PurchaseOrderItem::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPurchaseOrderItemData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach (
            $this->purchaseOrder->purchaseOrderItems
            as $purchaseOrderItem
        ) {
            array_push($this->selected, $purchaseOrderItem->id);
        }
    }

    public function render(): View
    {
        return view('livewire.purchase-order-purchase-order-items-detail', [
            'purchaseOrderItems' => $this->purchaseOrder
                ->purchaseOrderItems()
                ->paginate(20),
        ]);
    }
}

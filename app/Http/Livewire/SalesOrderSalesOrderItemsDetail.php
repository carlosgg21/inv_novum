<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\SalesOrder;
use Livewire\WithPagination;
use App\Models\SalesOrderItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SalesOrderSalesOrderItemsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public SalesOrder $salesOrder;
    public SalesOrderItem $salesOrderItem;
    public $productsForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New SalesOrderItem';

    protected $rules = [
        'salesOrderItem.quantity' => ['required', 'numeric'],
        'salesOrderItem.unit_price' => ['required', 'numeric'],
        'salesOrderItem.total_price' => ['required', 'numeric'],
        'salesOrderItem.notes' => ['nullable', 'max:255', 'string'],
        'salesOrderItem.product_id' => ['required', 'exists:products,id'],
    ];

    public function mount(SalesOrder $salesOrder): void
    {
        $this->salesOrder = $salesOrder;
        $this->productsForSelect = Product::pluck('name', 'id');
        $this->resetSalesOrderItemData();
    }

    public function resetSalesOrderItemData(): void
    {
        $this->salesOrderItem = new SalesOrderItem();

        $this->salesOrderItem->product_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSalesOrderItem(): void
    {
        $this->editing = false;
        $this->modalTitle = trans(
            'crud.sales_order_sales_order_items.new_title'
        );
        $this->resetSalesOrderItemData();

        $this->showModal();
    }

    public function editSalesOrderItem(SalesOrderItem $salesOrderItem): void
    {
        $this->editing = true;
        $this->modalTitle = trans(
            'crud.sales_order_sales_order_items.edit_title'
        );
        $this->salesOrderItem = $salesOrderItem;

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

        if (!$this->salesOrderItem->sales_order_id) {
            $this->authorize('create', SalesOrderItem::class);

            $this->salesOrderItem->sales_order_id = $this->salesOrder->id;
        } else {
            $this->authorize('update', $this->salesOrderItem);
        }

        $this->salesOrderItem->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', SalesOrderItem::class);

        SalesOrderItem::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSalesOrderItemData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->salesOrder->salesOrderItems as $salesOrderItem) {
            array_push($this->selected, $salesOrderItem->id);
        }
    }

    public function render(): View
    {
        return view('livewire.sales-order-sales-order-items-detail', [
            'salesOrderItems' => $this->salesOrder
                ->salesOrderItems()
                ->paginate(20),
        ]);
    }
}

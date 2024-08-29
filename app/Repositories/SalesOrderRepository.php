<?php

namespace App\Repositories;

use App\Models\SalesOrder;

class SalesOrderRepository
{
	protected $salesOrder;


	public function __construct(SalesOrder $salesOrder) {
		$this->salesOrder = $salesOrder;
	}

	public function findSalesOrder($id)
	{
		return $this->salesOrder
			->with([
				'customer',
				'salesOrderItems.inventory.product',
				'invoices',
				'paymentMethod',
				'paymentTerm',
				'soldBy',
				'paymentsReceiveds'
			])
			->findOrFail($id);
	}

}
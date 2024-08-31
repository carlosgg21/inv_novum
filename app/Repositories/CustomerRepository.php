<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
	protected $customer;


	public function __construct(Customer $customer) {
		$this->customer = $customer;
	}



	public function findCustomer($id)
	{
		return $this->customer
			->with([
				'salesOrders',
				'paymentMethod',
				'paymentTerm',
				'paymentsReceiveds',
				'contacts',
				'addresses',
				'bankAccounts' => function ($query) {
					$query->orderBy('default', 'desc'); // Ordenar por el campo 'default'
				},
			])
			->findOrFail($id);
	}


	public function entryCustomer($data)
	{
		try {
			$productId = $data['product_id'];
			$product = Product::findOrFail($productId);

			$entryCostPrice = isset($data['cost_price']) ? (float) $data['cost_price'] : 0.0;
			$currentCostPrice = $product->cost_price;

			if ($currentCostPrice !== $entryCostPrice) {
				$updatedCostPrice = $this->calculateNewCost($product, $data);
				$product->cost_price = $updatedCostPrice;
			}

			$entrySellPrice = isset($data['sell_price']) ? (float) $data['sell_price'] : 0.0;
			$currentUnitPrice = $product->unit_price;

			if ($currentUnitPrice !== $entrySellPrice) {
				$updatedUnitPrice = $this->calculateNewUnitPrice($product, $data);
				$product->unit_price = $updatedUnitPrice;
			}

			// Inicia la transacción
			DB::transaction(function () use ($product, $data) {
				$product->qty = $this->calculateUpdatedQuantity($product, $data);
				$product->save();

				return Inventory::create($data);
			});

			return  Inventory::latest()->first();
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

}
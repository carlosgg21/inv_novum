<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\AddressRepository;
use Illuminate\Support\Facades\DB;


class CustomerRepository
{
	protected $customer;
	protected $addressRepository;

	public function __construct(Customer $customer, AddressRepository $addressRepository)
	{
		$this->customer = $customer;
		$this->addressRepository = $addressRepository;
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


	public function entryCustomer($customer, $request)
	{
		// dd($request->input());
		// dump($request->only(['name', 'phone', 'email', 'payment_method_id', 'payment_term_id', 'notes']));
		$accounts[] = $request->only(['banks', 'currencies', 'number', 'default']);
		$contacs[] = $request->only(['contact_id', 'identifications','names', 'lasts_name', 'charges', 'phones', 'emails']);

		dd($contacs);
	
		try {

			DB::transaction(function () use ($customer, $request) {
				//insert in customer
				$customer->update($request->only(['name', 'phone', 'email', 'payment_method_id', 'payment_term_id', 'notes']));
				//insert in address polimofic table 
				$addresData[] = $request->only(['country_id', 'city_id', 'township_id', 'address', 'zip_code', 'address_id']);
				$this->addressRepository->updateOrCreate($addresData ?? [], $customer);
                
				
			
			});

// 			// return  Inventory::latest()->first();
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

}
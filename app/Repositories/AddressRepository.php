<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
	protected $address;


	public function __construct(Address $bankAddress) {
		$this->address = $bankAddress;
	}

	public function updateOrCreate(array $data, $addressable)
	{
		
		foreach ($data as $addressData) {
			if (isset($addressData['address_id'])) {
				
				// Actualizar la dirección existente
				
				$address = $this->address->find($addressData['address_id']);
				
				if ($address) {
					unset($addressData['address_id']);				
					$address->update($addressData);
				}
			} else {
				// Crear una nueva dirección
				
				$addressable->addresses()->create($addressData);
			}
		}
	}

}
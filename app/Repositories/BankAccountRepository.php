<?php

namespace App\Repositories;

use App\Models\BankAccount;

class BankAccountRepository
{
	protected $bankAccount;


	public function __construct(BankAccount $bankAccount) {
		$this->bankAccount = $bankAccount;
	}

}
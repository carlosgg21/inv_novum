<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
	protected $contact;


	public function __construct(Contact $contact) {
		$this->contact = $contact;
	}

}
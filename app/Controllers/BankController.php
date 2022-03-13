<?php

use App\Services\Package;
use App\Services\Bank;

require_once 'app/Services/Bank.php';

class BankController
{
	public $bank;
	public function __construct()
	{
		$this->bank = new Bank();
	}

	/**
	 * This function is used to fetch all banks from the database
	 * @return array
	 */
	public function getAll()
	{
		return $this->bank->fetchAllBanks();
	}

	/**
	 * This function returns a single bank
	 * @return array
	 */
    public function getBank($id)
    {
		if (!empty($id)) {
			return $this->bank->fetchBankById($id);
		}
		return false;
    }

	public function createBank($data)
	{
		if(isset($data['btnRegister'])){
			$this->validateSession($data['csrfToken']);

			if ($this->bank->addBank($data)) {
				return true;
			}
		}
	}
}

?>
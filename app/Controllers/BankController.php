<?php

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

	/**
	 * This function is used to create banks
	 */
	public function createBank($data)
	{
		if(isset($data['btnAddBank'])){
			$this->validateSession($data['csrfToken']);

			if ($this->bank->addBank($data)) {
				return true;
			}
		}
	}

	/**
	 * This function is used to validate user session token
	 * @param string $token
	 */
	private function validateSession($token)
	{
		if ($_SESSION['CSRF'] !== $token) {
			session_unset();
			session_destroy();
			header('Location: 419');
		}
	}
}

?>
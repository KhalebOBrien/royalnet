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
				header('location: manage-banks');
			}
		}
	}

	/**
	 * This function is used to update bank name.
	 * @return boolean
	 */
	public function updateBank($data)
	{
		if(isset($data['btnUpdateBank'])) {
			$this->validateSession($data['csrfToken']);

			if ($this->bank->updateBank($data)) {
				header('location: manage-banks');
			}
		}

		return null;
	}

	/**
	 * This function is used to delete bank.
	 * @return boolean
	 */
	public function deleteBank()
	{
		if(isset($_GET['delete'])) {
			if ($this->bank->deleteBank($_GET['delete'])) {
				header('location: manage-banks');
			}
		}

		return null;
	}

    /**
     * This function is used to get the count of all users under a bank
     * @param  int $bankId
     */
	public function sumBankUsers($bank)
	{
		return $this->bank->sumUsersByBank($bank);
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
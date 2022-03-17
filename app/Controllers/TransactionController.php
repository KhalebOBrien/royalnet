<?php

use App\Services\Transaction;

require_once 'app/Services/Transaction.php';

class TransactionController
{
	public $transaction;
	public function __construct()
	{
		$this->transaction = new Transaction();
	}

	/**
	 * This function is used to fetch all transactions for a user
	 * @return array
	 */
	public function getAllTransactionByUser($userId)
	{
		return $this->transaction->fetchAllTransactionByUser($userId);
	}

	/**
	 * This function is used to fetch transaction by Id
	 * @return array
	 */
    public function getTransactionById($id)
    {
        return $this->transaction->fetchTransactionById($id);
    }
}

?>
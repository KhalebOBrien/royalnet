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
	
	/**
	 * This function is used to fetch transaction by Id
	 * @return array
	 */
    public function sumUserTransactionsByType($user_id, $type=null)
    {
        return $this->transaction->sumUserTranxByType($user_id, $type);
    }

	/**
	 * This function is used to create a withdrawal request
	 * @param array
	 */
	public function withdrawalRequest($data)
	{
		if(isset($data['btnRequestWithdrawal'])){
			$this->validateSession($data['csrfToken']);

			if ($this->transaction->addWithdrawal($_SESSION['user']['id'], $data['txtAmount'])) {
				header('location: my-wallet');
			}
		}	
	}

	/**
	 * This function is used to retrieve all withdrawal request for admins approval
	 * @return array
	 */
	public function getAllWithdrawalRequest()
	{
		return $this->transaction->fetchAllWithdrawalRequest();
	}

	/**
	 * This function is used to approve a user withdrawal request.
	 * @return boolean
	 */
	public function approveWithdrawal()
	{
		if(isset($_GET['approve'])) {
			if ($this->transaction->approveWithdrawalRequest($_GET['approve'])) {
				header('location: '.$_GET['back']);
			}
		}

		return null;
	}

	/**
	 * This function is used to revoke a user withdrawal request.
     * It will refund the user's wallet
	 * @return boolean
	 */
	public function revokeWithdrawal()
	{
		if(isset($_GET['revoke'])) {
			if ($this->transaction->revokeWithdrawalRequest($_GET['revoke'])) {
				header('location: '.$_GET['back']);
			}
		}

		return null;
	}

	/**
	 * This function is used to sum all approved transactions
	 * @return array
	 */
	public function sumAllApprovedTransactions($type)
	{
		return $this->transaction->sumApprovedTransactions($type);
	}

	/**
	 * This function is used to sum all revoked transactions
	 * @return array
	 */
	public function sumAllRevokedTransactions($type)
	{
		return $this->transaction->sumRevokedTransactions($type);
	}

    /**
     * This function is used to check if the system can take withdrawals or not
     * @return boolean
     */
	public function isWithdrawalTurnedOn()
	{
		return $this->transaction->isWithdrawalTurnedOn();
	}

    /**
     * This function is used to set the system withdrawal status
     * @param boolean $status
     * @return boolean
     */
	public function switchWithdrawal($status)
	{
		if(!empty($status)) {
			if ($this->transaction->toggleWithdrawal(($status == 'on') ? 1 : 0)) {
				header('location: '.$_GET['back']);
			}
		}

		return null;
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
<?php
namespace App\Services;

use App\Middleware\DatabaseConnetion;

require_once 'app/Middleware/DatabaseConnetion.php';

class Transaction extends DatabaseConnetion
{
	public function __Construct()
	{
        parent::__construct();
	}

    /**
     * This function is used to fetch all transactions for a user
     * @return array
     */
    public function fetchAllTransactionByUser($userId)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = ".$userId." ORDER BY id DESC";
        $q = $this->dbconn->query($sql);
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to find a transaction by id
     * @param int $id
     * @return array
     */
    public function getTransactionById($id)
    {
        $sql = "SELECT * FROM transactions WHERE id = ".$id;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to find a transaction by refference
     * @param string $code
     * @return array
     */
    public function getTransactionByRefference($code)
    {
        $sql = "SELECT * FROM transactions WHERE reference_code = '".$code."'";
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to fetch all transactions for a user.
     * Revoked transactions are not included
     * @return int
     */
    public function sumUserTranxByType($userId, $type=null)
    {
        $sql = "SELECT SUM(amount) AS total FROM transactions WHERE user_id = ".$userId." AND is_revoked = 0";
        if (!is_null($type)) {
            $sql .= " AND type = '".$type."'";
        }
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        $result = empty($result['total']) ? 0 : $result['total'];

        return $result;
    }

    /**
     * This function is used to add withdrawal to database
     * @param int $userId
     * @param string $amount
     * @return boolean
     */
    public function addWithdrawal($userId, $amount)
    {
		try {
            // prevent withdrawals if turned off by admin
            if (!$this->isWithdrawalTurnedOn()) {
                return false;
            }
            // get the users's wallet                
            $sql = "SELECT amount FROM wallets WHERE user_id = ".$userId;
            $q = $this->dbconn->query($sql);
            $wallet = $q->fetch(\PDO::FETCH_ASSOC);

            // prevent withdrawal of loosed values
            if (intval($wallet['amount']) < intval($amount)) {
                return false;
            }

            // update the users's wallet balance
            $sql = "UPDATE wallets SET amount = :amount, updated_at = NOW() WHERE user_id = :user_id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':amount' => intval($wallet['amount']) - intval($amount),
                ':user_id' => $userId,
            ]);

            // create transaction record
            $sql = "INSERT INTO transactions (reference_code, user_id, amount, type, is_approved, is_revoked, created_at, updated_at) VALUES (:reference_code, :user_id, :amount, :type, :is_approved, :is_revoked, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':reference_code' => $token = Helpers::randomString(12),
                ':user_id' => $userId,
                ':amount' => intval($amount),
                ':type' => 'withdrawal',
                ':is_approved' => 0,
                ':is_revoked' => 0
            ));

            // send mail to admin

            // send mail to user

            return true;
        }
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to fetch all withdrawal requests
     */
    public function fetchAllWithdrawalRequest()
    {
        $sql = "SELECT * FROM transactions WHERE type = 'withdrawal' ORDER BY id DESC";
        $q = $this->dbconn->query($sql);
        $transactions = $q->fetchAll(\PDO::FETCH_ASSOC);
        $result = [];
        if (!empty($transactions)) {
            foreach ($transactions as $tranx) {
                $sql = "SELECT `id`, `surname`, `other_names`, `phone`, `bank`, `acct_number`, `acct_name`, `email`, `fb_link`, `ig_link`, `tw_link`, `yt_link` FROM users WHERE id = ".$tranx['user_id'];
                $q = $this->dbconn->query($sql);
                $data = $q->fetch(\PDO::FETCH_ASSOC);
                $data['requestedAmount'] = $tranx['amount'];
                $data['referenceCode'] = $tranx['reference_code'];
                $data['isApproved'] = $tranx['is_approved'];
                $data['isRevoked'] = $tranx['is_revoked'];
                $data['createdAt'] = $tranx['created_at'];

                $result[] = $data;
            }
        }

        return $result;
    }

	/**
	 * This function is used to approve a user withdrawal request.
	 * @return boolean
	 */
	public function approveWithdrawalRequest($code)
	{
        try {
            $sql = "UPDATE transactions SET is_approved = :is_approved, is_revoked = :is_revoked, updated_at = NOW() WHERE reference_code = :reference_code";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':is_approved' => 1,
                ':is_revoked' => 0,
                ':reference_code' => $code
            ]);

            // send mail to user

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
	}

	/**
	 * This function is used to revoke a user withdrawal request.
     * It will refund the user's wallet
	 * @return boolean
	 */
	public function revokeWithdrawalRequest($code)
	{
        try {
            $sql = "UPDATE transactions SET is_approved = :is_approved, is_revoked = :is_revoked, updated_at = NOW() WHERE reference_code = :reference_code";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':is_approved' => 0,
                ':is_revoked' => 1,
                ':reference_code' => $code
            ]);

            // get the transaction
            $tranx = $this->getTransactionByRefference($code);
            // get the wallet
            $sql = "SELECT * FROM wallets WHERE user_id = ".$tranx['user_id'];
            $q = $this->dbconn->query($sql);
            $wallet = $q->fetch(\PDO::FETCH_ASSOC);
            // make refund to the wallet
            $sql = "UPDATE wallets SET amount = :amount, updated_at = NOW() WHERE id = :id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':amount' => intval($tranx['amount']) + intval($wallet['amount']),
                ':id' => $wallet['id'],
            ]);

            // send mail to member

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
	}

    /**
     * This function is used to sum all approved transactions
     * @return int
     */
    public function sumApprovedTransactions($type)
    {

        $sql = "SELECT SUM(amount) AS total FROM transactions WHERE is_approved = 1 AND is_revoked = 0 AND type = '".$type."'";
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        $result = empty($result['total']) ? 0 : $result['total'];
        
        return $result;
    }

    /**
     * This function is used to sum all revoked transactions
     * @return int
     */
    public function sumRevokedTransactions($type)
    {

        $sql = "SELECT SUM(amount) AS total FROM transactions WHERE is_approved = 0 AND is_revoked = 1 AND type = '".$type."'";
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        $result = empty($result['total']) ? 0 : $result['total'];
        
        return $result;
    }

    /**
     * This function is used to check if the system can take withdrawals or not
     * @return boolean
     */
    public function isWithdrawalTurnedOn()
    {
        $sql = "SELECT * FROM site_settings WHERE name = 'withdrawal_is_active'";
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return boolval($result['value']);
    }

    /**
     * This function is used to set the system withdrawal status
     * @param boolean $status
     * @return boolean
     */
    public function toggleWithdrawal($status)
    {
        $sql = "UPDATE site_settings SET value = :value, last_updated_by = :last_updated_by, updated_at = NOW() WHERE name = 'withdrawal_is_active'";
        $q = $this->dbconn->prepare($sql);
        $q->execute([
            ':value' => $status,
            ':last_updated_by' => $_SESSION['user']['id']
        ]);

        return true;
    }

}

?>
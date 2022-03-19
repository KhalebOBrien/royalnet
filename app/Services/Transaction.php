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
        $sql = "SELECT * FROM transactions WHERE user_id = ".$userId;
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
     * This function is used to fetch all referral bonus transactions for a user
     * @return int
     */
    public function sumUserTranxByType($userId, $type=null)
    {
        $sql = "SELECT SUM(amount) AS total FROM transactions WHERE user_id = ".$userId;
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
            $sql = "INSERT INTO transactions (reference_code, user_id, amount, type, is_approved, created_at, updated_at) VALUES (:reference_code, :user_id, :amount, :type, :is_approved, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':reference_code' => $token = Helpers::randomString(12),
                ':user_id' => $userId,
                ':amount' => intval($amount),
                ':type' => 'withdrawal',
                ':is_approved' => 0
            ));

            return true;
        }
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

}

?>
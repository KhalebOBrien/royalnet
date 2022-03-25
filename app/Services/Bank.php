<?php
namespace App\Services;

use App\Middleware\DatabaseConnetion;

require_once 'app/Middleware/DatabaseConnetion.php';

class Bank extends DatabaseConnetion
{
	public function __Construct()
	{
        parent::__construct();
	}

    /**
     * This function is used to fetch all banks from the database
     * @return array
     */
    public function fetchAllBanks()
    {
        $sql = "SELECT * FROM banks";
        $q = $this->dbconn->query($sql);
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to fetch a bank by id
     * @param int $id
     * @return array
     */
    public function fetchBankById($id)
    {
        $sql = "SELECT * FROM banks WHERE id = ".$id;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to add banks to database
     * @param array $data
     * @return int
     */
    public function addBank($data)
    {
		try {
            $sql = "INSERT INTO banks (name) VALUES (:name)";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':name' => $data['txtBankName']
            ));

            return $this->dbconn->lastInsertId();
        }
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to update a bank
     * @param array $data
     * @return boolean
     */
    public function updateBank($data)
    {
        try {
            $sql = "UPDATE banks SET name = :name WHERE id = :id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':name' => $data['txtBankName'],
                ':id' => $data['txtBankId']
            ]);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to delete a bank
     * @param  int $id
     * @return  boolean
     */
    public function deleteBank($id)
    {
        try {
            $sql = "DELETE FROM banks WHERE id = :id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':id' => $id
            ]);

            // we also need to remove this bank from all users
            $sql = "UPDATE users SET bank = :bankId, acct_number = :acct_number, acct_name = :acct_name WHERE bank = ".$id;
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':bankId' => NULL,
                ':acct_number' => NULL,
                ':acct_name' => NULL
            ]);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to get the count of all users under a bank
     * @param  int $bankId
     * @return  int $count
     */
    public function sumUsersByBank($bankId)
    {
        $sql = "SELECT COUNT(*) AS total FROM users WHERE bank = ".$bankId;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result['total'];
    }
}

?>
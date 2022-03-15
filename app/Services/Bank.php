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
                ':name' => $data['txtname']
            ));

            return $this->dbconn->lastInsertId();
        }
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

}

?>
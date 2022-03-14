<?php
namespace App\Services;

use App\Middleware\DatabaseConnetion;

require_once 'app/Middleware/DatabaseConnetion.php';

class Package extends DatabaseConnetion
{
	public function __Construct()
	{
        parent::__construct();
	}

    /**
     * This function is used to fetch all packages from the database
     * @return array
     */
    public function fetchAllPackages()
    {
        $sql = "SELECT * FROM packages";
        $q = $this->dbconn->query($sql);
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to find a package by id
     * @param int $id
     * @return array
     */
    public function fetchPackageById($id)
    {
        $sql = "SELECT * FROM packages WHERE id = ".$id;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to add packages to database
     * @param array $data
     * @return int
     */
    public function addPackage($data)
    {
		try {
            $sql = "INSERT INTO packages (name, description, price, daily_commission, refferal_commission) VALUES (:name, :description, :price, :daily_commission, :refferal_commission)";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':name' => $data['txtname'],
                ':description' => $data['txtDescription'], 
                ':price' => $data['txtPrice'],
                ':daily_commission' => $data['txtDailyCommission'],
                ':refferal_commission' => $data['txtRefferalCommission']
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
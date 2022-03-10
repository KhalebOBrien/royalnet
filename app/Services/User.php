<?php
namespace App\Services;

use App\Middleware\DatabaseConnetion;

require_once 'app/Middleware/DatabaseConnetion.php';

class User extends DatabaseConnetion
{
	public function __Construct()
	{
        parent::__construct();
	}


    /**
     * This function is used to authenticate users
     * @param  string $email
     * @param  string $password
     * @return boolean
     */
    public function authenticate($email, $password)
    {
        try {
            $sql = "SELECT id, name, email, password FROM users WHERE email = '".$email."'";
            $q = $this->dbconn->query($sql);
            $account = $q->fetch(PDO::FETCH_ASSOC);
    
            if($account && password_verify($password, $account['password'])) {
                $_SESSION['user'] = $account;
                return true;
            }
            
            return false;
        }
        catch (PDOException $e)
        {
            echo ($e->getMessage() . ' ' . $e->getCode() . ' ' . $e->getFile() . ' ' . $e->getLine());
            exit();
        }
    }


    /**
     * This function is used to create new users
     * @param  array $data
     * @return int
     */
    public function create($data)
    {
		try {
            $sql = "INSERT INTO users (surname, other_names, phone, referral_code, referrers_code, email, password, created_at, updated_at) VALUES (:surname, :otherNames, :phone, :referral_code,:referrers_code, :email, :password, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':surname' => $data['txtSurname'],
                ':otherNames' => $data['txtOtherNames'],
                ':phone' => $data['txtPhone'],
                ':referral_code' => $data['referral_code'],
                ':referrers_code' => $data['referrers_code'],
                ':email' => $data['txtEmail'],
                ':password' => $data['txtPassword']
            ));

            return $this->dbconn->lastInsertId();
        }
        catch (PDOException $e)
        {
            echo ($e->getMessage() . ' ' . $e->getCode() . ' ' . $e->getFile() . ' ' . $e->getLine());
            exit();
        }
    }
	
}

?>
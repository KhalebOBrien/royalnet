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
            $sql = "SELECT * FROM users WHERE email = '".$email."'";
            $q = $this->dbconn->query($sql);
            $account = $q->fetch(\PDO::FETCH_ASSOC);
    
            if($account && password_verify($password, $account['password'])) {
                $_SESSION['user'] = $account;
                return true;
            }
            
            return false;
        }
        catch (\PDOException $e)
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
            $sql = "INSERT INTO users (surname, other_names, phone, package, referral_code, referrers_code, email, password, created_at, updated_at) VALUES (:surname, :otherNames, :phone, :package, :referral_code,:referrers_code, :email, :password, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':surname' => $data['txtSurname'],
                ':otherNames' => $data['txtOtherNames'],
                ':phone' => $data['txtPhone'],
                ':package' => $data['slPackage'],
                ':referral_code' => $data['referral_code'],
                ':referrers_code' => $data['referrers_code'],
                ':email' => $data['txtEmail'],
                ':password' => $data['txtPassword']
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
     * This function is used to generate and send reset password token 
     * @param  string $email
     * @return boolean
     */
    public function sendPasswordResetToken($email)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = '".$email."'";
            $q = $this->dbconn->query($sql);
            $account = $q->fetch(\PDO::FETCH_ASSOC);
    
            if($account) {
                // set new token
                $token = Helpers::randomString(6).'-'.Helpers::randomString(24).'-'.Helpers::randomString(6);
                // update user token
                $sql = "UPDATE users SET pwd_reset_token = :token, token_created_at = NOW(), updated_at = NOW() WHERE id = :id";
                $q = $this->dbconn->prepare($sql);
                $q->execute([
                    ':token' => $token,
                    ':id' => $account['id']
                ]);

                // prepare mail
                $subject = 'Password Reset';
                $message = '<b>Hello, '.$account['surname'].'. </b><br> Follow this link to reset your password: <a href="'.Helpers::APPLICATION_DOMAIN.'reset-password?email='.$email.'&token='.$token.'" target="_blank">'.Helpers::APPLICATION_DOMAIN.'reset-password?email='.$email.'&token='.$token.'</a><br> DO NOT SHARE THIS LINK WITH ANYONE. PLEASE, IGNORE THIS EMAIL IF YOU DID NOT REQUEST FOR A PASSWORD RESET.';
                // send mail
                Helpers::sendMail($account['email'], $subject, $message);

                return true;
            }
        }
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to find a user by email
     * @param  string $email
     * @return $user
     */
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = '".$email."'";
        $q = $this->dbconn->query($sql);
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * This function is used to find a user by referral code
     * @param  string $email
     * @return $user
     */
    public function getUserByRefferalCode($code)
    {
        $sql = "SELECT * FROM users WHERE referral_code = '".$code."'";
        $q = $this->dbconn->query($sql);
        $user = $q->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    /**
     * This function is used to find a users referrals
     * @param  string $code
     * @return array $users
     */
    public function getUsersRefferals($code)
    {
        $sql = "SELECT * FROM users WHERE referrers_code = '".$code."'";
        $q = $this->dbconn->query($sql);
        $users = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $users;
    }

    /**
     * This function is used to reset a users password
     * @param  array $account
     * @param  array $data
     */
    public function resetPassword($account, $data)
    {
        try {
            $sql = "UPDATE users SET pwd_reset_token = :token, token_created_at = :token_created_at, password = :password, updated_at = NOW() WHERE id = :id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':token' => null,
                ':token_created_at' => null,
                ':password' => $data['txtPassword'],
                ':id' => $account['id']
            ]);

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
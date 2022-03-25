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
                // unappproved users cannot login
                if (!$account['is_approved']) {
                    $_SESSION['msg'] = "Sorry, you cannot login at this time as your account have not been approved.";
                    return false;
                }
                // suspended users cannot login
                if ($account['is_suspended']) {
                    $_SESSION['msg'] = "Sorry, you have been restricted access to this system.";
                    return false;
                }

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
     * @param array $data
     * @return int
     */
    public function create($data, $isAdmin)
    {
		try {
            $sql = "INSERT INTO users (surname, other_names, phone, package, referral_code, referrers_code, is_admin, is_approved, is_verified, email, password, created_at, updated_at) VALUES (:surname, :otherNames, :phone, :package, :referral_code,:referrers_code, :is_admin, :is_approved, :is_verified, :email, :password, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':surname' => $data['txtSurname'],
                ':otherNames' => $data['txtOtherNames'],
                ':phone' => $data['txtPhone'],
                ':package' => $isAdmin ? null : $data['slPackage'],
                ':referral_code' => $data['referral_code'],
                ':referrers_code' => $data['referrers_code'],
                ':is_admin' => $isAdmin,
                ':is_approved' => $isAdmin ? 1 : 0, 
                ':is_verified' => $isAdmin ? 1 : 0,
                ':email' => $data['txtEmail'],
                ':password' => $data['txtPassword']
            ));
            $userId = $this->dbconn->lastInsertId();
            
            $sql = "INSERT INTO wallets (user_id, amount, created_at, updated_at) VALUES (:user_id, :amount, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':user_id' => $userId,
                ':amount' => '0.00'
            ));

            return $userId;
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
    public function getUserByReferralCode($code)
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
    public function getUsersReferrals($code)
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

    /**
     * This function is used to update a users profile
     * @param  array $account
     * @param  array $data
     * @return boolean
     */
    public function updateProfile($account, $data, $updateType)
    {
        try {
            if($updateType == 'bank'){
                $sql = "UPDATE users SET bank = :bank, acct_number = :acct_number, acct_name = :acct_name, fb_link = :fb_link, ig_link = :ig_link, tw_link = :tw_link, yt_link = :yt_link, updated_at = NOW() WHERE id = :id";
                $q = $this->dbconn->prepare($sql);
                $q->execute([
                    ':bank' => $data['slBank'],
                    ':acct_number' => $data['txtAcctNumber'],
                    ':acct_name' => $data['txtAcctName'],
                    ':fb_link' => $data['txtFbLink'],
                    ':ig_link' => $data['txtIgLink'],
                    ':tw_link' => $data['txtTwLink'],
                    ':yt_link' => $data['txtYtLink'],
                    ':id' => $account['id']
                ]);
            }
            else {
                $sql = "UPDATE users SET surname = :surname, other_names = :other_names, phone = :phone, updated_at = NOW() WHERE id = :id";
                $q = $this->dbconn->prepare($sql);
                $q->execute([
                    ':surname' => $data['txtSurname'],
                    ':other_names' => $data['txtOthernames'],
                    ':phone' => $data['txtPhone'],
                    ':id' => $account['id']
                ]);
            }

            $_SESSION['user'] = $this->getUserByEmail($account['email']);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to delete a user
     * @param  array $account
     * @param  boolean
     */
    public function deleteProfile($account)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
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

    /**
     * This function is used to fetch all admins
     * @return array $admins
     */
    public function getAdmins()
    {
        $sql = "SELECT * FROM users WHERE is_admin = 1 ORDER BY id DESC";
        $q = $this->dbconn->query($sql);
        $admins = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $admins;
    }

    /**
     * This function is used to fetch all non-admins (members)
     * @return array $users
     */
    public function getAllUsers($sumDeposits=false)
    {
        $sql = "SELECT * FROM users WHERE is_admin = 0";
        $q = $this->dbconn->query($sql);
        $users = $q->fetchAll(\PDO::FETCH_ASSOC);

        if ($sumDeposits) {
            $sum = 0;
            if (!empty($users)) {
                foreach ($users as $user) {
                    // get the users package
                    $userPackage = $this->getPackage($user['package']);
                    $sum += intval($userPackage['price']);
                }
            }
            $users['users'] = $users;
            $users['summedDeposits'] = $sum;
        }

        return $users;
    }

    /**
     * This function is used to fetch all unapproved members
     * @return array $users
     */
    public function getUnapprovedUsers($sumDeposits=false)
    {
        $sql = "SELECT * FROM users WHERE is_approved = 0 ORDER BY id DESC";
        $q = $this->dbconn->query($sql);
        $users = $q->fetchAll(\PDO::FETCH_ASSOC);

        if ($sumDeposits) {
            $sum = 0;
            if (!empty($users)) {
                foreach ($users as $user) {
                    // get the users package
                    $userPackage = $this->getPackage($user['package']);
                    $sum += intval($userPackage['price']);
                }
            }
            $users['users'] = $users;
            $users['summedDeposits'] = $sum;
        }

        return $users;
    }

    /**
     * This function is used to fetch all approved members
     * @return array $users
     */
    public function getApprovedUsers($sumDeposits=false)
    {
        $sql = "SELECT * FROM users WHERE is_approved = 1 AND is_admin = 0 ORDER BY id DESC";
        $q = $this->dbconn->query($sql);
        $users = $q->fetchAll(\PDO::FETCH_ASSOC);

        if ($sumDeposits) {
            $sum = 0;
            if (!empty($users)) {
                foreach ($users as $user) {
                    // get the users package
                    $userPackage = $this->getPackage($user['package']);
                    $sum += intval($userPackage['price']);
                }
            }
            $users['users'] = $users;
            $users['summedDeposits'] = $sum;
        }
        
        return $users;
    }

	/**
	 * This function is used to approve a user.
	 * This will lead to crediting the upliner
	 * @return boolean
	 */
    public function approveUser($code)
    {
        try {
            $sql = "UPDATE users SET is_approved = :is_approved, updated_at = NOW() WHERE referral_code = :referral_code";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':is_approved' => 1,
                ':referral_code' => $code
            ]);

            // retrive the parties
            $user = $this->getUserByReferralCode($code);
            $referrer = $this->getUserByReferralCode($user['referrers_code']);
            // credit the upliner
            if (!empty($user['referrers_code']) && !empty($referrer)) {
                // retrive the referrer's package reff commission
                $referrerPackage = $this->getPackage($referrer['package']);
                // retrive the user's package price
                $userPackage = $this->getPackage($user['package']);

                // calculate the commission
                $commission = (intval($referrerPackage['refferal_commission']) * intval($userPackage['price'])) / 100;

                // create referral bonus tranx for the referrer
                $sql = "INSERT INTO transactions (reference_code, user_id, amount, type, is_approved, created_at, updated_at) VALUES (:reference_code, :user_id, :amount, :type, :is_approved, NOW(), NOW())";
                $q = $this->dbconn->prepare($sql);
                $q->execute(array(
                    ':reference_code' => $token = Helpers::randomString(12),
                    ':user_id' => $referrer['id'],
                    ':amount' => $commission,
                    ':type' => 'referral bonus',
                    ':is_approved' => 1
                ));

                // get the referrer's wallet
                $sql = "SELECT amount FROM wallets WHERE user_id = ".$referrer['id'];
                $q = $this->dbconn->query($sql);
                $wallet = $q->fetch(\PDO::FETCH_ASSOC);
                // update the referrer's wallet balance
                $sql = "UPDATE wallets SET amount = :amount, updated_at = NOW() WHERE user_id = :user_id";
                $q = $this->dbconn->prepare($sql);
                $q->execute([
                    ':amount' => intval($wallet['amount']) + $commission,
                    ':user_id' => $referrer['id'],
                ]);
            }
            
            $_SESSION['msg'] = $user['email']." successfully APPROVED.";
            // prepare approval mail for the user
            $subject = 'Account APPROVED!';
            $message = '<b>Hello, '.$user['surname'].'. </b><br>Your account have been approved. You can login to your account by visiting this link: <a href="'.Helpers::APPLICATION_DOMAIN.'login" target="_blank">'.Helpers::APPLICATION_DOMAIN.'login</a><br> PLEASE, IGNORE THIS EMAIL IF YOU DID NOT PERFORM THIS ACTION.';
            // send mail
            Helpers::sendMail($user['email'], $subject, $message);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

	/**
	 * This function is used to suspend a user.
	 * @return boolean
	 */
    public function suspendUser($code)
    {
        try {
            $sql = "UPDATE users SET is_suspended = :is_suspended, updated_at = NOW() WHERE referral_code = :referral_code";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':is_suspended' => 1,
                ':referral_code' => $code
            ]);
            
            $user = $this->getUserByReferralCode($code);
            $_SESSION['msg'] = $user['email']." successfully SUSPENDED.";

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

	/**
	 * This function is used to revive a suspended user.
	 * @return boolean
	 */
    public function reviveUser($code)
    {
        try {
            $sql = "UPDATE users SET is_suspended = :is_suspended, updated_at = NOW() WHERE referral_code = :referral_code";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':is_suspended' => 0,
                ':referral_code' => $code
            ]);
            
            $user = $this->getUserByReferralCode($code);
            $_SESSION['msg'] = $user['email']." successfully REVIVED.";
            // prepare approval mail for the user
            $subject = 'Account REVIVED!';
            $message = '<b>Hello, '.$user['surname'].'. </b><br>Your account have been revived. You can login to your account by visiting this link: <a href="'.Helpers::APPLICATION_DOMAIN.'login" target="_blank">'.Helpers::APPLICATION_DOMAIN.'login</a>';
            // send mail
            Helpers::sendMail($user['email'], $subject, $message);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to retrieve a package by id
     * @return array $package
     */
    private function getPackage($id)
    {
        $sql = "SELECT * FROM packages WHERE id = ".$id;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to fetch accumulated balance of all wallets
     * @return int $total
     */
    public function getTotalUsersAccumulatedBalance()
    {
        $sql = "SELECT SUM(amount) AS total FROM wallets";
        $q = $this->dbconn->query($sql);
        $total = $q->fetch(\PDO::FETCH_ASSOC);

        return $total['total'];
    }

    public function getUserWalletBalance($id)
    {
        $sql = "SELECT amount FROM wallets WHERE user_id = ".$id;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result['amount'];
    }
	
}

?>
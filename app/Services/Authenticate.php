<?php
namespace App\Controllers;

use App\Middleware\DatabaseConnection;

class Authenticate extends DatabaseConnetion {
	var $authenticated = false;

	public function __Construct($email, $password)
	{
		$sql = "SELECT id, name, email, password FROM users WHERE email = '".$email."'";
		$q = $this->dbconn->query($sql);
		$account = $q->fetch(PDO::FETCH_ASSOC);

		if($account && password_verify($password, $account['password'])) {
			$_SESSION['user'] = $account;
			$this->authenticated = true;
		}
	} 
	
	public function IsValid() {
		return $this->authenticated;
	}
}

?>
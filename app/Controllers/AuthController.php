<?php

use App\Services\User;

require_once 'app/Services/Helpers.php';
require_once 'app/Services/User.php';

class AuthController
{
	public $user;
	public function __construct()
	{
		$this->user = new User();
	}

	/**
	 * This function is used to register new users
	 * @param  array $data
	 * @return boolean
	 */
	public function register($data)
	{
		if(isset($data['btnRegister'])){
			if ($_SESSION['CSRF'] !== $data['csrfToken']) {
				session_unset();
				session_destroy();
				header('Location: 419');
			}

			$data['referral_code'] = Helpers::randomString(8);
			$data['txtPassword'] = password_hash($data['txtPassword'], PASSWORD_DEFAULT);

			if ($this->user->create($data)) {
				header('Location: login');
			}
		}

		return null;
	}

	/**
	 * This function is used to login users
	 * @param  array $data
	 * @return boolean
	 */
	public function login($data)
	{
		if(isset($data['btnLogin'])){
			var_dump($data);
			exit;
			if($this->user->authenticate($data['txtEmail'], $data['txtPassword'])){
				echo "welcome";
				exit;

				header('Location: login');
			}
			else {
				echo "get away";
				exit;
			}
		}
		
		return null;
	}
}


?>
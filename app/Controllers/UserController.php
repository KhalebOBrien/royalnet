<?php

use App\Services\User;
use App\Services\Helpers;

require_once 'app/Services/Helpers.php';
require_once 'app/Services/User.php';

class UserController
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
	public function updateAccount($user, $data)
	{
		if(isset($data['btnUpdateAccount'])){
			$this->validateSession($data['csrfToken']);

			if ($this->user->updateProfile($user, $data)) {
				header('Location: my-account');
			}
		}

		return null;
	}

	/**
	 * This function is used to delete an account
	 * @param array $data
	 * @return boolean
	 */
	public function deleteAccount($data)
	{
		if(isset($data['btnDeleteAccount'])){
			$this->validateSession($data['csrfToken']);

			if (!password_verify($data['txtPassword'], $_SESSION['user']['password'])) {
				$_SESSION['error'] = 'Invalid password.';
				return false;
			}

			if ($this->user->deleteProfile($_SESSION['user'])) {
				header('Location: logout');
			}
		}

		return null;
	}

	/**
	 * This function is used to retrieve user refferals
	 * @return array
	 */
	public function fetchUserReferrals()
	{
		return $this->user->getUsersReferrals($_SESSION['user']['referral_code']);
	}

	/**
	 * This function is used to validate user session token
	 * @param string $token
	 */
	private function validateSession($token)
	{
		if ($_SESSION['CSRF'] !== $token) {
			session_unset();
			session_destroy();
			header('Location: 419');
		}
	}


}


?>
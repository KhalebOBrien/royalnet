<?php

use App\Services\User;
use App\Services\Helpers;

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
		if(isset($data['btnRegister'])) {
			$this->validateSession($data['csrfToken']);

			// prevent multiple registration with same email
			if(!empty($this->user->getUserByEmail($data['txtEmail']))) {
				return null;
			}

			$data['referral_code'] = Helpers::randomString(8);
			$data['txtPassword'] = password_hash($data['txtPassword'], PASSWORD_DEFAULT);

			if ($this->user->create($data)) {
				// send email

				$_SESSION['success'] = 'You have successfully registered. Please check your email to activate your account.';
			}
		}

		return null;
	}

	/**
	 * This function is used to login users
	 * @param array $data
	 * @return boolean
	 */
	public function login($data)
	{
		if(isset($data['btnLogin'])){
			$this->validateSession($data['csrfToken']);

			if($this->user->authenticate($data['txtEmail'], $data['txtPassword'])){
				header('Location: dashboard');
			}
			else {
				echo "invalid username or password";
				exit;
			}
		}
		
		return null;
	}

	/**
	 * This function is used to request for password reset token
	 * @param array $data
	 * @return boolean
	 */
	public function passwordResetTokenRequest($data)
	{
		if(isset($_POST['btnSendResetToken'])){
			$this->validateSession($data['csrfToken']);

			if($this->user->sendPasswordResetToken($data['txtEmail'])){
				header('Location: password-reset-link-sent');
			}
		}

		return null;
	}

	/**
	 * This function is used to reset users 
	 * password after the request link have been verified
	 * @param array $data
	 * @return boolean
	 */
	public function passwordReset($data)
	{
		// retrieve user data
		$user = $this->user->getUserByEmail($data['email']);
		if (empty($user) && $user['pwd_reset_token'] !== $data['token']) {
			header('Location: password-reset-link-expired');
		}

		if(isset($_POST['btnResetPassword'])){
			$this->validateSession($data['csrfToken']);

			$data['txtPassword'] = password_hash($data['txtPassword'], PASSWORD_DEFAULT);

			if($this->user->resetPassword($user, $data)){
				header('Location: login');
			}
		}

		return null;
	}

	/**
	 * This function is used to change a logged in users password
	 * @param array $data
	 * @return boolean
	 */
	public function changePassword($data)
	{
		if(isset($_POST['btnChangePassword'])){
			$this->validateSession($data['csrfToken']);

			$data['txtPassword'] = password_hash($data['txtNewPassword'], PASSWORD_DEFAULT);

			if(($data['txtNewPassword'] === $data['txtConfirmNewPassword']) && password_verify($data['txtOldPassword'], $_SESSION['user']['password'])){
				if($this->user->resetPassword($_SESSION['user'], $data)){
					header('Location: dashboard');
				}
			}
		}

		return null;
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
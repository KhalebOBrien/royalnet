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
	 * This function is used to retrieve users referrer
	 * @return array
	 */
	public function fetchUserReferrer($referrersCode)
	{
		return $this->user->getUserByReferralCode($referrersCode);
	}

	/**
	 * This function is used to retrieve admins except users
	 * @return array
	 */
	public function fetchAdmins()
	{
		return $this->user->getAdmins();
	}

	/**
	 * This function is used to retrieve all users except admins
	 * @return array
	 */
	public function fetchAllUsers($sumDeposits=false)
	{
		return $this->user->getAllUsers($sumDeposits);
	}

	/**
	 * This function is used to retrieve all users that have not been approved
	 * @return array
	 */
	public function fetchAllUnapprovedUsers($sumDeposits=false)
	{
		return $this->user->getUnapprovedUsers($sumDeposits);
	}

	/**
	 * This function is used to retrieve all users that have been approved
	 * @return array
	 */
	public function fetchAllApprovedUsers($sumDeposits=false)
	{
		return $this->user->getApprovedUsers($sumDeposits);
	}

	/**
	 * This function is used to register new admin
	 * @param  array $data
	 * @return boolean
	 */
	public function createAdmin($data)
	{
		if(isset($data['btnAddAdmin'])) {
			$this->validateSession($data['csrfToken']);

			// prevent multiple registration with same email
			if(!empty($this->user->getUserByEmail($data['txtEmail']))) {
				return null;
			}

			$data['referral_code'] = Helpers::randomString(8);
			$data['txtPassword'] = password_hash($data['txtPassword'], PASSWORD_DEFAULT);

			if ($this->user->create($data, 1)) {
				// send email
				header('location: manage-admins');
				// $_SESSION['msg'] = 'You have successfully registered. Please check your email to activate your account.';
			}
		}

		return null;
	}

	/**
	 * This function is used to approve a user.
	 * This will lead to crediting the upliner
	 * @return boolean
	 */
	public function approveUser()
	{
		if(isset($_GET['approve'])) {
			if ($this->user->approveUser($_GET['approve'])) {
				header('location: '.$_GET['back']);
			}
		}

		return null;
	}

	/**
     * This function is used to fetch accumulated balance of all wallets
     * @return int
	 */
	public function getAccumulatedWorth()
	{
		return $this->user->getTotalUsersAccumulatedBalance();
	}

	/**
	 * This function is used to fetch the wallet balance of the current user
	 * @return int
	 */
	public function fetchUserWalletBalance()
	{
		return $this->user->getUserWalletBalance($_SESSION['user']['id']);
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
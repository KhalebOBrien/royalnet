<?php
require_once 'app/Controllers/BaseController.php';

class AuthController extends BaseController
{

	public function __construct()
	{

	}

	public function register($data)
	{
		if(isset($data['btnRegister'])){
			var_dump($data);
			exit;
		}

		return null;
	}

	public function login($data)
	{
		if(isset($data['btnLogin'])){
			var_dump($data);
			exit;
		}
		
		return null;
	}
}


?>
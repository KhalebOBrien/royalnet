<?php
use App\Services\Authenticate;

if(isset($_POST['txtEmail']))
{
	$email = $_POST['txtEmail'];
	$password = $_POST['txtPassword'];
	
	$auth = new Authenticate($email, $password);

	if($auth->IsValid()){
		header("Location: ./application/cocWa4bRcKd5ePf1gCh2i?".mt_rand(10000000000,10000000000000));
	}
}


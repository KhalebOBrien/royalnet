<?php

class Helpers {

    public function __construct()
	{}

    /**
	 * This function generates random tokens using md5 encryption
	 */
	public static function generateRandomToken()
	{
		return md5(uniqid(rand(), true));
	}
    

	/**
	 * This function generates random string
	 */
	public static function randomString($length_of_string)
	{
		$str_result = '23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz';

		return substr(str_shuffle($str_result), 0, $length_of_string); 
	}
}
?>
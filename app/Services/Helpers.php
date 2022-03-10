<?php
namespace App\Services;

class Helpers
{
	#application variables
	#{
		const APPLICATION_TITLE 		= 	'Royalnet';
		const APPLICATION_NAME			=	'Royal Network';
		const APPLICATION_DOMAIN		=	'https://royalnet.com.ng/';
        const APPLICATION_MAIL	        =	'info@royalnet.com.ng';
		
	#}

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

    /**
     * This function sends an email 
     */
    public static function sendMail($to, $subject, $message)
	{
		$headers	= "MIME-Version: 1.0" . "\r\n";
		$headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers   .= 'Reply-To: '. Helpers::APPLICATION_MAIL . "\r\n";
		$headers   .= 'From: <'.Helpers::APPLICATION_MAIL.'>' . "\r\n";
		$headers   .= 'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}
}
?>
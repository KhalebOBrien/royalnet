<?php
namespace App\Middleware;

Class DatabaseConnetion {
	public $dbconn;

	public function __Construct()
	{
		// local
	    $dbhost = "royalnet";
	    $dbname = "royalnet";
	    $dbuser = "root";
	    $dbpass = "";
	    // live
	    // $dbhost = "";
	    // $dbname = "";
	    // $dbuser = "";
	    // $dbpass = "";
		
		try {
			$this->dbconn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		    $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Invalid Credentials ".$e->getMessage();
			$e_msg = 'e';
			header("location: ../500?$e_msg");
		}
		return true;
	}
}	
?>
<?php
    require_once './app/Services/Helpers.php';
    session_start();
    session_destroy();
    session_start();
	if(isset($_SESSION['user'])) {
		header("location: ./dashboard");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= Helpers::APPLICATION_TITLE ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="icon" href="/images/logo.png">
</head>
<script type="text/javascript">
	
	window.localStorage.clear();
	
	setTimeout(function()
	{
		window.location = 'login';
		
	}, 200);
</script>
<body>

</body>
</html>
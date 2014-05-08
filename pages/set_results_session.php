<?php
	session_start();
	
	if(isset($_POST['session']) AND $_POST['session'] != '' )
	{
		$_SESSION['results_session'] = $_POST['session'];
		echo "ok";
	}
	else
	{
		echo "error";
	}
?>
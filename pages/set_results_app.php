<?php
	session_start();
	
	if(isset($_POST['app']) AND $_POST['app'] != '' )
	{
		$_SESSION['results_app'] = $_POST['app'];
		$app_id = $_SESSION['results_app'];
		
		require('connection_imagine_reviews.php');
				
		//Look for the apps name:
				
		$result = mysql_query(" select *										
								from tblApp
								where idApp = '$app_id' ", $db);
				
		//check that at least one row was returned
		$rowCheck = mysql_num_rows($result);
	
		if(!($rowCheck == 0))
		{
			$row = mysql_fetch_array($result);
			$_SESSION['results_app_name'] = $row['AppName'];
			echo "ok";
		}
	}
	else
	{
		echo "error";
	}
?>
<?php

session_start();

$app_name = $_SESSION['app_name'];
unset($_SESSION['app_name']);

require('connection_imagine_reviews.php');

// Lookup app id
$result = mysql_query("select * from tblApp where AppName = '$app_name' ", $db);

// Check that something returned
$rowCheck = mysql_num_rows($result);
if(!($rowCheck == 0))
{
	// Set app-id var
	$row = mysql_fetch_array($result) ;
	$app_id = $row['idApp'];
	//$_SESSION['app_id'] = $app_id;
	
	// NOW Check if the (admin-)user-app relation already exists
	$admin_user_link_id = $_SESSION['admin_user_rlt_id'];

	$result2 = mysql_query("select * from tblLinkUserApp where (idLinkAdminUser = '$admin_user_link_id' AND idApp = '$app_id')", $db);
	
	// If nothing returned...
	$rowCheck2 = mysql_num_rows($result2);
	if($rowCheck2 == 0)
	{
		// Create the (admin-)user-app relation		
		mysql_query("insert into tblLinkUserApp (idLinkAdminUser, idApp) values ('$admin_user_link_id', '$app_id')", $db);
	}

	// Get the id for the (admin-)user-app relationship
	$result3 = mysql_query("select * from tblLinkUserApp where (idLinkAdminUser = '$admin_user_link_id' AND idApp = '$app_id')", $db);
	
	// Check that something returned and 
	$rowCheck3 = mysql_num_rows($result3);
	if(!($rowCheck3 == 0))
	{
		$row3 = mysql_fetch_array($result3) ;
		$user_app_link_id = $row3['idLinkUserApp'];
		$_SESSION['user_app_link_id'] = $user_app_link_id;
	}
	else
	{
		echo "Error no dmin user app relation.";	
	}
}
else
{
	echo "Error no app with such name.";	
	// This error shouldn't happen
} // no app with that name in DB

?>
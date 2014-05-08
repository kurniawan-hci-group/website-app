<?PHP

	//session_start(); 
	
	//The user must have come to this page after selecting test mode
	//require("check_test_mode.php");

/*
connection.php

Description:
After the user logs in 
First, the variables to connect to the datbase are set.
Second, it connects to the database.

*/
	
	//Set the database connection variables
	
	//Host
	$dbHost = 'db-01.soe.ucsc.edu';

	//User Name
	$dbUser = 'imagine_reviews';

	//Psswrd
	$dbPass = 'RJNGbxVh47yySkc6';

	//Database name
	$dbDatabase = 'imagine_reviews';
	
	//Connect to the database

	$db = mysql_connect("$dbHost", "$dbUser", "$dbPass");
	if (!$db)
	{ 
		echo "MySQL error." ;
		die ('Error connecting to database.' . mysql_error());
	}
	
	mysql_select_db("$dbDatabase", $db) or die ("Couldn't select the database." . mysql_error());
	
?>
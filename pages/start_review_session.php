<?php

// Save session info
session_start();

if( isset($_SESSION['test_mode']) AND $_SESSION['test_mode'] == TRUE )
{
	// Get date and time and save it as the Session Start Time (type DateTime)
	$start_time = date( 'Y-m-d H:i:s', time() );
	
	$user_app_link_id = $_SESSION['user_app_link_id'];
	
	require('connection_imagine_reviews.php');
	
	mysql_query("insert into tblSession (idLinkUserApp, StartDateTime) values ('$user_app_link_id', '$start_time')", $db);
	
	// Lookup session id and save it: [For storing results later]
	$result = mysql_query("select * from tblSession where (StartDateTime = '$start_time' AND idLinkUserApp = '$user_app_link_id')", $db);
	
	// Check that something returned
	$rowCheck = mysql_num_rows($result);
	if(!($rowCheck == 0))
	{
		$row = mysql_fetch_array($result) ;
		$_SESSION['session_id'] = $row['idSession'];
		//echo "done";
	}
	//else
	//{
		//Error - insertion failed!!!!
		//echo "alert(\"Failed to insert session info\");";	
	//}
}
//else
//{
	//echo "done";
//}

?>
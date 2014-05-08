<?php

	session_start(); 
	//require('sessionvalid_imagine_reviews.php'); 
	
	// Make sure the page is being called from the select user form and that the
	// UserNumber is valid
	if( !isset($_POST['user']) || $_POST['user'] == '' )
	{
		//header("Location: select_register_user.php");
		echo "no_selection";
	}
	else
	{
		require('connection_imagine_reviews.php');
		
		//Get info - user id and admin-user-relation id
		
		$user = $_POST['user'];

		$result = mysql_query("select * from tblUser where UserNumber = '$user' ", $db);
		
		$rowCheck = mysql_num_rows($result);
	
		if(!($rowCheck == 0))
		{
			
			//$_SESSION['user_selected'] = TRUE;
			$_SESSION['user'] = $user ;
			
			$row = mysql_fetch_array($result) ;
			
			$user_id = $row['idUser'];
			$_SESSION['id_user'] = $user_id;
			
			$admin_id = $_SESSION['id_admin'];
			
			// Get the user-admin-relation id
			$result2 = mysql_query("select * from tblLinkAdminUser where (idAdmin = $admin_id AND idUser = $user_id) ", $db);
	
			// Check that at least one row was returned
			$rowCheck2 = mysql_num_rows($result2);
			
			if(!($rowCheck2 == 0)) //If user-admin relation insertion successful
			{
				
				$row = mysql_fetch_array($result2) ;
				$_SESSION['admin_user_rlt_id'] = $row['idLinkAdminUser'] ;

				// User selection successful
				//$_SESSION['user_selected'] = TRUE;
				
				// Redirect the user to the test mode page 		
				//header("Location: test_mode.php");
				echo "lookup_ok";

			}
			//else - ERROR - No user-admin relation
		}
		// else - ERROR - No user with that UserNumber...	

	}// end of else - UserNumber set and valid
	
?>
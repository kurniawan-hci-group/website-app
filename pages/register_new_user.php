<?php

	session_start(); 
	//require('sessionvalid_imagine_reviews.php'); 

	//USER INFO
	// The UserNumber must be alpha numeric text fields (min 6 char max 25 char)
	
	//Check that the user is calling the page from the New User form 
	// (i.e., UserNumber must be set to something) and that the UserNumber entered 
	// is valid - made up of 6 to 12 alphanumeric 
	// $_POST['user'] == '' || 
	if( !isset($_POST['new_user']) || $_POST['new_user'] == '' || strlen($_POST['new_user']) < 6 || !ctype_alnum($_POST['new_user']) )
	{
		//session_register('userNumber_error');
		$_SESSION['UserNumber_error'] = TRUE;
		//echo "UserNumber not set." ;
		//header ("Location: new_user.php");
		echo "invalid_user_number";
	}
	else
	{
	
		require('connection_imagine_reviews.php');

		// If the admin was NOT redirected here because of file error
		// (i.e., if the new user hasn't been registered),
		// register user
		if(!isset($_SESSION['new_user_registered']))
		{
							
			// CHECK if UserNumber is taken
			
			//Check if the user name already exists	
			$new_user = $_POST['new_user'];
			
			// Check if there's a user with that User Number
			$result = mysql_query("select * from tblUser where UserNumber = '$new_user' ", $db);
			
			// Check, if at least one row was returned, it is taken
			$rowCheck = mysql_num_rows($result);
			if(!($rowCheck == 0)) //UserNumber is already in use
			{
				$_SESSION['UserNumber_taken'] = TRUE ;
				//header ("Location: new_user.php");
				echo "user_number_taken";
			}
			else // the number is not in use
			{	
				// INSERT NEW USER
				
				mysql_query("insert into tblUser (UserNumber) values ('$new_user')", $db);
	
				// Check that it was successful and get the id of the new user
				$result = mysql_query("select * from tblUser where UserNumber = '$new_user' ", $db);
				
				// Check that at least one row was returned
				$rowCheck = mysql_num_rows($result);
				if(!($rowCheck == 0)) //If user insertion successful
				{
	
					$row = mysql_fetch_array($result) ;
					$new_user_id = $row['idUser'];
					$_SESSION['new_user_registered'] = $new_user;
					
					$admin_id = $_SESSION['id_admin'];
					
					// Create AdminUser relation
					mysql_query("insert into tblLinkAdminUser (idAdmin,idUser) values ($admin_id,$new_user_id)", $db);
					
					// Check that it was successful
					$result2 = mysql_query("select * from tblLinkAdminUser where (idAdmin = $admin_id AND idUser = $new_user_id) ", $db);
			
					// Check that at least one row was returned
					$rowCheck2 = mysql_num_rows($result2);
					
					if($rowCheck2 == 0) //If user-admin relation insertion successful
					{
						$_SESSION['registration_error'] = TRUE ;
						
						// Delete the record and ask the user to try again
						mysql_query("delete from tblUser where UserNumber = '$new_user'", $db);
						
						unset($_SESSION['new_user_registered']);
					
						//header("Location: new_user.php");
						echo "registration_error";
						//echo "Nothing returned from query. User-Admin relation insertion failed.";

					}			
							
				}//end of if user insertion success	
							
				else //If user insertion unsuccessful
				{
					
					$_SESSION['registration_error'] = TRUE ;
																			
					//header("Location: new_user.php");
					echo "registration_error";
					//echo "Nothing returned from query. User insertion failed.";
				}
				
				// Now check if files were uploaded...
		
				//Check if any files were uploaded 
				if( isset($_SESSION['new_user_registered']) 
					&& isset($_FILES) 
					&& !empty($_FILES) 
					&& !empty($_FILES['files']) )
				{	
					//Code to upload reinforcers
					//...
					//Upload error
					//$_SESSION['upload_error'] = TRUE;
					//echo "upload_error";
					//...
					//If upload successful
					//unset($_SESSION['new_user_registered']);
					//echo "registration_ok";
				}
				else // $_FILES not set or empty, DONE!
				{
					//echo "No uploads...";
					unset($_SESSION['new_user_registered']);
					//header( "Location: select_register_user.php");
					echo "registration_ok";
				}
			
			}//end of else - UserNumber isn't in use
		
		}//end of if $_SESSION['new_user_id'] is NOT set - REGISTER NEW USER
		
	}// the user is calling this from the new user form
		
	

?>
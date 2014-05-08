<?PHP

	session_start();
	
	//The user must have come to this page after selecting test mode
	//require("check_test_mode.php");
	
	//If logged in - the person shouldn't be here
	//require("check_session.php");

	//Check that the necessary vars are set - this is being called from the login form
	if( $_POST['admin'] == '' OR $_POST['password'] == '')
	{
		$_SESSION['empty_adminNumber_or_password'] = TRUE;
		echo "empty_field";
		//header ("Location: login_imagine_reviews.php");
		
	}
	//elseif(!ctype_alnum($_POST['admin']) OR !ctype_alnum($_POST['password']))
	//{
	//	$_SESSION['invalid_adminNumber_or_password'] = TRUE;
	//	echo "invalid";
	//	header ("Location: login_imagine_reviews.php");
	//}
	else 
	{
		
		$admin = $_POST['admin'];
		$pass = $_POST['password'];
		//$_POST['admin'] = "";
		//$_POST['password'] = "";
		//$pass = sha1($pass) ;
	
		require('connection_imagine_reviews.php');
	
		$result = mysql_query("select * from tblAdmin where AdminNumber = '$admin' AND Password = '$pass'", $db);
			
		//check that at least one row was returned
		$rowCheck = mysql_num_rows($result);
	
		if(!($rowCheck == 0))
		{
			$row = mysql_fetch_array($result);
			
			//start the session and register a variable
			
			//session_start();
				
			//session_register('admin');
			$_SESSION['admin'] = $admin ;
				
			//session_register('id_admin');
			$_SESSION['id_admin'] = $row["idAdmin"];
			
			//session_register('admin_user');
			$_SESSION['admin_user'] = TRUE;
			
			if(isset($_SESSION['back']) AND ($_SESSION['back'] == TRUE))
			{
				unset($_SESSION['back']);
				echo "back_from_review";
				//header("Location: test_mode.php");
				
			}
			else
			{
				echo "login_ok";
				//header("Location: select_register_user.php");
			}
						
		}//end of if
		
		else 
		{
			//if nothing is returned by the query, unsuccessful login code goes here...
			//echo "Nothing returned from query";
			$_SESSION['Login_error'] = TRUE ;
			echo "login_fail";
			//header ("Location: login_imagine_reviews.php");
			
		}
		
	}//end of else - $_POST[admin and password] are set


?>
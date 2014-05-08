<div id="content"> 

	<div id="topdiv">
        <div id="imaginelogo">
            <a href="http://www.imaginecolorado.org/">
                <img id="logo" src="content/ImagineLogo.png" alt=" " />
            </a>
        </div>
        <div id="toprightnav">
             <div id="reviews_mode">
                REVIEWS</div>
             <div id="mode_test">
                TEST MODE</div>
        </div>
	</div>
	
	<div id="main">
	 
	 	<div id="mainleft">
        </div>
	 	
	 	<div id="mainmid">
	 	 
	 	 	<div id="midheadertext">
                LOG IN</div>
                
            <div id="errortext">
				<?php 
				
					//Check if user was redirected because of a login error
					session_start();
					
					// If incorrect password/Admin Number
					if(isset($_SESSION['Login_error']) AND $_SESSION['Login_error'] == TRUE )
					{
						echo "Incorrect Admin Number or Password." ;
						unset($_SESSION['Login_error']);
					}
					// If empty fields
					else if(isset($_SESSION['empty_adminNumber_or_password']) AND $_SESSION['empty_adminNumber_or_password'] == TRUE )
					{
						echo "Required fields: Admin Number and Password.";
						unset($_SESSION['empty_adminNumber_or_password']);
					}
			
				?>
			</div>
			
			<div id="loginbox">
				
				<form id="form1">		
					<label for="name">Admin Number:</label>
					<input type="text" id="admin" name="admin" size="12" maxlength="12" 
					value="<?php
						if(isset($_SESSION['back']) AND ($_SESSION['back'] == TRUE)
						AND isset($_SESSION['admin']) AND ($_SESSION['admin'] != ''))
						{
							echo $_SESSION['admin'];
						}
					?>"/><br />
					
					<label for="password">Password:</label><input type="password" id="password" name="password" size="12" maxlength="12" /><br />
					
					<label>&nbsp;</label>
					<input type="submit" id="login" value="Submit" name="login" class="button" />
						
				</form>  
				
			</div>
			
			<div id="midtext">
       			<a href="mailto:aandrews@imaginecolorado.org?Subject=Forgot%20Admin%20Number%20or%20Password" target="_top" style="font-size: 18px;">
				Forgot Admin Number or Password?</a>
            </div>
            
            <div id="btm">
				<a href="index.php">
				<div id="homebutton">
					HOME
				</div>
				</a>
    		</div>
			
	 	</div>
	 	 
	 	<div id="mainright">
        </div>
	 	 
	</div>

</div>


<script type="text/javascript"> 	
	//Reference: Working with Ajax, PHP and MySQL
	//Link: http://www.w3resource.com/ajax/working-with-PHP-and-MySQL.php
	
	$("#content #main #mainmid #loginbox #form1 #login").click(function()
	{
		//alert('Working!');
		var admin = document.getElementById("admin").value;  
		var password = document.getElementById("password").value;	
		
		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		var data = "admin=" + admin + "&password=" + password;  
		xhr.open("POST", "pages/session_imagine_reviews.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);
		xhr.onreadystatechange = check_log_in;  
		function check_log_in() 
		{  
			if (xhr.readyState == 4)
			{  
				if (xhr.status == 200) 
				{
					//$('#content').load('pages/select_register_user.php');
					//document.getElementById("suggestion").innerHTML = xhr.responseText;
					//alert(xhr.responseText);
					if(xhr.response == "login_ok")
					{
						$('#content').load('pages/select_register_user.php');
					}
					else if(xhr.response == "login_fail")
					{
						//alert("Incorrect Admin Number or Password. Please try again.");
						$('#content').load('pages/login.php');
					}
					else if(xhr.response == "empty_field")
					{
						//alert("Required fields: Admin Number and Password. Please try again.");
						$('#content').load('pages/login.php');
					}
					else if(xhr.response == "back_from_review")
					{
						$('#content').load('pages/test_mode.php');
					}
					else if(xhr.response == "invalid")
					{
						$('#content').load('pages/login.php');
					}
					else
					{
						alert("An unknown error occurred. Please try again.");
						$('#content').load('pages/login.php');
					}	
				}
			} 
			else 
			{  
				//$('#content').load('pages/login.php');
				//alert('There was a problem with the request.');  
			}  
		}
		return false;
	});
	
	$('#content #main #mainmid #btm a').click(function()
		{
			$('#content').load('pages/index.php');
			return false;
	});

</script>


       		
       		



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
     
     	<div id="mainleft"></div>
     	
     	<div id="mainmid">
     		
     		<div id="errortext">
            	<?php 
					session_start();
					if(isset($_SESSION['UserNumber_error']) AND $_SESSION['UserNumber_error'] == TRUE )
					{
						echo "Required field. 6 to 12 alphanumeric characters." ;
						unset($_SESSION['UserNumber_error']);
					}
					else if(isset($_SESSION['UserNumber_taken']) AND $_SESSION['UserNumber_taken'] == TRUE )
					{
						echo "The User Number you entered is already in use. Please enter a different one." ;
						unset($_SESSION['UserNumber_taken']);
					}
					else if(isset($_SESSION['registration_error']) AND $_SESSION['registration_error'] == TRUE )
					{
						echo "Sorry. Database error. Please try again." ;
						unset($_SESSION['registration_error']);
					}
					//else if(isset($_SESSION['upload_error']) AND $_SESSION['upload_error'] == TRUE )
// 					{
// 						echo "Sorry. There was a problem uploading the files. Please try again." ;
// 						unset($_SESSION['upload_error']);
// 					}
				?>
            </div>
        		
            <div id="midtext">
				<div id="midtext2_user">	
					Please enter a User Number with 6 to 12 characters (letters and/or numbers only).
				</div>
			</div>
				
			<form id="NewUser" enctype="multipart/form-data">
				<input type="text" id="new_user" name="new_user" size="12" maxlength="12" style="font-size: 20px; height: 20px; width: 200px;" 
				value="<?php 
							
							// If there was an error uploading any of the files but the new user
							// was registered - populate field
							
							session_start();
							if(isset($_SESSION['new_user_registered']))
							{
								echo $_SESSION['new_user_registered'] ;
							}
							
						?>"/>
				<input type="submit" value="Submit" id="submit" name="submit" class="button" style="font-size: 22px;"/>
			</form>
     	
     		<div id="btm_user" style="padding-top:200px;">
				<div id="homebutton">
				<a href="select_register_user.php">Cancel</a>
				</div>
    		</div>
     		
     	</div>
     	
     	 <div id="mainright">
        	<div class="navtext">
            	Logged in as: <span id="adminid"><?php echo $_SESSION['admin']; ?></span>
            </div>
        </div>
     	
     </div>

</div>

<script type="text/javascript"> 
	
	$('#content #main #mainmid #btm_user #homebutton a').click(function()
		{
			$('#content').load('pages/select_register_user.php');
			return false;
	});
	
	$("#content #main #mainmid #NewUser #submit").click(function()
	{
		//alert('Working!');
		var new_user = document.getElementById("new_user").value;  
		
		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		var data = "new_user=" + new_user;  
		xhr.open("POST", "pages/register_new_user.php", true);   
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
					if(xhr.response == "registration_ok")
					{
						$('#content').load('pages/select_register_user.php');
					}
					else if(xhr.response == "user_number_taken")
					{
						$('#content').load('pages/new_user.php');
					}
					else if(xhr.response == "invalid_user_number")
					{
						$('#content').load('pages/new_user.php');
					}
					else if(xhr.response == "registration_error")
					{
						$('#content').load('pages/new_user.php');
					}
					//else if(xhr.response == "upload_error")
					//{
					//	$('#content').load('pages/new_user.php');
					//}
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
	
</script>
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
        
        	<div id="select_user">
	
				<?php 
						
				session_start();
				
				$admin_id = $_SESSION['id_admin'];
			
				require('connection_imagine_reviews.php');
				
				$result = mysql_query("select tblUser.UserNumber 
									   from tblUser 
									   right join (tblAdmin right join tblLinkAdminUser 
												   on tblAdmin.idAdmin=tblLinkAdminUser.idAdmin ) 
												   on tblUser.idUser=tblLinkAdminUser.idUser 
												   WHERE tblAdmin.idAdmin= '$admin_id'", $db);
			
				//check that at least one row was returned
			
				$rowCheck = mysql_num_rows($result);
			
				if(!($rowCheck == 0))
				{
				?>
					
					<div id="midtext2_user">
					Please select the user for which you wish to collect data:</div>
				
					<div id="midtext">
					&nbsp;</div>
		
					<form id="drop_down">
						<select id="user" name="user" style="font-size: 20px; line-height: 1;">
						<option value="" selected="selected"></option>
						
						<?php
						while($row = mysql_fetch_array($result))
						{
								
								$user = $row['UserNumber'];
								?>
								<option value= '<?php echo $user ;?>' > <?php echo $user ; ?> </option>
								<?php
						}
						
						?>
						</select>
						<INPUT TYPE="submit" id="submit" value = "Select" name="submit" style="font-size: 20px;"/>
					</form>
					
					<div id="midtext">
                 	&nbsp;</div>
                 	
                 	<div id="midtext3_sel_reg_user">- or -</div>
					
					<div id="midtext">
                 	&nbsp;</div>
					
					<div id="midtext2_user">
                	Register a new user:</div>
					
				<?php						
				}//end of if
				
				else 
				{
				?>
					<div id="midtext2_user">
                	You do not have permission to any user accounts. 
                	Please register a new user:
                	</div>
				<?php
				}	
				?>
		
			</div>
        	
        	<div id="btm_user">
            	<a href="new_user.php">
            	<div id="userbutton">
            		New User
            	</div>
            	</a>
    		</div>
        
    	</div>
    	
    	 <div id="mainright">
        	<div class="navtext">
            	Logged in as: <span id="adminid"><?php echo $_SESSION['admin']; ?></span>
            </div>
            <a href="logout_imagine_reviews.php">[Sign Out]</a>
        </div>
        
    </div>
	
</div>

<script type="text/javascript"> 	
	
	$('#content #main #mainright a').click(function()
	{
		$('#content').load('pages/index.php');
		return false;
	});
	
	$('#content #main #mainmid #btm_user a').click(function()
	{
		$('#content').load('pages/new_user.php');
		return false;
	});
	
	$("#content #main #mainmid #select_user #drop_down #submit").click(function()
	{
	
		var user = document.getElementById("user").value;
		//alert(user);
	
		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		var data = "user=" + user;  
		xhr.open("POST", "pages/user_info.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);
		xhr.onreadystatechange = lookup_user;  
		function lookup_user() 
		{  
			if (xhr.readyState == 4)
			{  
				if (xhr.status == 200) 
				{
					//$('#content').load('pages/select_register_user.php');
					//document.getElementById("suggestion").innerHTML = xhr.responseText;
					//alert(xhr.responseText);
					if(xhr.responseText == "lookup_ok")
					{
						$('#content').load('pages/test_mode.php');
					}
					else if(xhr.responseText == "no_selection")
					{
						alert("Please make a selection.");
					}
					else
					{
						alert("An unknown error occurred. Please try again.");
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
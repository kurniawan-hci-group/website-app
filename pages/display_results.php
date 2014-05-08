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
	 
	 	<?php
			session_start();
			unset($_SESSION['results_app']);
			unset($_SESSION['results_app_name']);
			unset($_SESSION['results_session']);
		?>
	 	
	 	<div id="mainleft">
	 		
             <div id="edit_user" class="navtext" style="font-size: 26px;">
                User: <span id="userid"><?php echo $_SESSION['user']; ?> </span>
                <a href="select_register_user.php"> [Edit] </a>
            </div>
        	        
        	<div id="back" class="navtext" style="padding: 30px;">
        	<a href="test_mode.php" style="font-size: 26px;">Reviews Page</a>
        		<div class="link_info" style="font-size: 20px; color: #8F8F8F; font-weight: normal;"> 
	 				Go back to the Reviews Page.
	 			</div>
        	</div>
        		    
        </div>
	 	
	 	<div id="mainmid">
	 	
	 		 <div id="midheadertext">
                RESULTS
            </div>
           
            <div id="select_app">
	
				<?php 
						
				session_start();
				$user_id = $_SESSION['id_user'];
			
				require('connection_imagine_reviews.php');
				
				//Look for reviews the user has results for!
				
				$result = mysql_query(" select *
										from tblApp
										where idApp in (select idApp
														from tblLinkUserApp
														where idLinkUserApp in (select idLinkUserApp
																				from tblSession
																				where idSession in (select idSession
																									from tblResults
																									where idSession in (select idSession
																														from tblSession
																														where idLinkUserApp in (select idLinkUserApp
																																				from tblLinkUserApp
																																				where idLinkAdminUser in (	select idLinkAdminUser
																																											from tblLinkAdminUser
																																											where idUser='$user_id' ))))))", $db);
				
				//check that at least one row was returned
				$rowCheck = mysql_num_rows($result);
			
				if(!($rowCheck == 0))
				{
				?>
					
					 <div id="midtext">
                		Please select a review for which you wish to see results:
            		</div>
				
					<form id="drop_down">
						<select id="app" name="app" style="font-size: 20px; line-height: 1;">
						<option value="" selected="selected"></option>
						
						<?php
						while($row = mysql_fetch_array($result))
						{
								
								$app_name = $row['AppName'];
								$app_id = $row['idApp'];
								?>
								<option value= '<?php echo $app_id ;?>' > <?php echo $app_name ; ?> </option>
								<?php
						}
						
						?>
						</select>
						<INPUT TYPE="submit" id="submit" value = "Select" name="submit" style="font-size: 20px;"/>
					</form>
					
				<?php						
				}//end of if
				else
				{
				?>
					 <div id="midtext">
                		Sorry this user doesn't have any results saved for any of the reviews.
            		</div>
            	<?php
				}
				?>

			</div>
	 		
	 		<div id="select_session" style="padding: 20px;">
			</div>
		
			<div id="session_results" style="padding: 20px;">
			</div>
	 		
	 	</div>
	 	
		<div id="mainright">
            <div class="navtext">
            	Logged in as: <span id="adminid"><?php echo $_SESSION['admin']; ?></span>
            </div> 
            <a href="logout_imagine_reviews.php">[Sign Out]</a>
        </div>	 	

</div>

<script type="text/javascript"> 	
	
	$('#content #main #mainleft #edit_user a').click(function(){
		$('#content').load('pages/select_register_user.php');
		return false;
	});
	
	$('#content #main #mainleft #back a').click(function(){
		$('#content').load('pages/test_mode.php');
		return false;
	});
	
	$('#content #main #mainright a').click(function(){
		$('#content').load('pages/index.php');
		return false;
	});
	
	$("#content #main #mainmid #select_app #drop_down #submit").click(function(){
	
		$('#content #main #mainmid #session_results').hide();
		//$('#content #main #mainmid #session_results').style.display = 'none';
		
		var app = document.getElementById("app").value;
		
		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		var data = "app=" + app;  
		xhr.open("POST", "pages/set_results_app.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);
		xhr.onreadystatechange = set_app;  
		function set_app(){  
			if (xhr.readyState == 4)
			{  
				if (xhr.status == 200) 
				{
					if(xhr.responseText == "ok")
					{
						//if hidden show
						//alert("Select Session");
						$('#content #main #mainmid #select_session').load('pages/select_session.php');
						//else reload content
					}
					else
					{
						alert("An unknown error occurred. Please select the app again.");
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
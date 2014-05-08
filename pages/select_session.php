<?php 
						
	session_start();
	
	$app_id = $_SESSION['results_app'];

	require('connection_imagine_reviews.php');
	
	//Look for the sessions for which the user has results saved	
	$result = mysql_query(" select *
							from tblSession
							where idSession in (select idSession
												from tblResults
												where idSession in (select idSession
																	from tblSession
																	where idLinkUserApp in (select idLinkUserApp
																							from tblLinkUserApp
																							where idApp='$app_id')))", $db);
	
	//check that at least one row was returned

	$rowCheck = mysql_num_rows($result);

	if(!($rowCheck == 0)){
	?>
		
		 <div id="midtext">
			Please select a session (shown by start date and time) for which you wish to see results:
		</div>
	
		<form id="drop_down_2">
			
			<select id="session" name="session" style="font-size: 20px; line-height: 1;">
			<option value="" selected="selected"></option>
			
			<?php
			while($row = mysql_fetch_array($result))
			{	
				$session_date = $row['StartDateTime'];
					
				$session_id = $row['idSession'];
				?>
				<option value= '<?php echo $session_id;?>' > <?php echo $session_date ; ?> </option>
				<?php
			}
			
			?>
			</select>
			<INPUT TYPE="submit" id="submit_2" value = "Select" name="submit" style="font-size: 20px;"/>
		</form>
	<?php						
	}//end of if
?>

<script type="text/javascript"> 	
	
	$("#content #main #mainmid #select_session #drop_down_2 #submit_2").click(function(){
	
		var session = document.getElementById("session").value;
		
		//alert("session = " + session);
		
		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		var data = "session=" + session;
		xhr.open("POST", "pages/set_results_session.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);
		xhr.onreadystatechange = set_session;  
		function set_session() 
		{  
			if (xhr.readyState == 4)
			{  
				if (xhr.status == 200) 
				{
					if(xhr.responseText == "ok")
					{
						//alert("Session selected");
						$('#content #main #mainmid #session_results').show();
						$('#content #main #mainmid #session_results').load('pages/session_results.php');
					}
					else
					{
						alert("An unknown error occurred. Please select the session again.");
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
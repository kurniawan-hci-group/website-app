<div id="content">
		
	<?php
		session_start();
		//if session is set	- unset
		if(isset($_SESSION['admin_user']) AND isset($_SESSION['test_mode']))
		{
			//session variable is registered, the user is ready to logout
			
			unset($_SESSION);
			session_destroy();
		}
	?>
	
	<div id="topdiv">
		<div id="imaginelogo">
			<a href="http://www.imaginecolorado.org/">
				<img id="logo" src="content/ImagineLogo.png" alt=" " />
			</a>
		</div>
		<p id="reviews">
			REVIEWS
		</p>
	</div>
		
	<div id="mainlocation">
		<p id="maintext">
			HOME</p>
	</div>
		
	<div id="infobox">
		<div id="lbracket">
			<img class="curly" src="content/lcurly.png" alt=" " />
		</div>
		<div id="infotext">
			This website provides reviews on numbers, letters (uppercase and lowercase), shapes,
			colors, money, and money addition.</div>
		<div id="rbracket">
			<img class="curly" src="content/rcurly.png" alt=" " />
		</div>
	</div>
		
	<div class="selection" id="selection">
		
		
		<div id="testmode">
		<a href="login.php">TEST MODE</a>
		</div>
	
		<div class="verticalLine" id="v1">
		&nbsp;</div>
	
		<div id="practicemode">
		<a href="practice_mode.php"  >PRACTICE MODE</a>
		</div>
	   
	</div>
		
	<div class="selection" id="selection2">
			
		<div id="testmodeinfo">
			<a href="login.php">Log in to collect or view data on the reviews.</a>
		</div>
		
		<div class="verticalLine" id="v2">
			&nbsp;
		</div>
		
		<div id="practicemodeinfo">
			<a href="practice_mode.php">Do the reviews without collecting data.</a>
		</div>
				
	</div>
		
	<script type="text/javascript"> 	
		
		$('#content #selection #testmode a').click(function()
		{
			$('#content').load('pages/login.php');
			return false;
		});
		
		$('#content #selection #practicemode a').click(function()
		{
			$('#content').load('pages/practice_mode.php');
			return false;
		});
		
		$('#content #selection2 #testmodeinfo a').click(function()
		{
			$('#content').load('pages/login.php');
			return false;
		});
		
		$('#content #selection2 #practicemodeinfo a').click(function()
		{
			$('#content').load('pages/practice_mode.php');
			return false;
		});
	
	</script>
	
</div>

		
		

    
   
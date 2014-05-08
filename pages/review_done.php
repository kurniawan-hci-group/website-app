<div id="content">

	<div id="midheadertext">
		Congratulations!
	</div>
	<div id="mainlocation">
		<p id="maintext">
			Review Completed</p>
	</div>
	
	<div id="midtext">
		<div id="midtext2_rev_done">
		What do you want to do now?</div> 
	</div>
	
	<?php 
		
	session_start();	
	if(isset($_SESSION['test_mode']) AND $_SESSION['test_mode'] == TRUE)
	{
		 $_SESSION['back'] = TRUE;
	?>

		 <div id="selection1" class="selection">
			
			
			<div id="testmode">
			<a href="login.php">Reviews Page</a>
			</div>
			
			<div class="verticalLine" id="v1">
			&nbsp;</div>
			
			<div id="practicemode">
			<a href="index.php">Sign Out</a>
			</div>
			
		</div>
	
		<div class="selection">

			<div id="testmodeinfo">
			Select another review, look at the data collected, etc.
			</div>
			
			<div class="verticalLine" id="v2">
			&nbsp;</div>
			
			<div id="practicemodeinfo">
			Done with reviews and collecting data.
			</div>

		</div>
		
	<?php
	}
	else
	{
	?>
	
		<div id="selection2" class="selection">
		
			<div id="testmode">
				<a href="practice_mode.php">Reviews Page</a>
			</div>
			
			<div class="verticalLine" id="v1">
				&nbsp;</div>
				
			<div id="practicemode">
				<a href="index.php">Home</a>
			</div>
			
		</div>
	
		<div class="selection">

			<div id="testmodeinfo">
				Select another review.</div>
			<div class="verticalLine" id="v2">
				&nbsp;</div>
			<div id="practicemodeinfo">
				Go back to Home.</div>
				
		</div>			
	
	<?php
	}
	?>

</div>

<script type="text/javascript"> 	
		
	$('#content #selection1 #testmode a').click(function()
	{
		$('#content').load('pages/login.php');
		return false;
	});
	
	$('#content #selection1 #practicemode a').click(function()
	{
		$('#content').load('pages/index.php');;
		return false;
	});
	
	$('#content #selection2 #testmode a').click(function()
	{
		$('#content').load('pages/practice_mode.php');
		return false;
	});
	
	$('#content #selection2 #practicemode a').click(function()
	{
		$('#content').load('pages/index.php');;
		return false;
	});
	
</script>
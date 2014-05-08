<div id="content"> 

	<?php
		session_start(); 
		$_SESSION['practice_mode'] = TRUE ;
	?>
	
	<div id="topdiv">
        <div id="imaginelogo">
            <a href="http://www.imaginecolorado.org/">
                <img id="logo" src="content/ImagineLogo.png" alt=" " />
            </a>
        </div>
        <div id="toprightnav">
            <div id="reviews_mode">
                REVIEWS</div>
            <div id="mode_practice">
                PRACTICE MODE</div>
        </div>
	</div>

	<div id="main">
        
        <div id="mainleft"></div>
        
        <div id="mainmid">
            
            <div id="midheadertext">
                REVIEWS
            </div>
           
            <div id="midtext">
                Please select one of the following:
            </div>
                        
			<div id="review_numbers">
				<a href="number_review.php">
				<div id="appbutton">
					Numbers
				</div>
				</a>
			</div>
			
			<div id="review_money">
				<a href="money_review.php">
				<div id="appbutton">
					Money
				</div>
				</a>
			</div>
		
			<div id="review_colors">
				<a href="color_review.php">
				<div id="appbutton">
					Colors
				</div>
				</a>
			</div>
			
			<!--
			<div id="review_uletters">
				<div id="appbutton">Uppercase Letters</div>
			</div>
			<div id="review_lletters">
				<div id="appbutton">Lowercase Letters</div>
			</div>
			<div id="review_money_add">
				<div id="appbutton">Money Addition</div>
			</div>
			<div id="review_shapes">
				<div id="appbutton">Shapes</div>
			</div>
			<div id="review_dtime">
				<div id="appbutton">Digital Time</div>
			</div>
			<div id="review_atime">
				<div id="appbutton">Analogue Time</div>
			</div>
			<div id="review_spelling">
				<div id="appbutton">Spelling</div>
			</div>
			<div id="review_street_signs">
				<div id="appbutton">Street Signs</div>
			</div>
			-->
			<div id="btm">
				<a href="index.php">
				<div id="homebutton">
					HOME
				</div>
				</a>
    		</div>
		
        </div>
       
       <div id="mainright"></div>
        
    </div>

</div>

<script type="text/javascript"> 

	$('#content #main #mainmid #btm a').click(function()
		{
			$('#content').load('pages/index.php');
			return false;
	});
	
	$('#content #main #mainmid #review_numbers a').click(function()
	{
		$('#content').load('pages/number_review.php');
		return false;
	});
	
	$('#content #main #mainmid #review_money a').click(function()
	{
		$('#content').load('pages/money_review.php');
		return false;
	});
	
	$('#content #main #mainmid #review_colors a').click(function()
	{
		$('#content').load('pages/color_review.php');
		return false;
	});
	
</script>
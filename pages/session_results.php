<h1>Results</h1>

<?php
	
	session_start(); 
	
	$results_session = $_SESSION['results_session'];

	require('connection_imagine_reviews.php');
	
	//Look for the sessions for which the user has results saved	
	$result = mysql_query(" select *
							from tblSession
							where idSession = '$results_session'", $db);
	
	//check that at least one row was returned

	$rowCheck = mysql_num_rows($result);

	if(!($rowCheck == 0)){
	
		$row = mysql_fetch_array($result);
		$session_start = $row['StartDateTime'];
		$session_end = $row['EndDateTime'];
		$type = gettype($session_start);
		$start = strtotime($session_start);
		$end = strtotime($session_end);
		$diff = $end - $start;
		$h = $diff / 3600 % 24;
  		$m = $diff / 60 % 60; 
   		$s = $diff % 60;
		$zero=strtotime('0000-00-00 00:00:00');		
		?>
		
		<table class="session_info" align="center">
			<tr>
				<th colspan="2">Session Information</th>
			</tr>
			<tr>
				<th>Review</th>
				<td><?php echo $_SESSION['results_app_name']; ?></td>
			</tr>
			<tr>
				<th>Session Start</th>
				<td><?php echo $session_start; ?></td>
			</tr>
			<tr>
				<th>Session End</th>
				<td><?php echo $session_end; ?></td>
			<tr/>		
		<?php

		
		if($end > $zero)
		{
		?>
			<tr>  
				<th>Duration</th>
				<td><?php echo $h . " hours, " . $m . " minutes and " . $s . " secs"; ?></td>
			</tr> 
		<?php
		}
		else
		{
		?>
			<tr>
				<th>Duration</th>
				<td>The session was terminated unexpectedly.</td> 
			</tr> 
		<?php
		}
		
		?>
		</table>
		<?php
	}
	
	//Look for the sessions for which the user has results saved	
	$result = mysql_query(" select *
							from tblResults
							where idSession = '$results_session'", $db);
	
	//check that at least one row was returned

	$rowCheck = mysql_num_rows($result);

	if(!($rowCheck == 0)){
	?>	
		
		<br />
		
		<table class="results" align="center">
			<tr>
  				<th>Question</th>
  				<th>User's Answer</th>
  				<th>Screen Number</th>
			</tr>

			<?php
			while($row = mysql_fetch_array($result))
			{	
				$question = $row['TestQuestion'];
				$answer = $row['Answer'];
				$screen = $row['AnswerNumber'];
				?>
				<tr>
					<td><?php echo $question;?></td>
					<td><?php echo $answer;?></td>
					<td><?php echo $screen;?></td>
				</tr>
			<?php
			}
			?>
		</table>
	<?php
	}
?>



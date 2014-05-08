<?php

// When they answer or there is a timeout.
session_start(); 

if( isset($_SESSION['test_mode']) AND $_SESSION['test_mode'] == TRUE )
{
	$session_id = $_SESSION['session_id'] ;

	// 1. There should be a var called $screen_number set to 1,2,3 or 4
	// depending on which screen the user is on (1 if it's the first 
	// time the question was asked, 2 if it's the second time it's being
	// asked because either the user answered incorrectly on the previous
	// screen or there was a timeout on screen the previous screen, 3 and
	// 4--the same as two. This applies for all the apps except money addition.
	$answer_number = $_POST['screen']+1;
		
	// 2. There should be a var $test_question that holds the question 
	// asked; i.e, the letter, number, currency, color, etc. For example,
	// '1','a','C','quarter','1 dollar', etc.
	$test_question = $_POST['review_question']; // the letter, number, currency, color or shape - for example 'a' or 'A' or '8' or 'yellow' or 'circle'
	
	// 3. There should be a var-flag named $timeout
	// set to TRUE when there is a timeout or FALSE otherwise
	
	// 4. $answer that holds the user's answer
	$answer = $_POST['user_answer'];

	require('connection_imagine_reviews.php');
	
	$query = mysql_query("insert into tblResults (idSession, AnswerNumber, TestQuestion, Answer) values ('$session_id', '$answer_number', '$test_question', '$answer')", $db);
	
	if(mysql_errno()){
		echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing <br>\n$query\n<br>";
	}
	
	else
	{
		$review_done = FALSE;
		if( $_POST['review_done'] == "TRUE" || ($answer == "timeout" AND $answer_number == 4) )
		{
			$review_done = TRUE;
		}
		
		// If timeout on screen 4 or this was the last question - Session is over - save session info
		if($review_done)
		{
			// Get date and time and save it as the Session End Time (type DateTime)
			$end_time = date( 'Y-m-d H:i:s', time() );
		
			mysql_query("update tblSession set EndDateTime = '$end_time' where idSession = '$session_id'", $db);
		
		}
		echo "saved";
	}
}
else
{
	echo "saved";

}

?>
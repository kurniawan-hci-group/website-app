<div id="content">

	<?php 
		session_start();
		if(isset($_SESSION['test_mode']) AND $_SESSION['test_mode'] == TRUE)
		{
			$_SESSION['app_name'] = "Money Review";
			require('prep_review_session.php');
		}
	?>
	
	<div id="html_review">
	
		<div id ="body_review">
		
			<div id="loading">
				Loading...
			</div>
			
			<div id="topdiv_mr">
				
				<div id="promptbutton_mr">
					REPEAT PROMPT &nbsp;
					<img id="arrow_mr" src="content/arrow_right_gray.png" alt="" />
				</div>
				
				<div id="question_mr">
					Question 0/8
				</div>

			</div>
			
			<div class="coinbox" id="penny">
				<img src="content/penny.png" id="pennyImg" alt="Penny" />
			</div>
			<div class="billbox" id="one">
				<img src="content/onedollar.jpg" id="oneImg" alt="One Dollar" />
			</div>
			<div class="coinbox" id="nickel">
				<img src="content/nickel.png" id="nickelImg" alt="Nickel" />
			</div>
			<div class="billbox" id="five">
				<img src="content/fivedollars.jpg" id="fiveImg" alt="Five Dollars" />
			</div>
			<div class="coinbox" id="dime">
				<img src="content/dime.png" id="dimeImg" alt="Dime" />
			</div>
			<div class="billbox" id="ten">
				<img src="content/tendollars.jpg" id="tenImg" alt="Ten Dollars" />
			</div>
			<div class="coinbox" id="quarter">
				<img src="content/quarter.png" id="quarterImg" alt="Quarter" />
			</div>
			<div class="billbox" id="twenty">
				<img src="content/twentydollars.jpg" id="twentyImg" alt="Twenty Dollars" />
			</div>
			 
			<audio id="player" preload="auto" autoplay="autoplay" style="display: none;"></audio>
			<div class="reinforcer" id="fireworks1">
				<img class="reinforcegifs" src="content/fireworks1.gif" alt="" />
			</div>
			<div class="reinforcer" id="fireworks2">
				<img class="reinforcegifs" src="content/fireworks2.gif" alt="" />
			</div>
			<div class="reinforcer" id="celebration1">
				<img class="reinforcegifs" src="content/celebration1.gif" alt="" />
			</div>
			<div class="reinforcer" id="celebration2">
				<img class="reinforcegifs" src="content/celebration2.gif" alt="" />
			</div>
			<div class="reinforcer" id="celebration3">
				<img class="reinforcegifs" src="content/celebration3.gif" alt="" />
			</div>
			<div class="reinforcer" id="celebration4">
				<img class="reinforcegifs" src="content/celebration4.gif" alt="" />
			</div>
			<div class="reinforcer" id="football1">
				<img class="reinforcegifs" src="content/footballcelebrate1.gif" alt="" />
			</div>
			<div class="reinforcer" id="football2">
				<img class="reinforcegifs" src="content/footballcelebrate2.gif" alt="" />
			</div>
			<div class="reinforcer" id="football3">
				<img class="reinforcegifs" src="content/footballcelebrate3.gif" alt="" />
			</div>
			<div class="reinforcer" id="football4">
				<img class="reinforcegifs" src="content/footballnicework.png" alt="" />
			</div>
		
		</div>
	
	</div>

</div>

<script type="text/javascript">

	var audioCorrect = new Audio('audio/thatsright.mp3');
	//       var audioIncorrect1 = new Audio('audio/pleasetryagain.mp3');
	//       var audioIncorrect2 = new Audio('audio/pleasetryagain2.mp3');
	var audioOneDollar = new Audio('audio/onedollar.mp3');
	var audioFiveDollars = new Audio('audio/fivedollars.mp3');
	var audioTenDollars = new Audio('audio/tendollars.mp3');
	var audioTwentyDollars = new Audio('audio/twentydollars.mp3');
	var audioPenny = new Audio('audio/penny.mp3');
	var audioNickel = new Audio('audio/nickel.mp3');
	var audioDime = new Audio('audio/dime.mp3');
	var audioQuarter = new Audio('audio/quarter.mp3');

	var audioTouchOneDollar = new Audio('audio/touchonedollar.mp3');
	var audioTouchFiveDollars = new Audio('audio/touchfivedollars.mp3');
	var audioTouchTenDollars = new Audio('audio/touchtendollars.mp3');
	var audioTouchTwentyDollars = new Audio('audio/touchtwentydollars.mp3');
	var audioTouchPenny = new Audio('audio/touchpenny.mp3');
	var audioTouchNickel = new Audio('audio/touchnickel.mp3');
	var audioTouchDime = new Audio('audio/touchdime.mp3');
	var audioTouchQuarter = new Audio('audio/touchquarter.mp3');

	var audioGoodJob = new Audio('audio/goodjob.mp3');
	var audioNiceWork = new Audio('audio/nicework.mp3');
	var audio70secReminder = new Audio('audio/reminder70sec.mp3');

	var chooseArray = new Array(1, 2, 3, 4, 5, 6, 7, 8);
	shuffleArray(chooseArray);
	var reinforcerArray = new Array("fireworks1", "fireworks2", "celebration1", "celebration2",
		"celebration3", "celebration4", "football1", "football2", "football3", "football4");
	var iterationCount = 0;  // keep track of the array element we are currently on

	var randNum = Math.floor(Math.random() * 8);
	var correctId = "null";   // the number to select this round
	var incorrectCount = 0;
	var errorCount = 0;
	var timeoutMain;
	var timeoutReminder;
	var clickDisableState = false;
	var chosenAnswer;

	$(document).ready(function () {
		document.getElementById("loading").innerHTML = "Start";
		//$("#loading").show();
	});

	$('#loading').click(function () {
		window.requestFullScreen1(document.body);
		if (document.getElementById("loading").innerHTML == "Start") {
			
			// DB code - once app review is started
			var xhr;  
			if (window.XMLHttpRequest) 
			{ // Mozilla, Safari, ...  
				xhr = new XMLHttpRequest();  
			} else if (window.ActiveXObject)
			{ // IE 8 and older  
				xhr = new ActiveXObject("Microsoft.XMLHTTP");  
			}
			
			var data = "start";
			xhr.open("POST","pages/start_review_session.php", true);   
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
			xhr.send(data);
			//---end of DB code
	
			newRound();
		}
	});

	//$("body > div").click(function () {
	$("body > div #html_review #body_review").bind('click',function(event){
		//var id = $(this).attr("id");    // id of clicked item
		//var classId = $(this).attr("class");
		
		// For the images of coins and bills
		var parent = $(event.target).parent();
		var parentId = parent.attr('id');
		var parentClassId = parent.attr('class');

		//For the prompt and question
		var id = event.target.id ;  // id of clicked item
		var classId = $(event.target).attr('class') ;
		
		if (clickDisableState == true) return;  // click lockout

		if ((parentClassId == "billbox") || (parentClassId == "coinbox") || (classId == "coinbox") || (classId == "billbox") ) {
			if (errorCount < 2){
				if((parentClassId == "billbox") || (parentClassId == "coinbox")) playValue(parentId);
				else playValue(id);
				//clickDisable(2800);  // disable clicks
			}
		}

		if (parentId == correctId || id == correctId) {
			//alert("Correct");
			
			if (errorCount > 1) playValue(correctId);
			//if (errorCount > 1) playValue(parentId);
			chosenAnswer = parentId; 
			dbLog(correctId,chosenAnswer,errorCount,iterationCount);
			setTimeout(function () { rightAnswer(); }, 2800); //3000, 2950
			showReinforcer();
		}
		else if (id == "promptbutton_mr" || id == "arrow_mr") {
			clickDisable(2000);  // disable clicks
			playTouchValue(chooseArray[iterationCount-1]);
		}
		else if ((parentClassId == "billbox") 
		|| (parentClassId == "coinbox") 
		|| (classId == "billbox") 
		|| (classId == "coinbox") ) {
			if(errorCount == 2)
			{
				//chosenAnswer = -1; //blank cell
				chosenAnswer = "blank"; //blank cell
			}
			else if((parentClassId == "billbox") || (parentClassId == "coinbox"))
			{
				chosenAnswer = parentId;
			}
			else
			{
				chosenAnswer = id;
			}
			
			dbLog(correctId,chosenAnswer,errorCount,iterationCount);
 			//alert(chosenAnswer);
			wrongAnswer();
			//if (errorCount < 4) {
			//	setTimeout(function () { playTouchValue(correctId); }, 2100);
			//	clickDisable(3000);  // disable clicks
			//}
						
		}
	});

	function newRound() {
		//window.requestFullScreen1(document.body);
		$("#loading").hide();
		$(".coinbox").show();
		$(".billbox").show();
		$(".reinforcer").hide();
		$("img").show();
		//$("#question").show();
		//$("#promptbutton_mr").show();
		//$("#promptbutton").css("display", "inline-block");
		$('#topdiv_mr').show();

		$(".coinbox").css("background", "#3F3F3F");
		$(".billbox").css("background", "none");

		correctId = playTouchValue(chooseArray[iterationCount]);

		resizeDivs();

		clickDisable(2300);  // disable clicks

		//document.getElementById("question_mr").innerHTML = "Question " + (iterationCount+1) + "/8";
		//	chooseNumPrompt.addEventListener("load", function(){
		//	chooseNumPrompt.play();

		if (iterationCount == 8) {
			//shuffleArray(chooseArray);

			//document.getElementById("incorrectText").innerHTML = "Incorrect: " + incorrectCount;
			//document.getElementById("question_mr").innerHTML = "Question " + iterationCount + "/8";
			//iterationCount = 0;  // keep track of the array element we are currently on

			//alert("Nice Job!!! You've completed the number review! Let's do it again!");
			alert("Nice Job!!! You've completed the money review!");
			//window.location.href = "review_done.php";
			$("#content").load("pages/review_done.php");

			//document.getElementById("incorrectText").innerHTML = "Incorrect: " + incorrectCount;
			//document.getElementById("question_mr").innerHTML = "Question " + iterationCount + "/8";
		}

		clearTimeout(timeoutMain);
		clearTimeout(timeoutReminder);
		
		if (iterationCount < 8) {
			document.getElementById("question_mr").innerHTML = "Question " + (iterationCount+1) + "/8";
			//Set 90 second timeout
			timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
			//Set 70 second reminder
			timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
		}

		errorCount = 0;
		iterationCount++;

	}
	
	function dbLog(quest, answ, screen, status){
		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		// HERE!!!! HERE!!!!
		// CHANGE STATUS to MAX NUMBER OF QUESTIONS!!!!!
		var review_done = "FALSE";
		if(status == 8){ 
			review_done = "TRUE";
		}
		
		var data = "review_question=" + quest + "&user_answer=" + answ + "&screen=" + screen + "&review_done=" + review_done;
		//alert(data);
		xhr.open("POST", "pages/save_results.php", true); 
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);
		//alert("done sending results");
		xhr.onreadystatechange = check_save;  
		function check_save() 
		{  
			if (xhr.readyState == 4)
			{  
				if (xhr.status == 200) 
				{
					//$('#content').load('pages/select_register_user.php');
					//document.getElementById("suggestion").innerHTML = xhr.responseText;
					//alert(xhr.responseText);
					if(xhr.response == "saved")
					{
						//alert("Saved!");
					}
					else
					{
						//alert(xhr.response);
					}	
				}
			} 
			else 
			{  
				//$('#content').load('pages/login.php');
				//alert('There was a problem with the request.');  
			} 
		}
	}
	
	function rightAnswer() {
		var rand = Math.floor(Math.random() * 3);
		switch (rand) {
			case 0:
				audioCorrect.play();
				break;
			case 1:
				audioGoodJob.play();
				break;
			case 2:
				audioNiceWork.play();
				break;
			default:
				break;
		}
		//Set 90 second timeout
		clearTimeout(timeoutMain);
		timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
		//Set 70 second reminder
		clearTimeout(timeoutReminder);
		timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
	}

	function wrongAnswer() {
		errorCount++;
		
		//To make sure the timeouts stop after review is done
		clearTimeout(timeoutMain);
		clearTimeout(timeoutReminder);
		
		if(errorCount < 4){

			if (errorCount == 1) {
				setTimeout(function () { playTouchValue(correctId); }, 2700);
				clickDisable(3000);  // disable clicks
				setTimeout(function () { document.getElementById(correctId).style.backgroundColor = '#FFFF00'; }, 4900);
				//document.getElementById(correctId).style.backgroundColor = '#FFFF00'; // '#FFA500';
			}
			else if (errorCount == 2) {
				setTimeout(function () { playTouchValue(correctId); }, 2700);
				clickDisable(3000);  // disable clicks
				setTimeout(function () { 
					$('img').hide();
					$("#arrow_mr").show();
					//      $('#penny' + 'Img').show();
					//     $('#pennyImg').show();
					document.getElementById(correctId + "Img").style.display = 'inline-block';
				}, 4900);
			}
			else if (errorCount == 3) {
				//$(".coinbox").css("background", "#3F3F3F");
				//$(".billbox").css("background", "none");
				//$("#promptbutton_mr").hide();
				
				var chooseCoin = false;
				$('.coinbox').each(function (i, obj) {
					if ($(obj).attr("id") != correctId) $(obj).hide();
					else chooseCoin = true;
				});
				$('.billbox').each(function (i, obj) {
					if ($(obj).attr("id") != correctId) $(obj).hide();
				});
				
				if (chooseCoin) {
					document.getElementById(correctId).style.width = '80%';//
					document.getElementById(correctId).style.height = '400px'; //
					document.getElementById(correctId + "Img").style.width = "400px";
					//   document.getElementById(correctId).style.marginLeft = '150px';
					//   document.getElementById(correctId).style.marginRight = 'auto';
				}
				else {
					document.getElementById(correctId).style.width = '95%';
					document.getElementById(correctId).style.height = '270px';
					//      document.getElementById(correctId).style.marginLeft = '75px';
					document.getElementById(correctId + "Img").style.height = "100%";
					document.getElementById(correctId + "Img").style.width = "660px";
				}
	
				//if (chooseCoin) {
				//    document.getElementById(correctId).style.width = '80%';
				//    document.getElementById(correctId).style.height = '80%';
				//}
				//else {
				//    document.getElementById(correctId).style.width = '100%';
				//    document.getElementById(correctId).style.height = '55%';
				//    document.getElementById(correctId + "Img").style.height = "100%";
				//}
				
				//setTimeout(function () { playTouchValue(correctId); }, 2100);
				//clickDisable(3000);  // disable clicks
				
				//$("#promptbutton_mr").hide();
				$('#topdiv_mr').hide();
				
				playTouchValue(correctId); 
				clickDisable(-1); // disable click lockout for this stage
			
			}//end of else EC == 3
			
			//Set 90 second timeout
			timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
			//Set 70 second reminder
			timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
			
		}//end of if EC < 4
		
		else{ //else if (errorCount == 4) {
			// assume timeout has been reached
			alert("Time out!  Review is over.");
			//window.location.href = "review_done.php";
			$("#content").load("pages/review_done.php");
		}

	}
	
	function resizeDivs() {
		if (height() < width()) {
			// WINDOW IS LARGER VERTICALLY, SWAP WIDTH AND HEIGHT
			$(".coinbox").css("width", "120px");
			$(".coinbox img").css("width", "100%");
			$(".coinbox").css("height", "123px");
			$(".billbox img").css("height", "100%");
			$(".billbox").css("height", "160px");
			$(".billbox").css("width", "374px");
			$(".billbox img").css("width", "100%");
			$('#quarter').css("clear", "none");
			$('#nickel').css("clear", "none");
		}
		else {
			// WINDOW IS LARGER HORIZONTALLY, SWAP WIDTH AND HEIGHT
			$(".coinbox").css("width", "155px");
			$(".coinbox img").css("width", "100%");
			$(".coinbox").css("height", "151px");
			$(".billbox img").css("height", "190px");
			$(".billbox").css("height", "190px");
			$(".billbox").css("width", "444px");
			$(".billbox img").css("width", "100%");
			$('#quarter').css("clear", "left");
			$('#nickel').css("clear", "left");
		}
 		//document.getElementById(correctId + "Img").style.width = "100%";
		//document.getElementById(correctId).style.marginLeft = "10px";
	}
	
	//90 second timeout
	function timeoutMainHandler() {
		//alert("Sorry! 90 Second Timeout.  Restarting.");
		//createGrid();
		chosenAnswer = "timeout";
		dbLog(correctId,chosenAnswer,errorCount,iterationCount);
		wrongAnswer();
		//if (errorCount < 4) playTouchValue(correctId);
	};

	//70 second timeout
	function timeoutReminderHandler() {
		audio70secReminder.play();
		//playChooseNum();
	};

	function showReinforcer() {
		$(".coinbox").hide();
		$(".billbox").hide();
		$("#topdiv_mr").hide();
				
		//var rand = Math.floor(Math.random() * 1.35 * reinforcerArray.length);
		//if (rand >= reinforcerArray.length) rand = reinforcerArray.length - 1;
		//alert("rand = " + rand);
		//var rand = Math.floor(Math.random() * (reinforcerArray.length+1));
		var rand = Math.floor(Math.random() * (reinforcerArray.length+1));
		switch (rand) {
			case 0:
				$("#content #html_review #body_review #fireworks1").show();
				$("#content #html_review #body_review #fireworks1 img").show();
				break;
			case 1:
				$("#content #html_review #body_review #fireworks2").show();
				$("#content #html_review #body_review #fireworks2 img").show();
				break;
			case 2:
				$("#content #html_review #body_review #celebration1").show();
				$("#content #html_review #body_review #celebration1 img").show();
				break;
			case 3:
				$("#content #html_review #body_review #celebration2").show();
				$("#content #html_review #body_review #celebration2 img").show();
				break;
			case 4:
				$("#content #html_review #body_review #celebration3").show();
				$("#content #html_review #body_review #celebration3 img").show();
				break;
			case 5:
				$("#content #html_review #body_review #celebration4").show();
				$("#content #html_review #body_review #celebration4 img").show();
				break;
			case 6:
				$("#content #html_review #body_review #football1").show();
				$("#content #html_review #body_review #football1 img").show();
				break;
			case 7:
				$("#content #html_review #body_review #football2").show();
				$("#content #html_review #body_review #football2 img").show();
				break;
			case 8:
				$("#content #html_review #body_review #football3").show();
				$("#content #html_review #body_review #football3 img").show();
				break;
			case 9:
				$("#content #html_review #body_review #football4").show();
				$("#content #html_review #body_review #football4 img").show();
				break;
			default:
				//alert(rand);
				$("#content #html_review #body_review #football4").show();
				$("#content #html_review #body_review #football4 img").show();
				break;
		}
		// changed from 4500 to 5000 (LNB - 3/30)
		setTimeout(function () { newRound(); }, 5000);

	}

	function requestFullScreen1(element) {
		// Supports most browsers and their versions.
		var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
		if (requestMethod) { // Native full screen.
			requestMethod.call(element);
		} else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
			var wscript = new ActiveXObject("WScript.Shell");
			if (wscript !== null) {
				wscript.SendKeys("{F11}");
			}
		}
	}
	
	// pass value param (in ms) to disable click events for a given time
	function clickDisable(param) {
		//    alert("Hi");
		if (param < 0) {
			clickDisableState = false;
		}
		else {
			clickDisableState = true;
			setTimeout(function () { clickDisable(-1); }, param);
		}
	}

	function getValue(valueId) {
		switch (valueId) {
			case "penny":
				return 1
				break;
			case "nickel":
				return 2
				break;
			case "dime":
				return 3
				break;
			case "quarter":
				return 4
				break;
			case "one":
				return 5
				break;
			case "five":
				return 6
				break;
			case "ten":
				return 7
				break;
			case "twenty":
				return 8
				break;
			default:
				return 0;
				break;
		}
	}
	
	function playValue(valueId) {
		switch (valueId) {
			case 1:
			case "penny":
				audioPenny.play();
				return "penny";
				break;
			case 2:
			case "nickel":
				audioNickel.play();
				return "nickel";
				break;
			case 3:
			case "dime":
				audioDime.play();
				return "dime";
				break;
			case 4:
			case "quarter":
				audioQuarter.play();
				return "quarter";
				break;
			case 5:
			case "one":
				audioOneDollar.play();
				return "one";
				break;
			case 6:
			case "five":
				audioFiveDollars.play();
				return "five";
				break;
			case 7:
			case "ten":
				audioTenDollars.play();
				return "ten";
				break;
			case 8:
			case "twenty":
				audioTwentyDollars.play();
				return "twenty";
				break;
			default:
				break;
		}
	};
	
	function playTouchValue(valueId) {
		switch (valueId) {
			case "penny":
			case 1:
				audioTouchPenny.play();
				return "penny";
				break;
			case "nickel":
			case 2:
				audioTouchNickel.play();
				return "nickel";
				break;
			case "dime":
			case 3:
				audioTouchDime.play();
				return "dime";
				break;
			case "quarter":
			case 4:
				audioTouchQuarter.play();
				return "quarter";
				break;
			case "one":
			case 5:
				audioTouchOneDollar.play();
				return "one";
				break;
			case "five":
			case 6:
				audioTouchFiveDollars.play();
				return "five";
				break;
			case "ten":
			case 7:
				audioTouchTenDollars.play();
				return "ten";
				break;
			case "twenty":
			case 8:
				audioTouchTwentyDollars.play();
				return "twenty";
				break;
			default:
				break;
		}
	};
	
	/**
	* Randomize array element order in-place.
	* Using Fisher-Yates shuffle algorithm.
	*/
	function shuffleArray(array) {
		for (var i = array.length - 1; i > 0; i--) {
			var j = Math.floor(Math.random() * (i + 1));
			var temp = array[i];
			array[i] = array[j];
			array[j] = temp;
		}
		return array;
	};
	
	function width() {
		return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth || 0;
	}
	
	function height() {
		return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0;
	}

</script>
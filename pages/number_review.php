<div id="content">
	
	<?php 
		session_start();
		if(isset($_SESSION['test_mode']) AND $_SESSION['test_mode'] == TRUE)
		{
			$_SESSION['app_name'] = "Number Review";
			require('prep_review_session.php');
		}
	?>
	
	<div id="html_review">
	
		<div id="body_review">
	
			<div id="loading">
				Loading...
			</div>
			
			<div id="promptbutton">
				REPEAT PROMPT &nbsp;
				<img id="arrow" src="content/arrow_right_gray.png" alt="" style="display: none;" />
			</div>
			
			<div id="question">
				Question 0/10
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="box1">
				1
			</div>
			<div class="box" id="box2">
				2
			</div>
			<div class="box" id="box3">
				3
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="box4">
				4
			</div>
			<div class="box" id="box5">
				5
			</div>
			<div class="box" id="box6">
				6
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="box7">
				7
			</div>
			<div class="box" id="box8">
				8
			</div>
			<div class="box" id="box9">
				9
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="empty">
			</div>
			
			<div class="box" id="box0">
				0
			</div>
			
			<div class="empty">
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="big">
				0
			</div>
			
			<div class="linebreak">
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
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
<script type='text/javascript' src='../js/jquery.waitforimages.min.js'></script>

<script type="text/javascript">
			
	var audioCorrect = new Audio('audio/thatsright.mp3');
	//       var audioIncorrect1 = new Audio('audio/pleasetryagain.mp3');
	//       var audioIncorrect2 = new Audio('audio/pleasetryagain2.mp3');
	var audio1 = new Audio('audio/one.mp3');
	var audio2 = new Audio('audio/two.mp3');
	var audio3 = new Audio('audio/three.mp3');
	var audio4 = new Audio('audio/four.mp3');
	var audio5 = new Audio('audio/five.mp3');
	var audio6 = new Audio('audio/six.mp3');
	var audio7 = new Audio('audio/seven.mp3');
	var audio8 = new Audio('audio/eight.mp3');
	var audio9 = new Audio('audio/nine.mp3');
	var audio0 = new Audio('audio/zero.mp3');

	var audioTouch1 = new Audio('audio/touchone.mp3');
	var audioTouch2 = new Audio('audio/touchtwo.mp3');
	var audioTouch3 = new Audio('audio/touchthree.mp3');
	var audioTouch4 = new Audio('audio/touchfour.mp3');
	var audioTouch5 = new Audio('audio/touchfive.mp3');
	var audioTouch6 = new Audio('audio/touchsix.mp3');
	var audioTouch7 = new Audio('audio/touchseven.mp3');
	var audioTouch8 = new Audio('audio/toucheight.mp3');
	var audioTouch9 = new Audio('audio/touchnine.mp3');
	var audioTouch0 = new Audio('audio/touchzero.mp3');

	var audioGoodJob = new Audio('audio/goodjob.mp3');
	var audioNiceWork = new Audio('audio/nicework.mp3');
	var audioChooseNum = new Audio('audio/choosenum.mp3');
	var audio70secReminder = new Audio('audio/reminder70sec.mp3');
	var chooseNumPrompt;

	//correctText
	// create array of numbers 0-9 in random positions
	var randArray = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
	var boxArray = new Array("box1", "box2", "box3", "box4",
	"box5", "box6", "box7", "box8", "box9", "box0");  // these corresponds to the divs created
	shuffleArray(randArray);
	var numArray = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
	var reinforcerArray = new Array("fireworks1", "fireworks2", "celebration1", "celebration2",
		"celebration3", "celebration4", "football1", "football2", "football3", "football4");
	var iterationCount = 0;  // keep track of the array element we are currently on

	var randNum = Math.floor(Math.random() * 10);
	var boxvar = 'box';   // the box (ID) to select this round
	var chooseNum;   // the number to select this round
	var incorrectCount = 0;
	var errorCount = 0;
	var timeoutMain;
	var timeoutReminder;
	var clickDisableState = false;
	var chosenAnswer;

	$('.reinforcegifs').waitForImages({
      finished: function(){
        document.getElementById("loading").innerHTML = "Start";
      }, waitForAll: true
      });
	  
	$("body").on({
		ontouchmove : function(e) {
			e.preventDefault(); 
		}
	});
	
	$(document).bind(
		'touchmove',
		function(e) {
			e.preventDefault();
		}
	);
	$(document).ready(function(){
	//	document.getElementById("loading").innerHTML = "Start";
	});

	window.scrollTo(0, 1);
	$('#loading').click(function () {
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
			
			window.requestFullScreen1(document.body);
			$(".reinforcer").hide();
			$("#loading").hide();
			$("img").show();
			$(".box").css("display", "inline-block");
			$("#question").css("display", "inline-block");
			$(promptbutton).css("display", "inline");
			playChooseNum(randArray[iterationCount]);
			var boxes = document.getElementsByClassName('box');
			//  create squares

			if (height() < width()) {
				// WINDOW IS LARGER VERTICALLY, SWAP WIDTH AND HEIGHT
				for (var i = 0; i < boxArray.length; i++) {
					document.getElementById(boxArray[i]).style.width = "114px";
					document.getElementById(boxArray[i]).style.height = "114px";
				}
				document.getElementById("big").style.width = "500px";
				document.getElementById("big").style.height = "650px";
				document.getElementById("big").style.fontSize = "0.5em";
				$("#big").css("font-size", "1200%");
				$("#big").css("line-height", "87%");
				//		jQuery(".box").fitText(.09);
			}
			else {
				// WINDOW IS LARGER HORIZONTALLY, SWAP WIDTH AND HEIGHT
				for (var i = 0; i < boxArray.length; i++) {
					document.getElementById(boxArray[i]).style.width = "180px";
					document.getElementById(boxArray[i]).style.height = "180px";
				}
				$(".box").css("font-size", "1200%");
				//                width: 585px;
				//            height: 790px;
				// 	jQuery(".box").fitText(.12);
			}

			createGrid();
		}
	});

	//$("body > div #html_review #body_review").click(function () {
//	$("body > div #html_review #body_review").bind('click',function(event){
	$("body > div #html_review #body_review").on("click touchstart", function(e){
		//alert(event.target.id);
		
		var idVar = event.target.id ;    // id of clicked item
		var idVarNum = numArray[idVar.charAt(idVar.length - 1)];   // number of box
		
		if (clickDisableState == true) return;  // click lockout
				
		//-------------------------//
		if( (idVar.indexOf("box") != -1) || idVar == "big" )
		{
			
			//playNumber(chosenAnswer);
			//alert(choosenAnswer);
			//chosenAnswer = document.getElementById(idVar).innerHTML;

			if(idVarNum == chooseNum || idVar == "big"){
				chosenAnswer = chooseNum;
				playNumber(chooseNum);
				dbLog(chooseNum,chosenAnswer,errorCount,iterationCount);
				setTimeout(function () { rightAnswer(); }, 1400); //700, 800, 850, 
				// 700 works
				// 1000 works
				// 1200 doesnt
				// 1500 doesnt
				// 2000 doesnt
				// 3000 doesnt
				// 5000 doesnt
				// changed from 4200 to 4800 (LNB - 3/30)
				setTimeout(function () { playChooseNum(randArray[iterationCount-1]); }, 5300);
				showReinforcer();
			}
			else
			{
				chosenAnswer = idVarNum;
				if (errorCount < 2) {
					playNumber(chosenAnswer);
					clickDisable(3900);  // disable clicks
				}
				else if (errorCount == 2) {
					
			//		alert("errorcount=2");
					playChooseNum(randArray[iterationCount - 1]);
					clickDisable(2200);  // disable clicks
				}
				else
				{
					//chosenAnswer = -1; //blank cell
					chosenAnswer = "blank"; //blank cell
				}
				dbLog(chooseNum,chosenAnswer,errorCount,iterationCount);
				wrongAnswer();
				//Instead of less than 3 - now less than 4 so it plays the prompt on the last screen
				//if (errorCount < 4) setTimeout(function () { playChooseNum(randArray[iterationCount - 1]); }, 1400);
			}
		}
		else if(idVar == "promptbutton" || idVar == "arrow")
		{
			clickDisable(2100);  // disable clicks
			playChooseNum(randArray[iterationCount - 1]);
		}
	});

	// Creates grid with numbers
	function createGrid() {
		$(".box").show();
		$(".linebreak").show();
		$("#big").hide();
		$(".reinforcer").hide();
		$("#promptbutton").show();
		$("#question").show();
		clickDisable(2100);  // disable clicks
		chooseNum = randArray[iterationCount];

		//document.getElementById("question").innerHTML = "Question " + (iterationCount+1) + "/10";
		//chooseNumPrompt.addEventListener("load", function(){
		//chooseNumPrompt.play();

		//Set 90 second timeout
		clearTimeout(timeoutMain);
		//Set 70 second reminder
		clearTimeout(timeoutReminder);
		if(iterationCount != 10)
		{
			document.getElementById("question").innerHTML = "Question " + (iterationCount+1) + "/10";
			timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
			timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
		}

		errorCount = 0;

		// reset background color of previous target box to white
		if (iterationCount > 0) document.getElementById(boxvar).style.backgroundColor = '#FFFFFF';
		if (iterationCount == 10) {
			//shuffleArray(randArray);

			//document.getElementById("incorrectText").innerHTML = "Incorrect: " + incorrectCount;
			//document.getElementById("question").innerHTML = "Question " + iterationCount + "/10";
			
			//iterationCount = 0;  // keep track of the array element we are currently on
			//incorrectCount = 0;

			//alert("Nice Job!!! You've completed the number review! Let's do it again!");
			alert("Nice Job!!! You've completed the number review!");
			$("#content").load("pages/review_done.php");
			//window.location.href = "review_done.php";
			//document.getElementById("incorrectText").innerHTML = "Incorrect: " + incorrectCount;
			//document.getElementById("question").innerHTML = "Question " + iterationCount + "/10";
		}
		else{
			iterationCount++;
			shuffleArray(boxArray);
	
			for (var i = 0; i < boxArray.length; i++) {
				document.getElementById(boxArray[i]).innerHTML = i;
				numArray[boxArray[i].charAt(boxArray[i].length - 1)] = i;
				if (i == chooseNum) {
					boxvar = boxArray[i];
				}
			}
		}
		// iterationCount++;
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

		//  setTimeout(function () { playChooseNum(randArray[iterationCount]); }, 2000);
	}

	function wrongAnswer() {
		//		if (Math.floor(Math.random()*10) < 5) audioIncorrect1.play();
		//		else audioIncorrect2.play();
		incorrectCount++;
		errorCount++;
		if (errorCount == 1) {
			setTimeout(function () { playChooseNum(randArray[iterationCount - 1]); }, 1800);
			setTimeout(function () { document.getElementById(boxvar).style.backgroundColor = '#FFFF00'; }, 2900);
			//document.getElementById(boxvar).style.backgroundColor = '#FFFF00'; // '#FFA500';
		}
		else if (errorCount == 2) {
			setTimeout(function () { playChooseNum(randArray[iterationCount - 1]); }, 1800);
			setTimeout(function () {  
				for (var i = 0; i < boxArray.length; i++) {
					if (boxArray[i] != boxvar) {
						document.getElementById(boxArray[i]).innerHTML = "&nbsp;"; // replace numbers with empty space
					}
				}
			}, 2700);
		}
		else if (errorCount == 3) {
			$("#promptbutton").hide();
			$(".box").hide();
			$("#big").css("font-size", "5000%");
			$("#big").show();
			$("#bottomicon").show();
			document.getElementById("big").innerHTML = chooseNum;
			
	//	setTimeout(function () { playChooseNum(randArray[iterationCount - 1]); }, 1800);
		//	clickDisable(-1); // disable click lockout for this stage
		}
		else if (errorCount > 3) {
			// assume timeout has been reached
			alert("Time out!  Review is over.");
			//window.location.href = "review_done.php";
			$("#content").load("pages/review_done.php");
		}
		
		//To make sure the timeouts stop after review is done
		clearTimeout(timeoutMain);
		clearTimeout(timeoutReminder);
		if(errorCount <= 3){
			//Set 90 second timeout
			timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
			//Set 70 second reminder
			timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
		}
	}

	//90 second timeout
	function timeoutMainHandler() {
		//     alert("Sorry! 90 Second Timeout.  Restarting.");
		//     createGrid();
		chosenAnswer = "timeout";
		dbLog(chooseNum,chosenAnswer,errorCount,iterationCount);
		wrongAnswer();
		//if (errorCount < 4) playChooseNum(randArray[iterationCount - 1]);
	};

	//70 second timeout
	function timeoutReminderHandler() {
		audio70secReminder.play();
		//	 playChooseNum();
	};

	//quest = chooseNum
	//answ = chosenAnswer
	//screen = errorCount (+1 but it's added in the php file)
	//status = iterationCount
	function dbLog(quest, answ, screen, status) {

		var xhr;  
		if (window.XMLHttpRequest) 
		{ // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject)
		{ // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}
		
		var review_done = "FALSE";
		if(status == 10){
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

	function showReinforcer() {
		$(".box").hide();
		$("#promptbutton").hide();
		$(".linebreak").hide();
		$("#question").hide();
		
		var rand = Math.floor(Math.random() * (reinforcerArray.length+1));
		//var rand = Math.floor(Math.random() * 1.3 * (reinforcerArray.length+1));
		//if (rand > reinforcerArray.length) rand = reinforcerArray.length - 1;
		switch (rand) {
			case 0:
				$("#fireworks1").show();
				break;
			case 1:
				$("#fireworks2").show();
				break;
			case 2:
				$("#celebration1").show();
				break;
			case 3:
				$("#celebration2").show();
				break;
			case 4:
				$("#celebration3").show();
				break;
			case 5:
				$("#celebration4").show();
				break;
			case 6:
				$("#football1").show();
				break;
			case 7:
				$("#football2").show();
				break;
			case 8:
				$("#football3").show();
				break;
			case 9:
				$("#football4").show();
				break;
			default:
				$("#football1").show();
				break;
		}
		
		setTimeout(function () { createGrid(); }, 5100);
		
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

	var prevNumListener = -1;
	function playChooseNum(chooseNumVar) {
		//         audioChooseNum.addEventListener("ended", function () { playNumber(chooseNum); }, true);
		//         audioChooseNum.play();
		switch (chooseNumVar) {
			case 1:
				audioTouch1.play();
				break;
			case 2:
				audioTouch2.play();
				break;
			case 3:
				audioTouch3.play();
				break;
			case 4:
				audioTouch4.play();
				break;
			case 5:
				audioTouch5.play();
				break;
			case 6:
				audioTouch6.play();
				break;
			case 7:
				audioTouch7.play();
				break;
			case 8:
				audioTouch8.play();
				break;
			case 9:
				audioTouch9.play();
				break;
			case 0:
				audioTouch0.play();
				break;
			default:
				break;
		}

		//       setTimeout(function () { playNumber(chooseNum); }, 1200);
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
	
	function playNumber(num) {
		switch (num) {
			case 1:
				audio1.play();
				break;
			case 2:
				audio2.play();
				break;
			case 3:
				audio3.play();
				break;
			case 4:
				audio4.play();
				break;
			case 5:
				audio5.play();
				break;
			case 6:
				audio6.play();
				break;
			case 7:
				audio7.play();
				break;
			case 8:
				audio8.play();
				break;
			case 9:
				audio9.play();
				break;
			case 0:
				audio0.play();
				break;
			default:
				break;
		}
	}
	
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
<div id="content">

	<?php 
		session_start();
		if(isset($_SESSION['test_mode']) AND $_SESSION['test_mode'] == TRUE)
		{
			$_SESSION['app_name'] = "Colors Review";
			require('prep_review_session.php');
		}
	?>
	
	<div id="html_review">
	
		<div id ="body_review" style=" background: url(content/black-background-paisley-resized.jpg); background-repeat: repeat;">
		
			<div id="loading">
				Loading...
			</div>
			
			<div id="promptbutton">
				REPEAT PROMPT &nbsp;
				<img id="arrow" src="content/arrow_right_gray.png" alt="" style="display:none;" />
			</div>
			
			<div id="question">
				Question 0/11
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="box1" style="background: #000000; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box2" style="background: #FF0000; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box3" style="background: #804000; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="box4" style="background: #A5A5A5; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box5" style="background: #0000FF; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box6" style="background: #008000; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			
			<div class="linebreak">
			</div>
			
			<div class="box" id="box7" style="background: #FF7912; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box8" style="background: #FFFF00; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box9" style="background: #FFFFFF; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			
			<div class="linebreak">
			</div>
			<div class="empty">
			</div>
			
			<div class="box" id="box0" style="background: #660066; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			<div class="box" id="box10" style="background: #FFB6C1; border: none; width: 116px; height: 116px;">
				&nbsp;
			</div>
			
			<div class="empty">
			</div>
			<div class="linebreak">
			</div>
			
			<div class="box" id="big" style="border: none; width: 116px; height: 116px;">
				&nbsp;
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

<script type="text/javascript">

	var audioCorrect = new Audio('audio/thatsright.mp3');
	//       var audioIncorrect1 = new Audio('audio/pleasetryagain.mp3');
	//       var audioIncorrect2 = new Audio('audio/pleasetryagain2.mp3');
	var audioRed = new Audio('audio/red.mp3');
	var audioBlue = new Audio('audio/blue.mp3');
	var audioBlack = new Audio('audio/black.mp3');
	var audioBrown = new Audio('audio/brown.mp3');
	var audioGray = new Audio('audio/gray.mp3');
	var audioGreen = new Audio('audio/green.mp3');
	var audioOrange = new Audio('audio/orange.mp3');
	var audioYellow = new Audio('audio/yellow.mp3');
	var audioWhite = new Audio('audio/white.mp3');
	var audioPurple = new Audio('audio/purple.mp3');
	var audioPink = new Audio('audio/pink.mp3');

	var audioTouchRed = new Audio('audio/touchred.mp3');
	var audioTouchBlue = new Audio('audio/touchblue.mp3');
	var audioTouchBlack = new Audio('audio/touchblack.mp3');
	var audioTouchBrown = new Audio('audio/touchbrown.mp3');
	var audioTouchGray = new Audio('audio/touchgray.mp3');
	var audioTouchGreen = new Audio('audio/touchgreen.mp3');
	var audioTouchOrange = new Audio('audio/touchorange.mp3');
	var audioTouchYellow = new Audio('audio/touchyellow.mp3');
	var audioTouchWhite = new Audio('audio/touchwhite.mp3');
	var audioTouchPurple = new Audio('audio/touchpurple.mp3');
	var audioTouchPink = new Audio('audio/touchpink.mp3');

	var audioGoodJob = new Audio('audio/goodjob.mp3');
	var audioNiceWork = new Audio('audio/nicework.mp3');
	var audioChooseColor = new Audio('audio/chooseColor.mp3');
	var audio70secReminder = new Audio('audio/reminder70sec.mp3');
	var chooseColorPrompt;

	//correctText
	// create array of numbers 0-9 in random positions
	var randArray = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
	var boxArray = new Array("box1", "box2", "box3", "box4",
	"box5", "box6", "box7", "box8", "box9", "box0", "box10");  // these corresponds to the divs created
	shuffleArray(randArray);
	var numArray = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 10);
	var reinforcerArray = new Array("fireworks1", "fireworks2", "celebration1", "celebration2",
		"celebration3", "celebration4", "football1", "football2", "football3", "football4");
	var iterationCount = 0;  // keep track of the array element we are currently on

	var randNum = Math.floor(Math.random() * 11);
	var boxvar = 'box';   // the box (ID) to select this round
	var boxvarEl = $('#' + boxvar); //assuming you are referencing the element by id
	//boxvarEl.css('color', 'red');
	var chooseColor;   // the number to select this round
	var incorrectCount = 0;
	var errorCount = 0;
	var timeoutMain;
	var timeoutReminder;
	var clickDisableState = false;
	var chosenAnswer;

	$(document).ready(function () {
		document.getElementById("loading").innerHTML = "Start";
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

			var boxes = document.getElementsByClassName('box');
			//  create squares

			if (height() < width()) {
				// WINDOW IS LARGER VERTICALLY, SWAP WIDTH AND HEIGHT
				for (var i = 0; i < boxArray.length; i++) {
					document.getElementById(boxArray[i]).style.width = "114px";
					document.getElementById(boxArray[i]).style.height = "114px";
				}
				document.getElementById("big").style.width = "500px";
				document.getElementById("big").style.height = "544px";
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

			}
			createGrid();
			//           setTimeout(function () { alert("hi")}, 1000);
		}
	});


	//$("body > div").click(function () {
	$("body > div #html_review #body_review").bind('click',function(event){

		//var idVar = $(this).attr("id");    // id of clicked item
		// var idVarNum = numArray[idVar.charAt(idVar.length - 1)];   // number of box
		
		var idVar = event.target.id ;    // id of clicked item
		//alert("idVar=" + idVar );

		if (clickDisableState == true) return;  // click lockout

		if( (idVar.indexOf("box") != -1) || idVar == "big" ){
			getColorText
			if(getColor(idVar) == chooseColor || idVar == "big"){
				playColor(chooseColor);
				chosenAnswer = getColorText(idVar);
				dbLog(getColorText(chooseColor),chosenAnswer,errorCount,iterationCount);
				setTimeout(function () { rightAnswer(); }, 700);
				showReinforcer();
			}
			else{
				//alert("Wrong");
				chosenAnswer = getColorText(idVar);
				if (errorCount < 2){
					playColor(getColor(idVar));
					clickDisable(2800);  // disable clicks
				}
				else{
					chosenAnswer = "blank"; //blank cell
				}
				
				dbLog(getColorText(chooseColor),chosenAnswer,errorCount,iterationCount);
				wrongAnswer();
				//Instead of less than 3 - now less than 4 so it plays the prompt on the last screen
				//if (errorCount < 4) setTimeout(function () { playChooseColor(); }, 1600);
			}
		}
		else if(idVar == "promptbutton" || idVar == "arrow"){
			clickDisable(2200);  // disable clicks
			playChooseColor();
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

		$('#box1').css('background-color', '#000000');
		$('#box2').css('background-color', '#FF0000');
		$('#box3').css('background-color', '#804000');
		$('#box4').css('background-color', '#A5A5A5');
		$('#box5').css('background-color', '#0000FF');
		$('#box6').css('background-color', '#008000');
		$('#box7').css('background-color', '#FF7912');
		$('#box8').css('background-color', '#FFFF00');
		$('#box9').css('background-color', '#FFFFFF');
		$('#box0').css('background-color', '#660066');
		$('#box10').css('background-color', '#FFB6C1');
		if (errorCount > 0) {
			boxvarEl.width(function (i, w) { return w + 8; });
			boxvarEl.height(function (i, w) { return w + 8; });
		}
		clickDisable(1700);  // disable clicks

		chooseColor = randArray[iterationCount];
		playChooseColor();

		clearTimeout(timeoutMain);
		clearTimeout(timeoutReminder);		
		
		if(iterationCount != 11){
			document.getElementById("question").innerHTML = "Question " + (iterationCount+1) + "/11";
			//Set 90 second timeout
			timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
			//Set 70 second reminder
			timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
		}

		errorCount = 0;

		// reset background color of previous target box to white
		if (iterationCount > 0) document.getElementById(boxvar).style.border = 'none';
		if (iterationCount == 11) {
			
			//shuffleArray(randArray);
			//document.getElementById("incorrectText").innerHTML = "Incorrect: " + incorrectCount;
			//document.getElementById("question").innerHTML = "Question " + iterationCount + "/11";
			iterationCount = 0;  // keep track of the array element we are currently on
			incorrectCount = 0;

			alert("Nice Job!!! You've completed the color review!");
			$("#content").load("pages/review_done.php");
			
			//window.location.href = "review_done.php";
			//document.getElementById("incorrectText").innerHTML = "Incorrect: " + incorrectCount;
			//document.getElementById("question").innerHTML = "Question " + iterationCount + "/11";
		}
		else{
			iterationCount++;
			//shuffleArray(boxArray);

			for (var i = 0; i < boxArray.length; i++) {
				//      document.getElementById(boxArray[i]).innerHTML = i;
				//      numArray[boxArray[i].charAt(boxArray[i].length - 1)] = i;
				//      numArray[i] = i;
				if (chooseColor == getColor(boxArray[i])) {
					boxvar = boxArray[i];
					boxvarEl = $('#' + boxvar);
				}
			}
		}

	}

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
		
		// CHANGE THIS!!!!!!!! TO THE MAX
		var review_done = "FALSE";
		if(status == 11){
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
		
		//if (Math.floor(Math.random()*10) < 5) audioIncorrect1.play();
		//else audioIncorrect2.play();
		
		incorrectCount++;
		errorCount++;
		
		clearTimeout(timeoutMain);
		clearTimeout(timeoutReminder);
				
		if(errorCount < 4)
		{
			//Set 90 second timeout
			timeoutMain = setTimeout(function () { timeoutMainHandler(); }, 90000);
			//Set 70 second reminder
			timeoutReminder = setTimeout(function () { timeoutReminderHandler(); }, 70000);
				
			if (errorCount == 1) {
				setTimeout(function () { playChooseColor(); }, 1600);
				setTimeout(function () { 
					//if (boxvar != "box1" ){ // highlight black
					if (boxvar == "box9" || boxvar == "box8" || boxvar == "box10"){ // highlight black
						document.getElementById(boxvar).style.border = '8px dotted #000000'; // '#FFA500';
					}//else highlight white
					else document.getElementById(boxvar).style.border = '8px dotted #FFFFFF'; // '#FFA500';
					//       document.getElementById(boxvar).style.width = document.getElementById(boxvar).style.width - 8;
					boxvarEl.width(function (i, w) { return w - 8; });
					boxvarEl.height(function (i, w) { return w - 8; });
					//    boxvarEl.css('color', 'red');
					//          $(this).attr("id") == boxvar)
				
				 }, 3000); //3000
	
			}
			else if (errorCount == 2) {
				setTimeout(function () { playChooseColor(); }, 1600);
				setTimeout(function () { 
					for (var i = 0; i < boxArray.length; i++) {
						if (boxArray[i] != boxvar) {
							document.getElementById(boxArray[i]).style.backgroundColor = 'transparent'; // replace numbers with empty space
							//         $("#" + boxArray[i]).hide();
						}
					}
				}, 3000);
			}
			else if (errorCount == 3) {
				playChooseColor();
				$(".box").hide();
				$("#big").css("font-size", "5000%");
				document.getElementById("big").style.width = "500px";
                document.getElementById("big").style.height = "544px";
                document.getElementById("big").style.fontSize = "0.5em";
                $("#big").css("font-size", "1200%");
            	$("#big").css("line-height", "87%");
				//("#big").css("backgroundColor",  rgbToHex(boxVarEl.css('backgroundColor')));
				document.getElementById("big").style.backgroundColor = document.getElementById(boxvar).style.backgroundColor;  //rgbToHex(boxVarEl.css('backgroundColor'));
				
				$("#promptbutton").hide();
				$("#big").show();
				$("#bottomicon").show();

				clickDisable(-1); // disable click lockout for this stage
			
			}
		
		}
		else{ 		//else if (errorCount > 3) {
			// assume timeout has been reached
			alert("Time out!  Review is over.");
			$("#content").load("pages/review_done.php");
			//window.location.href = "review_done.php";
		}
		
		//alert(document.getElementById(boxvar).style.backgroundColor);
		//alert(rgbToHex(document.getElementById(boxvar).style.backgroundColor));
	}

	//90 second timeout
	function timeoutMainHandler() {
		//alert("Sorry! 90 Second Timeout.  Restarting.");
		//createGrid();
		chosenAnswer = "timeout";
		dbLog(getColorText(chooseColor),chosenAnswer,errorCount,iterationCount);
		wrongAnswer();
		//if (errorCount < 4) playChooseColor();
	};

	//70 second timeout
	function timeoutReminderHandler() {
		audio70secReminder.play();
		//	 playChooseColor();
	};

	function showReinforcer() {
		$(".box").hide();
		$("#promptbutton").hide();
		$(".linebreak").hide();
		$("#question").hide();
		//var rand = Math.floor(Math.random() * 1.3 * reinforcerArray.length);
		//if (rand > reinforcerArray.length) rand = reinforcerArray.length - 1;
		var rand = Math.floor(Math.random() * (reinforcerArray.length +1) );
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
				$("#football3").show();
				break;
		}
		// changed from 4800 to 5300 (LNB - 3/30)
		setTimeout(function () { createGrid(); }, 5300);

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
	function playChooseColor() {
		//         audioChooseColor.addEventListener("ended", function () { playColor(chooseColor); }, true);
		//         audioChooseColor.play();
		switch (chooseColor) {
			case 1:
				audioTouchBlack.play();
				break;
			case 2:
				audioTouchRed.play();
				break;
			case 3:
				audioTouchBrown.play();
				break;
			case 4:
				audioTouchGray.play();
				break;
			case 5:
				audioTouchBlue.play();
				break;
			case 6:
				audioTouchGreen.play();
				break;
			case 7:
				audioTouchOrange.play();
				break;
			case 8:
				audioTouchYellow.play();
				break;
			case 9:
				audioTouchWhite.play();
				break;
			case 0:
				audioTouchPurple.play();
				break;
			case 10:
				audioTouchPink.play();
				break;
		}
		//       setTimeout(function () { playColor(chooseColor); }, 1200);
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
	
	function getColor(chooseColorBox) {
		switch (chooseColorBox) {
			case "box1":
				return 1;
				break;
			case "box2":
				return 2;
				break;
			case "box3":
				return 3;
				break;
			case "box4":
				return 4;
				break;
			case "box5":
				return 5;
				break;
			case "box6":
				return 6;
				break;
			case "box7":
				return 7;
				break;
			case "box8":
				return 8;
				break;
			case "box9":
				return 9;
				break;
			case "box0":
				return 0;
				break;
			case "box10":
				return 10;
				break;
			default:
				break;
		}
	}
	
	function getColorText(chooseColorBox) {
		switch (chooseColorBox) {
			case "box1":
			case 1:
				return "black";
				break;
			case "box2":
			case 2:
				return "red";
				break;
			case "box3":
			case 3:
				return "brown";
				break;
			case "box4":
			case 4:
				return "gray";
				break;
			case "box5":
			case 5:
				return "blue";
				break;
			case "box6":
			case 6:
				return "green";
				break;
			case "box7":
			case 7:
				return "orange";
				break;
			case "box8":
			case 8:
				return "yellow";
				break;
			case "box9":
			case 9:
				return "white";
				break;
			case "box0":
			case 0:
				return "purple";
				break;
			case "box10":
			case 10:
				return "pink";
				break;
			default:
				break;
		}

	}
	
	function playColor(num) {
		switch (num) {
			case 1:
				audioBlack.play();
				break;
			case 2:
				audioRed.play();
				break;
			case 3:
				audioBrown.play();
				break;
			case 4:
				audioGray.play();
				break;
			case 5:
				audioBlue.play();
				break;
			case 6:
				audioGreen.play();
				break;
			case 7:
				audioOrange.play();
				break;
			case 8:
				audioYellow.play();
				break;
			case 9:
				audioWhite.play();
				break;
			case 0:
				audioPurple.play();
				break;
			case 10:
				audioPink.play();
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
	
	/*
	function rgbToHex(rgb) {
		var rgbvals = /rgb\((.+),(.+),(.+)\)/i.exec(rgb);
		var rval = parseInt(rgbvals[1]).toString;
		var gval = parseInt(rgbvals[2]);
		var bval = parseInt(rgbvals[3]);
		return '#' + (
			rval.toString(16) +
			gval.toString(16) +
			bval.toString(16)).toUpperCase();
	}*/
	
	function rgbToHex(rgb) {
		var rgbRegex = /^rgb\(\s*(-?\d+)(%?)\s*,\s*(-?\d+)(%?)\s*,\s*(-?\d+)(%?)\s*\)$/;
		var result, r, g, b, hex = "";
		if ((result = rgbRegex.exec(rgb))) {
			r = componentFromStr(result[1], result[2]);
			g = componentFromStr(result[3], result[4]);
			b = componentFromStr(result[5], result[6]);

			hex = "0x" + (0x1000000 + (r << 16) + (g << 8) + b).toString(16).slice(1);
		}
		return hex;
	}
	
	function componentFromStr(numStr, percent) {
		var num = Math.max(0, parseInt(numStr, 10));
		return percent ?
	Math.floor(255 * Math.min(100, num) / 100) : Math.min(255, num);
	}

</script>

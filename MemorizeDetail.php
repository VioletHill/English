<?php
session_start();
header("Content-Type: text/html; charset=utf8");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="MemorizeDetail/MemorizeDetail.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="MemorizeDetail/MemorizeDetail.js"></script>
	</head>
	
	<body>
		<?php
			include_once ("Navigation.php");
		?>
		
		<div class="BackGuide">

			<a href="Memorize.php"  style="float:right">
				<img src="images/back.png" width="41px" height="31px"/>
			</a>
			<button class="markButton" onclick="mark()" ></button>
		</div>
		
		<div class="mainDiv">
			<div class="leftContainer">
				
				<div class="chooseButton" onclick="selectWord(this)"></div>
				<div class="chooseButton" onclick="selectWord(this)"></div>
				<div class="chooseButton" onclick="selectWord(this)"></div>
				<div class="chooseButton" onclick="selectWord(this)"></div>

				<div class="nextButton" onclick="goToNextWord()"></div>
			</div>

			<div class="rightContainer">

				<div class="transContainer"><pre></pre></div>
			</div>
		</div>
	</body>
</html>
<?php
session_start();
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Memorize/Memorize.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="Memorize/Memorize.js"></script>
	</head>
	
	<body>
		<?php
			include_once ("Navigation.php");
		?>
		<div class="mainDiv">
			<div class="guide" style="float:right">
				<a href="MemorizeDetail.php" class="memorizeDetailButton">
					<img src="images/go.png" width="37px" height="31px" class="go"/>
				</a>
				<a href="Choose.php" class="backButton">
					<img src="images/back.png" width="41px" height="31px"/>
				</a>
			</div>

			<div class="wordContainer" id="wordContainer">
<!-- 				<div class="wordCell">
					<span class="wordTitle">wordTitle</span>
					<button class="wordVoice"></button>
					<span class="wordMeaning"></span>
				</div> -->
			</div>

			<div class="page">
				<button class="lastPage pageButton" onclick="getLastPage()"></button>
				<button class="nextPage pageButton" onclick="getNextPage()"></button>
			</div>
		</div>
		<embed id="player" src="" loop="0" autostart="true" hidden="true"></embed>
	</body>
</html>
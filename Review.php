<?php
session_start();
header("Content-Type: text/html; charset=utf8");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Review/Review.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="Review/Review.js"></script>
	</head>
	
	<body>
		<?php
			include_once ("Navigation.php");
		?>
		<div class="mainDiv">
			<div class="guide" style="float:right">
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

		</div>
	</body>
</html>
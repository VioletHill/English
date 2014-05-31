<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Choose/Choose.css">
		<script src="jquery.2.1.1.js"></script>
	</head>
	
	<body>
		<?php
			include_once ("Navigation.php");
		?>
		<div class="mainDiv">
			
			<div class="guide">
				<span style="margin-left:30px">
					<img src="images/welcome.png" width="27px" height="31px" />
					<span class="WelcomeInfo">  WELCOME <?php  echo $user->getAccount(); ?></span>
					<a href="index.php" style="float:right">
						<img src="images/back.png" width="41px" height="31px" />
					</a>
				</span>
			</div>

			<div class="chooseContainer">
				<div class="leftContainer">
					<div>
						<a href="person.php"><img src="images/personal_info.png" width="257px" height="192px"></a>
					</div>
					<div>
						<a href="review.php"><img src="images/review.png" width="257px" height="126px"></a>
					</div>
				</div>
				
				<div class="midiumContainer">
					<div>
						<a href="search.php"><img src="images/search.png" width="152px" height="237px"></a>
					</div>
					<div>
						<a href="plan.php"><img src="images/plan.png" width="152px" height="80px"></a>
					</div>
				</div>
				
				<div class="rightContainer">
					<div>
						<a href="memorize.php"><img src="images/memorize.png" width="203px" height="120px"></a>
					</div>
					<div>
						<a href=""><img src="images/blank.png" width="203px" height="198px"></a>
					</div>
				</div>
			</div>

			<div style="clear:both; float:right; margin-top:20px;">
				<a href="mailto:reciteword531@163.com?subject=recite word suggesstion">
				<img src="images/contact_us.png"/ width="174px" height="51px">
				</a>
			</div>
		</div>
	</body>
</html>
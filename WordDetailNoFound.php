<?php
	session_start();
?>

<html>	
	<head>
		<link rel="stylesheet" type="text/css" href="WordDetail/WordDetail.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="WordDetail/WordNoFound.js"></script>
	</head>
	<body>
 		<?php
			include_once ("Navigation.php");
		?> 
		
		<div class="mainDiv">

			<div class="backItemDiv">
				<a href="choose.php">
					<img class="backItem" src="images/back.png" />
				</a>
			</div>
			
			<div class="errorMsg" style="font-size:20px; text-align:center">
			</div>
		</div>
	<body>
</html>
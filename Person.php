<?php
	session_start();
?>

<html>	
	<head>
		<link rel="stylesheet" type="text/css" href="Person/Person.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="Person/Person.js"></script>
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
			
			<div class="leftContainer">
				<div class="info">
					<span>PLAN FOR NOW:</span>
					<span class="infoAnswer"><?php echo $user->getDictionary()->getName(); ?></span>
				</div>
				<div class="info">
					<span>PROCESS:</span>
					<span class="infoAnswer"><?php echo $user->getProcess()?></span>
				</div>
				<div class="info">
					<span>RANKING:</span>
					<span class="infoAnswer"><?php echo $user->getRanking()?></span>
				</div>
				<div>
					<button class="detailButton" onclick="toggleRightContainer()"></button>
				</div>
			</div>

			<div class="rightContainer">
				<div class="rankBox" selfName="<?php echo $user->getAccount(); ?>">
					<div class="rankTitle">RANKING</div>
					<div class="rankPerson">
						<div id="rank1" class="rankItem">
							<img src="images/champion.png" width="32px" height="36px" />
							<span class="rankName"></span>
						</div>
						<div id="rank2" class="rankItem">
							<img src="images/second_place.png" width="32px" height="36px" />
							<span class="rankName"></span>
						</div>
						<div id="rank3" class="rankItem">
							<img src="images/third.png" width="32px" height="36px" />
							<span class="rankName"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
</html>
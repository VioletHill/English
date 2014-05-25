<?php 	
	session_start();
?>

<html>
	<head>	
		<link rel="stylesheet" type="text/css" href="Plan/Plan.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="Plan/Plan.js"></script>
	</head>

	<body>
		<?php
			include_once ("Navigation.php");
		?>

		<!-- mainDiv is the main Container -->
		<div class="mainDiv">
			<!-- plant Navigation is navigation  -->
			<!-- if you want to add something in navigation just add in this div -->
			<div class="backItemDiv">
				<img class="backItem" src="images/back.png" />
			</div>

			<div class="wordPlanDiv">
				<div>
					<img class="wordPlanItem" src="images/cet4_off.png" key="cet4" />
					<img class="wordPlanItem" src="images/cet6_off.png" key="cet6" />
					<img class="wordPlanItem" src="images/kaoyan_off.png" key="kaoyan" />
				</div>
				<div>
					<img class="wordPlanItem" src="images/ielts_off.png" key="ielts" />
					<img class="wordPlanItem" src="images/toefl_off.png" key="toefl" />
					<img class="wordPlanItem" src="images/other_off.png" key="other" />
				</div>
				<script>
					<?php
						$user=unserialize( $_SESSION['user'] );
					?>
					var dictionaryName='<?php echo $user->getDictionary()->getName(); ?>'
					setDefaultClick(dictionaryName);
				</script>
			</div>

		</div>

	</body>

</html>
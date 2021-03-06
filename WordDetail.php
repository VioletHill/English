<?php
	session_start();
	header("Content-Type: text/html; charset=utf8");
	include_once('WordDao.php');
	$wordName=$_GET['word'];
	$word=WordDao::sharedWordDao()->getWordByCompleteName($wordName);
	if ($word->getWordID()==null)			//wrong url
	{
		echo "<script> window.location.href='WordDetailNoFound.php' </script>";
		return  ;
	}
?>

<html>
	<head>
		<meta http-equiv="charset">
		<link rel="stylesheet" type="text/css" href="WordDetail/WordDetail.css">
		<script src="jquery.2.1.1.js"></script>
		<script src="WordDetail/WordDetail.js"></script>
	</head>
	<body>
		<?php
			include_once ("Navigation.php");
		?>
		<div class="mainDiv">
			<div class="backItemDiv">
				<a href="javascript:window.location=document.referrer">
				<img class="backItem" src="images/back.png" />
				</a>
			</div>
			<div class="box">
				<div class="leftContainer">
					<div class="title">
						<span class="wordName"><?php echo $word->getName(); ?></span>
						<span class="phonetic phoneticEn">音标: <?php echo $word->getPhoneticEn(); ?></span>
						<!-- <span class="phonetic phoneticUs">美: </span> -->
						<button class="voiceButton" onclick="readWord()"></button>
					</div>
					
					<div class="transContainer"><pre><?php echo $word->getTrans(); ?></pre></div>
				</div>
				<div class="rightContainer">
					<div>
						<button class="markButton" onclick="mark()"></button>
					</div>
					<div >
						<img src="WordImages/<?php echo $word->getName(); ?>.jpg" class="wordImage">
					</div>
				</div>
			</div>
		</div>
	<body>
</html>
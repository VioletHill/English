<link rel="stylesheet" type="text/css" href="Navigation/Navigation.css">
<script src="Navigation/Navigation.js"></script>

<?php 
	require_once ('UserBean.php');
	require_once ('DictionaryBean.php');
	
	$user=unserialize( $_SESSION['user'] );
	if ($user==null)
	{
		echo "<script>location.href='index.php';</script>"; 
		return ;
	}
?>

<div class="planNavigation">
	<div class="navigationDate">a</div>
	<div class="navigationUserInfo">
		<span id="navAccount">WELCOME <?php echo $user->getAccount(); ?></span>
		<span id="navDictionary" class="navigationDictionary"><?php echo $user->getDictionary()->getName(); ?></span>
		<span id="navProcess" class="navigatonnProcess"><?php echo $user->getProcess()?> </span>
		<span style="float:right; margin-right:10px;"><a href="index.php" style="color:white">log out</a></span>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="Navigation/Navigation.css">
<script src="Navigation/Navigation.js"></script>

<?php 
	require_once ('UserBean.php');
	$user=unserialize( $_SESSION['user'] );
?>

<div class="planNavigation">
	<div class="navigationDate"></div>
	<div class="navigationUserInfo">
		<span>WELCOME <?php echo $user->getAccount() ?></span>
		<span class="navigationDictionary"></span>
		<span class="navigatonnProcess"></span>
	</div>
</div>
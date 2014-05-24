<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Index/Index.css">

		<script src="jquery-1.7.2.min.js"></script>
		<script src="jquery.md5.js"></script>
		<script src="Index/Index.js"></script>
	</head>

	<body>
		<!-- login navigation div -->
		<div class="loginNavigationContainer">
			<div class="loginNavigation">
				
			</div>
		</div>
		
		<div class="formContainer">
			<div class="tabButtonDiv">	
				<button class="tabButton loginButton tabButtonSelect">LOG IN</button>
				<button class="tabButton registerButton tabButtonUnselect">REGISTER </button>
			</div>

			<form class="loginForm" method="post" action="Login.php" onkeyDown="loginFormKeyDown(event)">
				<div class="loginName">
					<div class="fontText">NAME</div>
					<input type="textfield" id="loginName" class="textField"/>
				</div>
				<div class="loginPassword">
					<div class="fontText">PASSWORD</div>
					<input type="password" id="loginPassword" class="textField"/>
				</div>
				<div>
					<input type="button" class="submitButton" value="SUBMIT" onclick="loginButtonClick()"/>
				</div>
			</form> 

			<form class="RegisterForm" method="post" onkeyDown="registerFormKeyDown(event)">
				<div class="loginName">
					<div class="fontText">NAME</div>
					<input type="textfield" id="registerName" class="textField"/>
				</div>
				<div class="loginPassword">
					<div class="fontText">PASSWORD</div>
					<input type="password" id="registerPassword" class="textField"/>
				</div>
				<div class="loginPassword">
					<div class="fontText">CONFIRM</div>
					<input type="password" id="registerPasswordConfirm" class="textField"/>
				</div>
				<div>
					<input type="button" class="submitButton" value="REGISTER" onclick="registerButtonClick()"/>
				</div>
			</form>
		</div>
	</body>
</html>
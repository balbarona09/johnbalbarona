<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/admin.css">
		<title>Admin - Log in</title>
	</head>
	<body>
		<div class="loader-container loader-hide" id="loader">
			<div class="loader"></div>
		</div>
		<main class="login-container">
			<div class="login-title-container">
				<h1>Log in</h1>
			</div>
			<div id="result" class="alert">Email or Password is incorrect. Please try again.</div>
			<form id="login-form">
				<div>
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="login-textbox" placeholder="example@abc.com" required>
				</div>
				<div>
					<label for="password" >Password</label>
					<input type="password" name="password" id="password" class="login-textbox" placeholder="Your Password" required>
				</div>
				<div>
					<a href="forgot-password.php" class="forgot-password-link">Forgot Password?</a>
				</div>
				<div>
					<input type="submit" value="Log in" class="login-button">
				</div>
			</form>
		</main>		
		<script src="../js/admin.js"></script>
		<script src="../js/login.js" type="module"></script>
	</body>
</html>
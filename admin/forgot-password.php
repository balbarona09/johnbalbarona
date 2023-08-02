<?php
	session_start();
	
	require_once '../classes/AccountVerification.php';
	
	if(isset($_SESSION['FORGOT_ACCOUNT_VERIFICATION'])) {
		$accountVerification = unserialize($_SESSION['FORGOT_ACCOUNT_VERIFICATION']);
	}
	else {
		$accountVerification = new AccountVerification('', '', 'johnbalbarona', 'johnbalbarona - Verification Code');
		$_SESSION['FORGOT_ACCOUNT_VERIFICATION'] = serialize($accountVerification);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/admin.css">
		<title>Admin - Forgot Password</title>
	</head>
	<body>
		<div class="loader-container loader-hide" id="loader">
			<div class="loader"></div>
		</div>
		<main class="login-container">
			<div class="login-title-container">
				<h1>Reset Password</h1>
			</div>
			<div id="result"></div>
			<?php if($accountVerification->getStatus() == 'SEND CODE'): ?>
			<form id="forgot-sendcode-form">
				<div>
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="login-textbox" placeholder="example@abc.com" required>
				</div>
				<div>
					<input type="submit" value="Send Verification Code" class="login-button">
				</div>
			</form>
			<div>
				<a href="login.php" class="forgot-password-link">Log in</a>
			</div>
			
			<?php elseif($accountVerification->getStatus() == 'VERIFY CODE'): ?>
			<form id="forgot-verifycode-form">
				<div>
					<label for="code">Enter Verification Code</label>
					<p class="forgot-password-note">
						If <span><?php echo $accountVerification->getEmail(); ?></span> 
						exist in our sytem you will receive a code. Enter that code below. 
						You only have 
						<span id="attempts"><?php echo $accountVerification->getAttempts(); ?></span> attempts.
					</p>
					<input type="text" name="code" id="code" class="login-textbox" placeholder="Your code" required>
				</div>
				<div>
					<input type="submit" value="Verify Code" class="login-button">
				</div>
			</form>
			<div class="login-link-container">
				<a href="javascript:void(0);" id="forgot-resendcode" class="forgot-password-link disabled-link">Resend Code(120)</a>
				<a href="javascript:void(0);" id="forgot-change-email" class="forgot-password-link">Change Email</a>
			</div>
			
			<?php elseif($accountVerification->getStatus() == 'VERIFIED'): ?>
			<form id="forgot-change-password-form">
				<div>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="login-textbox" placeholder="Must be atleast 8 characters" required>
				</div>
				<div>
					<label for="confirm-password">Confirm Password</label>
					<input type="password" name="confirm-password" id="confirm-password" class="login-textbox" placeholder="Must match the password" required>
				</div>
				<div>
					<input type="submit" value="Reset Password" class="login-button">
				</div>
			</form>
			
			<!-- Modal For Successfull Forgot Password - Start -->
			<div id="forgot-password-modal" class="login-modal">
				<div class="login-modal-content">
					<div class="login-modal-header">
						<h5>Reset Password Successfully</h5>
					</div>
					<div class="login-modal-body">
						<p>Redirect to Login Page in <span id="counter">5</span></p>
					</div>
					<div class="login-modal-footer">
						<a href="login.php">Go to Login</a>
					</div>
				</div>
			</div>
			<!-- Modal For Successfull Forgot Password - End -->
			
		<?php endif; ?>
		</main>
		
		<script src="../js/admin.js"></script>
		<script src="../js/forgot-password.js" type="module"></script>
	</body>
</html>
<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'PROFILE';
$_SESSION['DROPDOWN_PAGE'] = 'PROFILE';
require_once 'includes/head.php'; 
require_once 'includes/sidebar.php'; 

// For changing of email.
require_once '../classes/AccountVerification.php';
	
if(isset($_SESSION['CHANGE_EMAIL_VERIFICATION'])) {
	$accountVerification = unserialize($_SESSION['CHANGE_EMAIL_VERIFICATION']);
}
else {
	$accountVerification = new AccountVerification('', '', 'johnbalbarona', 'johnbalbarona - Verification Code');
	$_SESSION['CHANGE_EMAIL_VERIFICATION'] = serialize($accountVerification);
}

?>

<div class="loader-container loader-hide" id="loader">
	<div class="loader"></div>
</div>

<div class="main-content">
	<?php require_once 'includes/topbar.php'; ?>
	<div class="form-alert-container">
		<div id="result" class="alert"></div>
	</div>
	<div class="profile-container">
		<div class="profile-item">
			<h5 class="profile-item-title">Profile</h5>
			<form class="profile-form" id="edit-profile-form">
				<div class="profile-form-container">
					<label for="fullname" class="form-label">Fullname</label>
					<input type="text" id="fullname" name="fullname" placeholder="Firstname Lastname" class="form-control" required>
				</div>
				<div class="profile-form-container">
					<input type="submit" value="Save" class="form-submit">
				</div>
			</form>
		</div>
		
		<?php if($accountVerification->getStatus() == 'VERIFIED'): 
			$accountVerification = new AccountVerification('balbarona09@gmail.com', 'kluuidjvywejjjft', 'johnbalbarona', 'johnbalbarona - Verification Code');
			$_SESSION['CHANGE_EMAIL_VERIFICATION'] = serialize($accountVerification);
		?>
			<div class="alert alert-success" style="display: block;">Email Successfully changed </div>
		<?php endif; ?>
		<div id="result-email" class="alert"></div>
		<div class="profile-item">
			<h5 class="profile-item-title">Email</h5>
			<?php if($accountVerification->getStatus() == 'SEND CODE'): ?>
			<form class="profile-form" id="edit-email-sendcode-form">
				<div class="profile-form-container">
					<label for="password" class="form-label">Password</label>
					<input type="password" id="password" name="password" placeholder="Enter your password" class="form-control">
				</div>
				<div class="profile-form-container">
					<label for="email" class="form-label">Email</label>
					<input type="email" id="email" name="email" placeholder="Ex. abc@gmail.com" class="form-control">
				</div>
				<div class="profile-form-container">
					<input type="submit" value="Send Verification Code" class="form-submit">
				</div>
			</form>
			<?php elseif($accountVerification->getStatus() == 'VERIFY CODE'): ?>
			<form class="profile-form" id="edit-email-verifycode-form">
				<div class="profile-form-container">
					<label for="code" class="form-label change-email-label">Enter Verification Code</label>
					<p class="change-email-note">We just sent a verification code to <span><?php echo $accountVerification->getEmail(); ?></span>. 
					Enter that code below. You only have <span id="attempts"><?php echo $accountVerification->getAttempts(); ?></span> attempts.</p>
					<input type="text" id="code" name="code" placeholder="Your Code" class="form-control">
				</div>
				<div class="profile-form-container">
					<input type="submit" value="Verify Code" class="form-submit">
				</div>
			</form>
			<div class="resend-code-container">
				<a href="javascript:void(0);" id="edit-email-resendcode" class="resend-code-btn resend-disabled">Resend Code(120)</a>
				<a href="javascript:void(0);" id="edit-email-change-email" class="change-email-btn">Change Email</a>
			</div>
			<?php endif; ?>
		</div>
		
		<div id="result-password" class="alert"></div>
		<div class="profile-item">
			<h5 class="profile-item-title">Password</h5>
			<form class="profile-form" id="edit-password-form">
				<div class="profile-form-container">
					<label for="current-password" class="form-label">Current Password</label>
					<input type="password" id="current-password" name="current-password" placeholder="Enter your current password" class="form-control" required>
				</div>
				<div class="profile-form-container">
					<label for="new-password" class="form-label">New Password</label>
					<input type="password" id="new-password" name="new-password" placeholder="Must be atleast 8 characters" class="form-control" minlength="8" required>
				</div>
				<div class="profile-form-container">
					<label for="confirm-password" class="form-label">Confirm Password</label>
					<input type="password" id="confirm-password" name="confirm-password" placeholder="Must match the password" class="form-control" required>
				</div>
				<div class="profile-form-container">
					<input type="submit" value="Change Password" class="form-submit">
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../js/profile.js" type="module"></script>
<?php require_once 'includes/foot.php' ?>
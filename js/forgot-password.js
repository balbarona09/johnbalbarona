import {ajax} from './ajax.js';

const sendCodeForm = document.getElementById('forgot-sendcode-form');
const verifyCodeForm = document.getElementById('forgot-verifycode-form');
const changeEmailButton = document.getElementById('forgot-change-email');
const resendCodeButton = document.getElementById('forgot-resendcode');
const resetPasswordForm = document.getElementById('forgot-change-password-form');

if(sendCodeForm != null) {
	sendCodeForm.addEventListener('submit', sendCode);
	
	function sendCode(e) {
		e.preventDefault();
		startLoading();
		let email = document.getElementById('email');
		ajax({'email' : email.value}, '../ajaxPhp/forgot-password.php', handleSendCode);
		
		function handleSendCode(response) {
			if(response == 1) {
				location.reload();
			}
			else {
				displayResult('Code not sent! Please try again!','danger');
			}
			stopLoading();
		}
	}
}

if(verifyCodeForm != null) {
	let resendCounter = 120;
	let resendTimer = setInterval(resendTimerFunction, '1000');
	
	verifyCodeForm.addEventListener('submit', verifyCode);
	
	function verifyCode(e) {
		e.preventDefault();
		startLoading();
		let code = document.getElementById('code');
		ajax({'code' : code.value}, '../ajaxPhp/forgot-password.php', handleVerifyCode);
		
		function handleVerifyCode(response) {
			if(response == 1) {
				location.reload();
			}
			else if(response == 2){
				displayResult('Code is incorrect','danger');
				document.getElementById('attempts').innerHTML -= 1;
			}
			else if(response == 3) {
				document.getElementById('attempts').innerHTML = 0 ;
				displayResult('You have used all your attempts. You can resend new code after 2 minutes.','danger');
				disableResend();
				clearInterval(resendTimer);
				resendTimer = setInterval(resendTimerFunction, '1000');
			}
			stopLoading();
		}
	}
	
	resendCodeButton.addEventListener('click', resendCode);
	
	function resendCode() {
		if(resendCounter < 0) {
			startLoading();
			ajax({'action': 'RESEND CODE'},'../ajaxPhp/forgot-password.php', handleResendCode);
		}
		
		function handleResendCode(response) {
			if(response == 1) {
				displayResult('We have sent a new verification code.', 'success');
				disableResend();
				resendTimer = setInterval(resendTimerFunction, '1000');
				document.getElementById('attempts').innerHTML = 5;
			}
			else {
				displayResult('Code not sent. Please try again!','danger')
			}
			stopLoading();
		}
	}
	
	function resendTimerFunction() {
		resendCodeButton.innerHTML = 'Resend Code(' + resendCounter + ')';
		resendCounter--;
		if(resendCounter < 0) {
			clearInterval(resendTimer);
			resendCodeButton.innerHTML = 'Resend Code';
			resendCodeButton.classList.remove('disabled-link')
		}
	}
	function disableResend() {
		resendCounter = 120;
		resendCodeButton.classList.add('disabled-link');
	}
}

if(resetPasswordForm != null) {
	resetPasswordForm.addEventListener('submit', resetPassword);
	
	function resetPassword(e) {
		e.preventDefault();
		startLoading();
		let password = document.getElementById('password');
		let confirmPassword = document.getElementById('confirm-password');
		ajax({'password' : password.value, 'confirmPassword' : confirmPassword.value}, 
		'../ajaxPhp/forgot-password.php', handleResetPassword);
		
		function handleResetPassword(response) {
			if(response == 1) {
				let modal = document.getElementById('forgot-password-modal');
				modal.style.display = 'block';
				let counter = 5;
				setTimeout(function() {location.replace('login.php'); }, "5000");
				setInterval(function() {counter--; document.getElementById('counter').innerHTML = counter;}, '1000');
			}
			else if(response == 'Password do not match') {
				displayResult('Password do not match. Please try again.', 'danger');
			}
			else {
				displayResult('Something went wrong. Please try again.','danger');
			}
			stopLoading();
		}
	}
}

if(changeEmailButton != null) {
	changeEmailButton.addEventListener('click', changeEmail);
	
	function changeEmail() {
		ajax({'action': 'CHANGE EMAIL'},'../ajaxPhp/forgot-password.php', handleChangeEmail);
		
		function handleChangeEmail(response) {
			if(response == 1) {
				location.reload();
			}
			else {
				alert('Something went wrong! Please try again');
			}
		}
	}
}
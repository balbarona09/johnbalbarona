import {ajax} from './ajax.js';

const editProfileForm = document.getElementById('edit-profile-form');
const editPasswordForm = document.getElementById('edit-password-form');
//For changing Email.
const sendCodeForm = document.getElementById('edit-email-sendcode-form');
const verifyCodeForm = document.getElementById('edit-email-verifycode-form');
const insertAccountForm = document.getElementById('edit-email-insertaccount-form');
const changeEmailButton = document.getElementById('edit-email-change-email');
const resendCodeButton = document.getElementById('edit-email-resendcode');
let resendCounter = 120;
let resendTimer;

getProfile();

editProfileForm.addEventListener('submit', editProfile);
editPasswordForm.addEventListener('submit', editPassword);

if(sendCodeForm != null) {
	sendCodeForm.addEventListener('submit', sendCode);
}
if(verifyCodeForm != null) {
	resendTimer = setInterval(resendTimerFunction, '1000');
	verifyCodeForm.addEventListener('submit', verifyCode);
	resendCodeButton.addEventListener('click', resendCode);	
	changeEmailButton.addEventListener('click', changeEmail);
}

function editProfile(e) {
	e.preventDefault();
	startLoading();
	const fullname = document.getElementById('fullname');
	ajax({'fullname': fullname.value, 'action' : 'editProfile'}, '../ajaxPhp/profile.php', handleResult);
	
	function handleResult(response) {
		if(response == 'success') {
			displayResult('Profile successfully updated.', 'success');
			document.getElementById('topbar-fullname').innerHTML = fullname.value;
		}
		else {
			displayResult('Somethig went wrong.', 'danger');
		}
		stopLoading();
	}
}

function editPassword(e) {
	e.preventDefault();
	startLoading();
	const currentPassword = document.getElementById('current-password');
	const password = document.getElementById('new-password');
	const confirmPassword = document.getElementById('confirm-password');
	ajax({'currentPassword': currentPassword.value, 'password': password.value, 'confirmPassword': confirmPassword.value,  
	'action' : 'editPassword'}, '../ajaxPhp/profile.php', handleResult)
	
	function handleResult(response) {
		if(response == 'success') {
			editPasswordForm.reset();
			displayResult('Password successfully updated.', 'success', 'result-password');
		}
		else if(response == 'wrong_current_password') {
			displayResult('Current Password is incorrect.', 'danger', 'result-password');
		}
		else if(response == 'password_less_than_eight') {
			displayResult('Password must be atleast 8 characters.', 'danger', 'result-password');
		}
		else if(response == 'passwords_do_not_match') {
			displayResult('Passwords do not match.', 'danger', 'result-password');
		}
		else {
			console.log(response);
			displayResult('Somethig went wrong.', 'danger', 'result-password');
		}
		stopLoading();
	}
}

function getProfile() {
	startLoading();
	ajax({'action' : 'getProfile'}, '../ajaxPhp/profile.php', handleResult);
	
	function handleResult(response) {
		if(response == 'error') {
			displayResult('Somethig went wrong.', 'danger');
		}
		else {
			displayProfile(JSON.parse(response));
		}
		stopLoading();
	}
}

function displayProfile(profile) {
	const fullname = document.getElementById('fullname');
	const email = document.getElementById('email');
	
	fullname.value = profile[0]['fullname'];
	if(email != null) {
		email.value = profile[0]['email'];
	}
}

function sendCode(e) {
	e.preventDefault();
	startLoading();
	let email = document.getElementById('email');
	let password = document.getElementById('password');
	ajax({'email' : email.value, 'password': password.value, 'action': 'editEmail'}, 
	'../ajaxPhp/profile.php', handleResult);
		
	function handleResult(response) {
		if(response == 1) {
			location.reload();
		}
		else if(response == 'wrong_current_password') {
			displayResult('Current Password is incorrect.','danger', 'result-email');
		}
		else {
			let result = response == 'Email is already used' ? response : 'Code not sent. Please try again!';
			displayResult(result,'danger', 'result-email');
		}
		stopLoading();
	}
}	

function verifyCode(e) {
	e.preventDefault();
	startLoading();
	let code = document.getElementById('code');
	ajax({'action': 'editEmail', 'code' : code.value}, '../ajaxPhp/profile.php', handleResult);
		
		
	function handleResult(response) {
		if(response == 1) {
			location.reload();
		}
		else if(response == 2){
			displayResult('Code is incorrect.', 'danger', 'result-email');
			document.getElementById('attempts').innerHTML -= 1;
		}
		else if(response == 3) {
			document.getElementById('attempts').innerHTML = 0 ;
			displayResult('You have used all your attempts. You can resend new code after 2 minutes.', 'danger', 'result-email');
			disableResend();
			clearInterval(resendTimer);
			resendTimer = setInterval(resendTimerFunction, '1000');
		}
		else {
			displayResult('Something went wrong!', 'danger', 'result-email');
		}
		stopLoading();
	}
}

function resendCode() {
	if(resendCounter < 0) {
		startLoading();
		ajax({'action': 'editEmail', 'action2': 'RESEND CODE'},'../ajaxPhp/profile.php', handleResult)
	}
	
	function handleResult(response) {
		if(response == 1) {
			displayResult('We have sent a new verification code.','success', 'result-email');
			disableResend();
			resendTimer = setInterval(resendTimerFunction, '1000');
			document.getElementById('attempts').innerHTML = 5;
		}
		else {
			displayResult('Something went wrong! Please try again!','danger', 'result-email');
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
		resendCodeButton.classList.remove('resend-disabled');
	}
}

function disableResend() {
	resendCounter = 120;
	resendCodeButton.classList.add('resend-disabled');
}

function changeEmail() {
	ajax({'action': 'editEmail', 'action2': 'CHANGE EMAIL'},'../ajaxPhp/profile.php', handleResult);
	
	function handleResult(response) {
		if(response == 1) {
			location.reload();
		}
	}
}
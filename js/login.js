import {ajax} from './ajax.js';

const loginForm = document.getElementById('login-form');

loginForm.addEventListener('submit', login);

function login(e) {
	e.preventDefault();
	startLoading();
	let email = document.getElementById('email');
	let password = document.getElementById('password');
	ajax({'email': email.value, 'password': password.value}, '../ajaxPhp/login.php', handleLogin);
	
	function handleLogin(response) {
		if(response == 1) {
			location.replace('index.php');
		}
		else {
			displayResult('Email or Password is incorrect. Please try again.', 'danger');
		}
		stopLoading();
	}
}
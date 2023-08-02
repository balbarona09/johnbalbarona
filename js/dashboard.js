import {ajax} from './ajax.js';

getDashboard();

function getDashboard() {
	startLoading();
	ajax({'action' : 'getDashboard'}, '../ajaxPhp/dashboard.php', handleResult);
	
	function handleResult(response) {
		if(response == 'error') {
			displayResult('Somethig went wrong.', 'danger');
		}
		else {
			displayDashboard(JSON.parse(response));
		}
		stopLoading();
	}
}

function displayDashboard(data) {
	const dashboardSkills = document.getElementById('dashboard-skills');
	const dashboardProjects = document.getElementById('dashboard-projects');
	const dashboardContacts = document.getElementById('dashboard-contacts');
	
	dashboardSkills.innerHTML = data[0]['skills'];
	dashboardProjects.innerHTML = data[0]['projects'];
	dashboardContacts.innerHTML = data[0]['contacts'];
}
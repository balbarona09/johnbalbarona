import {ajax} from './ajax.js';

const addForm = document.getElementById('add-form');

addForm.addEventListener('submit', addRecord);

function addRecord(e) {
	e.preventDefault();
	startLoading();
	const name = document.getElementById('name');
	const icon = document.getElementById('icon');
	const description = document.getElementById('description');
	ajax({'name': name.value, 'icon' : icon.value, 'description': description.value, 'action' : 'addSkills'}, 
	'../ajaxPhp/skills.php', handleResult);
	
	function handleResult(response) {
		if(response == 'success') {
			addForm.reset();
			displayResult('Skill successfully added.', 'success');
		}
		else if(response == 'already_exist') {
			displayResult('Skill name already exist.', 'danger');
		}
		else if(response == 'incomplete_data') {
			displayResult('Please complete the form.', 'danger');
		}
		else {
			displayResult('Somethig went wrong.', 'danger');
		}
		setTimeout(stopLoading, 300);
	}
}
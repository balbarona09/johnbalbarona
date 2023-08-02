import {ajax} from './ajax.js';

const addForm = document.getElementById('add-form');

addForm.addEventListener('submit', addRecord);

function addRecord(e) {
	e.preventDefault();
	startLoading();
	const name = document.getElementById('name');
	const type = document.getElementById('type');
	const value = document.getElementById('value');
	ajax({'name': name.value, 'type' : type.value, 'value': value.value, 'action' : 'addContacts'}, 
	'../ajaxPhp/contacts.php', handleResult);
	
	function handleResult(response) {
		if(response == 'success') {
			addForm.reset();
			displayResult('Contact successfully added.', 'success');
		}
		else if(response == 'incomplete_data') {
			displayResult('Please complete the form.', 'danger');
		}
		else {
			console.log(response);
			displayResult('Somethig went wrong.', 'danger');
		}
		setTimeout(stopLoading, 300);
	}
}
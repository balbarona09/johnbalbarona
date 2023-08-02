import {ajax} from './ajax.js';

const addForm = document.getElementById('add-form');

addForm.addEventListener('submit', addRecord);

function addRecord(e) {
	e.preventDefault();
	startLoading();
	const name = document.getElementById('name');
	const languages = document.getElementById('languages');
	const thumbnail = document.getElementById('thumbnail');
	const url = document.getElementById('url');
	ajax({'name': name.value, 'languages': languages.value, 'thumbnail': thumbnail.files[0], 'url': url.value, 'action' : 'addProjects'}, 
	'../ajaxPhp/projects.php', handleResult);
	
	function handleResult(response) {
		if(response == 'success') {
			addForm.reset();
			displayResult('Project successfully added.', 'success');
		}
		else if(response == 'already_exist') {
			displayResult('Project name already exist.', 'danger');
		}
		else if(response == 'incomplete_data') {
			displayResult('Please complete the form.', 'danger');
		}
		else if(response == 'invalid_image') {
			displayResult('Please upload png or jpeg or gif file only.', 'danger');
		}
		else if(response == 'invalid_image_size') {
			displayResult('Please upload no more than 2mb image file size.', 'danger');
		}
		else {
			displayResult('Something went wrong.', 'danger');
		}
		setTimeout(stopLoading, 300);
	}
}
import {ajax} from './ajax.js';

let counter = 1;
let offset = 0;
let limit = 10;
let order = 'id';
let sort = 'ASC';
let status = 0;
const editModal = document.getElementById('edit-modal');
const deleteModal = document.getElementById('delete-modal');
const closeEditModal = document.getElementById('close-edit-modal');
const closeDeleteModal = document.getElementById('close-delete-modal');
const editId = document.getElementById('edit-id');
const editName = document.getElementById('name');
const editIcon = document.getElementById('icon');
const editDescription = document.getElementById('description');
const deleteId = document.getElementById('delete-id');
const nextButton = document.getElementById('next');
const previousButton = document.getElementById('previous');
const limitSelect = document.getElementById('limit');
const deleteForm = document.getElementById('delete-form');
const editForm = document.getElementById('edit-form');

getData();

limitSelect.addEventListener('change', handleLimit);
nextButton.addEventListener('click', showNextData);
previousButton.addEventListener('click', showPreviousData);
closeEditModal.addEventListener('click', closeEdit);
closeDeleteModal.addEventListener('click', closeDelete);
deleteForm.addEventListener('submit', deleteRecord);
editForm.addEventListener('submit', editRecord);

function getData() {
	nextButton.setAttribute("disabled", true);
	previousButton.setAttribute("disabled", true);
	ajax({'action': 'getSkills', 'limit': limit, 'offset': offset, 'order': order, 'sort': sort, 'status': status}, 
	'../ajaxPhp/skills.php', displayData)
}

function displayData(response) {
	const data = JSON.parse(response);
	const table = document.getElementById('manage-table');
	const entriesStatement = document.getElementById('entries-statement');
	entriesStatement.innerHTML = data.length == 1 ? 'Showing 0' : 'Showing ' + counter;
	table.innerHTML = '';
	for (let counterLoop = 0; counterLoop < data.length; counterLoop++) {
		
		if(counterLoop == data.length - 1) {
			entriesStatement.innerHTML += ' to ' + --counter + ' of ' + data[counterLoop] + ' entries ';
			if(offset != 0) {
				previousButton.removeAttribute("disabled");
			}
			if(counter != data[counterLoop]) {
				nextButton.removeAttribute("disabled");
			}
			break;
		}
			
		const tr = document.createElement('tr');
		const thCounter = document.createElement('th');
		const tdName = document.createElement('td');
		const tdIcon = document.createElement('td');
		const tdDescription = document.createElement('td');
		const tdAction = document.createElement('td');
		const editButton = document.createElement('button');
		const deleteButton = document.createElement('button');
		
		thCounter.innerHTML = counter;
		tdName.innerHTML = data[counterLoop]['name'];
		tdIcon.innerHTML = data[counterLoop]['icon'];
		tdDescription.innerHTML = data[counterLoop]['description'].slice(0, 50) + "...";
		editButton.innerHTML = 'Edit';
		editButton.setAttribute('class', 'edit-btn');
		editButton.addEventListener('click',function() {
			editId.value = data[counterLoop]['skill_id'];
			editName.value = data[counterLoop]['name'];
			editIcon.value = data[counterLoop]['icon'];
			editDescription.value = data[counterLoop]['description'];
			editModal.style.display = "block";
			
		});
		deleteButton.innerHTML = 'Delete';
		deleteButton.setAttribute('class', 'delete-btn');
		deleteButton.addEventListener('click', function() {
			deleteModal.style.display = "block";
			deleteId.value = data[counterLoop]['skill_id'];
		});
			
		tdAction.appendChild(editButton);
		tdAction.appendChild(deleteButton);
		tr.appendChild(thCounter);
		tr.appendChild(tdName);
		tr.appendChild(tdIcon);
		tr.appendChild(tdDescription);
		tr.appendChild(tdAction);
		table.appendChild(tr);
		
		counter++;
		
	}
}

function closeEdit() {
	editModal.style.display = "none";
}

function closeDelete() {
	deleteModal.style.display = "none";
}

function handleLimit(e) {
	limit = e.target.value;
	counter = offset + 1;
	getData();
}

function showNextData() {
	counter++;
	offset = counter - 1;
	getData();
}

function showPreviousData() {
	counter = offset - (limitSelect.value - 1);
	counter = counter <= 0 ? 1 : counter;
	offset = counter - 1;
	getData();
}

function deleteRecord(e) {
	e.preventDefault();
	closeDelete();
	startLoading();
	ajax({'action': 'deleteSkills', 'id': deleteId.value}, '../ajaxPhp/skills.php', handleDelete);
	
	function handleDelete(response) {
		if(response == 'success') {
			counter = offset + 1;
			getData();
			displayResult('Successfully Deleted Skills', 'success');
		}
		else {
			displayResult('Something went wrong!', 'danger');
		}
		stopLoading();
	}
}

function editRecord(e) {
	e.preventDefault();
	closeEdit();
	startLoading();
	ajax({'action': 'editSkills', 'id': editId.value, 'name': editName.value, 
	'icon': editIcon.value, 'description': description.value}, '../ajaxPhp/skills.php', handleEdit);
	
	function handleEdit(response) {
		if(response == 'success') {
			counter = offset + 1;
			getData();
			displayResult('Successfully Updated Skills', 'success');
		}
		else if(response == 'already_exist') {
			displayResult('Skill name already exist.', 'danger');
		}
		else {
			displayResult('Something went wrong!', 'danger');
		}
		stopLoading();
	}
}

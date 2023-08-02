function startLoading() {
	document.getElementById("loader").classList.remove('loader-hide');
}

function stopLoading() {
	document.getElementById("loader").classList.add('loader-hide');
}

function displayResult(message, status, resultId = 'result') {
	let result = document.getElementById(resultId);
	if(status == 'danger') {
		result.setAttribute('class', 'alert alert-danger');
	}
	else {
		result.setAttribute('class', 'alert alert-success');
	}
	result.innerHTML = message;
	result.style.display = 'block';
}

/* Topbar Dropdown and Sidebar */ 
const topbarDropdown = document.getElementById('topbar-dropdown-btn');
const topbarMenu = document.getElementById('topbar-menu-btn');
const sidebarClose = document.getElementById('sidebar-close-btn');
if(topbarDropdown != null) {
	
	topbarDropdown.addEventListener('click', showTopbarDropdown);

	topbarMenu.addEventListener('click', showSidebar);	
	sidebarClose.addEventListener('click', hideSidebar);

	window.addEventListener('click', handleWindowClick);

	function showTopbarDropdown() {
		const dropdownContent = document.getElementById("topbar-dropdown-content");
		if(dropdownContent.style.display == 'block') {
			dropdownContent.style.display = 'none';
		}
		else {
			dropdownContent.style.display = 'block';
		}
	}
	
	function showSidebar() {
		document.getElementById('sidebar').classList.remove('sidebar-0px');
		document.getElementById('sidebar').classList.add('sidebar-270px');
	}
	
	function hideSidebar() {
		document.getElementById('sidebar').classList.remove('sidebar-270px');
		document.getElementById('sidebar').classList.add('sidebar-0px');
	}
	
	function handleWindowClick(e) {
		if(e.target != topbarDropdown) {
			const dropdownContent = document.getElementById("topbar-dropdown-content");
			dropdownContent.style.display = 'none';
		}
		if( e.target != document.getElementById('sidebar') &&
			e.target.parentElement != topbarMenu &&
			e.target.parentElement != document.getElementById('sidebar') ) {
			hideSidebar();
		}
	}
	
	let collapsible = document.getElementsByClassName("collapsible");

	for (let counter = 0; counter < collapsible.length; counter++) {
		collapsible[counter].addEventListener("click", handleCollapse);
		if(collapsible[counter].classList.contains('active')) {
			collapsible[counter].nextElementSibling.style.maxHeight = collapsible[counter].nextElementSibling.scrollHeight + "px";
		}
	}
	
	function handleCollapse(e) {
		let content = this.nextElementSibling;
		if (content.style.maxHeight){
			content.style.maxHeight = null;
		} 
		else {
			content.style.maxHeight = content.scrollHeight + "px";
		}
	}
	
}
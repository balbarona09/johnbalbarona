<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'CONTACTS';
$_SESSION['DROPDOWN_PAGE'] = 'ADD_CONTACTS';
require_once 'includes/head.php'; 
require_once 'includes/sidebar.php'; 

?>
		
<div class="loader-container loader-hide" id="loader">
	<div class="loader"></div>
</div>

<div class="main-content">
	<?php require_once 'includes/topbar.php'; ?>
	<div class="form-alert-container">
		<div id="result" class="alert"></div>
	</div>
	<main class="form-container">
		<div class="form-title-container">
			<h1 class="form-title">Contacts</h1>
		</div>
		<form class="form" id="add-form">
			<div class="form-control-container">
				<label for="name" class="form-label">Contact name</label>
				<input type="text" id="name" name="name" placeholder="Ex. Phone" class="form-control">
			</div>
			<div class="form-control-container">
				<label for="type" class="form-label">Type</label>
				<select id="type" name="type" class="form-control" >
					<option value="0">Phone number</option>
					<option value="1">Email</option>
					<option value="2">URL</option>
				</select>
			</div>
			<div class="form-control-container">
				<label for="value" class="form-label">Value</label>
				<input type="text" id="value" name="value" placeholder="Ex. 09112233456" class="form-control" >
			</div>
			<div class="form-control-container"></div>
			<div class="form-control-container">
				<input type="submit" value="Add Contact" class="form-submit">
			</div>
		</form>
	</main>
</div>

<script src="../js/add-contacts.js" type="module"></script>
<?php require_once 'includes/foot.php' ?>
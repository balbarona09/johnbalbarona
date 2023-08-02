<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'CONTACTS';
$_SESSION['DROPDOWN_PAGE'] = 'MANAGE_CONTACTS';
require_once 'includes/head.php'; 
require_once 'includes/sidebar.php'; 

?>
		
<!-- Modal For Edit - Start -->
<div id="edit-modal" class="edit-modal">
	<div class="edit-modal-content">
		<div class="edit-modal-header">
			<h5>Edit Contacts</h5>
		</div>
		<div class="edit-modal-body">
			<form id="edit-form">
				<input type="hidden" id="edit-id" required>
				<div>
					<label for="name" class="form-label">Contact name</label>
					<input type="text" placeholder="Ex. Phone" id="name" name="name" class="form-control" required>
				</div>
				<div>
					<label for="type" class="form-label">Type</label>
					<select class="form-control" id="type" name="type">
						<option value="0">Phone number</option>
						<option value="1">Email</option>
						<option value="2">URL</option>
					</select>
				</div>				
				<div>
					<label for="value" class="form-label">Value</label>
					<input type="text" id="value" name="value" class="form-control">
				</div>
				<div>
					<input type="submit" value="Save" class="form-submit">
				</div>
			</form>
		</div>
		<div class="edit-modal-footer">
			<button class="close" id="close-edit-modal">Close</button>
		</div>
	</div>
</div>
<!-- Modal For Edit - End -->

<!-- Modal For Delete - Start -->
<div id="delete-modal" class="delete-modal">
	<div class="delete-modal-content">
		<div class="delete-modal-header">
			<h5>Delete Contacts</h5>
		</div>
		<div class="delete-modal-body">
			<form id="delete-form">
				<input type="hidden" name="delete-id" id="delete-id">
				<p>Are you sure you want to delete this contact?</p>
				<input type="submit" value ="Yes" class="form-submit">
			</form>
		</div>
		<div class="delete-modal-footer">
			<button class="close" id="close-delete-modal">Close</button>
		</div>
	</div>
</div>
<!-- Modal For Delete - End -->
			
<div class="loader-container loader-hide" id="loader">
	<div class="loader"></div>
</div>

<div class="main-content">
	<?php require_once 'includes/topbar.php'; ?>
	<div class="form-alert-container">
		<div id="result" class="alert"></div>
	</div>
	<main class="table-container">
		<div>
			<label for="limit">Show: </label>
			<select id="limit" class="limit">
				<option>10</option>
				<option>25</option>
				<option>50</option>
				<option>100</option>
			</select>
		</div>
		<table class="manage-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Contact name</th>
					<th>Type</th>
					<th>Value</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="manage-table">
				
			</tbody>
		</table>
		<div class="entries-container">
			<span id="entries-statement" class="entries-statement">
			Showing 1 to 2 of 2 entries
			</span>
			<div class="next-prev">
				<button class="previous-btn" id="previous">Previous</button>
				<button class="next-btn" id="next">Next</button>
			</div>
		</div>
	</main>
</div>

<script src="../js/manage-contacts.js" type="module"></script>
<?php require_once 'includes/foot.php' ?>
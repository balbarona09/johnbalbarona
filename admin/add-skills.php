<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'SKILLS';
$_SESSION['DROPDOWN_PAGE'] = 'ADD_SKILLS';
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
			<h1 class="form-title">Skills</h1>
		</div>
		<form class="form" id="add-form">
			<div class="form-control-container">
				<label for="name" class="form-label">Skill name</label>
				<input type="text" id="name" name="name" placeholder="Ex. Time Management" class="form-control" required>
			</div>
			<div class="form-control-container">
				<label for="icon" class="form-label">Icon</label>
				<input type="text" id="icon" name="icon" placeholder='Ex. <i class"fas fa"></i>' class="form-control" required>
			</div>
			<div class="form-control-container">
				<label for="description" class="form-label">Description</label>
				<textarea id="description" name="description" class="form-textarea" required></textarea>
			</div>
			<div class="form-control-container"></div>
			<div class="form-control-container">
				<input type="submit" value="Add Skill" class="form-submit">
			</div>
		</form>
	</main>
</div>

<script src="../js/add-skills.js" type="module"></script>
<?php require_once 'includes/foot.php' ?>
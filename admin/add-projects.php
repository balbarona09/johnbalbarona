<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'PROJECTS';
$_SESSION['DROPDOWN_PAGE'] = 'ADD_PROJECTS';
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
			<h1 class="form-title">Projects</h1>
		</div>
		<form class="form" id="add-form">
			<div class="form-control-container">
				<label for="name" class="form-label">Project name</label>
				<input type="text" id="name" name="name" placeholder="Ex. Blog Management System" class="form-control" required>
			</div>
			<div class="form-control-container">
				<label for="languages" class="form-label">Languages seperated by comma</label>
				<input type="text" id="languages" name="languages" placeholder='Ex. PHP, MySQL' class="form-control" required>
			</div>
			<div class="form-control-container">
				<label for="thumbnail" class="form-label">Thumbnail</label>
				<input type="file" id="thumbnail" name="thumbnail" class="form-file" accept="image/png, image/jpeg, image/gif" required>
			</div>
			<div class="form-control-container">
				<label for="url" class="form-label">URL</label>
				<input type="text" id="url" name="url" placeholder="Ex. johnbalbarona.tech" class="form-control" required>
			</div>
			<div class="form-control-container">
				<input type="submit" value="Add Project" class="form-submit">
			</div>
		</form>
	</main>
</div>

<script src="../js/add-projects.js" type="module"></script>
<?php require_once 'includes/foot.php' ?>
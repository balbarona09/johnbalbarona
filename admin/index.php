<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'DASHBOARD';
$_SESSION['DROPDOWN_PAGE'] = 'DASHBOARD';
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
	<div class="dashboard-container">
		<div class="dashboard-item">
			<h2 class="dashboard-item-title">Skills</h2>
			<p class="dashboard-item-value" id="dashboard-skills">0</p>
		</div>
		<div class="dashboard-item">
			<h2 class="dashboard-item-title">Projects</h2>
			<p class="dashboard-item-value" id="dashboard-projects">0</p>
		</div>
		<div class="dashboard-item">
			<h2 class="dashboard-item-title">Contacts</h2>
			<p class="dashboard-item-value" id="dashboard-contacts">0</p>
		</div>
	</div>
</div>

<script src="../js/dashboard.js" type="module"></script>
<?php require_once 'includes/foot.php' ?>
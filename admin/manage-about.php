<?php 
require_once 'check-login.php';
$_SESSION['PAGE'] = 'ABOUT';
$_SESSION['DROPDOWN_PAGE'] = 'MANAGE_ABOUT';
require_once 'includes/head.php'; 
require_once 'includes/sidebar.php'; 

?>
		

<div class="main-content">
	<?php require_once 'includes/topbar.php'; ?>
	<div>
		Dashboard
	</div>
</div>

<?php require_once 'includes/foot.php' ?>
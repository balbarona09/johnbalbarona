<div class="sidebar" id="sidebar">
	<button class="close-btn" id="sidebar-close-btn">&times;</button>
	<img src="../images/logo.svg" class="logo">
	<a href="index.php" class="item <?php echo $_SESSION['PAGE'] == 'DASHBOARD' ? 'active' : ''; ?>">
		<i class="fas fa-home"></i> Dashboard
	</a>
	<a href="javascript:void(0)" class="collapsible item <?php echo $_SESSION['PAGE'] == 'SKILLS' ? 'active' : ''; ?>">
		<i class="fas fa-code"></i> Skills
		<i class="fas fa-caret-down float-right"></i>
	</a>
	<div class="collapse-content">
		<a href="add-skills.php" class="item callapse-content-item <?php echo $_SESSION['DROPDOWN_PAGE'] == 'ADD_SKILLS' ? 'active' : ''; ?>">
			<i class="fas fa-arrow-right"></i> &nbsp; Add Skills
		</a>
		<a href="manage-skills.php" class="item callapse-content-item <?php echo $_SESSION['DROPDOWN_PAGE'] == 'MANAGE_SKILLS' ? 'active' : ''; ?>">
			<i class="fas fa-arrow-right"></i> &nbsp; Manage Skills
		</a>
	</div>
	<a href="javascript:void(0)" class="collapsible item <?php echo $_SESSION['PAGE'] == 'PROJECTS' ? 'active' : ''; ?>">
		<i class="fas fa-tasks"></i> Projects
		<i class="fas fa-caret-down float-right"></i>
	</a>
	<div class="collapse-content">
		<a href="add-projects.php" class="item callapse-content-item <?php echo $_SESSION['DROPDOWN_PAGE'] == 'ADD_PROJECTS' ? 'active' : ''; ?>">
			<i class="fas fa-arrow-right"></i> &nbsp; Add Projects
		</a>
		<a href="manage-projects.php" class="item callapse-content-item <?php echo $_SESSION['DROPDOWN_PAGE'] == 'MANAGE_PROJECTS' ? 'active' : ''; ?>">
			<i class="fas fa-arrow-right"></i> &nbsp; Manage Projects
		</a>
	</div>
	<a href="javascript:void(0)" class="collapsible item <?php echo $_SESSION['PAGE'] == 'CONTACTS' ? 'active' : ''; ?>">
		<i class="fas fa-address-card"></i> Contacts
		<i class="fas fa-caret-down float-right"></i>
	</a>
	<div class="collapse-content">
		<a href="add-contacts.php" class="item callapse-content-item <?php echo $_SESSION['DROPDOWN_PAGE'] == 'ADD_CONTACTS' ? 'active' : ''; ?>">
			<i class="fas fa-arrow-right"></i> &nbsp; Add Contacts
		</a>
		<a href="manage-contacts.php" class="item callapse-content-item <?php echo $_SESSION['DROPDOWN_PAGE'] == 'MANAGE_CONTACTS' ? 'active' : ''; ?>">
			<i class="fas fa-arrow-right"></i> &nbsp; Manage Contacts
		</a>
	</div>
</div>
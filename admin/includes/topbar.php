<nav class="topbar">
	<button class="menu-btn" id="topbar-menu-btn"><i class="fas fa-bars"></i></button>
	<div class="dropdown">
		<button id="topbar-dropdown-btn" class="dropdown-btn"><span id="topbar-fullname"><?php echo $_SESSION['USER_INFORMATION']['NAME']; ?></span> <i class="fas fa-caret-down"></i></button>
		<div id="topbar-dropdown-content" class="dropdown-content">
			<a href="profile.php" class="item">Profile</a>
			<a href="login.php" class="item">Log out</a>
		</div>
	</div>
</nav>
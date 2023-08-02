<?php 
require_once 'config/connect.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/main.css">
		<title>John Michael V. Balbarona - Portfolio</title>
		<script src="https://kit.fontawesome.com/16c4a07abd.js" crossorigin="anonymous"></script>
		<link rel="icon" href="images/johnbalbarona-low-resolution-color-logo.svg">
	</head>
	<body>
		<nav id="navbar">
			<a href="#" class="nav-left">johnbalbarona</a>
			<div class="nav-right">
				<a href="#skills-section" onclick="showMenu()">Skills</a>
				<a href="#projects" onclick="showMenu()">Projects</a>
				<a href="#about" >About</a>
				<a href="#footer" onclick="showMenu()">Contacts</a>
			</div>
			<a href="javascript:void(0);" class="icon" onclick="showMenu()"> 
				<i class="fas fa-bars"></i>
			</a>
		</nav>
		
		<div id="welcome-section">

			<h1>Hi, I'm John Michael Balbarona.<br>Nice to meet you.</h1>
			
			<p>I am a full stack web developer. I can create a website from scratch and update a website's features.
			I enjoy coding, programming, problem solving and, most of all, I love learning technologies.
			</p>
			
			<a href="#footer">Contact me!</a>		
		</div>
		
		<div id="skills-section">
			<h2 class="skills-title">Skills</h2>
			<?php
			$statement = $database->prepare("SELECT * FROM skill");
			$statement->execute();
			while($skill = $statement->fetch(PDO::FETCH_ASSOC)):
			?>
			
			<div class="skills-container">
				<?php echo $skill['icon']; ?>
				<h3><?php echo   $skill['name']; ?> </h3>
				<p><?php echo $skill['description']; ?></p>
			</div>
			<?php endwhile;?>
		</div>
		
		<div id="projects">
			<p class="recent">My Best Projects</p>
			<?php
			$statement = $database->prepare("SELECT * FROM project");
			$statement->execute();
			while($project = $statement->fetch(PDO::FETCH_ASSOC)):
			?>
			<section class="project-tile">
				<img src="images/projects/<?php echo $project['thumbnail']; ?>" alt="<?php echo $project['name']; ?>">
				<h3><?php echo $project['name']; ?></h3>
				<p><?php echo $project['languages']; ?></p>
				<a href="<?php echo $project['url']; ?>" target="_blank">Visit site</a>
			</section><hr>
			<?php endwhile;?>
		</div>
				
		<footer id="footer">
			<div class="footer-container">
			<h4>Get in Touch</h4><br>
			<?php
			$statement = $database->prepare("SELECT * FROM contact");
			$statement->execute();
			while($contact = $statement->fetch(PDO::FETCH_ASSOC)):
			?>
			<p><?php echo $contact['name']; ?>: 
			
			<?php if($contact['type'] == 0): ?>
			<a href="tel:{<?php echo $contact['value']; ?>}"><?php echo $contact['value']; ?></a>
				
			<?php elseif($contact['type'] == 1): ?>
			<a href="mailto:<?php echo $contact['value']; ?>"><?php echo $contact['value']; ?></a>
				
			<?php else: ?>
			<a href="<?php echo $contact['value']; ?>" target="_blank"><?php echo $contact['value']; ?></a>
			<?php endif; ?>
			
			</p><br>
			<?php endwhile;?>
			</div>
		</footer>
		<script>
		function showMenu() {
			var top_nav = document.getElementById("navbar");
			if (top_nav.classList.contains("responsive")) {
				top_nav.classList.remove("responsive");
			} else {
				top_nav.classList.add("responsive");
			}
		}
		</script>
	</body>
</html>
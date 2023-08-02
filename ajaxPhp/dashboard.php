<?php
	require_once '../admin/check-login.php';
	require_once '../config/connect.php';
	
	switch($_POST['action']) {
		case 'getDashboard': 
			$statement = $database->prepare("SELECT (SELECT COUNT(skill_id) FROM skill) AS skills, 
			(SELECT COUNT(project_id) FROM project) AS projects,
			(SELECT COUNT(contact_id) FROM contact) AS contacts");
			$statement->execute();
			$result = $statement->fetchAll();
			die(json_encode($result));
			break;
	}

?>
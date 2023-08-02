<?php 
	require_once '../admin/check-login.php';
	require_once '../config/connect.php';
	
	switch($_POST['action']) {
		case 'addSkills':
			//checking if all the input needed is not empty;
			if( empty($_POST['name']) || empty($_POST['description']) || empty($_POST['icon']) ) {
				die('incomplete_data');
			}
			
			//checking if the skill name is already in a database.
			$statement = $database->prepare("SELECT COUNT(name) FROM skill WHERE name = :name");
			$statement->bindParam(':name', $_POST['name']);
			if(!$statement->execute()) {
				die();
			}
			if($statement->fetch(PDO::FETCH_NUM)[0] > 0) {
				die("already_exist");
			}
			
			//inserting to database
			$statement = $database->prepare("INSERT INTO skill (name, description, icon) VALUES(:name, :description, :icon)");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':description', $_POST['description']);
			$statement->bindParam(':icon', $_POST['icon']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
		case 'getSkills':
			//checking if the Order by and sort is correct. This will be used in query.
			if($_POST['order'] == 'name') {
				  $order = $_POST['order'];
			}
			else {
				$order = 'skill_id';
			}
			$sort = $_POST['sort'] == 'DESC' ? 'DESC' : 'ASC';
			
			//Getting the skills data. The last array will be the Total record.
			$statement = $database->prepare("SELECT * FROM skill ORDER BY {$order} {$sort} LIMIT :offset, :limit;");
			$statement->bindParam(':offset', $_POST['offset'], PDO::PARAM_INT);
			$statement->bindParam(':limit', $_POST['limit'], PDO::PARAM_INT);
			if(!$statement->execute()) {
				die();
			}
			$result = $statement->fetchAll();
			$statement = $database->prepare('SELECT COUNT(skill_id) FROM skill');
			$statement->execute();
			array_push($result, $statement->fetch(PDO::FETCH_NUM)[0]);
			die(json_encode($result));
			break;
		case 'deleteSkills':
			//deleting the record in database.
			$statement = $database->prepare("DELETE FROM skill WHERE skill_id = :id");
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
		case 'editSkills':
			//checking if all the input needed is not empty;
			if( empty($_POST['id']) || empty($_POST['name']) || empty($_POST['description']) || empty($_POST['icon']) ) {
				die('incomplete_data');
			}
			
			//checking if the skill name is already in a database except its own record.
			$statement = $database->prepare("SELECT COUNT(name) FROM skill WHERE name = :name AND skill_id != :id");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			if($statement->fetch(PDO::FETCH_NUM)[0] > 0) {
				die("already_exist");
			}
			
			//updating database
			$statement = $database->prepare("UPDATE skill SET name = :name, description = :description, icon = :icon 
			WHERE skill_id = :id");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':description', $_POST['description']);
			$statement->bindParam(':icon', $_POST['icon']);
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
	}
?>
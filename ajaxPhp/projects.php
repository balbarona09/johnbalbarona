<?php 
	require_once '../admin/check-login.php';
	require_once '../config/connect.php';
	require_once '../functions/isImageValid.php';
	
	switch($_POST['action']) {
		case 'addProjects':
			//checking if all the input needed is not empty.
			if( empty($_POST['name']) || empty($_POST['languages']) || empty($_FILES['thumbnail']) || 
			empty($_POST['url']) ) {
				die('incomplete_data');
			}
			
			//Checking if image is valid image file and is gif or png or jpg.
			if(!isImageValid($_FILES['thumbnail']['tmp_name'])) {
				die('invalid_image');
			}
			
			//Checking if the image size is no more than 2mb.
			if($_FILES['thumbnail']['size'] > 2048000) {
				die('invalid_image_size');
			}
			
			//checking if the project name is already in a database.
			$statement = $database->prepare("SELECT COUNT(name) FROM project WHERE name = :name");
			$statement->bindParam(':name', $_POST['name']);
			if(!$statement->execute()) {
				die();
			}
			if($statement->fetch(PDO::FETCH_NUM)[0] > 0) {
				die("already_exist");
			}
			
			//uploading the image
			$filename = md5(uniqid()) .".". pathinfo($_FILES['thumbnail']['name'])['extension'];
			while(@file_exists($filename)) {
				$filename = md5(uniqid()) .".". pathinfo($_FILES['thumbnail']['name'])['extension'];
			}
			if(!@move_uploaded_file($_FILES['thumbnail']['tmp_name'], "../images/projects/$filename")) {
				die('upload_error');
			}
			
			//inserting to database
			$statement = $database->prepare("INSERT INTO project (name, languages, thumbnail, url) VALUES(:name, :languages, :thumbnail, :url)");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':languages', $_POST['languages']);
			$statement->bindParam(':thumbnail', $filename);
			$statement->bindParam(':url', $_POST['url']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
		case 'getProjects':
			//checking if the Order by and sort is correct. This will be used in query.
			if($_POST['order'] == 'name') {
				  $order = $_POST['order'];
			}
			else {
				$order = 'project_id';
			}
			$sort = $_POST['sort'] == 'DESC' ? 'DESC' : 'ASC';
			
			//Getting the projects data. The last index on array will be the Total record.
			$statement = $database->prepare("SELECT * FROM project ORDER BY {$order} {$sort} LIMIT :offset, :limit;");
			$statement->bindParam(':offset', $_POST['offset'], PDO::PARAM_INT);
			$statement->bindParam(':limit', $_POST['limit'], PDO::PARAM_INT);
			if(!$statement->execute()) {
				die();
			}
			$result = $statement->fetchAll();
			$statement = $database->prepare('SELECT COUNT(project_id) FROM project');
			$statement->execute();
			array_push($result, $statement->fetch(PDO::FETCH_NUM)[0]);
			die(json_encode($result));
			break;
		case 'deleteProjects':
			//deleting the record in database.
			$statement = $database->prepare("DELETE FROM project WHERE project_id = :id");
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
		case 'editProjects':
			//checking if all the input needed is not empty;
			if( empty($_POST['id']) || empty($_POST['name']) || empty($_POST['languages']) || empty($_POST['url']) ) {
				die('incomplete_data');
			}
			
			//checking if the project name is already in a database except its own record.
			$statement = $database->prepare("SELECT COUNT(name) FROM project WHERE name = :name AND project_id != :id");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			if($statement->fetch(PDO::FETCH_NUM)[0] > 0) {
				die("already_exist");
			}
			
			$preparedStatement = "UPDATE project SET name = :name, languages = :languages, url = :url";
			
			//checking if user uploaded a file.
			$isUserUploadImage = !empty($_FILES['thumbnail']);
			if($isUserUploadImage) {
				//Checking if image is valid image file and is gif or png or jpg.
				if(!isImageValid($_FILES['thumbnail']['tmp_name'])) {
					die('invalid_image');
				}
			
				//Checking if the image size is no more than 2mb.
				if($_FILES['thumbnail']['size'] > 2048000) {
					die('invalid_image_size');
				}
				
				//uploading the image
				$filename = md5(uniqid()) .".". pathinfo($_FILES['thumbnail']['name'])['extension'];
				while(@file_exists($filename)) {
					$filename = md5(uniqid()) .".". pathinfo($_FILES['thumbnail']['name'])['extension'];
				}
				if(!@move_uploaded_file($_FILES['thumbnail']['tmp_name'], "../images/projects/$filename")) {
					die('upload_error');
				}
				
				$preparedStatement .= ", thumbnail = :thumbnail";
			}
			
			//updating database
			$preparedStatement .= ' WHERE project_id = :id';
			$statement = $database->prepare($preparedStatement);
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':languages', $_POST['languages']);
			$statement->bindParam(':url', $_POST['url']);
			$statement->bindParam(':id', $_POST['id']);
			if($isUserUploadImage) {
				$statement->bindParam(':thumbnail', $filename);
			}
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
	}
?>
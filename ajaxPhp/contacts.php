<?php 
	require_once '../admin/check-login.php';
	require_once '../config/connect.php';
	
	switch($_POST['action']) {
		case 'addContacts':
			//checking if all the input needed is not empty. isset on type because there may be 0 value.
			if( empty($_POST['name']) || !isset($_POST['type']) || empty($_POST['value']) ) {
				die('incomplete_data');
			}
			
			//checking if the type is correct.
			if(!($_POST['type'] == 0 || $_POST['type'] == 1 || $_POST['type'] == 2)) {
				die('wrong_type');
			}
			
			//inserting to database
			$statement = $database->prepare("INSERT INTO contact (name, type, value) VALUES(:name, :type, :value)");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':type', $_POST['type']);
			$statement->bindParam(':value', $_POST['value']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
		case 'getContacts':
			//checking if the Order by and sort is correct. This will be used in query.
			if($_POST['order'] == 'name') {
				  $order = $_POST['order'];
			}
			else {
				$order = 'contact_id';
			}
			$sort = $_POST['sort'] == 'DESC' ? 'DESC' : 'ASC';
			
			//Getting the contact data. The last array will be the Total record.
			$statement = $database->prepare("SELECT * FROM contact ORDER BY {$order} {$sort} LIMIT :offset, :limit;");
			$statement->bindParam(':offset', $_POST['offset'], PDO::PARAM_INT);
			$statement->bindParam(':limit', $_POST['limit'], PDO::PARAM_INT);
			if(!$statement->execute()) {
				die();
			}
			$result = $statement->fetchAll();
			$statement = $database->prepare('SELECT COUNT(contact_id) FROM contact');
			$statement->execute();
			array_push($result, $statement->fetch(PDO::FETCH_NUM)[0]);
			die(json_encode($result));
			break;
		case 'deleteContacts':
			//deleting the record in database.
			$statement = $database->prepare("DELETE FROM contact WHERE contact_id = :id");
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
		case 'editContacts':
			//checking if all the input needed is not empty;
			if( empty($_POST['id']) || empty($_POST['name']) || empty($_POST['value']) ) {
				die('incomplete_data');
			}
			
			//checking if the type is correct.
			if(!($_POST['type'] == 0 || $_POST['type'] == 1 || $_POST['type'] == 2)) {
				die('wrong_type');
			}
			
			//updating database
			$statement = $database->prepare("UPDATE contact SET name = :name, type = :type, value = :value 
			WHERE contact_id = :id");
			$statement->bindParam(':name', $_POST['name']);
			$statement->bindParam(':type', $_POST['type']);
			$statement->bindParam(':value', $_POST['value']);
			$statement->bindParam(':id', $_POST['id']);
			if(!$statement->execute()) {
				die();
			}
			die('success');
			break;
	}
?>
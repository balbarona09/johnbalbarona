<?php

	$host = 'localhost';
	$dbname = 'portfolio';
	$user = 'root';
	$password = '';

	$database = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);


?>
<?php
session_start();
if(!(isset($_SESSION['USER_INFORMATION']['ID']) && !empty($_SESSION['USER_INFORMATION']['ID']))) {
	header("Location: login.php");
	die();
}

?>
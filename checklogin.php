<?php
	include_once('resources/init.php');
	$password = "ac5a6781715c3d6b90527d0cc2d87da0";
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'submit') {
			$submittedPassword = $_POST['password'];
			if (!strcmp(md5($submittedPassword) , $password)) {
				header('Location: admin_index.php');
			} else {
				$error = "Password does not match!";
			}
		}
	}
?>

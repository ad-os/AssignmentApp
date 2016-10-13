<?php
	session_start();
	if ($_SESSION['login'] != 2) {
		include_once('resources/init.php');
		$admin = get_admin_password();
		$password = $admin['password'];
		if (isset($_POST['action'])) {
			if ($_POST['action'] == 'submit') {
				$submittedPassword = $_POST['password'];
				if (!strcmp(md5($submittedPassword) , $password)) {
					$_SESSION['login'] = 2;
					header('Location: admin_index.php');
				} else {
					$error = "Password does not match!";
				}
			} else {
				header('Location: reset.php');
			}
		}
	} else {
		header('Location: admin_index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Questions">
	<meta name="author" content="Jmi Developers">
	<title>Login Page</title>
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/index.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="index.php" class="image-margin"><img src="img/Home-56-grunt.png" alt="Logo" /></a>
		</div>
	</nav>
	<div class="container">
		<div class="row margin box-shadow">
			<form class="col s12 m12 l12" method="POST" action="login.php">
				<div class="row">
					<div class="input-field col s12 m12 l12 input-margin-top">
						<input id="password" type="password" name="password" class="validate">
						<label for="password">Password</label>
					</div>
					<div class="col s12 l6 m6 margin">
						<button class="waves-effect waves-light btn-large width" type="submit" name="action" value="submit">Log In</button>
					</div>
					<div class="col s12 l6 m6 margin">
						<button class="waves-effect waves-light btn-large width" type="submit" name="action" value="reset">Reset Password</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<footer>
		<div class="row margin-zero">
			<div class="col s12">
				<div class="card white margin-zero">
					<div class="card-content">
						<p class="center">Copyright &copy; Sonaal, Abhinav and Adhyan</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script>
		Materialize.toast('<?php if(isset($error)) { echo $error; } ?>', 2000);
	</script>
	</body>
</html>

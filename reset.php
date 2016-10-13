<?php
	include_once('resources/init.php');
	$admin = get_admin_password();
	$passwordOld = $admin['password'];
	if (isset($_POST['action'])) {
		if (!strcmp(md5($_POST['password']), $passwordOld)) {
			if (!strcmp($_POST['passwordreset'], $_POST['passwordresetretype'])) {
				set_new_admin_password($_POST['passwordreset']);
				header('Location: login.php');
			} else {
				$error = 'New password\'s does not match'; 
			}
		} else {
			$error = 'Old password does not match.';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Questions">
	<meta name="author" content="Jmi Developers">
	<title>Reset Password</title>
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
			<form class="col s12 m12 l12" method="POST" action="reset.php">
				<div class="row">
					<div class="input-field col s12 m12 l12 input-margin-top">
						<input id="password" type="password" name="password" class="validate">
						<label for="password">Current Password</label>
					</div>
					<div class="input-field col s12 m12 l12 input-margin-top">
						<input id="password1" type="password" name="passwordreset" class="validate">
						<label for="password1">New Password</label>
					</div>
					<div class="input-field col s12 m12 l12 input-margin-top">
						<input id="password2" type="password" name="passwordresetretype" class="validate">
						<label for="password2">Retype New Password</label>
					</div>
					<div class="col s12 l12 m12 margin">
						<button class="waves-effect waves-light btn-large width" type="submit" name="action" value="reset">Change Password</button>
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
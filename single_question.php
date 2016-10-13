<?php
include_once('resources/init.php');
$images = get_image_by_post_id($_GET['id']);
$post = get_post_id($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Questions">
	<meta name="author" content="Jmi Developers">
	<title>Assignment</title>
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/index.css">
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="index.php" class="image-margin"><img src="img/Home-56-grunt.png" alt="Logo" /></a>
		<div class="center head-style">
		</div>
	</nav>
	<div class="row">
		<div class="container">
			<?php
				if (sizeof($images)) {
			?>
			<div class="col s12 m12 l12">
				<?php
					foreach ($images as $image) {
				?>
				<div class="card">
					<div class="card-image">
						<?php
							echo '<img src="'.$image['imagePath'].'">';
						?>
						<br>
					</div>
				</div>
				<?php
					}
				?>
			</div>
			<?php
				}
			?>
			<div class="col s12 m12 l12">
				<div class="card teal">
					<div class="card-content">
						<pre><?php if (isset($post['contents'])) { echo $post['contents']; } ?></pre>
					</div>
				</div>
			</div>
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
	<script src="js/jquery.min.js"></script>
</body>
</html>

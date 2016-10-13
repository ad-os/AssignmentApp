<?php
include_once('resources/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Questions">
	<meta name="author" content="Jmi Developers">
	<title>Add Question</title>
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/index.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="index.php" class="image-margin"><img src="img/Home-56-grunt.png" alt="Logo" /></a>
			<div class="center head-style">
			</div>
		</div>
	</nav>
	<section class="container margin-top">
		<?php
			foreach(get_categories() as $category){
		?>
			<div class="collection center">
				<a href="#!" class="collection-item"><?php echo $category['name']; ?></a>
				<a class="btn waves-effect waves-light" href="delete_category.php?id=<?php echo $category['id']; ?>" onclick="return confirm('All posts related to this category will be deleted!')">Delete</a>
			</div>
		<?php
			}
		?>
	</section>
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
</body>
</html>

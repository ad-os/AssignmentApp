<?php
	session_start();
	if ($_SESSION['login'] == 2) {
		include_once('resources/init.php');
		$posts = get_posts();
	} else {
		echo "You are not logged in !";
	}
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
	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<?php
		if ($_SESSION['login'] == 2) {
	?>
		<nav>
			<div class="nav-wrapper">
				<a href="index.php" class="image-margin"><img src="img/Home-56-grunt.png" alt="Logo" /></a>
				<div class="center head-style">
				</div>
			</div>
		</nav>
		<div class="container">
			<section class = row>
				<div class="col s12 m12 l4 margin-top-button">
					<a href="add_category.php" class="waves-effect waves-light btn-large width">Add a new Category</a>
				</div>
				<div class="col s12 m12 l4 margin-top-button">
					<a href="add_post.php" class="waves-effect waves-light btn-large width">Add a new Question</a>
				</div>
				<div class="col s12 m12 l4 margin-top-button">
					<a href="category_list.php" class="waves-effect waves-light btn-large width">List of Categories</a></p>
				</div>
			</section>
			<section class="row">
				<ul class="collapsible popout" data-collapsible="accordion">
					<?php
						foreach ($posts as $post) {
						$categoryId = $post['cat_id'];
						$cat = get_category_by_id($categoryId);
					?>
					<li>
						<div class="collapsible-header">This title '<?php echo $post['title']; ?>' was posted in '<?php echo $cat['name']; ?>' on <?php echo date('d-m-Y H:i:s', strtotime($post['date_posted'])); ?></div>
						<div class="collapsible-body"><p>
							<?php echo nl2br($post['contents']); ?></p>
							<div class="row padding">
								<div class="col s6 m6 l6">
									<a href="edit_post.php?id=<?php echo $post['id']; ?>" class="waves-effect waves-light btn-large width">Edit</a>
								</div>
								<div class="col s6 m6 l6">
									<a href="delete_post.php?id=<?php echo $post['id']; ?>" class="waves-effect waves-light btn-large width" onclick="return confirm('Are you sure ?')">Delete</a>
								</div>
							</div>
						</div>
					</li>
					<?php
						}
					?>
				</ul>
			</section>
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
	<?php
		}
	?>
</body>
</html>

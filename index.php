<?php
include_once('resources/init.php');
$posts = get_posts();
if (isset($_POST['action'])) {
	if ($_POST['action'] == 'submit') {
		$categoryId = $_POST['category'];
		$posts = get_posts_by_category_id($categoryId);
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
	<title>Assignment</title>
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/index.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="index.php" class="image-margin"><img src="img/Home-56-grunt.png" alt="Logo" /></a>
			<div class="right image-margin-right">
				<a href="login.php"><img src="img/Gear-56-grunt.png" alt="Admin Login" /></a>
				<p>HOME</p>
			</div>
			<div>
			</div>
			<div class="center head-style">
				<!-- nav heading -->
			</div>
		</div>
	</nav>
	<div class="container">
		<section class="row margin-top">
			<?php
				$count = count(get_categories());
				if ($count) {
			?>
			<form method="POST" enctype="multipart/form-data">
				<div class="input-field col s12 m12 l8">
					<select name="category">
						<?php
							foreach(get_categories() as $category){
							if ($_POST['category'] == $category['id']) {
						?>
						<option id="event" value="<?php echo $category['id']; ?>" selected><?php echo $category['name']; ?></option>
						<?php
							} else {
						?>
						<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
						<?php
							}
						}
					?>
					</select>
					<label>Lab</label>
				</div>
				<div class="col s12 m12 l4">
					<button class="waves-effect waves-light btn-large width" type="submit" name="action" value="submit">Get Questions!</button>
				</div>
			</form>
			<?php
				}
			?>
			<div class="col s12 m12 l12">
			<?php
				if(isset($posts))
				{
					foreach ($posts as $post) {
						$categoryId = $post['cat_id'];
						$cat = get_category_by_id($categoryId);
				?>
				<div class="card blue-grey darken-1">
					<div class="card-content white-text">
						<p class="font-style"><a href="single_question.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></p>
						<?php  echo isset($post) ?date('d-m-Y H:i:s', strtotime($post['date_posted'])):""; ?> <?php echo $cat['name']; ?>
					</div>
				</div>
				<?php
					}
				}
			?>
			</div>
		</section>
	</div>
	<footer>
		<div class="row margin-zero">
			<div class="col s12">
				<div class="card white border-shadow margin-zero">
					<div class="card-content">
						<p class="center">Copyright &copy; Sonaal, Abhinav and Adhyan</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
</body>
</html>

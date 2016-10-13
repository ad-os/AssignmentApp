<?php
	include_once('resources/init.php');
	if (isset($_POST['action'])) {
		if ($_POST['action'] == "Add Category") {
			if (!empty(($_POST['name']))) {
				$name = trim($_POST['name']);
				if(category_exists($name)){
					$error = 'That category already exists.';
				} else if(strlen($name) > 24){
					$error = 'Category name can only be up to 24 characters.';
				} else{
					add_category($name);
					$name = $_POST['name'];
					$category = get_category_by_name($name);
					$cat_id = $category['id'];
					$headerString = 'http://localhost/cslab/add_post.php?id='.$cat_id;
					header('Location: '.$headerString);
					die("Error in redirecting to the above link!");
				}
			} else {
				$error = 'You must submit a category name.';
			}		
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
	<title>Add category</title>
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
	<section class="container">
		<div class="row margin translateY">
			<form class="s12 m12 l12" method="POST">
				<div class="row">
					<div class="input-field col s12">
						<input id="category" type="text" class="validate" name="name">
						<label class="active" for="category">Category Name</label>
					</div>
				</div>
				<div class="col s12 center">
					<button class="waves-effect waves-light btn-large center" type="submit" value="Add Category" name="action">INSERT</button>
				</div>
			</form>
		</div>
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
	<script>
		Materialize.toast('<?php echo $error; ?>', 2000);
	</script>
</body>
</html>
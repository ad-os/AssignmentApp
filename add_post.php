<?php
include_once('resources/init.php');
if(isset($_POST['title']) && isset($_POST['contents']) && isset($_POST['category'])){
	if(!empty(trim($_POST['title']))){
		$title = trim($_POST['title']);
	} else{
		$error .= 'Please enter title ';
	}
	if(!empty(trim($_POST['contents']))){
		$contents = trim($_POST['contents']);
	}else{
		$error .= 'You need to supply the content. ';
	}
	if(strlen(trim($_POST['title']))>255){
		$error .= 'The title cannot be longer than 255 characters.'; 
	}
	if(empty($error)){
		add_post($title, $contents, $_POST['category'], $_FILES);
		$header_string = 'http://localhost/cslab/admin_index.php';
		header('Location: '.$header_string);
		die();
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
	<section class="container">
		<div class="row margin">
			<form class="s12 m12 l12" method="POST" enctype="multipart/form-data" action="#">
				<div class="row">
					<div class="input-field col s12">
						<select name="category">
							<?php
								foreach(get_categories() as $category){
								if (isset($_GET['id'])) {
									$cat = get_category_by_id($_GET['id']);
							?>
							<option value="<?php echo $category['id']; ?>"><?php echo $cat['name']; ?></option>
							<?php
								} else {
							?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
							<?php
								}
							}
						?>
						</select>
						<label>Category</label>
					</div>
					<div class="input-field col s12">
						<input value="<?php echo isset($_POST['title'])?$_POST['title']:""; ?>" id="title" type="text" class="validate" name="title">
						<label class="active" for="title">Title</label>
					</div>
					<div class="input-field col s12">
						<textarea id="Content" name="contents" type="text" class="materialize-textarea"><?php echo isset($_POST['contents'])?$_POST['contents']:""; ?></textarea>
						<label for="Content">Contents</label>
					</div>
					<div class="file-field input-field col s12">
						<div class="btn">
							<span>Image</span>
							<input type="file" name="files[]" multiple/>
						</div>
						<div class="col s5">
							<input class="file-path validate" type="text"/>
						</div>
					</div>
				</div>
				<div class="col s12 center">
					<button class="waves-effect waves-light btn-large center" type="submit" value="submit" name="action">INSERT</button>
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
		Materialize.toast('<?php if (isset($error)) { echo $error; } ?>', 2000);
	</script>
	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
</body>
</html>
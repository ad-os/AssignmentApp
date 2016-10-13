<?php
function add_post($title, $contents, $category, $FILES){
	global $mysql_connect;
	$title = mysqli_real_escape_string($mysql_connect, $title);
	$contents = mysqli_real_escape_string($mysql_connect, $contents);
	$category = (int)$category;
	if (isset($_GET['id'])) {
		$category = $_GET['id'];
	}
	$query = "INSERT INTO posts SET cat_id = '$category', title = '$title', contents = '$contents', date_posted = NOW()";
	$result = mysqli_query($mysql_connect, $query);
	$last_post_id = mysqli_insert_id($mysql_connect);
	uploadImage($last_post_id, $FILES, "New");
}

function delete($table, $id, $column){
	global $mysql_connect;
	$table = mysqli_real_escape_string($mysql_connect, $table);
	$id = (int)$id;
	$sql_query = 'DELETE FROM '.$table.' WHERE '.$column.' = '. $id;
	$result = mysqli_query($mysql_connect, $sql_query);
}

function uploadImage($id, $FILES, $flag) {
	if (sizeof($FILES)) {
		$extension=array("jpeg","jpg","png","gif");
		if (strcmp($flag, "Edit") == 0) {
			delete('images', $id, 'post_id');
		}
		foreach($FILES['files']['tmp_name'] as $key => $tmp_name ){
			$file_name = $FILES['files']['name'][$key];
			$file_size =$FILES['files']['size'][$key];
			$file_tmp =$FILES['files']['tmp_name'][$key];
			$file_type=$FILES['files']['type'][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);//getting the extension from the filename.
			if (in_array($ext, $extension)) {
				//if condition to check whether file already exists or not.
				if(!file_exists("uploaded_images/".$file_name))
				{
					move_uploaded_file($file_tmp,"uploaded_images/".$file_name);
				}
				else
				{
					$filename=basename($file_name,$ext);//getting the filename without extension.
					$newFileName=$filename.time().".".$ext;
					move_uploaded_file($file_tmp,"uploaded_images/".$newFileName);
				}
			}
			$filepath = "uploaded_images/".$file_name;
			saveImage($id, $filepath);
			list($width, $height) = getimagesize($filepath);
			if ($width > 1000 || $height > 1000) {
				resizeImage($filepath);
			}
		}
	}
}

function resizeImage($filepath) {
	list($width, $height) = getimagesize($filepath);
	$ratio = ($width/$height);
	if( $ratio > 1) {
		$newWidth = 700;
		// $newHeight = 700/$ratio;
	}
	else {
		$newWidth = 700*$ratio;
		// $newHeight = 700;
	}
	$src = imagecreatefromstring(file_get_contents($filepath));
	$dst = imagecreatetruecolor($newWidth,$newWidth);
	imagecopyresampled($dst,$src,0,0,0,0,$newWidth,$newHeight,$width,$height);
	imagedestroy($src);
	imagepng($dst,$filepath); // adjust format as needed
	imagedestroy($dst);
}

function saveImage($id, $filepath) {
	global $mysql_connect;
	$id = (int)$id;
	$query = "INSERT INTO images SET post_id = '$id', imagePath = '$filepath'";
	$result = mysqli_query($mysql_connect, $query);
}

function edit_post($id, $title, $contents, $category, $FILES){
	global $mysql_connect;

	$id = (int)$id;
	$title = mysqli_real_escape_string($mysql_connect, $title);
	$contents = mysqli_real_escape_string($mysql_connect, $contents);
	$category = (int)$category;
	$query = "UPDATE posts SET cat_id = '$category', title = '$title', contents = '$contents' WHERE id = '$id'";
	uploadImage($id, $FILES, "Edit");
	$result = mysqli_query($mysql_connect, $query);
}

function add_category($name){
	global $mysql_connect;
	$name = mysqli_real_escape_string($mysql_connect, $name);
	$result = mysqli_query($mysql_connect, "INSERT INTO categories SET name = '$name'");
}

function get_posts(){
	global $mysql_connect;
	$posts = array();
	$query = "SELECT * FROM `posts`";
	$query .= "ORDER BY `id` DESC";
	$result = mysqli_query($mysql_connect, $query);
	while($row = mysqli_fetch_array($result)){
		$posts[] = $row;
	}
	return $posts;
}

function get_image_by_post_id($id) {
	global $mysql_connect;
	$images = array();
	$query = "SELECT * FROM images WHERE post_id = '$id'";
	$result = mysqli_query($mysql_connect, $query);
	while ( $row = mysqli_fetch_array($result)) {
		$images[] = $row;
	};
	return $images;
}

function get_categories(){
	global $mysql_connect;
	$categories = array();
	$result = mysqli_query($mysql_connect, "SELECT id, name FROM categories");
	while($row = mysqli_fetch_array($result)){
		$categories[] = $row;
	}
	return $categories;
}

function get_category_by_id($id) {
	global $mysql_connect;
	$query = "SELECT * FROM categories WHERE id = '$id'";
	$result = mysqli_query($mysql_connect, $query);
	$row = mysqli_fetch_array($result);
	return $row;
}

function get_category_by_name($name) {
	global $mysql_connect;
	$query = "SELECT * FROM categories WHERE name = '$name'";
	$result = mysqli_query($mysql_connect, $query);
	$row = mysqli_fetch_array($result);
	return $row;
}

function category_exists($name){
	global $mysql_connect;
	$name = mysqli_real_escape_string($mysql_connect, $name);
	$result = mysqli_query($mysql_connect, "SELECT name FROM categories WHERE name = '$name'");
	if(mysqli_num_rows($result)==0){
		return false;
	}else if(mysqli_num_rows($result)>=1){
		return true;
	}

}

function category_id_exists($id){
	global $mysql_connect;
	$id = mysqli_real_escape_string($mysql_connect, $id);
	$result = mysqli_query($mysql_connect, "SELECT id FROM categories WHERE id = '$id'");
	if(mysqli_num_rows($result)==0){
		return false;
	}else if(mysqli_num_rows($result)>=1){
		return true;
	}
}

function get_posts_by_category_id($categoryId) {
	global $mysql_connect;
	$query = "SELECT * FROM posts WHERE cat_id = '$categoryId' ORDER BY id DESC";
	$result = mysqli_query($mysql_connect, $query);
	while($row = mysqli_fetch_array($result)){
		$posts[] = $row;
	}
	if(isset($posts))
		return $posts;
}

function get_post_id($id) {
	global $mysql_connect;
	$query = "SELECT * FROM posts WHERE id='$id'";
	$result = mysqli_query($mysql_connect, $query);
	$post = mysqli_fetch_array($result);
	return $post;
}

function get_admin_password() {
	global $mysql_connect;
	$query = "SELECT * FROM admin";
	$result = mysqli_query($mysql_connect, $query);
	$row = mysqli_fetch_array($result);
	return $row;
}

function set_new_admin_password($newPassword) {
	global $mysql_connect;
	$newPassword = md5($newPassword);
	$query = "UPDATE admin SET password = '$newPassword' WHERE id = 1";
	$result = mysqli_query($mysql_connect, $query);
}

?>

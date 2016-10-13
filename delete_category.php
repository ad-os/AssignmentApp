<?php
include_once('resources/init.php');

if(!isset($_GET['id'])){
	header('Location: index.php');
	die();
}else{
	$posts = get_posts_by_category_id($_GET['id']);
	foreach ($posts as $post) {
		delete('images', $post['id'], 'post_id');
	}
	delete('posts', $_GET['id'], 'cat_id');
	delete('categories', $_GET['id'], 'id');
	header('Location: category_list.php');
	die();
}
?>

<?php
include_once('resources/init.php');

if(!isset($_GET['id'])){
	$header_string = 'http://localhost/cslab/admin_index.php';
	header('Location: '.$header_string);
	die();
}else{
	//To delete the posts.
	//Delete the images first which has a foreign key relationship with the posts.
	delete('images', $_GET['id'], 'post_id');
	delete('posts', $_GET['id'], 'id');
	$header_string = 'http://localhost/cslab/admin_index.php';
	header('Location: '.$header_string);
	die();
}
?>
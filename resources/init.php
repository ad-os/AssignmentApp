<?php
	$mysql_connect = mysqli_connect('localhost', 'root', '1234');
	mysqli_select_db($mysql_connect, 'questions_db');
	include_once('func/blog.php');
?>
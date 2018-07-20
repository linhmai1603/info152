<?php
	require 'database.php';
	$query = $_POST['query'];
	$dbname = $_POST['dbname'];
	$database ->search($query);
	$database ->close();
?>
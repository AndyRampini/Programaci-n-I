<?php
include 'db.php';
session_start();
$_POST = array_map('trim', $_POST);
if(!empty($_POST['title'])and !empty($_POST['description'])) {
	$query = $con->prepare('insert into tasks (user_id,title, description) values (?,?,?)');
	$query->execute(array($_SESSION['user_id'], $_POST['title'],$_POST['description']));
	header('Location: home.php');
}

else header('Location: home.php');
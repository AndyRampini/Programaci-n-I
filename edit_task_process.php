<?php
include 'db.php';
session_start();
if(isset($_SESSION['edit_task'])) {
	$query = $con->prepare('update tasks set title = ? where task_id = ?');
	$query->execute(array($_POST['title'], $_SESSION['edit_task']));
	unset($_SESSION['edit_task']);
	header('Location: home.php');
}
	if(isset($_SESSION['edit_task'])) {
	$query = $con->prepare('update tasks set description = ? where task_id = ?');
	$query->execute(array($_POST['description'], $_SESSION['edit_task']));
	unset($_SESSION['edit_task']);
	header('Location: home.php');
}

else header('Location: home.php');

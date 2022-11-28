<?php
include 'db.php';
session_start();
$_POST = array_map('trim', $_POST);
if(!empty($_POST['username']) && !empty($_POST['password'])) {
	$stmt = $con->prepare('SELECT * from users where username = ?');
	$stmt->execute(array($_POST['username']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row)
		if(password_verify($_POST['password'], $row['password'])) {
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user'] = 'Bienvenido, ' . $row['username'] . '!';		// Sesión iniciada
			header('Location: index.php');
		}
		else {
			$_SESSION['error'] = 'Contraseña invalida.';
			header('Location: login.php');
		}
	else {
		$_SESSION['error'] = "El nombre de usuario no existe.";
		header('Location: login.php');
	}
}
else {
	$_SESSION['error'] = "Por favor complete ambos campos.";
	header('Location: login.php');
}
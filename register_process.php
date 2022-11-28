<?php
include 'db.php';
session_start();
$_POST = array_map('trim', $_POST);
if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
	$_SESSION['error'] = 'Porfavor llene todos los campos.';
	header('Location: register.php');
}
if(strlen($_POST['password']) < 6) {
	$_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres.';
	header('Location: register.php');
}
else if($_POST['password'] == $_POST['confirm_password']) {
	$stmt = $con->prepare('SELECT count(*) from users where username = ?');
	$stmt->execute(array($_POST['username']));
	if($stmt->fetchColumn()) {
		$_SESSION['error'] = 'El nombre de usuario ya existe.';
		header('Location: register.php');
	}
	else {
		$stmt = $con->prepare('INSERT into users (username, email, password) VALUES (?,?,?)');
		if($stmt->execute(array($_POST['username'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT)))) {
			$_SESSION['success'] = 'Cuenta creada.';
			header('Location: register.php');
		}
		else {
			$_SESSION['error'] = 'Hubo un problema al crear su cuenta.';
			header('Location: register.php');
		}
	}
}
else {
	$_SESSION['error'] = 'Las contraseñas deben coincidir.';
	header('Location: register.php');
}
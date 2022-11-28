<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header><a href="index.php" id='app_name' class="header">Programación I</a></header>
	<form action="register_process.php" method="post">
		<input type="text" placeholder="Usuario" name='username' required pattern="\S+" title="Spaces are not allowed.">
		<input type="email" placeholder="E-mail" name='email' required>
		<input type="password" placeholder="Contraseña" name='password' required pattern="\S+" title="Spaces are not allowed." minlength=6>
		<input type="password" placeholder="Confirme Contraseña" name='confirm_password' required>
		<input type="submit" value="Sign Up">
	</form>
</body>
</html>

<?php
session_start();
if(isset($_SESSION['error']))
		echo "<p class='error'>" . $_SESSION['error'] . '</p>';
unset($_SESSION['error']);

if(isset($_SESSION['success']))
		echo "<p class='success'>" . $_SESSION['success'] . '</p>';
unset($_SESSION['success']);

if(isset($_SESSION['user']))
	header('Location: index.php');
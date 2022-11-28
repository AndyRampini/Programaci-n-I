<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Edit Task</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
		<a id='app_name' href="#">Programación I</a>
		<a href="logout.php" id='logout_btn'>Cerrar sesión</a>
	</header>
	<form action="edit_task_process.php" method='post'>
	<h3>Editar Tarea</h3>
		<input type="text" value='<?php echo $_SESSION["title"] ?>' name='title' required>
		<input type="text" value='<?php echo $_SESSION["description"] ?>' name='description' required>
		<input type="submit" value='Guardar'>
		<button id='cancel_btn'><a href="edit_task.php?cancel=1">Cancelar</a></button>
	</form>
</body>
</html>


<?php
if(!isset(($_SESSION['edit_task'])))
	header('Location: index.php');

if(($_GET['cancel'])==1) {
	unset($_SESSION['edit_task']);
	header('Location: index.php');	
}
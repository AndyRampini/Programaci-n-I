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
	<header>
		<a id='app_name' href="#">Programación I</a>
		<a href="login.php" id='login_btn'>Iniciar sesión</a>
		<a href="register.php" id='signup_btn'>Registrarse</a>
		<a href="logout.php" id='logout_btn'>Cerrar sesión</a>
	</header>
	<div class="cuerpo">
		<div class="arriba"> ARRIBA</div>
		<div class="abajo">ABAJO</div>
	</div>
</body>

</html>

<?php
include 'db.php';
session_start();
if(isset($_SESSION['user'])){		// Inicia sesión
	?>
	<script>
		document.querySelector('#login_btn').style.display = 'none';
		document.querySelector('#signup_btn').style.display = 'none';
		document.querySelector('#logout_btn').style.display = 'inline-block';
	</script>
	<div>
	 <?php echo '<h3 id="username">' . $_SESSION['user'] . '</h3>'; ?>
	</div>
	<form action="add_task.php" method='post' id='add_task_form'>
		<input type="text" name='title' placeholder='Titulo de la tarea' id='title' required>
		<input type="text" name='description' placeholder='Describe la tarea' id='description' required>
		<input type="submit" value='Añadir tarea' id='add_task_submit'>
	</form>

	<?php
	$query = $con->prepare('select * from tasks, users where users.user_id = ? and tasks.user_id = users.user_id');
	$query->execute(array($_SESSION['user_id']));
	$result = $query->fetchAll();
	foreach($result as $row) {
		?>
		<div class='task_container'>
			<h2> <?php echo $row['title'] ?> </h2>  
			<p> <?php echo $row['description'] ?> </p>
			<a href="index.php?del_task= <?php echo $row['task_id'] ?>">Borrar</a>
			<a href="index.php?edit_task= <?php echo $row['task_id'] ?>">Editar</a>
		</div>
		<?php
	}
	
	// Borrar tareas
	if(isset($_GET['del_task'])) {
		$query = $con->prepare('delete from tasks where task_id = ?');
		$query->execute(array($_GET['del_task']));
		header('Location: index.php');
	}

	// Editar tareas
	if(isset($_GET['edit_task'])) {
		$_SESSION['edit_task'] = $_GET['edit_task'];

		// Muestra texto para editar
		$query = $con->prepare('select title from tasks where task_id = ?');
		$query->execute(array($_SESSION['edit_task']));
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$_SESSION['title'] = $row['title'];
		header('Location: edit_task.php');

		$query = $con->prepare('select description from tasks where task_id = ?');
		$query->execute(array($_SESSION['edit_task']));
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$_SESSION['description'] = $row['description'];
		header('Location: edit_task.php');
		
	}

}
else {		//Cerrar sesión
	?>
	<script>
		document.querySelector('#login_btn').style.display = 'inline-block';
		document.querySelector('#signup_btn').style.display = 'inline-block';
		document.querySelector('#logout_btn').style.display = 'none';
	</script>
	<?php
}
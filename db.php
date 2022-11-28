<?php

try{
	$con = new PDO('mysql:host=localhost;dbname=todo_app','admin','password');
} catch(PDOException $e) {
	die('<p> Conexión fallida: </p>' . $e->getMessage());
}

$con->exec('create table if not exists users (
	user_id int(4) unsigned auto_increment primary key,
	username varchar(20)  not null,
	email varchar(40) not null,
	password varchar(64) not null
);');

$con->exec('create table if not exists tasks (
	task_id int(4) unsigned auto_increment primary key,
	user_id int(4) unsigned,
	title varchar(20) not null,
	description varchar(100) not null
);');
<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página cumple el rol de añadir eventos al calendario.
*/

//Se conecta a la base de datos.
include 'config1.php';

// Valores recibios via AJAX.
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];


//Query: Inserta el evento en la base de datos y se ejecuta el query.
$sql = "INSERT INTO events (title, start, end) VALUES (:title, :start, :end )";
$q = $conn->prepare($sql);
$q->execute(array(':title' => $title, ':start' => $start, ':end' => $end));
?>

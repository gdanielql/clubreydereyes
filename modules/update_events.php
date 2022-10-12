<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito actualizar el evento del calendario.
*/
include 'config1.php';
// Valores recibidos a través de AJAX.
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];


//Query: Actualizar el evento y enviarlo a la base de datos.
$sql = "UPDATE events SET title=?, start=?, end=? WHERE id=?";
$q = $conn->prepare($sql);
$q->execute(array($title, $start, $end, $id));
?>

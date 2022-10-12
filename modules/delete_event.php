<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito eliminar eventos de la base de datos.
*/

//Se conecta a la base de datos
include 'config1.php';
$id = $_POST['id'];

//Query: Elimina un evento de la base de datos en la tabla de "Events".
$sql = "DELETE from events WHERE id=" . $id;
$q = $conn->prepare($sql);
$q->execute();
?>

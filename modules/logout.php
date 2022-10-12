<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito salir de la sesión en la que se encuentra el usuario.
*/
	session_start();
	session_destroy();
	header("location: index.php");
?>

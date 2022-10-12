<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito descargar los archivos en archivos administrativos..
*/
$conn = mysqli_connect("localhost", "root", "root", "mattendance");


//Si el id está establecido, debe obtener el archivo con la identificación de la base de datos.
if (isset($_GET['id'])) {

    $id    = $_GET['id'];
    $query = "SELECT name, type, size, content FROM files WHERE id = $id";
    $result = mysqli_query($conn, $query) or die('Error, query failed');

    list($name, $type, $size, $content) = mysqli_fetch_array($result);

    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=$name");
    header("Content-Type: application/octet-stream=$content");

    echo $content;

}
?>

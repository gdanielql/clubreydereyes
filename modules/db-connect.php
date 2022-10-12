<?php
//Se procede a entrar a la base de datos.
$servername = "localhost";
$username = "root";
$password = "";
$database = 'mattendance';

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn, $database) or die( "Unable to select database");

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página se conecta a la base de datos introduciendo los datos necesarios para acceder a ella.
*/
//Conectar a la base de datos
	$databaseHost = 'localhost';
	$databaseName = 'mattendance';
	$databaseUsername = 'root';
	$databasePassword = 'root';

	try {

		$conn = new PDO('mysql:host=' . $databaseHost . ';dbname=' . $databaseName . '', $databaseUsername, $databasePassword);
	}
	catch (PDOException $e) {
    echo $e->getMessage();
	}
	// echo "Connection is there<br/>";
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

?>

<?php
$db = mysqli_connect('localhost', 'root', 'root', 'mattendance');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

	  }
		?>

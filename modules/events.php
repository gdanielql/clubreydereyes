<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar los eventos en el calendario de eventos..
*/
include 'config1.php';
// List of events
$json = array();

// Query that retrieves events
$request = "SELECT * FROM events ORDER BY id";

// Execute the query
$result = $conn->query($request) or die(print_r($conn->errorInfo()));

// sending the encoded result to success page
echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));

?>

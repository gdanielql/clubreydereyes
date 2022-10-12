<?php
      //export.php
 if(isset($_POST["export"]))
 {
      $connect = mysqli_connect("localhost", "root", "root", "mattendance");
      header('Content-Type: text/csv; charset=utf-8');
      header('Content-Disposition: attachment; filename=Informacion_miembros.csv');
      $output = fopen("php://output", "w");
      fputcsv($output, array('ID', 'Nombre y Apellidos', 'Email', 'ELO Rating', 'Telefono', 'Direccion'));
      $query = "SELECT * from member ORDER BY sid";
      $result = mysqli_query($connect, $query);
      while($row = mysqli_fetch_assoc($result))
      {
           fputcsv($output, $row);
      }
      fclose($output);
 }
 ?>

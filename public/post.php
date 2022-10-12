<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar las publicaciones del "Rincón Ajedrecístico". También, provee un navegador para facilitarle al usuario
          ver la información de forma rápida.
*/
//Conectar a la base de datos.
include 'config1.php';
?>



  <?php include 'nav.php';?>

  <div class="container">
     <div class="row">
         <div class="col-4">
             <img class="mx-auto d-block" style = "width:1100px; height:500px;" src="../images/aboutbackground.jpg">
         </div>
     </div>
  </div>

<!--Se construye el header de la página.-->
<div class="container">
  <div class="row">
    <div class="container p-3 my-3 bg-dark text-white">
			<center><h1 class="page-header">Rincón Ajedrecístico</h1><center>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
  	</div>
	</div>

        <div class="card p-3 my-3 bg-dark text-white">
        <div class="card-body">
	<?php

				 $conn = new mysqli("localhost","root","root","mattendance");
         //Query: Muestra las publicaciones guardadas en la base de datos en la tabla de "post".
				 $sql = "SELECT * FROM post";
				 $result = $conn->query($sql);
		     $count=0;
				 if ($result -> num_rows >  0) {

					 while ($row = $result->fetch_assoc())
	 {
			$count=$count+1;
						 ?>

	<h3 class="card-title"><?php echo $row["heading"] ?></h3>

	<p class="card-text"><?php echo $row["post"]  ?></p><hr>

			<?php

					 }
				 }

			?>

				</div>


			</div>
      <hr>
  <!--Se crea el botón para volver atrás-->
  <button class="btn btn-primary btn-block" onclick="history.go(-1);"> Atrás </button>


<style>
body{
  background-image:url("../images/woodback.jpg");


   background-size: cover;
    background-position: center;

  height: 140vh;
}


</style>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar los torneos guardados en la base de datos. También, para cada uno
					tendrá la opción de editar o eliminar. De igual forma, se podrá añadir si así lo desea.

*/

//Se conecta a la base de datos.
	include 'config1.php';
	$uid = $_SESSION['uid'];
	$date = date("d/m/Y");
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div style="position:relative; height:60px;">
<img src="images/trophy2.png"
   style="position:absolute; top:-100px; right:450px; width:200px; height:200px; border:none;"
   alt="Trofeo"
   title="Trofeo" />
</div>

<!-- Se construye el header-->
<!-- Título de página -->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">

			<h1 class="page-header">Registro de Torneos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">


				</div>
			</div>

<form method="POST" name= "search" class="form-inline" action="index.php?page=searchTourney">
<?php

if (isset($_POST['search'])) {
	include 'modules/search.php';
} else if (isset($_POST['add'])) {

include 'modules/additem.php';

}

?>

	<i class="fa fa-fw fa-search"></i> <input type="text" name="valueToSearch" placeholder="">
	<!--Se construye el botón de search.-->
	<input type="submit" name="search" class="btn btn-info" value = "Buscar"><br><br>

</form>
<!--Se construye el header de la tabla de torneos.-->
<div class="panel panel-primary">
<div class="panel-heading">
	<h3 class="panel-title">Torneos</h3>
</div>

<?php

if (isset($_GET['id']))
{

//Query: Con el ID recibido borra el torneo seleccionada.
$result = mysqli_query($db,"DELETE FROM tourney WHERE tid=".$_GET['id']);

}

?>

<div class="panel-body">

<!--Se construye el botón para añadir torneo.-->
	<form action="index.php?page=registertourn">
			<button type="submit" name="page" value="registertourn"  class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> Añadir Torneo</button>
	</form>

<!--Se construye la tabla de torneo.-->

	<table id="myTable" class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre del torneo</th>
			<th>Descripción</th>
			<th>Fecha</th>
			<th>Lugar</th>
			<th>Cantidad</th>
			<th>Premios</th>
			<th>Tipo</th>
			<th>Rating FIDE</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
<?php
		//Query: Muestra la información guardada de la base de datos en la tabla de "Tourney".
		 $sql = "SELECT * FROM tourney";
		 $result = $db->query($sql);
		 $count=0;
		 if ($result -> num_rows >  0) {

			 while ($row = $result->fetch_assoc())
{
	$count=$count+1;
	$date = date("d/m/Y");
		 ?>
 <tr>
	<td><?php echo $count ?></td>
		<td><?php echo $row["name"] ?></td>
		<td><?php echo $row["description"]  ?></td>
		<td><?php echo date('F d, Y ', strtotime($row['date'])); ?></td>
		<td><?php echo $row["place"]  ?></td>
		<td><?php echo $row["quantity"]  ?> jugador(es)</td>
		<td><?php echo $row["prize"]  ?></td>
		<td><?php echo $row["type"]  ?></td>
		<td><?php echo $row["rating"]  ?></td>

		<!--Para cada torneo tendrá la opción de eliminar o editar comunicándose con sus respectivas páginas.-->
		<th> <button href="up"Edit></a><a href="index.php?page=edit_tourney&id=<?php echo $row["tid"] ?>"><i class="fa fa-fw fa-pencil"></i>Editar</a>
			 <button  href="up"Edit></a><a <a onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=tourney&id=<?php echo $row["tid"] ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>
				</tr>
		<?php

				 }
			 }

		?>


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'modules/footer.php';?>
<!--Ejecuta la biblioteca de "dataTable" para asignar features a las tablas-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css"></style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>


<script>

function confirmationDelete(anchor)
{
   var conf = confirm('Se eliminará un torneo. Presione "OK" para confirmar');
   if(conf)
      window.location=anchor.attr("href");
}

$(document).ready(function(){
    $('#myTable').dataTable(
		{
			"searching":     false,
       "scrollX": true
		});
});

</script>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar los miembros del club que esté loggeado. La tabla tendrá las
					opciones de poder añadir, editar o eliminar un miembro.
*/

//Se conecta a la base de datos
	include 'config1.php';
	//Guarda el id de la sesión registrada
	$uid = $_SESSION['uid'];
?>


<div style="position:relative; height:60px;">
<img src="images/register.png" class="img-rounded"
   style="position:absolute; top:-100px; right:450px; width:200px; height:200px; border:none;"
   alt="Member"
   title="Member" />
</div>

<!--Se construye el header de la página.-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
			<h1 class="page-header">Miembros y Actividades</h1>
		</div>
	</div>
	<form method="POST" name= "search" class="form-inline" action="index.php?page=searchMember">

	<?php


	if (isset($_POST['search'])) {
			include 'index.php?page=searchMember';
	} else if (isset($_POST['add'])) {

	include 'modules/register.php';

	}

	 ?>

	<i class="fa fa-fw fa-search"></i> <input type="text" name="valueToSearch" placeholder="">
	<!--Se construye el botón de search.-->
	<input type="submit" name="search"  id = "search" class="btn btn-info" value = "Buscar"><br><br>

	</form>


	<div class="row">
		<div class="col-md-12 col-lg-12">

			<!--Se construye el header de la tabla de actividades.-->
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Actividades</h3>
				</div>
				<div class="panel-body">

					<?php
						$output = '';
						//Query: Muestra la información de las actividades que se celebran en el club que esté loggeado.
						$query_subject = "SELECT activity.name, activity.id from activity INNER JOIN user_activity WHERE user_activity.id = activity.id AND user_activity.uid = {$uid}  ORDER BY activity.name";
						$sub=$conn->query($query_subject);
						$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);

						$noOfSubject = count($rsub);

						for($i = 0; $i<$noOfSubject; $i++) {
							$output .= $rsub[$i]['name'];
							$output .= ',&nbsp;';
						}
						print $output;
					?>

				</div>
			</div>


	<!--Se construye el header de la tabla miembros.-->

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Miembros</h3>
				</div>
				<div class="panel-body">
					<?php

					if (isset($_GET['id']))
					{

					//Query: Con el ID recibido borra el miembro seleccionado.
					$result = mysqli_query($db,"DELETE FROM member WHERE sid=".$_GET['id']);
					if($result==true)

					$result = mysqli_query($db,"DELETE FROM member_activity WHERE sid=".$_GET['id']);

					}

					?>

	<!--Se construye el botón de "Añadir miembro".-->
					<form action="index.php?page=register">

							<button type="submit" name="page" value="register"  class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> Añadir Miembro</button>

					</form>

	<!--Se construye la tabla de los miembros-->
				<table id="myTable"  class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre y Apellidos</th>
							<th>Email</th>
							<th>ELO Rating</th>
							<th>Teléfono</th>
							<th>Dirección</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						<?php

						//Query: Muestra la información de los miembros que estén registrados en el club que esté loggeado unicamente ordenados por nombre.
							$sql = "SELECT DISTINCT member.sid sid, name, email, rating, cellphone, address FROM `user_activity` INNER JOIN member_activity INNER JOIN member
							 WHERE user_activity.id = member_activity.id AND member_activity.sid = member.sid AND user_activity.uid = $uid ORDER BY name";

						 $result = $db->query($sql);
							$count=0;
									 if ($result -> num_rows >  0) {

										//Se recorre todas las filas para obtener la información de los miembros
										 while ($row = $result->fetch_assoc())
						 {
								$count=$count+1;
											 ?>
											 <tr>

													<td><?php echo $row["sid"] ?></td>
													<td><?php echo $row["name"] ?></td>
													<td><?php echo $row["email"]  ?></td>
													<td><?php echo $row["rating"]  ?></td>
													<td><?php echo $row["cellphone"]  ?></td>
													<td><?php echo $row["address"]  ?></td>

														<!--Para cada miembro, tendrá la opción de editarlo o eliminarlo.-->
													<th> <button  href="up"Edit></a><a href="index.php?page=edit_member&id=<?php echo $row["sid"] ?>"><i class="fa fa-fw fa-pencil"></i>Editar</a>
														 <button  href="up"Delete></a><a onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=memberinfo&id=<?php echo $row["sid"] ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>
												</tr>

												<?php

														 }
													 }

												?>

						</tbody>
					</div>
				</table><hr>
					<form method="post" action="modules/export.php" align="center">
						<center><input type="submit" name="export" value="Exportar en Archivo Excel" class="btn btn-success btn-block" /><center>
					</form>
			</div>
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
   var conf = confirm('Se eliminará un miembro. Presione "OK" para confirmar');
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

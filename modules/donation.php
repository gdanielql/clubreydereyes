<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar una tabla que contenga todas las donaciones a nivel de los 4
          clubes. De igual manera tiene la opción de poder añadir, editar o eliminar alguna donación.
*/
//Conecta a la base de datos
  include 'config1.php';
	$uid = $_SESSION['uid'];
?>

<!--Imagen de centro.-->
<div style="position:relative; height:60px;">
  <img src="images/wallet.png" style="position:absolute; top:-100px; right:430px; width:200px; height:200px; border:none;" alt="Donación" title="Donación" />
</div>

<!--Se construye el header.-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <h1 class="page-header">Registro de Donaciones</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12">
    </div>
  </div>

  <!--Se coloca el textbox y el botón que redirige al search-->
      <form method="POST" name= "search" class="form-inline" action="index.php?page=searchDonation">
      	<?php

      	if (isset($_POST['search'])) {
      	    include 'modules/search.php';
      	} else if (isset($_POST['add'])) {

      	include 'modules/additem.php';

      	}

      	 ?>
<i class="fa fa-fw fa-search"></i> <input type="text" name="valueToSearch" placeholder="">
<!--Se construye el botón de search.-->
<input type="submit" name="search" class="btn btn-info" value="Buscar"><br><br>
</form>
<!--Se construye el heading de la tabla-->
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Donaciones</h3>
  </div>

  <?php

  if (isset($_GET['id']))
  {

  //Query: Con el ID recibido borra la donación seleccionada.
  $result = mysqli_query($db,"DELETE FROM donation WHERE donation_id=".$_GET['id']);

  }

  ?>
  <div class="panel-body">

    <!--Se construye el botón para añadir una donación-->
    <form action="index.php?page=registerdon">

      <button type="submit" name="page" value="registerdon" class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> Añadir Donación</button>

    </form>
    <!--Se construye la tabla en donde mostrará las donaciones con las diferentes opciones-->
    <table id="myTable" class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre del donante</th>
          <th>Fecha</th>
          <th>Cantidad</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
<?php
              //Query: Muestra todas las donaciones de la tabla "donation" de la base de datos
								 $sql = "SELECT * FROM donation";
								 $result = $db->query($sql);
						$count=0;
								 if ($result -> num_rows >  0) {

									 while ($row = $result->fetch_assoc())
					 {
							$count=$count+1;
										 ?>
					<tr>
	  <td><?php echo $count ?></td>
	  <td><?php echo $row["name"] ?></td>
	  <td><?php echo date('F d, Y ', strtotime($row['date'])); ?></td>
	  <td>$<?php echo number_format((float)$row['quantity'], 2, '.', ''); ?></td>
		<th> <button href="up" Edit></a><a href="index.php?page=edit_donation&id=<?php echo $row["donation_id"] ?>"><i class="fa fa-fw fa-pencil"></i>Editar</a>
		<button href="up" Edit></a><a onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=donation&id=<?php echo $row["donation_id"] ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>

					</tr>
					<?php

									 }
								 }

							?>

					</table>

          <hr>
  					<form method="post" action="modules/export_donation.php" align="center">
  						<center><input type="submit" name="export" value="Exportar en Archivo Excel" class="btn btn-success btn-block" /><center>
  					</form>

					</div>
					</div>

					<!--Se construye la tabla en donde mostrará el total de las donaciones en dólares-->
					<div class="panel panel-info" style="width: 300px;">
					  <div class="panel-heading">
					    <h3 class="panel-title">Contador</h3>
					  </div>
					  <div class="panel-body">
					    <?php
              //Query: Suma la cantidad de las donaciones
							 $sql = "SELECT SUM(quantity) as donation_sum FROM `donation`";
							 $result = $db->query($sql);
							 $count=0;
							 if ($result -> num_rows >  0) {

								 while ($row = $result->fetch_assoc())
				 {
						$count=$count+1;
									 ?>

					    <h5>Total de Donaciones: $<?php print number_format((float)$row['donation_sum'], 2, '.', '');?></a></h5>
					    <?php

	 }
 }

?>

	  </div>
	  </div>
	  </div>
	  </div>
	  </div>
					<?php include 'modules/footer.php';?>
					<!--Ejecuta la biblioteca de "dataTable" para asignar features a las tablas-->
					<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
					</style>
					<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
					<script>
					  function confirmationDelete(anchor) {
					    var conf = confirm('Se eliminará una donación. Presione "OK" para confirmar');
					    if (conf)
					      window.location = anchor.attr("href");
					  }

					  $(document).ready(function() {
					    $('#myTable').dataTable({
					      "searching": false,
					      "info": false

					    });
					  });
					</script>

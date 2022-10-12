<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar los productos del inventario. También tiene la opción de poder
					añadir, editar o eliminar algún producto. De igual manera un buscador.
*/
//Se conecta a la base de datos.
	include 'config1.php';

?>
		<!-- Se construye el header-->
	<!-- Título de página -->
	<div class="page-title-area">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<div class="breadcrumbs-area clearfix">
					</ul>
				</div>
			</div>
			<div class="col-sm-6 clearfix">
				<!-- Imagen de centro -->
				<div style="position:relative; height:150px;">
					<img src="images/inventory.png" style="position:absolute; top:-100px; right:450px; width:250px; height:250px; border:none;" alt="Inventario" title="Inventario" />
				</div>

			</div>
		</div>
	</div>

<h1 class="page-header">Registro de Productos</h1>

<form method="POST" name= "search" class="form-inline" action="index.php?page=search">


	<?php
//Se construye el buscador y se redirige a la página de search.php
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
  </body>
  <div class="main-content-inner">
  	<div class="row">
  		<!--Se construye el header de la tabla de producto.-->
  		<div class="panel panel-primary">
  			<div class="panel-heading">
  				<h3 class="panel-title">Productos</h3>
  			</div>

				<?php

				if (isset($_GET['id']))
				{
				//Query: Una vez recibido el ID se procede a eliminar el producto
				$result = mysqli_query($db,"DELETE FROM product WHERE product_id=".$_GET['id']);

				}
				?>

  			<div class="table-responsive">
  				<div class="panel-body">
  					<form action="index.php?page=registerinventory">

  						<button type="submit" name="page" value="inventory" class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> Añadir Producto</button>

  					</form>
  					<!--Se construye la tabla que va a contener la información sobre los productos.-->
  					<table id="myTable" class="table table-striped">

  						<thead>
  							<tr class="table-active">
  								<th>ID</th>
  								<th scope="col">Nombre</th>
  								<th scope="col">Precio</th>
  								<th scope="col">Cantidad</th>
  								<th scope="col">Club</th>
  								<th scope="col">Opciones</th>
  							</tr>
  						</thead>
  						<tbody>
<?php
//Query: Muestra los productos de la base de datos de la tabla productos ordenada por el nombre del club.
			 $sql = "SELECT * FROM product ORDER BY club";
			 $result = $db->query($sql);
			 $count=0;
			 if ($result -> num_rows >  0) {

//Se recorre todas las filas para mostrar los distintos productos.
				 while ($row = $result->fetch_assoc())
 {
		$count=$count+1;
					 ?>
					 <tr>
						<td><?php echo $count ?></td>
							<td><?php echo $row["product_name"] ?></td>
							<td>$<?php echo $row["price"]  ?></td>
							<td><?php echo $row["quantity"]  ?> articulo(s)</td>
							<td><?php echo $row["club"]  ?></td>

				<!--Permite que cada producto tenga las diferentes opciones.-->
		<th> <button  href="up"Edit></a><a href="index.php?page=edit&id=<?php echo $row["product_id"] ?>"><i class="fa fa-fw fa-pencil"></i>Editar</a>
			 <button  href="up"Edit></a><a onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=inventorylist&id=<?php echo $row["product_id"] ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></td>
			 </th>

		<?php

				 }
			 }

		?>

	</tbody>



	</table>
	<br>

	<form action="index.php?page=catalog">
		<button type="submit" name="page" value="catalog" class="btn btn-warning btn-block"><i class="fa fa-fw fa-eye"></i> Ver el Catálogo</button>
	</form>


	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
<?php include 'modules/footer.php';?>
</html>

<!--Ejecuta la biblioteca de "dataTable" para asignar features a las tablas-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css"></style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>

function confirmationDelete(anchor)
{
   var conf = confirm('Se eliminará un producto. Presione "OK" para confirmar');
   if(conf)
      window.location=anchor.attr("href");
}
$(document).ready(function(){
    $('#myTable').dataTable(
		{
			"searching":     false
		});
});

 </script>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página es parte del inventario. Busca un producto del inventario según su nombre, club, precio o cantidad.
*/
//Si se presiona el botón de buscar se activará el query que realiza la búsqueda.
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];

    //Query: Busca en todas las columnas de la tabla de productos.
    $query = "SELECT * FROM `tourney` WHERE CONCAT(`name`, `description`, `date`,`place`, `quantity`, `prize`, `type`, `rating` ) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM `tourney`";
    $search_result = filterTable($query);
}

//Función que conecta y ejecuta el query.
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "root", "mattendance");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>
    <body>
    <div style="position:relative; height:60px;">
      <img src="images/trophy2.png" style="position:absolute; top:-100px; right:450px; width:200px; height:200px; border:none;" alt="Trofeo" title="Trofeo" />
    </div>

    <!--Se construye el header de la página.-->
    <div class="container">
      <div class="row">
        <h1 class="page-header">Resultados de su Búsqueda</h1>
      </div>
    </div>

    <!--Se construye el header de la tbala.-->
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Productos</h3>
    </div>
    <div class="panel-body">
      <!--Se construye la tabla que obtendra los productos que se busquen.-->
      <table id="myTab" class="table table-striped">
        <thead>
          <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Cantidad</th>
            <th>Premios</th>
            <th>Tipo</th>
            <th>Rating FIDE</th>

          </tr>
        </thead>
        <tbody>

          <!-- Poblar la tabla con la base de datos.-->
          <?php while($row = mysqli_fetch_array($search_result)):?>
          <tr>

            <td><?php echo $row["tid"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["description"]  ?></td>
            <td><?php echo date('F d, Y ', strtotime($row['date'])); ?></td>
            <td><?php echo $row["place"]  ?></td>
            <td><?php echo $row["quantity"]  ?> jugador(es)</td>
            <td><?php echo $row["prize"]  ?></td>
            <td><?php echo $row["type"]  ?></td>
            <td><?php echo $row["rating"]  ?></td>

          </tr>
          <?php endwhile;?>
      </table>
      </form>

    </div>
  </div>
  </div>
  <br>
<!--Se construye un botón para regresar.-->
<input type="submit" <a href="#"  class="btn btn-success btn-block" onclick="history.back();" value ="Atrás"</a>
<?php include 'modules/footer.php';?>
</body>
</html>

<!--Ejecuta la biblioteca de "dataTable" para asignar features a las tablas-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css"></style>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<script>

$(document).ready(function(){
    $('#myTab').dataTable(
		{
			"searching":     false,
			 "info":     false,
       "scrollX": true
		});
});

</script>

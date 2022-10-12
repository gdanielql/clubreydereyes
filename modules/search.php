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
    $query = "SELECT * FROM `product` WHERE CONCAT(`product_name`, `price`, `quantity`,`club`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM `product`";
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
    <!--Se coloca imagen de centro.-->
    <div style="position:relative; height:150px;">
      <img src="images/inventory.png" style="position:absolute; top:-100px; right:450px; width:250px; height:250px; border:none;" alt="Inventario" title="Inventario" />
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
        <table class="table">
          <tr>
            <th>Nombre del Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Club</th>
          </tr>

          <!-- Poblar la tabla con la base de datos.-->
          <?php while($row = mysqli_fetch_array($search_result)):?>
          <tr>

            <td><?php echo $row['product_name'];?></td>
            <td><?php echo $row['price'];?></td>
            <td><?php echo $row['quantity'];?></td>
            <td><?php echo $row['club'];?></td>
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


<?php include 'modules/footer.php';?>
<script>
$(document).ready(function(){
    $('#myTable').dataTable(
		{
			"searching":     false,
			 "info":     false,
       "scrollX": true
		});
});

</script>

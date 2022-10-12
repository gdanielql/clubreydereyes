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
    $query = "SELECT * FROM `donation` WHERE CONCAT(`name`, `date`, `quantity`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);

}
 else {
    $query = "SELECT * FROM `donation`";
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
  <!--Se coloca imagen de centro-->
<div style="position:relative; height:60px;">
  <img src="images/wallet.png" style="position:absolute; top:-100px; right:500px; width:200px; height:200px; border:none;" alt="Donación" title="Donación" />
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
    <h3 class="panel-title">Donaciones</h3>
  </div>
  <div class="panel-body">
    <!--Se construye la tabla que obtendra los productos que se busquen.-->

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre del donante</th>
          <th>Fecha</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
      <!-- Poblar la tabla con la base de datos.-->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>

                    <td><?php echo $row['donation_id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo date('F d, Y ', strtotime($row['date'])); ?></td>
                    <td>$<?php echo number_format((float)$row['quantity'], 2, '.', ''); ?></td>

                </tr>
                <?php endwhile;?>
            </table>
        </form>
</div>
</div>

<!--Se construye un botón para regresar.-->
<input type="submit" <a href="#" class="btn btn-success btn-block" onclick="history.back();" value="Atrás" </a>
</div>
<?php include 'modules/footer.php';?>
<br>


</div>
</body>

</html>
<?php include 'modules/footer.php';?>

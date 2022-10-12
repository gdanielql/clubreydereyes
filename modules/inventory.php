<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito añadir un producto al inventario.
*/

//Conecta a la base de datos.
include 'config1.php';

?>
<div style="position:relative; height:150px;">
  <img src="images/inventory.png" style="position:absolute; top:-100px; right:450px; width:250px; height:300px; border:none;" alt="Inventario" title="Inventario" />
</div>

<!--Se construye el header.-->
<div class="container">
  <div class="row">
    <h1 class="page-header">Registra un Producto</h1>
    <?php
    if (isset($_POST['inventory']) && !empty($_POST['product_name'])) {
        $product_name = $_POST['product_name'];
        $price        = $_POST['price'];
        $quantity     = $_POST['quantity'];
        $club         = $_POST['club'];

        //Query: Guarda la información del producto en la base de datos en la tabla de "product".
        $query = "INSERT INTO product (`product_name`, `price`, `quantity`, `club`) VALUES('" . $product_name . "','" . $price . "', '" . $quantity . "','" . $club . "')";
        mysqli_query($db, $query);

        echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>¡Hecho!</strong> Producto registrado con éxito!.
          </div>';



    }
    $db->close();
    ?>

  </div>
</div>

<div class="panel panel-default">
<div class="panel-heading">
  <h3 class="panel-title">Registro</h3>
</div>
<div class="panel-body">

<!--Se construye el form en donde el usuario tiene que rellenar la información del producto para ser guardada.-->
<form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
  <div class="form-group">
    <div class="col-xs-3">
      <label for="name"> Nombre del Producto: </label>
      <input type="text" name="product_name" class="form-control" required>
    </div>

    <div class="form-group">
      <div class="col-xs-3">
        <label for="price"> Precio: </label>
        <input type="text" name="price" class="form-control" placeholder="$0.00" required>
      </div>

      <div class="form-group">
        <div class="col-xs-3">
          <label for="quantity"> Cantidad: </label>
          <input type="text" name="quantity" class="form-control" placeholder="0" required>
        </div>

        <!--Se crea un dropdown para elegir el club.-->
        <div class="form-group">
          <div class="col-xs-3">
            <label for="club">Elija un Club: </label>
            <select name="club" class="form-control">
              <label for="club">Elija un Club: </label>
              <option value="Trujillo Alto" selected>Trujillo Alto</option>
              <option value="Aibonito">Aibonito</option>
              <option value="Arecibo">Arecibo</option>
              <option value="Florida">Florida</option>
            </select>
            <br>
          </div>
          </select>
          <br>
        </div>
        <br>
        <hr>

        <!--Se construye el botón para "Guardar".-->
        <input type="submit" name="inventory" class="btn btn-success btn-block" value="Guardar">
        <!--Se construye el botón de "Atrás".-->
       <a class="btn btn-primary btn-block" href="index.php?page=inventorylist">Atrás</a>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include 'modules/footer.php';?>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito editar los productos en las tabla del apartado de "Inventario".
*/
//Conecta a la base de datos.
include 'config1.php';

//Acción que permite volver una página atrás.
    $previous = "javascript:window.history.go(-2)";
    if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>
<?php

if (isset($_POST['submit'])) {
    $id    = $_POST['id'];
    $name  = mysqli_real_escape_string($db, $_POST['product_name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $quant = mysqli_real_escape_string($db, $_POST['quantity']);
    $club  = mysqli_real_escape_string($db, $_POST['dropdown']);

    //Query: Permite actualizar la información de las donaciones con el ID correspondiente.
    mysqli_query($db, "UPDATE product SET product_name='$name', price='$price' ,quantity='$quant', club='$club' WHERE product_id='$id'");

}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id     = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM product WHERE product_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id    = $row['product_id'];
        $name  = $row['product_name'];
        $price = $row['price'];
        $quant = $row['quantity'];
        $club  = $row['club'];
    } else {
        echo "No results!";
    }
}
?>

<?php
   if(isset($_POST['submit']))
   {
     //Redirige al usuario una vez se hagan los cambios a la página de "Inventario".
    header('Location: http://localhost:8080/member/index.php?page=inventorylist');
   }
?>


<html>
<head>
<title>Edit Item</title>
</head>
<body>

</div>

<!-- Imagen de centro -->
<div style="position:relative; height:150px;">
  <img src="images/inventory.png" style="position:absolute; top:-100px; right:450px; width:250px; height:250px; border:none;" alt="Inventario" title="Inventario" />
</div>


  <form action="" method="post" action="edit.php">
  <input type="hidden" name="id" value="<?php echo $id; ?>" />

  <div class="container">
<div class="row">

    <!--Se construye el header.-->
    <div class="container">
      <div class="row">
        <h1 class="page-header">Editar un Producto</h1>
      </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-heading">
    	<h3 class="panel-title">Registro</h3>
    </div>
  <div class="panel-body">
    <!--Se construye el form en donde se pretende editar la información que así lo entienda necesario el usuario.-->
    <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
      <div class="form-group">
        <div class="col-xs-3">

          <label for="name"> Nombre del Producto: </label>
          <input type="text" name="product_name" value="<?php echo $name;?>" class="form-control" required>

        </div>

        <div class="form-group">
          <div class="col-xs-3">
            <label for="price"> Precio: </label>
            <input type="text" name="price" value="<?php echo $price;?>" class="form-control" placeholder="$0.00" required>
          </div>

          <div class="form-group">
            <div class="col-xs-3">
              <label for="quantity"> Cantidad: </label>
              <input type="text" name="quantity" value="<?php echo $quant;?>" class="form-control" placeholder="0" required>
            </div>

            <div class="form-group">
              <div class="col-xs-3">
                <label for="club">Elija un Club: </label>
                <select name="dropdown"  class="form-control">
                  <option value="Trujillo Alto" <?php if($row["club"]=='Trujillo Alto') echo "selected";?>>Trujillo Alto</option>
                  <option value="Aibonito" <?php if($row["club"]=='Aibonito') echo "selected";?> >Aibonito</option>
                  <option value="Arecibo" <?php if($row["club"]=='Arecibo') echo "selected";?>>Arecibo</option>
                  <option value="Florida" <?php if($row["club"]=='Florida') echo "selected";?>>Florida</option>
                </select>
                <br>
              </div>
              </select>
              <br>
            </div>
            </select>
            <br>

          </div>
          <hr>

          <input type="hidden" name="goback" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

          <!--Se construye el botón de "Editar producto".-->
          <input type="submit" class="btn btn-success btn-block" name="submit" onclick="modules/inventory.php" value="Editar producto">
          <!--Se construye el botón de "Atrás".-->
          <a class="btn btn-primary btn-block" href="<?= $previous ?>">Atrás</a </label></td>
          </tr>
          </table>
    </form>
  </div>
</div>
</div>
</div>
</div>
</div>
</body>

</html>
<?php include 'modules/footer.php';?>

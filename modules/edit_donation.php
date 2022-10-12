<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito editar las donaciones en las tabla del apartado.
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
    $name  = mysqli_real_escape_string($db, $_POST['name']);
    $date  = mysqli_real_escape_string($db, $_POST['date']);
    $quant = mysqli_real_escape_string($db, $_POST['quantity']);

    //Query: Permite actualizar la información de las donaciones con el ID correspondiente.
    mysqli_query($db, "UPDATE donation SET name='$name', date='$date' ,quantity='$quant' WHERE donation_id='$id'");

}

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id     = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM donation WHERE donation_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id    = $row['donation_id'];
        $name  = $row['name'];
        $date  = $row['date'];
        $quant = $row['quantity'];

    } else {
        echo "No results!";
    }
}
?>

<?php
   if(isset($_POST['submit']))
   {
      //Redirige al usuario una vez se hagan los cambios a la página de "Donaciones".
    header('Location: http://localhost:8080/member/index.php?page=donation');
   }
?>

<html>

<head>
  <title>Edit Donation</title>
</head>

<body>

  <!--Imagen de centro.-->
  <div style="position:relative; height:60px;">
    <img src="images/wallet.png" style="position:absolute; top:-100px; right:430px; width:200px; height:200px; border:none;" alt="Donación" title="Donación" />
  </div>


  <br><br><br>
  </div>

  <form action="" method="post" action="edit_donation.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <!--Se construye el header.-->
    <div class="container">
      <div class="row">
          <h1 class="page-header">Editar una Donación</h1>
          <p> Por favor llene toda la información. Los campos marcados con * son obligatorios.</p>
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
          <div class="col-xs-4">
            <label for="name"> * Nombre: </label>
            <input type="text" name="name" class="form-control" value="<?php echo $name;?>" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="No introduzca números o caracteres especiales " placeholder="Nombre completo" required>
          </div>

          <div class="form-group" data-provide="datepicker">
            <div class="col-xs-4">
              <label for="select" class="control-label"> * Fecha:</label>
              <input type="date" class="form-control" name="date" value="<?php echo $date;?>" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
            </div>

            <div class="form-group">
              <div class="col-xs-4">
                <label for="quantity"> * Cantidad: </label>
                <input type="text" name="quantity" class="form-control" value="<?php echo $quant;?>" pattern="\d+(\.\d{1,2})?" title="Solo dígitos" placeholder="$0.00" required>
              </div>
              </select>
            </div>
            <br><br>
            <hr>

            <input type="hidden" name="goback" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <!--Se construye el botón de "Editar producto".-->
            <input type="submit" name="submit" class="btn btn-success btn-block" onclick="modules/inventory.php" value="Editar donación">
            <!--Se construye el botón de "Atrás"-->
            <a class="btn btn-primary btn-block" href="<?= $previous ?>">Atrás</a </label></td>
            </tr>
            </table>
            </body>
      </form>
    </div>
  </div>
</div>
</div>
</div>


</html>
<?php include 'modules/footer.php';?>

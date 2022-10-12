<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito añadir una nueva donación a la tabla de "donation" de la base de datos.
*/
//Se conecta a la base de datos.
include 'config1.php';

?>
<div style="position:relative; height:60px;">
  <img src="images/wallet.png" style="position:absolute; top:-100px; right:500px; width:200px; height:200px; border:none;" alt="Donación" title="Donación" />
</div>

<!--Se construye el header de la página-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <h1 class="page-header">Registra una Donación</h1>
      <p> Por favor llene toda la información. Los campos marcados con * son obligatorios.</p>
      <?php
      //Una vez se oprima el botón de guardar, se procede a guardar la información en las distintas variables de la base de datos e insertarlas.
      if(isset($_POST['registerdon']) && !empty($_POST['name'])){
          $name = $_POST['name'];
          $date = $_POST['date'];
          $quantity = $_POST['quantity'];

          //Query: Guarda la información de la donación en la base de datos en la tabla de "Donation".
          $query = "INSERT INTO donation(`name`, `date`, `quantity`) VALUES('".$name."','".$date."', '".$quantity."')";
          mysqli_query($db, $query);


          echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>¡Hecho!</strong> Donación registrada con éxito!.
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
  <!--Se construye el form de la página en donde se le pide al usuario la información sobre la donación que desee registrar.-->
  <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
    <div class="form-group">
      <div class="col-xs-4">
        <label for="name"> * Nombre: </label>
        <input type="text" name="name" class="form-control"  placeholder="Nombre completo" required>
      </div>

      <div class="form-group" data-provide="datepicker">
        <div class="col-xs-4">
          <label for="select" class="control-label"> * Fecha:</label>
          <input type="date" class="form-control" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
        </div>

        <div class="form-group">
          <div class="col-xs-4">
            <label for="quantity"> * Cantidad: </label>
            <input type="text" name="quantity" class="form-control" pattern="\d+(\.\d{1,2})?" title="Solo dígitos" placeholder="$0.00" required>
          </div>

          </select>
        </div>
        <br>
        <br>
        <hr>
        <input type="submit" name="registerdon" class="btn btn-success btn-block" value="Guardar">
        <!--Se construye el botón de "Atrás".-->
       <a class="btn btn-primary btn-block" href="index.php?page=donation">Atrás</a>
  </form>

</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'modules/footer.php';?>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito añadir un torneo en la tabla de "tourney" de la base de datos.
*/
//Se conecta a la base de datos.
include 'config1.php';
?>




<div style="position:relative; height:60px;">
  <img src="images/trophy2.png" style="position:absolute; top:-100px; right:450px; width:200px; height:200px; border:none;" alt="Trofeo" title="Trofeo" />
</div>

<!--Se construye el header de la página-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <h1 class="page-header">Registra un Torneo</h1>
      <p> Por favor llene toda la información. Los campos marcados con * son obligatorios.</p>
      <br>
      <?php
      //Una vez se oprima el botón de guardar, se procede a guardar la información en las distintas variables de la base de datos e insertarlas.
      if(isset($_POST['registertourn']) && !empty($_POST['name'])){
          $name = $_POST['name'];
          $description = $_POST['description'];
          $date = $_POST['date'];
          $place = $_POST['place'];
          $quantity = $_POST['quantity'];
          $prize = $_POST['prize'];
          $type = $_POST['type'];
          $rating = $_POST['rating'];

          //Query: Guarda la información sobre el torneo en la base de datos en la tabla de "tourney".
          $query = "INSERT INTO tourney (`name`, `description`,`date`, `place`, `quantity`, `prize`, `type`, `rating` ) VALUES('".$name."','".$description."',
            '".$date."', '".$place."','".$quantity."', '".$prize."', '".$type."', '".$rating."' )";
          mysqli_query($db, $query);

          echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>¡Hecho!</strong> Torneo registrado con éxito!.
            </div>';

        }
      $db->close();
      ?>

    </div>
  </div>

  <div class="panel panel-default" style="width:830px;">
  <div class="panel-heading">
  	<h3 class="panel-title">Registro</h3>
  </div>
<div class="panel-body">

  <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
    <!--Se construye el form en donde se le solicita al usuario la información completa sobre el torneo que desea registrar-->
    <div class="form-group">
      <label for="name"> * Nombre:</label>
      <input type="text" name="name" style="width:800px;" class="form-control"  required>
    </div>

    <div class="form-group">
      <label for="description"> Descripción:</label>
      <input type="text" name="description" style="width:800px;" class="form-control" required>
    </div>

    <div class="form-group" data-provide="datepicker">
      <label for="select" class="control-label"> * Fecha:</label>
      <input type="date" class="form-control" style="width:800px;" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
    </div>

    <div class="form-group">
      <label for="place"> * Lugar:</label>
      <input type="text" name="place" style="width:800px;" class="form-control" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="No introduzca números o caracteres especiales " required>
    </div>

    <div class="form-group">
      <label for="quantity"> * Cantidad de Participantes:</label>
      <input type="text" name="quantity" style="width:800px;" class="form-control" pattern="\d{1,5}" title="Solo dígitos" required>
    </div>

    <div class="form-group">
      <label for="quantity"> * Premios:</label>
      <input type="text" name="prize" style="width:800px;" class="form-control" required>
    </div>

    <!--Se crea un dropdown para elegir el tipo de torneo.-->
    <div class="form-group">
      <div class="col-xs-3">
        <label for="type">Tipo de Torneo: </label>
        <select name="type" class="form-control">
          <label for="type">Tipo de torneo: </label>
          <option value="Rapid" selected>Rapid</option>
          <option value="Blitz">Blitz</option>
          <option value="Clásico">Clásico</option>
          <option value="Simultaneas">Simultaneo</option>
        </select>
        <br>
      </div>


      <!--Se crea un dropdown para elegir si es por rating FIDE.-->
      <div class="form-group">
        <div class="col-xs-4">
          <label for="rating">¿Cuenta para rating FIDE?: </label>
          <select name="rating" class="form-control">
            <option value="Sí" selected>Sí</option>
            <option value="No">No</option>
          </select>
          <br>
        </div>
        </select>

</div>
</div>

<hr>
<input type="submit" name="registertourn" class="btn btn-success btn-block" value="Guardar">
<!--Se construye el botón de "Atrás".-->
<a class="btn btn-primary btn-block" href="index.php?page=tourney">Atrás</a>

</form>

</div>
</div>
</div>
</div>

<?php include 'modules/footer.php';?>

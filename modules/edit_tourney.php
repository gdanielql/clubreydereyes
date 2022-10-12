<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito editar los torneos en las tabla del apartado.
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
    $id          = $_POST['id'];
    $name        = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $date        = mysqli_real_escape_string($db, $_POST['date']);
    $place       = mysqli_real_escape_string($db, $_POST['place']);
    $quantity    = mysqli_real_escape_string($db, $_POST['quantity']);
    $prize       = mysqli_real_escape_string($db, $_POST['prize']);
    $type        = mysqli_real_escape_string($db, $_POST['type']);
    $rating      = mysqli_real_escape_string($db, $_POST['rating']);

    //Query: Permite actualizar la información de las donaciones con el ID correspondiente.
    mysqli_query($db, "UPDATE tourney SET name='$name', description='$description' , date='$date',
   place='$place', quantity='$quantity', prize='$prize', type='$type', rating='$rating'  WHERE tid ='$id'");

}

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id     = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM tourney WHERE tid=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id          = $row['tid'];
        $name        = $row['name'];
        $description = $row['description'];
        $date        = $row['date'];
        $place       = $row['place'];
        $quantity    = $row['quantity'];
        $prize       = $row['prize'];
        $type        = $row['type'];
        $rating      = $row['rating'];
    } else {
        echo "No results!";
    }
}
?>


<?php
   if(isset($_POST['submit']))
   {
 //Redirige al usuario una vez se hagan los cambios a la página de "Torneos".
    header('Location: http://localhost:8080/member/index.php?page=tourney');
   }
?>


<html>
<head>
<title>Editar Torneo</title>
</head>
<body>

  <div style="position:relative; height:60px;">
  <img src="images/trophy2.png"
     style="position:absolute; top:-100px; right:450px; width:200px; height:200px; border:none;"
     alt="Trofeo"
     title="Trofeo" />
  </div>


<form action="" method="post" action="edit.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<!--Se construye el header.-->
<div class="container">
  <div class="row">
			<h1 class="page-header">Editar un Torneo</h1>
      <p> Por favor llene toda la información. Los campos marcados con * son obligatorios.</p>
      <br>
		</div>
	</div>
  <!--Se construye el form en donde se pretende editar la información que así lo entienda necesario el usuario.-->
  <div class="panel panel-default" style="width:830px;">
  <div class="panel-heading">
    <h3 class="panel-title">Registro</h3>
  </div>
  <div class="panel-body">
  <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
      <div class="form-group">
          <label for="name"> * Nombre:</label>
          <input type="text" name="name" value="<?php echo $name;?>"  style="width:800px;"class="form-control" required>
      </div>

      <div class="form-group">
          <label for="description"> Descripción:</label>
          <input type="text" name="description" value="<?php echo $description;?>" style="width:800px;" class="form-control" required>
      </div>

      <div class="form-group" data-provide="datepicker">
        <label for="select" class="control-label"> * Fecha:</label>
        <input type="date" class="form-control"  style="width:800px;"  value="<?php echo $date;?>" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
      </div>

      <div class="form-group">
          <label for="place"> * Lugar:</label>
          <input type="text" name="place" style="width:800px;" value="<?php echo $place;?>"  class="form-control" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$"
          title="No introduzca números o caracteres especiales "  required>
      </div>

      <div class="form-group">
          <label for="quantity"> * Cantidad de Participantes:</label>
          <input type="text" name="quantity"  style="width:800px;" value="<?php echo $quantity;?>"class="form-control" pattern="\d{1,5}" title="Solo dígitos" required>
      </div>

      <div class="form-group">
          <label for="quantity"> * Premios:</label>
          <input type="text" name="prize"  style="width:800px;"  value="<?php echo $prize;?>" class="form-control" required>
      </div>


      <!--Se crea un dropdown para elegir el tipo de torneo.-->
      <div class="form-group">
        <div class="col-xs-3">
          <label for="type">Tipo de Torneo: </label>
          <select name="type" class="form-control">
            <label for="type">Tipo de torneo: </label>
            <option value="Rapid" <?php if($row["type"]=='Rapid') echo "selected";?>>Rapid</option>
            <option value="Blitz" <?php if($row["type"]=='Blitz') echo "selected";?>>Blitz</option>
            <option value="Clásico" <?php if($row["type"]=='Clásico') echo "selected";?>>Clásico</option>
            <option value="Simultaneas" <?php if($row["type"]=='Simultaneas') echo "selected";?>>Simultaneas</option>
          </select>
          <br>
        </div>


        <!--Se crea un dropdown para elegir si es por rating FIDE.-->
        <div class="form-group">
          <div class="col-xs-5">
            <label for="rating">¿Cuenta para rating FIDE?: </label>
            <select name="rating" class="form-control">
              <option value="Sí"<?php if($row["rating"]=='Sí') echo "selected";?>>Sí</option>
              <option value="No"<?php if($row["rating"]=='No') echo "selected";?>>No</option>
            </select>
            <br>
          </div>
          </select>
        </div>
      </div>

<br>

   <input type="hidden" name="goback" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <!--Se construye el botón de "Editar torneo".-->
<input type="submit" name="submit"  class="btn btn-success btn-block" value="Editar torneo">
  <!--Se construye el botón de "Atrás".-->
<a  class="btn btn-primary btn-block" href="<?= $previous ?>">Atrás</a
</label></td>

</form>
</div>
</div>
</div>
</body>
</html>

<?php include 'modules/footer.php';?>

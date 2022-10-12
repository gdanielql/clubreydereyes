<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito añadir una publicación al apartado de "Conócenos". De igual manera, tiene la opción de editar o eliminar
          una publicación.
*/
//Se conecta a la base de datos.
include 'config1.php';

//Acción que permite volver una página atrás.
  $previous = "javascript:window.history.go(-2)";
  if(isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
}
?>

	<!--Se construye el header de la página-->
	<div class="container">
	  <div class="row">
	    <div class="col-md-12 col-lg-12">
	      <h1 class="page-header">Conócenos</h1>
	      <p> En este apartado usted puede publicar cualquier información sobre los distintos clubes para
	        mostrar al público</p>
          <?php

          //Una vez se oprima el botón de guardar, se procede a guardar la información en las distintas variables de la base de datos e insertarlas.
          if(isset($_POST['registerabout']) && !empty($_POST['title'])){

              $title = $_POST['title'];
              $message = $_POST['message'];

              //Query: Guarda la publicación en la base de datos en la tabla de "about".
              $query = "INSERT INTO about(`heading`, `message`) VALUES('".$title."','".$message."')";
              mysqli_query($db, $query);

              if($db==true)
              echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>¡Hecho!</strong> Publicado con éxito!.
                </div>';
            }
          $db->close();
          ?>
	    </div>
	  </div>

	  <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
	    <div class="form-group">
	      <!--Se construye el text box del título-->
	      <label for="title"> Título: </label>
	      <input type="text" name="title" class="form-control" required>

	    </div>

	    <div class="form-group">
	      <!--Se construye el text box del mensaje-->
	      <label for="message"> Mensaje: </label>
	      <textarea class="form-control" rows="15" name="message"></textarea>
	    </div>

	    </select>
	    <!--Se construye el botón de "Guardar"-->
	    <input type="submit" name="registerabout" class="btn btn-success btn-block" value="Guardar">
	    <!--Se construye el botón de "Atrás".-->
	    <a class="btn btn-primary btn-block" href="index.php?page=about">Atrás</a>
	</div>
	<br>
	</div>
	</form>
<?php include 'modules/footer.php';?>

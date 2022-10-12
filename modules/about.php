
<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página se le muestra al director el apartado de "Conócenos" con las
            distintas publicaciones realizadas. También tendrá la opción de editar o eliminar.
*/

//Conectar a la base de datos.
include 'config1.php';
?>


<!--Se construye el contenedor donde estará la información provista-->
<div class="container">
  <div class="row">
    <!--Se construye el encabezado de la página-->
    <div class="container p-3 my-3 bg-dark text-white">
      <h1 class="page-header">Conócenos</h1>
    </div>

    <?php

    if (isset($_GET['id']))
    {
    //Query: Con el ID recibido borra la publicación seleccionada.
    $result = mysqli_query($db,"DELETE FROM about WHERE about_id=".$_GET['id']);
    if($result==true)
    echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>¡Hecho!</strong> Publicación eliminada con éxito!.
      </div>';
    }

    ?>

  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12">

      <!--Se crea el botón para escribir en el apartado de "Conócenos"-->
      <form action="index.php?page=registerabout">
        <button type="submit" name="page" value="registerabout" class="btn btn-primary pull-right"> <i class="fa fa-fw fa-pencil"></i> Publicar</button>
      </form>
    </div>
  </div>
  <!--Se crea el cuerpo en donde contendrá la información-->
  <div class="card">
    <div class="card-body">
						<?php
                  // Query: Buscará en la tabla de about la información a ser desplegada
									 $sql = "SELECT * FROM about";
									 $result = $db->query($sql);

                   //Se iniciliza el contador y se recorre las distintas filas dentro de la base de datos.
							     $count=0;
									 if ($result -> num_rows >  0) {

										 while ($row = $result->fetch_assoc())
						       {
								             $count=$count+1;
											 ?>
                       <!--Para cada título y mensaje se le añadirá la opción de editar o eliminar-->
													<h3 class="card-title"><?php echo $row["heading"] ?></h3>

													<p class="card-text"><?php echo $row["message"]  ?></p>

                          <th> <a href="up"Edit></a><a  class="btn btn-primary" href="index.php?page=edit_about&id=<?php echo $row["about_id"] ?>"><i class="fa fa-fw fa-pencil"></i>Editar</a>
                             <a href="up"Edit></a><a  class="btn btn-primary" onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=about&id=<?php echo $row["about_id"] ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>
								<?php

										 }
									 }

								?>

				</div>
			</div>
    </div>
  </div>
      <script>

      function confirmationDelete(anchor)
      {
         var conf = confirm('Se eliminará una publicación. Presione "OK" para confirmar');
         if(conf)
            window.location=anchor.attr("href");
      }


      </script>

      <?php include 'modules/footer.php';?>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito realizar publicaciones al apartado del "Rincón Ajedrecístico". Aquí podrá
          escribir artículos, biografía o cualquier otra información relevante al mundo del ajdrez.
*/
//Se conecta a la base de datos.
include 'config1.php';
?>
<!--Se construye el header de la página-->
<div class="container">
  <div class="row">
    <div class="container p-3 my-3 bg-dark text-white">
      <h1 class="page-header">Rincón Ajedrecístico</h1>
    </div>

    <?php

    if (isset($_GET['id']))
    {
    //Query: Con el ID recibido borra la publicación seleccionada.
    $result = mysqli_query($db,"DELETE FROM post WHERE post_id=".$_GET['id']);
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

      <!--Se construye el botón de "Publicar Rincón Ajedrecístico"-->
      <form action="index.php?page=registerpost">
        <button type="submit" name="page" value="registerpost" class="btn btn-primary pull-right"><i class="fa fa-fw fa-pencil"></i> Publicar</button>
      </form>


    </div>
  </div>

  <div class="card">
    <div class="card-body">
						<?php
              //Query: Muestra las publicaciones guardadas en la base de datos.
									 $sql = "SELECT * FROM post";
									 $result = $db->query($sql);
							     $count=0;
									 if ($result -> num_rows >  0) {

                  //Se recorre toda la lista para obtener las distintas publicaciones
										 while ($row = $result->fetch_assoc())
						 {
            								$count=$count+1;
											 ?>
                        	<!--Se construye el textbox del heading.-->
													<h3 class="card-title"><?php echo $row["heading"] ?></h3>

                          	<!--Se construye el textbox para publicar.-->
													<p class="card-text"><?php echo $row["post"]  ?></p>

	                         <!--Para cada publicación tendrá la opción de editar o eliminar-->
                          <th> <a href="up"Edit></a><a class="btn btn-primary" href="index.php?page=edit_post&id=<?php echo $row["post_id"] ?>"><i class="fa fa-fw fa-pencil"></i>Editar</a>
                             <a href="up"Edit></a><a  class="btn btn-primary" onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=post&id=<?php echo $row["post_id"] ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>

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

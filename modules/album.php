  <?php
  //Conectar a la base de datos.
  include 'config1.php';
  ?>


  <!-- Contenido de la página-->
<div class="container">
  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0 text-white">Galería de fotos del Club de Ajedrez Rey de Reyes</h1>
  <hr class="mt-2 mb-5">
  <p> Para añadir alguna imagen al nuevo al album asegúrese de escribir nombre o descripción. El formato debe ser imagen PNG o JPG.</p><br><br>

  <div class="row text-center text-lg-left">
    <div class="row">
      <?php

      if (isset($_GET['id']))
      {

      //Query: Con el ID recibido borra la donación seleccionada.
      $result = mysqli_query($db,"DELETE FROM album WHERE id=".$_GET['id']);

      }

      //Redirige la página a "Donaciones"
      header( "refresh:2;url=http://localhost:8080/member/index.php?page=album" );

      ?>

      <?php
      //Se crean las variables sobre los archivos y variables temporeras
      if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
      {

      $fileName = $_FILES['userfile']['name'];
      $tmpName  = $_FILES['userfile']['tmp_name'];
      $fileSize = $_FILES['userfile']['size'];
      $fileType = $_FILES['userfile']['type'];
      $fp      = fopen($tmpName, 'r');
      $content = fread($fp, filesize($tmpName));

      // addslashes() - Escapa un string con barras invertidas
      $content = addslashes($content);
      $title = $_POST['title'];
      fclose($fp);

      //Devuelve el valor actual del parámetro de configuración magic_quotes_gpc
      if(!get_magic_quotes_gpc())

      {
      // addslashes() - Escapa un string con barras invertidas
      $fileName = addslashes($fileName);

      }

      //Query: Se inserta el archivo en la base de datos en la tabla de "files" con su nombre, tamaño, tipo, contenido y su categoría
      $query = "INSERT INTO album (name, size, type, content, title) "." VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$title' )";
      //En caso de que falle el query,  lo indica con un mensaje,
      mysqli_query($db,$query) or die('Error, query failed');
      //Se desplega mensaje de éxito
      echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>¡Hecho!</strong> Imagen subida con éxito!.
        </div>';

      }
      ?>




  <?php
  //Query: Muestra todas las imágenes que estén en la tabla de "album" en la base de datos y ejecuta el query.
  $sql = "SELECT * FROM album";
  $result = $db->query($sql);

  //Recorre las distintas filas de la tabla "album"
  while ($row = $result->fetch_assoc())
  {
  echo '<div class="col-xs-4 col-md-4 col-sm-4">'. '<a href="up"Delete></a><a  class="btn btn-danger"  href="index.php?page=album&id='. $row['id'].'">Borrar</a></th>';
  echo '<p>'.$row['title'];
  echo '<img class="img-fluid img-thumbnail" style="width:350px; height:250px;" src="data:image/jpeg;base64,'.base64_encode( $row['content'] ).'"/>'.'</p></div>';
  }
  ?>
  </div>
  </div>
  </div>
  </hr>

  <br>

  <!-- Se posicionan los botones-->
  <form method="post" enctype="multipart/form-data">

    <td width="246">
      <!--Se construye el botón para seleccionar el archivo dentro de la computadora-->
      <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
      </div>
      <div class="form-group">
        <input id="userfile" type="file" name="userfile" />
    </td>
    </div>

    <div class="form-group">
      <!--Se construye el text box del título-->
      <label for="title"> Título: </label>
      <input type="text" name="title" class="form-control" required>

    </div>
    <!--Se construye el botón para subir el archivo a la base de datos-->
    <div class="form-group">
      <td width="80"><input id="upload" type="submit" class="btn btn-success btn-block" name="upload" value=" Subir imagen " /></td>
      <!--Se construye el botón de "Atrás".-->
     <a class="btn btn-info btn-block" href="index.php?page=dashboard">Atrás</a>
    </div>

  </form>
  </tr>
  </div>


    <?php include 'modules/footer.php';?>

    <script>

    function confirmationDelete(anchor)
    {
       var conf = confirm('Se eliminará un producto. Presione "OK" para confirmar');
       if(conf)
          window.location=anchor.attr("href");
    }

     </script>

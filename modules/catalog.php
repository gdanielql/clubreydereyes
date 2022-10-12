<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página se le muestra al director el apartado de "Inventario en la opción de "Ver el catálogo".
          Muestra imágenes de los diferentes productos y tiene la opción de subir imagen con título.
*/

//Conectar a la base de datos.
include 'config1.php';


?>

<div style="position:relative; height:150px;">
  <img src="images/inventory.png" style="position:absolute; top:-100px; right:450px; width:250px; height:250px; border:none;" alt="Inventario" title="Inventario" />
</div>
<!-- Page Content -->
<div class="container">
  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0 text-white">Catálogo de los productos</h1>
  <hr class="mt-2 mb-5">
  <p> Para añadir algún producto nuevo al catálogo asegúrese de escribir nombre o descripción. El formato debe ser imagen PNG o JPG.
    <br><br>
  <div class="row text-center text-lg-left">
    <div class="row">

      <?php

      //Método para eliminar una imagen
      if (isset($_GET['id']))
      {

      //Query: Con el ID recibido borra la donación seleccionada.
      $result = mysqli_query($db,"DELETE FROM catalog WHERE id=".$_GET['id']);

      }

      //Se crean las variables sobre los archivos y variables temporeras para añadir una imagen
      if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
      {

      $fileName = $_FILES['userfile']['name'];

      $tmpName  = $_FILES['userfile']['tmp_name'];

      $fileSize = $_FILES['userfile']['size'];

      $fileType = $_FILES['userfile']['type'];

      $fp      = fopen($tmpName, 'r');

      $content = fread($fp, filesize($tmpName));

      $content = addslashes($content);

      $title = $_POST['title'];

      fclose($fp);

      if(!get_magic_quotes_gpc())

      {

      $fileName = addslashes($fileName);

      }


    //Query: Se inserta el archivo en la base de datos en la tabla de "files" con su nombre, tamaño, tipo, contenido y su categoría
      $query = "INSERT INTO catalog (name, size, type, content, title) "." VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$title' )";

      mysqli_query($db,$query) or die('Error, query failed');
      if($query==true){
      echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>¡Hecho!</strong> Imagen subida con éxito!.
        </div>';
        }
      }

      ?>



<?php

//Se conecta a la base de datos
include 'config1.php';
//Query: Muestra todas las imágenes en la tabla de catálogo
$sql = "SELECT * FROM catalog";
$result = $db->query($sql);



//Recorre toda la lista para obtener todas las imágenes y desplegar la opción de eliminar.
while ($row = $result->fetch_assoc())
{
echo '<div class="col-xs-4 col-md-4 col-sm-4">'. '<a href="up"Delete></a><a  class="btn btn-danger" href="index.php?page=catalog&id='. $row['id'].'">Borrar</a></th>';
echo '<p>'.$row['title'];
echo '<img class="img-fluid img-thumbnail" style="width:350px; height:250px;" src="data:image/jpeg;base64,'.base64_encode( $row['content'] ).'"/>'.'</p></div>';

}
?>

</div>
</div>
</div>
</hr>

<br>

<!-- /.container -->
<form method="post" enctype="multipart/form-data">
  <table width="350" border="0" cellspacing="1" cellpadding="1">
    <tbody>
      <tr>
        <td width="246">
          <!--Se construye el botón para seleccionar el archivo dentro de la computadora-->
          <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
          </div>
          <div class="form-group">
            <input id="userfile" type="file" name="userfile" />
        </td>
        </div>
        <!--Se construye el botón para subir el archivo a la base de datos-->
        <div class="form-group">
          <td width="80"><input id="upload" type="submit" name="upload" class="btn btn-success" value=" Subir imagen " /></td>
        </div>

        <div class="form-group">
          <!--Se construye el text box del título-->
          <label for="title"> Nombre o descripción del producto: </label>
          <input type="text" name="title" class="form-control" required>

        </div>
        </div>
        </div>
</form>
</table>
</tbody>
</tr>

<!--Se construye el botón de "Atrás".-->
<a class="btn btn-info btn-block" href="index.php?page=inventorylist">Atrás</a>


</div>
<?php include 'modules/footer.php';?>

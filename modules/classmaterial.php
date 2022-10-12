<?php

/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página se le muestra al director el apartado de "Materiales de clases" los diferentes archivos en el formato PDF
          para ser descargados. También, incluye la opción de poder subir al sistema su archivo de su computador a la base de datos.
          De igual manera, debe elegir una categoría para así distinguir los archivos.
*/

//Conecta a la base de datos.
    include 'config1.php';
?>

<!--Se coloca imagen de centro-->
<div style="position:relative; height:60px;">
  <img src="images/class.jpg" class="img-rounded" style="position:absolute; top:-120px; right:470px; width:220px; height:220px; border:none;" alt="Archivos" title="Archivos" />
</div>
<br>

<!--Se construye el header-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <center>
        <h1 class="page-header"></i>Documentos para Clases</h1>
      </center>
    </div>
  </div>
</div>

  <?php
  //Se crean las variables sobre los archivos y variables temporeras para ser insertados en la base de datos
  if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
      $fileName = $_FILES['userfile']['name'];

      $tmpName  = $_FILES['userfile']['tmp_name'];

      $fileSize = $_FILES['userfile']['size'];

      $fileType = $_FILES['userfile']['type'];

      $fp      = fopen($tmpName, 'r');

      $content = fread($fp, filesize($tmpName));

      $content = addslashes($content);

      fclose($fp);

      if (!get_magic_quotes_gpc()) {
          $fileName = addslashes($fileName);

      }

      $category = $_POST['category'];

      //Query: Se inserta el archivo en la base de datos en la tabla de "files" con su nombre, tamaño, tipo, contenido y su categoría
      $query = "INSERT INTO files (name, size, type, content, category) "." VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$category' )";

      mysqli_query($db, $query) or die('Error, query failed');

      echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>¡Hecho!</strong> Archivo subido con éxito!.
    </div>';
  }
  ?>

<!--Se construye la tabla en donde se mostrán los archivos para ser descargados-->
<div class=" col-xs-offset-1 col-xs-6">
  <div class="panel panel-primary " style="width: 900px;">
    <div class="panel-heading">
      <h3 class="panel-title">Material de Curso</h3>
    </div>

    <?php

    if (isset($_GET['id']))
    {
    //Query: Con el ID recibido borra el archivo seleccionado.
    $result = mysqli_query($db,"DELETE FROM files WHERE id=".$_GET['id']);

    }

    ?>
    <div class="panel-body">
      <table id="myTable" class="table table-dark table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Opción</th>
      </tr>
    </thead>
    <tbody>

    <div class="row">
      <div class="col-md-12 col-lg-12">
  			<h3><i class="fa fa-fw fa-file"></i> Descargar Archivos</h3>
				<p>Presione encima del documento que desee descargar.
  		</div>
  	</div>
  <br>
  <?php

  $conn=mysqli_connect("localhost", "root", "root", "mattendance");


  //Query: Se muestran los archivos para ser descargados
  $query = "SELECT * FROM files";

  $result = mysqli_query($db, $query) or die('Error, query failed');

  if (mysqli_num_rows($result) == 0) {
      echo "Database is empty";
  } else {
      $count=0;
      while (list($id, $name, $category) = mysqli_fetch_array($result)) {
          $count=$count+1; ?>
<tr>
  <td><?php echo $count ?></td>

<!--Se redirige a  "download2.php" para descargar el archivo-->
  <td><a href="modules/download2.php?id=<?php echo $id; ?>"><?php echo $name; ?></a></td>
  	<td><?php echo $category ?></td>

    <th><button href="up"Edit></a><a onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=classmaterial&id=<?php echo $id ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>



  <?php
      }
  }

  ?>



</div>
</div>
</tbody>
</table>

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
            <input id="userfile" type="file" name="userfile" value="Hola" />
        </td>
        </div>
        <!--Se construye el botón para subir el archivo a la base de datos-->
        <div class="form-group">
          <td width="80"><input id="upload" class="btn btn-success" type="submit" name="upload" value=" Subir archivo " /></td>
        </div>
      </tr>

      <div class="form-group">
        <!--Se construye un dropdown con las opciones para la categoría-->
        <label for="category">Elija una Categoría: </label>
        <select name="category" class="form-control">
          <label for="club">Elija un Club: </label>
          <option value="Básico" selected>Básico</option>
          <option value="Intermedio">Intermedio</option>
          <option value="Avanzado">Avanzado</option>
        </select>
        <br>
      </div>
      <h3><i class="fa fa-fw fa-upload"></i> Subir Archivos</h3>
      <p>Seleccione el archivo que desee subir desde su computadora.</p>
      <br>


      </div>
  </table>
  </tbody>
  </div>
  </div>
  </div>
  </div>
  </div>
<?php include 'modules/footer.php';?>
</body>
</html>
	<!--Ejecuta la biblioteca de "dataTable" para asignar features a las tablas-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css"></style>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
	<script>

	function confirmationDelete(anchor)
	{
	   var conf = confirm('Se eliminará un documento. Presione "OK" para confirmar');
	   if(conf)
	      window.location=anchor.attr("href");
	}
	$(document).ready(function(){
	    $('#myTable').dataTable(
			{
				 "info":     false
			});
	});

	 </script>

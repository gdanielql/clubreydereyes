<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar los archivos que se relacionan a los materiales de clases
          para poder ser descargados. De igual forma, poder subir archivos elegidos de su propia computadora en categorías
          para facilitar su búsqueda.
*/
//Se conecta a la base de datos.
include 'config1.php';
?>

<div style="position:relative; height:60px;">
  <img src="images/admin.png" class="img-rounded" style="position:absolute; top:-120px; right:470px; width:220px; height:220px; border:none;" alt="Archivos" title="Archivos" />
</div>
<br>

<!--Se construye el header-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
      <center>
        <h1 class="page-header">Archivos Administrativos</h1>
      </center>
    </div>
  </div>
</div>

  <?php
  //Una vez se oprima el botón de "Subir Archivo" se procede a guardar en la base de datos.
  //Antes de guardar se crean unas variables temporeras.
  if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
  {

  $fileName = $_FILES['userfile']['name'];

  $tmpName  = $_FILES['userfile']['tmp_name'];

  $fileSize = $_FILES['userfile']['size'];

  $fileType = $_FILES['userfile']['type'];

  $fp      = fopen($tmpName, 'r');

  $content = fread($fp, filesize($tmpName));

  $content = addslashes($content);

  fclose($fp);

  if(!get_magic_quotes_gpc())

  {

  $fileName = addslashes($fileName);

  $category = $_POST['category'];

  }
//Query: Guarda el archivo en la tabla de "files_manual" en la base de datos.
  $query = "INSERT INTO files_manual (name, size, type, content, category) "." VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$category' )";

  mysqli_query($db,$query) or die('Error, query failed');

  echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>¡Hecho!</strong> Archivo subido con éxito!.
    </div>';

  }
  ?>

<!--Se construye el heading de la tabla de Archivos administrativos.-->
<div class=" col-xs-offset-1 col-xs-6">
  <div class="panel panel-primary " style="width: 900px;">
    <div class="panel-heading">
      <h3 class="panel-title">Documentos Administrativos</h3>
    </div>

    <?php

    if (isset($_GET['id']))
    {

    //Query: Con el ID recibido borra el archivo seleccionado.
    $result = mysqli_query($db,"DELETE FROM files_manual WHERE id=".$_GET['id']);

    }

    ?>

    <!--Se construye la tabla en donde mostrará los archivos para ser descargados o eliminados.-->
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
  			<h3><i class="fa fa-fw fa-file"></i>Descargar documentos</h3>
        <p>Presione encima del documento que desee descargar.
  		</div>
  	</div>
  <br>
  <?php
  //Query: Muestra los archivos que contiene la base de datos.
  $query = "SELECT * FROM files_manual";

  $result = mysqli_query($db,$query) or die('Error, query failed');

  if(mysqli_num_rows($result) == 0)

  {

  echo "Database is empty";

  }

  else

  {
    $count=0;
  while(list($id, $name, $category) = mysqli_fetch_array($result))

  {


    $count=$count+1;

  ?>
<tr>
  <td><?php echo $count ?></td>
  <!--Una vez se seleccione un archivo se procederá a descargar por lo que se redirige a la página de "download.php" para realizar esta acción.-->
  <td><a href="modules/download.php?id=<?php echo $id;?>"><?php echo $name; ?></a></td>
  	<td><?php echo $category ?></td>

    <!--Para cada archivo se tendrá la opción de borrar..-->
    <th><button href="up"Edit></a><a onclick='javascript:confirmationDelete($(this));return false;' href="index.php?page=manual&id=<?php echo $id ?>"><i class="fa fa-fw fa-trash"></i>Borrar</a></th>

  <?php

  }

  }

  ?>

</div>
</div>
</tbody>
</table>

<!--Se construye los botones de "Seleccionar archivo" y "Subir archivo".-->

  <form method="post" enctype="multipart/form-data">
  <table width="350" border="0" cellspacing="1" cellpadding="1">
  <tbody>
  <tr>
  <td width="246">

  <div class="form-group">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
  </div>
  <div class="form-group">
  <input id="userfile" type="file" name="userfile" /></td>
  </div>
  <div class="form-group">
  <td width="80"><input id="upload" class="btn btn-success" type="submit" name="upload" value=" Subir archivo " /></td>
  </div>
  </tr>

	<!-- Dropdown para elegir la categoría-->
  <div class="form-group">
  		<label for="category">Elija una Categoría: </label>
      <select name = "category" class="form-control">
  					<label for="club">Categoría </label>
  					 <option value = "Manual" selected>Manual</option>
  					 <option value = "Reglas">Reglas</option>
  					 <option value = "Reportes">Reportes</option>
             <option value = "Reportes">Certificación</option>
  				</select>
  				<br>
      <h3><i class="fa fa-fw fa-upload"></i>Subir Archivos</h3>
      <p>Seleccione el archivo que desee subir desde su computadora.</p>

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

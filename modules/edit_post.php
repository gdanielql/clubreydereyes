<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito editar las publicaciones en el apartado de "Rincón Ajedrecístico".
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

if (isset($_POST['submit']))
{
$id=$_POST['id'];
$heading=mysqli_real_escape_string($db, $_POST['heading']);
$post=mysqli_real_escape_string($db, $_POST['post']);

//Query: Permite actualizar la información de las donaciones con el ID correspondiente.
mysqli_query($db,"UPDATE post SET heading='$heading', post='$post'  WHERE post_id ='$id'");

}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM post WHERE post_id=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['post_id'];
$heading = $row['heading'];
$post = $row['post'];

}
else
{
echo "No results!";
}
}
?>

<?php
   if(isset($_POST['submit']))
   {
     //Redirige al usuario una vez se hagan los cambios a la página de "Rincón Ajedrecístico".
    header('Location: http://localhost:8080/member/index.php?page=post');
   }
?>

<html>
<head>
<title>Editar Publicación</title>
</head>
<body>

<form action="" method="post" action="edit_post.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<!--Se construye el header.-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">

			<h1 class="page-header">Editar publicación</h1>
      <p> Por favor actualice toda la información. Los campos marcados con * son obligatorios.</p>
		</div>
	</div>

<!--Se construye el text box del título.-->
<div class="panel-body">
<label for="title"> Título: </label>
<input type="text"  class="form-control" name="heading" value="<?php echo $heading; ?>" />
</label>
<!--Se construye el text box del mensaje.-->
<label for="title"> Mensaje: </label>
<textarea class="form-control" rows="15" name="post"><?php echo $post; ?></textarea>


<br>
<label>

</div>
</div>
</div>
   <input type="hidden" name="goback" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
     <!--Se construye el botón de "Editar publicación".-->
<input type="submit" class="btn btn-success btn-block" name="submit" value="Editar Publicación">
  <!--Se construye el botón de "Atrás".-->
<a  class="btn btn-primary btn-block" href="<?= $previous ?>">Atrás</a></div>

</form>
</label>
</body>
</html>
<?php include 'modules/footer.php';?>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito editar las publicaciones en el apartado de "Conócenos".
*/

//Se conecta a la base de datos.
include 'config1.php';

//Acción que permite volver una página atrás.
$previous = "javascript:window.history.go(-2)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>
<?php

if (isset($_POST['submit'])) {
    $id      = $_POST['id'];
    $heading = mysqli_real_escape_string($db, $_POST['heading']);
    $message = mysqli_real_escape_string($db, $_POST['message']);

    //Query: Permite actualizar la información con el ID correspondiente.
    mysqli_query($db, "UPDATE about SET heading='$heading', message='$message'  WHERE about_id ='$id'");

}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id     = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM about WHERE about_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id      = $row['about_id'];
        $heading = $row['heading'];
        $message = $row['message'];

    } else {
        echo "No results!";
    }
}
?>

<?php
if (isset($_POST['submit'])) {
    //Redirige al usuario una vez se hagan los cambios a la página de "Conócenos"
    header('Location: http://localhost:8080/member/index.php?page=about');
}
?>

<html>

<head>
  <title>Editar Publicación</title>
</head>

<body>
  <form action="" method="post" action="edit_post.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <!--Se construye el header.-->
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <h1 class="page-header">Editar publicación</h1>
          <p> Por favor actualice toda la información. Los campos marcados con * son obligatorios.</p>
        </div>
      </div>

      <!--Se construye el textbox del título-->
      <div class="panel-body">
        <label for="title"> Título: </label>
        <input type="text" class="form-control" name="heading" value="<?php echo $heading; ?>" />
        </label>

        <!--Se construye el textbox del mensaje-->
        <label for="title"> Mensaje: </label>
        <textarea class="form-control" rows="15" name="message"><?php echo $message; ?></textarea>


        <br>
        <label>
  </form>

  </div>


  <input type="hidden" name="goback" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <!--Se construye el botón de "Editar publicación".-->
  <input type="submit" class="btn btn-success btn-block" name="submit" onclick="modules/edit_about.php" value="Editar Publicación">
  <!--Se construye el botón de "Atrás".-->
  <a class="btn btn-primary btn-block" href="<?= $previous ?>">Atrás</a></div>
  </label>

</html>

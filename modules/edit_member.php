<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito editar los miembros en las tabla del apartado.
*/

include 'config1.php';


//Acción que permite volver una página atrás.
    $previous = "javascript:window.history.go(-2)";
    if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>
<?php


if (isset($_POST['submit'])) {
    $id        = $_POST['id'];
    $name      = mysqli_real_escape_string($db, $_POST['name']);
    $email     = mysqli_real_escape_string($db, $_POST['email']);
    $rating    = mysqli_real_escape_string($db, $_POST['rating']);
    $cellphone = mysqli_real_escape_string($db, $_POST['cellphone']);
    $address   = mysqli_real_escape_string($db, $_POST['address']);

    //Query: Permite actualizar la información de las donaciones con el ID correspondiente.
    mysqli_query($db, "UPDATE member SET name='$name', email='$email', rating='$rating', cellphone='$cellphone',
  address='$address'  WHERE sid='$id'");

}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id     = $_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM member WHERE sid=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id        = $row['sid'];
        $name      = $row['name'];
        $email     = $row['email'];
        $rating    = $row['rating'];
        $cellphone = $row['cellphone'];
        $address   = $row['address'];

    } else {
        echo "No results!";
    }
}
?>

<?php
   if(isset($_POST['submit']))
   {
    //Redirige al usuario una vez se hagan los cambios a la página de "Miembros"
    header('Location: http://localhost:8080/member/index.php?page=memberinfo');
   }
?>
<html>

<head>
  <title>Edit Member</title>
</head>

<body>

  <div style="position:relative; height:60px;">
  <img src="images/register.png" class="img-rounded"
     style="position:absolute; top:-100px; right:450px; width:200px; height:200px; border:none;"
     alt="Member"
     title="Member" />
  </div>

  </style>

  <form action="" method="post" action="edit_member.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <!--Se construye el header.-->
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <!--Se construye el form en donde se pretende editar la información que así lo entienda necesario el usuario.-->
          <h1 class="page-header">Editar un miembro</h1>
          <p> Por favor llene toda la información. Los campos marcados con * son obligatorios.</p>
          <br>
        </div>
      </div>
      <div class="panel panel-default" style="width:830px;">
      <div class="panel-heading">
        <h3 class="panel-title">Registro</h3>
      </div>
      <div class="panel-body">

        <div class="form-group">
          <label for="email"> * Nombre: </label>
          <input type="text" name="name" class="form-control" value="<?php echo $name;?>" style="width:800px;" placeholder="Nombre completo"
            required>
        </div>

        <div class="form-group">
          <label for="email"> * Email: </label>
          <input type="email" name="email" class="form-control" value="<?php echo $email;?>" style="width:800px;" placeholder="email@gmail.com" required>
        </div>
        <div class="form-group">
          <label for="rating"> * Rating: </label>
          <input type="int" name="rating" class="form-control" value="<?php echo $rating;?>" style="width:800px;" pattern="\d{1,5}" title="Solo dígitos" placeholder="####" required>
        </div>
        <div class="form-group">
          <label for="cellphone"> * Teléfono: </label>
          <input type="text" name="cellphone" class="form-control" value="<?php echo $cellphone;?>" style="width:800px;" pattern="^\d{3}-\d{3}-\d{4}$" title="Favor introducir en el formato correcto ###-###-####" placeholder="###-###-####" required>
        </div>

        <div class="form-group">
          <label for="address"> * Dirección: </label>
          <input type="text" name="address" value="<?php echo $address;?>" style="width:800px;" class="form-control" placeholder="" required>
        </div>

        <div>

        </div>


  <input type="hidden" name="goback" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <!--Se construye el botón de "Editar miembro".-->
  <input type="submit" name="submit" class="btn btn-success btn-block" onclick="modules/edit_member.php" value="Editar miembro">
  <!--Se construye el botón de "Atrás".-->
  <a class="btn btn-primary btn-block" href="<?= $previous ?>">Atrás</a>
  </form>
  </div>
</div>
</div>
</div>
</body>

</html>
<?php include 'modules/footer.php';?>

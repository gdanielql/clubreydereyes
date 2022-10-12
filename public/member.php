<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar un formulario en donde el director llene toda la información necesaria
          para poder registrar a un miembro. También, tendrá la opción de poder establecer si ese miembro desea ser registrado
          en una o más actividades y en otros clubes.
*/

//Se conecta a la base de datos.
include 'config1.php';

//Se fijan los valores en las variables que representan las clases en los distintos clubes.
$value_trujillo_class = 3;
$value_aibonito_class = 5;
$value_florida_class = 7;
$value_arecibo_class = 8;

//Se fijan los valores en las variables que representan las reuniones sociales en los distintos clubes.
$value_trujillo_reunion = 1;
$value_aibonito_reunion = 4;
$value_arecibo_reunion = 9;
$value_florida_reunion = 6;

//Se fijan los valores en las variables que representan los torneos.
$value_tourney = 2;
$value_tourney2 = 10;
$value_tourney3 = 11;


?>

<?php include 'nav.php';?>
<html>
<br><br>

<div class="container">
   <div class="row">
       <div class="col-4">
           <img class="mx-auto d-block" style = "width:1100px; height:500px;" src="../images/register.jpg">
       </div>
   </div>
</div>
<!--Se construye el header de la página.-->
<div class="container">
  <div class="row">
    <div class="container p-3 my-3 bg-dark text-white">
      <center>
        <h1 class="page-header">Regístrate en los Clubes de Ajedrez Rey de Reyes</h1>
        <center>
    </div>
  </div>
</div>

<div class="container text-white">
  <!--Se construye el form que le solicita al usuario toda la información para registrar un miembro..-->
  <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
    <div class="form-group">
      <label for="email"> * Nombre: </label>
      <input type="text" name="name" class="form-control" style="width:800px;" placeholder="Nombre completo" pattern="^([Á-Za-z]+[,.]?[ ]?|[Á-Za-z]+['-]?)+$" title="No introduzca números o caracteres especiales " required>
    </div>

    <div class="form-group">
      <label for="email"> * Email: </label>
      <input type="email" name="email" class="form-control" style="width:800px;" placeholder="email@gmail.com">
    </div>
    <div class="form-group">
      <label for="rating"> * Rating: </label>
      <input type="int" name="rating" class="form-control" style="width:800px;" pattern="\d{1,5}" title="Solo dígitos" placeholder="####" required>
    </div>
    <div class="form-group">
      <label for="cellphone"> * Teléfono: </label>
      <input type="text" name="cellphone" class="form-control" style="width:800px;" pattern="^\d{3}-\d{3}-\d{4}$" title="Favor introducir en el formato correcto ###-###-####" placeholder="###-###-####" required>
    </div>

    <div class="form-group">
      <label for="address"> * Dirección: </label>
      <input type="text" name="address" style="width:800px;" class="form-control" placeholder="" required>
    </div>


    </select>
</div>
</div>
<br>

<div class="container text-white">
  <h2 class="page-header">Clases de Ajedrez </h2>
  <p> Elige las actividades y el club en donde desea ser registrado. </p>
  <div class="form-group">

    <p>Club:</p>
    <input type="radio" id="classt" name="class" value="classt">
    <label for="classt">Trujillo Alto</label><br>
    <input type="radio" id="classai" name="class" value="classai">
    <label for="classai">Aibonito</label><br>
    <input type="radio" id="classar" name="class" value="classar">
    <label for="classar">Arecibo</label><br>
    <input type="radio" id="classf" name="class" value="classf">
    <label for="classf">Florida</label><br>
  </div>



  <h2 class="page-header"> Reuniones Sociales</h2>
  <div class="form-group">
    <p>Club:</p>
    <input type="radio" id="reuniont" name="reunion" value="reuniont" required>
    <label for="reuniont">Trujillo Alto</label><br>
    <input type="radio" id="reunionai" name="reunion" value="reunionai">
    <label for="reunionai">Aibonito</label><br>
    <input type="radio" id="reunionar" name="reunion" value="reunionar">
    <label for="reunionar">Arecibo</label><br>
    <input type="radio" id="reunionf" name="reunion" value="reunionf">
    <label for="reunionf">Florida</label><br>
  </div>



  <h2 class="page-header">Torneos</h2>
  <p>Seleccione si desea estar pre-registrado en los torneos que se vayan a celebrar </p>
  <div class="form-group">
    <p>Club:</p>
    <input type="radio" id="tourney" name="tourney" value="tourney">
    <label for="reuniont">Rapid</label><br>
    <input type="radio" id="tourneyblitz" name="tourney" value="tourneyblitz">
    <label for="reunionai">Blitz</label><br>
    <input type="radio" id="tourneyclassic" name="tourney" value="tourneyclassic">
    <label for="reunionai">Clásico</label><br>

  </div>

  <br>


  <!--Se construye el botón de guardar.-->
  <input type="submit" name="register" class="btn btn-success btn-block" value="Guardar">
  </form>

  <!--Se crea el botón para volver atrás-->
  <button class="btn btn-primary btn-block" onclick="history.go(-1);"> Atrás </button>


</div>
</div>

<?php include 'modules/footer.php';?>
<?php
if(isset($_POST['register']) && !empty($_POST['name'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $cellphone = $_POST['cellphone'];
    $address = $_POST['address'];
    $radioVal = $_POST["class"];
    $radioSecond = $_POST["reunion"];
    $radioThird = $_POST["tourney"];

  //Query: Guarda la información del miembro en la tabla de "member" en la base de datos.
    $query = "INSERT INTO member(`name`, `email`, `rating`, `cellphone`, `address`) VALUES('".$name."', '".$email."', '".$rating."', '".$cellphone."', '".$address."')";
    if(mysqli_query($db, $query)){

      echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>¡Hecho!</strong> Miembro registrado con éxito!.
        </div>';

     $lastid = mysqli_insert_id($db);

///Para la tabla intermediaria se guardan los valores correspondientes.
     if($radioVal == "classt"){
     $query = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_trujillo_class."')";
    mysqli_query($db,$query);


}


  if($radioSecond == "reuniont"){

 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_t = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_trujillo_reunion."')";
  mysqli_query($db,$query_t);

  }
  if($radioSecond == "reunionai"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_ai = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_aibonito_reunion."')";
  mysqli_query($db,$query_ai);

  }

  if($radioSecond == "reunionar"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_ai = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_arecibo_reunion."')";
  mysqli_query($db,$query_ai);

  }

  if($radioSecond == "reunionf"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_f = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_florida_reunion."')";
  mysqli_query($db,$query_f);

  }


  if($radioVal == "classai"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_classai = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_aibonito_class."')";
  mysqli_query($db,$query_classai);

  }

  if($radioVal == "classar"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_classar = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_arecibo_class."')";
  mysqli_query($db,$query_classar);

  }

  if($radioVal == "classf"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_classf = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_florida_class."')";
  mysqli_query($db,$query_classf);

  }

  if($radioThird == "tourney"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_classf = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_tourney."')";
  mysqli_query($db,$query_classf);

  }

  if($radioThird == "tourneyblitz"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_classf = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_tourney2."')";
  mysqli_query($db,$query_classf);

  }

  if($radioThird == "tourneyclassic"){
 //Query: Guarda el último ID creado y el valor seleccionado en la tabla "member_activity".
   $query_classf = "INSERT INTO member_activity (`sid`, `id`) VALUES ('".$lastid."','".$value_tourney3."')";
  mysqli_query($db,$query_classf);

  }
}
}

<?php

/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página se le muestra al director la pantalla de inicio rápidamente que inicia sesión. Se debe mostrar el Nombre
          del director que esté loggeado en la parte superior. También debe mostrar diferentes tablas en donde muestren: Asistencias que
          deban tomar en el día, asistencias pendientes, y las distintas cosas tales como: cantidad de donaciones, torneos, miembros etc
          que hay en el club que está loggeado. De igual manera, también tiene la opción de entrar a los apartados de "Conócenos" y "Rincón Ajedrecístico".
*/

  include 'config1.php';

//Formato para las distintas fechas que serán presentadas
	$todayYMD = date("Y/m/d");
	$today = date("m/d/Y");
	$todayQuery = date("m/d/Y");
	$todayTimestamp = strtotime($today);
	$userId = $_SESSION['uid'];
?>

<?php
//Query: Muestra el nombre del usuario que esté autenticado
  $query = "SELECT name as user FROM `user` WHERE uid = $userId";

  //Despliega el query y lo ejecuta
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!--Mensaje de bienvenida-->
<?php if(!empty($result)) : ?>
  <center><h2 class="fa fa-2x fa-user"> Bienvenido, <?php print $result[0]['user'] ?></h2></center>
<?php else: ?>
  <p><i class="fa fa-truck"></i> No hay usuarios en su club!</p>
<?php endif; ?>


<!--Se construye el header con el logo y mensaje-->

<img src="images/fondito2.jpeg" style="position:center; top: 10px; right:90px; width:1170px; height:500px; border: round" alt="Club de Ajedrez Rey de Reyes" title="Club de Ajedrez Rey de Reyes" />
<br>


<br>
<!-- Header -->
<header class="bg-primary py-5 mb-5">
  <div class="container h-100">

    <div class="row h-100 align-items-center">
      <div class="col-lg-12">
        <center>
          <h1 class="display-4 text-white mt-5 mb-2">CLUB DE AJEDREZ REY DE REYES - DIRECTORES</h1>
          <center>
      </div>
    </div>
  </div>
</header>

<div class="row">
  <div class="col-md-8 mb-5">
    <h2>Bienvenido(a) a la plataforma de directores</h2>
    <hr>
    <p>Aquí podrás realizar cualquier tarea administrativa relacionada con el club. Puedes utilizar el navegador para dirigirte entre los diferentes apartados que se encuentran en el lado superior derecho.</p>
    <p>Es importante que mantengas toda la información actualizada. En caso de necesitar ayuda diríjase a la sección de ayuda ubicada en el navegador.</p>
  </div>
  <div class="col-md-4 mb-5">
    <h2> Contactos</h2>
    <hr>
    <address>
      <strong>Centro Recreativo</strong>
      <br>Urb. Villas de Caney
      <br>Trujillo Alto, Puerto Rico 00976
      <br>
    </address>
    <address>
      <abbr title="Phone">Teléfono:</abbr>
      (939) 891-0052 y/o (787)-943-3647
      <br>
      <abbr title="Email">Email:</abbr>
      <a href="mailto:#">ajedreztrujillano@gmail.com</a>
    </address>
  </div>
</div>
<!-- /.row -->
<?php
//Query: Se lleva un conteo sobre la cantidad de eventos y lo muestra
  $query = "SELECT COUNT(DISTINCT id) as event_count FROM `events`";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if(!empty($result)) : ?>
<div class=" col-xs-offset-1 col-xs-6">
<h3 class="fa fa-2x fa-home"> Dashboard | <i class="fa fa-calendar "></i><a style="color:Tomato;" href="index.php?page=calendar"><strong>  <?php print  $result[0]['event_count'] ?>  Evento(s) pendientes</a></h3></strong>
<?php else: ?>
  <p><i class="fa fa-calendar"></i> No hay eventos en su club!</p>
<?php endif; ?>

</div>

<!--Se construye el botón de Rincón Ajedrecístico-->
<form action="index.php?page=album">
  <button style="margin:5px; position:absolute; top: 1000px; right:610px;" type="submit" name="page" value="album" class="btn btn-warning pull-right"><i class="fa fa-fw fa-picture-o"></i> Álbum</button>
</form>

<!--Se construye el botón de Rincón Ajedrecístico-->
<form action="index.php?page=post">
  <button style="margin:5px; position:absolute; top: 1000px; right:410px;" type="submit" name="page" value="post" class="btn btn-success pull-right"><i class="fa fa-fw fa-pencil-square-o"></i> Rincón Ajedrecístico</button>
</form>

<!--Se construye el botón de "Conócenos"-->
<form action="index.php?page=about">
  <button style="margin:5px; position:absolute; top: 1000px; right:275px;" type="submit" name="page" value="about" class="btn btn-info pull-right"><i class="fa fa-fw fa-pencil-square-o"></i> Conócenos</button>
</form>

<!--Se crea la tabla en donde obtendrá la información de las asistencias que deban ser tomadas en ese día-->
<div class=" col-xs-offset-1 col-xs-6">
  <div class="panel panel-primary " style="width: 910px;">
    <div class="panel-heading">
      <h3 class="panel-title">Asistencia de hoy</h3>
    </div>
    <div class="panel-body">

      <img src="images/assistance.png" style="position:absolute; top: 3px; right:-300px; width:300px; height:160px; border:none;">

      <img src="images/warning.png" style="position:absolute; top: 200px; right:-280px; width:230px; height:240px; border:none;"

		<?php
    //Query: Muestra las actividades que se celebran en el club que esté autenticado con el formato de fecha correspondiente
			$query_activity = "SELECT activity.name, activity.id from activity INNER JOIN user_activity WHERE user_activity.id = activity.id AND
       user_activity.uid = {$_SESSION['uid']}  ORDER BY activity.name";
			$sub=$conn->query($query_activity);
			$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
			$today = date("d/m/Y");
			$todayQuery = date("d/m/Y");
			$todayDBQuery = strtotime(date("Y-m-d"));
			$noOfActivities = count($rsub);

			for($i = 0; $i<$noOfActivities; $i++) {
				$subId = $rsub[$i]['id'];
				$sql = "SELECT sid, ispresent FROM attendance WHERE id=$subId AND date=$todayDBQuery AND uid=$userId";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if(!empty($result)){
					print "<p><a href='index.php?subject=" . $subId . "&date=" . $todayQuery ."'>Actividad <strong>" . $rsub[$i]['name']
          ."</strong> de <strong>Hoy!</strong> (" . $today .")</a> <span class='label label-success'>Asistencia guardada</span> </p>";
				}
				else {
					print "<p><a href='index.php?subject=" . $subId . "&date=" . $todayQuery ."'>Actividad <strong>" . $rsub[$i]['name'] ."</strong> de <strong>Hoy!</strong> (" . $today .")</a> <span class='label label-warning'>¡Tome la asistencia de hoy!</span></p>";
				}
			}
		?>
  </div>
</div>

<!--Se construye la tabla de las asistencias pendientes a ser tomadas en días posteriores-->
<div class="panel panel-info " style="width: 910px;">
  <div class="panel-heading">
    <h3 class="panel-title">Asistencias pendientes</h3>
  </div>
  <div class="panel-body panel-dark">
		<?php

			for($i = 1; $i < 8; $i++) {
				$dateCurrentYMD = date('Y-m-d', strtotime($todayYMD ." -$i day"));

				$queryTimeStamp = strtotime($dateCurrentYMD);
				$dateCurrent = date('d/m/Y', $queryTimeStamp);

				$query_subjectPending = "SELECT activity.name, activity.id from activity INNER JOIN user_activity WHERE user_activity.id = activity.id AND user_activity.uid = {$_SESSION['uid']}  ORDER BY activity.name";
				$subPending=$conn->query($query_subjectPending);
				$rsubPending=$subPending->fetchAll(PDO::FETCH_ASSOC);
				$today = date("d/m/Y");
				$todayQuery = date("d/m/Y");
				$todayDBQuery = strtotime(date("Y-m-d"));
				$noOfAttendancePending = count($rsubPending);

				$weekday= strtolower(date("l", strtotime($dateCurrentYMD)));
        //Evita que se cuenten los lunes, martes, miércoles, jueves y viernes ya que en esos días no se celebran actividades en los clubes
				if(($weekday!="monday") && ($weekday!="tuesday") && ($weekday!="wednesday") && ($weekday!="thursday")) {
					for($j = 0; $j<$noOfAttendancePending; $j++) {
						$subIdP = $rsubPending[$j]['id'];
						$sqlPending = "SELECT sid, ispresent FROM attendance WHERE id=$subIdP AND date=$queryTimeStamp AND uid=$userId";
						$stmtP = $conn->prepare($sqlPending);
						$stmtP->execute();
						$resultP = $stmtP->fetchAll(PDO::FETCH_ASSOC);
						if(!empty($resultP)){
							print "<p><a href='index.php?subject=" . $subIdP . "&date=" . $dateCurrentYMD ."'>Actividad <strong>" . $rsubPending[$j]['name'] ."</strong> del <strong>" . $dateCurrent ."</strong></a> <span class='label label-success'>Asistencia guardada</span> </p>";
						}
						else {
							print "<p><a href='index.php?subject=" . $subIdP . "&date=" . $dateCurrentYMD ."'>Actividad <strong>" . $rsubPending[$j]['name'] ."</strong> del <strong>" . $dateCurrent ."</strong></a> <span class='label label-warning'>¡Marque la asistencia!</span></p>";
						}
					}

					if ($i !== 7) {
						print "<hr>";
					}
				}
			}

		?>

  </div>
</div>

<!--Se construye la tabla de información útil para el usuario-->
<div class="panel panel-primary" style="width: 910px;">
  <div class="panel-heading">
    <h3 class="panel-title">Usted tiene</h3>
  </div>
  <div class="panel-body">
    <div style="position:relative; height:30px;">
      <img src="images/info.png" style="position:absolute; top:50px; right:50px; width:200px; height:200px; border:none;" alt="Trofeo" title="Trofeo" />
    </div>
    <p><i class="fa fa-book"></i> <a href="index.php?page=memberinfo"> <strong><?php print $noOfActivities; ?></strong> Actividades </a></p>
<hr>
  	<?php
    //Query: Se lleva un conteo del total de miembros que hay en el club autenticado.
			$query = "SELECT COUNT(DISTINCT sid) as member_count FROM `user_activity` INNER JOIN member_activity WHERE user_activity.id = member_activity.id
      AND user_activity.uid = $userId";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		?>

		<?php if(!empty($result)) : ?>
			<p><i class="fa fa-users"></i> <a href="index.php?page=memberinfo"><strong><?php print $result[0]['member_count'] ?></strong> Miembros</a></p>
		<?php else: ?>
			<p><i class="fa fa-users"></i> No hay miembros en su club!</p>
		<?php endif; ?>
<hr>
    <?php
    //Query: Se lleva un conteo del total de torneos celebrados y registrados.
      $query = "SELECT COUNT(DISTINCT tid) as tourney_count FROM `tourney`";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if(!empty($result)) : ?>
      <p><i class="fa fa-trophy"></i> <a href="index.php?page=tourney"><strong><?php print $result[0]['tourney_count'] ?></strong> Torneos</a></p>
    <?php else: ?>
      <p><i class="fa fa-trophy"></i> No hay torneos en su club!</p>
    <?php endif; ?>

<hr>
    <?php
    //Query: Se suma el total en $ de donaciones
      $query = "SELECT SUM(quantity) as donation_sum FROM `donation`";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if(!empty($result)) : ?>
      <p><i class="fa fa-money"></i> $<a href="index.php?page=donation"><strong><?php print  $result[0]['donation_sum'] ?></strong> Total de Donaciones</a></p>
    <?php else: ?>
      <p><i class="fa fa-money"></i> No hay donaciones en su club!</p>
    <?php endif; ?>

<hr>

    <?php
    //Query: Se lleva un conteo sobre la cantidad de productos que hay en el inventario
      $query = "SELECT COUNT(DISTINCT product_id) as product_count FROM `product`";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if(!empty($result)) : ?>
      <p><i class="fa fa-truck"></i> <a href="index.php?page=inventorylist"><strong><?php print $result[0]['product_count'] ?></strong> Productos</a></p>
    <?php else: ?>
      <p><i class="fa fa-truck"></i> No hay productos en su club!</p>
    <?php endif; ?>


  </div>
  </div>
  </div>
  </div>
<?php include 'modules/footer.php';?>

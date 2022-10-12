<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: En esta página se le muestra al director las asistencias. Se debe de elegir una actividad y
						la fecha en la que desea tomar esa asistencia. Debe de poder cargar la lista de miembros que
						son participantes de esa actividad en particular. Una vez carguen, se debe marcar si el miembro
						está presente. Finalmente, debe de poder guardarla en la base de datos.
*/

//Conecta a la base de datos.
	include 'config1.php';
	$updateFlag = 0;
?>


<!--Coloca imagen  en el centro-->
<div style="position:relative; height:150px;">
<img src="images/attendance.png"
   style="position:absolute; top:-100px; right:450px; width:250px; height:230px; border:none;"
   alt="Asistencia"
   title="Asistencia" />
</div>

<!--Se construye el header y se crea la tabla de actividades-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
			<h1 class="page-header">Tomar asistencia</h1>
			<p> Seleccione la fecha y la actividad para generar la lista.</p><br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<form action="index.php" method="get" class="form-inline" id="subjectForm" data-toggle="validator">
				<div class="form-group">
					<label for="select" class="control-label">Actividad:</label>
					<?php
						//Query: Busca la información de las actividades que se celebran en el club del que esté iniciado en la sesión
						$query_subject = "SELECT activity.name, activity.id from activity
						INNER JOIN user_activity WHERE user_activity.id = activity.id AND user_activity.uid = {$_SESSION['uid']}  ORDER BY activity.name";
						$sub=$conn->query($query_subject);
						$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
						echo "<select name='activity' class='form-control' required='required'>";
						for($i = 0; $i<count($rsub); $i++)
						{
							if ($_GET['activity'] == $rsub[$i]['id']) {
								echo"<option value='". $rsub[$i]['id']."' selected='selected'>".$rsub[$i]['name']."</option>";
							}
							else {
								echo"<option value='". $rsub[$i]['id']."'>".$rsub[$i]['name']."</option>";
							}
						}
						echo"</select>";
					?>
				</div>
				<!--Se construye un datetime picker-->
				<div class="form-group" data-provide="datepicker">
					<label for="select" class="control-label">Fecha:</label>
					<input type="date" class="form-control" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
				</div>
					<!--Se construye el botón para cargar los miembros una vez se oprima-->
				<input type="submit" class="btn btn-info" name="sbt_stn" value="Cargar miembros">
			</form>

			<?php
			// Se corrobora que el usuario haya seleccionado fecha y actividad para así desplegar la información.
				if(isset($_GET['date']) && isset($_GET['activity'])) :
			?>

			<?php
				// Inicializa variables de tiempo para obtener la fecha.
				$todayTime = time();
				$submittedDate = strtotime($_GET['date']);

			?>

			<br>
			<form action="index.php" method="post">
			<!--Se crea tabla para desplegar información sobre ID y nombre de los miembros a los que se tomará asistencia-->
			<table  class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Número de ID</th>
						<th>Nombre</th>
						<th><input type="checkbox" class="chk-head" /> Todos presentes</th>
					</tr>
				</thead>

				<?php
					 $dat = $_GET['date'];
					 $ddate = strtotime($dat);
					 $sub=$_GET['activity'];
					//Query: obtiene de la tabla de attendance el id de miembro y de la actividad a la que esté presente o ausente en la fecha correspondiente.
					$que= "SELECT sid, aid, ispresent  from attendance  WHERE date  =$ddate
					AND id=$sub ORDER BY sid";
					$ret=$conn->query($que);
					$attData=$ret->fetchAll(PDO::FETCH_ASSOC);

					if(count($attData))
					{
						$updateFlag=1;
					}
					else{
						$updateFlag=0;

					}
					//Query: Muestra a los miembros presentes o ausentes en una actividad predeterminada.
					$qu = "SELECT member.sid, member.name from member INNER JOIN member_activity WHERE member.sid = member_activity.sid AND member_activity.id  = {$_GET['activity']}  ORDER BY member.sid";
					$stu=$conn->query($qu);
					$rstu=$stu->fetchAll(PDO::FETCH_ASSOC);

					//En caso de que el usuario quiera regresar y actualizar asistencia, se desplegará la tabla con el id, nombre y se indicará si estaba presente o no.
					echo"<tbody>";
					for($i = 0; $i<count($rstu); $i++)
					{
						echo"<tr>";

						if($updateFlag) {
							echo"<td>".$rstu[$i]['sid']."<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'>" ."<input type='hidden' name='att_id[]' value='" . $attData[$i]['aid'] . "'>".  "</td>";
							echo"<td>".$rstu[$i]['name']."</td>";


								if(($rstu[$i]['sid'] ==  $attData[$i]['sid']) && ($attData[$i]['ispresent']))
								{

									echo "<td><input class='chk-present' checked type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
								}
								else
								{
									echo "<td><input class='chk-present' type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
								}
							}
							else {
								echo"<td>".$rstu[$i]['sid']."<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'></td>";
								echo"<td>".$rstu[$i]['name']."</td>";
								echo"<td><input class='chk-present' type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
							}


						echo"</tr>";
					}
					echo"</tbody>";

				?>
			</table>

<!--En caso de actualizar, muestra si el miembro está presente o ausente-->
			<?php if($updateFlag) : ?>
				<input type="hidden" name="updateData" value="1">
			<?php else: ?>
				<input type="hidden" name="updateData" value="0">
			<?php endif; ?>

			<input type="hidden" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>">
			<input type="hidden" name="activity" value="<?php print isset($_GET['activity']) ? $_GET['activity'] : ''; ?>">
			<hr>
			<input type="submit" class="btn btn-success btn-block" name="sbt_top" value="Guardar Asistencia">

			</form>

			<p>&nbsp;</p>

			</div>

			<?php
				endif;
			?>
			<?php
				//Se actualiza la información de la asistencia
				if (isset($_POST['sbt_top'])) {
					if(isset($_POST['updateData']) && ($_POST['updateData'] == 1) ) {

							$id = $_POST['activity'];
							$uid = $_SESSION['uid'];
							$p = 0;
							$st_sid =  $_POST['st_sid'];
							$attt_aid =  $_POST['att_id'];
							$ispresent = array();
							if (isset($_POST['chbox'])) {
								$ispresent =  $_POST['chbox'];
							}

							for($j = 0; $j < count($st_sid); $j++)
							{
									//Query: Actualiza la lista de asistencia
									$stmtInsert = $conn->prepare("UPDATE attendance SET ispresent = :isMarked WHERE aid = :aid");

									if (count($ispresent)) {
										$p = (in_array($st_sid[$j], $ispresent)) ? 1 : 0;
									}

									$stmtInsert->bindParam(':isMarked', $p);
									$stmtInsert->bindParam(':aid', $attt_aid[$j]);
									$stmtInsert->execute();

							}
						echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>¡Bien hecho!</strong> Asistencia guardada satisfactoriamente!.
              </div>';

					}
					else {

						// Prepara el sql y enlaza los parámetros
							$date = $_POST['date'];
						$tstamp = strtotime($date);
							$id = $_POST['activity'];
							$uid = $_SESSION['uid'];
							$p = 0;
							$st_sid =  $_POST['st_sid'];
							$ispresent = array();
							if (isset($_POST['chbox'])) {
								$ispresent =  $_POST['chbox'];
							}

							for($j = 0; $j < count($st_sid); $j++)
							{
									//Query: inserta los valores en la tabla de asistencia
									$stmtInsert = $conn->prepare("INSERT INTO attendance (sid, date, ispresent, uid, id)
								VALUES (:sid, :date, :ispresent, :uid, :id)");

									if (count($ispresent)) {
										$p = (in_array($st_sid[$j], $ispresent)) ? 1 : 0;
									}

									$stmtInsert->bindParam(':sid', $st_sid[$j]);
									$stmtInsert->bindParam(':date', $tstamp);
									$stmtInsert->bindParam(':ispresent', $p);
									$stmtInsert->bindParam(':uid', $uid);
									$stmtInsert->bindParam(':id', $id);
									$stmtInsert->execute();

						}
						//Se desplega mensaje de éxito
						echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>¡Bien hecho!</strong> Asistencia guardada satisfactoriamente!.
              </div>';
					}
				}
			?>
		</div>
	</div>
</div>
</div>
<?php include 'modules/footer.php';?>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito crear reportes de las asistencias registradas. Provee las opciones
					de elegir la actividad y las fechas en las que se desea obtener ese reporte. Muestra el nombre de los miembros,
					las diferentes fechas, si está presente o ausente y el porcentaje final.
*/
//Se conecta a la base de datos.
include 'config1.php';
?>
<?php
//Guarda el ID de la sesión loggeada.
	$suid = $_SESSION['uid'];

?>

<!--Se coloca imagen de centro-->
<div style="position:relative; height:60px;">
<img src="images/report.png" class="img-rounded"
   style="position:absolute; top:-100px; right:450px; width:300px; height:200px; border:none;"
   alt="Trofeo"
   title="Trofeo" />
</div>

<!--Se construye el header de la página-->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
			<h1 class="page-header">Reportes</h1>
		</div>
	</div>

<!--Se construye el dropdown que contiene las actividades que se celebra en el club loggeado.-->
<div class="row">
<div class="col-md-12 col-lg-12">
	<form action="" method="GET" class="form-inline" data-toggle="validator">
		<div class="form-group">
			<label for="select" class="control-label">Actividad:</label>
		<?php
		//Query: Muestra las actividades que se celebran en club loggeado.
			$query = "SELECT activity.name, activity.id from activity
		INNER JOIN user_activity WHERE user_activity.id = activity.id AND user_activity.uid = $suid  ORDER BY activity.name";
			$sub=$conn->query($query);
			$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
			$subnm=$rsub[0]['name'];
			$subid=$rsub[0]['id'];

			echo "<select name='activity' class='form-control' required='required'>";
			for($i = 0; $i<count($rsub); $i++)
			{
				if ($_GET['subject'] == $rsub[$i]['id']) {
					echo"<option value='". $rsub[$i]['id']."' selected='selected'>".$rsub[$i]['name']."</option>";
				}
				else {
					echo"<option value='". $rsub[$i]['id']."'>".$rsub[$i]['name']."</option>";
				}
			}
			echo "</select><br>";
		?>
	</div>
		<!--Se construyen los date time picker para que el usuario seleccione de que fecha a que fecha desea que se genere el reporte.-->
		<div class="form-group" data-provide="datepicker">
			<label for="select" class="control-label">Desde:</label>
			<input type="date" name="sdate" class="form-control" value="<?php print isset($_GET['sdate']) ? $_GET['sdate'] : ''; ?>" required>
		</div>

		<div class="form-group" data-provide="datepicker">
			<label for="select" class="control-label">Hasta:</label>
			<input type="date" name="edate" class="form-control" value="<?php print isset($_GET['edate']) ? $_GET['edate'] : ''; ?>" required>
		</div>

		<input type="hidden" name="page" value="reports">
		<input type="submit" class="btn btn-info" name="submit" value="Cargar miembros">
			</form>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<p>&nbsp;</p>
			<div class="report-data">

			<?php
//Una vez se rellenen los campos se obtiene la información de la actividad y las fechas en las que desea obtener los resultados
$t=time();
if(isset($_GET['submit']) && !empty($_GET['sdate']) && !empty($_GET['edate']) && ($_GET['edate'] > $_GET['sdate']) && ($_GET['sdate']<$t) && ($_GET['edate']<$t))
{
$sdat = $_GET['sdate'];
$edat= $_GET['edate'];
$selsub=$_GET['activity'];
$sdate = strtotime($sdat);
$edate = strtotime($edat);

//Query: Muestra los nombres de los miembros que son participantes de la actividad que se seleccionó.
$query = "SELECT member.sid, member.name from member INNER JOIN member_activity WHERE member.sid = member_activity.sid AND member_activity.id  = {$selsub}  ORDER BY member.sid";
$stu=$conn->query($query);
$rstu=$stu->fetchAll(PDO::FETCH_ASSOC);


echo "<table class='table table-striped table-hover reports-table'>";
echo "<thead>";
echo "<tr>";
echo "<th>Número de ID</th>";
echo "<th>Nombre</th>";

//Se fija que las fechas que se desea obtener es viernes, sábado y domingo solamente y sus respectivos formatos.
for($k=$sdate;$k<=$edate;$k=$k+86400)
{
	$thisDate = date( 'd-m-Y', $k );
	$weekday= date("l", $k );
	$normalized_weekday = strtolower($weekday);
	if(($normalized_weekday!="monday") && ($normalized_weekday!="tuesday") && ($normalized_weekday!="wednesday") && ($normalized_weekday!="thursday") )
	{
		echo "<th>".$thisDate."</th>";
	}
}
echo "<th>Presentes/Total</th>";
echo "<th>Porcentaje</th>";;
echo "</tr>";
echo "</thead>";
echo "</tbody>";

//Se coloca el valor a cada uno de los miembros en donde se muestran si están ausentes o presentes.
for($i=0;$i<count($rstu);$i++)
{

	$present=0;
	$absent=0;
	$totlec=0;
	$perc=0;
	echo"<tr><td><h6>".$rstu[$i]['sid']."</h6></td>";
	echo "<td><h5>".$rstu[$i]['name']."</h5></td>";
	$dsid=$rstu[$i]['sid'];

//Se fija que las fechas que se desea obtener es viernes, sábado y domingo solamente y sus respectivos formatos.
	for($j=$sdate;$j<=$edate;$j=$j+86400)
	{
		$weekday= date("l", $j );
		$currentDate = date('Y-m-d', $j);
		$normalized_weekday = strtolower($weekday);
		 if(($normalized_weekday!="monday") && ($normalized_weekday!="tuesday") && ($normalized_weekday!="wednesday") && ($normalized_weekday!="thursday"))
		 {

			 //Query: Muestra los asistencias de los miembros utilizando sus ID's correspondientes.
			 $sql = "SELECT sid ,ispresent FROM attendance WHERE sid=$dsid AND
			 id=$selsub AND date=$j AND $suid=uid " ;
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(!empty($result)){

				//Si está presente se representa con un 1 y se va incrementando a medida de que sean más días.
				$totlec++;
				if($result[0]['ispresent']==1)
				{
					$present++;
					echo"<td><span class='text-success'>Presente</span></td>";
				}
				else
				{
					echo"<td><span class='text-danger'>Ausente</span></td>";
					$absent++;
				}
			}else
			{
				echo "<td><a href='index.php?subject=" . $selsub . "&date=" . $currentDate . "'>Tomar Asistencia</a></td>";
			}
							}
						}
						if($totlec!=0)
							$perc=round((($present*100)/$totlec), 2);
						else
							$perc=0;
						echo"<td><strong>".$present."</strong>/".$totlec."</td>";
						echo"<td>".$perc."&nbsp;%</td>";
						echo"</tr>";

					}
					echo "</tbody>";
					echo "</table>";
				}else

			?>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<?php
include 'config1.php';
?>
<html>
<head>
	<!--Se construye el header de la página-->
	<div class="container">
	  <div class="row">
	    <div class="col-md-12 col-lg-12">
				<h2 class="page-header">Gráfica de torneos y donaciones</h2>
			</div>
		</div>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <script type="text/javascript">


 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
  google.setOnLoadCallback(drawChart2);


 function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['Nombre','Cantidad de Participantes'],
 <?php
			$query = "SELECT * from tourney";

			 $exec = mysqli_query($db,$query);
			 while($row = mysqli_fetch_array($exec)){

			 echo "['".$row['name']."',".$row['quantity']."],";
			 }
			 ?>

 ]);



 var options = {
 title: 'Número de participantes de los distintos torneos'
 };
 var chart = new google.visualization.ColumnChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }



 function drawChart2() {
 var data = google.visualization.arrayToDataTable([

 ['Nombre','Donación'],
 <?php
			$query = "SELECT * from donation";

			 $exec = mysqli_query($db,$query);
			 while($row = mysqli_fetch_array($exec)){

			 echo "['".$row['date']."',".$row['quantity']."],";
			 }
			 ?>

 ]);

 var options = {
 title: 'Cantidad de donaciones por fechas'
 };
 var chart = new google.visualization.BarChart(document.getElementById("columnchart13"));
 chart.draw(data,options);
 }



</script>

</head>
<body>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>

 <div class="container-fluid">
 <div id="columnchart13" style="width: 100%; height: 500px;"></div>
</div>
</div>
</body>
</html>

<?php include 'modules/footer.php';?>

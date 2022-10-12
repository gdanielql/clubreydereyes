<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página es para la construcción del navegador del sistema. Aquí se mostrarán los diferentes
					apartados con sus respectivas referencias a las diferentes páginas.
*/
	session_start();
?>

<?php if (isset($_SESSION['islogin']) && $_SESSION['islogin'] == 1) : ?>

		<!--Se construye barra de navegador con estilo en css.-->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #1e3f5a;" id="sidebar-wrapper" role="navigation">

			<ul class="nav sidebar-nav" >
					<li class="sidebar-brand">
							<a href="index.php">
								<div style="position:relative; height:60px;">
								<img src="images/chessy.png" alt="ajedrez"
								style="position:absolute; top:-50px; right:-5px; width:230px; height:120px; border:none;"/>
							</a>
							</div>


	<!--Se crea una lista que contiene los nombres de los diferentes apartados del sistema.-->
					</li>
					<li>
						<br>
							<a href="index.php?page=dashboard"><i class="fa fa-fw fa-home"></i> Dashboard</a>
					</li>
					<li>
							<a href="index.php?page=memberinfo"><i class="fa fa-fw fa-address-book"></i> Miembros</a>
					</li>
					<li>
							<a href="index.php"><i class="fa fa-fw fa-book"></i> Asistencia</a>
					</li>
					<li>
							<a href="index.php?page=reports"><i class="fa fa-fw fa-bar-chart"></i> Reportes</a>
					</li>
					</li>
					<li>
							<a href="index.php?page=inventorylist"><i class="fa fa-fw fa-truck"></i> Inventario</a>
					</li>
					</li>
					<li>
							<a href="index.php?page=donation"><i class="fa fa-fw fa-money"></i> Donaciones</a>
					</li>
					</li>
					<li>
							<a href="index.php?page=tourney"><i class="fa fa-fw fa-trophy"></i> Torneos</a>
					</li>
					</li>

				<li>
						<a href="index.php?page=calendar"><i class="fa fa-fw fa-calendar"></i> Calendario</a>
				</li>
				</li>

					<li>
							<a href="index.php?page=classmaterial"><i class="fa fa-fw fa-file"></i> Materiales de Clases</a>
					</li>
					</li>
					<li>
							<a href="index.php?page=manual"><i class="fa fa-fw fa-check-square"></i> Archivos</a>
					</li>
					</li>
					<li>
							<a href="index.php?page=help"><i class="fa fa-fw fa-question"></i> Ayuda</a>
					</li>
					</li>
					<li>
							<a href="index.php?page=logout"><i class="fa fa-fw fa-sign-out"></i> Salir</a>
					</li>
					</li>


			</ul>
	</nav>

	<!--Se creaotra barra de navegador para el front end.-->
<?php else: ?>
	<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #1e3f5a;"  id="sidebar-wrapper" role="navigation">
			<ul class="nav sidebar-nav">
					<li class="sidebar-brand">
							<a href="index.php">
								<div style="position:relative; height:60px;">
								<img src="images/chessy.png" alt="ajedrez"
								style="position:absolute; top:-50px; right:-5px; width:230px; height:100px; border:none;"/>
							</a>

					</li>
					<li>
							<a href="index.php"><i class="fa fa-fw fa-sign-in"></i> Administradores</a>
					</li>


					<li>
							<a href="public/post.php"><i class="fa fa-fw fa-pencil"></i> Rincón Ajedrecístico</a>
					</li>

					<li>
							<a href="public/about.php"><i class="fa fa-fw fa-bullhorn"></i> Conócenos</a>
					</li>

					<li>
							<center><a href="https://www.facebook.com/clubdeajedreztrujillano"><i class="fa fa-3x fa-facebook"></i> </a></center>
					</li>

					<li>
							<center><a href="https://twitter.com/club_trujillano?lang=en"><i class="fa fa-3x fa-twitter"></i> </a></center>
					</li>

					<li>
							<center><a href="https://www.instagram.com/clubreydereyes_/"><i class="fa fa-3x fa-instagram"></i> </a></center>
					</li>


	</nav>
<?php endif; ?>

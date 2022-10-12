<!--
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página permite desplazar entre los distintos apartados sin tener que introducir el nombre de la página en la URL.
-->

<!-- Contenido de la página-->
	<div id="page-content-wrapper">
	<button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
		<span class="hamb-top"></span>
		<span class="hamb-middle"></span>
		<span class="hamb-bottom"></span>
	</button>
	<div class="container">
		<div class="row">
				<?php

$start=false;
// session_start();

//Permite ir cambiando de páginas en el navegador
if (isset($_POST['register'])) {

		include 'modules/register.php';
}
else {
	if (isset($_SESSION['islogin']) && $_SESSION['islogin'] == 1) {
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			switch ($page) {
				case 'dashboard':
				case 'calendar':
				case 'reports':
				case 'logout':
				case 'help':
				case 'memberinfo':
				case 'tourney':
				case 'inventory':
				case 'donation':
				case 'registerdon':
				case 'classmaterial':
				case 'manual':
				case 'registertourn':
				case 'inventorylist':
				case 'register':
				case 'post':
				case 'registerpost':
				case 'about':
				case 'album':
				case 'catalog':
				case 'search':
				case 'searchMember':
				case 'searchDonation':
				case 'searchTourney':
				case 'registerabout':
				case 'edit_tourney':
				case 'edit_member':
				case 'edit_donation':
				case 'edit_post':
				case 'edit_about':
				case 'edit':
					include 'modules/'.$page.'.php';
					break;
				default:
					include 'modules/attendance.php';
					break;
			}
		}
		else if (isset($_POST['registerdon'])){
			include 'modules/registerdon.php';
		}
		else if (isset($_POST['register'])){
			include 'modules/register.php';
		}
		else if (isset($_POST['add'])){
			include 'modules/attendance.php';
		}

		else if (isset($_POST['registertourn'])){
			include 'modules/registertourn.php';
		}

		else if (isset($_POST['inventory'])){
			include 'modules/inventory.php';
		}

		else if (isset($_POST['class'])){
			include 'modules/register.php';
		}

		else if (isset($_POST['registerpost'])){
			include 'modules/registerpost.php';
		}

		else if (isset($_POST['upload'])){
			include 'modules/album.php';
		}

		else if (isset($_POST['registerabout'])){
			include 'modules/registerabout.php';
		}

		else if (isset($_POST['search'])){
			include 'modules/searchMember.php';
		}

		else if (isset($_POST['search'])){
			include 'modules/searchDonation.php';
		}

		else if (isset($_POST['search'])){
			include 'modules/searchTourney.php';
		}

		else if (isset($_POST['search'])){
			include 'modules/search.php';
		}

		else if (isset($_POST['search'])){
			include 'modules/search.php';
		}

		else if (isset($_POST['search'])){
			include 'modules/search.php';
		}

		else {
			include 'modules/attendance.php';
		}

	}

	else {
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			switch ($page) {
				default:
					include 'modules/login.php';
					break;
			}
		}
		else {
			include 'modules/login.php';
		}
	}
}
					?>
				</div>
			</div>
	</div>
	<!-- /#page-content-wrapper -->

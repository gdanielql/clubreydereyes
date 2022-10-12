<!--
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página permite al usuario poder loggearse dentro del sistema. Se encarga de poder autenticar al usuario y de llamar a
            la función que se encarga de validar la información. De igual manera si hay algún error se lo indica al usuario.
-->

<!--Se construye el header con su logo-->
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <img src="images/logos.png" alt="logos"
      style="width:350px; height:350px; border:none;">
      <h4>Bienvenidos(as) a la plataforma de directores del </h4>
      <h2><strong>CLUB DE AJEDREZ REY DE REYES</strong></h2>
    </div>
  </div>
  <div class="row">
    <!--En caso de que estén los datos incorrectos, desplegará mensaje.-->
		<?php if(isset($_GET['invalid'])) : ?>
			<div class="col-md-6 col-md-offset-3 col-lg-6 no-column-padding">
				<div class="form-group alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>ERROR</strong> Nombre de usuario o Contraseña incorrecta.
				</div>
			</div>
		<?php endif; ?>
    <!--Se construye el form en donde se le pide al usuario el nombre de usuario y la contraseña.-->
    <!--El form verificará los datos redirigiéndose a verify.php-->
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" id="loginForm" action="modules/verify.php" method="post" data-toggle="validator">
				<div class="form-group">

          <label for="inputEmail3" class="control-label"> <i class="fa fa-fw fa-user"></i> Nombre de usuario </label>
          <input type="text" class="form-control" id="inputEmail3" name="name" maxlength="16" placeholder="Nombre de Usuario" required>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="control-label"> <i class="fa fa-fw fa-lock"></i> Contraseña </label>
          <input type="password" class="form-control" id="inputPassword3"  name="pass" maxlength="16" placeholder="Contraseña" required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Iniciar sesión">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">


<!-- Imagen de fondo -->
<style>
body {
  background-image: url("images/fondito2.jpeg");
  background-position: top;
  height: 140vh;
}

</style>
  <!--Coloca imagen en blanco-->
  <div style="position:relative;">
  <img src="images/blank.png"
     style="position:absolute; top: -780px; right:-400px; width:200px; height:200px; border:none;"
     alt="Logo Club de Ajedrez Rey de Reyes"
     title="Logo Club de Ajedrez Rey de Reyes" />
  </div>
</div>
</div>
</div>
</div>
<?php include 'modules/footer.php';?>
<script>
	$('#loginForm').validator();
	$('#studentForm').validator();
</script>

<?php
/*
Autor: Gioberto Daniel Quiñones Lozada
Curso: SICI 4038
Dr. Miguel Vélez
Propósito: Esta página tiene como propósito mostrar las publicaciones de "Conócenos". También, provee un navegador para facilitarle al usuario
          ver la información de forma rápida.
*/
//Conectar a la base de datos.
include 'config1.php';
?>


<?php include 'nav.php';?>
<br>

<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('../images/aboutbackground.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h3 class="display-4">Aprende ajedrez con los mejores</h3>
          <p class="lead">El deporte ciencia es considerado como el juego para los genios.</p>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('../images/slide.png')">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('../images/slide3.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h3 class="display-4">Clases gratis, regístrate hoy</h3>
          <p class="lead">Se parte de nuestra comunidad.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</header>


<!--Se construye el header de la página.-->
<div class="container">
  <div class="row">
    <div class="container p-3 my-3 bg-dark text-white">
			<center><h1 class="page-header">Conoce los Clubes de Ajedrez Rey de Reyes</h1><center>
		</div>
	</div>
</div>


      <div class="container">

        <div>
          <!--Se crea el botón para escribir en el apartado de "Rincón Ajedrecístico"-->
          <form action="album2.php">

              <button  style="margin:5px;" type="submit" name="page" value="album"  class="btn btn-primary btn-block"><i class="fa fa-fw fa-eye"></i> Ver album de fotos</button>

          </form>
        </div>
    <div class="row">
        <div class="col col-md-8">
            <div class="card container p-3 my-3 bg-dark text-white">
                <div class="card-body ">

						<?php

									 $conn = new mysqli("localhost","root","root","mattendance");
									 $sql = "SELECT * FROM about";
									 $result = $conn->query($sql);
							$count=0;
									 if ($result -> num_rows >  0) {

										 while ($row = $result->fetch_assoc())
						 {
								$count=$count+1;
											 ?>

													<h3 class="card-title"><?php echo $row["heading"] ?></h3>

													<p class="card-text"><?php echo $row["message"]  ?></p><hr>

								<?php

										 }
									 }

								?>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/pIHmvOFa_YY" frameborder="0" allow="accelerometer; autoplay;
              clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div><hr>
                  <!--Se crea el botón para visitar  el apartado de "Rincón Ajedrecístico"-->
                  <form action="post.php">

                      <button  style="margin:5px;" type="submit" name="page" value="post"  class="btn btn-primary btn-block"> Visita el Rincón Ajedrecístico</button>

                  </form>


                </div>

				</div>
			</div>
    </div>

<!--Se colocan imágenes para el público-->
<div class="col col-md-4">
            <div class="card p-2 my-3 bg-dark text-white">
              <div class="card-body ">
                <div class="card">
            <img class='img-fluid w-80' src="../images/poster.jpg">
          </div>
          <br>
            </div>
            <div class="card">
            <img class='img-fluid w-80' src="../images/jonathan.jpg">
            </div>
          <br>
            <div class="card">
            <img class='img-fluid w-80' src="../images/pic2.jpg">
            </div>

          <br>
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
            (939) 891-0052
            <br>
            <abbr title="Email">Email:</abbr>
            <a href="mailto:#">ajedreztrujillano@gmail.com</a>
          </address>

<div class="mapouter"><div class="gmap_canvas"><iframe width="320" height="343" id="gmap_canvas"
  src="https://maps.google.com/maps?q=villas%20de%20caney&t=&z=13&ie=UTF8&iwloc=&output=embed"
  frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  <a href="https://embedgooglemap.net/134/">torrentz2</a></div><style>.mapouter
  {position:relative;text-align:right;height:343px;width:375px;}.gmap_canvas
  {overflow:hidden;background:none!important;height:343px;width:326px;}</style></div>

<style>
.carousel-item {
  height: 65vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

</style>

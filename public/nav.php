
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">






<!--Se crea un nuevo navegador con estilo diferente para el front end-->
<nav  class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top" >
  <a class="navbar-brand text-white"  href="#">Club de Ajedrez Rey de Reyes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="http://localhost:8080/member/index.php"> <i class="fa fa-fw fa-sign-in"></i> Administradores  <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="member.php"><i class="fa fa-fw fa-address-book"></i> Regístrate <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="post.php"><i class="fa fa-fw fa-pencil"></i> Rincón Ajedrecístico<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="about.php"> <i class="fa fa-fw fa-info"></i> Conócenos<span class="sr-only">(current)</span></a>
      </li>
      <ul></ul><ul></ul><ul></ul><ul></ul>
      <ul class="nav-item">
          <a class="nav-link" href="https://www.facebook.com/clubdeajedreztrujillano"><i class="fa fa-2x fa-facebook"></i><span class="sr-only">(current)</span></a>
      </ul>

      <ul class="nav-item">
          <a class="nav-link" href="https://twitter.com/club_trujillano?lang=en"><i class="fa fa-2x fa-twitter"></i><span class="sr-only">(current)</span></a>
      </ul>

      <ul class="nav-item">
          <a class="nav-link" href="https://www.instagram.com/clubreydereyes_/"><i class="fa fa-2x fa-instagram"></i><span class="sr-only">(current)</span></a>
      </ul>

    </ul>
  </div>
</nav>
<br>


  <style>
  body{
    background-image:url("../images/woodback.jpg");


     background-size: cover;
      background-position: center;

    height: 140vh;
  }

  body {
    font-family: 'Montserrat', sans-serif;
  }
</style>

<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>
    <script>
    $(function() {
        Holder.addTheme("thumb", {
            background: "#55595c",
            foreground: "#eceeef",
            text: "Thumbnail"
        });
        $('#myCarousel').carousel({
            // Options
        });
    });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

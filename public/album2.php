
<?php
//Conectar a la base de datos.

?>

<?php include 'nav.php';?>
<br><br>

  <!--Se construye el header de la página.-->
  <div class="container">
    <div class="row">
      <div class="container p-3 my-3 bg-dark text-white">
  			<h1 class="page-header">Galería del Club Rey de Reyes</h1>
  		</div>
  	</div>
  </div>

  <!-- The Close Button -->

  <!-- Page Content -->
  <div class="container">
    <hr class="mt-2 mb-5">
    <div class="row text-center text-lg-left">
      <div class="row">


        <!-- The Modal -->
<div id="myModal" class="modal">
     <center><button type="button" class="btn btn-secondary btn-right" data-dismiss="modal">Cerrar</button><center>
  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">
</div>

<?php
include 'config1.php';
$sql = "SELECT * FROM album";
$result = $db->query($sql);



while ($row = $result->fetch_assoc())
{

echo  '<div id ="myModal" class="col-xs-4 col-md-4 col-sm-4">'. '<center><p class = text-white>'.$row['title'];
echo '<img id="myImages" class="img-fluid img-thumbnail myImages modal-content" style="width:350px; height:250px;" src="data:image/jpeg;base64,'.base64_encode( $row['content'] ).'">'.'</p><center></div>';
}
?>
</div>
</div>


<!--Se crea el botón para volver atrás-->
<button  class="btn btn-primary btn-block" onclick="history.go(-1);"> Atrás </button>
</div>
</hr>

<br>


<style>
* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: 	#FFFFFF;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}

  body{
    background-image:url("../images/woodback.jpg");


     background-size: cover;
      background-position: center;

    height: 140vh;
  }


  </style>

  <script>
  // create references to the modal...
  var modal = document.getElementById('myModal');
  // to all images -- note I'm using a class!
  var images = document.getElementsByClassName('myImages');
  // the image in the modal
  var modalImg = document.getElementById("img01");
  // and the caption in the modal
  var captionText = document.getElementById("caption");

  // Go through all of the images with our custom class
  for (var i = 0; i < images.length; i++) {
    var img = images[i];
    // and attach our click listener for this image.
    img.onclick = function(evt) {
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
  }

  var span = document.getElementsByClassName("btn btn-secondary")[0];

  span.onclick = function() {
    modal.style.display = "none";
  }
</script>

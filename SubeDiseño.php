<?php
include("funciones/validarUser.php");
include 'filesLogic.php';

?>
<?php
if (!session_id()) session_start();
include("funciones/conecta.php");
include("funciones/config.php");
include("carrito.php");

//$sql = "select * from productos where id_tipo='1'";
$sql = "select * from subir_diseño where id_tipo='1'";

$result = $conecta->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CDN Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!--========== BOX ICONS ==========-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <!--========== Sweet Alert ==========-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!------------------- AJAX ---------------------->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Script para cargar pagina -->
  <script src="js/cargarPagina.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/categorias.css">

  <title>E-Royal Style</title>

  <!--========== Ir al formulario de inicio de sesión mediante AJAX ==========-->
  <script>
    function Iniciar_Sesion() {
      //console.log("OK");
      $.ajax({
        type: "POST",
        url: "iniciar_sesion.php",
        //url: url,
        //data: parametros,
        success: function(data) {
          $("#resultado").html(data);
        },
        error: function(data) {
          $("#resultado").html("El recurso buscado no se encuentra");
        }
      });
      //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
    }

    function irCarrito() {
            console.log("SI LLEGA");
            $.ajax({
                type: "POST",
                url: "mostrarCarrito.php",
                //url: url,
                //data: parametros,
                success: function(data) {
                    $("#mostrar_carrito").html(data);
                },
                error: function(data) {
                    $("#mostrar_carrito").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      E-Royal Style
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class='bx bx-male-sign'></i>Damas
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Blusas</a>
            <a class="dropdown-item" href="#">Vestidos</a>
            <a class="dropdown-item" href="#">Pantalones</a>
            <a class="dropdown-item" href="#">Calcetas</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class='bx bx-female-sign'></i>Caballeros
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#" onclick="cargarPagina('playeras.php')">Playeras</a>
            <a class="dropdown-item" href="#">Gorras</a>
            <a class="dropdown-item" href="#">Chamarras</a>
            <a class="dropdown-item" href="#">Calcetines</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class='bx bxs-t-shirt'></i>Diseñador
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Plantillas</a>
            <a class="dropdown-item" href="Diseño.php">Mis diseños</a>
          </div>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>-->
      </ul>
      <h4 class="sesion">
        <span class="badge badge-secondary">Bienvenido
          <?php
          echo $_SESSION['usuario'];
          echo "<br>";

          $varsesion = $_SESSION['usuario'];

          if ($varsesion == null || $varsesion = '') {
            echo "<a href='#' onclick='Iniciar_Sesion()'>Iniciar sesión</a>";
          } else {
            echo "<a href='funciones/cerrar_sesion.php'>Cerrar sesion</a>";
          }
          ?>
        </span>
      </h4>

      <?php
        $sql_search = "select * from productos where id_tipo='1'";
        $result = $conecta->query($sql);
      ?>

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="buscar" id="buscar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>

      <!--<?php echo $mensaje; ?>-->
      <!-- Carrito -->
      <a class="nav-link" href="#" onclick="irCarrito()" class="badge badge-success">
        <h3 class="bx bx-cart-alt"></h3>
        <div class="circle">
          <div class="contador">
            <div id="eliminado">
            <div id="resu">
              <!-- Este DIV es el resultado de la funcion "enviaDatosCarrito" que esta en la página "playeras" -->
              <?php echo (empty($_SESSION['carrito'])) ? 0 : count($_SESSION['carrito']); ?>
            </div>
            </div>
          </div>
        </div>
      </a>

    </div>
  </nav>

  <!-- CONTENIDO -->
  <!-- Page content -->
  <div id="main">
    <div id="mostrar_carrito">
    <div id="resultado">
      <div class="w3-content" style="max-width:2000px;margin-top:46px">
      <div class="products-grid">


<div class="divsubida">
    <form class="formulariodiseño" action="SubeDiseño.php" method="post" enctype="multipart/form-data">

        <div class="divfile">
            <p>SUBIR DISEÑO</p>
            <input type="file" name="myArchivo" id="subefile">
        </div>

        <b>Categoría:</b>
        <select name="tipo" id="tipo">
            <option value="1">Playeras</option>
            <option value="2">Calcetines</option>
            <option value="3">Gorras</option>
            <option value="4">Chamarras</option>
        </select>

        <p><b>Descripcion:</b></p>
        <textarea name="describe" id="describe" cols="30" rows="2" style="resize: none;" maxlength="100" require></textarea>
        <button class="botonsubir" type="submit" name="envia">+</button>
    </form>
</div>


<?php foreach ($files as $file) : ?>
    
    <div class="product">
        <img class="product-image" src="downloads.php?file_id=<?php echo $file['id_diseño'] ?>">
        <div class="product-info">
            <br>
            <p><?php echo $file['descripcion']; ?></p>
        </div>
    </div>
    
<?php endforeach; ?>

</div>
       
        <!-- End Page Content -->
      </div>


      <!-- Image of location/map -->
      <img src="/w3images/map.jpg" class="w3-image w3-greyscale-min" style="width:100%">

      <!-- Footer -->
      <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
        <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
      </footer>
    </div> <!-- Fin de DIV Resultado -->
    </div> <!-- Fin DIV mostrar_carrito -->
  </div> <!-- Fin de DIV Main -->

  <script>
    // Automatic Slideshow - change image every 4 seconds
    var myIndex = 0;
    carousel();

    function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      myIndex++;
      if (myIndex > x.length) {
        myIndex = 1
      }
      x[myIndex - 1].style.display = "block";
      setTimeout(carousel, 4000);
    }

    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }

    // When the user clicks anywhere outside of the modal, close it
    var modal = document.getElementById('ticketModal');
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>
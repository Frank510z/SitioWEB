<?php
include("funciones/conecta.php");
include("funciones/config.php");
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <title>E-Royal Style</title>

  <script>
    /*********** Ir al formulario de inicio de sesión mediante AJAX ***********/
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

    /*********** Ir a la página de Carrito mediante AJAX ***********/
    function irCarrito() {
      //console.log("SI LLEGA");
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

    /*********** Contrato de confidencialidad mediante AJAX ***********/
    function contrato() {
      //console.log("OK");
      $.ajax({
        type: "POST",
        url: "contrato_confidencialidad.php",
        //url: url,
        //data: parametros,
        success: function(data) {
          $("#contrato").html(data);
        },
        error: function(data) {
          $("#contrato").html("El recurso buscado no se encuentra");
        }
      });
      //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
    }

    /*********** Mandar datos de form CONTACTO mediante AJAX ***********/
    function contacto() {
			var nombre_cliente = $('#nombre_cliente').val();
			var correo = $('#correo').val();
			var mensaje = $('#mensaje').val();
			var url = "contacto.php";
			//console.log("Nombre: "+nombre+" Direccion: "+direccion);
			var parametros = {
				"nombre_cliente": nombre_cliente,
				"correo": correo,
				"mensaje": mensaje
			};
			console.log(parametros);
			$.ajax({
				type: "POST",
				url: "contacto.php",
				//url: url,
				data: parametros,
				success: function(data) {
					$("#contacto").html(data);
				},
				error: function(data) {
					$("#contacto").html("El recurso buscado no se encuentra");
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
            <a class="dropdown-item" href="SubeDiseño.php">Mis diseños</a>
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
  <div id="contrato">
  <div id="main">
    <div id="mostrar_carrito">
      <div id="resultado">
        <div class="w3-content" style="max-width:2000px;margin-top:46px">

          <!-- Automatic Slideshow Images -->
          <div class="mySlides w3-display-container w3-center">
            <img src="img/banner1.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
              <!--<h3>Los Angeles</h3>
            <p><b>We had the best time playing at Venice Beach!</b></p>-->
            </div>
          </div>
          <div class="mySlides w3-display-container w3-center">
            <img src="img/banner2.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
              <!--<h3>New York</h3>
            <p><b>The atmosphere in New York is lorem ipsum.</b></p>-->
            </div>
          </div>
          <div class="mySlides w3-display-container w3-center">
            <img src="img/banner3.png" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
              <!--<h3>Chicago</h3>
            <p><b>Thank you, Chicago - A night we won't forget.</b></p>-->
            </div>
          </div>

          <!-- The Band Section -->
          <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
            <h2 class="w3-wide">ACERCA DE NOSOTROS</h2>
            <p class="w3-opacity"><i>"Perfila tu estilo, tu eres tu mejor diseñador"</i></p>
            <p class="w3-justify">E-Royal Style fue fundado en 2022 por un grupo de jovenes emprendedores. Fue tan grande el emprendimiento que creamos nuestro sitio web enfocado a la venta de ropa y al diseño de la misma. Gracias a todos los que lo hicieron posible</p>
            <div class="w3-row w3-padding-32">
              <div class="w3-third">
                <b>Angélica Acosta Rodríguez</b>
                <img src="img/perfil_angelica.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
              </div>
              <div class="w3-third">
                <b>Miguel Angel Sánchez González</b>
                <img src="img/perfil_miguel.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
              </div>
              <div class="w3-third">
                <b>César Adair Medel Pedraza</b>
                <img src="img/perfil_cesar.jpg" class="w3-round" alt="Random Name" style="width:60%">
              </div>
            </div>
          </div>

          <!-- The Tour Section -->
          <div class="w3-black" id="tour">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
              <h2 class="w3-wide w3-center">TOP VENTAS</h2>
              <p class="w3-opacity w3-center"><i>¡Los tres mejores del mes!</i></p><br>

              <!--<ul class="w3-ul w3-border w3-white w3-text-grey">
                <li class="w3-padding">September <span class="w3-tag w3-red w3-margin-left">Sold out</span></li>
                <li class="w3-padding">October <span class="w3-tag w3-red w3-margin-left">Sold out</span></li>
                <li class="w3-padding">November <span class="w3-badge w3-right w3-margin-right">3</span></li>
              </ul>-->

              <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
                <div class="w3-third w3-margin-bottom">
                  <img src="img/chamarra_nasa.jpg" alt="New York" style="width:100%" class="w3-hover-opacity">
                  <div class="w3-container w3-white">
                    <p><b>New York</b></p>
                    <p class="w3-opacity">Fri 27 Nov 2016</p>
                    <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                    <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                  </div>
                </div>
                <div class="w3-third w3-margin-bottom">
                  <img src="img/Playera_necaxa.jpg" alt="Paris" style="width:100%" class="w3-hover-opacity">
                  <div class="w3-container w3-white">
                    <p><b>Paris</b></p>
                    <p class="w3-opacity">Sat 28 Nov 2016</p>
                    <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                    <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                  </div>
                </div>
                <div class="w3-third w3-margin-bottom">
                  <img src="img/gorra_gato.jpg" alt="San Francisco" style="width:100%" class="w3-hover-opacity">
                  <div class="w3-container w3-white">
                    <p><b>San Francisco</b></p>
                    <p class="w3-opacity">Sun 29 Nov 2016</p>
                    <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                    <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Ticket Modal -->
          <div id="ticketModal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
              <header class="w3-container w3-teal w3-center w3-padding-32">
                <span onclick="document.getElementById('ticketModal').style.display='none'" class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
                <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Tickets</h2>
              </header>
              <div class="w3-container">
                <p><label><i class="fa fa-shopping-cart"></i> Tickets, $15 per person</label></p>
                <input class="w3-input w3-border" type="text" placeholder="How many?">
                <p><label><i class="fa fa-user"></i> Send To</label></p>
                <input class="w3-input w3-border" type="text" placeholder="Enter email">
                <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">PAY <i class="fa fa-check"></i></button>
                <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
                <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
              </div>
            </div>
          </div>



          <!-- The Contact Section -->
          <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-center">CONTACTO</h2>
            <p class="w3-opacity w3-center"><i>¿Eres un fan? ¡Deja una nota!</i></p>
            <div class="w3-row w3-padding-32">
              <div class="w3-col m6 w3-large w3-margin-bottom">
                <i class="fa fa-map-marker" style="width:30px"></i> Texcoco, MEXICO<br>
                <i class="fa fa-phone" style="width:30px"></i> Phone: +00 151515<br>
                <i class="fa fa-envelope" style="width:30px"> </i> Email: soporte@eroyalstyle.com<br>
              </div>
              <div class="w3-col m6">
                <!--<form action="contacto.php" method="post" target="_blank">-->
                  <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                    <div class="w3-half">
                      <input class="w3-input w3-border" type="text" placeholder="Nombre" required name="nombre_cliente" id="nombre_cliente">
                    </div>
                    <div class="w3-half">
                      <input class="w3-input w3-border" type="text" placeholder="Email" required name="correo" id="correo">
                    </div>
                  </div>
                  <input class="w3-input w3-border" type="text" placeholder="Mensaje" required name="mensaje" id="mensaje">
                  <button onclick="contacto()" class="w3-button w3-black w3-section w3-right">ENVIAR</button>
                <!--</form>-->
                <br>
                <br>
                <br>
                <div id="contacto"></div>
              </div>
            </div>
          </div>

          <!-- End Page Content -->
        </div>

        <!-- Web Service Section -->
        <div id="map"></div>
        <script src="js/mapa.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC28mrpJiyL8EEu5JgyvTahqnQRB3kc21Y&callback=iniciarMap"></script>

        <!-- Footer -->
        <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
          <i class="fa fa-facebook-official w3-hover-opacity"></i>
          <i class="fa fa-instagram w3-hover-opacity"></i>
          <i class="fa fa-snapchat w3-hover-opacity"></i>
          <i class="fa fa-pinterest-p w3-hover-opacity"></i>
          <i class="fa fa-twitter w3-hover-opacity"></i>
          <i class="fa fa-linkedin w3-hover-opacity"></i>
          <p class="w3-medium"><a href="#" onclick="contrato()">Contrato de confidencialidad</a></p>
          <!--<p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>-->
        </footer>
      </div> <!-- Fin de DIV Resultado -->
    </div> <!-- Fin DIV mostrar_carrito -->
  </div> <!-- Fin de DIV Main -->
  </div> <!-- Fin de DIV contrato -->

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
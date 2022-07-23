<?php
include("funciones/conexion.php");

if (isset($_POST['insertar'])) {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $cargarImagen = ($_FILES['imagen']['tmp_name']);
    $imagen = fopen($cargarImagen, 'rb');

    $insertarPJ = $conexion->prepare("INSERT INTO productos(nombre, id_tipo, precio, cantidad, descripcion, imagen) VALUES (:nombre, :tipo, :precio, :cantidad, :descripcion, :imagen)");
    $insertarPJ->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $insertarPJ->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $insertarPJ->bindParam(':precio', $precio, PDO::PARAM_STR);
    $insertarPJ->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
    $insertarPJ->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $insertarPJ->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
    $insertarPJ->execute();

    if ($insertarPJ) {
        $mensaje = "<script>swal('¡OK!', 'Producto registrado', 'success')</script>";
    } else {
        $mensaje = "<script>swal('¡Atención!', 'Algo salió mal', 'error')</script>";
    }
}
?>

<?php
include("funciones/conecta.php");
include("funciones/config.php");
include("funciones/conectividad.php");
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

    <!--========== JQuery ==========-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--========== API para hacer graficas ==========-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Script para cargar pagina -->
    <script src="js/cargarPagina.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/formularios.css">


    <title>E-Royal Style Admins</title>

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



        /*********** Ir al formulario de inicio de sesión mediante AJAX ***********/
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

        /*********** Ir al formulario de inicio de sesión mediante AJAX ***********/
        function grafica() {
            //console.log(playera);
            //var id_producto = $('#id_producto').val();
            var categoria = $('#categoria').val();
            var url = "";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "categoria": categoria
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#grafico_Pastel").html(data);
                },
                error: function(data) {
                    $("#grafico_Pastel").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>

    <!--========== Regresar al Stock de productos mediante AJAX ==========-->
    <script>
        function regresar_stock() {
            $.ajax({
                type: "POST",
                url: "mostrarProductos.php",
                //url: url,
                //data: parametros,
                success: function(data) {
                    $("#resultado_stock").html(data);
                },
                error: function(data) {
                    $("#resultado_stock").html("El recurso buscado no se encuentra");
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
                    <a class="nav-link" href="index_administradores.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="cargarPagina('mostrarProductos.php')">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="cargarPagina('mostrarUsuarios.php')">Usuarios</a>
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
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class='bx bx-search-alt-2'></i></button>
            </form>

        </div>
    </nav>

    <!-- CONTENIDO -->
    <!-- Page content -->
    <div id="resultado_stock">
    <div id="contrato">
        <div id="main">
            <div id="mostrar_carrito">
                <div id="resultado">
                    <div class="w3-content" style="max-width:2000px;margin-top:46px">
                        <div id="resultado">
                            <div id="main">
                                <div id="container">
                                    <h2>Productos</h2>
                                    <p>Registro de productos E-Royal Style</p>
                                    <?php echo $mensaje; ?>
                                    <form name=fregistro id="registro" method="POST" action="" enctype="multipart/form-data">
                                        <center>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Nombre: </td>
                                                        <td><input type="text" placeholder="Nombre del producto" id="nombre" name="nombre" required></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2" align="center">Categoria:
                                                            <select name="tipo" id="tipo">
                                                                <option value="1">Playeras</option>
                                                                <option value="2">Calcetines</option>
                                                                <option value="3">Gorras</option>
                                                                <option value="4">Chamarras</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Precio: </td>
                                                        <td><input type="text" placeholder="Precio del producto" id="precio" name="precio" required></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Cantidad: </td>
                                                        <td><input type="number" placeholder="Cantidad de producto" id="cantidad" name="cantidad" required></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Descripcion: </td>
                                                        <td><input type="text" placeholder="Agrega una decripción" id="descripcion" name="descripcion" required></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Imagen: </td>
                                                        <td><input class="simagen" type="file" id="imagen" name="imagen" required></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </center>
                                        <button class="register" name="insertar" type="submit" value="Insertar personaje">Registrar</button>

                                    </form>
                                    <button onclick="regresar_stock()" class="back">Stock</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Fin de DIV Resultado -->
            </div> <!-- Fin DIV mostrar_carrito -->
        </div> <!-- Fin de DIV Main -->
    </div> <!-- Fin de DIV contrato -->
    </div> <!-- Fin de DIV resultado_stock -->

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





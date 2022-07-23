<?php
include("funciones/conecta.php");
include("funciones/config.php");
include("funciones/conectividad.php");
session_start();

$query2 = "SELECT nombre_cliente, mensaje, fecha FROM contacto";
$productos2 = mysqli_query($conecta, $query2);
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

    <!-- Styles Grafica -->
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>

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

        /************************ Eliminar un correo con AJAX ************************/
		function eliminar_correo(nombre_cliente, correo, fecha) {
            var nombre_cliente = nombre_cliente;
            var correo = correo;
			var fecha = fecha;
            var url = "ec_logic.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "nombre_cliente": nombre_cliente,
                "correo": correo,
				"fecha": fecha
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "ec_logic.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#elimina_correo").html(data);
                },
                error: function(data) {
                    $("#elimina_correo").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>
</head>

<body>
        <div id="resultado_elimina_correo">
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
    <div id="contrato">
        <div id="main">
            <div id="mostrar_carrito">
                <div id="resultado">
                    <div class="w3-content" style="max-width:2000px;margin-top:46px">
                        <!-- Grafica estadística -->
                        <?php
                        $categoria = 1;
                        $pastel_jsonTable = 0;

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $categoria = ($_POST["categoria"]);
                        }

                        if ($categoria != 0) {
                            /*$pastel = $conn->query("SELECT productos.nombre, productos.cantidad, tipo_producto.id_tipo FROM productos, tipo_producto WHERE tipo_producto.id_tipo='1' AND productos.id_tipo='1';")*/
                            $pastel = $conn->query("SELECT * FROM tipo_producto P JOIN productos T ON P.id_tipo = T.id_tipo WHERE P.id_tipo='$categoria';");

                            $pastel_rows = array();
                            $pastel_table = array();

                            $pastel_table['cols'] = array(

                                array('label' => 'Producto', 'type' => 'string'),
                                array('label' => 'Cantidad', 'type' => 'number')

                            );

                            foreach ($pastel as $p) {
                                $pastel_temp = array();

                                $pastel_temp[] = array('v' => (string) $p['nombre']);
                                $pastel_temp[] = array('v' => (int) $p['cantidad']);

                                $pastel_rows[] = array('c' => $pastel_temp);
                            }

                            $pastel_table['rows'] = $pastel_rows;

                            $pastel_jsonTable = json_encode($pastel_table);
                        }
                        ?>

                        <script type="text/javascript">
                            google.load('visualization', '1', {
                                'packages': ['corechart']
                            });

                            <?php
                            //echo "ok";
                            if ($categoria != 0) {

                            ?>
                                google.setOnLoadCallback(drawChartPastel);

                                function drawChartPastel() {
                                    var data = new google.visualization.DataTable(<?= $pastel_jsonTable ?>);
                                    var option = {
                                        title: "Stock de productos por categoria especificada",
                                        is3D: 'false',
                                        width: 900,
                                        height: 700
                                    };

                                    var chart = new google.visualization.PieChart(document.getElementById('grafico_Pastel'));
                                    chart.draw(data, option);
                                }
                            <?php
                            }
                            ?>
                        </script>

                        <!--===== script del scroll =====-->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var button = document.getElementById('grafico_Pastel');
                                button.onclick = function() {
                                    document.getElementById('container_grafica').scrollLeft += 20;
                                };
                            }, false);
                        </script>

                        <center>
                            <h2 class="w3-wide">BALANCE DE PRODUCTOS POR CATEGORIA</h1>
                                <!--<form method="post">-->
                                <div>
                                    <label for="categoria_tipo">Ingrese la categoria de la que desea saber el stock:</label>
                                    <!--<input type="number" class="form-control" name="categoria" id="categoria">-->
                                    <select name="categoria" id="categoria">
                                        <option value="1">Playeras</option>
                                        <option value="2">Calcetines</option>
                                        <option value="3">Gorras</option>
                                        <option value="4">Chamarras</option>
                                    </select>
                                </div>
                                <input type="button" onclick="grafica()" name="productos" class="btn btn-primary" value="Consultar">
                        </center>
                        <br>
                        <!--</form>-->
                        <center>
                            <div class="scroll_horizontal">

                                <?php
                                if ($categoria != 0) {
                                ?>
                                    <div id='grafico_Pastel'></div>
                                <?php
                                }
                                ?>
                            </div>
                        </center>

                        <div class="w3-black" id="tour">
                            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
                                <h2 class="w3-wide w3-center">Echale un vistazo...</h2>
                                <p class="w3-opacity w3-center"><i>Correos recientes de los usuarios</i></p><br>
                                <div class="table-responsive-sm">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="blanco" scope="col">Remitente</th>
                                                <th class="blanco" scope="col">Mensaje</th>
                                                <th class="blanco" scope="col">Fecha</th>
                                                <th class="blanco" scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row2 = mysqli_fetch_assoc($productos2)) : ?>

                                                <tr>
                                                    
                                                    <th class="blank"><?php echo $row2['nombre_cliente']; ?></th>
                                                    <td class="blank"><?php echo $row2['mensaje']; ?></td>
                                                    <td class="blank"><?php echo $row2['fecha']; ?></td>
                                                    <td>
                                                        <!-- Eliminar -->
                                                        <button onclick="eliminar_correo('<?php echo $row2['nombre_cliente']; ?>','<?php echo $row2['mensaje']; ?>','<?php echo $row2['fecha']; ?>')" class="btn btn-danger" name="eliminar"><i class='bx bx-trash'></i></button>
                                                    </td>
                                                </tr>

                                            <?php endwhile; ?>
                                            <div id="elimina_correo"></div>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- End Page Content -->
                    </div>


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
    </div>

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
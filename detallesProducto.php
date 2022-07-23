<?php
    include("funciones/validarUser.php");
?>
<?php
session_start();
    include("funciones/conecta.php");
    include("funciones/config.php");
    //include("carrito.php");

    $id_producto = $_POST['id_producto'];

    $sql = "SELECT * FROM productos WHERE id_producto='" . $id_producto . "'";
    $result = $conecta->query($sql);

    $nombre = $_POST["nombre"];
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap">

    <script>
    /************************ Función para agregar un producto + CANTIDAD al carrito mediante AJAX ************************/
        function enviaDatosCarritoCantidad(playera, nombre, precio) {
            //console.log(playera);
            //var id_producto = $('#id_producto').val();
            var id_producto = playera;
            var nombre = nombre;
            var precio = precio;
            //var cantidad = cantidad;
            var cantidad = $('#cantidad').val();
            var btnAccion = $('#btnAccion').val();
            var url = "carrito.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_producto": id_producto,
                "nombre": nombre,
                "precio": precio,
                "cantidad": cantidad,
                "btnAccion": btnAccion
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "carrito.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#resu").html(data);
                },
                error: function(data) {
                    $("#resu").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    
    </script>

    <style>
        .container-fluid {
            display: flex;
        }

        @media only screen and (max-width: 500px) {
            .container-fluid {
                display: inline;
            }
        }
    </style>

</head>

<body>
    <div id="mostrar_carrito">
    <div id="resultado">
    <!------------------------ Contenedor de los detalles del producto ------------------------>
    <div class="container-fluid">
        <div class="product-image">
            <?php
            foreach ($result as $producto) {
                echo '<div class="container">
                            <img class="img-responsive" src="data:image/jpg;base64, ' . base64_encode($producto['imagen']) . '" alt="imagen de producto" width="350" height="345">
                          </div>';
                /*echo '<img class="product-image" src="data:image/jpg;base64, ' . base64_encode($producto['imagen']) . '">';*/
            }
            ?>
        </div>
        <div class="product-info">
            <div class="product-title">
                <?php echo $nombre; ?>
            </div>
            <div class="product-sku">
                <?php echo "sku: " . $id_producto; ?>
            </div>
            <div class="product-price">
                <?php echo "$" . $precio; ?>
            </div>
            <div class="product-description">
                <?php echo $descripcion; ?>
            </div>

            <?php foreach ($result as $producto) { ?>
                <!--<form action="" method="post">-->
                    <input type="hidden" name="id_producto" id="id_producto" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                    <b>Cantidad</b> <br><input type="number" name="cantidad" id="cantidad" min="1" max="10" step="1" >
                    <!--<button class="btn btn-success" name="btnAccion" , value="Agregar" type="submit">Añadir</button>-->
                    <input type="button" onclick="enviaDatosCarritoCantidad('<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>','<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>','<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>');" class="btn btn-success" id="btnAccion" , name="btnAccion" , value="Agregar">
                <!--</form>-->
            <?php } ?>
            <!--Cantidad <input type="number" min="1" max="10" step="1">;-->
        </div>
    </div>

    <!------------------------ Información adicional ------------------------>
    <div class="product-additional">
        <table class="table-info">
            <tbody>
                <tr>
                    <td class="text-center one">
                        <i class='bx bxl-shopify'></i>
                        <br>
                        <b>Envio gratis a partir de $499</b>
                        <br>
                        Recíbelo de 2 a 7 días

                    </td>
                    <td class="text-center two">
                        <i class='bx bx-medal'></i>
                        <br>
                        <b>Cambios y garantía</b>
                        <br>
                        Hasta 1 año de garantía
                    </td>
                    <td class="text-center three">
                        <i class='bx bx-lock'></i>
                        <br>
                        <b>Compras seguras</b>
                        <br>
                        Tu información está protegida
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <center>Hokage's Store, Todos los derechos reservados <i class='bx bx-copyright'></i> 2022</center>
    </div>

    </section>

    <!------------------------ Icono Whatsapp flotante ------------------------>
    <a href="https://api.whatsapp.com/send?phone=5951218621" class="btn-wsp" target="_blank">
        <i class="fa fa-whatsapp icono"></i>
    </a>
    </div> <!-- Fin DIV resultado -->
    </div> <!-- Fin DIV mostrar_carrito -->

    <script>
        let arrow = document.querySelectorAll(".arrow");

        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                console.log(arrowParent);
                arrowParent.classList.toggle("showMenu");
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>

    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/titulo_categoria.js"></script>

</body>

</html>
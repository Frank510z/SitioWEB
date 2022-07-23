<?php
session_start();
include("funciones/conecta.php");
include("funciones/config.php");
//include("carrito.php");

$sql = "select * from productos where id_tipo='1'";
$result = $conecta->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/categorias.css">

    <!-- Script para cargar pagina -->
    <script src="js/cargarPagina.js"></script>

    <script>
        /************************ Función para agregar un producto al carrito mediante AJAX ************************/
        function enviaDatosCarrito(playera, nombre, precio, cantidad) {
            //console.log(playera);
            //var id_producto = $('#id_producto').val();
            var id_producto = playera;
            var nombre = nombre;
            var precio = precio;
            var cantidad = cantidad;
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

        /************************ Función para ir a la pagina de detalles y mostrar datos del producto mediante AJAX ************************/
        function detallesProducto(playera, nombre, precio, descripcion) {
            //console.log(playera);
            //var id_producto = $('#id_producto').val();
            var id_producto = playera;
            var nombre = nombre;
            var precio = precio;
            var descripcion = descripcion;
            //var btnAccion = $('#btnAccion').val();
            var url = "detallesProducto.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_producto": id_producto,
                "nombre": nombre,
                "precio": precio,
                "descripcion": descripcion
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "detallesProducto.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#product_details").html(data);
                },
                error: function(data) {
                    $("#product_details").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>

    <title>Responsive sidebar submenus</title>
</head>

<body>
    <div id="product_details">
    <div id="mostrar_carrito">
    <div id="resultado">
        <!-- Este DIV es el resultado de la función "Iniciar_Sesion" que esta en la pagina "index" el cual es mandar a traer el formulario de inicio de sesión" -->

        <h1>Playeras</h1>
        <!--========== CONTENTS ==========-->
        <main>
            <!------------------------ Sección de productos ------------------------>
            <div class="products-grid">
                <?php foreach ($result as $producto) { ?>
                    <div class="product" id="producto">
                        <?php echo '<img class="product-image" src="data:image/jpg;base64, ' . base64_encode($producto['imagen']) . '">'; ?>
                        <div class="product-info">
                            <p><?php echo $producto['nombre']; ?></p>
                            <!--<p>Playera Bart Simpson</p>-->
                            <div class="price">
                                <span>$<?php echo $producto['precio']; ?></span>
                                <!--<del>$200</del>-->
                            </div>
                            <br>

                            <!--<form id="frmAgregaProducto" onsubmit="mandaDatos(); return false" >-->
                            <input type="hidden" name="id_producto" id="id_producto" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1; ?>">
                            <input type="button" onclick="enviaDatosCarrito('<?php echo openssl_encrypt($producto['id_producto'], COD, KEY); ?>','<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>','<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>','<?php echo 1; ?>');" class="btn btn-success" id="btnAccion" , name="btnAccion" value="Agregar">


                            <!--</form>-->
                            <div id="mensaje"></div>
                            <div id="resultado"></div>

                            <!--<form action="detallesProducto.php" method="post">-->
                            <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $producto['id_producto']; ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre']; ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio']; ?>">
                            <input type="hidden" name="descripcion" id="descripcion" value="<?php echo $producto['descripcion']; ?>">

                            <!--<button class="btn btn-primary" name="Detalles" type="submit">Detalles</button>-->
                            <input type="button" onclick="detallesProducto('<?php echo $producto['id_producto']; ?>','<?php echo $producto['nombre']; ?>','<?php echo $producto['precio']; ?>','<?php echo $producto['descripcion']; ?>');" class="btn btn-primary" name="Detalles" value="Detalles">
                            <!--</form>-->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>

        
    </div> <!-- Fin DIV Resultado -->
    </div> <!-- FIN DIV mostrar_carrito -->
    </div> <!-- FIN DIV product_details -->
    


</body>

</html>
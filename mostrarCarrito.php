<?php
//include("funciones/validarUser.php");
session_start();
?>
<?php
    include("funciones/conecta.php");
    include("funciones/config.php");
    //include("carrito.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/mostrar_carrito.css">

    <title>Carrito</title>

    <!-- Script para cargar pagina -->
    <script src="js/cargarPagina.js"></script>

    <script>
        function enviaDatosCarrito(producto) {
            //console.log(playera);
            //var id_producto = $('#id_producto').val();
            var id_producto = producto;
            var btnAccion = $('#btnAccion').val();
            var url = "carrito.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_producto": id_producto,
                "btnAccion": btnAccion
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "carrito.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#eliminado").html(data);
                },
                error: function(data) {
                    $("#eliminado").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>
</head>
<body class="compra">
    <div id="resultado">
    <div id="producto_eliminado">  
    <div id="eliminado">
    <center><h3 class="w3-wide">Lista de carrito</h3></center>
    <br>
    <?php if(!empty($_SESSION['carrito'])) { ?>
    <table class="table">
        <tbody>
            <tr>
                <th width="40%">Descripción</th>
                <th width="15%" class="text-center">Cantidad</th>
                <th width="20%" class="text-center">Precio</th>
                <th width="20%" class="text-center">Total</th>
                <th width="5%" class="text-center">--</th>
            </tr>

            <?php $total=0; ?>
            <!-- Despliega todos los productos que hemos seleccionado en el carrito de compras -->
            <?php foreach($_SESSION['carrito'] as $indice=>$producto){?>
            <tr>
                <td width="40%"><?php echo $producto['nombre'] ?></td>
                <td width="15%" class="text-center"><?php echo $producto['cantidad'] ?></td>
                <td width="20%" class="text-center"><?php echo $producto['precio'] ?></td>
                <td width="20%" class="text-center">$<?php echo number_format($producto['precio'] * $producto['cantidad'],2); ?></td>
                <td width="5%">
                    <!--<form action="" method="post">-->
                        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo openssl_encrypt($producto['id_producto'], COD, KEY);?>">
                        <input type="button" onclick="enviaDatosCarrito('<?php echo openssl_encrypt($producto['id_producto'], COD, KEY);?>');" class="btn btn-danger" id="btnAccion" , name="btnAccion" value="Eliminar">
                    <!--</form>-->
                </td>
                
            </tr>
            <?php $total=$total+($producto['precio'] * $producto['cantidad']); ?>
            <?php } ?>
            
            <!-- Muestra el total que hay que pagar por todo -->
            <tr>
                <td colspan="4" align="right"><h3>Total</h3></td>
                <td align="right"><h3>$<?php echo number_format($total,2); ?></h3></td>
            </tr>
            
        </tbody>
    </table>

    <form action="pagar.php" method="post">
                    <div class="alert alert-success">
                        <center><img src="img/PayPal-logo.png" alt="paypal" width="250" height="150"></center>
                        <div class="form-group">
                            <br>
                            <!--<input type="text" value="</*?php echo number_format($total,2); ?*/>" name="monto">-->
                            <center><label for="my-input">Correo de contacto:</label></center>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Por favor escribe tu correo" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            <center>Ingresa tu correo asociado a PayPal para procesar el pago</center>
                        </small>
                    </div>
                    <br>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="proceder">Proceder a pagar >></button><
                    </form>
    
    <?php } else{ ?>
        <div class="alert alert-success">
            No hay productos en el carrito...
        </div>
    <?php } ?>
    </div>
    </div>
    </div>
</body>
</html>
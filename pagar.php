<?php
    session_start();
    include("funciones/conecta.php");
    include("funciones/config.php");
    include("funciones/phpqrcode/qrlib.php");
    include("carrito.php");

    $dir='qr/';
?>

<?php
    if ($_POST) {
        $total=0;
        $sid=session_id();
        $correo=$_POST['email'];
        $monto=$_POST['monto'];
        //$tipoev=$_POST['tipoev']; // tipoevento
	    //$fechaev=$_POST['fechaev']; // fecha evento
	    //$lugarev=$_POST['lugarev']; //lugar evento
	    //$fev=str_replace("-", "", $fechaev);

        

        foreach($_SESSION['carrito'] as $indice=>$producto) {
            $total = $total + ($producto['precio'] * $producto['cantidad']);
        }

        $sentencia = $pdo->prepare("INSERT INTO `ventas` (`id_venta`, `clave_transaccion`, `fecha`, `correo_paypal`, `total`) VALUES (NULL, :clave_transaccion, NOW(), :correo, :total);");
        $sentencia->bindParam(":clave_transaccion",$sid);
        $sentencia->bindParam(":correo",$correo);
        $sentencia->bindParam(":total",$total);
        $sentencia->execute();

    
			//echo "Registro correcto";
            $idVenta=$pdo->lastInsertId();

        foreach($_SESSION['carrito'] as $indice=>$producto) {
            $sentencia = $pdo->prepare("INSERT INTO `detalle_venta` (`id_dv`, `id_venta`, `id_producto`, `precio_unitario`, `cantidad`) VALUES (NULL,:IDVENTA,:IDPRODUCTO,:PRECIOUNITARIO,:CANTIDAD);");
                $sentencia->bindParam(":IDVENTA",$idVenta);
                $sentencia->bindParam(":IDPRODUCTO",$producto['id_producto']);
                $sentencia->bindParam(":PRECIOUNITARIO",$producto['precio']);
                $sentencia->bindParam(":CANTIDAD",$producto['cantidad']);
                $sentencia->execute();
                //echo "Registro correctoooo";
          
        }

        $royal = 'https://www.eroyalstyle.com/mostrarQR.php?idVenta=';

	    $hring=date("G");
	    $ming=date("i");
        $random=rand(1, 999999);
	    $evento=$correo . $monto . $hring . $ming . $random;
	    $filename=$dir.$evento.".png";
        

        $tam=10; //tamaño
	    $nivel='M'; //calidad
	    $fs=3; //tamaño de borde
	    //$url="https://www.eroyalstyle.com/";
        $url= $royal . $idVenta;
	    //echo "Codigo de evento: " . $evento;
	    QRcode::png($url, $filename, $nivel, $tam, $fs);
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Beastly&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- script para transacciones de paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <style>
        body {
            background-color: white;
        }
    </style>

   

</head>
<body>
    
    
    <!--<script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons().render({
            env: 'sandbox',
            style: {
                
                layout: 'horizontal'
            },
        
            client: {
                sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt40gqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                production: '<insert production client id>'
            },

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?php echo $total ?>', currency: 'MXN' }
                            }
                        ]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }
        
        }, '#paypal-button-container');

    </script>-->

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                layout: 'horizontal'
            },

            client: {
                sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt40gqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                production: '<insert production client id>'
            },

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?php echo $total ?>', currency: 'MXN' }
                            }
                        ]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }
            
            

        }).render('#paypal-button-container');
    </script>
    
    <div class="jumbotron text-center">
        <h1 class="display-4">¡Todo listo!</h1>
        <hr class="my-4">
        <p class="lead">Has pagado la cantidad de:
            <h4>$<?php echo number_format($total,2); ?></h4>
            <!--<center><div id="paypal-button-container"></div></center>-->
        </p>
        <p>¡Gracias por elegir E-Royal Style!</br>
            <br>
            <p>Escanea el codigo QR para ver los productos que has comprado</p>
            <img class="product-image" src="<?php echo $filename; ?>">
            <br>
            <strong>(para mas aclaraciones: soporte@eroyalstyle.com)</strong>
            <br>
            <br>
            <center><a href="index.php">¡OK!</a></center>
            <?php session_destroy() ?>
        </p>
    </div>
    
    
</body>
</html>




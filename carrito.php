
<?php
session_start();
//include("funciones/validarUser.php");
include("funciones/conecta.php");
//echo "<script>alert('SI LLEGA AL PHP CARRITO');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <!--========== BOX ICONS ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js" integrity="sha512-QE2PMnVCunVgNeqNsmX6XX8mhHW+OnEhUhAWxlZT0o6GFBJfGRCfJ/Ut3HGnVKAxt8cArm7sEqhq2QdSF0R7VQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="cuerpo">

<?php
//$respuesta = new stdClass();


$varsesion = $_SESSION['usuario'];

if ($varsesion == null || $varsesion = '') {
    echo "<script>swal('¡No has iniciado sesión!', 'Inicia sesión para poder realizar compras', 'error')</script>";
    echo 0;
}
else {



    if (isset($_POST['btnAccion'])) {
       // echo "<script>alert('SI LLEGA a if');</script>";
        
        //echo "<script>alert('ENTRASTE AL IF');</script>";
        switch ($_POST['btnAccion']) {
            case 'Agregar':
                //echo "<script>alert('ENTRASTE AL CASE AGREGAR');</script>";
                if (is_numeric(openssl_decrypt($_POST['id_producto'], COD, KEY ))) {
                    $id_producto = openssl_decrypt($_POST['id_producto'], COD, KEY );
                    //$mensaje.= "<script>alert('ID CORRECTO');</script>";
                    //echo "<script>alert('ID CORRECTO');</script>";
                }

                else {
                    $mensaje.= "Ups... algo pasa con el id"."<br/>"; break;
                    //echo "<script>alert('ERROR EN EL ID');</script>";
                }

                if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                    $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                    $mensaje.= "Ok nombre" .$nombre."<br/>";
                }

                else {
                    $mensaje.= "Ups... algo pasa con el nombre"."<br/>"; break;
                }

                if (is_numeric($_POST['cantidad'])) {
                    $cantidad = $_POST['cantidad'];
                    $mensaje.= "Ok cantidad" .$cantidad."<br/>";
                }

                else {
                    $mensaje.= "Ups... algo pasa con la cantidad"."<br/>"; break;
                }

                if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                    $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                    $mensaje.= "Ok precio" .$precio."<br/>";
                }

                else {
                    $mensaje.= "Ups... algo pasa con el precio"."<br/>"; break;
                }

                /*if (is_numeric(openssl_decrypt($_POST['talla'], COD, KEY))) {
                    $talla = openssl_decrypt($_POST['talla'], COD, KEY);
                    $mensaje.= "Ok talla" .$talla."<br/>";
                }

                else {
                    $mensaje.= "Ups... algo pasa con la talla"."<br/>"; break;
                }*/

                if (!isset($_SESSION['carrito'])) {
                    $producto = array(
                        'id_producto' => $id_producto,
                        'nombre' => $nombre,
                        'cantidad' => $cantidad,
                        'precio' => $precio
                    );

                    $_SESSION['carrito'][0] = $producto;
                    echo "<script>swal('¡Ok!', 'añadido', 'success')</script>";
                    echo $productoInicial = count($_SESSION['carrito']);
                    
                    
                }

                else {
                    $idProducts = array_column($_SESSION['carrito'], "id_producto");

                    if (in_array($id_producto, $idProducts)) {
                        echo "<script>swal('¡Atencion!', 'El producto ya ha sido seleccionado', 'info')</script>";
                    }

                    else {
                        $NumeroProductos = count($_SESSION['carrito'])+1;
                        $producto = array(
                            'id_producto' => $id_producto,
                            'nombre' => $nombre,
                            'cantidad' => $cantidad,
                            'precio' => $precio
                        );
                        
                        $_SESSION['carrito'][$NumeroProductos] = $producto;
                        $mensaje = "Producto agregado al carrito";
                        echo $NumeroProductos;
                        echo "<script>swal('¡Ok!', 'añadido', 'success')</script>";
                        
                        //$respuesta->mensaje = 'agregado';
                        

                        //echo "<script>swal('¡Ok!', 'añadido', 'success')</script>";
                        
                        //echo "ok";
                       
                    }
                }

                //$mensaje = print_r($_SESSION,true);
            break;

            case 'Eliminar':
                //echo "<script>alert('SI LLEGA a if eliminar');</script>";
                if (is_numeric(openssl_decrypt($_POST['id_producto'], COD, KEY ))) {
                    $id_producto = openssl_decrypt($_POST['id_producto'], COD, KEY );

                    foreach($_SESSION['carrito'] as $indice=>$producto) {
                        if($producto['id_producto']==$id_producto){
                            unset($_SESSION['carrito'][$indice]);
                            //echo "<script>alert('Elemento borrado...')</script>";
                            //echo "Elemento borrado";
                        
                           //echo "<script>swal('¡OK!', 'El producto ya ha sido eliminado', 'success')</script>";
                            
                           echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script>
					jQuery(function(){
						swal({
							icon: "success",
							title: "¡Ok!",
							text: "Producto Eliminado"
						}).then(function() {
							$.ajax({
								type: "POST",
								url:"mostrarCarrito.php",
								//url: url,
								//data: parametros,
								success: function (data) {
									$("#shirts").html(data);
								},
								error: function (data) {
									$("#shirts").html("El recurso buscado no se encuentra");
								}
							});
						});
					});
				</script>"';


                        }
                    }
                }

                else {
                    $mensaje.= "Ups... id incorrecto" .$id_producto."<br/>";
                    //echo "Ups... id incorrecto";
                }
            break;
        }
    } else {
        //echo "<script>swal('¡Ok!', 'añadido', 'error')</script>";
    }

    //echo json_encode( $respuesta );

}
?>
</body>
</html>
<?php
include("funciones/conecta.php");
include("funciones/config.php");

$idV = $_GET['idVenta'];
//echo $idV;

$query = "SELECT detalle_venta.id_venta, detalle_venta.id_producto, productos.nombre, detalle_venta.precio_unitario, detalle_venta.cantidad FROM detalle_venta INNER JOIN productos WHERE detalle_venta.id_venta='" . $idV . "' AND detalle_venta.id_producto=productos.id_producto";
$productos = mysqli_query($conecta, $query);

//FROM detalle_venta INNER JOIN productos WHERE detalle_venta.id_venta='168' AND detalle_venta.id_producto=productos.id_producto

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!--========== BOX ICONS ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>QR</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4 mb-4">Tus compras:</h1>

        <div class="row">
            <div class="col-sm-12">
                <table class="table mt-2">
                    <thead>
                        <tr>
                            
                            
                            <th scope="col">nombre</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($productos)) : ?>

                            <tr>
                            
                                <th><?php echo $row['nombre']; ?></th>
                                <td><?php echo $row['precio_unitario']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                            </tr>

                        <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
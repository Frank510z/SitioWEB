<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--========== Sweet Alert ==========-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    
</body>
</html>
<?php
    include("funciones/conecta.php");
    include("funciones/config.php");

    session_start();

    $persona = $_SESSION['usuario'];
    //echo $persona;
    if (isset($_POST['nombre_cliente']) || isset($_POST['correo']) || isset($_POST['mensaje'])) {
        
        $nombre_cliente = $_POST["nombre_cliente"];
        $correo = $_POST["correo"];
        $mensaje = $_POST["mensaje"];

        if (!isset($nombre_cliente) || $nombre_cliente == NULL || !isset($correo) || $correo == NULL || !isset($mensaje) || $mensaje == NULL) {
            echo "<script>swal('¡Advertencia!', 'Llene los campos vacios', 'info')</script>";
        } else {

            $sql = "SELECT id_cliente FROM usuarios WHERE usuario='$persona'";
            $resultado = mysqli_query($conecta, $sql);
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                $id_cliente = $row['id_cliente'];
            }

            $sql_contacto = "INSERT INTO contacto(id_cliente,nombre_cliente,correo,mensaje,fecha) VALUES('$id_cliente','$nombre_cliente','$correo','$mensaje',NOW())";

            $data = mysqli_query($conecta, $sql_contacto);
            
            if ($data) {
                //echo "<script>alert('INSERSION CORRECTA');</script>";
                echo "<script>swal('¡Gracias por tus comentarios!', 'Tus comentarios nos ayudan a mejorar', 'success')</script>";
            }
            
            else {
                echo "<div class='alert alert-danger' role='alert'>
                Inicia sesión para mandar un correo.
              </div>";
            }
        }
    }
?>


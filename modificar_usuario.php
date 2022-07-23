<?php
//include("funciones/validarUser.php");
?>
<?php
include("funciones/conecta.php");

if (mysqli_connect_error()) {
    echo "Error al conectar la BD";
} else {
    //echo "Si se puede conectar a la BD <br>";
    $nombre_user = $_POST['nombre'];
    $query = "SELECT * FROM usuarios WHERE nombre='" . $nombre_user . "'";
    $producto = mysqli_query($conecta, $query);
    $row = mysqli_fetch_assoc($producto);
}
?>
<?php
$query = "SELECT id_cliente, nombre, usuario, correo, nivel, statu FROM usuarios";
$productos2 = mysqli_query($conecta, $query2);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!------------------- AJAX ---------------------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/formularios.css">

    <!--========== Regresar al Stock de usuarios mediante AJAX ==========-->
    <script>
        function regresa() {
            console.log("SI SE PRESIONA BTN REGRESAR");
            $.ajax({
                type: "POST",
                url: "mostrarUsuarios.php",
                //url: url,
                //data: parametros,
                success: function(data) {
                    $("#regresar_crud").html(data);
                },
                error: function(data) {
                    $("#regresar_crud").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>

    <!--========== Mandar los datos para realizar la MODIFICACION del registro con AJAX ==========-->
    <script>
        function modifica() {
            var nombre = $('#nombre').val();
            var dire = $('#usuario').val();
            var tel = $('#cargo').val();
            var mail = $('#correo').val();
            var url = "mu_logic.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "nombre": nombre,
                "usuario": dire,
                "cargo": tel,
                "correo": mail
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "mu_logic.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#res").html(data);
                },
                error: function(data) {
                    $("#res").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>

    <title>Modificar usuario</title>
</head>

<body>
    <div id="regresar_crud">
    <div id="container">
        <div id="res"></div>
        <h2><label for="nombreUser"><?php echo $row['nombre']; ?></label></h2>
        <p>Actualiza usuario</p>
        <!--<form name=fregistro id="registro" method="POST" action="">-->
        <center>
            <table>
                <tbody>
                    <tr>
                        <td>Nombre: </td>
                        <td><input type="text" placeholder="Ingresa nombre" id="nombre" name="nombre" required value="<?php echo $row['nombre']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Usuario: </td>
                        <td><input type="text" placeholder="Ingresa nickname" id="usuario" name="usuario" required value="<?php echo $row['usuario']; ?>"></td>
                    </tr>

                    <tr>
                        <td>Cargo: </td>
                        <td><input type="text" placeholder="1.Admin 2.Cliente" id="cargo" name="cargo" required value="<?php echo $row['nivel']; ?>"></td>
                    </tr>

                    <tr>
                        <td>Correo: </td>
                        <td><input type="mail" placeholder="Ingresa correo" id="correo" name="correo" required value="<?php echo $row['correo']; ?>"></td>
                    </tr>
                

                </tbody>
            </table>
        </center>
        
        <br>
        <button onclick="modifica()" class="btn-modifica">Modificar</button>
        <button onclick="regresa()" class="back">Cancelar</button>
        <!--</form>-->
    </div>
    </div>
</body>

</html>
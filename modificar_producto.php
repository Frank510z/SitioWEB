<?php
//include("funciones/validarUser.php");
?>
<?php
include("funciones/conecta.php");

if (mysqli_connect_error()) {
    echo "Error al conectar la BD";
} else {
    //echo "Si se puede conectar a la BD <br>";
    $nombre_product = $_POST['nombre'];
    $query = "SELECT * FROM productos WHERE nombre='" . $nombre_product . "'";
    $producto = mysqli_query($conecta, $query);
    $row = mysqli_fetch_assoc($producto);
}
?>
<?php
$query = "SELECT id_producto, nombre, precio, cantidad, descripcion FROM productos";
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
        function regresa_productos() {
            console.log("SI SE PRESIONA BTN REGRESAR");
            $.ajax({
                type: "POST",
                url: "mostrarProductos.php",
                //url: url,
                //data: parametros,
                success: function(data) {
                    $("#regresar_crud_productos").html(data);
                },
                error: function(data) {
                    $("#regresar_crud_productos").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>

    <!--========== Mandar los datos para realizar la MODIFICACION del registro con AJAX ==========-->
    <script>
        function modifica_producto() {
            var nombre = $('#nombre').val();
            var dire = $('#precio').val();
            var tel = $('#cantidad').val();
            var mail = $('#descripcion').val();
            var url = "mp_logic.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "nombre": nombre,
                "precio": dire,
                "cantidad": tel,
                "descripcion": mail
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "mp_logic.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#result_modifica").html(data);
                },
                error: function(data) {
                    $("#result_modifica").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
    </script>

    <title>Modificar producto</title>
</head>

<body>
    <div id="resultado_modifica_producto">
    <div id="regresar_crud_productos">
    <div id="container">
        <div id="result_modifica"></div>
        <h2><label for="nombreUser"><?php echo $row['nombre']; ?></label></h2>
        <p>Actualiza producto</p>
        <!--<form name=fregistro id="registro" method="POST" action="">-->
        <center>
            <table>
                <tbody>
                    <tr>
                        <td>Nombre: </td>
                        <td><input type="text" placeholder="Ingresa nombre" id="nombre" name="nombre" required value="<?php echo $row['nombre']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Precio: </td>
                        <td><input type="text" placeholder="Ingresa precio" id="precio" name="precio" required value="<?php echo $row['precio']; ?>"></td>
                    </tr>

                    <tr>
                        <td>Cantidad: </td>
                        <td><input type="text" placeholder="Ej. 12.40" id="cantidad" name="cantidad" required value="<?php echo $row['cantidad']; ?>"></td>
                    </tr>

                    <tr>
                        <td>Descripcion: </td>
                        <td><input type="text" placeholder="Ingresa descripción" id="descripcion" name="descripcion" required value="<?php echo $row['descripcion']; ?>"></td>
                    </tr>
                

                </tbody>
            </table>
        </center>
        
        <br>
        <button onclick="modifica_producto()" class="btn-modifica">Modificar</button>
        <button onclick="regresa_productos()" class="back">Cancelar</button>
        <!--</form>-->
    </div>
    </div>
    </div>
</body>

</html>
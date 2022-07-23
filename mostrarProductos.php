<?php
//include("funciones/validarUser.php");
?>
<?php
include("funciones/conecta.php");
include("funciones/config.php");
?>

<?php
session_start();
$persona = $_SESSION['usuario'];
?>

<?php

$query = "SELECT id_producto, nombre, precio, cantidad, descripcion FROM productos";
$productos = mysqli_query($conecta, $query);
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--========== BOX ICONS ==========-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

	<!--========== CSS ==========-->
	<link rel="stylesheet" href="css/styles.css">

	<!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!--========== CSS ==========-->
	<link rel="stylesheet" href="css/styles.css">

	<script src="js/cargarPagina.js"></script>

	<script>
		/************************ Mandar a llamar al fomulario de REGISTRO DE PRODUCTOS con AJAX ************************/
		function traerFormRegistroProductos() {
			$.ajax({
				type: "POST",
				url: "registrar_productos.php",
				//url: url,
				//data: parametros,
				success: function(data) {
					$("#registro_productos").html(data);
				},
				error: function(data) {
					$("#registro_productos").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}
		/************************ Mandar a llamar al fomulario de MODIFICACION DE PRODUCTOS con AJAX ************************/
		function traerFormModificarProducto(id_producto, nombre, precio, cantidad, descripcion) {
            var id_producto = id_producto;
            var nombre = nombre;
            var precio = precio;
            var cantidad = cantidad;
			var descripcion = descripcion;
            var url = "modificar_producto_logic.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_producto": id_producto,
                "nombre": nombre,
                "precio": precio,
                "cantidad": cantidad,
				"descripcion": descripcion
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "modificar_producto.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#form_modifica_producto").html(data);
                },
                error: function(data) {
                    $("#form_modifica_producto").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }

		function traerFormRegistro() {
			$.ajax({
				type: "POST",
				url: "registrar_productos.php",
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

		/************************ Eliminar un usuario con AJAX ************************/
		function eliminar_producto(id_producto, nombre, precio, cantidad, descripcion) {
            var id_producto = id_producto;
            var nombre = nombre;
            var precio = precio;
            var cantidad = cantidad;
			var descripcion = descripcion;
            var url = "ep_logic.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_producto": id_producto,
                "nombre": nombre,
                "precio": precio,
                "cantidad": cantidad,
				"descripcion": descripcion
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "ep_logic.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#elimina_producto").html(data);
                },
                error: function(data) {
                    $("#elimina_prducto").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
	</script>

	<title>Almacén</title>

	<style>
		.container_products {
            margin-top: 80px;
            margin-left: 30px;
            margin-right: 30px;
        }
	</style>
</head>

<body>
	<div id="registro_productos">
	<div id="form_modifica_producto">
	<div id="resultado_elimina_producto">
	<div id="elimina_producto"></div>
	<div id="main">
		<div class="container_products" id="resultado">
			<h1 class="text-center mt-4 mb-4">Almacén</h1>

			<a href="registrar_productos.php" class="btn btn-success w-100">Agregar producto</a>

			<div class="row">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Nombre</th>

								<th scope="col">Precio</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Descripción</th>
							</tr>
						</thead>

						<tbody>

							<?php while ($row = mysqli_fetch_assoc($productos)) : ?>

								<tr>
									<th><?php echo $row['id_producto']; ?></th>
									<td><?php echo $row['nombre']; ?></td>

									<td><?php echo $row['precio']; ?></td>
									<td><?php echo $row['cantidad']; ?></td>
									<td><?php echo $row['descripcion']; ?></td>

									<td>
										<!-- Modificar -->
										<button onclick="traerFormModificarProducto('<?php echo $row['id_producto']; ?>','<?php echo $row['nombre']; ?>','<?php echo $row['precio']; ?>','<?php echo $row['cantidad']; ?>','<?php echo $row['descripcion']; ?>')" class="btn btn-primary"><i class='bx bx-edit-alt'></i></button>
										
										<!-- Eliminar -->
										<button onclick="eliminar_producto('<?php echo $row['id_producto']; ?>','<?php echo $row['nombre']; ?>','<?php echo $row['precio']; ?>','<?php echo $row['cantidad']; ?>','<?php echo $row['descripcion']; ?>')" class="btn btn-danger"><i class='bx bx-trash'></i></button>
									</td>
								</tr>

							<?php endwhile; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
</body>

</html>
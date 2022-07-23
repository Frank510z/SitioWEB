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

$query2 = "SELECT id_cliente, nombre, usuario, correo, nivel, statu FROM usuarios";
$productos2 = mysqli_query($conecta, $query2);
?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--========== BOX ICONS ==========-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

	<!--========== Sweet Alert ==========-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!------------------- JQuery ---------------------->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	<!--========== CSS ==========-->
	<link rel="stylesheet" href="css/styles.css">

	<script>
		/************************ Mandar a llamar al fomulario de REGISTRO DE USUARIOS con AJAX ************************/
		function traerFormRegistro() {
			$.ajax({
				type: "POST",
				url: "registro_admins.php",
				//url: url,
				//data: parametros,
				success: function(data) {
					$("#registro_admins").html(data);
				},
				error: function(data) {
					$("#registro_admins").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}
        
		/************************ Mandar a llamar al fomulario de MODIFICACION DE USUARIOS con AJAX ************************/
		function traerFormModificar(id_cliente, nombre, usuario, correo, nivel, statu) {
            var id_cliente = id_cliente;
            var nombre = nombre;
            var usuario = usuario;
            var correo = correo;
			var nivel = nivel;
			var statu = statu;
            var url = "modificar_usuario.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_cliente": id_cliente,
                "nombre": nombre,
                "usuario": usuario,
                "correo": correo,
				"nivel": nivel,
				"statu": statu
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "modificar_usuario.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#form_modifica").html(data);
                },
                error: function(data) {
                    $("#form_modifica").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }

		/************************ Eliminar un usuario con AJAX ************************/
		function eliminar(id_cliente, nombre, usuario, correo, nivel, statu) {
            var id_cliente = id_cliente;
            var nombre = nombre;
            var usuario = usuario;
            var correo = correo;
			var nivel = nivel;
			var statu = statu;
            var url = "eu_logic.php";
            //console.log("Nombre: "+nombre+" Direccion: "+direccion);
            var parametros = {
                "id_cliente": id_cliente,
                "nombre": nombre,
                "usuario": usuario,
                "correo": correo,
				"nivel": nivel,
				"statu": statu
            };
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "eu_logic.php",
                //url: url,
                data: parametros,
                success: function(data) {
                    $("#elimina").html(data);
                },
                error: function(data) {
                    $("#elimina").html("El recurso buscado no se encuentra");
                }
            });
            //$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
        }
	</script>

	<title>Usuarios</title>

	<style>
		.container_users {
			margin-top: 80px;
            margin-left: 30px;
            margin-right: 30px;
		}
	</style>
</head>

<body>
	<div id="resultado_elimina">
	<div id="resultado_modifica">
	<div id="form_modifica">
	<div id="modificar">
	<div id="elimina"></div>
	<div id="regresar">
	
	<div id="resultado_agregar_user">
	<div class="container_users" id="registro_admins">
		<h1 class="text-center mt-4 mb-4">Usuarios existentes</h1>

		<a href="#" onclick="traerFormRegistro()" class="btn btn-success w-100">Agregar usuario</a>

		<div class="row">
			<div class="table-responsive">
				<table id="tbUsuarios" class="table">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nombre</th>

							<th scope="col">Nickname</th>
							<th scope="col">Correo</th>
							<th scope="col">Nivel</th>
							<th scope="col">Status</th>
							<!--<th id="mod" scope="col" width="1"></th>
							<th scope="col" width="1"></th>-->
						</tr>
					</thead>

					<tbody>

						<?php while ($row2 = mysqli_fetch_assoc($productos2)) : ?>

							<tr>
								<div id="aparte">
								<th><?php echo $row2['id_cliente']; ?></th>
								<td><?php echo $row2['nombre']; ?></td>

								<td><?php echo $row2['usuario']; ?></td>
								<td><?php echo $row2['correo']; ?></td>
								<td><?php echo $row2['nivel']; ?></td>
								<td><?php echo $row2['statu']; ?></td>
								</div>
								<td>
									<!-- Modificar -->
									<button onclick="traerFormModificar('<?php echo $row2['id_cliente']; ?>','<?php echo $row2['nombre']; ?>','<?php echo $row2['usuario']; ?>','<?php echo $row2['correo']; ?>','<?php echo $row2['nivel']; ?>','<?php echo $row2['statu']; ?>')" class="btn btn-primary" name="modificar"><i class='bx bx-edit-alt'></i></button>
									
									<!-- Eliminar -->
									<button onclick="eliminar('<?php echo $row2['id_cliente']; ?>','<?php echo $row2['nombre']; ?>','<?php echo $row2['usuario']; ?>','<?php echo $row2['correo']; ?>','<?php echo $row2['nivel']; ?>','<?php echo $row2['statu']; ?>')" class="btn btn-danger" name="modificar"><i class='bx bx-trash'></i></button>
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
	</div>
	</div>
	
</body>

</html>
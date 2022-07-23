<?php
include("funciones/conecta.php");
include("funciones/config.php");
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Regístrate</title>
	<link rel="stylesheet" href="css/styleregistro.css" />
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- Script para cargar pagina -->
	<script src="js/cargarPagina.js"></script>

	<script>
		function Registrarse() {
			var usuario = $('#usuario').val();
			var nombre = $('#nombre').val();
			var correo = $('#correo').val();
			var passw = $('#passw').val();
			var passw2 = $('#passw2').val();
			var url = "rc_logic.php";
			//console.log("Nombre: "+nombre+" Direccion: "+direccion);
			var parametros = {
				"usuario": usuario,
				"nombre": nombre,
				"correo": correo,
				"passw": passw,
				"passw2": passw2
			};
			console.log(parametros);
			$.ajax({
				type: "POST",
				url: "rc_logic.php",
				//url: url,
				data: parametros,
				success: function(data) {
					$("#resultado_registro").html(data);
				},
				error: function(data) {
					$("#resultado_registro").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}

		/******************** Validar contraseña ********************/
		function validar() {
			console.log("Se esta presionando");
			var mayus = new RegExp("^(?=.*[A-Z])");
			var special = new RegExp("^(?=.*[!@#$&*])");
			var numbers = new RegExp("^(?=.*[0-9])");
			var lower = new RegExp("^(?=.*[a-z])");
			//var len = new RegExp("^(?=.*{8,})");

			//$("#passw").on("keyup", function validar(){

			var pass = $("#passw").val();

			if (mayus.test(pass) && special.test(pass) && numbers.test(pass) && lower.test(pass)) {
				$("#mensaje").html("Segura").css("color", "green");
			} else {
				$("#mensaje").html("insegura").css("color", "red");
			}
			//});
		}

		/******************** Regresar al formulario de inicio de sesión mediante AJAX ********************/
		function Regreso_Login() {
			//console.log("OK");
			$.ajax({
				type: "POST",
				url: "iniciar_sesion.php",
				//url: url,
				//data: parametros,
				success: function(data) {
					$("#resultado_frmLogin").html(data);
				},
				error: function(data) {
					$("#resultado_frmLogin").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}
	</script>
</head>

<body>
	<div id="resultado_frmLogin">
		<div class="registro-box">
			<img src="img/logo.png" class="avatar" alt="LOGO" />
			<h1>- REGISTRO -</h1>
			<!--<form name="fregistro" id="fregistro" method="POST" action="">-->
			<label for="nombre">Usuario:</label>
			<input type="text" placeholder="Nombre de usuario" autocomplete="off" name="usuario" id="usuario" required />

			<label for="apellidoP">Nombre:</label>
			<input type="text" placeholder="Nombre completo" autocomplete="off" name="nombre" id="nombre" required />

			<label for="apellidoM">Correo:</label>
			<input type="text" placeholder="Correo electronico" autocomplete="off" name="correo" id="correo" required />

			<label for="username">Contraseña:</label>
			<input type="password" placeholder="Contraseña" autocomplete="off" name="passw" id="passw" onkeyup="
					validar()">
			<div id="mensaje"></div></input>

			<label for="username">Confirmar contraseña:</label>
			<input type="password" placeholder="Confirmar contraseña" autocomplete="off" name="passw2" id="passw2" required />

			<center><button onclick="Registrarse()" class="btn_registro">Registrarse</button></center>
			<br>
			<div class="centra">
				<a href="#" onclick="Regreso_Login()">Volver</a>
			</div>

			<!--</form>-->
		</div>
	</div>
	<div id="resultado_registro"></div>
</body>


</html>
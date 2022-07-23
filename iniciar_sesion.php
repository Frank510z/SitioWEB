<?php
include("funciones/conecta.php");
include("funciones/config.php");
session_start();
?>
<!DOCTYPE html>
<!-- === Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- ===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

	<!-- ===== CSS ===== -->
	<link rel="stylesheet" href="css/login&registration_forms.css">

	<!--========== Sweet Alert ==========-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!--<title>Login & Registration Form</title>-->

	<!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- Script para cargar pagina -->
	<script src="js/cargarPagina.js"></script>

	<link rel="stylesheet" href="css/stylelogin.css" />

	<title>Iniciar sesión</title>

	<script>
		/************** Ir al formulario de registro mediante AJAX **************/
		function Registrarse() {
			//console.log("OK");
			$.ajax({
				type: "POST",
				url: "registro_cliente.php",
				//url: url,
				//data: parametros,
				success: function(data) {
					$("#resultado_frmregistro").html(data);
				},
				error: function(data) {
					$("#resultado_frmregistro").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}

		/************** Mandar datos de inicio de sesión mediante AJAX **************/
		function Inicio_Sesion() {
			var usuario = $('#usuario').val();
			var pass = $('#pass').val();
			var url = "is_logic.php";
			//console.log("Nombre: "+nombre+" Direccion: "+direccion);
			var parametros = {
				"usuario": usuario,
				"pass": pass
			};
			console.log(parametros);
			$.ajax({
				type: "POST",
				url: "is_logic.php",
				//url: url,
				data: parametros,
				success: function(data) {
					$("#is_logic").html(data);
				},
				error: function(data) {
					$("#is_logic").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}
	</script>
</head>

<body>
	<div id="resultado_frmregistro">
		<div class="login-box" id="resultado">
			<img src="img/logo.png" class="avatar" alt="LOGO" />
			<h1>- Bienvenido -</h1>
			<!--<form name="fregistro" id="fregistro" method="POST" action="">-->
				<!-- USERNAME INPUT -->
				<label for="username">Usuario:</label>
				<input type="text" placeholder="Ingrese su usuario" autocomplete="off" name="usuario" id="usuario" />
				<!-- PASSWORD INPUT -->
				<label for="password">Contraseña:</label>
				<input type="password" placeholder="Ingrese su contraseña" autocomplete="off" name="pass" id="pass" />
				<!--<input type="submit" value="Iniciar Sesion" name="iniciar" />-->
				<center><button onclick="Inicio_Sesion()" class="btn_login">Iniciar sesión</button></center>
				<br>

				<div class="centra">
					<a href="formulario_reestablecer_pass.php">¿Olvidaste tu contraseña?</a><br>
					<a href="#" onclick="Registrarse()" class="centro">¿No tienes Cuenta? Registrate</a>
				</div>
			<!--</form>-->
		</div> <!-- Fin DIV resultado_frmregistro -->

		<div id="is_logic"></div>

		<!-- <script src="JavaScript/particles.min.js"></script>
	<script src="JavaScript/app.js"></script>

    <script src="script.js"></script> -->
	</div>
</body>

</html>
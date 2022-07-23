<?php
//include("funciones/validarUser.php");
?>
<?php
    include("funciones/conecta.php");
    include("funciones/config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!--========== Sweet Alert ==========-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/formularios.css">

	<script src="js/cargarPagina.js"></script>

	<!--========== Regresar al Stock de usuarios mediante AJAX ==========-->
	<script>
		function regresar() {
			$.ajax({
				type: "POST",
				url:"mostrarUsuarios.php",
				//url: url,
				//data: parametros,
				success: function (data) {
					$("#regresar").html(data);
				},
				error: function (data) {
					$("#regresar").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}

		function validar(){
			console.log("Se esta presionando");
			var mayus = new RegExp("^(?=.*[A-Z])");
			var special = new RegExp("^(?=.*[!@#$&*])");
			var numbers = new RegExp("^(?=.*[0-9])");
			var lower = new RegExp("^(?=.*[a-z])");
			//var len = new RegExp("^(?=.*{8,})");

			//$("#passw").on("keyup", function validar(){

				var pass = $("#passw").val();

				if(mayus.test(pass) && special.test(pass) && numbers.test(pass) && lower.test(pass)){
						$("#mensaje").html("Segura").css("color", "green");
				}else{
						$("#mensaje").html("insegura").css("color", "red");
				}
			//});
		}
	</script>

	<script>
		function saluda() {
			var nombre = $('#nombre').val();
			var dire = $('#usuario').val();
			var tel = $('#nivel').val();
			var mail = $('#correo').val();
			var curp = $('#passw').val();
			var sexo = $('#passw2').val();
			var url = "ra_logic.php";
			//console.log("Nombre: "+nombre+" Direccion: "+direccion);
			var parametros = {
				"nombre": nombre,
				"usuario": dire,
				"nivel": tel,
				"correo": mail,
				"passw": curp,
				"passw2": sexo
			};
			console.log(parametros);
			$.ajax({
				type: "POST",
				url:"ra_logic.php",
				//url: url,
				data: parametros,
				success: function (data) {
					$("#agrega_usuario").html(data);
				},
				error: function (data) {
					$("#agrega_usuario").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}
	</script>
	
	
	<title>Registrar</title>
	
</head>

<body>
	
	<!--======================= Formulario de ingreso de datos =======================-->
	<div id="main">
	<div id="container">
		<!--<div id="res"></div>--><div id="agrega_usuario"></div>
		<h2>Registro</h2>
		
		<p>Registro de clientes/admins</p>
		<!--<form name=fregistro id="registro" method="POST" action="">-->
			<center><table>
			<tbody>
				<tr>
					<td>Nombre: </td> <td><input type="text" placeholder="Ingresa tu nombre" id="nombre" name="nombre" required></td>
				</tr>

				<tr>
					<td>Usuario: </td> <td><input type="text" placeholder="Ingresa tu nickname" id="usuario" name="usuario" required></td>
				</tr>

				<tr>
					<td>Cargo</td>
					<td><input class="radiob" type="radio" name="nivel" id="nivel" value="1">Admin<br>
					<input class="radiob" type="radio" name="nivel" id="nivel" value="2">Cliente</td>
				</tr>

				<tr>
					<td>Correo: </td> <td><input type="mail" placeholder="Ingresa tu correo" id="correo" name="correo" required></td>
				</tr>

				<tr>
				<td>Contraseña: </td> <td><input type="password" placeholder="Ingresa tu contraseña" id="passw" name="passw" required onkeyup="
					validar()"> <div id="mensaje"></div></td>
				</tr>
				
				<tr>
					<td>Confirmar contraseña: </td> <td><input type="password" placeholder="Confirmar Contraseña" autocomplete="off" name="passw2" id="passw2" /></td>
				</tr>
			
				<!--<tr>
					<td colspan="2" align="center">Nivel:
					
					<select name="carrera" id="carrera">
						<option>1</option>
						<option>2</option>
					</select>
					</td>
				</tr>-->

			</tbody>
			</table></center>
			
			<button class="register" onclick="saluda()">Registrar</button>
			
			<button onclick="regresar()" class="back">Cancelar</button>
			
		<!--</form>-->
	</div>
	</div>
	
</body>
</html>
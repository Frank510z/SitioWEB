<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<!------------------- AJAX ---------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script>
		function regresar() {
			
			/*var url = "mostrarUsuarios.php";*/
			
			$.ajax({
				type: "POST",
				url:"mostrarUsuarios.php",
				//url: url,
				//data: parametros,
				success: function (data) {
					$("#resultado").html(data);
				},
				error: function (data) {
					$("#resultado").html("El recurso buscado no se encuentra");
				}
			});
			//$('#tablanombres tr:last').after('<tr><td>' + nombre + '</td><td>' + dire + '</td><td>' + tel + '</td><td>' + mail + '</td><td>' + curp + '</td><td>' + sexo + '</td></tr>');
		}
	</script>
</head>
<body>
	<div id="resultado"></div>
</body>
</html>

<?php
    include("funciones/conecta.php");
    include("funciones/config.php");
?>

<?php

if (isset($_POST['usuario']) || isset($_POST['nombre']) || isset($_POST['correo']) || isset($_POST['passw'])  || isset($_POST['passw2'])  || isset($_POST['nivel'])) {

  	$usuario = $_POST['usuario'];
  	$nombre = $_POST['nombre'];
  	$correo = $_POST['correo'];
  	$passw = $_POST['passw'];
  	$passw2 = $_POST['passw2'];
  	$nivel = $_POST['nivel'];

  	if (!isset($usuario) || $usuario == NULL || !isset($nombre) || $nombre == NULL || !isset($correo) || $correo == NULL || !isset($passw) || $passw == NULL || !isset($passw2) || $passw2 == NULL || !isset($nivel) || $nivel == NULL) {
    	echo "<script>swal('¡Advertencia!', 'Llene los campos vacios', 'info')</script>";
  	} else {

    	$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
		$query = $conecta->query($sql);
		$filas = mysqli_num_rows($query);

    	if($filas == 0){

    		if (crypt($passw, $passw) == crypt($passw2, $passw2)) {
      			$contra = crypt($passw2, $passw);

      			//$sql = "INSERT INTO usuario(nombre,apellidos,matricula,correo,telefono) VALUES('$nombre','$apellido','$matricula','$email','$telefono')";
      			$sql = "INSERT INTO usuarios(nombre,usuario,correo,contraseña,nivel,statu) VALUES('$nombre','$usuario','$correo','$contra','$nivel',1)";

      			$data = mysqli_query($conecta, $sql);
      
      			if ($data) {
        			//header("location:index.php");
                    echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
					<script>
						jQuery(function(){
							swal({
								icon: "success",
								title: "¡Ok!",
								text: "Usuario registrado"
							}).then(function() {
								$.ajax({
									type: "POST",
									url:"mostrarUsuarios.php",
									//url: url,
									//data: parametros,
									success: function (data) {
										$("#resultado_agregar_user").html(data);
									},
									error: function (data) {
										$("#resultado_agregar_user").html("El recurso buscado no se encuentra");
									}
								});
							});
						});
					</script>"';
      			}

    		}else{
				echo "<script>swal('¡Error!', 'Las constraseñas no coinciden', 'error')</script>";
    		}

  		}else{
    		echo "Otra persona ya utilizo ese nombre de usuario";
  		}

  	}
}
?>
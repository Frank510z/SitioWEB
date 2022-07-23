<?php

    include("funciones/conecta.php");

    
        $nombre_user = $_GET['nombre'];
        $query = "SELECT * FROM usuarios WHERE nombre='".$nombre_user."'";
        $producto= mysqli_query($conecta, $query);
        $row = mysqli_fetch_assoc($producto);
        
        
        $nombre = $_POST["nombre"] ;
        $usuario = $_POST["usuario"] ;
        $cargo = $_POST["cargo"] ;
        $correo = $_POST["correo"] ;


        if (!isset($nombre) || $nombre == '' || !isset($usuario) || $usuario == '' || !isset($cargo) || $cargo == '' || !isset($correo) || $correo == '') {
        	echo "<script>swal('¡Advertencia!', 'Llene los campos vacios', 'info')</script>";
        }

        else {
        $varsql = "UPDATE usuarios SET nombre='$nombre', usuario='$usuario', nivel='$cargo', correo='$correo' WHERE nombre='$nombre'";


        //$conecta->query($varsql);

        	if($conecta->query($varsql)) {
            	//echo "Registro correcto";
            	//header("Location:mostrarProductos.php");
                echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script>
					jQuery(function(){
						swal({
							icon: "success",
							title: "¡Ok!",
							text: "Actualización correcta"
						}).then(function() {
							$.ajax({
								type: "POST",
								url:"mostrarUsuarios.php",
								//url: url,
								//data: parametros,
								success: function (data) {
									$("#resultado_modifica").html(data);
								},
								error: function (data) {
									$("#resultado_modifica").html("El recurso buscado no se encuentra");
								}
							});
						});
					});
				</script>"';
        	}

        	else {
            	echo "<script>swal('¡Error!', 'Algo salió mal', 'error')</script>";
            	
        	}

    	}
     
    
?>
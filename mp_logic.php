<?php

    include("funciones/conecta.php");

    
        $nombre_product = $_GET['nombre'];
        $query = "SELECT * FROM productos WHERE nombre='".$nombre_productos."'";
        $producto= mysqli_query($conecta, $query);
        $row = mysqli_fetch_assoc($producto);
        
        
        $nombre = $_POST["nombre"] ;
        $precio = $_POST["precio"] ;
        $cantidad = $_POST["cantidad"] ;
        $descripcion = $_POST["descripcion"] ;


        if (!isset($nombre) || $nombre == '' || !isset($precio) || $precio == '' || !isset($cantidad) || $cantidad == '' || !isset($descripcion) || $descripcion == '') {
        	echo "<script>swal('¡Advertencia!', 'Llene los campos vacios', 'info')</script>";
        }

        else {
        $varsql = "UPDATE productos SET nombre='$nombre', precio='$precio', cantidad='$cantidad', descripcion='$descripcion' WHERE nombre='$nombre'";


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
								url:"mostrarProductos.php",
								//url: url,
								//data: parametros,
								success: function (data) {
									$("#resultado_modifica_producto").html(data);
								},
								error: function (data) {
									$("#resultado_modifica_producto").html("El recurso buscado no se encuentra");
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
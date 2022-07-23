<?php
    //echo "<script> alert('llega al php'); </script>";
    include("funciones/conecta.php");

    $nombre_user = $_GET['nombre'];
        $query = "SELECT * FROM usuarios WHERE nombre='".$nombre_user."'";
        $producto= mysqli_query($conecta, $query);
        $row = mysqli_fetch_assoc($producto);
        
        $nombre = $_POST["nombre"] ;
        $usuario = $_POST["usuario"] ;
        $cargo = $_POST["cargo"] ;
        $correo = $_POST["correo"] ;


        $varsql = "DELETE FROM usuarios WHERE usuario='$usuario'";


        //$conecta->query($varsql);

        	if($conecta->query($varsql)) {
            	//echo "El usuario se ha elmimindo, presiona el boton REGRESAR";
            	//header("Location:mostrarProductos.php");
                //echo "<script>swal('¡Ok!', 'Se ha eliminado el usuario', 'success')</script>";
                echo '<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script>
					jQuery(function(){
						swal({
							icon: "success",
							title: "¡Ok!",
							text: "El usuario ha sido eliminado correctamente"
						}).then(function() {
							$.ajax({
								type: "POST",
								url:"mostrarUsuarios.php",
								//url: url,
								//data: parametros,
								success: function (data) {
									$("#resultado_elimina").html(data);
								},
								error: function (data) {
									$("#resultado_elimina").html("El recurso buscado no se encuentra");
								}
							});
						});
					});
				</script>"';
        	}

        	else {
            	echo "<script>swal('¡No!', 'No se elimino', 'error')</script>";
            	
        	}

?>
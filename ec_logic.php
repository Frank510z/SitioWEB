<?php
    //echo "<script> alert('llega al php'); </script>";
    include("funciones/conecta.php");

    $nombre_user = $_GET['nombre'];
        $query = "SELECT * FROM contacto WHERE nombre_cliente='".$nombre_user."'";
        $producto= mysqli_query($conecta, $query);
        $row = mysqli_fetch_assoc($producto);
        
        $nombre_cliente = $_POST["nombre_cliente"] ;
        $fecha = $_POST["fecha"] ;
        $correo = $_POST["correo"] ;


        $varsql = "DELETE FROM contacto WHERE nombre_cliente='$nombre_cliente'";


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
							text: "El correo ha sido eliminado correctamente"
						}).then(function() {
							$.ajax({
								type: "POST",
								url:"index_administradores.php",
								//url: url,
								//data: parametros,
								success: function (data) {
									$("#resultado_elimina_correo").html(data);
								},
								error: function (data) {
									$("#resultado_elimina_correo").html("El recurso buscado no se encuentra");
								}
							});
						});
					});
				</script>';
        	}

        	else {
            	echo "<script>swal('¡No!', 'No se elimino', 'error')</script>";
            	
        	}

?>
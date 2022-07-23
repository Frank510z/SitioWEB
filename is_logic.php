<?php
include("funciones/conecta.php");
include("funciones/config.php");

if (isset($_POST["usuario"]) || isset($_POST["pass"])) {


	$usuario = $_POST["usuario"];
	$pass = $_POST["pass"];
	$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
	$query = $conecta->query($sql);
	$filas = mysqli_num_rows($query);
	if ($filas == 0) {
		echo "<script>swal('¡Atencion!', 'Usuario No Encontrado', 'error')</script>";
		//echo "usuario no encontrado";

	} else {
		while ($fila = $query->fetch_array()) {
			if (isset($fila[2])) //fila[2] Es el usuario
			{

				if ($fila[4] == crypt($pass, $fila[4]) and $fila[6] == 1) //
				{
					session_start();
					//echo "<script>swal('Â¡Felicitaciones!', 'Ingreso exitoso', 'success')</script>";		
					echo "ingreso exitoso";
					$_SESSION['usuario'] = $fila["usuario"];
					//$_SESSION['nombre'] = $fila["nombre"];

					$varsql = "select * from usuarios where usuario='$usuario'";
					$result = $conecta->query($varsql);

					while ($row = $result->fetch_array()) {
						echo $row[0] . " ";
						echo $row[1] . " ";
						echo $row[2] . " ";
						echo $row[3] . " ";
						echo $row[4] . " ";
						echo $row[5] . " ";

						if ($row[5] == "1") {
							echo "<script>window.location = 'index_administradores.php';</script>";
							//header("location:index_administradores.php");
						} else {
							echo "<script>window.location = 'index.php';</script>";
						}
					}
					//echo "<script>document.location.href='principal.php'</script>";
				} else {


					//$error = "ALERTA";
					echo "<script>swal('¡Atencion!', 'La contraseña que ingresaste es incorrecta', 'error')</script>";
					//header("location:index.php");
				} //Fin comprobacion de password

			} else {
				//echo "<script>swal('¡Atencion!', 'Verifica tu usuario', 'error')</script>";
				echo "verifica tu usuario";
			}
		}
	}
}
?>
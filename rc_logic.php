<?php
include("funciones/conecta.php");
include("funciones/config.php");

if (isset($_POST['usuario']) || isset($_POST['nombre']) || isset($_POST['correo']) || isset($_POST['passw'])  || isset($_POST['passw2'])) {

  $usuario = $_POST['usuario'];
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $passw = $_POST['passw'];
  $passw2 = $_POST['passw2'];

  if (!isset($usuario) || $usuario == NULL || !isset($nombre) || $nombre == NULL || !isset($correo) || $correo == NULL || !isset($passw) || $passw == NULL || !isset($passw2) || $passw2 == NULL) {

    echo "<script>swal('¡Advertencia!', 'Llene los campos vacios', 'info')</script>";
    
  } else {

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$query = $conecta->query($sql);
$filas = mysqli_num_rows($query);

    if($filas == 0){

    if (crypt($passw, $passw) == crypt($passw2, $passw2)) {
      $contra = crypt($passw2, $passw);



      //$sql = "INSERT INTO usuario(nombre,apellidos,matricula,correo,telefono) VALUES('$nombre','$apellido','$matricula','$email','$telefono')";
      $sql = "INSERT INTO usuarios(nombre,usuario,correo,contraseña,nivel,statu) VALUES('$nombre','$usuario','$correo','$contra',2,1)";

      $data = mysqli_query($conecta, $sql);
      
      if ($data) { 
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
                window.location = "index.php";
            });
        });
        </script>"';
      }
    }
    else{
      echo "<script>swal('¡Advertencia!', 'Las contraseñas no coinciden', 'info')</script>";
    }

  }else{
    echo "Otra persona ya utilizo ese nombre de usuario";
  }

  }
}
?>
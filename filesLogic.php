<?php
// conexionect to the database
$conecta = mysqli_connect('localhost', 'root', '12345678', 'tienda_online');
if (!session_id())  session_start();
$persona = $_SESSION['usuario'];


$sql = "SELECT * FROM subir_diseño WHERE usuario='$persona'";
$resultado = mysqli_query($conecta, $sql);

$files = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


// Uploads files
if (isset($_POST['envia'])) { // si el boton de envia se clickeo
    // name of the uploaded file
    $filename = $_FILES['myArchivo']['name'];
    $describe = $_POST['describe'];
    $tipo_producto = $_POST['tipo'];

    // Guarda la imagen en la carpeta diseños
    $destination = 'Diseños/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myArchivo']['tmp_name'];
    $size = $_FILES['myArchivo']['size'];
    $valid = $_FILES['myArchivo'];

    if (!in_array($extension, ['jpg', 'png', 'jpg'])) { //Tipos de archivos
        echo "Tu archivo debe de ser de formato jpg, png, jpg";
    } elseif ($_FILES['myArchivo']['size'] > 1000000) { // Tamaño de la imagen
        echo "El archivo pesa demasiado";
    } else {
        // Guarda la imagen subida en la carpeta temporal que se asigno en destination
        if (move_uploaded_file($file, $destination)) {

            $sql = "INSERT INTO subir_diseño(usuario,id_tipo,nombre_archivo,descripcion,peso) VALUES('$persona','$tipo_producto','$filename','$describe','$size')";

            if (mysqli_query($conecta, $sql)) {
                header("location:SubeDiseño.php");
                echo "<script>swal('¡Atencion!', 'El producto ya ha sido seleccionado', 'info')</script>";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    //fetch file to download from database

    $sql = "SELECT * FROM subir_diseño WHERE id_diseño=$id AND usuario='$persona'";
    $resultado = mysqli_query($conecta, $sql);

    $file = mysqli_fetch_assoc($resultado);

    $filepath = 'Diseños/' . $file['nombre_archivo'];


    if (file_exists($filepath)) {

        readfile('Diseños/' . $file['nombre_archivo']);

        exit;
    }
}

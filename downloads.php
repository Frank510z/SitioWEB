<?php include 'filesLogic.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
  <title>Download files</title>
</head>

<body>

  <table>
    <thead>
      <th>ID</th>
      <th>Nombre Del Archivo</th>
      <th>Peso (in mb)</th>
      <th>Imagen</th>
    </thead>
    <tbody>
      <?php foreach ($files as $file) : ?>
        <tr>
          <td><?php echo $file['id_diseño']; ?></td>
          <td><?php echo $file['nombre_archivo']; ?></td>
          <td><?php echo floor($file['peso'] / 1000) . ' KB'; ?></td>

          <td><a href="downloads.php?file_id=<?php echo $file['id_diseño'] ?>"></a>  <!--Descargar imagen-->
            <img src="downloads.php?file_id=<?php echo $file['id_diseño'] ?>" alt="imagen prueba">
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>

</body>

</html>
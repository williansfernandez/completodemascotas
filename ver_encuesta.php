<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Datos de la Encuesta</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f0f0f0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #ffe082;
    }

    tr:nth-child(even) {
      background-color: #fafafa;
    }

    img {
      max-width: 100px;
      max-height: 100px;
    }

    .btn-validar {
      padding: 8px 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-validar:hover {
      background-color: #45a049;
    }

    h2 {
      color: #333;
    }
  </style>
</head>
<body>

  <h2>Respuestas Recibidas de la Encuesta</h2>

  <?php
  $archivo = "respuestas.txt";

  if (file_exists($archivo) && filesize($archivo) > 0) {
      $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      echo "<table>
        <tr>
          <th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th>
          <th>Dirección</th><th>Dir. Cercana</th><th>Estado</th><th>País</th>
          <th>Postal</th><th>Área</th><th>Estado Mascota</th><th>Foto</th><th>Acción</th>
        </tr>";

      foreach ($lineas as $index => $linea) {
          $campos = explode(" | ", $linea);
          echo "<tr>";

          // Mostrar los primeros 11 campos
          for ($i = 0; $i < count($campos) - 1; $i++) {
              echo "<td>" . htmlspecialchars($campos[$i]) . "</td>";
          }

          // Mostrar imagen
          $imagen = trim(end($campos));
          if ($imagen !== '' && file_exists("imagenes/$imagen")) {
              echo "<td><img src='imagenes/$imagen' alt='Foto'></td>";
          } else {
              echo "<td>Sin imagen</td>";
          }

          // Botón "Datos correctos"
          echo "<td>
  <form method='post' action='publicar.php'>";
for ($i = 0; $i < count($campos); $i++) {
    $valorSeguro = htmlspecialchars($campos[$i], ENT_QUOTES, 'UTF-8');
    echo "<input type='hidden' name='campo$i' value='$valorSeguro'>";
}
echo "<button type='submit' class='btn-validar'>Datos correctos</button>
  </form>
</td>";

          echo "</tr>";
      }

      echo "</table>";
  } else {
      echo "<p>No hay respuestas almacenadas todavía.</p>";
  }
  ?>

</body>
</html>


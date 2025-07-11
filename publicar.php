<?php
// publicar.php
$campos = [];
for ($i = 0; isset($_POST["campo$i"]); $i++) {
    $campos[] = htmlspecialchars($_POST["campo$i"]);
}

// Guardar los datos confirmados en un archivo
if (count($campos) >= 12) {
    $linea = implode('|', $campos) . PHP_EOL;
    file_put_contents('confirmados.txt', $linea, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Publicación de Mascota</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #fdfcfb;
    }
    .card {
      border: 1px solid #ccc;
      border-radius: 8px;
      max-width: 500px;
      margin: 20px auto;
      background-color: white;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .card img {
      max-width: 100%;
      border-radius: 8px;
    }
    h2 {
      color: #333;
      margin-top: 0;
    }
  </style>
</head>
<body>

<!-- Tarjeta de la mascota recién confirmada -->
<?php if (count($campos) >= 12): ?>
  <div class="card">
    <h2><?php echo $campos[0] . " " . $campos[1]; ?></h2>
    <p><strong>Email:</strong> <?php echo $campos[2]; ?></p>
    <p><strong>Teléfono:</strong> <?php echo $campos[3]; ?></p>
    <p><strong>Dirección:</strong> <?php echo $campos[4]; ?> (Cercana: <?php echo $campos[5]; ?>)</p>
    <p><strong>Ubicación:</strong> <?php echo $campos[6] . ", " . $campos[7]; ?> - CP: <?php echo $campos[8]; ?>, Área: <?php echo $campos[9]; ?></p>
    <p><strong>Estado de la mascota:</strong> <?php echo $campos[10]; ?></p>
    <?php if (!empty($campos[11]) && file_exists("imagenes/" . $campos[11])): ?>
      <img src="imagenes/<?php echo $campos[11]; ?>" alt="Foto de la mascota">
    <?php else: ?>
      <p><em>Sin imagen disponible</em></p>
    <?php endif; ?>
  </div>
<?php endif; ?>

<!-- Tarjetas de mascotas previamente confirmadas -->
<?php
$lineas = file('confirmados.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lineas as $linea) {
    $datos = explode('|', $linea);
    if (count($datos) >= 12) {
        echo "<div class='card'>
            <h2>{$datos[0]} {$datos[1]}</h2>
            <p><strong>Email:</strong> {$datos[2]}</p>
            <p><strong>Teléfono:</strong> {$datos[3]}</p>
            <p><strong>Dirección:</strong> {$datos[4]} (Cercana: {$datos[5]})</p>
            <p><strong>Ubicación:</strong> {$datos[6]}, {$datos[7]} - CP: {$datos[8]}, Área: {$datos[9]}</p>
            <p><strong>Estado de la mascota:</strong> {$datos[10]}</p>";
        if (!empty($datos[11]) && file_exists("imagenes/" . $datos[11])) {
            echo "<img src='imagenes/{$datos[11]}' alt='Foto de la mascota'>";
        } else {
            echo "<p><em>Sin imagen disponible</em></p>";
        }
        echo "</div>";
    }
}
?>

</body>
</html>












</body>
</html>

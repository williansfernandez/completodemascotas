<?php
// guardar_encuesta.php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si alguien accede con GET, lo redirigimos de vuelta al formulario
    header('Location: formulario.html');
    exit;
}

// 1) Recoger datos
$data = [
    $_POST['firstname']  ?? '',
    $_POST['lastname']   ?? '',
    $_POST['email']      ?? '',
    $_POST['phone']      ?? '',
    $_POST['address']    ?? '',
    $_POST['address2']   ?? '',
    $_POST['state']      ?? '',
    $_POST['country']    ?? '',
    $_POST['post']       ?? '',
    $_POST['area']       ?? '',
    $_POST['description']?? '',
];

// 2) Procesar imagen
$imagen = '';
if (!empty($_FILES['imagen']['tmp_name']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $imagen = 'foto_' . time() . '.' . $ext;
    if (!is_dir('imagenes')) {
        mkdir('imagenes', 0777, true);
    }
    move_uploaded_file($_FILES['imagen']['tmp_name'], 'imagenes/' . $imagen);
}

// 3) Guardar en texto
$linea = implode(' | ', $data) . ' | ' . $imagen . PHP_EOL;
file_put_contents('respuestas.txt', $linea, FILE_APPEND);

// 4) Redirigir a la página de confirmación
header('Location: registro_exitoso.php');
exit;

// No cerramos la etiqueta PHP para evitar "headers already sent"


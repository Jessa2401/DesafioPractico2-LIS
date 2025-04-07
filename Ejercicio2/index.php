<?php
require_once 'libro.php';

session_start();

$errores = [];
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = []; 
}


if (isset($_GET['borrar'])) {
    $isbnBorrar = $_GET['borrar'];
    foreach ($_SESSION['libros'] as $index => $libro) {
        if ($libro->isbn === $isbnBorrar) {
            unset($_SESSION['libros'][$index]);  
            $_SESSION['libros'] = array_values($_SESSION['libros']); //reindexo
            break;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $autor     = htmlspecialchars(trim($_POST['autor']));
    $titulo    = htmlspecialchars(trim($_POST['titulo']));
    $edicion   = htmlspecialchars(trim($_POST['edicion']));
    $lugar     = htmlspecialchars(trim($_POST['lugar']));
    $editorial = htmlspecialchars(trim($_POST['editorial']));
    $anio      = htmlspecialchars(trim($_POST['anio']));
    $paginas   = htmlspecialchars(trim($_POST['paginas']));
    $notas     = htmlspecialchars(trim($_POST['notas']));
    $isbn      = htmlspecialchars(trim($_POST['isbn']));

    $validaciones = [
        'autor'     => '/^[A-ZÁÉÍÓÚÑa-záéíóúñ\s]+(?:, [A-ZÁÉÍÓÚÑa-záéíóúñ\s]+)?$/',
        'titulo'    => '/^[A-Za-zÁÉÍÓÚÑáéíóúñ0-9\s]+$/',
        'edicion'   => '/^\d+(ª|º)?$/',
        'lugar'     => '/^[A-ZÁÉÍÓÚÑa-záéíóúñ\s.,\'-]+$/',
        'editorial' => '/^[A-ZÁÉÍÓÚÑa-záéíóúñ\s.,\'-]+$/',
        'anio'      => '/^(19|20)[0-4][0-9]$/',  // Año entre 1900 y 2050
        'paginas'   => '/^\d+$/',
        'isbn'      => '/^\d{13}$/', // ISBN de 13 numeros
    ];

    foreach ($validaciones as $campo => $regex) {
        if (!preg_match($regex, $$campo)) {
            $errores[$campo] = "Campo inválido: $campo";
        }
    }

    if (empty($errores)) {
        $libro = new Libro($autor, $titulo, $edicion, $lugar, $editorial, $anio, $paginas, $notas, $isbn);
        $_SESSION['libros'][] = $libro;  // aqui almaceno
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Inventario de Libros</h1>

        <?php if ($errores): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Título del libro</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Número de edición</label>
                <input type="text" name="edicion" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Lugar de publicación</label>
                <input type="text" name="lugar" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Editorial</label>
                <input type="text" name="editorial" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Año de edición</label>
                <input type="text" name="anio" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Número de páginas</label>
                <input type="text" name="paginas" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Notas</label>
                <textarea name="notas" class="form-control"></textarea>
            </div>
            <div class="col-12">
                <button class="btn btn-primary">Agregar libro</button>
            </div>
        </form>

        <hr class="my-5">

        <h2>Libros Registrados</h2>
        <?php if (!empty($_SESSION['libros'])): ?>
            <div class="list-group">
                <?php foreach ($_SESSION['libros'] as $libro): ?>
                    <div class="list-group-item">
                        <h5><?= $libro->titulo ?> <small>(<?= $libro->anio ?>)</small></h5>
                        <p><strong>Autor:</strong> <?= $libro->autor ?></p>
                        <p><strong>Editorial:</strong> <?= $libro->editorial ?>, <strong>Lugar:</strong> <?= $libro->lugar ?>, <strong>Edición:</strong> <?= $libro->edicion ?></p>
                        <p><strong>ISBN:</strong> <?= substr($libro->isbn, 0, 3) . '-' . substr($libro->isbn, 3, 5) . '-' . substr($libro->isbn, 8, 5) . '-' . substr($libro->isbn, 13, 1) ?></p>
                        <p><strong>Páginas:</strong> <?= $libro->paginas ?></p>
                        <p><strong>Notas:</strong> <?= $libro->notas ?></p>
                        <a href="?borrar=<?= $libro->isbn ?>" class="btn btn-danger btn-sm">Borrar</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se han registrado libros aún.</p>
        <?php endif; ?>
    </div>
</body>
</html>

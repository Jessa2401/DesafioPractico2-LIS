<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Array Anidado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-3">
            <h1 class="text-center mb-4">Academia Full Language</h1>
            
            <?php
            $niveles = array("Básico", "Intermedio", "Avanzado");
            $idiomas = array("Inglés", "Francés", "Mandarín", "Ruso", "Portugués", "Japonés");

            $alumnos = array(
                array(25, 10, 8, 12, 30, 90), 
                array(15, 5, 4, 8, 15, 25),   
                array(10, 2, 1, 4, 10, 67)    
            );

            // Obtener el idioma seleccionado (si existe)
            $idiomaSeleccionado = isset($_GET['idioma']) ? $_GET['idioma'] : null;
            
            // Obtener el índice del idioma seleccionado
            $indiceIdioma = $idiomaSeleccionado !== null ? array_search($idiomaSeleccionado, $idiomas) : false;
            ?>

            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Seleccione un idioma</h3>
                    
                    <form method="GET" action="">
                        <select class="form-control" name="idioma" onchange="this.form.submit()">
                            <option value="">Seleccione un idioma</option>
                            <?php foreach ($idiomas as $idioma): ?>
                                <option value="<?= $idioma ?>" <?= ($idiomaSeleccionado === $idioma) ? 'selected' : '' ?>>
                                    <?= $idioma ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                    
                    <div class="tabla-alumnos">
                        <?php if ($idiomaSeleccionado && $indiceIdioma !== false): ?>
                            <h4 class="text-center mb-3">Alumnos en <?= $idiomaSeleccionado ?></h4>
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nivel</th>
                                        <th>Alumnos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($niveles as $indice => $nivel): ?>
                                        <tr>
                                            <td><?= $nivel ?></td>
                                            <td><?= $alumnos[$indice][$indiceIdioma] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-info text-center">
                                Seleccione un idioma del menú desplegable
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
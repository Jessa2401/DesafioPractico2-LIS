<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Arreglos Asociativos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-3">
            <h1 class="text-center mb-4">Academia Full Language</h1>
            
            <?php
            $niveles = array("Básico", "Intermedio", "Avanzado");
            $idiomas = array("Inglés", "Francés", "Mandarín", "Ruso", "Portugués", "Japonés");

            $alumnos = array(
                "Básico" => array(
                    "Inglés" => 25,
                    "Francés" => 10,
                    "Mandarín" => 8,
                    "Ruso" => 12,
                    "Portugués" => 30,
                    "Japonés" => 90
                ),
                "Intermedio" => array(
                    "Inglés" => 15,
                    "Francés" => 5,
                    "Mandarín" => 4,
                    "Ruso" => 8,
                    "Portugués" => 15,
                    "Japonés" => 25
                ),
                "Avanzado" => array(
                    "Inglés" => 10,
                    "Francés" => 2,
                    "Mandarín" => 1,
                    "Ruso" => 4,
                    "Portugués" => 10,
                    "Japonés" => 67
                )
            );

            // Obtener el idioma seleccionado (si existe)
            $idiomaSeleccionado = isset($_GET['idioma']) ? $_GET['idioma'] : null;
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
                        <?php if ($idiomaSeleccionado): ?>
                            <h4 class="text-center mb-3">Alumnos en <?= $idiomaSeleccionado ?></h4>
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nivel</th>
                                        <th>Alumnos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($niveles as $nivel): ?>
                                        <tr>
                                            <td><?= $nivel ?></td>
                                            <td><?= $alumnos[$nivel][$idiomaSeleccionado] ?></td>
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
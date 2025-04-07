<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Array Combinado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-3">
            <h1 class="text-center mb-4">Academia Full Language</h1>
            
            <?php
            $niveles = array("Básico", "Intermedio", "Avanzado");
            $idiomas = array("Inglés", "Francés", "Mandarín", "Ruso", "Portugués", "Japonés");

            $alumnos = array(
                "Básico" => [25, 10, 8, 12, 30, 90],
                "Intermedio" => [15, 5, 4, 8, 15, 25],
                "Avanzado" => [10, 2, 1, 4, 10, 67]
            );

            // Obtener el idioma seleccionado (si existe)
            $idiomaSeleccionado = isset($_GET['idioma']) ? $_GET['idioma'] : null;
            
            // Obtener el índice del idioma seleccionado
            $indiceIdioma = $idiomaSeleccionado !== null ? array_search($idiomaSeleccionado, $idiomas) : false;

            function mostrarAlumnos($idiomaSeleccionado, $indiceIdioma, $niveles, $idiomas, $alumnos) {
                echo '<form method="GET" action="">';
                echo '<div class="row">';
                    echo '<div class="col-md-8 mx-auto">';
                        echo '<select class="form-select" name="idioma" onchange="this.form.submit()">';
                            echo '<option value="">Seleccione un idioma</option>';
                            foreach ($idiomas as $idioma) {
                                $selected = ($idiomaSeleccionado === $idioma) ? 'selected' : '';
                                echo "<option value=\"$idioma\" $selected>$idioma</option>";
                            }
                        echo '</select>';
                    echo '</div>';
                echo '</div>';
            echo '</form>';
            echo '<div class="tabla-alumnos mt-4">';
                if ($idiomaSeleccionado && $indiceIdioma !== false){
                    echo "<h4 class=\"text-center mb-3\">Alumnos en $idiomaSeleccionado </h4>";
                    echo '<table class="table table-bordered table-striped">';
                        echo '<thead class="table-dark">';
                            echo '<tr>';
                                echo '<th>Nivel</th>';
                                echo '<th>Alumnos</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                            foreach ($alumnos as $nivel => $datosIdiomas){
                                echo '<tr>';
                                    echo "<td>$nivel</td>";
                                    echo "<td> $datosIdiomas[$indiceIdioma]</td>";
                                echo '</tr>';
                            }
                        echo '</tbody>';
                    echo '</table>';
                }else{
                    echo '<div class="alert alert-info text-center">';
                        echo 'Seleccione un idioma del menú desplegable para ver los alumnos por nivel';
                    echo '</div>';
                }
            echo '</div>';
            }
            ?>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Seleccione un idioma</h3>
                    <?php mostrarAlumnos($idiomaSeleccionado, $indiceIdioma, $niveles, $idiomas, $alumnos); ?>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
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

            function mostrarAlumnos($idiomaSeleccionado, $niveles, $idiomas, $alumnos) {
                echo '<form method="GET" action="">';
                    echo '<select class="form-control" name="idioma" onchange="this.form.submit()">';
                        echo '<option value="">Seleccione un idioma</option>';
                        foreach ($idiomas as $idioma) {
                            $selected = ($idiomaSeleccionado === $idioma) ? 'selected' : '';
                            echo "<option value=\"$idioma\" $selected>$idioma</option>";
                        }
                    echo '</select>';
                echo '</form>';
                
                echo '<div class="tabla-alumnos">';
                    if ($idiomaSeleccionado) { 
                        echo "<h4 class=\"text-center mb-3\">Alumnos en $idiomaSeleccionado</h4>";
                        echo '<table class="table table-bordered table-striped">';
                            echo '<thead class="table-dark">';
                                echo '<tr>';
                                    echo '<th>Nivel</th>';
                                    echo '<th>Alumnos</th>';
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                                foreach ($niveles as $nivel) {
                                    echo '<tr>';
                                        echo "<td>$nivel</td>";
                                        echo "<td>".$alumnos[$nivel][$idiomaSeleccionado]."</td>";
                                    echo '</tr>';
                                }
                            echo '</tbody>';
                        echo '</table>';
                    } else { 
                        echo '<div class="alert alert-info text-center">';
                            echo 'Seleccione un idioma del menú';
                        echo '</div>';
                    }
                echo '</div>';
            }
            ?>
            <div class="card shadow">
                <div class="card-body">
                     <h3 class="card-title text-center mb-4">Seleccione un idioma</h3>
                     <?php mostrarAlumnos($idiomaSeleccionado, $niveles, $idiomas, $alumnos); ?>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php
class Libro {
    public $autor;
    public $titulo;
    public $edicion;
    public $lugar;
    public $editorial;
    public $anio;
    public $paginas;
    public $notas;
    public $isbn;

    public function __construct($autor, $titulo, $edicion, $lugar, $editorial, $anio, $paginas, $notas, $isbn) {
        $this->autor = $autor;
        $this->titulo = $titulo;
        $this->edicion = $edicion;
        $this->lugar = $lugar;
        $this->editorial = $editorial;
        $this->anio = $anio;
        $this->paginas = $paginas;
        $this->notas = $notas;
        $this->isbn = $isbn;
    }

    public function mostrar() {
        return "<li><strong>{$this->autor}</strong> - {$this->titulo} ({$this->anio})</li>";
    }
}

function validarCampo($valor, $regex) {
    return preg_match($regex, $valor);
}

function limpiar($texto) {
    return htmlspecialchars(trim($texto));
}
?>

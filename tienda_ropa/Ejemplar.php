<?php
class Ejemplar {
    // Valores permitidos (equivalen a las enumeraciones de la base de datos)
    const COLORES = ['blanco', 'negro'];
    const TALLAS  = ['S', 'M', 'L', 'XL'];

    public $prenda;
    public $color;
    public $talla;
    public $stock;

    function __construct($prenda, $color, $talla, $stock) {
        $this->prenda = $prenda;
        $this->color  = $color;
        $this->talla  = $talla;
        $this->stock  = $stock;
    }
}
?>

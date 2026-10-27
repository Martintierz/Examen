<?php
require_once './conexion/conexion.php';
require_once 'PrendaDAO.php';
require_once 'EjemplarDAO.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: nuevo.php");
    exit;
}

$marca = $_POST['prenda'] ?? '';
$color = $_POST['color'] ?? '';
$talla = $_POST['talla'] ?? '';
$stock = filter_var($_POST['stock'] ?? '', FILTER_VALIDATE_INT);

// Validaciones en el servidor
$prendaDAO = new PrendaDAO($conector);
if ($prendaDAO->buscarPorMarca($marca) === null) {
    die("La prenda no existe");
}
if (!in_array($color, Ejemplar::COLORES, true)) {
    die("Color erróneo");
}
if (!in_array($talla, Ejemplar::TALLAS, true)) {
    die("Talla errónea");
}
// La columna stock es TINYINT, así que el máximo es 127
if ($stock === false || $stock < 0 || $stock > 127) {
    die("Stock erróneo (debe ser un número entre 0 y 127)");
}

// Crear el objeto e insertarlo
$ejemplar = new Ejemplar($marca, $color, $talla, $stock);
$ejemplarDAO = new EjemplarDAO($conector);
$ejemplarDAO->guardar($ejemplar);

header("Location: ver.php?marca=" . urlencode($marca));
exit;
?>

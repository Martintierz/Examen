<?php
require_once './conexion/conexion.php';
require_once 'PrendaDAO.php';
require_once 'Ejemplar.php';

$prendaDAO = new PrendaDAO($conector);
$marcas = $prendaDAO->listarMarcas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo ejemplar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Tienda de ropa</h1>
    <nav>
        <a href="indice.php">Inicio</a>
        <a href="nueva.php">Nueva prenda</a>
        <a href="nuevo.php">Nuevo ejemplar</a>
    </nav>
</header>

<main>
    <h2>Nuevo ejemplar</h2>

    <form action="guardarEjemplar.php" method="POST">

        <label>Prenda:</label>
        <select name="prenda" required>
            <option value="" disabled selected>Selecciona una prenda</option>
            <?php foreach ($marcas as $marca): ?>
            <option value="<?= htmlspecialchars($marca) ?>"><?= htmlspecialchars($marca) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Color:</label>
        <select name="color" required>
            <option value="" disabled selected>Selecciona un color</option>
            <?php foreach (Ejemplar::COLORES as $color): ?>
            <option value="<?= $color ?>"><?= ucfirst($color) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Talla:</label>
        <select name="talla" required>
            <option value="" disabled selected>Selecciona una talla</option>
            <?php foreach (Ejemplar::TALLAS as $talla): ?>
            <option value="<?= $talla ?>"><?= $talla ?></option>
            <?php endforeach; ?>
        </select>

        <label>Stock:</label>
        <input type="number" name="stock" min="0" max="127" placeholder="Cantidad disponible" required>

        <button type="submit">Guardar ejemplar</button>
    </form>
</main>
</body>
</html>

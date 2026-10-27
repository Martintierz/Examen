<?php
require_once './conexion/conexion.php';
require_once 'PrendaDAO.php';
require_once 'EjemplarDAO.php';

$marca = $_GET['marca'] ?? '';

$prendaDAO = new PrendaDAO($conector);
$prenda = $prendaDAO->buscarPorMarca($marca);

if ($prenda === null) {
    http_response_code(404);
    die("La prenda no existe. <a href='indice.php'>Volver al inicio</a>");
}

$ejemplarDAO = new EjemplarDAO($conector);
$ejemplares = $ejemplarDAO->listarPorPrenda($prenda->marca);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prenda - <?= htmlspecialchars($prenda->marca) ?></title>
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
    <h2><?= htmlspecialchars($prenda->marca) ?></h2>

    <section>
        <p><strong>Tipo de prenda:</strong> <span><?= htmlspecialchars($prenda->tipoPrenda) ?></span></p>
    </section>

    <section>
        <h3>Ejemplares disponibles</h3>

        <?php if (count($ejemplares) === 0): ?>
            <p>Esta prenda todavía no tiene ejemplares.</p>
        <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Color</th>
                <th>Talla</th>
                <th>Stock</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ejemplares as $e): ?>
            <tr>
                <td><?= htmlspecialchars(ucfirst($e->color)) ?></td>
                <td><?= htmlspecialchars($e->talla) ?></td>
                <td><?= (int) $e->stock ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </section>
</main>
</body>
</html>

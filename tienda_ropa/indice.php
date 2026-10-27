<?php
require_once './conexion/conexion.php';
require_once 'PrendaDAO.php';

$prendaDAO = new PrendaDAO($conector);
$prendas = $prendaDAO->listarConNumEjemplares();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ropa</title>
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
    <h2>Prendas</h2>
    <table>
      <thead>
      <tr>
        <th>Marca</th>
        <th>Tipo de prenda</th>
        <th>Nº de ejemplares</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($prendas as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['marca']) ?></td>
        <td><?= htmlspecialchars($p['tipoPrenda']) ?></td>
        <td><?= (int) $p['numEjemplares'] ?></td>
        <td><a href="ver.php?marca=<?= urlencode($p['marca']) ?>">Ver</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </main>
</body>
</html>

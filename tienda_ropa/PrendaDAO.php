<?php
require_once __DIR__ . '/prenda.php';

class PrendaDAO {
    private PDO $conector;

    public function __construct(PDO $conector) {
        $this->conector = $conector;
    }

    // Todas las prendas con su número de ejemplares (para indice.php)
    public function listarConNumEjemplares(): array {
        $sql = "SELECT p.marca, p.tipoPrenda, COUNT(e.prenda) AS numEjemplares
                FROM prendas p
                LEFT JOIN ejemplares e ON e.prenda = p.marca
                GROUP BY p.marca, p.tipoPrenda
                ORDER BY p.marca";
        return $this->conector->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Una prenda por su marca (para ver.php y para validar el formulario)
    public function buscarPorMarca(string $marca): ?Prenda {
        $stmt = $this->conector->prepare("SELECT marca, tipoPrenda FROM prendas WHERE marca = :marca");
        $stmt->bindParam(":marca", $marca, PDO::PARAM_STR);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) {
            return null;
        }
        return new Prenda($fila['marca'], $fila['tipoPrenda']);
    }

    // Solo las marcas (para rellenar el desplegable de nuevo.php)
    public function listarMarcas(): array {
        return $this->conector->query("SELECT marca FROM prendas ORDER BY marca")
                              ->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>

<?php
require_once __DIR__ . '/Ejemplar.php';

class EjemplarDAO {
    private PDO $conector;

    public function __construct(PDO $conector) {
        $this->conector = $conector;
    }

    // Ejemplares de una prenda (para ver.php)
    public function listarPorPrenda(string $marca): array {
        $sql = "SELECT prenda, color, talla, stock
                FROM ejemplares
                WHERE prenda = :marca
                ORDER BY color, FIELD(talla, 'S', 'M', 'L', 'XL')";
        $stmt = $this->conector->prepare($sql);
        $stmt->bindParam(":marca", $marca, PDO::PARAM_STR);
        $stmt->execute();

        $ejemplares = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $fila) {
            $ejemplares[] = new Ejemplar($fila['prenda'], $fila['color'], $fila['talla'], $fila['stock']);
        }
        return $ejemplares;
    }

    // Inserta el ejemplar. Si ya existe esa prenda + color + talla, suma el stock.
    public function guardar(Ejemplar $e): void {
        $sql = "INSERT INTO ejemplares (prenda, color, talla, stock)
                VALUES (:prenda, :color, :talla, :stock)
                ON DUPLICATE KEY UPDATE stock = stock + VALUES(stock)";
        $stmt = $this->conector->prepare($sql);
        $stmt->bindParam(":prenda", $e->prenda, PDO::PARAM_STR);
        $stmt->bindParam(":color",  $e->color,  PDO::PARAM_STR);
        $stmt->bindParam(":talla",  $e->talla,  PDO::PARAM_STR);
        $stmt->bindParam(":stock",  $e->stock,  PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>

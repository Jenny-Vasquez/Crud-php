<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegura que el ID sea un número entero
    try {
        $sql = "DELETE FROM pokemons WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("Location: index.php?message=Eliminado"); // Redirigir con mensaje
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar: " . $e->getMessage();
    }
} else {
    echo "ID no proporcionado.";
}
?>


<?php
include 'db.php';

$query = $conn->query("SELECT * FROM pokemons");
$pokemons = $query->fetchAll(PDO::FETCH_ASSOC);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pokémon CRUD</title>
    <link rel="shortcut icon" href="icono.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">

</head>
<header>

</header>
<body>
    <h1>Lista de Pokémon</h1>
    <?php
    if (isset($_GET['message']) && $_GET['message'] === 'Eliminado') {
        echo "<p style='color: green; font-size:2rem;'>¡Pokémon eliminado con éxito!</p>";
    }
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Nivel</th>
            <th>Accion</th>
        </tr>
        <?php foreach ($pokemons as $pokemon): ?>
        <tr>
            <td><?= $pokemon['id'] ?></td>
            <td><?= $pokemon['name'] ?></td>
            <td><?= $pokemon['type'] ?></td>
            <td><?= $pokemon['level'] ?></td>
            <td>
            <a href="update.php?id=<?= $pokemon['id'] ?>" class= "icon-1">
                
                <img src="edit.png" alt="Editar" style="width:20px; height:20px;">
                
            </a>
            <br>
            <br>
            <a href="delete.php?id=<?= $pokemon['id'] ?>" class= "icon-1"
                onclick="return confirm('¿Estás seguro de que deseas eliminar este Pokémon?')">
                <img src="delete.png" alt="Eliminar" style="width:20px; height:20px;">
            </a>

            </td>
        </tr>


        <?php endforeach; ?>
    </table>
  
    <button >
    <a href="create.php">Agregar Pokémon</a>
    </button>
    <footer style="margin-top: 4rem; text-align:center; border-top: 1px solid red">
        <p>© 2024 Jenny P. Vásquez Calero | Desarrollo web Entorno Servidor </p>
    </footer>
</body>

</html>

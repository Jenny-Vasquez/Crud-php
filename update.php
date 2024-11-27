<?php
include 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM pokemons WHERE id = :id");
$query->execute(['id' => $id]);
$pokemon = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $level = $_POST['level'];

    $query = $conn->prepare("UPDATE pokemons SET name = :name, type = :type, level = :level WHERE id = :id");
    $query->execute(['name' => $name, 'type' => $type, 'level' => $level, 'id' => $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Pokémon</title>
    <link rel="shortcut icon" href="icono.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Editar Pokémon</h1>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="name" value="<?= $pokemon['name'] ?>" required><br>
        <label>Tipo:</label>
        <input type="text" name="type" value="<?= $pokemon['type'] ?>" required><br>
        <label>Nivel:</label>
        <input type="number" name="level" value="<?= $pokemon['level'] ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>

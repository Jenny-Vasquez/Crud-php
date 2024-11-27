<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $level = $_POST['level'];

    $query = $conn->prepare("INSERT INTO pokemons (name, type, level) VALUES (:name, :type, :level)");
    $query->execute(['name' => $name, 'type' => $type, 'level' => $level]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Pokémon</title>
    <link rel="shortcut icon" href="icono.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header></header>
    <h1>Agregar Pokémon</h1>
    <form method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="type">Tipo:</label>
        <input type="text" id="type" name="type" required><br>

        <label for="level">Nivel:</label>
        <input type="number" id="level" name="level" min="1" required><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>

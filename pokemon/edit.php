<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user'])) {
    header('Location:.'); 
    exit;
}

try {
    // Conectar a la base de datos 
    $connection = new \PDO(
        'mysql:host=localhost;dbname=pokedexdatabase',
        'pokemonuser',
        'pokemonpassword',
        array(
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
        )
    );
} catch (PDOException $e) {
    header('Location: ..'); 
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $url = '.?op=editpokemon&result=noid';
    header('Location: ' . $url);
    exit;
}

$sql = 'SELECT * FROM pokemon WHERE id = :id';
$sentence = $connection->prepare($sql);
$parameters = ['id' => $id];
foreach ($parameters as $nombreParametro => $valorParametro) {
    $sentence->bindValue($nombreParametro, $valorParametro);
}

try {
    $sentence->execute();
    $row = $sentence->fetch();
} catch (PDOException $e) {
    header('Location:.'); 
    exit;
}

if ($row == null) {
    header('Location: .'); 
    exit;
}

// Variables para el formulario
$id = $row['id'];
$name = $row['name'];
$weight = $row['weight'];
$height = $row['height'];
$type = $row['type'];
$evolution = $row['evolution'];

$connection = null; 
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Pokémon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha384-xxxxx" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="..">Pokedex</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="..">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./">Pokemon</a>
            </li>
        </ul>
    </div>
</nav>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h4 class="display-4">Editar Pokémon</h4>
        </div>
    </div>
    <div class="container">
        <?php
        if (isset($_GET['op']) && isset($_GET['result'])) {
            if ($_GET['result'] > 0) {
                ?>
                <div class="alert alert-primary" role="alert">
                    Resultado: <?= htmlspecialchars($_GET['op'] . ' ' . $_GET['result']) ?>
                </div>
                <?php 
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Resultado: <?= htmlspecialchars($_GET['op'] . ' ' . $_GET['result']) ?>
                </div>
                <?php
            }
        }
        ?>
        <div>
            
            <form action="update.php" method="post">
                <div class="form-group">
                    <label for="name">Nombre del Pokémon</label>
                    <input value="<?= htmlspecialchars($name) ?>" required type="text" class="form-control" id="name" name="name" placeholder="Nombre del Pokémon">
                </div>
                <div class="form-group">
                    <label for="weight">Peso</label>
                    <input value="<?= htmlspecialchars($weight) ?>" required type="number" step="0.001" class="form-control" id="weight" name="weight" placeholder="Peso en kg">
                </div>
                <div class="form-group">
                    <label for="height">Altura</label>
                    <input value="<?= htmlspecialchars($height) ?>" required type="number" step="0.01" class="form-control" id="height" name="height" placeholder="Altura en metros">
                </div>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select required class="form-control" id="type" name="type">
                        <option value="water" <?= $type === 'water' ? 'selected' : '' ?>>Agua</option>
                        <option value="ground" <?= $type === 'ground' ? 'selected' : '' ?>>Tierra</option>
                        <option value="rock" <?= $type === 'rock' ? 'selected' : '' ?>>Roca</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="evolution">Evolución (ID del Pokémon evolucionado)</label>
                    <input value="<?= htmlspecialchars($evolution) ?>" type="number" class="form-control" id="evolution" name="evolution" placeholder="ID de la evolución">
                </div>
               
                <input type="hidden" name="id" value="<?= $id ?>" />
                <button type="submit" class="btn btn-primary">Editar</button>
            </form>
        </div>
        <hr>
    </div>
</main>
<footer class="container">
    <p>&copy; Pokedex 2024</p>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

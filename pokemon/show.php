<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos pokedexdatabase
try {
    $connection = new PDO(
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
    $url = '.?op=showpokemon&result=noid';
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
} catch (PDOException $e) {
 
    $url = '.?op=showpokemon&result=nosql';
    header('Location: ' . $url);
    exit;
}

if (!$fila = $sentence->fetch()) {
    $url = '.?op=showpokemon&result=nofetch';
    header('Location: ' . $url);
    exit;
}

$connection = null;
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalles del Pokémon</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha384-xxxxx" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="index.php">Pokedex</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Pokémon</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Detalles del Pokémon</h4>
                </div>
            </div>
            <div class="container">
                <div>
                    <div class="form-group">
                        ID del Pokémon:
                        <?= htmlspecialchars($fila['id']) ?>
                    </div>
                    <div class="form-group">
                        Nombre:
                        <?= htmlspecialchars($fila['name']) ?>
                    </div>
                    <div class="form-group">
                        Peso (kg):
                        <?= htmlspecialchars($fila['weight']) ?>
                    </div>
                    <div class="form-group">
                        Altura (m):
                        <?= htmlspecialchars($fila['height']) ?>
                    </div>
                    <div class="form-group">
                        Tipo:
                        <?= htmlspecialchars($fila['type']) ?>
                    </div>
                    <div class="form-group">
                        Evolución:
                        <?= $fila['evolution'] !== null ? htmlspecialchars($fila['evolution']) : 'No tiene evolución' ?>
                    </div>
                    <div class="form-group">
                        <a href="./">Volver</a>
                    </div>
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

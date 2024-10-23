<?php

ini_set('display_errors', 1);
error_reporting(E_ALL); 

session_start();

$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('Location: login.php'); 
    exit;
}

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
}

// Consultar todos los Pokémon
$sql = 'SELECT * FROM pokemon ORDER BY name, id';
try {
    $sentence = $connection->prepare($sql);
    $sentence->execute();
} catch (PDOException $e) {
    header('Location: ..'); 
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pokedex</title>
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
                        <a class="nav-link" href="index.php">Inicio</a>
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
                    <h4 class="display-4">Listado de Pokémon</h4>
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
                <div class="row">
                    <h3>Listado de Pokémon</h3>
                </div>
                <table class="table table-striped table-hover" id="tablaPokemon">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Peso (kg)</th>
                            <th>Altura (m)</th>
                            <th>Tipo</th>
                            <th>Evolución</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($fila = $sentence->fetch()) {
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($fila['id']); ?></td>
                                    <td><?= htmlspecialchars($fila['name']); ?></td>
                                    <td><?= htmlspecialchars($fila['weight']); ?></td>
                                    <td><?= htmlspecialchars($fila['height']); ?></td>
                                    <td><?= htmlspecialchars($fila['type']); ?></td>
                                    <td><?= $fila['evolution'] !== null ? htmlspecialchars($fila['evolution']) : 'N/A'; ?></td>
                                    <td><a href="destroy.php?id=<?= $fila['id'] ?>" class="borrar">Eliminar</a></td>
                                    <td><a href="edit.php?id=<?= $fila['id'] ?>">Editar</a></td>
                                    <td><a href="show.php?id=<?= $fila['id'] ?>">Ver</a></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <!-- Botón para agregar un Pokémon -->
                <div class="row">
                    <a href="create.php" class="btn btn-success">Agregar Pokémon</a>
                </div>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; Pokedex 2024</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
    </body>
</html>
<?php
$connection = null;



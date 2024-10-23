<?php
session_start();
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
            <a class="navbar-brand" href="./">Pokedex</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pokemon">Pokémons</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Main</h4>
                </div>
            </div>
            <div class="container">
                <?php
                if (isset($_GET['op']) && isset($_GET['result'])) {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        Result: <?= $_GET['op'] . ' ' . $_GET['result'] ?>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <h3>Pokémons</h3>
                </div>
                <div class="row">
                    <?php
                    if (isset($_SESSION['user'])) {
                        ?>
                        <a href="user/logout.php" class="btn btn-success">Log Out</a>
                        <?php
                    } else {
                        ?>
                        <a href="user/login.php" class="btn btn-success">Log In</a>
                        <?php
                    }
                    ?>
                    &nbsp;
                    <a href="pokemon" class="btn btn-success">View Pokémons</a>
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

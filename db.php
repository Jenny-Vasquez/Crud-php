<?php
$host = 'localhost';
$dbname = 'pokemon_db';
$username = 'root';
$password = ''; // Por defecto en XAMPP es una cadena vacía.

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

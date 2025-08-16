<?php
$servername = "127.0.0.1";
$username = "root";
$password = "desarrollo_software_1"; // Pon la contraseña que usas para root, si no tienes deja vacío
$dbname = "desarrollo_software_1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos.";
} catch(PDOException $e) {
    echo "Error en conexión: " . $e->getMessage();
}
?>

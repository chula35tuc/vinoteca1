<?php
$servername = 'localhost';
$username = 'root';
$password = ''; // Si no tiene contraseña, déjalo vacío o elimina la variable.
$dbname = 'vinotecadatos';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["username"];
    $contrasena = $_POST["password"];

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO usuarios (nombre, contrasena) VALUES ('$nombre', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente en la base de datos.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
}

$conn->close();
?>

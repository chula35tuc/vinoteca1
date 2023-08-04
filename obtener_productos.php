<?php
// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vinotecadatos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener la categoría seleccionada desde la solicitud GET
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];

    // Limpiar el valor de la categoría para evitar problemas de seguridad
    $categoria = mysqli_real_escape_string($conn, $categoria);
    
    // Realizar la consulta para obtener los productos de la categoría seleccionada
    $sql = "SELECT * FROM productos WHERE categoria = '$categoria'";
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        $productos = array();

        // Recorrer los resultados y agregarlos al array de productos
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        // Convertir el array de productos a formato JSON y enviarlo de vuelta
        echo json_encode($productos);
    } else {
        echo "No se encontraron productos para la categoría seleccionada.";
    }
} else {
    echo "No se proporcionó ninguna categoría.";
}

// Cerrar la conexión
$conn->close();
?>

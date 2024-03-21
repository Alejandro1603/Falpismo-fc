<?php
// Conectar a la base de datos
$host = "localhost";
$user = "usuario";
$password = "contraseña";
$dbname = "mi_base_de_datos";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Verificar si el nombre de usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Mostrar un mensaje de error
        $error = "El nombre de usuario ya existe.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        // Mostrar un mensaje de éxito
        $success = "El usuario se ha registrado correctamente.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>


<?php
session_start();

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificar las credenciales de inicio de sesión
    if ($username == "usuario" && $password == "contraseña") {
        // Iniciar sesión
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        // Redirigir al usuario a la página de inicio
        header("location: inicio.php");
    } else {
        // Mostrar un mensaje de error
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

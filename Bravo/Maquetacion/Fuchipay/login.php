<?php
session_start(); // Iniciar sesión

require_once 'conexion.php'; // Archivo que contiene la función `conectar_bd()`

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Conectar a la base de datos
$conn = conectar_bd();

// Verificar si el usuario existe
$sql = "SELECT * FROM Usuario WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    
    // Verificar la contraseña
    if (password_verify($password, $usuario['password'])) {
        // Almacenar los datos del usuario en la sesión
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        $_SESSION['id_tipo_usuario'] = $usuario['id_tipo_usuario'];

        // Redirigir al menú principal o dashboard
        header("Location: dashboard.php");
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    echo "No existe una cuenta asociada a este correo.";
}

// Cerrar la conexión
$conn->close();
?>

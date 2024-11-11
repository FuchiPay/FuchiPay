<?php
require_once 'conexion.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$tipo_usuario = "Cliente"; // Tipo de usuario fijo para registro

$conn = conectar_bd();

// Verificar si el correo ya está registrado
$sql_verificar = "SELECT email FROM Usuario WHERE email = ?";
$stmt_verificar = $conn->prepare($sql_verificar);
$stmt_verificar->bind_param("s", $email);
$stmt_verificar->execute();
$stmt_verificar->store_result();

if ($stmt_verificar->num_rows > 0) {
    // Redireccionar a loginyregister.html con el mensaje de error
    header('Location: loginyregister.html?error=email_registered');
} else {
    // Consulta para insertar un nuevo usuario
    $sql_usuario = "INSERT INTO Usuario (nombre_usuario, apellido, email, password, id_tipo_usuario) VALUES (?, ?, ?, ?, (SELECT id_tipo_usuario FROM TipoUsuario WHERE nombre_tipo = ?))";
    $stmt = $conn->prepare($sql_usuario);
    $stmt->bind_param("sssss", $nombre, $apellido, $email, $password, $tipo_usuario);

    if ($stmt->execute()) {
        // Redireccionar a loginyregister.html con éxito
        header('Location: loginyregister.html?success=registered');
    } else {
        // Manejar el error en caso de fallo
        header('Location: loginyregister.html?error=registration_error');
    }

    $stmt->close();
}
$stmt_verificar->close();
$conn->close();

?>

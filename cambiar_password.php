<?php
session_start();
require_once 'conexion.php';

function cambiar_password($usuario_id, $password_actual, $nueva_password) {
    // Conectar a la base de datos
    $conn = conectar_bd();

    // Hash de la nueva contraseña
    $nuevo_password_hashed = password_hash($nueva_password, PASSWORD_BCRYPT);

    // Verificar la contraseña actual del usuario
    $sql = "SELECT password FROM Usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($password_actual, $usuario['password'])) {
        // Actualizar la contraseña
        $sql = "UPDATE Usuario SET password = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nuevo_password_hashed, $usuario_id);
        
        if ($stmt->execute()) {
            $conn->close();
            return "success_password";
        } else {
            $conn->close();
            return "error";
        }
    } else {
        $conn->close();
        return "wrong_password";
    }
}

if (isset($_POST['nueva_password'], $_SESSION['id_usuario'], $_POST['password_actual'])) {
    $message = cambiar_password($_SESSION['id_usuario'], $_POST['password_actual'], $_POST['nueva_password']);
    header("Location: perfil_view.php?message=$message");
} else {
    header("Location: perfil_view.php?message=error");
}
?>

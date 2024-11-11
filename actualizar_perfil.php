<?php
session_start();
require_once 'conexion.php'; // Archivo que contiene la función `conectar_bd()`

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

$conn = conectar_bd();

$id_usuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = isset($_POST['password']) && !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

// Actualizar el nombre y email
$sql = "UPDATE Usuario SET nombre_usuario = ?, email = ? WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $nombre, $email, $id_usuario);

if ($stmt->execute()) {
    // Solo actualizar la contraseña si se proporciona
    if ($password) {
        $sql_password = "UPDATE Usuario SET password = ? WHERE id_usuario = ?";
        $stmt_password = $conn->prepare($sql_password);
        $stmt_password->bind_param("si", $password, $id_usuario);
        $stmt_password->execute();
    }
    echo "Perfil actualizado con éxito.";
} else {
    echo "Error al actualizar el perfil: " . $stmt->error;
}

$conn->close();
?>

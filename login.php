<?php
session_start();
require_once 'conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

$conn = conectar_bd();

$sql = "SELECT * FROM Usuario WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($password, $usuario['password'])) {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario['nombre'];
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        header("Location: menu.html");
        exit();
    } else {
        header("Location: loginyregister.html?error=incorrect_password");
        exit();
    }
} else {
    header("Location: loginyregister.html?error=no_account");
    exit();
}

$conn->close();
?>

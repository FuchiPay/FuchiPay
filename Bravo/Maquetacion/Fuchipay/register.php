<?php
require_once 'conexion.php'; // Asumimos que aquí tienes la función `conectar_bd()`

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptamos la contraseña
$tipo_usuario = $_POST['tipo_usuario'];
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$complejo = isset($_POST['complejo']) ? $_POST['complejo'] : null;

// Conexión a la base de datos
$conn = conectar_bd();

// Primero, inserta el usuario
$sql_usuario = "INSERT INTO Usuario (nombre_usuario, email, password, id_tipo_usuario) VALUES (?, ?, ?, (SELECT id_tipo_usuario FROM TipoUsuario WHERE nombre_tipo = ?))";
$stmt = $conn->prepare($sql_usuario);
$stmt->bind_param("ssss", $nombre, $email, $password, $tipo_usuario);

if ($stmt->execute()) {
    $id_usuario = $stmt->insert_id; // Capturamos el ID del usuario recién creado

    // Si es un administrador, insertar también en la tabla Complejo
    if ($tipo_usuario == 'administrador' && $apellido && $complejo) {
        $sql_complejo = "INSERT INTO Complejo (nombre_complejo, direccion, id_usuario_admin) VALUES (?, 'Sin dirección definida', ?)";
        $stmt_complejo = $conn->prepare($sql_complejo);
        $stmt_complejo->bind_param("si", $complejo, $id_usuario);

        if ($stmt_complejo->execute()) {
            echo "Administrador y complejo registrados con éxito.";
        } else {
            echo "Error al registrar el complejo: " . $stmt_complejo->error;
        }
    } else {
        echo "Usuario registrado con éxito.";
    }
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

// Cerrar la conexión
$conn->close();
?>

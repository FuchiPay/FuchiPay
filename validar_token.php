<?php
// Conectar con la base de datos para validar el token (esto es un ejemplo, adapta según tu estructura)
include('conexion.php'); // Si tienes una conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token_ingresado = $_POST['token'];
    $nueva_contrasena = $_POST['nueva_contrasena'];

    // Verifica que el token ingresado sea correcto (esto depende de cómo almacenes el token)
    // Ejemplo: suponer que tienes una tabla `recuperacion_tokens` con columnas `email` y `token`

    $sql = "SELECT * FROM recuperacion_tokens WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token_ingresado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token válido, permitir al usuario cambiar la contraseña
        echo "Token válido. Ahora puedes cambiar tu contraseña.";
        // Aquí podrías redirigir a un formulario de cambio de contraseña
    } else {
        echo "Token inválido.";
    }
} else {
    // Si no se envió el formulario, mostrar el formulario para ingresar el token
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        ?>
        <form method="POST" action="validar_token.php">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="nuevo_token">Ingresa el token recibido:</label>
            <input type="text" name="token" id="nuevo_token" required>
            <label for="nueva_contrasena">Nueva Contraseña:</label>
            <input type="password" name="nueva_contrasena" id="nueva_contrasena" required>
            <button type="submit">Verificar Token y Cambiar Contraseña</button>
        </form>
        <?php
    }
}
?>

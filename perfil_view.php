<?php
session_start();
require_once 'conexion.php'; // Conexión a la base de datos

// Conectar a la base de datos
$conn = conectar_bd();

// Obtener los datos del usuario desde la base de datos
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM Usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc()
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="perfil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>
<body>
    <!-- Botón de retroceso -->
<button onclick="history.back()" class="back-button" style="border: none; background: none; cursor: pointer; position: absolute; top: 10px; margin-right: 1400px; ">
    <i class='bx bx-arrow-back' style="font-size: 40px;"></i>
</button>
<div class="container">

    <h1>Perfil de Usuario</h1>

    <!-- Foto de perfil con icono de cámara -->
    <div class="profile-pic-container">
        <?php
        if (isset($usuario['foto_perfil']) && !empty($usuario['foto_perfil']) && file_exists($usuario['foto_perfil'])) {
            echo '<img src="' . $usuario['foto_perfil'] . '" alt="Foto de perfil" class="profile-pic">';
        } else {
            echo '<img src="img/perfiles/default.jpg" alt="Foto predeterminada" class="profile-pic">';
        }
        ?>
        <!-- Icono de cámara -->
        <i class='bx bx-camera icon-camera' onclick="document.getElementById('file-input').click();"></i>
    </div>

    <!-- Formulario oculto para subir foto -->
    <form id="photo-form" action="subir_foto.php" method="POST" enctype="multipart/form-data" class="hidden">
        <input type="file" name="foto_perfil" id="file-input" accept="image/*" onchange="document.getElementById('photo-form').submit();">
    </form>

    <!-- Otros detalles del perfil -->
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre_usuario']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>

    <!-- Formulario para cambiar la contraseña -->
    <div>
        <i class='bx bx-key icon-password' onclick="togglePasswordForm();"></i>
        <span>Modificar contraseña</span>
    </div>

    <form id="password-form" action="cambiar_password.php" method="POST">
    <div class="show-input">
        <label for="current_password">Contraseña actual:</label>
        <input type="password" name="password_actual" id="current_password" required>
    </div>
    <div class="show-input">
        <label for="nueva_password">Nueva contraseña:</label>
        <input type="password" name="nueva_password" id="nueva_password" required>
    </div>
    <button type="submit">Actualizar contraseña</button>
</form>
<!-- Modal para mensajes -->
<div id="modal-message" class="modal">
        <div class="modal-content">
            <p id="modal-text"></p>
            <a href="perfil_view.php" id="modal-link">Volver</a>
        </div>
    </div>
 </div>

 
    <script src="script.js"></script>   
    <script>
             // Función para mostrar el formulario de cambio de contraseña
             function togglePasswordForm() {
            var form = document.getElementById("password-form");
            form.classList.toggle("hidden");
        } 
        // Función para mostrar el modal
        function mostrarModal(mensaje, enlace = false) {
            const modal = document.getElementById("modal-message");
            const modalText = document.getElementById("modal-text");
            const modalLink = document.getElementById("modal-link");

            modalText.textContent = mensaje;
            modalLink.style.display = enlace ? "block" : "none";
            modal.style.display = "flex";

            setTimeout(() => {
                modal.style.display = "none";
            }, 2500);
        }

        // Mostrar el modal si hay un parámetro de mensaje en la URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('message')) {
            const messageType = urlParams.get('message');
            let message = '';

            switch (messageType) {
                case 'success_password':
                    message = 'La contraseña se actualizó correctamente.';
                    break;
                case 'wrong_password':
                    message = 'La contraseña actual es incorrecta.';
                    break;
                case 'error':
                    message = 'Hubo un error al actualizar la contraseña.';
                    break;
            }

            mostrarModal(message, messageType === 'success_password');
            // Eliminar el parámetro de mensaje de la URL sin recargar
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
    
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>

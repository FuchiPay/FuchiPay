<?php
session_start();
require_once 'conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Verificar si se ha enviado un archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto_perfil'])) {
    $id_usuario = $_SESSION['id_usuario'];

    // Directorio de destino
    $target_dir = "img/perfiles/";
    $target_file = $target_dir . basename($_FILES["foto_perfil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["foto_perfil"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo (limite 5MB)
    if ($_FILES["foto_perfil"]["size"] > 5000000) {
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 debido a un error
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no se pudo subir.";
    } else {
        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $target_file)) {
            // Actualizar la base de datos con la nueva ruta
            $conn = conectar_bd();
            $sql = "UPDATE Usuario SET foto_perfil = ? WHERE id_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $id_usuario);

            if ($stmt->execute()) {
                echo "La foto de perfil ha sido actualizada.";
                header("Location: perfil_view.php");
            } else {
                echo "Error al actualizar la base de datos.";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}
?>

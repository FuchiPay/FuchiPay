<?php
include('conexion.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Verificar si el correo existe en la base de datos
    $conn = conectar_bd();
    $query = "SELECT id_usuario FROM Usuario WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar el token y la expiración en la base de datos
        $query = "INSERT INTO RecuperacionContraseña (email, token, expiracion) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $token, $expiracion);
        $stmt->execute();

        // Enviar el correo con el enlace de recuperación
        $resetLink = "http://localhost/reset_password.php?token=" . $token;

        // Aquí usa PHPMailer para enviar el correo con el enlace de recuperación
        $mail->setFrom('proyectoloscampeones@gmail.com', 'FuchiPay');
        $mail->addAddress($email);
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body = "Para restablecer tu contraseña, haz clic en el siguiente enlace: <a href='$resetLink'>$resetLink</a>";
        
        if ($mail->send()) {
            echo "Se ha enviado un correo con el enlace de recuperación.";
        } else {
            echo "Hubo un error al enviar el correo.";
        }
    } else {
        echo "El correo no existe en nuestra base de datos.";
    }
}
?>

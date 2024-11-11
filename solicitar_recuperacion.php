<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Recuperacion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contenedor">
        <img class="img-logo" src="img/fuchipay-Photoroom.png" alt="">
        <div class="contenedor-form">
   <!-- solicitar_recuperacion.php -->
    <form class="sign-in" method="post" action="procesar_recuperacion.php">
        <h1>FuchiPay</h1>
        
        <br>
        
        <label style="text-align: justify;" for="email">Correo electrónico:</label>
        <div class="contenedor-input">
              <ion-icon name="mail-outline"></ion-icon> 
              <input type="email" name="email" id="email" required>
        </div>
        <br>
         <button class="button" type="submit">Enviar</button>
    </form>

    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>


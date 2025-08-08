<?php
session_start();

require "Conexion.php"; // conexion DB

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña (usa password_verify si has almacenado las contraseñas de forma segura)
        if ($user['contrasena'] == $password) {
            // Guardar la información del usuario en la sesión
            $_SESSION['Nombre'] = $user['nombre'];
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['email'] = $user['email'];
            // Redirigir al usuario a la página de inicio
            header("Location: inicio.php");
            exit();
        } else {
            $message = "Por Favor Valida los Datos Ingresados"; // Sms Error
        }
    } else {
        $message = "No se encontró ningún usuario con ese correo electrónico.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css" />
    <script src="https://kit.fontawesome.com/bf528d3bda.js" crossorigin="anonymous"></script>

</head>
<body>
  <div class="contenedor-login">
    <div class="login-imagen"></div>

    <div class="modal-contenido">
        <div class="contenido-tab activo" id="tabUsuario">
            <img src="img/logo.jpg" alt="Logo" class="logo-login">
            <h3 style="text-align: center; margin-bottom: 1.5rem; color: var(--color-secundario);">Iniciar Sesión</h3>
            <form action="login.php" method="post">
                <div class="grupo-formulario">
                    <label for="emailUsuario">Correo Electrónico</label>
                    <input type="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                    
                <div class="grupo-formulario">
                    <label for="passwordUsuario">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                    
                <button type="submit" class="boton-enviar">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>
                    
                <p style="text-align: center; margin-top: 1rem;">
                    ¿No tienes cuenta? <a href="#" style="color: var(--color-terciario);">Regístrate aquí</a>
                </p>
            </form>
        </div>
    </div>
</div>
<body>   
</body>
</html>

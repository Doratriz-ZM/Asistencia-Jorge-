   <!-- NO PONGAN MANO .    
<?php
$servername = "localhost";
$database = "asistencia";
$username = "root";
$password = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

PHP DE REGISTRO 
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $password = trim($_POST['password']);

    // Buscar al maestro en la tabla maestro
    $stmt = $conn->prepare("SELECT id_maestro FROM maestro WHERE nom_maes = ? AND apellidos_maes = ?");
    $stmt->bind_param("ss", $nombre, $apellido);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $id_maestro = $row['id_maestro'];

        // Verificar si ya tiene usuario registrado
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE id_maestro = ?");
        $stmt->bind_param("i", $id_maestro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Este usuario ya está registrado.";
        } else {
            // Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar nuevo usuario
            $stmt = $conn->prepare("INSERT INTO usuarios (id_maestro, contraseña) VALUES (?, ?)");
            $stmt->bind_param("is", $id_maestro, $hashed_password);
            if ($stmt->execute()) {
                echo "Registro exitoso.";
            } else {
                echo "Error en el registro.";
            }
        }
    } else {
        echo "El nombre y apellido no coinciden con ningún maestro.";
    }
    
    $stmt->close();
    $conn->close();
}
?>

 PHP DE INICIO DE SESION 
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $password = trim($_POST['password']);

    // Buscar usuario
    $stmt = $conn->prepare("
        SELECT usuarios.id_usuario, usuarios.contraseña 
        FROM usuarios 
        JOIN maestro ON usuarios.id_maestro = maestro.id_maestro
        WHERE maestro.nom_maes = ?
    ");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Verificar contraseña
        if (password_verify($password, $row['contraseña'])) {
            session_start();
            $_SESSION['id_usuario'] = $row['id_usuario'];
            echo "Inicio de sesión exitoso.";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?> 
-->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesión | IPPC</title>
    <link rel="icon" type="image/x-icon" href="images/logo.ico">

    <!--CSS Link-->
    <link rel="stylesheet" href="log-reg.css">

    <!--Icons Links-->
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!--Fonts Links-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,700;1,700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

</head>
<body>

    <div class="login-container">
        <div class="forms">
            <div class="form login">
                <!-- <a href="/Inicio/Index.html" class="bx bx-chevron-left return"></a> -->
                <span class="titulo">Inicia Sesión</span>

                <form action="#">
                    <div class="input-field">
                    <input type="text" name="nombre" placeholder="Nombre de usuario" required>
                    <i class="bx bx-user icon"></i>
                    </div>
                    <div class="input-field">
                    <input type="password" class="password" name="password" placeholder="Contraseña" required>
                    <i class="bx bx-lock-alt icon"></i>
                        <i class="bx bx-hide showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logcheck">
                            <label for="logcheck" class="text">Recordarme</label>
                        </div>

                        <a href="#" class="text">¿Olvidó su contraseña?</a>
                    </div>

                    <div class="input-field button">
                    <button type="submit" value="Acceder">Acceder
                    <a href="/Login-Register-Views/Index.html"></a>
                    </button>
                    </div>
                </form>

                <a href="/"></a>

                <div class="login-signup">
                    <span class="text">¿No tienes cuenta? 
                        <a href="#" class="text signup-link">Regístrate</a></span>
                </div>
            </div>

            <!--Registarse-->
                    <div class="form singup">
                        <span class="titulo">Regístrate</span>
        
                        <form action="#">
                            <div class="input-field">
                            <input type="text" name="nombre" placeholder="Ingrese su nombre" required>
                            <i class="bx bx-user icon"></i>
                            </div>
                            <div class="input-field">
                            <input type="text" name="apellido" placeholder="Ingrese su apellido" required>
                            <i class="bx bx-user icon"></i>
                            </div>
                            <div class="input-field">
                            <input type="password" name="password" placeholder="Crea una contraseña" required>
                            <i class="bx bx-lock-alt icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="password" placeholder="Confirmar contraseña" required>
                                <i class="bx bx-lock-alt icon"></i>
                                <i class="bx bx-hide showHidePw"></i>
                            </div>
        
                            <div class="checkbox-text">
                                <div class="checkbox-content">
                                    <input type="checkbox" id="sigcheck">
                                    <label for="logcheck" class="text">Acepto los términos y condiciones</label>
                                </div>
        
                                <a href="#" class="text"> </a>
                            </div>
        
                            <div class="input-field button">
                            <input type="submit" value="Registrarse">
                            </div>
                        </form>
        
                        <div class="login-signup">
                            <span class="text">¿Ya tienes una cuenta? 
                                <a href="#" class="text login-link">Inicia sesión</a></span>
                        </div>
                    </div>

                    
        </div>
    </div>

    
    <script src="Login-register.js"></script>
</body>
</html>
<?php
// Verificar si se han enviado datos a través del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "root"; // Cambia esto si es necesario
    $password = ""; // Cambia esto si es necesario
    $dbname = "asistencia"; // Nombre de la base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recibir los datos del formulario
    $nom_maes = $_POST['nom_maes'];
    $apellidos_maes = $_POST['apellidos_maes'];
    $cedula_maes = $_POST['cedula_maes'];
    $correo_maes = $_POST['correo_maes'];
    $id_aula = $_POST['id_aula'];
    $id_materia = $_POST['id_materia'];

    // Sentencia SQL para insertar un nuevo maestro
    $sql = "INSERT INTO maestro (nom_maes, apellidos_maes, cedula_maes, correo_maes, id_aula, id_materia) 
            VALUES ('$nom_maes', '$apellidos_maes', '$cedula_maes', '$correo_maes', $id_aula, $id_materia)";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo maestro registrado correctamente.";
    } else {
        echo "Error al registrar el maestro: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "No se enviaron datos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Maestro</title>
</head>
<body>
    <h2>Formulario para Registrar Maestro</h2>
    <form action="insertar_maestro.php" method="POST">
        <label for="nom_maes">Nombre:</label>
        <input type="text" id="nom_maes" name="nom_maes" required><br><br>

        <label for="apellidos_maes">Apellidos:</label>
        <input type="text" id="apellidos_maes" name="apellidos_maes" required><br><br>

        <label for="cedula_maes">Cédula:</label>
        <input type="text" id="cedula_maes" name="cedula_maes" required><br><br>

        <label for="correo_maes">Correo Electrónico:</label>
        <input type="email" id="correo_maes" name="correo_maes" required><br><br>

        <label for="id_aula">ID Aula:</label>
        <input type="number" id="id_aula" name="id_aula" required><br><br>

        <label for="id_materia">ID Materia:</label>
        <input type="number" id="id_materia" name="id_materia" required><br><br>

        <button type="submit" >Registrar Maestro</button>
    </form>
</body>
</html>

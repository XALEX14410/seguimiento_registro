<?php include_once ("modelos/basededatos.php");

// Crear una instancia de la clase BaseDatos
$db = new BaseDatos();

// Conectar a la base de datos
$conn = $db->getBd();

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . $db->mensajes['BD_conexion']);
}

// Obtener el valor de 'id' de la URL
$inicializador = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_pregunta = intval($_POST['id_pregunta']);
    $respuestas = $conn->real_escape_string($_POST['respuestas']);

    // Insertar la respuesta en la tabla 'respuesta'
    $sql_respuesta = "INSERT INTO respuesta (id_pregunta, respuestas) VALUES ($id_pregunta, '$respuestas')";
    if ($conn->query($sql_respuesta)) {
        echo "Respuesta guardada correctamente.<br>";

        // Insertar en la tabla 'seguimiento'
        $sql_seguimiento = "INSERT INTO seguimiento (id_persona, fecha_inicio, estado, inicializador, cadena_seguimiento) 
                            VALUES (1, NOW(), 'activo', $inicializador, 'Encuesta realizada')";
        if ($conn->query($sql_seguimiento)) {
            echo "Seguimiento guardado correctamente.<br>";
        } else {
            echo "Error al guardar el seguimiento: " . $conn->error . "<br>";
        }
    } else {
        echo "Error al guardar la respuesta: " . $conn->error . "<br>";
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Respuestas</title>
</head>
<body>
    <h1>Formulario de Respuestas</h1>
    <form method="POST" action="">
        <label for="id_pregunta">ID de la Pregunta:</label>
        <input type="number" id="id_pregunta" name="id_pregunta" required><br><br>

        <label for="respuestas">Respuesta:</label>
        <textarea id="respuestas" name="respuestas" required></textarea><br><br>

        <button type="submit">Enviar Respuesta</button>

        <a href="http://localhost/seguimiento_registro/index.php?id=7">Compartir</a>
    </form>
</body>
</html>
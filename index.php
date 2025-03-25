<?php
// Incluir el archivo de la base de datos
include_once("modelos/basededatos.php");

// Crear una instancia de la clase BaseDatos
$db = new BaseDatos();

// Conectar a la base de datos
$conn = $db->getBd();

// Verificar si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . $db->mensajes['BD_conexion']);
}

// Obtener el valor de 'id' y 'id_form' de la URL
$inicializador = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_form = isset($_GET['id_form']) ? intval($_GET['id_form']) : 0;

// Obtener las preguntas basadas en el id_form
$sql_preguntas = "SELECT `id_pregunta`, `id_seguimiento`, `preguntas`, `tipo_pregunta` FROM `pregunta` WHERE id_seguimiento = $id_form";
$resultado_preguntas = $conn->query($sql_preguntas);

// Cerrar conexión
$conn->close();

// Incluir la función para generar inputs
include_once("modelos/generar_inputs.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Respuestas</title>
    <style>
        .pregunta {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .pregunta label {
            font-weight: bold;
        }
        .inputs_xd {
            margin-top: 10px;
        }
        .input_text {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Formulario de Respuestas</h1>
    <form method="POST" action="">
        <?php if ($resultado_preguntas && $resultado_preguntas->num_rows > 0): ?>
            <?php while ($pregunta = $resultado_preguntas->fetch_assoc()): ?>
                <?php
                // Convertir las cadenas de texto en arreglos PHP
                $preguntas = json_decode($pregunta['preguntas']);
                $tipos_preguntas = json_decode($pregunta['tipo_pregunta']);

                // Verificar si la decodificación fue exitosa
                if (json_last_error() === JSON_ERROR_NONE && is_array($preguntas) && is_array($tipos_preguntas)) {
                    // Iterar sobre las preguntas y tipos de preguntas
                    foreach ($preguntas as $i => $texto_pregunta) {
                        $tipo_pregunta = $tipos_preguntas[$i] ?? 'Desconocido'; // Obtener el tipo de pregunta correspondiente
                        ?>
                        <div class="pregunta">
                            <label><?php echo htmlspecialchars($texto_pregunta); ?></label>
                            
                            <div class="inputs_xd">
                                <?php echo generarInput($tipo_pregunta, $i); ?>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Error al decodificar las preguntas.</p>";
                }
                ?>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay preguntas disponibles para este formulario.</p>
        <?php endif; ?>

        <button type="submit">Enviar Respuesta</button>
    </form>
</body>
</html>
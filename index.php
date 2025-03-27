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

// Variable para mensajes
$mensaje_exito = '';
$mensaje_error = '';

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si hay respuestas enviadas
    if (isset($_POST['respuesta']) && is_array($_POST['respuesta'])) {
        // Convertir las respuestas a formato JSON
        $respuestas_json = json_encode($_POST['respuesta']);
        
        // Obtener el id_pregunta
        $id_pregunta = 0;
        $sql_pregunta = "SELECT id_pregunta FROM pregunta WHERE id_seguimiento = $id_form LIMIT 1";
        $result = $conn->query($sql_pregunta);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_pregunta = $row['id_pregunta'];
        }
        
        // Insertar en la tabla respuesta
        $sql_respuesta = "INSERT INTO respuesta (id_pregunta, respuestas) VALUES ($id_pregunta, '".$conn->real_escape_string($respuestas_json)."')";
        
        if ($conn->query($sql_respuesta)) {
            // Insertar en la tabla seguimiento
            $sql_seguimiento = "INSERT INTO seguimiento (id_persona, fecha_inicio, estado, inicializador, cadena_seguimiento) 
                                VALUES (1, NOW(), 'activo', $inicializador, 'Encuesta realizada')";
            if ($conn->query($sql_seguimiento)) {
                // Redireccionar para evitar reenvío al recargar
                header("Location: ".$_SERVER['PHP_SELF']."?id=".$inicializador."&id_form=".$id_form."&exito=1");
                exit();
            } else {
                $mensaje_error = "Error al guardar el seguimiento: " . htmlspecialchars($conn->error);
            }
        } else {
            $mensaje_error = "Error al guardar las respuestas: " . htmlspecialchars($conn->error);
        }
    }
}

// Mostrar mensaje de éxito si viene de redirección
if (isset($_GET['exito']) && $_GET['exito'] == 1) {
    $mensaje_exito = "Respuestas guardadas correctamente.";
}

// Obtener las preguntas basadas en el id_form
$sql_preguntas = "SELECT `id_pregunta`, `id_seguimiento`, `preguntas`, `tipo_pregunta` FROM `pregunta` WHERE id_seguimiento = $id_form";
$resultado_preguntas = $conn->query($sql_preguntas);

// Cerrar conexión
$conn->close();
include_once("modelos/funciones.php");
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
            margin: 10px;
        }
        .input_text {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .success {
            color: green;
            margin: 10px 0;
            padding: 10px;
            background-color: #e6ffe6;
            border: 1px solid green;
            border-radius: 4px;
        }
        .error {
            color: red;
            margin: 10px 0;
            padding: 10px;
            background-color: #ffe6e6;
            border: 1px solid red;
            border-radius: 4px;
        }
        .form-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .soporte-link {
            color: #d9534f;
            text-decoration: none;
            font-weight: bold;
        }
        .soporte-link:hover {
            text-decoration: underline;
        }
        .sin-preguntas {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <?php if ($id_form > 0) { ?>
        <h1>Formulario de Respuestas</h1>
        <?php echo presentacion(); ?>
    <?php } ?>
    <?php if (!empty($mensaje_exito)) { ?>
        <div class="success"><?php echo $mensaje_exito; ?></div>
    <?php } ?>
    
    <?php if (!empty($mensaje_error)) { ?>
        <div class="error"><?php echo $mensaje_error; ?></div>
    <?php } ?>
    
    <form method="POST" action="">
        <?php if ($resultado_preguntas && $resultado_preguntas->num_rows > 0) { ?>
            <?php while ($pregunta = $resultado_preguntas->fetch_assoc()) { ?>
                <?php
                // Convertir las cadenas de texto en arreglos PHP
                $preguntas = json_decode($pregunta['preguntas']);
                $tipos_preguntas = json_decode($pregunta['tipo_pregunta']);
                
                // Verificar si la decodificación fue exitosa
                if (json_last_error() === JSON_ERROR_NONE && is_array($preguntas) && is_array($tipos_preguntas)) {
                    // Iterar sobre las preguntas y tipos de preguntas
                    foreach ($preguntas as $i => $texto_pregunta) {
                        $tipo_pregunta = $tipos_preguntas[$i] ?? 'Desconocido';
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
                    echo "<p class='error'>Error al decodificar las preguntas.</p>";
                }
                ?>
            <?php } ?>
        <?php } else { ?>
            <p>No hay preguntas disponibles para este formulario.</p>
            <p>¿Necesitas ayuda? <a href="soporte.php?error=formulario&id_form=<?php echo $id_form; ?>" class="soporte-link">Contacta a soporte técnico</a></p>
        <?php } ?>
        <?php if ($id_form > 0) { ?>

    
        <button type="submit">Enviar Respuesta</button>
        <?php } ?>
    </form>
</div>
</body>
</html>
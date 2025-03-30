<?php
include_once realpath(dirname(__FILE__) . "/../../modelos/listas1.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listas_db = new consulta_observador();
    $con = $listas_db->getBD();
    
    $idPregunta = $_POST['idPregunta'];
    // Decodificar ambos campos desde JSON
    $preguntas = json_decode($_POST['preguntas'], true) ?? [];
    $tipos = json_decode($_POST['tipo_pregunta'], true) ?? [];
    
    // Validar que tengamos la misma cantidad de preguntas y tipos
    if (count($preguntas) !== count($tipos)) {
        die("Error: La cantidad de preguntas no coincide con los tipos de pregunta.");
    }
    
    // Convertir a JSON para almacenar en la base de datos sin escapar caracteres Unicode
    $preguntas_json = json_encode($preguntas, JSON_UNESCAPED_UNICODE);
    $tipos_json = json_encode($tipos, JSON_UNESCAPED_UNICODE);
    
    // Preparar la consulta SQL
    $sql = "UPDATE pregunta SET preguntas = ?, tipo_pregunta = ? WHERE id_pregunta = ?";
    $stmt = $con->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $con->error);
    }
    
    $stmt->bind_param("ssi", $preguntas_json, $tipos_json, $idPregunta);
    
    if ($stmt->execute()) {
        echo "Pregunta actualizada exitosamente";
    } else {
        echo "Error al actualizar la pregunta: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    die("Método no permitido");
}
?>

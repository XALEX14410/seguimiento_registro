<?php
include_once(realpath(dirname(__FILE__) . "/../../modelos/bd_preguntas.php"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $id_pregunta = $_POST['id_pregunta'];
    $id_seguimiento = $_POST['id_seguimiento'];
    $preguntas = $_POST['preguntas'];
    $tipo_pregunta = $_POST['tipo_pregunta'];

    // Crear un objeto de la clase bd_preguntas
    $bd_preguntas = new bd_preguntas();

    if ($mensaje === "OK") {
        // Si no existe, agregar la pregunta
        $pregunta = new pregunta();
        $pregunta->setIdPregunta($id_pregunta);
        $pregunta->setIdSeguimiento($id_seguimiento);
        $pregunta->setPreguntas($preguntas);
        $pregunta->setTipoPregunta($tipo_pregunta);
        
        // Agregar la pregunta
        $bd_preguntas->agrega_pregunta($pregunta);
        echo "Pregunta insertada exitosamente";
    } else {
        // Si existe, retornar el mensaje de error
        echo $mensaje;
    }
}
?>
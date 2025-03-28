<?php
include_once(realpath(dirname(__FILE__) . "/../../modelos/bd_pregunta.php"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicializar la variable $mensaje
    $mensaje = "OK";

    // Recibir los datos del formulario

    $preguntas = $_POST['preguntas'];
    $tipo_pregunta = $_POST['tipo_pregunta'];

    // Crear un objeto de la clase bd_preguntas
    $bd_preguntas = new bd_pregunta();

    if ($mensaje === "OK") {
        // Si no existe, agregar la pregunta
        $pregunta = new dbo_pregunta();

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
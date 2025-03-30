<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el mensaje activo seleccionado
    if (isset($_POST['mensaje_activo'])) {
        // Obtener el ID del mensaje activo seleccionado
        $mensaje_id = $_POST['mensaje_activo'];
        
        // Actualizar el campo 'en_sistema' en la base de datos
        // Establecer 'en_sistema' a 0 para todos los mensajes
        $sql_update = "UPDATE presentacion_formulario SET en_sistema = 0";
        $conn->query($sql_update);
        
        // Establecer 'en_sistema' a 1 para el mensaje seleccionado
        $sql_update_selected = "UPDATE presentacion_formulario SET en_sistema = 1 WHERE id = $mensaje_id";
        $conn->query($sql_update_selected);
        
        // Redireccionar al usuario a alguna página de confirmación
        header("Location: mensaje_actualizado.php");
        exit();
    } else {
        // Si no se seleccionó ningún mensaje, redireccionar a alguna página de error
        header("Location: error.php");
        exit();
    }
} else {
    // Si no se envió el formulario correctamente, redireccionar a alguna página de error
    header("Location: error.php");
    exit();
}
?>

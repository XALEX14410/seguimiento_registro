<?php
// Evitar que se muestren errores como HTML
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Establecer el tipo de contenido como JSON primero
header('Content-Type: application/json');

// Incluir archivo de base de datos
$basededatos_path = realpath(dirname(__FILE__)."/../../modelos/basededatos.php");
if (!file_exists($basededatos_path)) {
    echo json_encode(['success' => false, 'message' => 'Archivo basededatos.php no encontrado']);
    exit();
}

include_once($basededatos_path);

try {
    // Verificar método HTTP
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Método no permitido", 405);
    }

    // Verificar datos POST
    if (!isset($_POST['mensaje_activo'])) {
        throw new Exception("No se especificó mensaje activo", 400);
    }

    // Validar ID
    $mensaje_id = filter_var($_POST['mensaje_activo'], FILTER_VALIDATE_INT);
    if ($mensaje_id === false || $mensaje_id < 1) {
        throw new Exception("ID de mensaje inválido", 400);
    }

    // Crear instancia de BaseDatos
    $db = new BaseDatos();
    $conn = $db->getBd();
    
    if (!$conn) {
        throw new Exception("Error de conexión: " . ($db->mensajes['BD_conexion'] ?? 'Desconocido'), 500);
    }

    // Iniciar transacción
    $conn->autocommit(false);
    
    // 1. Desactivar todos los mensajes
    $sql_desactivar = "UPDATE presentacion_formulario SET en_sistema = 0";
    if (!$conn->query($sql_desactivar)) {
        throw new Exception("Error al desactivar mensajes: " . $conn->error, 500);
    }
    
    // 2. Activar mensaje seleccionado
    $sql_activar = "UPDATE presentacion_formulario SET en_sistema = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql_activar);
    if (!$stmt) {
        throw new Exception("Error al preparar consulta: " . $conn->error, 500);
    }
    
    $stmt->bind_param("i", $mensaje_id);
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar consulta: " . $stmt->error, 500);
    }
    
    // Confirmar transacción
    $conn->commit();
    
    // Respuesta exitosa
    echo json_encode([
        'success' => true,
        'message' => 'Estado actualizado correctamente'
    ]);

} catch (Exception $e) {
    // Revertir transacción si está activa
    if (isset($conn) && $conn) {
        $conn->rollback();
    }
    
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    
} finally {
    // Cerrar conexiones
    if (isset($stmt)) $stmt->close();
    if (isset($conn)) $conn->close();
}
?>
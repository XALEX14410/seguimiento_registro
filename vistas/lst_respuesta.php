<?php
include_once('../modelos/basededatos.php');
include_once('../modelos/listas1.php');

// Crear una instancia de la clase consulta_observador
$consulta_observador = new consulta_observador();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentaciones</title>

    <!-- Librerías de iconos -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" 
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" 
            crossorigin="anonymous"></script>

    <!-- Estilos personalizados -->
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f5f7fa;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }
    
    .contenedor-tabla {
        width: 100%;
        max-width: 1600px;
        overflow-x: auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background-color: #fff;
        margin: 20px 0;
    }
    
    .tabla {
        /* width: 90%; */
        border-collapse: collapse;
        table-layout: fixed;
    }
    
    .tabla__fila1 {
        background-color: #2c3e50;
        color: #fff;
        font-size: 16px;
    }
    
    .tabla__celda {
        padding: 15px;
        text-align: center;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    
    .tabla__celda.color1 {
        font-weight: bold;
        /* color: #2c3e50; */
    }
    
    .tabla__celda.bold {
        font-weight: 700;
    }
    
    .tabla__celda.size1 {
        font-size: 15px;
    }
    
    tbody tr td {
        padding: 18px;
    }
    
    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    tbody tr:hover {
        background-color: #e9f5ff;
    }
    
    .tabla__fila1 .tabla__celda {
        padding: 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    @media (max-width: 768px) {
        .contenedor-tabla {
            width: 95%;
        }
        
        .tabla__celda {
            padding: 10px 8px;
            font-size: 14px;
        }
    }
</style>
</head>
<body>
    <h1 style="text-align: center; color: #333;">Listado de Presentaciones</h1>
    
            <?php echo $consulta_observador->obtener_respuestas(); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="./js/update/dbo_respuesta.js"></script>
</body>
</html>
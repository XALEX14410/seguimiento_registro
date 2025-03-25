<?php
include_once('../modelos/basededatos.php');
include_once('../modelos/presentaciones.php');

// Crear una instancia de la clase Presentaciones
$presentaciones = new Presentaciones();
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
</head>
<body>
    <table class="tabla" width="100%">
        <thead>
            <tr class="tabla__fila1">
                <td class="tabla__celda color1 center bold size1">Título</td>
                <td class="tabla__celda color1 center bold size1">Imagen</td>
                <td class="tabla__celda color1 center bold size1">Video</td>
                <td class="tabla__celda color1 center bold size1">Descripción</td>
                <td class="tabla__celda color1 center bold size1">En Sistema</td>
                <td class="tabla__celda color1 center bold size1">Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php echo $presentaciones->generarContenidoTabla(); ?>
        </tbody>
    </table>
</body>
</html>
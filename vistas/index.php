<?php
// Nombre de este archivo para excluirlo del listado
$current_file = basename(__FILE__);

// Obtener todos los archivos del directorio actual
$files = scandir('.');

// Configuración
$exclude_files = ['.', '..', $current_file]; // Archivos a excluir
$title = "Índice de Archivos"; // Título de la página

// Filtrar archivos
$filtered_files = array_diff($files, $exclude_files);

// Ordenar alfabéticamente
sort($filtered_files);

// Iniciar HTML
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>$title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 8px;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .file-info {
            color: #666;
            font-size: 0.9em;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>$title</h1>
    <ul>";

// Generar enlaces
foreach ($filtered_files as $file) {
    $file_size = filesize($file);
    $file_date = date("Y-m-d H:i:s", filemtime($file));
    
    echo "<li>
            <a href='$file'>$file</a>
            <span class='file-info'>($file_size bytes, modificado: $file_date)</span>
          </li>";
}

// Cerrar HTML
echo "</ul>
</body>
</html>";
?>
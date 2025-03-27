<?php
include_once("modelos/basededatos.php");
include_once("modelos/funciones.php");

$error_formulario = isset($_GET['error_form']) ? $_GET['error_form'] : '';

// Procesar formulario de soporte
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';
    $formulario_problema = $_POST['formulario'] ?? '';
    
    // Validar y enviar a base de datos o correo
    // ...
    
    header("Location: soporte.php?exito=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Soporte Técnico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos generales */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
}

/* Contenedor principal */
.contenedor-soporte {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.2em;
}

/* Estilos del formulario */
form {
    margin: 40px;
    display: block;
}

.campo-formulario {
    margin:0px 0px 0px 0px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
}

input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
}

input[readonly] {
    background-color: #f9f9f9;
    color: #777;
    cursor: not-allowed;
}

textarea {
    min-height: 150px;
    resize: vertical;
}

/* Botón de enviar */
.boton-enviar {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: block;
    width: 100%;
    font-weight: 600;
}

.boton-enviar:hover {
    background-color: #2980b9;
}

/* Mensajes */
.mensaje-exito {
    background-color: #d4edda;
    color: #155724;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #c3e6cb;
    text-align: center;
}

/* Información de contacto */
.informacion-contacto {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 4px;
    border-left: 4px solid #3498db;
}

.informacion-contacto h2 {
    color: #2c3e50;
    margin-top: 0;
    font-size: 1.4em;
}

.informacion-contacto p {
    margin: 10px 0;
    color: #555;
}

/* Responsive */
@media (max-width: 600px) {
    .contenedor-soporte {
        padding: 20px;
    }
    
    h1 {
        font-size: 1.8em;
    }
}
    </style>
    <link rel="stylesheet" href="estilos/soporte.css">
</head>
<body>
    <div class="contenedor-soporte">
        <h1>Soporte Técnico</h1>
        
        <?php if (isset($_GET['exito'])): ?>
        <div class="mensaje-exito">
            Hemos recibido tu solicitud. Nos contactaremos contigo pronto.
        </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="campo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="campo-formulario">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="campo-formulario">
                <label for="formulario">Formulario con problemas:</label>
                <input type="text" id="formulario" name="formulario" 
                       value="<?= htmlspecialchars($error_formulario) ?>" readonly>
            </div>
            
            <div class="campo-formulario">
                <label for="mensaje">Describe el problema:</label>
                <textarea id="mensaje" name="mensaje" required></textarea>
            </div>
            
            <button type="submit" class="boton-enviar">Enviar solicitud</button>
        </form>
        
        <div class="informacion-contacto">
            <h2>También puedes contactarnos:</h2>
            <p>Teléfono: +1 (123) 456-7890</p>
            <p>Correo: soporte@tudominio.com</p>
            <p>Horario: Lunes a Viernes, 9:00 - 18:00</p>
        </div>
    </div>
</body>
</html>
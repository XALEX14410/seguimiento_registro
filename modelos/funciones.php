<?php
include_once ('../modelos/basededatos.php');    
// include_once realpath(dirname(__FILE__)."/../modelos/database.php");

// Función para procesar el formulario y guardar los datos en la base de datos
function procesarFormulario($titulo, $descripcion, $imagen, $video, $conn) {
    // Valor predeterminado para en_sistema
    $en_sistema = 1;

    // Verificar si se ingresó un video y obtener su ID de YouTube
    if (!empty($video)) {
        $videoId = obtenerIdYouTube($video);
    } else {
        $videoId = null;
    }

    // Consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO presentacion_formulario (titulo, imagen, video, descripcion, en_sistema) VALUES ('$titulo', '$imagen', '$videoId', '$descripcion', $en_sistema)";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir al usuario a una página diferente después de insertar los datos
        header("Location: formulario_subido.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para extraer el ID del video de YouTube de la URL
function obtenerIdYouTube($url) {
    $id = null;
    $match = preg_match('/[?&]v=([^?&]+)/', $url, $matches);
    if ($match) {
        $id = $matches[1];
    } else {
        $match = preg_match('/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([^?&]+)/', $url, $matches);
        if ($match) {
            $id = $matches[1];
        }
    }
    return $id;
}

// Función para guardar la imagen en la carpeta "img/"
function guardarImagen($imagen) {
    // Crear la carpeta "img/" si no existe
    if (!file_exists('img')) {
        mkdir('img', 0777, true);
    }
    // Generar un nombre único para la imagen
    $nombreImagen = 'img/' . uniqid() . '_' . $imagen['name'];
    // Mover la imagen a la carpeta "img/"
    move_uploaded_file($imagen['tmp_name'], $nombreImagen);
    return $nombreImagen;
}

// Función para obtener el mensaje activo en el sistema
function obtenerMensajeActivo() {
    global $conn; // Hacemos global la variable de conexión

    // Verificamos si la conexión está establecida
    if ($conn) {
        // Consultar los mensajes activos en el sistema
        $sql = "SELECT * FROM presentacion_formulario WHERE en_sistema = 1";
        $resultado = $conn->query($sql);

        // Contar la cantidad de mensajes activos
        $cantidad_mensajes_activos = $resultado->num_rows;

        // Si hay más de un mensaje activo, mostrar formulario para seleccionar uno
        if ($cantidad_mensajes_activos > 1) {
            echo "<form action='actualizar_mensaje_activo.php' method='post'>";
            echo "<p>¡Advertencia! Hay más de un mensaje activo en el sistema. Por favor, elija uno para mantener activo:</p>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<label><input type='radio' name='mensaje_activo' value='" . $fila["id"] . "'>" . $fila["titulo"] . "</label><br>";
            }
            echo "<button type='submit' name='submit'>Confirmar</button>";
            echo "</form>";
        } elseif ($cantidad_mensajes_activos == 1) {
            // Si hay un único mensaje activo, mostrar ese mensaje
            $mensaje_activo = $resultado->fetch_assoc()["titulo"];
            echo "<p class='main__titulo text_presentation' id='miParrafo'>El mensaje activo en el sistema es: \"$mensaje_activo\"</p>";
        } else {
            // Si no hay mensajes activos, mostrar un mensaje indicando que no hay mensajes activos
            echo "<p class='main__titulo text_presentation'>No hay ningún mensaje activo en el sistema</p>";
        }
    } else {
        // Mostramos un mensaje de error si la conexión no está establecida
        echo "<p class='main__titulo text_presentation'>Error: No se pudo conectar a la base de datos.</p>";
    }
}


function obtenerMensajeActivo_comprobacion() {
    global $conn; // Hacemos global la variable de conexión

    // Verificamos si la conexión está establecida
    if ($conn) {
        // Consultar los mensajes activos en el sistema
        $sql = "SELECT * FROM presentacion_formulario WHERE en_sistema = 1";
        $resultado = $conn->query($sql);

        // Contar la cantidad de mensajes activos
        $cantidad_mensajes_activos = $resultado->num_rows;

        // Si hay exactamente un mensaje activo, retornarlo, de lo contrario, retornar NULL
        if ($cantidad_mensajes_activos == 1) {
            return $resultado->fetch_assoc();
        } else {
            return NULL;
        }
    } else {
        // Mostramos un mensaje de error si la conexión no está establecida
        echo "<p>Error: No se pudo conectar a la base de datos.</p>";
        return NULL;
    }
}


// Función para generar el HTML del formulario basado en el mensaje activo en el sistema
function presentacion() {
    $mensaje_activo = obtenerMensajeActivo_comprobacion();

    // Verificar si hay un mensaje activo
    if ($mensaje_activo) {
        // Generar el HTML del formulario con los datos del mensaje activo
        $html = '
        <div class="formulario">
            <h3 class="main__titulo subtitle">' . $mensaje_activo['titulo'] . '</h3>
            <div class="formulario__contenedor">
                <!-- Imagen del logo -->
                <div class="formulario__img">
                    <img src="' . $mensaje_activo['imagen'] . '" class="img img-form" alt="Imagen del formulario"/>
                </div>
                
            </div>
            <div class="formulario__contenedor">
            <div class="formulario__img">
                <!-- Video del formulario -->
                ';
        // Verificar si se proporcionó un video
        if ($mensaje_activo['video']) {
            $video_url = 'https://www.youtube.com/embed/' . obtenerIdYouTube($mensaje_activo['video']);
            $html .= '<iframe width="560" height="315" src="' . $video_url . '" frameborder="0" allowfullscreen></iframe>';
            ;
        } else {
            $html .= '<p>No se ingresó un video</p>';
        }
        $html .= '
            </div>
            <div class="formulario__contenedor"><div class="formulario__img">
            <p class="formulario__parrafo">' . $mensaje_activo['descripcion'] . '</p>
       </div> </div></div>';
    } else {
        // Mostrar un mensaje de error si no hay un mensaje activo
        $html = '<div class="formulario">
        <h3 class="main__titulo subtitle">LFTECH</h3>
        <div class="formulario__contenedor">
            <!-- Imagen del logo -->
            <div class="formulario__img">
                <img src="img/2.svg" class="img img-form" alt="Imagen del formulario"/>
            </div>
            </div>
        </div>';
    }
    



    // Retornar el HTML generado
    return $html;
}


            
            

            

?>





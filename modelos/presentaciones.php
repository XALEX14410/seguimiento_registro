<?php
include_once realpath(dirname(__FILE__)."/../modelos/basededatos.php");
// include_once realpath(dirname(__FILE__)."/../clases/presentacion_formulario.php");
include_once('funciones.php');

class Presentaciones {
    public function generarContenidoTabla() {
        // Crear instancia de BaseDatos
        $db = new BaseDatos();
        $con = $db->getBd();
        
        if (!$con) {
            die("Error de conexión: " . $db->mensajes['BD_conexion']);
        }

        $sql = "SELECT id, titulo, imagen, video, descripcion, en_sistema FROM presentacion_formulario";
        $resultado = $con->query($sql);
        
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table class='tabla' border='1'>";
            echo "<thead>";
            echo "<tr class='tabla__fila1'>";
            echo "<th>Título</th>";
            echo "<th>Imagen</th>";
            echo "<th>Video</th>";
            echo "<th>Descripción</th>";
            echo "<th>En Sistema</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='tabla__celda-body color2 center normal size2'>" . htmlspecialchars($fila['titulo']) . "</td>";
                
                // Celda para la imagen
                echo "<td class='tabla__celda-body color2 center normal size2'>";
                if ($fila["imagen"]) {
                    $extension = strtolower(pathinfo($fila["imagen"], PATHINFO_EXTENSION));
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        echo "<img src='" . htmlspecialchars($fila["imagen"]) . "' alt='Imagen' style='max-width: 100px; max-height: 100px;'>";
                    } else {
                        echo "<p>No existe imagen válida</p>";
                    }
                } else {
                    echo "<p>No existe imagen</p>";
                }
                echo "</td>";
                
                // Celda para el video
                echo "<td class='tabla__celda-body color2 center normal size2'>";
                if ($fila["video"]) {
                    echo "<iframe width='160' height='90' src='https://www.youtube.com/embed/" . htmlspecialchars(obtenerIdYouTube($fila["video"])) . "' frameborder='0' allowfullscreen></iframe>";
                } else {
                    echo "No se ingresó un video";
                }
                echo "</td>";
                
                echo "<td class='tabla__celda-body color2 center normal size2'>" . htmlspecialchars($fila['descripcion']) . "</td>";
                // Dentro de tu bucle donde muestras los registros
                echo "<td class='tabla__celda-body color2 center normal size2'>";
                echo "<button id='btnEstadoSistema-".$fila['id']."' 
                        class='btn-estado ".($fila["en_sistema"] ? 'btn-activo' : 'btn-inactivo')."'
                        data-id='".$fila['id']."'
                        data-estado='".($fila["en_sistema"] ? '1' : '0')."'>";
                echo ($fila["en_sistema"] ? "Sí" : "No");
                echo "</button>";
                echo "</td>";  
                // Celda para acciones
                echo "<td class='tabla__celda-body center' width='100'>";
                echo "<div class='contenedor-btn contenedor-btn2'>";
                echo "<a href='./act_mesa.php?id=" . urlencode($fila['id']) . "' title='Editar la mesa' class='btn btn-small btn-radius2 btn-exito'><i class='bi bi-pen icono-5'></i></a>";
                echo "<a title='Eliminar la mesa' class='btn btn-small btn-radius2 btn-peligro' onclick='eliminar(" . $fila['id'] . ")'><i class='bi bi-trash3 icono-5'></i></a>";
                echo "</div>";
                echo "</td>";
                
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No hay datos disponibles</p>";
        }
        
        // Cerrar la conexión
        $con->close();
    }
}
?>
<?php
// Incluir la clase BaseDatos para la conexión a la base de datos
include_once realpath(dirname(__FILE__) . "/../modelos/basededatos.php");

class consulta_observador extends BaseDatos // Heredar de listas_select
{

    // Método para obtener todas las preguntas
    public function obtener_preguntas()
    {
        $sql = "SELECT `id_pregunta`, `id_seguimiento`, `preguntas`, `tipo_pregunta` FROM `pregunta`";
        $con = $this->getBD();
        $resultado = $con->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table class='tabla' border='1'>   <thead>";
            echo "<tr class='tabla__fila1'><th>ID Pregunta</th><th>ID Seguimiento</th><th>Pregunta</th><th>Tipo Pregunta</th><th>Acciones</th></tr>         </thead>
        <tbody>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['id_pregunta']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['id_seguimiento']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['preguntas']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['tipo_pregunta']) . "</td>";
                echo "<td><a href='editar_pregunta.php?id=" . urlencode($fila['id_pregunta']) . "'>Editar</a></td>";
                echo "</tr>";
            }
            echo "      </tbody></table>";
        } else {
            echo "<p>No se encontraron preguntas.</p>";
        }
    }

    // Método para obtener todas las respuestas
    public function obtener_respuestas()
    {
        $sql = "SELECT `id_respuesta`, `id_pregunta`, `respuestas` FROM `respuesta`";
        $con = $this->getBD();
        $resultado = $con->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table class='tabla' border='1'>   <thead>";
            echo "<tr class='tabla__fila1'><th>ID Respuesta</th><th>ID Pregunta</th><th>Respuesta</th><th>Acciones</th></tr>         </thead>
        <tbody>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['id_respuesta']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['id_pregunta']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['respuestas']) . "</td>";
                echo "<td><a href='editar_respuesta.php?id=" . urlencode($fila['id_respuesta']) . "'>Editar</a></td>";
                echo "</tr>";
            }
            echo "      </tbody></table>";
        } else {
            echo "<p>No se encontraron respuestas.</p>";
        }
    }

    // Método para obtener todos los seguimientos
    public function obtener_seguimientos()
    {
        $sql = "SELECT `id_seguimiento`, `id_persona`, `fecha_inicio`, `estado`, `inicializador`, `cadena_seguimiento` FROM `seguimiento`";
        $con = $this->getBD();
        $resultado = $con->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table class='tabla' border='1'>   <thead>";
            echo "<tr class='tabla__fila1'><th>ID Seguimiento</th><th>ID Persona</th><th>Fecha Inicio</th><th>Estado</th><th>Inicializador</th><th>Cadena Seguimiento</th><th>Acciones</th></tr>         </thead>
        <tbody>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['id_seguimiento']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['id_persona']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['fecha_inicio']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['estado']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['inicializador']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['cadena_seguimiento']) . "</td>";
                echo "<td><a href='editar_seguimiento.php?id=" . urlencode($fila['id_seguimiento']) . "'>Editar</a></td>";
                echo "</tr>";
            }
            echo "      </tbody></table>";
        } else {
            echo "<p>No se encontraron seguimientos.</p>";
        }
    }

}
?>
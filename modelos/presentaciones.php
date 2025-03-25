<?php
include_once('basededatos.php');
include_once('funciones.php');

class Presentaciones {
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
        $conn = $this->db->getBd();
        
        if (!$conn) {
            die("Error de conexión: " . $this->db->mensajes['BD_conexion']);
        }
    }

    public function generarContenidoTabla() {
        $conn = $this->db->getBd();
        $output = '';

        // Consulta SQL para obtener los datos de la base de datos
        $sql = "SELECT id, titulo, imagen, video, descripcion, en_sistema FROM presentacion_formulario";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Salida de datos de cada fila en la tabla
            while ($row = $result->fetch_assoc()) {
                $output .= "<tr>";
                $output .= "<td class='tabla__celda-body color2 center normal size2'>" . $row["titulo"] . "</td>";
                $output .= "<td class='tabla__celda-body color2 center normal size2'>";
                if ($row["imagen"]) {
                    $extension = strtolower(pathinfo($row["imagen"], PATHINFO_EXTENSION));
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $output .= "<img src='" . $row["imagen"] . "' alt='Imagen' style='max-width: 100px; max-height: 100px;'>";
                    } else {
                        $output .= "<p>No existe imagen válida</p>";
                    }
                } else {
                    $output .= "<p>No existe imagen</p>";
                }
                $output .= "</td>";
                $output .= "<td class='tabla__celda-body color2 center normal size2'>";
                if ($row["video"]) {
                    $output .= "<iframe width='160' height='90' src='https://www.youtube.com/embed/" . obtenerIdYouTube($row["video"]) . "' frameborder='0' allowfullscreen></iframe>";
                } else {
                    $output .= "No se ingresó un video";
                }
                $output .= "</td>";
                $output .= "<td class='tabla__celda-body color2 center normal size2'>" . $row["descripcion"] . "</td>";
                $output .= "<td class='tabla__celda-body color2 center normal size2'>" . ($row["en_sistema"] ? "Sí" : "No") . "</td>";
                $output .= "<td class='tabla__celda-body center' width='100'>
                            <div class='contenedor-btn contenedor-btn2'>
                                <a href='./act_mesa.php' title='Editar la mesa' class='btn btn-small btn-radius2 btn-exito'><i class='bi bi-pen icono-5'></i></a>
                                <a title='Eliminar la mesa' class='btn btn-small btn-radius2 btn-peligro' onclick='eliminar()'><i class='bi bi-trash3 icono-5'></i></a>
                            </div>
                        </td>";
                $output .= "</tr>";
            }
        } else {
            $output .= "<tr><td class='tabla__celda-body color2 center normal size2' colspan='6'>No hay datos disponibles</td></tr>";
        }

        // Cerrar la conexión
        $conn->close();

        return $output;
    }
}
?>
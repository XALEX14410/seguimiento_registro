<?php
include_once realpath(dirname(__FILE__) . "/../../modelos/listas1.php");

$listas_db = new consulta_observador();
$pregunta = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $con = $listas_db->getBD();
    $sql = "SELECT `id_pregunta`, `preguntas`, `tipo_pregunta` FROM `pregunta` WHERE id_pregunta = ?";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $con->error);
    }

    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $pregunta = $resultado->fetch_assoc();
        
        // Convertir los strings JSON a arrays
        $preguntas_array = json_decode($pregunta['preguntas'], true);
        $tipos_array = json_decode($pregunta['tipo_pregunta'], true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $preguntas_array = [$pregunta['preguntas']];
            $tipos_array = [$pregunta['tipo_pregunta']];
        }
        
        $pregunta['preguntas_array'] = $preguntas_array;
        $pregunta['tipos_array'] = $tipos_array;
    } else {
        die("No se encontró la pregunta con el ID proporcionado.");
    }

    $stmt->close();
} else {
    die("No se proporcionó un ID válido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Pregunta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./../../css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./../../css/admin.css">
  <link rel="stylesheet" href="./../../css/footer.css">
  <link rel="stylesheet" href="./../../css/header.css">
  <link rel="stylesheet" href="./../../css/tables_desing.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    textarea {
        resize: vertical;
        width: 100%;
        overflow: hidden;
        min-height: 40px;
    }
    .form-container {
        background-color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .select-container {
        margin-bottom: 1rem;
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }
    .additional-content {
        margin-top: 1rem;
    }
    .hidden {
        display: none;
    }
    .inputs_xd {
        margin-bottom: 1rem;
    }
    .input_text {
        margin-bottom: 0.5rem;
        width: 100%;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    .opcione {
        display: flex;
        gap: 1rem;
    }
    .div_radio {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
  </style>
</head>

<body class="bg-light">
  <div class="container mt-5">
    <section class="form-container shadow rounded">
      <h1 class="text-center mb-4 text-primary">Actualizar Pregunta <i class="bi bi-pencil-square"></i></h1>

      <div id="contentContainer" class="mb-3 border p-3 rounded bg-light">
        <p><i class="bi bi-info-circle"></i> Aquí puedes editar los detalles de la pregunta seleccionada.</p>
      </div>

      <form method="POST" id="form_pregunta">
        <input type="hidden" name="idPregunta" value="<?= htmlspecialchars($_GET['id']) ?>">

        <!-- Los selects y artículos se generarán aquí dinámicamente -->
        
        <div class="envio_perron text-end mt-3">
          <button type="submit" class="btn btn-success" id="saveButton">
            <i class="bi bi-save"></i> Actualizar
          </button>
        </div>
      </form>
    </section>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
<!-- Corregir estas líneas -->
<!-- <script src="./../../vistas/js/script.js"></script> -->
<script src="./../../vistas/js/update/editar_pregunta.js"></script>
<script>
    // Pasar datos PHP a JavaScript
    const preguntaData = {
        preguntasArray: <?= isset($pregunta['preguntas_array']) ? json_encode($pregunta['preguntas_array']) : '[]' ?>,
        tiposArray: <?= isset($pregunta['tipos_array']) ? json_encode($pregunta['tipos_array']) : '[]' ?>
    };
    console.log("Datos precargados:", preguntaData); // Para depuración
</script>
</body>
</html>
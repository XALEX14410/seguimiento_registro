<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generador de Selección</title>
  <link href="./../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./../css/estilos.css">
  <link rel="stylesheet" href="./../css/icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <section class="bg-white p-4 shadow rounded">
      <h1 class="text-center mb-4 text-primary">
        Generador de Selección 
        <i class="bi bi-lightbulb"></i>
      </h1>
      
      <div id="contentContainer" class="mb-3 border p-3 rounded bg-light">
        <p>
          <i class="bi bi-info-circle"></i> 
          Aquí puedes generar tus selecciones de manera rápida.
        </p>
      </div>
      
      <form method="POST" id="form_pregunta">
        <div class="text-end mt-3">
          <button class="btn btn-success" id="saveButton">
            <i class="bi bi-send"></i> 
            Enviar
          </button>
        </div>
      </form>
    </section>
  </div>

  <!-- Botón flotante -->
  <button class="btn btn-primary position-fixed d-flex align-items-center justify-content-center shadow-lg" onclick="generateSelect()" style="bottom: 20px; right: 20px; border-radius: 50%; width: 50px; height: 50px;">
    <i class="bi bi-plus-circle-fill"></i>
  </button>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./../js/script.js"></script>
  <script src="./../js/insert/dbo_pregunta.js"></script>
</body>
</html>

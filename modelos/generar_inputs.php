<?php
// ./modelos/generar_inputs.php

function generarInput($tipo_pregunta, $index) {
    switch ($tipo_pregunta) {
        case 'Respuesta Corta':
            return '
                <div class="inputs_xd">
                    
                    <input class="input_text" type="text" name="respuesta[' . $index . ']" placeholder="Texto de respuesta breve" required>
                </div>
            ';
        case 'Párrafo':
            return '
                <div class="inputs_xd">
      
                    <textarea class="input_text" name="respuesta[' . $index . ']" placeholder="Texto de respuesta larga" required></textarea>
                </div>
            ';
        case 'Pregunta de Opción Múltiple':
            return '
                <div class="inputs_xd">
      
                    <div class="opcione">
                        <div class="div_radio">
                            <input type="radio" name="opcion_multiple[' . $index . '][]" value="1">
                            <input type="radio" name="opcion_multiple[' . $index . '][]" value="2">
                            <input type="radio" name="opcion_multiple[' . $index . '][]" value="3">
                        </div>
                        <div class="div_input">
                            <input class="input_text" type="text" name="opcion_multiple_texto[' . $index . '][]" value="Opción 1" required>
                            <input class="input_text" type="text" name="opcion_multiple_texto[' . $index . '][]" required>
                            <input class="input_text" type="text" name="opcion_multiple_texto[' . $index . '][]" required>
                        </div>
                    </div>
                </div>
            ';
        case 'Casillas de Verificación':
            return '
                <div class="inputs_xd">
      
                    <div class="opcione">
                        <div class="div_radio">
                            <input type="checkbox" name="casillas_verificacion[' . $index . '][]" value="1">
                            <input type="checkbox" name="casillas_verificacion[' . $index . '][]" value="2">
                            <input type="checkbox" name="casillas_verificacion[' . $index . '][]" value="3">
                        </div>
                        <div class="div_input">
                            <input class="input_text" type="text" name="casillas_verificacion_texto[' . $index . '][]" value="Opción 1" required>
                            <input class="input_text" type="text" name="casillas_verificacion_texto[' . $index . '][]" required>
                            <input class="input_text" type="text" name="casillas_verificacion_texto[' . $index . '][]" required>
                        </div>
                    </div>
                </div>
            ';
        // Agrega más casos según sea necesario
        default:
            return '<p>Tipo de pregunta no soportado.</p>';
    }
}
?>
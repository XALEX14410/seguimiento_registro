document.getElementById("form_pregunta").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío tradicional del formulario 
    // Recolectar los valores de los inputs y selects
    var inputValues = collectInputTextValues();
    var selectedOptions = collectSelectedOptions();
    
    // Combinar todos los valores para enviar como preguntas
    var todasLasPreguntas = {
        inputs: inputValues,
        selects: selectedOptions
    };
    
    // Convertir a JSON para enviar
    var preguntasJSON = JSON.stringify(todasLasPreguntas);

    // Crear el objeto FormData para enviar
    var formData = new FormData();
    
    
    formData.append("preguntas", preguntasJSON);
    formData.append("tipo_pregunta", "mixto"); // Puedes ajustar esto según necesites

    // Mostrar en consola lo que se enviará (para depuración)
    console.log("Datos a enviar:", {

        preguntas: todasLasPreguntas,
        tipo_pregunta: "mixto"
    });

    // Realizar la petición AJAX
    fetch("./../../controladores/insert/ct_pregunta.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Manejar la respuesta del servidor
        if (data.includes("exitosamente")) {
            Swal.fire({
                title: 'Éxito!',
                text: 'Pregunta insertada correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                location.reload(); // Recargar la página después de insertar
            });
        } else {
            Swal.fire({
                title: 'Error',
                html: 'Error al insertar la pregunta: <br><b>' + data + '</b>',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'Error en la conexión con el servidor',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
});

// Función para recolectar valores de inputs de texto
function collectInputTextValues() {
    var inputValues = [];
    var inputs = document.querySelectorAll(".input_text");
    
    inputs.forEach(function(input) {
        // Solo agregar si tiene valor
        if (input.value.trim() !== '') {
            inputValues.push({
                id: input.id,
                name: input.name,
                value: input.value
            });
        }
    });

    return inputValues;
}

// Función para recolectar opciones seleccionadas en selects
function collectSelectedOptions() {
    var selectedOptions = [];
    var selects = document.querySelectorAll("select");
    
    selects.forEach(function(select) {
        // Solo agregar si tiene una selección válida (no la opción por defecto)
        if (select.selectedIndex > 0) {
            selectedOptions.push({
                id: select.id,
                name: select.name,
                selectedValue: select.value,
                selectedText: select.options[select.selectedIndex].text
            });
        }
    });

    return selectedOptions;
}

// Función para recolectar los nombres de las opciones seleccionadas en los selects
function collectSelectedOptions() {
    var selectedOptions = [];
    // Obtener todos los selects
    var selects = document.querySelectorAll("select");
    
    // Recorrer los selects y recolectar los nombres de las opciones seleccionadas
    selects.forEach(function(select) {
        var selectedOption = select.options[select.selectedIndex].text;
        selectedOptions.push(selectedOption);
    });

    return selectedOptions;
}

// Función para imprimir el contenido de #select1
function printSelect1Value() {
    var select1 = document.getElementById("select1");
    if (select1) {
        console.log("Valor seleccionado en #select1:", select1.value);
    } else {
        console.log("No se encontró el elemento #select1");
    }
}

// Ejemplo de cómo usar las funciones anteriores
function saveAndPrint() {
    var inputValues = collectInputTextValues();
    var selectedOptions = collectSelectedOptions();
    
    console.log("Valores de los .input_text:", inputValues);
    console.log("Opciones seleccionadas:", selectedOptions);
    printSelect1Value();
    return inputValues,selectedOptions;
}

// Puedes llamar a saveAndPrint() en un evento, como al hacer clic en un botón
document.getElementById("saveButton").addEventListener("click", saveAndPrint);
document.getElementById("form_pregunta").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de la manera tradicional
    
    // Obtener los valores directamente en este scope
 // Obtener valores
 var inputValues = collectInputTextValues();
 var selectedOptions = collectSelectedOptions();
 
 // Convertir arreglos a formato string "[valor1,valor2,...]"
 var preguntasString = "[" + inputValues.map(v => `"${v}"`).join(",") + "]";
 var tiposString = "[" + selectedOptions.map(v => `"${v}"`).join(",") + "]";
 console.log("Preguntas:", preguntasString);
    console.log("Tipos:", tiposString);
 // Crear FormData
 var formData = new FormData();
 formData.append("preguntas", preguntasString); // Ejemplo: ["preg1","preg2"]
 formData.append("tipo_pregunta", tiposString); // Ejemplo: ["tipo1","tipo2"]

    // Realizar el POST usando Fetch API
    fetch("./../../controladores/insert/ct_pregunta.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // Procesar la respuesta del servidor
    .then(data => {
        // Mostrar la respuesta usando SweetAlert
        if (data.includes("exitosamente")) {
            Swal.fire({
                title: 'Éxito!',
                text: 'Pregunta insertada exitosamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                location.reload(); // Recargar la página tras éxito
            });
        } else {
            Swal.fire({
                title: 'Error',
                html: 'Hubo un problema al insertar la pregunta: <br><b>' + data + '</b>',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }        
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'Hubo un error al enviar los datos.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    });
});
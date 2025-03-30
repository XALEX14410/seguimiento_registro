// Función de inicialización que se ejecuta cuando la página está completamente cargada
window.onload = function() {
    // Verificar si tenemos datos de pregunta para precargar
    if (typeof preguntaData !== 'undefined' && preguntaData.preguntasArray && preguntaData.tiposArray) {
        // Limpiar el contenedor pero mantener el mensaje inicial
        const contentContainer = document.getElementById('contentContainer');
        contentContainer.innerHTML = '<p><i class="bi bi-info-circle"></i> Aquí puedes editar los detalles de la pregunta seleccionada.</p>';
        
        // Generar campos para cada pregunta existente
        for (let i = 0; i < preguntaData.preguntasArray.length; i++) {
            generateSelectWithData(
                preguntaData.preguntasArray[i], 
                preguntaData.tiposArray[i]
            );
        }
        
        // Asegurar que el campo id_pregunta está en el formulario
        if (!document.querySelector('[name="idPregunta"]') && preguntaData.id_pregunta) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'idPregunta';
            hiddenInput.value = preguntaData.id_pregunta;
            document.getElementById('form_pregunta').appendChild(hiddenInput);
        }
    } else {
        // Si no hay datos, generar un campo vacío
        generateSelectWithData();
    }
};

var selectCount = 1; // Contador de campos de pregunta

// Función para generar campos de pregunta con datos precargados
function generateSelectWithData(preguntaText = "", tipoPregunta = "Respuesta Corta") {
    const contentContainer = document.getElementById("contentContainer");
    const selectContainerId = "selectContainer-" + selectCount;

    // Crear contenedor principal
    const selectContainer = document.createElement("div");
    selectContainer.className = "select-container mb-3 p-3 border rounded";
    selectContainer.id = selectContainerId;

    // Crear select para tipo de pregunta
    const select = document.createElement("select");
    select.className = "form-select mb-2";
    select.id = "select" + selectCount;
    select.name = "tipos[]";
    select.setAttribute("onchange", "mostrarArticulo(this)");

    // Opciones disponibles
    const options = [
        "Respuesta Corta", "Párrafo", "Pregunta de Opción Múltiple",
        "Casillas de Verificación", "Lista Desplegable", "Carga de Archivo",
        "Cuadrícula de Opción Múltiple", "Cuadrícula de Casilla de Verificación", "Fecha y Hora"
    ];

    // Llenar select con opciones
    options.forEach((option, index) => {
        const optionElement = document.createElement("option");
        optionElement.value = option; // Usar el texto como valor
        optionElement.textContent = option;
        if (option === tipoPregunta) {
            optionElement.selected = true;
        }
        select.appendChild(optionElement);
    });

    selectContainer.appendChild(select);

    // Crear contenedor para artículos (diferentes tipos de preguntas)
    const articlesContainer = document.createElement("div");
    articlesContainer.className = "additional-content articles-container-" + select.id;

    // Crear artículos para cada tipo de pregunta
    options.forEach((option, index) => {
        const article = document.createElement("article");
        article.className = "r_" + option.toLowerCase().replace(/\s+/g, "_") + " hidden";
        article.id = "article" + index + "-" + select.id;

        // Mostrar solo el artículo correspondiente al tipo de pregunta
        if (option === tipoPregunta || (index === 0 && !tipoPregunta)) {
            article.classList.remove("hidden");
        }

        // Generar contenido específico para cada tipo de pregunta
        article.innerHTML = generateArticleContent(index, option, preguntaText);
        articlesContainer.appendChild(article);
    });

    selectContainer.appendChild(articlesContainer);
    contentContainer.appendChild(selectContainer);

    // Configurar evento change para mostrar el artículo correspondiente
    select.addEventListener("change", function() {
        mostrarArticulo(this);
    });

    // Agregar botón de eliminar (excepto para el primer campo)
    if (selectCount > 1) {
        const deleteBtn = document.createElement("button");
        deleteBtn.className = "btn btn-danger btn-sm mt-2";
        deleteBtn.innerHTML = '<i class="bi bi-trash"></i> Eliminar';
        deleteBtn.onclick = () => eliminarSelect(selectContainerId);
        selectContainer.appendChild(deleteBtn);
    }

    selectCount++;
}

// Función para generar el contenido del artículo según el tipo de pregunta
function generateArticleContent(index, option, preguntaText) {
    // Input principal (siempre visible)
    let html = `
        <div class="inputs_xd mt-3">
            <input class="input_text form-control" type="text" name="preguntas[]" 
                   value="${preguntaText || ''}" placeholder="Texto de la pregunta" required>
    `;

    // Campos adicionales según el tipo de pregunta
    switch(option) {
        case "Respuesta Corta":
            html += `<input class="form-control mt-2" type="text" placeholder="Texto de respuesta breve" disabled>`;
            break;
        case "Párrafo":
            html += `<textarea class="form-control mt-2" placeholder="Texto de respuesta larga" disabled></textarea>`;
            break;
        case "Pregunta de Opción Múltiple":
            html += `
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opciones_${selectCount}" disabled>
                        <input class="form-control form-control-sm d-inline-block w-auto ms-2" type="text" value="Opción 1" disabled>
                    </div>
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="radio" name="opciones_${selectCount}" disabled>
                        <input class="form-control form-control-sm d-inline-block w-auto ms-2" type="text" value="Opción 2" disabled>
                    </div>
                </div>
            `;
            break;
        // Agregar más casos según sea necesario
        default:
            html += `<div class="mt-2">Configuración para: ${option}</div>`;
    }

    html += `</div>`; // Cerrar el div principal
    return html;
}

// Función para mostrar el artículo correspondiente al select cambiado
function mostrarArticulo(select) {
    const selectedOption = select.value;
    const containerClass = ".articles-container-" + select.id;
    const articles = document.querySelectorAll(containerClass + " article");
    
    // Ocultar todos los artículos
    articles.forEach(article => {
        article.classList.add("hidden");
    });
    
    // Mostrar el artículo correspondiente a la opción seleccionada
    const selectedIndex = Array.from(select.options).findIndex(opt => opt.value === selectedOption);
    const selectedArticle = document.getElementById(`article${selectedIndex}-${select.id}`);
    
    if (selectedArticle) {
        selectedArticle.classList.remove("hidden");
    }
}

// Función para eliminar un campo de pregunta
function eliminarSelect(selectContainerId) {
    if (selectContainerId !== "selectContainer-1") {
        const selectContainer = document.getElementById(selectContainerId);
        if (selectContainer) selectContainer.remove();
    } else {
        Swal.fire({
            title: 'Información',
            text: 'No puedes eliminar el primer campo de pregunta.',
            icon: 'info'
        });
    }
}

function collectFormData() {
    // Obtener todos los contenedores de pregunta
    const selectContainers = document.querySelectorAll('.select-container');
    const preguntas = [];
    const tipos = [];

    selectContainers.forEach(container => {
        // Obtener el select de tipo dentro del contenedor
        const select = container.querySelector('select[name="tipos[]"]');
        // Obtener el artículo visible correspondiente a ese select
        const articlesContainer = container.querySelector('.articles-container-' + select.id);
        const visibleArticle = articlesContainer.querySelector('article:not(.hidden)');
        
        if (visibleArticle) {
            // Obtener el input de la pregunta dentro del artículo visible
            const inputPregunta = visibleArticle.querySelector('input[name="preguntas[]"]');
            if (inputPregunta) {
                preguntas.push(inputPregunta.value.trim());
                tipos.push(select.value);
            }
        }
    });

    const idPregunta = document.querySelector('[name="idPregunta"]')?.value || '';

    // Validar que las preguntas y tipos tengan la misma longitud
    if (preguntas.length !== tipos.length) {
        console.error("Discrepancia encontrada:", { preguntas, tipos });
        throw new Error("La cantidad de preguntas no coincide con los tipos de pregunta.");
    }

    // Convertir a cadenas JSON para la consulta SQL
    return { 
        idPregunta, 
        preguntas: JSON.stringify(preguntas), 
        tipos: JSON.stringify(tipos) 
    };
}

document.getElementById('form_pregunta').addEventListener('submit', function(e) {
    e.preventDefault();
    
    try {
        const { idPregunta, preguntas, tipos } = collectFormData();
        
        console.log("Datos a enviar:", { idPregunta, preguntas, tipos });

        const formData = new FormData();
        formData.append('idPregunta', idPregunta);  // Enviar como campo individual
        formData.append('preguntas', preguntas);    // Enviar como JSON string
        formData.append('tipo_pregunta', tipos);    // Enviar como JSON string
        
        fetch('./editar_pregunta_proceso.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('exitosamente')) {
                Swal.fire({
                    title: 'Éxito',
                    text: 'Pregunta actualizada correctamente',
                    icon: 'success'
                }).then(() => {
                    window.location.href = './../../vistas/lst_preguntas.php';
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: data || 'Error al actualizar la pregunta',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Error al enviar los datos',
                icon: 'error'
            });
        });
    } catch (error) {
        console.error('Error de validación:', error);
        Swal.fire({
            title: 'Error',
            text: error.message,
            icon: 'error'
        });
    }
});

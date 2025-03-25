// Función de inicialización que se ejecuta cuando la página está completamente cargada
window.onload = function () {
    generateSelect(); // Llamada a la función generateSelect al cargar la página
};

var selectCount = 1; // Variable para mantener el conteo de selects generados

function mostrarArticulo(select) {
    var selectedOption = select.value;

    // Ocultar todos los artículos del conjunto correspondiente
    var articles = document.querySelectorAll(".articles-container-" + select.id + " article");
    articles.forEach(function (article) {
        article.classList.add("hidden");
    });

    // Mostrar el artículo correspondiente al número seleccionado
    var selectedArticle = document.getElementById("article" + selectedOption + "-" + select.id);
    if (selectedArticle) {
        selectedArticle.classList.remove("hidden");
    }
}

function generateSelect() {
    var contentContainer = document.getElementById("contentContainer");

    var selectContainerId = "selectContainer-" + selectCount; // ID único para el contenedor de selección
    var additionalContentId = "additionalContent-" + selectCount; // ID único para el contenido adicional

    var selectContainer = document.createElement("div");
    selectContainer.classList.add("select-container");
    selectContainer.id = selectContainerId;
    var select = document.createElement("select");
    select.id = "select" + selectCount;
    select.setAttribute("onchange", "mostrarArticulo(this)");

    var options = [
        "Respuesta Corta", // Colocamos "Respuesta Corta" como la primera opción
        "Párrafo",
        "Pregunta de Opción Múltiple",
        "Casillas de Verificación",
        "Lista Desplegable",
        "Carga de Archivo",
        "Cuadrícula de Opción Múltiple",
        "Cuadrícula de Casilla de Verificación",
        "Fecha y Hora"
    ];

    options.forEach(function (option, index) {
        var optionElement = document.createElement("option");
        optionElement.value = index;
        optionElement.textContent = option;
        select.appendChild(optionElement);
    });

    selectContainer.appendChild(select);

    var articlesContainer = document.createElement("div");
    articlesContainer.classList.add("additional-content", "articles-container-" + select.id);

    options.forEach(function (option, index) {
        var article = document.createElement("article");
        article.classList.add("r_" + option.toLowerCase().replace(/\s+/g, "_"));
        article.classList.add("hidden");
        article.id = "article" + index + "-" + select.id;

        // Solo mostramos el artículo correspondiente a "Respuesta Corta" al principio
        if (option === "Respuesta Corta") {
            article.classList.remove("hidden");
        }

        switch (index) {
            case 0: // Respuesta Corta
                article.innerHTML = `
                    <div class="inputs_xd">
                        <label for="respuesta_corta" class="title">Respuesta Corta:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <input class="input_text_none" type="text" id="respuesta_corta" name="respuesta_corta" placeholder="Texto de respuesta breve" required>
                    </div>
                `;
                break;
            case 1: // Párrafo
                article.innerHTML = `
                    <div class="inputs_xd">                
                        <label for="parrafo" class="title">Párrafo:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <input class="input_text_none" type="text" id="respuesta_corta" name="respuesta_corta" placeholder="Texto de respuesta larga" required>
                    </div>
                `;
                break;
            case 2: // Pregunta de Opción Múltiple
                article.innerHTML = `
                    <div class="inputs_xd">
                        <label class="title">Pregunta de Opción Múltiple:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <div class="opcione">
                            <div class="div_radio">
                                <input type="radio" name="radio" />
                                <input type="radio" name="radio" />
                                <input type="radio" name="radio" />        
                            </div>
                            <div class="div_input">
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" value="Opción 1" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                            </div>
                        </div>  
                    </div>
                `;
                break;
            case 3: // Casillas de Verificación
                article.innerHTML = `
                    <div class="inputs_xd">
                        <label class="title">Casillas de Verificación:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <div class="opcione">
                            <div class="div_radio">
                                <input type="checkbox" name="radio" />
                                <input type="checkbox" name="radio" />
                                <input type="checkbox" name="radio" />        
                            </div>
                            <div class="div_input">
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" value="Opción 1" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                            </div>
                        </div>  
                    </div>
                `;
                break;
            case 4: // Lista Desplegable
                article.innerHTML = `
                    <div class="inputs_xd">
                        <label for="lista_desplegable" class="title">Lista Desplegable:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <div class="opciones">
                            <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                            <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                            <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        </div>  
                    </div>
                `;
                break;
            case 5: // Carga de Archivo
                article.innerHTML = `
                    <div class="inputs_xd">
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <label for="archivo" class="title">Carga de Archivo:</label>
                        <input type="file" id="archivo" name="archivo">
                    </div>
                `;
                break;
            case 6: // Cuadrícula de Opción Múltiple
                article.innerHTML = `
                    <div class="inputs_xd">
                        <label class="title">Cuadrícula de ${option}:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <div class="opcione">
                            <div class="div_radio">
                                <input type="radio" name="radio" />
                                <input type="radio" name="radio" />
                                <input type="radio" name="radio" />        
                            </div>
                            <div class="div_input">
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" value="Opción 1" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                            </div>
                        </div>
                    </div>
                `;
                break;
            case 7: // Cuadrícula de Casilla de Verificación
                article.innerHTML = `
                    <div class="inputs_xd">
                        <label class="title">Cuadrícula de ${option}:</label>
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <div class="opcione">
                            <div class="div_radio">
                                <input type="checkbox" name="radio" />
                                <input type="checkbox" name="radio" />
                                <input type="checkbox" name="radio" />        
                            </div>
                            <div class="div_input">
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" value="Opción 1" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                                <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                            </div>
                        </div>
                    </div>
                `;
                break;
            case 8: // Fecha y Hora
                article.innerHTML = `
                    <div class="inputs_xd">
                        <input class="input_text" type="text" id="respuesta_corta" name="respuesta_corta" required>
                        <label for="fecha_hora">Fecha y Hora:</label>
                        <input type="datetime-local" id="fecha_hora" name="fecha_hora">
                    </div>
                `;
                break;
            default:
                break;
        }

        articlesContainer.appendChild(article);
    });

    selectContainer.appendChild(articlesContainer);
    contentContainer.appendChild(selectContainer);

    // Mostrar el artículo correspondiente a "Respuesta Corta" al inicio
    mostrarArticulo(select);

    // Añadir contenido adicional
    addMoreContent(selectContainerId);

    selectCount++;
    countSelectContainers();
}

function addMoreContent(selectContainerId) {
    var contentContainer = document.getElementById("contentContainer");
    var additionalContent = document.createElement("div");
    additionalContent.classList.add("additional-content");
    additionalContent.id = "additionalContent-" + selectContainerId; // Asigna un ID único

    // Agregar el botón para eliminar el selectContainer
    additionalContent.innerHTML += `<div class='text-container'>
        <button onclick="eliminarSelect('${selectContainerId}')">Eliminar</button>
    </div>`;

    contentContainer.appendChild(additionalContent);
}

function eliminarSelect(selectContainerId) {
    // Verifica que el ID del contenedor de selección no sea el del primer select
    if (selectContainerId !== "selectContainer-1") {
        var selectContainer = document.getElementById(selectContainerId);
        if (selectContainer) {
            selectContainer.remove();
        }

        var additionalContent = document.getElementById("additionalContent-" + selectContainerId);
        if (additionalContent) {
            additionalContent.remove();
        }
    } else {
        // Muestra un mensaje de alerta indicando que el primer select no puede ser eliminado
        alert("No puedes eliminar el primer select.");
    }
    countSelectContainers();
}

function countSelectContainers() {
    var selectContainers = document.querySelectorAll("[id^='selectContainer-']");
    console.log("Cantidad de selectContainers:", selectContainers.length);
}
// Función para recolectar los valores de los .input_text visibles
function collectInputTextValues() {
    var values = [];
    // Obtener todos los artículos visibles
    var visibleArticles = document.querySelectorAll("article:not(.hidden)");
    
    // Recorrer los artículos visibles y recolectar los valores de los .input_text
    visibleArticles.forEach(function(article) {
        var inputs = article.querySelectorAll(".input_text");
        inputs.forEach(function(input) {
            values.push(input.value);
        });
    });

    return values;
}

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
}

// Puedes llamar a saveAndPrint() en un evento, como al hacer clic en un botón
document.getElementById("saveButton").addEventListener("click", saveAndPrint);
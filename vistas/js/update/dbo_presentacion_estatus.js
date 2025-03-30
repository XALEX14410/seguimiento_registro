document.addEventListener("DOMContentLoaded", function() {
    // Función para manejar el toggle del estado
    function toggleEstadoSistema(boton) {
        const id = boton.getAttribute("data-id");
        const estadoActual = boton.getAttribute("data-estado");
        
        // Si el elemento está ACTIVO (visible)
        if (estadoActual === "1") {
            Swal.fire({
                title: "Elemento visible",
                text: "Este elemento ya está visible. Selecciona otro elemento inactivo si deseas cambiar la visibilidad.",
                icon: "info",
                confirmButtonText: "OK",
                showCancelButton: false // Solo muestra el botón OK
            });
        } 
        // Si el elemento está INACTIVO (no visible)
        else {
            Swal.fire({
                title: "Cambiar visibilidad",
                text: "¿Estás seguro de hacer visible este elemento en el formulario?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Hacer visible",
                cancelButtonText: "Cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar loader mientras se procesa
                    Swal.fire({
                        title: "Actualizando...",
                        html: "Por favor espere",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Llamada AJAX para actualizar el estado
                    fetch('/seguimiento_registro/controladores/update/actualizar_mensaje_activo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `mensaje_activo=${id}`
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.close();
                        
                        if (data.success) {
                            // Mostrar mensaje de éxito
                            Swal.fire({
                                title: "¡Éxito!",
                                text: data.message,
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // Recargar la página para ver cambios
                                location.reload();
                            });
                        } else {
                            throw new Error(data.message);
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error",
                            text: error.message,
                            icon: "error"
                        });
                        console.error("Error:", error);
                    });
                }
            });
        }
    }

    // Asignar eventos a todos los botones de estado
    const botonesEstado = document.querySelectorAll("[id^='btnEstadoSistema-']");
    botonesEstado.forEach(boton => {
        boton.addEventListener("click", function(e) {
            e.preventDefault();
            toggleEstadoSistema(this);
        });
    });
});
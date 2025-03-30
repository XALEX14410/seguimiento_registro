document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones que comienzan con 'btnEditarColonia-'
    const botones = document.querySelectorAll("[id^='btnEditarColonia-']");
    
    botones.forEach(boton => {
        boton.addEventListener("click", function(e) {
            e.preventDefault();
            const idRespuesta = this.getAttribute("data-id");
            
            if (!idRespuesta) {
                Swal.fire("Error", "No se especificó un ID válido", "error");
                return;
            }

            Swal.fire({
                title: "¿Editar colonia?",
                text: "Serás redirigido al formulario de edición",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Continuar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/politic_vote/controladores/update/editar_colonia.php?id=${idRespuesta}`;
                }
            });
        });
    });
});
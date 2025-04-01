        // Función para verificar si hay texto en la fila y actualizar el contenido en consecuencia
        function actualizarContenido() {
            var fila = document.getElementById('identifi');
            var celdas = fila.getElementsByTagName('td');
            var textoEncontrado = false;

            // Verificar si hay texto en al menos una celda de la fila
            for (var i = 0; i < celdas.length; i++) {
                if (celdas[i].innerText.trim() !== '') {
                    textoEncontrado = true;
                    break;
                }
            }

            // Actualizar contenido de la fila
            if (!textoEncontrado) {
                fila.innerHTML = '<td colspan="1000000000">No existe ningún valor</td>';
            }
        }

        // Llamar a la función cuando la página se carga por completo
        window.onload = actualizarContenido;
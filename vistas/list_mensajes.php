<?php
    include_once realpath(dirname(__FILE__)."/../model/bd_mensaje_w.php");
    include_once realpath(dirname(__FILE__)."/../model/componentes.php");

    $mimensaje       = new bd_mensaje_w();
    $micomponente = new componentes();

    $lista_mensaje = $mimensaje->lista_mensaje_w();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Libreria de iconos (BOXICONS) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Libreria de iconos (BOOTSTRAP) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Estilos css -->
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/loader.css">
    <link rel="stylesheet" href="./css/componentes.css">
    <link rel="stylesheet" href="./css/elementos.css">
    <link rel="stylesheet" href="./css/contenido.css">
    <link rel="stylesheet" href="./css/formulario.css">

    <script>
        const temaLocal = localStorage.getItem('theme');
        const colorSistema = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oscuro' : 'claro';
        const nuevoTema = temaLocal ?? colorSistema;
        document.documentElement.setAttribute('data-tema', nuevoTema);
    </script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Mensajes de Whatsapp</title>
</head>
<body class="hidden">
    <!-- Preloader -->
    <!--<?php $micomponente->generaLoader(); ?>-->

    <!-- Layout -->
    <main class="principal">
        <?php $micomponente->generaMenu(); ?>

        <!-- Comienzo el contenido -->
        <section class="contenido">
            <?php 
                $micomponente->generaNav();
                $micomponente->generaOpciones(); 
            ?>
            <div class="modal"></div>

            <!-- Contenido principal -->
            <div class="main">
                <div class="main__contenedor contenedor">
                    <h2 class="main__titulo">Lista de Mensajes de Whatsapp</h2>

                    <div class="panel panel-grid1">
                        <div class="data padding-0">
                            <div class="data__contenedor scrolling">
                                <table class="tabla">
                                    <thead>
                                        <tr class="tabla__fila1">
                                            <td class="tabla__celda color1 center bold size1">No.</td>
                                            <td class="tabla__celda color1 center bold size1">Mensaje</td>
                                            <td class="tabla__celda color1 center bold size1">En sistema</td>
                                            <td class="tabla__celda color1 center bold size1">Acciones</td>
                                            

                                        </tr>
                                    </thead>
                                    <tbody id="identifi">
                                        <?php for($i=0; $i<count($lista_mensaje); $i++) { ?>
                                                <tr class="tabla__fila2 buscar">
                                                    <td class="tabla__celda-body color2 center normal size2"><?php echo ($i+1) ?></td> 
                                                    <td class="tabla__celda-body color2 center normal size2"><?php echo $lista_mensaje[$i]->getmensaje(); ?></td>
                                                    <td class="tabla__celda-body color2 center   normal size2"><?php echo $lista_mensaje[$i]->geten_sistema()?"Activo":"Inactivo";?></td>                                            
                                                    
                                                    <td class="tabla__celda-body center" width="100">
                                                        <div class="contenedor-btn contenedor-btn2">
                                                            <a href="./act_coordinador.php?id=<?php echo $lista_mensaje[$i]->getid(); ?>" title="Editar al coordinador <?php echo $lista_mensaje[$i]->getmensaje(); ?>" class="btn btn-small btn-radius2 btn-exito"> <i class="bi bi-pen icono-5"></i> </a>
                                                            <a title="Eliminar al coordinador <?php echo $lista_mensaje[$i]->getmensaje(); ?>" class="btn btn-small btn-radius2 btn-peligro" onclick="eliminar('<?php echo $lista_mensaje[$i]->getmensaje() ?>', '<?php echo $lista_mensaje[$i]->getid() ?>')"> <i class="bi bi-trash3 icono-5"></i> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="data acciones">
                            <div class="contenedor-btn">
                                <a href="./frm_mesa.php" title="Agregar nueva mesa" class="btn btn-small btn-radius2 btn-primario"><i class='bx bx-plus icono-4'></i></a>
                                <a title="Descargar archivo Excel" class="btn btn-small btn-radius2 btn-bloqueado"><i class='bx bx-file icono-4'></i></a>
                                <a title="Cancelar" class="btn btn-small btn-radius2 btn-bloqueado"><i class='bx bx-x icono-4'></i></a>
                            </div>
                            
                            <div class="input-field">
                                <figure class="input-field__icono">
                                    <i class='bx bx-search-alt input-field__img'></i>
                                </figure>
                                <input type="text" placeholder="Buscar..." class="input input-indep-buscar input-indep input-indep100" id="buscardor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <script src="./js/loader.js"></script>
    <script src="./js/componentes.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <script src="./js/buscar.js"></script>
    <script>
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
                fila.innerHTML = '<td class="tabla__celda-none color5 center bold size2" colspan="1000000000">No existen mensajes registrados</td>';
            }
        }

        // Llamar a la función cuando la página se carga por completo
        window.onload = actualizarContenido;
    </script>
    <script src="./js/del_mesa.js"></script>
</body>
</html>
<?php
// Cambiar el nombre del archivo con el error tipográfico en 'bd_presentacion.php'
include_once realpath(dirname(__FILE__) . "/../model/componentes.php");
include_once realpath(dirname(__FILE__) . "/../model/bd_presentacion.php");
include_once realpath(dirname(__FILE__) . "/../model/funciones.php");
// Instanciar clases
$micomponente = new componentes();
$midato = new bd_presentacion();

// Revisar si los métodos existen y están descomentados al usarlos
$presentacion = $midato->lista_presentacion_formulario();
?>
<?php
// Función para extraer el ID del video de YouTube de la URL
function obtenerIdYouTube_table($url)
{
    $id = null;
    $match = preg_match('/[?&]v=([^?&]+)/', $url, $matches);
    if ($match) {
        $id = $matches[1];
    } else {
        $match = preg_match('/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([^?&]+)/', $url, $matches);
        if ($match) {
            $id = $matches[1];
        }
    }
    return $id;
}
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
    <script src="./js/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Presentaciones</title>
</head>

<body class="hidden">
    <!-- Preloader -->
    <?php
    $micomponente->generaLoader();
    ?>

    <!-- Layout -->
    <main class="principal">
        <?php
        $micomponente->generaMenu();
        ?>

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
                    <h2 class="main__titulo">Lista de presentaciones disponibles</h2>
                    <div class="panel panel-grid0">
                        <div class="data padding-1">
                            <div class="center bold size1">
                                <?php
                                // Invocar la función obtenerMensajeActivo
                                obtenerMensajeActivo();
                                ?>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-grid1">
                        <div class="data">
                            <div class="data__contenedor scrolling">
                                <table id="datos" class="tabla">
                                    <thead>
                                        <tr class="tabla__fila1">
                                            <td class="tabla__celda color1 center bold size1">id</td>
                                            <td class="tabla__celda color1 center bold size1">Título</td>
                                            <td class="tabla__celda color1 center bold size1">Imagen</td>
                                            <td class="tabla__celda color1 center bold size1">Video</td>
                                            <td class="tabla__celda color1 center bold size1">Descripción</td>
                                            <td class="tabla__celda color1 center bold size1">En Sistema</td>
                                            <td class="tabla__celda color1 center bold size1">Acciones</td>
                                            <!-- <td class="tabla__celda color1 center bold size1">Galería</td> -->
                                        </tr>
                                    </thead>
                                    <tbody id="identifi">
                                        <?php for ($i = 0; $i < count($presentacion); $i++) { ?>
                                            <tr>
                                                <td class='tabla__celda-body color2 center normal size2'><?php echo ($i + 1) ?></td>
                                                <td class='tabla__celda-body color2 center normal size2'><?php echo $presentacion[$i]->gettitulo(); ?></td>
                                                <td class='tabla__celda-body color2 center normal size2'>
                                                    <?php
                                                    // Validar si existe una imagen y si su URL tiene una extensión de archivo de imagen
                                                    if ($presentacion[$i]->getimagen()) {
                                                        $extension = strtolower(pathinfo($presentacion[$i]->getimagen(), PATHINFO_EXTENSION));

                                                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) { ?>
                                                            <img src="<?php echo $presentacion[$i]->getimagen(); ?>" alt="Imagen" style="max-width: 100px; max-height: 100px;">
                                                        <?php } else { ?>
                                                            <p>No existe imagen válida</p> <!-- Mensaje si no hay imagen válida -->
                                                        <?php }
                                                    } else { ?>
                                                        <p>No existe imagen válida</p> <!-- Mensaje si no hay imagen en absoluto -->
                                                    <?php } ?>
                                                </td>

                                                <td class='tabla__celda-body color2 center normal size2'>
                                                    <?php
                                                    if ($presentacion[$i]->getvideo()) {
                                                        $videoId = obtenerIdYouTube_table($presentacion[$i]->getvideo());
                                                        if ($videoId) { ?>
                                                            <iframe width='160' height='90' src='https://www.youtube.com/embed/<?php echo $videoId; ?>' frameborder='0' allowfullscreen></iframe>
                                                        <?php } else { ?>
                                                            <p>No existe video válido</p>
                                                        <?php }
                                                    } else { ?>
                                                        <p>No se ingresó un video</p>
                                                    <?php } ?>
                                                </td>

                                                <td class='tabla__celda-body color2 center normal size2'><?php echo $presentacion[$i]->getdescripcion(); ?></td>
                                                <td class='tabla__celda-body color2 center normal size2'><?php echo $presentacion[$i]->geten_sistema() ? "Activo" : "Inactivo"; ?></td>
                                                <td class='tabla__celda-body center' width='100'>
                                                    <div class='contenedor-btn contenedor-btn2'>
                                                        <a href='./act_mesa.php' title='Editar la mesa' class='btn btn-small btn-radius2 btn-exito'> <i class='bi bi-pen icono-5'></i> </a>
                                                        <a title='Eliminar la mesa' class='btn btn-small btn-radius2 btn-peligro' onclick='eliminar()'> <i class='bi bi-trash3 icono-5'></i> </a>
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
                                <a href="./frm_presentacion_formulario.php" title="Agregar nueva sección" class="btn btn-small btn-radius2 btn-primario"><i class='bx bx-plus icono-4'></i></a>
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

            </div>
        </section>
    </main>

    <!-- Scripts -->
    <script src="./js/loader.js"></script>
    <script src="./js/componentes.js"></script>
    <script src="./js/sweetalert2.js"></script>
    <script src="./js/buscar.js"></script>
    <!-- JQuery -->
    <script src="./tbl-components/jquery-3.7.1.js"></script>
    <!-- Script que me permite agregar las clase de CSS a las etiquetas de los DataTables -->
    <script src="./tbl-components/dataTables.min.js"></script>
    <!-- Script que invoca y genera el dataTable -->
    <script src="./js/DESING/NdataTables.js"></script>
    <script src="./js/del_lugar_votacion.js"></script>
</body>

</html>
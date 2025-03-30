<?php

include_once realpath(dirname(__FILE__)."/../clases/dbo_pregunta.php");
include_once realpath(dirname(__FILE__)."/../modelos/basededatos.php");

class bd_pregunta extends BaseDatos {
    // Agrega nueva pregunta
    public function agrega_pregunta($datos_dbo_pregunta) {
        $sql = "INSERT INTO `pregunta`(`preguntas`, `tipo_pregunta`) VALUES (

                    '".$datos_dbo_pregunta->getPreguntas()."',
                    '".$datos_dbo_pregunta->getTipoPregunta()."'
                )";
        $con = $this->getBD();
        $resultado = $con->query($sql);
        $con->close();
    }

    // Genero mi lista de preguntas
    public function lista_pregunta() {
        $lista_dbo_pregunta = array(); // Inicializar la variable correctamente
        $sql = "SELECT `id_pregunta`, `preguntas`, `tipo_pregunta` FROM `pregunta` ORDER BY id_pregunta";
        $con = $this->getBD();
        $resultado = $con->query($sql);
        if ($resultado->num_rows > 0) { // Quiere decir que lo encontró
            for ($i = 0; $i < $resultado->num_rows; $i++) {
                $renglon = $resultado->fetch_assoc();
                $dato_tabla = new dbo_pregunta($renglon);
                $dato_tabla->setidPregunta($dato_tabla->getidPregunta());
                
                $dato_tabla->setPreguntas($dato_tabla->getPreguntas());
                $dato_tabla->setTipoPregunta($dato_tabla->getTipoPregunta());
                $lista_dbo_pregunta[$i] = $dato_tabla; // Almacena en el array
            }
        }
        $con->close();
        return $lista_dbo_pregunta;
    }

    // Busco una pregunta por ID
    public function busca_pregunta($id) {
        $datos_del_elemento = array();
        if ($id > 0) {
            $sql = "SELECT `id_pregunta`, `preguntas`, `tipo_pregunta` FROM `pregunta` WHERE id_pregunta = ".$id;
            $con = $this->getBD();
            $resultado = $con->query($sql);
            if ($resultado->num_rows > 0) { // Quiere decir que lo encontró
                for ($i = 0; $i < $resultado->num_rows; $i++) {
                    $renglon = $resultado->fetch_assoc();
                    $dato_elemento = new dbo_pregunta($renglon);
                    $dato_elemento->setidPregunta($dato_elemento->getidPregunta());
                    
                    $dato_elemento->setPreguntas($dato_elemento->getPreguntas());
                    $dato_elemento->setTipoPregunta($dato_elemento->getTipoPregunta());
                    $datos_del_elemento[$i] = $dato_elemento;
                }
            }
            $con->close();
        } else {
            // Si no hay un ID válido, inicializamos un objeto vacío
            $dato_elemento = new dbo_pregunta();
            $dato_elemento->setidPregunta(0);
            
            $dato_elemento->setPreguntas("Sin pregunta");
            $dato_elemento->setTipoPregunta("Sin tipo");
            $datos_del_elemento[0] = $dato_elemento;
        }
        return $datos_del_elemento;
    }

    // Modifico los registros en la base de datos
    public function actualiza_pregunta($eldato) {
        $sql = "UPDATE `pregunta` SET ".
                    
                    "preguntas='".$eldato->getPreguntas()."', ".
                    "tipo_pregunta='".$eldato->getTipoPregunta()."' ".
               "WHERE id_pregunta=".$eldato->getidPregunta();
        $con = $this->getBD();
        $resultado = $con->query($sql);
        $con->close();
    }

    // Elimino una pregunta
    public function elimina_pregunta($id) {
        $sql = "DELETE FROM `pregunta` WHERE id_pregunta = ".$id;
        $con = $this->getBD();
        $resultado = $con->query($sql);
        $con->close();
    }
}
?>

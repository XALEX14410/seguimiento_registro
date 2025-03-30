<?php
include_once realpath(dirname(__FILE__) . "/../class/presentacion_formulario.php");
include_once realpath(dirname(__FILE__) . "/../model/basedatos.php");

class bd_presentacion extends BaseDatos
{
    // Agrega nueva presentacion
    public function agrega_dbo_presentacion_formulario($datos_presentacion_formulario)
    {
        $sql = "insert into presentacion_formulario(	`titulo`, `imagen`, `video`, `descripcion`, `en_sistema`)" .
            " values(
                        '" . $datos_presentacion_formulario->getid() . "', " .
            "'" . $datos_presentacion_formulario->getmensaje() . "', " .
            "'" . $datos_presentacion_formulario->geten_sistema() . "' " .

            ")";
        $con = $this->getBD();
        $resultado = $con->query($sql);
        $con->close();
    }

    // Genero mi lista de dbo_presentacion_formulario
    public function lista_presentacion_formulario()
    {
        $lista_dbo_presentacion_formulario = array();
        $sql = "SELECT * FROM `presentacion_formulario`";
        $con = $this->getBD();
        $resultado = $con->query($sql);

        if ($resultado->num_rows > 0) { // Quiere decir que lo encontro
            for ($i = 0; $i < $resultado->num_rows; $i++) {
                $renglon = $resultado->fetch_assoc();
                $dato_tabla = new presentacion($renglon);
                $dato_tabla->setid($dato_tabla->getid());
                $dato_tabla->settitulo($dato_tabla->gettitulo());
                $dato_tabla->setimagen($dato_tabla->getimagen());
                $dato_tabla->setvideo($dato_tabla->getvideo());
                $dato_tabla->setdescripcion($dato_tabla->getdescripcion());
                $dato_tabla->seten_sistema($dato_tabla->geten_sistema());
                




                $lista_dbo_presentacion_formulario[$i] = $dato_tabla;
            } // end for
        }
        $con->close();
        return $lista_dbo_presentacion_formulario;
    }

    // Busco a dbo_presentacion_formulario
    public function busca_presentacion_formulario($id)
    {
        $datos_del_elemento = array();
        if ($id > 0) {
            $sql = "select * from presentacion_formulario where id=" . $id;
            $con = $this->getBD();
            $resultado = $con->query($sql);
            if ($resultado->num_rows > 0) { // Quiere decir que lo encontro 
                for ($i = 0; $i < $resultado->num_rows; $i++) {
                    $renglon = $resultado->fetch_assoc();
                    $dato_elemento = new presentacion($renglon);
                    $dato_elemento->setid($dato_elemento->getid());



                    $datos_del_elemento[$i] = $dato_elemento;
                } // end for
            }
            $con->close();
        } else {
            $dato_elemento = new presentacion();
            $dato_elemento->setid($dato_elemento->getid());





            $datos_del_elemento[0] = $dato_elemento;
        }

        return $datos_del_elemento;
    }

    // Modifico los registros en la base de datos
    public function actualiza_dbo_presentacion_formulario($eldato)
    {
        $sql = "update presentacion_formulario set " .
            "id='" . $eldato->getid() . "', " .
            "mensaje='" . $eldato->getmensaje() . "', " .
            "en_sistema='" . $eldato->geten_sistema() . "', " .


            "where dbo_presentacion_formulario=" . $eldato->getid();
        $con = $this->getBD();
        $resultado = $con->query($sql);
        $con->close();
    }

    // Elimino dbo_presentacion_formulario
    public function elimina_dbo_presentacion_formulario($id)
    {
        $sql = "delete from presentacion_formulario where id=" . $id;
        $con = $this->getBD();
        $resultado = $con->query($sql);
        $con->close();
    }
}

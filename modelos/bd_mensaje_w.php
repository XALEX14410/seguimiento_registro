<?php
    include_once realpath(dirname(__FILE__)."/../class/mensaje_w.php");
    include_once realpath(dirname(__FILE__)."/../model/basedatos.php");

    class bd_mensaje_w extends BaseDatos {
        // Agrega nueva mensaje_w
        Public function agrega_dbo_mensaje_w($datos_mensaje_w) {
            $sql = "insert into mensaje_w(	id,	mensaje,	en_sistema)".
             " values(
                        '".$datos_mensaje_w->getid()."', ". 
                        "'".$datos_mensaje_w->getmensaje()."', ".
                        "'".$datos_mensaje_w->geten_sistema()."' ".
 
            ")";
            $con = $this->getBD();
            $resultado = $con->query($sql);
            $con->close();
        }

        // Genero mi lista de dbo_mensaje_w
        public function lista_mensaje_w() {
            $lista_dbo_mensaje_w = array();
            $sql = "SELECT * FROM `mensaje_w`";
            $con = $this->getBD();
            $resultado = $con->query($sql);
            
            if ($resultado->num_rows>0) { // Quiere decir que lo encontro
                for($i=0; $i < $resultado->num_rows; $i++) {
                    $renglon = $resultado->fetch_assoc();
                    $dato_tabla = new mensaje_w($renglon);
                    $dato_tabla->setid($dato_tabla->getid());
                    $dato_tabla->setmensaje($dato_tabla->getmensaje());
                    $dato_tabla->seten_sistema($dato_tabla->geten_sistema());
                    


                    $lista_dbo_mensaje_w[$i] = $dato_tabla;
                }// end for
            }
            $con->close();
            return $lista_dbo_mensaje_w;
        }

        // Busco a dbo_mensaje_w
        public function busca_mensaje_w($id) {
            $datos_del_elemento = array();
            if ($id>0) {
                $sql = "select * from mensaje_w where id=".$id;
                $con = $this->getBD();
                $resultado = $con->query($sql);
                if ($resultado->num_rows>0) { // Quiere decir que lo encontro 
                    for($i=0; $i < $resultado->num_rows; $i++) {
                        $renglon = $resultado->fetch_assoc();
                        $dato_elemento = new mensaje_w($renglon);
                        $dato_elemento->setid($dato_elemento->getid());
                    $dato_elemento->setmensaje($dato_elemento->getmensaje());
                    $dato_elemento->seten_sistema($dato_elemento->geten_sistema());
                    

                        $datos_del_elemento[$i] = $dato_elemento;
                    }// end for
                }
                $con->close();
            }

            else {
                $dato_elemento = new mensaje_w();
                $dato_elemento->setid($dato_elemento->getid());
                    $dato_elemento->setmensaje($dato_elemento->getmensaje());
                    $dato_elemento->seten_sistema($dato_elemento->geten_sistema());
                    
                

                $datos_del_elemento[0] = $dato_elemento;
            }

            return $datos_del_elemento;
        }

        // Modifico los registros en la base de datos
        public function actualiza_dbo_mensaje_w($eldato) {
            $sql = "update dbo_mensaje_w set ".
                        "id='".$eldato->getid()."', ".
                        "mensaje='".$eldato->getmensaje()."', ".
                        "en_sistema='".$eldato->geten_sistema()."', ".
                        
                               
            "where dbo_mensaje_w=".$eldato->getid();
            $con = $this->getBD();
            $resultado = $con->query($sql);
            $con->close();
        }

        // Elimino dbo_mensaje_w
        public function elimina_dbo_mensaje_w($id) {
            $sql = "delete from dbo_mensaje_w where id=".$id;
            $con = $this->getBD();
            $resultado = $con->query($sql);
            $con->close();
        }
    }
?>
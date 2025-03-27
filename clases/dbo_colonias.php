<?php
    include_once realpath(dirname(__FILE__)."/../clases/base.php");

    class dbo_pregunta extends base {
        protected $id_pregunta;
        protected $id_seguimiento;
        protected $preguntas;
        protected $tipo_pregunta;

        public function getIdPregunta() {
            return $this->id_pregunta;
        }

        public function setIdPregunta($id_pregunta) {
            $this->id_pregunta = $id_pregunta;
        }

        public function getIdSeguimiento() {
            return $this->id_seguimiento;
        }

        public function setIdSeguimiento($id_seguimiento) {
            $this->id_seguimiento = $id_seguimiento;
        }

        public function getPreguntas() {
            return $this->preguntas;
        }

        public function setPreguntas($preguntas) {
            $this->preguntas = $preguntas;
        }

        public function getTipoPregunta() {
            return $this->tipo_pregunta;
        }

        public function setTipoPregunta($tipo_pregunta) {
            $this->tipo_pregunta = $tipo_pregunta;
        }
    }
?>

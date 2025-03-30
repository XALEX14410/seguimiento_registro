<?php
    include_once realpath(dirname(__FILE__)."/../class/base.php");
    // `id`, `titulo`, `imagen`, `video`, `descripcion`, `en_sistema`
    class presentacion extends base {
	protected $id;
	protected $titulo;
    protected $imagen;
    protected $video;
    protected $descripcion;
	protected $en_sistema;


    public function getid() {
        return $this->id;
    }

    public function setid($id) {
        $this->id = $id;
    }

    public function gettitulo() {
        return $this->titulo;
    }

    public function settitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getimagen() {
        return $this->imagen;
    }

    public function setimagen($imagen) {
        $this->titulo = $imagen;
    }

    public function getvideo() {
        return $this->video;
    }

    public function setvideo($video) {
        $this->titulo = $video;
    }

    public function getdescripcion() {
        return $this->descripcion;
    }

    public function setdescripcion($descripcion) {
        $this->titulo = $descripcion;
    }

    public function geten_sistema() {
        return $this->en_sistema;
    }

    public function seten_sistema($en_sistema) {
        $this->en_sistema = $en_sistema;
    }



   
    }
?>
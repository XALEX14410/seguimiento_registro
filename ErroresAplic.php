<?php
/*
Archivo:  ErroresAplic.php
Objetivo: clase que encapsula los errores que maneja la aplicación
		  Trabaja bajo el supuesto de que el texto del error se va 
		  a presentar en HTML
Autor:    BAOZ
*/
class ErroresAplic{
	private $nError=-1;
	//Errores considerados
	CONST NO_FIRMADO = 1;
	CONST USR_DESCONOCIDO = 2;
	CONST ERROR_EN_BD = 3;
	CONST SIN_SESION = 4;
	CONST FALTAN_DATOS = 5;
	CONST NO_EXISTE_BUSCADO = 6;
	CONST SIN_PERMISOS = 7;
	CONST ERROR_TIPO_MAT = 8;
	
	public function getError(){
		return $this->nError;
	}
	public function setError($val){
		$this->nError = $val;
	}
	
	public function getTextoError(){
	$sMsjError = "";
		switch ($this->nError){
			case self::NO_FIRMADO: $sMsjError = "Debe estar firmado";
									break;
			case self::USR_DESCONOCIDO: $sMsjError ="Usuario desconocido";
									break;
			case self::ERROR_EN_BD: $sMsjError ="Error al acceder a la base de datos";
									break;
			case self::SIN_SESION: $sMsjError = "No estableci&oacute; sesi&oacute;n";
									break;
			case self::FALTAN_DATOS: $sMsjError = "Faltan datos";
									break;
			case self::NO_EXISTE_BUSCADO: $sMsjError = "No existe el registro buscado";
									break;
			case self::SIN_PERMISOS: $sMsjError = "No tiene permisos para ver la pantalla solicitada";
									break;
			case self::ERROR_TIPO_MAT: $sMsjError = "No existe el tipo de material indicado";
									break;
			default: $sMsjError = "Error de codificaci&oacute;n";
		}
		return $sMsjError;
	}
}
?>
<?php
require_once 'Conexion.php';
class Cargos extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTADO DE CARGOS
    //*****************************************************************
    public function cargos(){
        $resultado = $this->mysqli->query("SELECT * FROM cargos");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data; 
        } 
        
    }

}

?>
<?php
require_once 'Conexion.php';
class Personal extends Conexion {

    public $mysqli;
    public $data;

    public function __construct() {
        $this->mysqli = parent::conectar();
        $this->data = array();
    }

    //*****************************************************************
    // LISTAMOS TODO EL PERSONAL
    //*****************************************************************
    public function personal(){
        $resultado = $this->mysqli->query("SELECT
            personal.id,
            personal.nombre,
            personal.sexo,
            personal.telefono,
            personal.direccion,
            personal.correo,
            pais.pais,
            cargos.cargo
            FROM
            personal
            INNER JOIN pais ON personal.idpais = pais.id
            INNER JOIN cargos ON personal.idcargo = cargos.id
            ");

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data; 
        }         
    }
    
    
    
    //*****************************************************************
    // AGREGAR PERSONAL
    //*****************************************************************
    public function add() {

        $consulta = sprintf(
            "INSERT INTO personal values(null, %s, %s, %s, %s, %s, %s, %s);",  
            parent::comillas_inteligentes($_POST['nm']), 
            parent::comillas_inteligentes($_POST['gd']), 
            parent::comillas_inteligentes($_POST['tl']),
            parent::comillas_inteligentes($_POST['ar']),
            parent::comillas_inteligentes($_POST['email']),
            parent::comillas_inteligentes($_POST['pais']),
            parent::comillas_inteligentes($_POST['cargo'])
            );
        $this->mysqli->query($consulta);

    }
    //*****************************************************************
    // MODIFICAR PERSONAL
    //*****************************************************************
    public function update() {

        $consulta = sprintf(
            "UPDATE personal SET
            nombre = %s,
            sexo = %s,
            telefono = %s,
            direccion = %s,
            correo = %s,
            idpais = %s,
            idcargo = %s
            WHERE
            id = %s;", 
            parent::comillas_inteligentes($_POST['nm']), 
            parent::comillas_inteligentes($_POST['gd']),
            parent::comillas_inteligentes($_POST['tl']),
            parent::comillas_inteligentes($_POST['ar']),
            parent::comillas_inteligentes($_POST['email']),
            parent::comillas_inteligentes($_POST['pais']),
            parent::comillas_inteligentes($_POST['cargo']),
            parent::comillas_inteligentes($_POST['id'])
            );

        $this->mysqli->query($consulta);

        echo "<script type='text/javascript'>window.location='index.php';</script>";
    }
    //*****************************************************************
    // ELIMINAR PRODUCTO
    //*****************************************************************
    public function delete($id) {
        $query = sprintf(
            "DELETE FROM personal WHERE id = %s;", 
            parent::comillas_inteligentes($id)
            );
        $this->mysqli->query($query);
        header("Location: index.php");
    }
    //*****************************************************************
    // PERSONAL POR ID
    //*****************************************************************
    public function personalPorId($id){
        $consulta = sprintf("SELECT
            personal.id,
            personal.nombre,
            personal.sexo,
            personal.telefono,
            personal.direccion,
            personal.correo,
            personal.idpais,
            personal.idcargo,
            pais.pais
            FROM
            personal
            INNER JOIN pais ON personal.idpais = pais.id
            INNER JOIN cargos ON personal.idcargo = cargos.id
            WHERE
            personal.id = %s", 
            parent::comillas_inteligentes($id)
            );

        $resultado = $this->mysqli->query($consulta);

        while( $fila = $resultado->fetch_assoc() ){
            $data[] = $fila;
        }

        if (isset($data)) {
            return $data; 
        }
    }
}
?>
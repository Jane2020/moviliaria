<?php
require_once 'Conexion.php';
class Lotizacion extends Conexion {
	public $mysqli;
	public $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lotizaciones
	 */
	public function listarLotizacion(){		
		$resultado = $this->mysqli->query("SELECT * FROM lotizacion");		
		if($resultado != null){
			while( $fila = $resultado->fetch_array() ){
				$data[] = $fila;
			}	
			if (isset($data)) {
				return $data;
			}
		}
	}	
	
	/**
	 * Función que obtiene los datos de una lotización dado el id
	 */	
	public function editarLotizacion(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT * FROM lotizacion where id=".$id);	
			$data= $$resultado->fetch_row();			
		}
		else{
			$data = (object) array('id'=>0,''=>'','lotizacion' =>'','ciudad'=>'','sector'=>'','referencia'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una lotización
	 */
	public function guardarLotizacion() {	
		if ($_POST['id'] == 0){
			$localizacion = $_POST['lotizacion'];
			$ciudad = $_POST['ciudad'];
			$sector = $_POST['sector'];
			$referencia = $_POST['referencia'];
			$consulta = "INSERT INTO lotizacion( nombre, ciudad, sector, referencia)
						 VALUES ('".$localizacion."','".$ciudad."','".$sector."','".$referencia."')";
		}
		else{
			$consulta = sprintf(
					"UPDATE lotizacion SET
		            nombre = %s,
		            ciudad = %s,
		            sector = %s,
		            referencia
		            WHERE
		            id = %s;",
					parent::comillas_inteligentes($_POST['lotizacion']),
					parent::comillas_inteligentes($_POST['ciudad']),
					parent::comillas_inteligentes($_POST['sector']),
					parent::comillas_inteligentes($_POST['referencia'])
					);				
		}
		$resultado = $this->mysqli->query($consulta);
		if ($resultado)
		{
			header('Location:listar.php');
		}
		else
		{
			echo"No se inserto";
		}
	}	
}
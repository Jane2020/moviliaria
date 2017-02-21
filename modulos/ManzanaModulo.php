<?php
require_once 'Conexion.php';
class Manzana extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Manzanas
	 */
	public function listarManzanas(){		
		$resultado = $this->mysqli->query("SELECT m.id,m.nombre,m.descripcion, l.nombre as lotizacion FROM manzana m
										   INNER JOIN lotizacion l on l.id=m.lotizacion_id where m.eliminado=0");		
		if($resultado != null){
			while( $fila = $resultado->fetch_object() ){
				$data[] = $fila;
			}	
			if (isset($data)) {
				return $data;
			}
		}
	}	
	
	/**
	 * Función que obtiene el Listado de Lotizaciones
	 */
	public function listarLotizacion(){
		$resultado = $this->mysqli->query("SELECT id, nombre FROM lotizacion where eliminado=0");
		if($resultado != null){
			while( $fila = $resultado->fetch_object() ){
				$data[] = $fila;
			}
			if (isset($data)) {
				return $data;
			}
		}
	}
	
	/**
	 * Función que edita los datos de una Manzana
	 */	
	public function editarManzana(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT * FROM manzana where id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,''=>'','nombre' =>'','descipcion'=>'','lotizacion_id'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Manzana
	 */
	public function guardarManzana() {
		$nombre = $_POST['nombre'];
		$descripcion = trim($_POST['descripcion']);
		$lotizacion_id = $_POST['lotizacion_id'];			
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO manzana(nombre, descripcion,lotizacion_id)
						 VALUES ('".$nombre."','".$descripcion."',".$lotizacion_id.")";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE manzana SET nombre='".$nombre."',descripcion='".$descripcion."',lotizacion_id=".$lotizacion_id." WHERE id=".$id;	
		}
		try {
			$resultado = $this->mysqli->query($consulta);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location:listar.php" );
	}	
	
	/**
	 * Función que eliminar logicamente una Manzana
	 */
	public function eliminarManzana() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE manzana SET eliminado=1 WHERE id =".$id;
			try {
				$resultado = $this->mysqli->query($consulta);
				$_SESSION ['message'] = "Datos eliminados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
			header ( "Location:listar.php" );
		}
	}
}
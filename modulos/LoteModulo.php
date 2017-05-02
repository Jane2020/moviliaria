<?php

require_once 'Conexion.php';
class Lote extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lotes
	 */
	public function listarLotes(){		
		$resultado = $this->mysqli->query("SELECT l.*,m.id as manzana_id, m.nombre as manzana_nombre  FROM lote l 
										   INNER JOIN manzana m ON l.manzana_id=m.id WHERE l.eliminado=0");		
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
	 * Función que obtiene el Listado de Manzanas
	 */
	public function listarManzanas(){
		$resultado = $this->mysqli->query("SELECT id, nombre FROM manzana where eliminado=0");
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
	 * Función que edita los datos de una Lote
	 */	
	public function editarLote(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT l.*,m.id as manzana_id, m.nombre as manzana_nombre  FROM lote l 
										   INNER JOIN manzana m ON l.manzana_id=m.id WHERE l.id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,''=>'','nombre' =>'','ubicacion'=>'','dimension'=>'','dimension'=>'','numero_lote'=>'','disponible'=>'','manzana_id'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Lote
	 */
	public function guardarLote() {
		$nombre = $_POST['nombre'];
		$ubicacion = trim($_POST['ubicacion']);
		$dimension = $_POST['dimension'];		
		$numero_lote = trim($_POST['numero_lote']);
		$disponible = isset($_POST['disponible'])?$_POST['disponible']:0;
		$manzana_id = $_POST['manzana_id'];		
		
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO lote(nombre,ubicacion,dimension,numero_lote,disponible,manzana_id)
						 VALUES ('".$nombre."','".$ubicacion."','".$dimension."',".$numero_lote.",".$disponible.",".$manzana_id.")";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE lote SET nombre='".$nombre."',ubicacion='".$ubicacion."',dimension='".$dimension."',disponible=".$disponible." ,numero_lote=".$numero_lote.", manzana_id=".$manzana_id." WHERE id=".$_POST['id'];			
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
	 * Función que eliminar logicamente un Lote
	 */
	public function eliminarLote() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta_lote ="SELECT * FROM acuerdo where estado=1 and lote_id=".$id;
			$resultado_lote = $this->mysqli->query($consulta_lote);
			if($resultado_lote->num_rows == 0){
				$consulta = "UPDATE lote SET eliminado=1 WHERE id =".$id;
				try {
					$resultado = $this->mysqli->query($consulta);
					$_SESSION ['message'] = "Datos eliminados correctamente.";
				} catch ( Exception $e ) {
					$_SESSION ['message'] = $e->getMessage ();
				}
			}
			else{
				$_SESSION ['message'] = "No se puede eliminar la lote, existen un acuerdo relacionado.";
			}
			header ( "Location:listar.php" );
		}
	}
}
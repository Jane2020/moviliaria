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
	 * Función que obtiene el Listado de Lotes
	 */
	public function listarLote(){
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
			$data = (object) array('id'=>0,''=>'','nombre' =>'','descipcion'=>'','lotizacion_id'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Manzana
	 */
	public function guardarLote() {
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
		$resultado = $this->mysqli->query($consulta);
		if ($resultado)
		{
			header('Location:listar.php');
		}
		else
		{
			echo"Error al insertar";
		}
	}	
	
	public function eliminarLote() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE manzana SET eliminado=1 WHERE id =".$id;
			$resultado = $this->mysqli->query($consulta);
			if ($resultado)
			{
				header('Location:listar.php');
			}
			else
			{
				echo"Error al eliminar";
			}
		}
	}
}
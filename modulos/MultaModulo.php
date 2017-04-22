<?php
require_once 'Conexion.php';
class Multa extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Multas
	 */
	public function listarMultas(){		
		$resultado = $this->mysqli->query("SELECT * FROM multa where eliminado=0");		
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
	 * Función que edita los datos de una multa
	 */	
	public function editarMulta(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT * FROM multa where id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,''=>'','nombre' =>'','descipcion'=>'','valor'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una multa
	 */
	public function guardarMulta() {
		$nombre = $_POST['nombre'];
		$descripcion = trim($_POST['descripcion']);
		$valor = $_POST['valor'];			
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO multa( nombre, descripcion,valor)
						 VALUES ('".$nombre."','".$descripcion."',".$valor.")";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE multa SET nombre='".$nombre."',descripcion='".$descripcion."',valor=".$valor." WHERE id=".$id;	
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
	 * Función que eliminar logicamente una Multa
	 */	
	public function eliminarMulta() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta_multa ="SELECT * FROM lote_multa where multa_id=".$id;
			$resultado_multa = $this->mysqli->query($consulta_multa);
			if($resultado_multa->num_rows == 0){					
				$consulta = "UPDATE multa SET eliminado=1 WHERE id =".$id;
				try {
					$resultado = $this->mysqli->query($consulta);
					$_SESSION ['message'] = "Datos eliminados correctamente.";
				} catch ( Exception $e ) {
					$_SESSION ['message'] = $e->getMessage ();
				}
			}
			else{
				$_SESSION ['message'] = "No se puede eliminar la multa, existen elementos relacionados.";
			}
			header ( "Location:listar.php" );
		}
	}
}
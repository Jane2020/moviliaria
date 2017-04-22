<?php
require_once 'Conexion.php';
class Obras extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Obras de Infraestructura
	 */
	public function listarObras(){		
		$resultado = $this->mysqli->query("SELECT * FROM obras_infraestructura where eliminado=0");		
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
	 * Función que obtiene los datos de una obra dado el id
	 */	
	public function editarObra(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT * FROM obras_infraestructura where id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,''=>'','nombre' =>'','valor' =>'','descripcion'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una obra
	 */
	public function guardarObra() {
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$valor = $_POST['valor'];
			
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO obras_infraestructura(nombre, descripcion,valor)
						 VALUES ('".$nombre."','".$descripcion."',".$valor.")";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE obras_infraestructura SET nombre='".
			$nombre."',valor=".$valor.",descripcion='".$descripcion.
			"' WHERE id=".$id;	
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
	 * Función que eliminar logicamente una obra
	 */	
	public function eliminarObra() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];		
			$consulta_obra ="SELECT * FROM lote_infraestructura where infraestructura_id=".$id;
			$resultado_obra = $this->mysqli->query($consulta_obra);
			if($resultado_obra->num_rows == 0){						
				$consulta = "UPDATE obras_infraestructura SET eliminado=1 WHERE id =".$id;
				try {
					$resultado = $this->mysqli->query($consulta);
					$_SESSION ['message'] = "Datos eliminados correctamente.";
				} catch ( Exception $e ) {
					$_SESSION ['message'] = $e->getMessage ();
				}
			}
			else{
				$_SESSION ['message'] = "No se puede eliminar la obra, existen elementos relacionados.";
			}
			header ( "Location:listar.php" );
		}
	}
}
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
			$data = (object) array('id'=>0,''=>'','nombre' =>'','descripcion'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una obra
	 */
	public function guardarObra() {
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
			
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO obras_infraestructura(nombre, descripcion)
						 VALUES ('".$nombre."','".$descripcion."')";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE obras_infraestructura SET nombre='".
			$nombre."',descripcion='".$descripcion.
			"' WHERE id=".$id;	
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
	
	public function eliminarObra() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE obras_infraestructura SET eliminado=1 WHERE id =".$id;
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
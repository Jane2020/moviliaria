<?php
require_once 'Conexion.php';
class Manzana extends Conexion {
	public $mysqli;
	public $data;
	
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
	 * Función que edita los datos de una Manzana
	 */	
	public function editarManzana(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT * FROM multa where id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,''=>'','nombre' =>'','descipcion'=>'','lotizacion'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Manzana
	 */
	public function guardarManzana() {
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
	
	public function eliminarManzana() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE multa SET eliminado=1 WHERE id =".$id;
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
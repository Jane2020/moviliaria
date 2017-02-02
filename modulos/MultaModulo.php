<?php
require_once 'Conexion.php';
class Multa extends Conexion {
	public $mysqli;
	public $data;
	
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
	
	public function eliminarMulta() {
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
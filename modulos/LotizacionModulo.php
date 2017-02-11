<?php
require_once 'Conexion.php';
class Lotizacion extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lotizaciones
	 */
	public function listarLotizacion(){		
		$resultado = $this->mysqli->query("SELECT * FROM lotizacion where eliminado=0");		
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
	 * Función que obtiene los datos de una lotización dado el id
	 */	
	public function editarLotizacion(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT * FROM lotizacion where id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,''=>'','nombre' =>'','ciudad'=>'','sector'=>'','referencia'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una lotización
	 */
	public function guardarLotizacion() {
		$localizacion = $_POST['nombre'];
		$ciudad = $_POST['ciudad'];
		$sector = $_POST['sector'];
		$referencia = $_POST['referencia'];
			
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO lotizacion( nombre, ciudad, sector, referencia)
						 VALUES ('".$localizacion."','".$ciudad."','".$sector."','".$referencia."')";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE lotizacion SET nombre='".
			$localizacion."',ciudad='".$ciudad."',sector='".$sector."',referencia='".$referencia.
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
	
	public function eliminarLotizacion() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE lotizacion SET eliminado=1 WHERE id =".$id;
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
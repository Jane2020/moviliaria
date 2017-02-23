<?php
require_once 'Conexion.php';
class Cliente extends Conexion {
	private $mysqli;
	private $data;
	
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Clientes
	 */
	public function listarClientes(){		
		$resultado = $this->mysqli->query("SELECT u.*, t.nombre as tipo  FROM usuario as u 
										   INNER JOIN tipo_usuario as t ON u.tipo_usuario_id = t.id WHERE u.eliminado=0 and tipo_usuario_id = 3");		
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
	 * Función que edita los datos de un Cliente
	 */	
	public function editarCliente(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT u.*  FROM usuario as u WHERE u.id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,'cedula'=>'','nombres' =>'','apellidos'=>'','email'=>'','celular'=>'');
		}
		
		return $data;
	}
	
	/**
	 * Función que guarda o modificar un Cliente
	 */
	public function guardarCliente() {
		$nombres = $_POST['nombres'];
		$cedula = trim($_POST['cedula']);
		$apellidos = $_POST['apellidos'];				
		$email = $_POST['email'];
		$celular = $_POST['celular'];		
				
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO usuario(cedula,nombres,apellidos,password,email,celular,tipo_usuario_id)
						 VALUES ('".$cedula."','".$nombres."','".$apellidos."', '".md5($cedula)."',  '".$email."','".$celular."',3)";
		} else {			
			$consulta = "UPDATE usuario SET cedula='".$cedula."', nombres='".$nombres."',apellidos='".$apellidos."', email='".$email."' ,celular='".$celular."' WHERE id=".$_POST['id'];	
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
	 * Función que eliminar logicamente un Cliente
	 */
	public function eliminarCliente() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE usuario SET eliminado=1 WHERE id =".$id;
			try {
				$resultado = $this->mysqli->query($consulta);
				$_SESSION ['message'] = "Datos eliminados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
			
		}
		header ( "Location:listar.php" );
	}
}


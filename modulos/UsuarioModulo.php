<?php
require_once 'Conexion.php';
class Usuario extends Conexion {
	private $mysqli;
	private $data;
	public $patron = '----';
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Usuarios
	 */
	public function listarUsuarios(){		
		$resultado = $this->mysqli->query("SELECT u.*, t.nombre as tipo  FROM usuario as u 
										   INNER JOIN tipo_usuario as t ON u.tipo_usuario_id = t.id WHERE u.eliminado=0 and tipo_usuario_id <> 3");		
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
	 * Función que obtiene el Listado de Tipos de usuarios
	 */
	public function listarTipos(){
		$resultado = $this->mysqli->query("SELECT id, nombre FROM tipo_usuario where id != 3");
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
	 * Función que edita los datos de un Usuario
	 */	
	public function editarUsuario(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT u.*  FROM usuario as u WHERE u.id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,'cedula'=>'','nombres' =>'','apellidos'=>'','email'=>'','celular'=>'','password'=>'','tipo_usuario_id'=>0);
		}
		$data->password = $this->patron;
		return $data;
	}
	
	/**
	 * Función que guarda o modificar un Usuario
	 */
	public function guardarUsuario() {
		$nombres = $_POST['nombres'];
		$cedula = trim($_POST['cedula']);
		$apellidos = $_POST['apellidos'];		
		$password = trim($_POST['password']);
		$email = $_POST['email'];
		$celular = $_POST['celular'];		
		$tipo = $_POST['tipo'];
		
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO usuario(cedula,nombres,apellidos,password,email,celular,tipo_usuario_id)
						 VALUES ('".$cedula."','".$nombres."','".$apellidos."', '".md5($password)."',  '".$email."','".$celular."',".$tipo.")";
		} else {
			if($password != $this->patron){
				$password = "password='".md5($password)."', ";
			}
			$id = $_POST['id'];
			$consulta = "UPDATE usuario SET cedula='".$cedula."', nombres='".$nombres."',apellidos='".$apellidos."', ".$password." email='".$email."' ,celular='".$celular."', tipo_usuario_id=".$tipo." WHERE id=".$_POST['id'];	
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
	 * Función que eliminar logicamente un Usuario
	 */
	public function eliminarUsuario() {
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
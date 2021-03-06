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
										   INNER JOIN tipo_usuario as t ON u.tipo_usuario_id = t.id WHERE u.eliminado=0 ");		
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
		$resultado = $this->mysqli->query("SELECT id, nombre FROM tipo_usuario ");
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
			$data = (object) array('id'=>0,'cedula'=>'','nombres' =>'','apellidos'=>'','email'=>'','celular'=>'','direccion'=>'','telefono'=>'','password'=>'','tipo_usuario_id'=>0);
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
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$tipo = $_POST['tipo'];
		
		if($this->validarUsuario($cedula, $tipo, $_POST['id'])){

			if ($_POST['id'] == 0){
				$consulta = "INSERT INTO usuario(cedula,nombres,apellidos,password,email,celular,telefono,direccion,tipo_usuario_id)
						 VALUES ('".$cedula."','".$nombres."','".$apellidos."', '".md5($password)."',  '".$email."','".$celular."','".$telefono."','".$direccion."',".$tipo.")";
			} else {
				if($password != $this->patron){
					$password = "password='".md5($password)."', ";
				}
				else {
					$password =null;
				}
				$id = $_POST['id'];
				$consulta = "UPDATE usuario SET cedula='".$cedula."', nombres='".$nombres."',apellidos='".$apellidos."', ".$password." email='".$email."' ,celular='".$celular."' ,telefono='".$telefono."' ,direccion='".$direccion."', tipo_usuario_id=".$tipo." WHERE id=".$_POST['id'];
			}
			try {
				$resultado = $this->mysqli->query($consulta);
				$_SESSION ['message'] = "Datos almacenados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
		} else {
			$_SESSION ['message'] = "El usuario ya se encuentra registrado con el Rol seleccionado.";
		}
		
		
		header ( "Location:listar.php" );
	}	
	
	
	private function validarUsuario($cedula, $tipo, $id){
		$resultado = $this->mysqli->query("SELECT u.id FROM usuario as u
										   WHERE u.eliminado=0 and cedula = '".$cedula."' and tipo_usuario_id=".$tipo);
		if($resultado != null){
			
			$userId = 0;
			
			while( $fila = $resultado->fetch_object() ){
				$userId = $fila->id;
			}
			if ($userId > 0) {
				if($userId == $id){
					return true;
				}
				return false;
				
			} else {
				return true;
			}
			
		} else {
			return true;
		}
	
	}
	
	
	/**
	 * Función que eliminar logicamente un Usuario
	 */
	public function eliminarUsuario() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];		
			$usuario_sesion = $_SESSION['SESSION_USER']->id;
			if( $id != $usuario_sesion){
				$consulta_usuario ="SELECT * FROM acuerdo where estado=1 and usuario_id=".$id;
				$resultado_usuario = $this->mysqli->query($consulta_usuario);
				if($resultado_usuario->num_rows == 0){					
					$consulta = "UPDATE usuario SET eliminado=1 WHERE id =".$id;
					try {
						$resultado = $this->mysqli->query($consulta);
						$_SESSION ['message'] = "Datos eliminados correctamente.";
					} catch ( Exception $e ) {
						$_SESSION ['message'] = $e->getMessage ();
					}
				}
				else{
					$_SESSION ['message'] = "No se puede eliminar el cliente, existen items relacionados.";
				}
			}
			else{
				$_SESSION ['message'] = "No se puede eliminar el usuario, actualmente es el usuario activo.";
			}
		}
		header ( "Location:listar.php" );
	}
}
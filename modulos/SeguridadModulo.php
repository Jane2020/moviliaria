<?php

require_once 'Conexion.php';
class Seguridad extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	public function limpiar($str){
		$str = @trim($str);
		if(get_magic_quotes_gpc())
		{
			$str = stripslashes($str);
		}
		return addslashes($str);
	}
	
	public function validar()
	{
		$login = $this->limpiar($_POST['usuario']);
		$password = $this->limpiar($_POST['contrasena']);
		
		$sql = "select id, nombres, apellidos, tipo_usuario_id,cedula
				from usuario
				where cedula= '".$login."' and password = '".md5($password)."' and eliminado = 0";
	
		$resultado = $this->mysqli->query($sql);
		
		if($resultado != null){
			$result = $resultado->fetch_object();
			if(is_object($result)){
				session_regenerate_id();
				$_SESSION['SESSION_USER'] = $result;
				session_write_close();
				if($result->tipo_usuario_id == 3){
					$redirect = "../../web/index.php";
				}				
				else{				
					
					$redirect = "inicio.php";
				}
			}
			 else {
				$_SESSION ['message'] = "Credenciales Inválidas..";
				$redirect = "login.php";
			 }
		}
		header ( "Location:" .$redirect );

	}
	
	public function cerrarSesion(){
		session_start();
		$sesion = $_SESSION["SESSION_USER"];
		unset($_SESSION["SESSION_USER"]);
		session_destroy();
		if($sesion->tipo_usuario_id==3){
			header("Location: ../../web/index.php");
		}
		else{
			header("Location: ../seguridad/login.php");
		}
	}
	
	public function cambiarContrasena(){
		header("Location: ../seguridad/cambio.php");
	}
	
	public function cambiarContraseñaDatos($back=true){
		$passwd["p1"] = $_POST['passwordAnterior'];
		$passwd["p2"] = $_POST['password'];
		$passwd["p3"] = $_POST['password1'];
		$user = $_SESSION['SESSION_USER']->id;
		$message = $this->validarContrasenas($passwd,$user);

		if($message == ''){
			$sql = "update usuario set password = md5('".$passwd["p2"]."') where id = ".$user;
			$resultado = $this->mysqli->query($sql);
			$_SESSION['message'] = "Su contraseña ha sido cambiada exitosamente.";
			
		} else {
			$_SESSION['message'] = $message;
		}
	if($back){
		header("Location: ../seguridad/cambio.php");
	} 
		
	}
	
	private function validarContrasenas($passwd,$user,$band = true){
		
		if($band){
			$sql = "select id from usuario where id = ".$user." and password = md5('".$passwd["p1"]."')";
			$resultado = $this->mysqli->query($sql);
			$result = $resultado->fetch_object();
			if(!is_object($result)){			
				return 'La contraseña actual no coincide.';
			}
		}
	
		if ($passwd["p2"] == ''){
			return 'Por favor ingrese un Password';
		}
		if ($passwd["p3"] == '') {
			return 'Por favor ingrese nuevamente un Password';
		}
		if ($passwd["p2"] != $passwd["p3"]){
			return 'Las contraseñas no coinciden';
		}
		return "";
	}
	
	public function error403(){
		require_once PATH_VISTAS."/Seguridad/vista.error403.php";
	}
	
	public function error404(){
		require_once PATH_VISTAS."/Seguridad/vista.error404.php";
	}
	
	public function error500(){
		require_once PATH_VISTAS."/Seguridad/vista.error500.php";
	}
	
	
	public function getEstadisticas(){
		$resultado = $this->mysqli->query("SELECT count(id) as total FROM lotizacion");
		$fila = $resultado->fetch_object();
		$datos['lotizaciones'] = $fila->total;
		
		$resultado = $this->mysqli->query("SELECT count(id) as total FROM lote");
		$fila = $resultado->fetch_object();
		$datos['lotes'] = $fila->total;
		$resultado = $this->mysqli->query("SELECT count(id) as total FROM lote where disponible = 1");
		$fila = $resultado->fetch_object();
		$datos['lotes_disponibles'] = $fila->total;
		$resultado = $this->mysqli->query("SELECT count(id) as total FROM usuario where tipo_usuario_id = 3");
		$fila = $resultado->fetch_object();
		$datos['clientes'] = $fila->total;
		
		return $datos;
	}
	
	
	
}
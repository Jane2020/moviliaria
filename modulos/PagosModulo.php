<?php

require_once 'Conexion.php';
class Pagos extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Acuerdos
	 */
	public function listarPagos(){		
		$resultado = $this->mysqli->query("SELECT a.id,concat(u.nombres,' ', u.apellidos) as nombre_cliente,
											l.numero_lote, cod_promesa,fecha_ingreso
											FROM acuerdo a 
											INNER JOIN usuario u ON u.id= a.usuario_id
											INNER JOIN lote l ON l.id= a.lote_id
											WHERE a.eliminado=0");		
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
	 * Función que obtiene el Listado de Lotizaciones
	 */
	public function listarLotizaciones(){
		$resultado = $this->mysqli->query("SELECT * FROM lotizacion WHERE eliminado=0");
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
	 * Función que obtiene el Listado de Manzanas dado el id de la Lotización
	 */
	public function listarManzanasByLotizacion($lotizacion_id=null){
		if(isset($_GET['id']) && $_GET['id'] >0 && $lotizacion_id == null){
			$id= $_GET['id'];
		}
		else{
			$id=$lotizacion_id;
		}
		$resultado = $this->mysqli->query("SELECT * FROM manzana WHERE lotizacion_id=".$id." and eliminado=0");
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
	 * Función que obtiene el Listado de Lotes dado el id de la manzana
	 */
	public function listarLoteByLManzana($manzana_id=null){
		$disponible = null;
		if(isset($_GET['id']) && $_GET['id'] >0 && $manzana_id==null){
			$id= $_GET['id'];			
			$disponible = " and disponible=1 ";
		}
		else{
			$id=$manzana_id;
		}
		$resultado = $this->mysqli->query("SELECT id,numero_lote as nombre FROM lote where eliminado=0 ".$disponible." and manzana_id=".$id);
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
	 * Función que obtiene el Usuario dado la cédula
	 */
	public function obtenerCedula($cedula){
		$resultado = $this->mysqli->query("SELECT id as usuario_id, concat(nombres,' ' ,apellidos) as nombre FROM usuario WHERE eliminado=0 and tipo_usuario_id=3 and cedula ='".$cedula."'");
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
	 * Función que edita los datos de una Acuerdo
	 */	
	public function editarPagos(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT a.id, u.id as usuario_id,a.id,concat(u.nombres,' ', u.apellidos) as usuario,
												m.lotizacion_id,l.manzana_id,
												a.lote_id, cod_promesa,fecha_ingreso,valor_ingreso,valor_venta,cod_promesa
												FROM acuerdo a 
												INNER JOIN usuario u ON u.id= a.usuario_id
												INNER JOIN lote l ON l.id= a.lote_id
												INNER JOIN manzana m ON m.id = l.manzana_id
												INNER JOIN lotizacion lz ON lz.id = m.lotizacion_id
												WHERE a.id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,'usuario'=>'','usuario_id'=>'','lotizacion_id' =>'','manzana_id' =>'','lote_id' =>'','usuario'=>'','usuario_id'=>'','fecha_ingreso'=>'','valor_ingreso'=>'','valor_venta'=>'','cod_promesa'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Acuerdo
	 */
	public function guardarPagos() {
		$usuario_id = $_POST['usuario_id'];		
		$lote_id = trim($_POST['lote_id']);		
		$fecha_ingreso = $_POST['fecha_ingreso'];		
		$valor_ingreso = trim($_POST['valor_ingreso']);
		$valor_venta = $_POST['valor_venta'];
		$cod_promesa = $_POST['cod_promesa'];		
		
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO acuerdo(usuario_id,lote_id, fecha_ingreso,valor_ingreso,valor_venta,cod_promesa)
						 VALUES ('".$usuario_id."','".$lote_id."','".$fecha_ingreso."',".$valor_ingreso.",".$valor_venta.",'".$cod_promesa."')";
		}
		else{
			$id = $_POST['id'];
			$consulta = "UPDATE lote SET nombre='".$nombre."',ubicacion='".$ubicacion."',dimension='".$dimension."',disponible=".$disponible." ,numero_lote=".$numero_lote.", manzana_id=".$manzana_id." WHERE id=".$_POST['id'];	
		}
		$consulta_lote = "UPDATE lote SET disponible=0 WHERE id=".$lote_id;
		try {
			$this->mysqli->query($consulta);
			$this->mysqli->query($consulta_lote);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location:listar.php" );
	}	
	
	/**
	 * Función que eliminar logicamente un Pagos
	 */
	public function eliminarPagos() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE acuerdo SET eliminado=1 WHERE id =".$id;
			$consulta_lote = "UPDATE lote SET disponible=1 WHERE id=".$lote_id;
			try {
				 $this->mysqli->query($consulta);
				 $this->mysqli->query($consulta_lote);
				$_SESSION ['message'] = "Datos eliminados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
			header ( "Location:listar.php" );
		}
	}
}
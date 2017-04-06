<?php
require_once 'Conexion.php';
require_once 'LoteMultaObraModulo.php';

class Acuerdo extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Acuerdos
	 */
	public function listarAcuerdos(){		
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
	 * Función que obtiene el Listado de Tipos de pagp
	 */
	public function listarTipoPago(){
		$resultado = $this->mysqli->query("SELECT * FROM tipo_pago where eliminado=0");
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
		}
		else{
			$id=$manzana_id;			
		}
		if($_GET['id'] == $manzana_id){
			$disponible = " and disponible=1 ";
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
		$resultado = $this->mysqli->query("SELECT id as usuario_id, concat(nombres,' ' ,apellidos) as nombre FROM usuario WHERE tipo_usuario_id=3 and eliminado=0 and cedula ='".$cedula."'");
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
	public function editarAcuerdo(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT a.id, u.id as usuario_id,a.id,concat(u.nombres,' ', u.apellidos) as usuario,
												m.lotizacion_id,l.manzana_id,
												a.lote_id, cod_promesa,fecha_ingreso,valor_inicial,valor_total,cod_promesa,numero_abonos as num_cuotas, 
												p.tipo_pago_id as pago_id
												FROM acuerdo a
												INNER JOIN pago p ON p.acuerdo_id= a.id
												INNER JOIN usuario u ON u.id= a.usuario_id
												INNER JOIN lote l ON l.id= a.lote_id
												INNER JOIN manzana m ON m.id = l.manzana_id
												INNER JOIN lotizacion lz ON lz.id = m.lotizacion_id
												WHERE a.id=".$id);
			$data =  $resultado->fetch_object();					  	
		}
		else{
			$data = (object) array('id'=>0,'usuario'=>'','usuario_id'=>'','lotizacion_id' =>'','manzana_id' =>'','lote_id' =>'','usuario'=>'','usuario_id'=>'','fecha_ingreso'=>'','valor_total'=>'','valor_inicial'=>'','cod_promesa'=>'', 'pago_id'=>'', 'num_cuotas'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Acuerdo
	 */
	public function guardarAcuerdo() {
		$usuario_id = $_POST['usuario_id'];		
		$lote_id = trim($_POST['lote_id']);		
		$fecha_ingreso = date("Y-m-d");		
		$valor_total = trim($_POST['valor_total']);
		$valor_inicial = isset($_POST['valor_inicial'])?trim($_POST['valor_inicial']):trim($_POST['valor_total']);
		$cod_promesa = $_POST['cod_promesa'];
		$num_cuotas = isset($_POST['num_cuotas'])?$_POST['num_cuotas']:1;
		$tipo_pago_id = $_POST['pago_id'];
		$estado = $tipo_pago_id ==1?1:2;
		
		try {
			$consulta = "INSERT INTO acuerdo(usuario_id,lote_id, fecha_ingreso,valor_total,valor_inicial,cod_promesa)
							 VALUES ('".$usuario_id."','".$lote_id."','".$fecha_ingreso."',".$valor_total.",".$valor_inicial.",'".$cod_promesa."')";
			$this->mysqli->query($consulta);
			
			$acuerdo = new LoteMultaObraModulo();
			$acuerdoId = $acuerdo->obtenerAcuerdoId($lote_id);			
			$consulta_pago = "INSERT INTO pago(monto_total,numero_abonos,monto_pagado,estado,acuerdo_id,tipo_pago_id,id_item)
							  VALUES (".$valor_total.",". $num_cuotas .",". $valor_inicial .",".$estado.",". $acuerdoId.",". $tipo_pago_id.",". 1 .")";
			$this->mysqli->query($consulta_pago);
				
			$pagoId = $this->mysqli->insert_id;
			$consulta_trans="INSERT INTO transaccion(fecha_transaccion,valor,eliminado,pago_id)
							  VALUES ('".$fecha_ingreso."',". $valor_inicial .",". 0 .",". $pagoId.")";
			$this->mysqli->query($consulta_trans);					
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location:listar.php" );
	}
}
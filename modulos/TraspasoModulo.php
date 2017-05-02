<?php
require_once 'Conexion.php';
require_once 'LoteMultaObraModulo.php';

class Traspaso extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
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
			$disponible = " and disponible=0 ";
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
	
	public function getUserBylote($lote_id=null){
		
		$resultado = $this->mysqli->query("SELECT u.nombres, u.apellidos, a.id, a.cod_promesa FROM lote as l inner join acuerdo as a on l.id = a.lote_id inner join usuario as u on u.id = a.usuario_id where a.estado = 1 and  l.id=".$lote_id);
	
		if($resultado != null){
			$data = array();
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
		$acuerdo_id = $_POST['acuerdo_id'];
		$estado = $tipo_pago_id ==1?1:2;
		
		try {
			
			$updateEstado = "UPDATE acuerdo SET estado=0, tipo=1 WHERE id =".$acuerdo_id;
			$this->mysqli->query($updateEstado);
			
			$consulta = "INSERT INTO acuerdo(usuario_id,lote_id, fecha_ingreso,valor_total,valor_inicial,cod_promesa,tipo)
							 VALUES ('".$usuario_id."','".$lote_id."','".$fecha_ingreso."',".$valor_total.",".$valor_inicial.",'".$cod_promesa."', 2)";
			$this->mysqli->query($consulta);
			
			$acuerdoId = $this->mysqli->insert_id;
			$consulta_pago = "INSERT INTO pago(monto_total,numero_abonos,monto_pagado,estado,acuerdo_id,id_item,id_obra_multa)
							  VALUES (".$valor_total.",". $num_cuotas .",". $valor_inicial .",".$estado.",". $acuerdoId.",1,0)";
			$this->mysqli->query($consulta_pago);
				
			$pagoId = $this->mysqli->insert_id;
			$consulta_trans="INSERT INTO transaccion(fecha_transaccion,monto_total,valor,eliminado,pago_id,tipo_pago_id)
							  VALUES ('".$fecha_ingreso."',".$valor_total.",". $valor_inicial .",". 0 .",". $pagoId.",". $tipo_pago_id.")";
			$this->mysqli->query($consulta_trans);			
			
			$consulta_lote = "UPDATE lote SET disponible=0 WHERE id =".$lote_id;
			$this->mysqli->query($consulta_lote);
			
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		
	}
}
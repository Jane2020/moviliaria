<?php
require_once 'Conexion.php';
class LoteMultaObraModulo extends Conexion {
	private $mysqli;
	private $data;
	public function __construct() {
		$this->mysqli = parent::conectar ();
		$this->data = array ();
	}
	
	/**
	 * Función que obtiene el Listado de Lotizaciones
	 */
	public function listarLotizaciones() {
		$resultado = $this->mysqli->query ( "SELECT * FROM lotizacion where eliminado=0" );
		if ($resultado != null) {
			while ( $fila = $resultado->fetch_object () ) {
				$data [] = $fila;
			}
			if (isset ( $data )) {
				return $data;
			}
		}
	}
	
	/**
	 * Función que obtiene el Listado de Manzanas dado el id de la Lotización
	 */
	public function listarManzanasByLotizacion($lotizacion_id = null) {
		if (isset ( $_GET ['id'] ) && $_GET ['id'] > 0 && $lotizacion_id == null) {
			$id = $_GET ['id'];
		} else {
			$id = $lotizacion_id;
		}
		$resultado = $this->mysqli->query ( "SELECT * FROM manzana WHERE lotizacion_id=" . $id . " and eliminado=0" );
		if ($resultado != null) {
			while ( $fila = $resultado->fetch_object () ) {
				$data [] = $fila;
			}
			if (isset ( $data )) {
				return $data;
			}
		}
	}
	
	/**
	 * Función que obtiene el Listado de Lotes dado el id de la manzana
	 */
	public function listarLoteByLManzana($manzana_id = null) {
		if (isset ( $_GET ['id'] ) && $_GET ['id'] > 0 && $manzana_id == null) {
			$id = $_GET ['id'];
		} else {
			$id = $manzana_id;
		}
		$resultado = $this->mysqli->query ( "SELECT l.id, l.nombre FROM lote l 
					INNER JOIN acuerdo a on l.id=a.lote_id
					INNER JOIN usuario u on u.id=a.usuario_id				
					WHERE a.eliminado=0 and a.estado=1 and manzana_id=" . $id );
		if ($resultado != null) {
			while ( $fila = $resultado->fetch_object () ) {
				$data [] = $fila;
			}
			if (isset ( $data )) {
				return $data;
			}	else {
				return [];
			}
		}
	}
	
	/**
	 * Función que obtiene el valor de la multa dado el id
	 */
	public function obtenerValorMulta($multa_id = null) {
		if (isset ( $_GET ['id'] ) && $_GET ['id'] > 0 && $multa_id == null) {
			$id = $_GET ['id'];
		} else {
			$id = $multa_id;
		}
		$resultado = $this->mysqli->query ( "SELECT valor FROM multa WHERE eliminado=0 and id=" . $id );
		if ($resultado != null) {
			while ( $fila = $resultado->fetch_object () ) {
				$data [] = $fila;
			}
			if (isset ( $data )) {
				return $data;
			}
		}
	}
	
	
	/**
	 * Función que obtiene el Listado de Multas
	 */
	public function listarMultas() {
		$resultado = $this->mysqli->query ( "SELECT id, nombre FROM multa where eliminado=0" );
		if ($resultado != null) {
			while ( $fila = $resultado->fetch_object () ) {
				$data [] = $fila;
			}
			if (isset ( $data )) {
				return $data;
			}
		}
	}
	
	/**
	 * Función que obtiene el Listado de Obras de Infraestructura
	 */
	public function listaObras(){
		$resultado = $this->mysqli->query("SELECT * FROM obras_infraestructura where eliminado=0");
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
	 * Función que obtiene el valor de la multa dado el id
	 */
	public function obtenerValorObra($multa_id=null ){
		if(isset($_GET['id']) && $_GET['id'] >0 && $multa_id == null){
			$id= $_GET['id'];
		}
		else{
			$id = $multa_id;
		}
		$resultado = $this->mysqli->query("SELECT valor FROM obras_infraestructura WHERE eliminado=0 and id=".$id);
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
	 * Función que obtiene los datos de una Multa de Lote dado el id
	 */
	public function editarLoteMultas() {
		$data = ( object ) array (
				'id' => 0,
				'' => '',
				'lotizacion_id' => '',
				'lote_id' => '',
				'multa_id' => '',
				'valor_multa' => '',
				'valor'=> '',
				'obra_id'=> '',
				'fecha_ingreso' => '',
				'descripcion' => '' 
		);
		return $data;
	}
	
	/**
	 * Función que obtiene el id del acuerdo
	 */
	public function obtenerAcuerdoId($lote){
		$consulta = "SELECT id FROM acuerdo where lote_id=".$lote;
		$resultado = $this->mysqli->query($consulta);
		while ( $fila = $resultado->fetch_object () ) {
			$data [] = $fila;
		}
		if (isset ( $data )) {
			return $data[0]->id;
		}		
	}
	
	/**
	 * Función que guarda o modificar una Multa de Lote
	 */
	public function guardarLoteMultasObras() {
		$lotes = $_POST ['lote_id'];
		if (isset( $_POST ['multa_id'])) {
			$multa_id = $_POST ['multa_id'];
			$valor_multa = $this->obtenerValorMulta ( $multa_id );
			$valor = isset ( $valor_multa [0] ) ? $valor_multa [0]->valor : 0;
			$descripcion = $_POST ['descripcion'];
		}
		
		if(isset($_POST['obra_id'])){
			$obra_id = $_POST['obra_id'];
			$valor_obra = $this->obtenerValorObra($obra_id);
			$valor = isset($valor_obra[0])?$valor_obra[0]->valor:0;
		}
		$fecha_ingreso = $_POST ['fecha_ingreso'];
	
		if ($_POST ['id'] == 0) {
			try {
				foreach ($lotes as $lote){
					$acuerdoId = $this->obtenerAcuerdoId($lote);					
					if(isset($multa_id)){
						$consulta = "INSERT INTO lote_multa(lote_id,multa_id,valor_multa,fecha_ingreso,descripcion)
								 VALUES (" . $lote . "," . $multa_id . "," . $valor . ",'" . $fecha_ingreso . "','" . $descripcion . "')";
						$resultado = $this->mysqli->query($consulta);				
						
						$consulta = "SELECT id FROM lote_multa order by id desc";
						$resultado = $this->mysqli->query($consulta);
						$id = $resultado->fetch_row()[0];
						//Multa
						$tipo =3;
					}
					if(isset($obra_id)){
						$consulta = "INSERT INTO lote_infraestructura(lote_id,infraestructura_id,valor,fecha_ingreso)
						 VALUES (".$lote.",".$obra_id.",".$valor.",'".$fecha_ingreso."')";
						$resultado = $this->mysqli->query($consulta);
						$consulta = "SELECT id FROM lote_infraestructura order by id desc";
						$resultado = $this->mysqli->query($consulta);
						$id = $resultado->fetch_row()[0];
						//Obra
						$tipo =2;
					}
					
					$consulta_pago = "INSERT INTO pago(monto_total,numero_abonos,monto_pagado,estado,acuerdo_id,id_item, id_obra_multa)
							  VALUES (".$valor.",". 1 .",". 0 .",". 0 .",". $acuerdoId.",". $tipo .",".$id.")";		
					$resultado1 = 	$this->mysqli->query($consulta_pago);
					
				}
				$_SESSION ['message'] = "Datos almacenados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
		}
		if($_GET['tipo'] == 1){
			header ( "Location:../lote_multa/listar.php" );
		}else{
			header ( "Location:../lote_obra/listar.php" );
		}
	}
}
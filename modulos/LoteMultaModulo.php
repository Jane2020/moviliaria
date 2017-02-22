<?php
require_once 'Conexion.php';
class LoteMulta extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lote de Multas
	 */
	public function listarLoteMultas(){		
		$resultado = $this->mysqli->query("SELECT lm.id, l.nombre as lote,m.nombre as multa, m.valor,lm.descripcion 
										   FROM lote_multa lm
										   INNER JOIN lote l ON l.id = lm.lote_id
										   INNER JOIN multa m ON m.id = lm.multa_id
										   WHERE lm.eliminado=0");		
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
		if(isset($_GET['id']) && $_GET['id'] >0 && $manzana_id==null){
			$id= $_GET['id'];
		}
		else{
			$id=$manzana_id;
		}
		$resultado = $this->mysqli->query("SELECT * FROM lote where eliminado=0 and manzana_id=".$id);
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
	public function obtenerValorMulta($multa_id=null ){
		if(isset($_GET['id']) && $_GET['id'] >0 && $multa_id == null){
			$id= $_GET['id'];	
		}
		else{
			$id = $multa_id;
		}
		$resultado = $this->mysqli->query("SELECT valor FROM multa WHERE eliminado=0 and id=".$id);
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
	 * Función que obtiene el Listado de Multas
	 */
	public function listarMultas(){
		$resultado = $this->mysqli->query("SELECT id, nombre FROM multa where eliminado=0");
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
	public function editarLoteMultas(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT lm.id, lz.id as lotizacion_id,m.id as manzana_id,l.id as lote_id, lm.multa_id as multa_id, 
												lm.valor_multa,DATE_FORMAT(lm.fecha_ingreso,'%Y-%m-%d') as fecha_ingreso,lm.descripcion 
												FROM lote_multa lm
												INNER JOIN lote l ON l.id = lm.lote_id
												INNER JOIN manzana m ON m.id = l.manzana_id
												INNER JOIN lotizacion lz ON lz.id = m.lotizacion_id
												WHERE lm.eliminado=0 and lm.id=".$id);
			$data =  $resultado->fetch_object();				
		}
		else{
			$data = (object) array('id'=>0,''=>'','lotizacion_id' =>'','lote_id' =>'','multa_id' =>'','valor_multa' =>'','fecha_ingreso'=>'','descripcion'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Multa de Lote
	 */
	public function guardarLoteMultas() {
		$lote_id = $_POST['lote_id'];
		$multa_id = $_POST['multa_id'];
		if($multa_id){
			$valor_multa = $this->obtenerValorMulta($multa_id);
			$valor = isset($valor_multa[0])?$valor_multa[0]->valor:0;
		}
		$fecha_ingreso = $_POST['fecha_ingreso'];
		$descripcion = $_POST['descripcion'];			
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO lote_multa(lote_id,multa_id,valor_multa,fecha_ingreso,descripcion)
						 VALUES (".$lote_id.",".$multa_id.",".$valor.",'".$fecha_ingreso."','".$descripcion."')";		}
		else{
			$id = $_POST['id'];
			$lote_sql = isset($lote_id)?"lote_id=".$lote_id.",":"";
			$multa_sql = isset($multa_id)?"multa_id=".$multa_id.",":"";
			$consulta = "UPDATE lote_multa SET ".$lote_sql.$multa_sql." valor_multa=".$valor.",
					fecha_ingreso='".$fecha_ingreso."',descripcion='".$descripcion."' WHERE id=".$id;
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
	 * Función que eliminar logicamente una obra
	 */	
	public function eliminarLoteMultas() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE lote_multa SET eliminado=1 WHERE id =".$id;
			try {
				$resultado = $this->mysqli->query($consulta);
				$_SESSION ['message'] = "Datos eliminados correctamente.";
			} catch ( Exception $e ) {
				$_SESSION ['message'] = $e->getMessage ();
			}
			header ( "Location:listar.php" );
		}
	}
}
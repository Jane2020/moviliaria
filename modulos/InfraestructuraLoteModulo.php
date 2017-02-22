<?php
require_once 'Conexion.php';
class InfraestructuraLote extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lote de Multas
	 */
	public function listarLoteInfra(){		
		$resultado = $this->mysqli->query("SELECT li.id, l.nombre as lote,oi.nombre as infra, li.valor
										   FROM lote_infraestructura li
										   INNER JOIN lote l ON l.id = li.lote_id
										   left JOIN obras_infraestructura oi ON oi.id = li.infraestructura_id
										   WHERE li.eliminado=0");		
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
	 * Función que obtiene los datos de una Obras de Infraestructura de Lote dado el id
	 */	
	public function editarLoteInfra(){
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];
			$resultado = $this->mysqli->query("SELECT li.id, lz.id as lotizacion_id,m.id as manzana_id,l.id as lote_id, li.infraestructura_id as obra_id, 
												li.valor,DATE_FORMAT(li.fecha_ingreso,'%Y-%m-%d') as fecha_ingreso 
												FROM lote_infraestructura li
												INNER JOIN lote l ON l.id = li.lote_id
												INNER JOIN manzana m ON m.id = l.manzana_id
												INNER JOIN lotizacion lz ON lz.id = m.lotizacion_id
												WHERE li.eliminado=0 and li.id=".$id);
			$data =  $resultado->fetch_object();				
		}
		else{
			$data = (object) array('id'=>0,''=>'','lotizacion_id' =>'','lote_id' =>'','obra_id' =>'','valor' =>'','fecha_ingreso'=>'');
		}
		return $data;
	}
	
	/**
	 * Función que guarda o modificar una Obras de Infraestructura de un Lote
	 */
	public function guardarLoteInfra() {
		$lote_id = $_POST['lote_id'];
		$obra_id = $_POST['obra_id'];
		if($obra_id){
			$valor_obra = $this->obtenerValorObra($obra_id);
			$valor = isset($valor_obra[0])?$valor_obra[0]->valor:0;
		}
		$fecha_ingreso = $_POST['fecha_ingreso'];				
		if ($_POST['id'] == 0){
			$consulta = "INSERT INTO lote_infraestructura(lote_id,infraestructura_id,valor,fecha_ingreso)
						 VALUES (".$lote_id.",".$obra_id.",".$valor.",'".$fecha_ingreso."')";
		}
		else{
			$id = $_POST['id'];
			$lote_sql = isset($lote_id)?"lote_id=".$lote_id.",":"";
			$obra_sql = isset($obra_id)?"infraestructura_id=".$obra_id.",":"";
			$consulta = "UPDATE lote_infraestructura SET ".$lote_sql.$obra_sql." valor=".$valor.",
					fecha_ingreso='".$fecha_ingreso."' WHERE id=".$id;
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
	public function eliminarLoteInfra() {
		if(isset($_GET['id']) && $_GET['id'] >0){
			$id= $_GET['id'];			
			$consulta = "UPDATE lote_infraestructura SET eliminado=1 WHERE id =".$id;
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
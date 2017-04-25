<?php
require_once 'Conexion.php';
class Reportes extends Conexion {
	private $mysqli;
	private $data;
	
	public function __construct() {
		$this->mysqli = parent::conectar();
		$this->data = array();
	}
	
	/**
	 * Función que obtiene el Listado de Lotes por Manzanas
	 */
	public function listarLotesByManzana(){	
		$manzanas = $this->mysqli->query("SELECT distinct(m.id) as manzana_id, m.nombre as manzana, null as lotes
					FROM acuerdo a
					INNER JOIN lote l ON a.lote_id=l.id
					INNER JOIN manzana m ON l.manzana_id=m.id");
		if($manzanas != null){
			while( $fila = $manzanas->fetch_object() ){
				$data=[];					
				$lotes = $this->mysqli->query("SELECT a.id , u.nombres, u.apellidos,u.cedula,l.numero_lote, a.valor_total,a.cod_promesa
													FROM acuerdo a
													INNER JOIN usuario u ON a.usuario_id=u.id
													INNER JOIN lote l ON a.lote_id=l.id
													INNER JOIN manzana m ON l.manzana_id=m.id
													WHERE m.id=".$fila->manzana_id);		
				if($lotes != null){					
					while( $fila1 = $lotes->fetch_object() ){						
						$data[]= $fila1;
					}					
				}
				$fila->lotes = $data;
				$data1[] = $fila;
			}
		}
		return $data1;
	}	
	
}
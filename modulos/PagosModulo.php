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
	 * Función que obtiene el Listado de Lotes dada la Cédula
	 */
	public function listarLoteByCedula($cedula){		
		$resultado = $this->mysqli->query("SELECT a.id as id, l.numero_lote
											FROM acuerdo a
											INNER JOIN usuario u ON a.usuario_id=u.id
											INNER JOIN lote l ON l.id=a.lote_id
											WHERE l.eliminado=0 and u.cedula='".$cedula."'");		
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
	 * Función que obtiene el Listado de Lotes dada la Cédula
	 */
	public function listarPagos($cedula, $acuerdo_id){
		$resultado_pagos = $this->mysqli->query("SELECT p.id as pago_id , p.estado, id_item, t.valor,date_format(t.fecha_transaccion, '%Y-%m-%d') as fecha_pago
												FROM pago p
												INNER JOIN transaccion t on p.id=t.pago_id
												WHERE p.acuerdo_id =".$acuerdo_id);
		
		$resultado_sinpagos = $this->mysqli->query("SELECT p.id as pago_id , p.estado, id_item, monto_pagado, monto_total
												FROM pago p
												WHERE estado <>1 and p.acuerdo_id=".$acuerdo_id);		
		if(isset($resultado_pagos)){
			$html ="<div class='card'>
    					<div class='header'>
        					<h4 class='title'>Pagos Realizados</h4>                              
        				</div>
        				<div class='content table-responsive table-full-width'>
        					<table class='table table-striped'>
            					<thead>
                					<tr>
				                		<th>ID</th>
					                    <th>Nombre del Pago</th>
				    	                <th>Monto Pagado</th>
				        	            <th>Fecha de Pago</th> 
										<th>Estado</th>
                   					</tr>
                				</thead>
                				<tbody>";
			while( $fila = $resultado_pagos->fetch_object() ){
				if($fila->id_item == 1){
					$item_nombre = "Acuerdo";
				}else if($fila->id_item == 3){
					$item_nombre = "Multa";
				}
				else{
					$item_nombre = "Obra de Infraestructura";
				}				
				$item_estado = $fila->estado == 1?"Pagado":"Pago Parcial";
			$html .="				<tr>
		                    			<td>".$fila->pago_id."</td>
		                        		<td>".$item_nombre."</td>
		                        		<td>".$fila->valor."</td>
		                        		<td>".$fila->fecha_pago."</td>
		                        		<td>".$item_estado."</td>
	                    			</tr>
                				</tbody>
        					</table>
						</div>
					</div><br>";
			}
			$data[0]=$html;
		}	
		else{
			$data[0]=null;
		}
		if(isset($resultado_sinpagos)){
			$html ="<div class='card'>
    					<div class='header'>
        					<h4 class='title'>Cuentas por Pagar</h4>
        				</div>
        				<div class='content table-responsive table-full-width'>
        					<table class='table table-striped'>
            					<thead>
                					<tr>
				                		<th>ID</th>
					                    <th>Nombre del Pago</th>
				    	                <th>Monto Pagado</th>
				        	            <th>Monto por Pagar</th>					 					
										<th>Acción</th>
                   					</tr>
                				</thead>
                				<tbody>";
			while( $fila = $resultado_sinpagos->fetch_object() ){
				if($fila->id_item == 1){
					$item_nombre = "Acuerdo";
				}else if($fila->id_item == 3){
					$item_nombre = "Multa";
				}
				else{
					$item_nombre = "Obra de Infraestructura";
				}
				$deuda = $fila->monto_total - $fila->monto_pagado;
				$html .="				<tr>
		                    			<td>".$fila->pago_id."</td>
		                        		<td>".$item_nombre."</td>
		                        		<td>".$fila->monto_pagado."</td>
		                    			<td>".$deuda."</td>
		                        		<td><button type='submit' name='pagar' id='pagar' class='btn btn-success btn-sm'>Pagar</button></td>
	                    			</tr>
                				</tbody>
        					</table>
						</div>
					</div>";
			}	
			$data[1]=$html;
			
		}	
		else{
			$data[1]=null;
		}
		return $data;
		
		
	}
}
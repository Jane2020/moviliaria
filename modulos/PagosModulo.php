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
											WHERE a.estado=1 and l.eliminado=0 and u.cedula='".$cedula."'");		
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
	 * Función que obtiene el Listado de Pagos
	 */
	public function listarPagos($cedula, $acuerdo_id){
		$resultado_pagos = $this->mysqli->query("SELECT p.id as pago_id , p.estado, tp.nombre as estado_nombre,id_item,t.monto_total, t.valor,date_format(t.fecha_transaccion, '%Y-%m-%d') as fecha_pago
												FROM pago p
												INNER JOIN transaccion t on p.id=t.pago_id
				 								INNER JOIN tipo_pago tp on tp.id=tipo_pago_id
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
					        			<th>Monto Total</th>
				    	                <th>Monto Pagado</th>
				        	            <th>Fecha de Pago</th>
										<th>Tipo de Pago</th>
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
			$html .="				<tr>
		                    			<td>".$fila->pago_id."</td>
		                        		<td>".$item_nombre."</td>
		                        		<td>$".$fila->monto_total."</td>
		                        		<td>$".$fila->valor."</td>
		                        		<td>".$fila->fecha_pago."</td>
		                        		<td>".$fila->estado_nombre."</td>
		                        		<td>Pendiente de Poner</td>		                        		
	                    			</tr>
                				";
			}
			$html.="</tbody>
        					</table>
						</div>
					</div><br>";
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
		                    			<td>".$fila->pago_id."
		                    				  <input type='hidden' id='pago_id' value=".$fila->pago_id."></td>
		                        		<td>".$item_nombre."</td>
		                        		<td>$".$fila->monto_pagado."</td>
		                    			<td>".$deuda."</td>
		                        		<td>
											<a href='javascript: loadModal(".$fila->pago_id.")' class='btn btn-success btn-sm' title='Pagar' >
													Pagar
											</a>
		                    			</td>		
	                    			</tr>";
							}										
                $html .="		</tbody>
        					</table>
						</div>
					</div>
		            <script type='text/javascript'>
						function loadModal(id){
							jQuery.ajax({
							   	    type: 'GET',
							        url: 'ajax.php',		        
							        data: {
										'pago_id':id,
							        	'accion':2
							        },
							        success:function(response) {
							        	jQuery('.modal-body').html(response);	
		                    			$('#pagoModal').modal();
							        }
							});
						}
		            </script>";
			$data[1]=$html;
			
		}	
		else{
			$data[1]=null;
		}
		return $data;
	}
	
	/*
	 * Función con elementos de ventana modal
	 */
	public function mostrarPantallaModal($pago_id){
		$resultado = $this->mysqli->query("SELECT * FROM tipo_pago where eliminado=0");
		$resultado_pago = $this->mysqli->query("SELECT monto_total, monto_pagado FROM pago where id=".$pago_id);
		$pagos = $resultado_pago->fetch_row();
		$monto_pago_deuda = $pagos[0]-$pagos[1];
		if(isset($resultado)){
			$html ="<div class='form-group col-sm-12>
						<div class='form-group col-sm-6'>
							<label>							
									<b>El Monto Adeudado es: $".$monto_pago_deuda."</b>
							</label>				
							<input type='hidden' name='monto_pago_deuda' id='monto_pago_deuda' class='form-control' value=".$monto_pago_deuda.">
							<input type='hidden' name='pagos_id' id='pagos_id' class='form-control' value=".$pago_id.">
						</div>
					</div>				
					<div class='form-group col-sm-12>	
						<div class='form-group col-sm-6'>
							<label class='control-label'>Tipo de Pago</label>
							<select class='form-control border-input' name='tipo_pago' id='tipo_pago'>
								<option value=''>Seleccione</option>";
			while( $fila = $resultado->fetch_object() ){
				$html .="<option value='".$fila->id."'>".$fila->nombre."</option>";
			}
			$html .="</select></div></div>
					<div class='form-group col-sm-12>
						<div class='form-group col-sm-6'>
							<label class='control-label'>Valor de la Cuota</label>
							<input type='text'name='valor' class='form-control border-input' value='' id='valor'>							
						</div>
					</div>							
					<div class='form-group col-sm-12>
						<div class='form-group col-sm-6'>
								<br>
						 		<button type='submit' name='guardar_pago' id='guardar_pago' class='btn btn-success btn-sm'>Guardar</button>
								<button type='submit' name='cancelar_pago' id='cancelar_pago' class='btn btn-cancel btn-sm' data-dismiss='modal'>Cancelar</button>									
						</div>
					</div>				
				<script type='text/javascript'>
					$(document).ready(function() {
						$('#frmEnviarPago').formValidation({    	    
							message: 'This value is not valid',
							fields: {
								tipo_pago: {
									message: 'El tipo de pago no es válida',
									validators: {
										notEmpty: {
											message: 'El Tipo de Pago no puede ser vacío.'
										}
									}
								},
								valor: {
									message: 'El Valor no es válido',
									validators: {
										notEmpty: {
											message: 'El Valor no puede ser vacío.'
										},					
										regexp: {
											regexp: /^\d+(\.\d{1,2})?$/,
											message: 'Ingrese un Valor válido.'
										}
									}
								}									
							}
						});
									
									
						$('#tipo_pago').change(function(){
							var tipo_pago = jQuery('#tipo_pago').val();
	    					var pago = jQuery('#pagos_id').val();
							if(tipo_pago ==1){
								jQuery.ajax({
									type: 'GET',
									url: 'ajax.php',		        
									data: {
											'tipo_pago':tipo_pago,
											'pago_id':pago,
									       	'accion':4
									      },
									      success:function(response) {
									        $('#valor').val(response);		        		        				  
			        	  					$('#valor').prop('disabled', true);
									      }
								});		
							}
							else{
								$('#valor').val('');		        		        				  
			        	  		$('#valor').prop('disabled', false);
							}
						});
									
						$('#guardar_pago').click(function(){
							var tipo_pago = jQuery('#tipo_pago').val();
	       					var pagos_id = jQuery('#pagos_id').val();
					console.log(pagos_id);
							var monto_pago_deuda = jQuery('#monto_pago_deuda').val();
							var valor = jQuery('#valor').val();
							jQuery.ajax({
								type: 'GET',
								url: 'ajax.php',		        
								data: {
										'tipo_pago':tipo_pago,
										'valor':valor,
										'pagos_id':pagos_id,
								       	'accion':3
								      },
								      success:function(response) {
										  var cedula = jQuery('#cedula').val();
										  var lote_id = jQuery('#lote_numero').val();
										  jQuery.ajax({
										        type: 'GET',
										        url: 'ajax.php',		        
										        data: {
										        	'cedula': cedula,
										        	'lote_id':lote_id,
										        	'accion':1
										        },
										        success:function(response) {
										        	jQuery('#pagados').html('');
										        	jQuery('#pagados').html(response);		        	  
										        }
										});
										$('#pagoModal').modal('hide');
										jQuery('#mensaje').html('');
										jQuery('#mensaje').html(response);
								}
							});							
						});
					});
				";
			return $html;
		}
	}
	
	/*
	 * Función que obtiene valor para pago total
	 */
	public  function obtenerMontoTotal($pago_id){
		$resultado = $this->mysqli->query("SELECT monto_total, monto_pagado FROM pago where id=".$pago_id);
		$fila = $resultado->fetch_row();
		$monto_pago_total = $fila[0]-$fila[1];
		return $monto_pago_total;		
	}
	
	/*
	 * Función que obtiene montos a pagar
	 */
	public  function obtenerMontos($pago_id){
		$resultado = $this->mysqli->query("SELECT monto_total, monto_pagado FROM pago where id=".$pago_id);
		$fila = $resultado->fetch_row();
		return $fila;
	}
	
	/*
	 * Función que guardar transacción de pago
	 */
	public function guardarPago($pago_id, $tipo_pago, $valor){		
		try {
			$fecha_ingreso = date("Y-m-d");			
			$montos = $this->obtenerMontos($pago_id);
			$monto_total = $montos[0];
			$monto_pagado = $montos[1];
			$monto_adeudado = $monto_total - $monto_pagado;
			if($tipo_pago ==2){
				$monto = $valor+$monto_pagado;
				if($monto_adeudado == $valor){
					$estado = 1;
				}
				else{
					$estado = 2;
				}				
			}
			else{
				$monto = $valor;
				$estado = 1;
			}
			
			$consulta = "INSERT INTO transaccion(fecha_transaccion,monto_total,valor,pago_id,tipo_pago_id,eliminado)
						VALUES('".$fecha_ingreso."',".$monto_adeudado.",".$valor.",".$pago_id.",".$tipo_pago.",0)";
			$this->mysqli->query($consulta);
			
			$consulta_pago = "update pago set monto_pagado=".$monto.",estado=".$estado."  where id=".$pago_id;
			$this->mysqli->query($consulta_pago);
			$html="<div class='alert alert-success fade in alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							Se almaceno correctamente el pago
					</div>";
			return $html;
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}		
	}
	
	
	/**
	 * Función que obtiene el Listado de Lotes dada la Cédula de un cliente 
	 */
	public function listaPagosCliente($cedula){
		$acuerdos = $this->mysqli->query("SELECT distinct(a.id), numero_lote
					FROM acuerdo a
					INNER JOIN usuario u on u.id=a.usuario_id
					INNER JOIN lote l on l.id=a.lote_id
					WHERE a.estado=1 and cedula='".$cedula."'");		
		while( $fila = $acuerdos->fetch_object()){
			$resultado_pagos = $this->mysqli->query("SELECT distinct(p.id) as pago_id , p.estado, tp.nombre as estado_nombre,id_item,t.monto_total, t.valor,
					   date_format(t.fecha_transaccion, '%Y-%m-%d') as fecha_pago
					   FROM pago p
					   INNER JOIN transaccion t on p.id=t.pago_id
					   INNER JOIN tipo_pago tp on tp.id=tipo_pago_id
	                   where p.acuerdo_id=".$fila->id);
			$fila->pagados = $resultado_pagos;
			$resultado_sinpagos = $this->mysqli->query("SELECT p.id as pago_id , p.estado, id_item, monto_pagado, monto_total
													FROM pago p
													WHERE estado <>1 and p.acuerdo_id=".$fila->id);
			$fila->sinpagados = $resultado_sinpagos;
			$data[] = $fila;
		}
		return $data;
	}
}
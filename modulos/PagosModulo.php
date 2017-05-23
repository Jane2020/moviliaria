<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
require_once 'Conexion.php';
require_once 'lib/dompdf/autoload.inc.php';
require_once 'lib/dompdf/src/FontMetrics.php';

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
		$resultado_pagos = $this->mysqli->query("SELECT t.id,p.id as pago_id , p.estado, tp.nombre as estado_nombre,p.id_item,t.monto_total, t.valor,
												date_format(t.fecha_transaccion, '%Y-%m-%d') as fecha_pago,p.estado as estado_pago, id_obra_multa
												FROM pago p
												INNER JOIN transaccion t on p.id=t.pago_id
				 								INNER JOIN tipo_pago tp on tp.id=tipo_pago_id
												WHERE p.acuerdo_id =".$acuerdo_id. " order by t.id");
		$resultado_sinpagos = $this->mysqli->query("SELECT p.id as pago_id , p.estado, p.id_item, monto_pagado, monto_total,id_obra_multa
												FROM pago p
												WHERE estado <>1 and p.acuerdo_id=".$acuerdo_id);		
		if(isset($resultado_pagos)){
			$html ="<div class='card'>
    					<div class='header'>
        					<h4 class='title'>Pagos Realizados</h4>                              
        				</div>
						<div class='icon-container'>
							<span class='ti-download'></span><span class='icon-name'>
								<a href='accion.php?ced=".$cedula;
					$html .="' target='_blank'>Descargar</a></span>
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
					if(isset($fila->id_obra_multa)){
						$consulta_multa ="SELECT m.nombre FROM multa m
	   									  INNER JOIN lote_multa lm ON m.id=lm.multa_id
										  WHERE lm.id = ".$fila->id_obra_multa;
						$resultado_multa = $this->mysqli->query($consulta_multa);
						$item_nombre = $resultado_multa->fetch_row()[0];
					}
				}
				else{
					if(isset($fila->id_obra_multa)){
						$consulta_obra ="SELECT oi.nombre
									 FROM lote_infraestructura li
									 INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
									 WHERE li.id=".$fila->id_obra_multa;
						$resultado_obra = $this->mysqli->query($consulta_obra);
						$item_nombre = $resultado_obra->fetch_row()[0];
					}
				}
				if($fila->estado_pago == 1){
					$estado_pago = "Pago Completo";
				}else{
					$estado_pago = "Pago Incompleto";
				}
			$html .="				<tr>
		                    			<td>".$fila->pago_id."</td>
		                        		<td>".$item_nombre."</td>
		                        		<td>$".$fila->monto_total."</td>
		                        		<td>$".$fila->valor."</td>
		                        		<td>".$fila->fecha_pago."</td>
		                        		<td>".$fila->estado_nombre."</td>
		                        		<td>".$estado_pago."</td>		                        		
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
					if(isset($fila->id_obra_multa)){
						$consulta_multa ="SELECT m.nombre FROM multa m
	   									  INNER JOIN lote_multa lm ON m.id=lm.multa_id
										  WHERE lm.id = ".$fila->id_obra_multa;
						$resultado_multa = $this->mysqli->query($consulta_multa);
						$item_nombre = $resultado_multa->fetch_row()[0];
					}
				}
				else{
					if(isset($fila->id_obra_multa)){
						$consulta_obra ="SELECT oi.nombre
										 FROM lote_infraestructura li
										 INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
										 WHERE li.id=".$fila->id_obra_multa;
						$resultado_obra = $this->mysqli->query($consulta_obra);
						$item_nombre = $resultado_obra->fetch_row()[0];
					}
				}
				$deuda = $fila->monto_total - $fila->monto_pagado;
				$html .="				<tr>
		                    			<td>".$fila->pago_id."
		                    				  <input type='hidden' id='pago_id' value=".$fila->pago_id."></td>
		                        		<td>".$item_nombre."</td>
		                        		<td>$".$fila->monto_pagado."</td>
		                    			<td>$".$deuda."</td>
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
					<form id='frmEnviarPago' name='' action='' method='post' >
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
					</form>
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
										},
										between: {
				                            min: 0,
				                            max: ".$monto_pago_deuda.",
				                            message: 'El valor no puede ser mayor que el valor del pago'
				                        }
									}
								}									
							}
						}).on('success.form.fv', function(e) {
				            // Prevent form submission
				            e.preventDefault();				
				         		                            		
				            var tipo_pago = jQuery('#tipo_pago').val();
	       					var pagos_id = jQuery('#pagos_id').val();
					
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
			
			$monto = $valor+$monto_pagado;
			
			if($tipo_pago ==2){
				
				if($monto_adeudado == $valor){
					$estado = 1;
				}
				else{
					$estado = 2;
				}				
			}
			else{
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
		$acuerdos = $this->mysqli->query("SELECT distinct(a.id), numero_lote, lt.nombre as lotizacion, m.nombre as manzana
					FROM acuerdo a
					INNER JOIN usuario u on u.id=a.usuario_id
					INNER JOIN lote l on l.id=a.lote_id
					inner join manzana as m on l.manzana_id = m.id
					inner join lotizacion as lt on lt.id = m.lotizacion_id
					WHERE a.estado=1 and cedula='".$cedula."'");	
	
		
		while( $fila = $acuerdos->fetch_object()){
			$resultado_pagos = $this->mysqli->query("SELECT distinct(p.id) as pago_id , p.estado, tp.nombre as estado_nombre,id_item,t.monto_total, t.valor,id_obra_multa,
					   date_format(t.fecha_transaccion, '%Y-%m-%d') as fecha_pago
					   FROM pago p
					   INNER JOIN transaccion t on p.id=t.pago_id
					   INNER JOIN tipo_pago tp on tp.id=tipo_pago_id
	                   where p.acuerdo_id=".$fila->id);
			$fila->pagados = $resultado_pagos;
			$resultado_sinpagos = $this->mysqli->query("SELECT p.id as pago_id , p.estado, id_item, monto_pagado, monto_total,id_obra_multa
													FROM pago p
													WHERE estado <>1 and p.acuerdo_id=".$fila->id);
			$fila->sinpagados = $resultado_sinpagos;
			$data[] = $fila;
		}
		if(isset($data)){
			return $data;
		}
	}
	
	/**
	 * Función que obtiene el Listado de Lotes dada la Cédula de un cliente
	 */
	public function listaPagosClientePdf($cedula){
		$consulta ="SELECT nombres, apellidos,celular,telefono FROM usuario WHERE cedula='".$cedula."'";
		$resultado = $this->mysqli->query($consulta);
		$items= $resultado->fetch_row();
		
		$acuerdos = $this->listaPagosCliente($cedula);
		$html = "<html>
					<head>
						<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'/>
						<style>
						body {
						margin: 20px 20px 20px 50px;
						}
						table{
						border-collapse: collapse; width: 100%;
						}
						
						td{
						border:1px solid #ccc; padding:1px;
						font-size:9pt;
						}
						</style>
					</head>
				<body>
					<table width= 100% border=0>
						<tr>
							<td width= 10% align='center'>
								<img src='".PATH_FILES."/images/logo.jpg' style='height: 80px; margin-bottom: 5px;'>
							</td>
							<td>
								<h3 class='title' align='center'>COMPAÑÍA NUEVO AMANECER DONOVILSA S.A</h3>
							</td>
						</tr> 
					</table>
					<table class='table table-striped'>
						<tr><td colspan=4 align=center><b>DATOS DEL CLIENTE</b></td></tr>
						<tr>
							<td width=20%><b>Cédula:</b></td><td colspan=3>".$cedula."</td>						
						</tr>
						<tr>
							<td width=20%><b>Nombre:</b></td><td colspan=3>".$items[0]." ".$items[1]."</td>
						</tr>
						<tr>
							<td width=20%><b>Teléfono:</b></td><td width=25%>".$items[2]."</td>
							<td width=20%><b>Celular:</b></td><td>".$items[3]."</td>
						</tr>
					</table><br>
					
			<div class='gallery-section'>
				<div class='container'>				
					<div style='overflow: auto;'>";
				if(count($acuerdos) >0 ){
					foreach ($acuerdos as $row){
		$html .="<div class='form-group col-sm-12'>
					<div class='header'>							
						<h5>Pagos Realizados</h5>				
					</div>
					<table class='table table-striped'>
						<tr>
							<td>
								<b>Lotizacion</b> :".$row->lotizacion."
							</td>
						</tr>
						<tr>
							<td>
								<b>Manzana: </b> ".$row->manzana." - <b>Lote: </b>".$row->numero_lote."
							</td>
						</tr>											
					</table>							 	
				</div>
				<br>
				<div class='form-group col-sm-12'>					
					<div class='card'>
    					<div class='content table-responsive table-full-width'>
        					<table class='table table-striped'>
            					<thead>
                					<tr>
				                		<td><b>ID</b></td>
					                    <td><b>Nombre del Pago</b></td>
					        			<td><b>Monto Total</b></td>
				    	                <td><b>Monto Pagado</b></td>
				        	            <td><b>Fecha de Pago</b></td> 
										<td><b>Estado</b></td>
                   					</tr>
                				</thead>
                				<tbody>";
										$item_nombre = null;
										while( $fila = $row->pagados->fetch_object() ){											
											if($fila->id_item == 1){
												$item_nombre = "Acuerdo";
											}else if($fila->id_item == 3){
												if(isset($fila->id_obra_multa)){
													$consulta_multa ="SELECT m.nombre FROM multa m
								   									  INNER JOIN lote_multa lm ON m.id=lm.multa_id
																	  WHERE lm.id = ".$fila->id_obra_multa;
													$resultado_multa = $this->mysqli->query($consulta_multa);
													$item_nombre = $resultado_multa->fetch_row()[0];
												}
											}
											else{
												if(isset($fila->id_obra_multa)){
													$consulta_obra ="SELECT oi.nombre
																	 FROM lote_infraestructura li
																	 INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
																	 WHERE li.id=".$fila->id_obra_multa;
													$resultado_obra = $this->mysqli->query($consulta_obra);
													$item_nombre = $resultado_obra->fetch_row()[0];
												}
											}
				$html .="			<tr>
		                    			<td>".$fila->pago_id."</td>
		                    			<td>".$item_nombre."</td>
		                    			<td>".$fila->monto_total."</td>
		                    			<td>".$fila->valor."</td>
		                        		<td>".$fila->fecha_pago."</td>
		                        		<td>".$fila->estado_nombre."</td>
	                    			</tr>";
                					} 
								
				$html .="		</tbody>
        					</table>
						</div>
				</div>";
				if($row->sinpagados->num_rows > 0){
				$html .="<div class='card'>
    					<div class='header'>
        					<h5 class='title'>Cuentas por Pagar</h5>
        				</div>
        				<div class='content table-responsive table-full-width'>
        					<table class='table table-striped'>
            					<thead>
                					<tr>
				                		<td><b>ID</b></td>
					                    <td><b>Nombre del Pago</b></td>
				    	                <td><b>Monto Pagado</b></th>
				        	            <td><b>Monto por Pagar</b></td>
                   					</tr>
                				</thead>
                				<tbody>";
										while( $fila = $row->sinpagados->fetch_object() ){
										if($fila->id_item == 1){
											$item_nombre = "Acuerdo";
										}else if($fila->id_item == 3){
											if(isset($fila->id_obra_multa)){
												$consulta_multa ="SELECT m.nombre FROM multa m
	   									 						  INNER JOIN lote_multa lm ON m.id=lm.multa_id
										  						  WHERE lm.id = ".$fila->id_obra_multa;
												$resultado_multa = $this->mysqli->query($consulta_multa);
												$item_nombre = $resultado_multa->fetch_row()[0];
											}
										}
										else{
											if(isset($fila->id_obra_multa)){
												$consulta_obra ="SELECT oi.nombre
																 FROM lote_infraestructura li
																 INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
																 WHERE li.id=".$fila->id_obra_multa;
												$resultado_obra = $this->mysqli->query($consulta_obra);
												$item_nombre = $resultado_obra->fetch_row()[0];
											}
										}
										$deuda = $fila->monto_total - $fila->monto_pagado;
									
						$html .="	<tr>
										<td>".$fila->pago_id."</td>
										<td>".$item_nombre."</td>
			                       		<td>".$fila->monto_pagado."</td>
			                       		<td>".$deuda."</td>			                       		
			                		</tr>";
									}
						$html .="</tbody>
        					</table>
						</div>
					</div><br>";        		
					}
					}
		$html .="</div>";	
			} else {
				echo "<h3>No existe informaci&oacute;n relacionada!</h3>";
			}
		$html .="</div>		
				</div></div></body></html>";
		
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->load_html($html);
		
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		// $font = FontMetrics::getFont("helvetica", "bold");
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", $font, 6, array(0,0,0)); //footer
		$dompdf->stream('general', array("Attachment"=>false));
	}
}
<?php
$title = 'Pagos';

require_once ("../modulos/Conexion.php");
require_once ("../modulos/PagosModulo.php");
require_once ("../template/headerPublic.php"); 

$conexion  = new Conexion();
$mysqli = $conexion->conectar();

$pagos = new Pagos();
$acuerdos= $pagos->listaPagosCliente($_SESSION['SESSION_USER']->cedula);
?>
<div class="banner-section">
			<div class="container">
				<h2>Mis Pagos</h2>
			</div>
</div>	


<div class="content">
			<div class="gallery-section">
				<div class="container">
		
		<div style="overflow: auto;">
			<?php
				if(count($acuerdos) >0 ){
?>
<div class="icon-container">
<span class="ti-download"></span><span class="glyphicon glyphicon-download-alt">
<a href="../vistas/pagos/accion.php?ced=<?php echo $_SESSION['SESSION_USER']->cedula; ?>" target="_blank">Descargar</a>
</span>
</div>
<br>
<?php 
				foreach ($acuerdos as $row):?>
			<div class="form-group col-sm-12">
				
					<div class='header'>
					<h3>Lote <?php echo $row->numero_lote;?></h3><br>
						<h5>Pagos Realizados </h5>
					</div>			
			</div>
			<div class="form-group col-sm-12">					
				<div class='card'>
    					<div class='content table-responsive table-full-width'>
        					<table class='table table-striped'>
            					<thead>
                					<tr>
				                		<th>ID</th>
					                    <th>Nombre del Pago</th>
					        			<th>Monto Total</th>
				    	                <th>Monto Pagado</th>
				        	            <th>Fecha de Pago</th> 
										<th>Estado</th>
                   					</tr>
                				</thead>
                				<tbody>
									<?php
										$item_nombre = null;
										while( $fila = $row->pagados->fetch_object() ){											
											if($fila->id_item == 1){
												$item_nombre = "Acuerdo";
											}else if($fila->id_item == 3){
												$consulta_multa ="SELECT m.nombre FROM multa m
							   									  INNER JOIN lote_multa lm ON m.id=lm.multa_id
																  WHERE lm.id = ".$fila->id_obra_multa;
												$resultado_multa = $mysqli->query($consulta_multa);
												$item_nombre = $resultado_multa->fetch_row()[0];
											}
											else{
												if(isset($fila->id_obra_multa)){
													$consulta_obra ="SELECT oi.nombre
																	 FROM lote_infraestructura li
																	 INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
																	 WHERE li.id=".$fila->id_obra_multa;
													$resultado_obra = $mysqli->query($consulta_obra);
													$item_nombre = $resultado_obra->fetch_row()[0];
												}
											}
										?>											
									<tr>
		                    			<td><?php echo $fila->pago_id; ?></td>
		                    			<td><?php echo $item_nombre; ?></td>
		                    			<td><?php echo $fila->monto_total; ?></td>
		                    			<td><?php echo $fila->valor; ?></td>
		                        		<td><?php echo $fila->fecha_pago; ?></td>
		                        		<td><?php echo $fila->estado_nombre; ?></td>
	                    			</tr>
                				<?php } 
								?>
							</tbody>
        					</table>
						</div>
					</div>
				
				<?php if($row->sinpagados->num_rows > 0):?>
				<div class='card'>
    					<div class='header'>
        					<h5 class='title'>Cuentas por Pagar</h5>
        				</div>
        				<div class='content table-responsive table-full-width'>
        					<table class='table table-striped'>
            					<thead>
                					<tr>
				                		<th>ID</th>
					                    <th>Nombre del Pago</th>
				    	                <th>Monto Pagado</th>
				        	            <th>Monto por Pagar</th>
                   					</tr>
                				</thead>
                				<tbody>
									<?php while( $fila = $row->sinpagados->fetch_object() ){
										if($fila->id_item == 1){
											$item_nombre = "Acuerdo";
										}else if($fila->id_item == 3){
											$consulta_multa ="SELECT m.nombre FROM multa m
   									 						  INNER JOIN lote_multa lm ON m.id=lm.multa_id
									  						  WHERE lm.id = ".$fila->id_obra_multa;
											$resultado_multa = $mysqli->query($consulta_multa);
											$item_nombre = $resultado_multa->fetch_row()[0];
										}
										else{
											$consulta_obra ="SELECT oi.nombre
															 FROM lote_infraestructura li
															 INNER JOIN obras_infraestructura oi ON oi.id=li.infraestructura_id
															 WHERE li.id=".$fila->id_obra_multa;
											$resultado_obra = $mysqli->query($consulta_obra);
											$item_nombre = $resultado_obra->fetch_row()[0];
										}
										$deuda = $fila->monto_total - $fila->monto_pagado;
									?>
									<tr>
										<td><?php echo $fila->pago_id; ?></td>
										<td><?php echo $item_nombre; ?></td>
			                       		<td><?php echo $fila->monto_pagado; ?></td>
			                       		<td><?php echo $deuda; ?></td>			                       		
			                		</tr>
			                		<?php }?>
								</tbody>
        					</table>
						</div>
					</div>		        		
				<?php endif;?>
				</div>	
			<?php 
			endforeach;
				} else {
				echo "<h3>No existe informaci&oacute;n relacionada!</h3>";
			}?>
		</div>		
	</div>
	</div>
</div>
<?php
$title = 'Pagos';
require_once ("../modulos/PagosModulo.php");
require_once ("../template/headerPublic.php"); 

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
				foreach ($acuerdos as $row){?>
			<div class="form-group col-sm-12">
				
					<div class='header'>
						<h3>Pagos Realizados Lote: <?php echo $row->numero_lote;?></h3>
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
												$item_nombre = "Multa";
											}
											else{
												$item_nombre = "Obra de Infraestructura";
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
								}?>
							</tbody>
        					</table>
						</div>
				</div>
				<?php if($row->sinpagados->num_rows > 0):?>
				<div class='card'>
    					<div class='header'>
        					<h3 class='title'>Cuentas por Pagar Lote  <?php echo $row->numero_lote;?></h3>
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
											$item_nombre = "Multa";
										}
										else{
											$item_nombre = "Obra de Infraestructura";
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
			<?php } ?>
		</div>		
	</div>
	</div>
</div>
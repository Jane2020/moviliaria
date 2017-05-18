<?php
$title = 'Reportes';
require_once ("../../modulos/ReportesModulo.php");
require_once ("../../template/header.php");
?>
<div class="card">
<div class="header">
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
	</div>
<?php endif;?>
<div class="icon-container">
	<span class="ti-download"></span><span class="icon-name">
		<a href="accion.php?id=2" target="_blank">Descargar</a>		
	</span>
</div>
<br>
<div class='header'>
	<h5 class='title' align='center'>REPORTE DE PRESUPUESTO DE OBRAS DE INFRAESTRUCTURA</h5>	
</div>

<?php
          $reportes = new Reportes();
          $listaObras = $reportes->listarObrasPagadas();
          if(count($listaObras) > 0){
                        
?>

<table class="display table table-bordered table-stripe" cellspacing="0" width="100%">

<?php  


		foreach ($listaObras as $fila){   
			
			if(array_key_exists ( 'lotizacion' , $fila )):
			
			?>
			<tr>
			 	<td colspan="7" align="center">
			  			<b>URBANIZACIÓN <?php echo strtoupper($fila["lotizacion"]); ?></b>
			  	</td>
			 </tr>
			
	<?php		
			endif;
			if(array_key_exists ( 'manzana' , $fila )):
		
			?>
						 <tr>
				            <td colspan="7" align="center" style='background-color:yellow'>MAnzana<b><?php echo strtoupper($fila["manzana"]); ?></b></td>
				        </tr> 
						
				<?php		
		endif;
		
		if(array_key_exists ( 'obras' , $fila )):
		$obras = $fila["obras"];
		?>
			<tr>
			<td>LOTE</td>
			<?php
              foreach ($fila["obras"] as $val){               	
     		?> 
				<td><?php echo $val->nombre ?></td>
     	    <?php
      	      }        
      	      ?>
      	      				</tr>
      	      		<?php 
				endif;
				
				
				if(array_key_exists ( 'lote' , $fila )):
		
		?>
			<tr>
			<td><?php echo $fila["lote"][0]?></td>
			<?php
              foreach ($obras as $val){               	
     		?> 
				<td><?php echo isset($fila["lote"][$val->nombre])?$fila["lote"][$val->nombre]:0; ?></td>
     	    <?php
      	      }        
      	      ?>
      	      				</tr>
      	      		<?php 
				endif;
		}
				?>

	
</table>      	
<?php
 	
 }
require_once ("../../template/footer.php");
?>
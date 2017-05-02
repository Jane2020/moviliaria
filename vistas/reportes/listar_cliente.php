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
	<h5 class='title' align='center'>Información de Clientes</h5>	
</div>
<table class="display table table-stripe" cellspacing="0" width="100%">
	<tbody>
     <?php
          $reportes = new Reportes();
          $listaClientes = $reportes->listarLotesByCliente();
          $contador = 0;
          if(count($listaClientes) > 0){
               foreach ($listaClientes as $lote){    
     ?>
     	<?php if ($contador == 0){?><tr><?php } ?>
            <td colspan="7" align="center">
            	<table border=1>
            		<tr><td colspan="2" align="center" style='background-color:#FF00FF'><b>DATOS DEL CLIENTE N°<?php echo $lote->id ?></b></td></tr>
            		<tr><td>NOMBRES</td><td><?php echo $lote->nombres ?></tr>
		            <tr><td>APELLIDOS</td> <td><?php echo $lote->apellidos ?></td></tr>
		            <tr><td>CÉDULA</td><td><?php echo $lote->cedula?></td></tr>
		            <tr><td>TELÉFONO</td><td><?php echo $lote->telefono ?></tr>
		            <tr><td>CELULAR</td><td><?php echo $lote->celular ?></tr>
		            <tr><td>DIRECCIÓN</td><td><?php echo $lote->direccion ?></tr>            
		            <tr><td>CORREO ELECTRÓNICO</td><td><?php echo $lote->email ?></tr>
		            <tr><td colspan="2" align="center" style='background-color:#FF00FF'><b>DATOS DEL TERRENO</b></td></tr>
		            <tr><td>URBANIZACIÓN</td><td><?php echo $lote->urbanizacion ?></tr>
		            <tr><td>NÚMERO DE LOTE</td><td><?php echo $lote->numero_lote ?></tr>
					<?php
               			foreach ($lote->obras as $obra){               				
     				?>            
     				<tr><td><?php echo strtoupper($obra->nombre) ?></td><td><?php echo $obra->valor ?></tr>
     				<?php        
        				}
      				?>
            	</table>
            </td>            
        <?php if ($contador == 1){?></tr>        
        <?php }else
	        {
	        	$contador = 0;
	        }
        	$contador++;
            }
        }
      ?>
     </tbody>
</table>	
 </div>    
 </div>
<?php
require_once ("../../template/footer.php");
?>
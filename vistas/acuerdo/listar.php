<?php
$title = 'Acuerdo';
require_once ("../../modulos/AcuerdoModulo.php");
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
</p>
<p>
   <a href="editar.php" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" title="Nuevo"></span></a><br/>
</p>
<table id="dataTables-example" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
          <tr>
               <th>ID</th>
               <th>Nombre del Cliente</th>
               <th>Número del Lote</th>                             
               <th>Código de Promesa</th>
               <th>Fecha de Ingreso</th>               
               <th style="width: 15%">Acci&oacute;n</th>
          </tr>
     </thead>
     <tbody>
     <?php
          $acuerdo = new Acuerdo();
          $listaAcuerdo = $acuerdo->listarAcuerdos();
          if(count($listaAcuerdo) > 0){
               foreach ($listaAcuerdo as $row){
     ?>
     	<tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->nombre_cliente ?></td>   
            <td><?php echo $row->numero_lote?></td>
            <td><?php echo $row->cod_promesa ?></td>
            <td><?php echo $row->fecha_ingreso ?></td>
            <td style="text-align: center;">
                <a title="Editar" href="editar.php?id=<?php echo $row->id ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>              
            </td>
          </tr>
      <?php
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
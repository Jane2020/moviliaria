<?php
$title = 'Multas';
require("../../modulos/MultaModulo.php");
require_once ("../../template/header.php");
?>
<header class="page-header">
					<h1 class="page-title"><?php echo $title; ?></h1>
</header>
<p>
   <a href="editar.php" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true" title="Nuevo"></span></a><br/>
</p>
<table id="ghatable" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
          <tr>
               <th>ID</th>
               <th>Nombre</th>
               <th>Descripción</th>
               <th>Valor</th>
               <th colspan="2">Acción</th>               
          </tr>
     </thead>
     <tbody>
     <?php
          $multa = new Multa();
          $listaMulta = $multa->listarMultas();
          if(count($listaMulta) > 0){
               foreach ($listaMulta as $row){
     ?>
     	<tr>
            <td><?php echo $row->id ?></td>
            <td><?php echo $row->nombre ?></td>
            <td><?php echo $row->descripcion ?></td>
            <td><?php echo $row->valor ?></td>
            <td style="text-align: center;">
                <a title="Editar" href="editar.php?id=<?php echo $row->id ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> </a>
                <a title="Eliminar" class="btn btn-danger btn-sm" onclick="return confirm('Desea eliminar el registro')" href="accion.php?id=<?php echo $row->id ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </td>
          </tr>
      <?php
               }
          }
      ?>
     </tbody>
</table>	    
<?php
include "../../template/footer.php";
?>
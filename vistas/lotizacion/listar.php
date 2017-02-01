<?php
require("../../modulos/LotizacionModulo.php");
include "../../template/header.php";
?>
<p>
   <a href="editar.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Lotización</a><br/>
</p>
<table id="ghatable" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
	<thead>
          <tr>
               <th>ID</th>
               <th>NOMBRE</th>
               <th>CIUDAD</th>
               <th>SECTOR</th>
               <th>REFERENCIA</th>
               <th>MODIFICAR</th>
               <th>ELIMINAR</th>
          </tr>
     </thead>
     <tbody>
     <?php
          $lotizacion = new Lotizacion();
          $listaLotizacion = $lotizacion->listarLotizacion();
          if(count($listaLotizacion) > 0){
               foreach ($listaLotizacion as $row){
     ?>
     	<tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['ciudad'] ?></td>
            <td><?php echo $row['sector'] ?></td>
            <td><?php echo $row['referencia'] ?></td>
            <td>
                <a href="editar.php?id=<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>
            </td>
            <td>
                <a onclick="return confirm('Desea eliminar el registro')" href="delete.php?d=<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
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
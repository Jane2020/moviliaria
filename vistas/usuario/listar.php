<?php
require("../../modulos/UsuarioModulo.php");
include "../../../template/header.php";
?>
<p>
   <a href="editar.php" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Personal</a><br/>
</p>
<table id="ghatable" class="display table table-bordered table-stripe" cellspacing="0" width="100%">
     <thead>
          <tr>
               <th>ID</th>
               <th>NOMBRE</th>
               <th>SEXO</th>
               <th>TELEFONO</th>
               <th>DIRECCION</th>
               <th>CORREO</th>
               <th>PAIS</th>
               <th>CARGO</th>
               <th>MODIFICAR</th>
               <th>ELIMINAR</th>
          </tr>
     </thead>
     <tbody>
          <?php
          $objpersonal = new Personal();
          $personal = $objpersonal->personal();
          if(sizeof($personal) > 0){
               foreach ($personal as $row){
                    ?>
                    <tr>
                         <td><?php echo $row['id'] ?></td>
                         <td><?php echo $row['nombre'] ?></td>
                         <td><?php echo $row['sexo'] ?></td>
                         <td><?php echo $row['telefono'] ?></td>
                         <td><?php echo $row['direccion'] ?></td>
                         <td><?php echo $row['correo'] ?></td>
                         <td><?php echo $row['pais'] ?></td>
                         <td><?php echo $row['cargo'] ?></td>
                         <td>
                              <a href="update.php?u=<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>
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
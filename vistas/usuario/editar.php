<?php
require_once ("../../modulos/UsuarioModulo.php");
$usuario = new Usuario();
$tipos = $usuario->listarTipos();
$item= $usuario->editarUsuario();

$title = (($item->id>0)?'Editar ':'Nuevo ').'Usuario';
require_once ("../../template/header.php");

if (isset($_POST['guardar'])){
	$usuario->guardarUsuario();	
}
?>
 <div class="card">
 <div class="content">
<form id="frmUsuario" method="post" action="">
<div style="overflow: auto;">
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6" >
			<label class="control-label">Identificación</label>
		<input type='text' name='cedula' class='form-control border-input'
			value="<?php echo $item->cedula; ?>" id="cedula">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Nombres</label> <input type='text'
			name='nombres' class='form-control border-input' 
			value="<?php echo $item->nombres; ?>" id="nombres">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Apellidos</label> <input type='text'
			name='apellidos' class='form-control border-input' 
			value="<?php echo $item->apellidos; ?>" id="apellidos">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Email</label> <input type='text'
			name='email' class='form-control border-input'
			value="<?php echo $item->email; ?>" id="email">
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Teléfono</label> <input type='text'
			name='telefono' class='form-control border-input'
			value="<?php echo $item->telefono; ?>" id="telefono">	
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Celular</label> <input type='text'
			name='celular' class='form-control border-input'
			value="<?php echo $item->celular; ?>" id="celular">	
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Dirección</label> <input type='text'
			name='direccion' class='form-control border-input' 
			value="<?php echo $item->direccion; ?>" id="direccion">
		</div>
	</div>
	<div class="form-group col-sm-12">	
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Tipo Usuario</label> 
			<select class='form-control border-input' name="tipo" id="tipo">
				<option value="" >Seleccione</option>
				<?php foreach ($tipos as $dato) { ?>
					<option value="<?php echo $dato->id;?>"  <?php if($item->tipo_usuario_id==$dato->id):echo "selected"; endif;?>><?php echo $dato->nombre;?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group col-sm-6 row6">
			<label class="control-label">Contrase&ntilde;a</label> <input type='password'
			name='password' class='form-control border-input'
			value="<?php echo $item->password; ?>" id="password">	
		</div>
	</div>
	<div class="form-group">
		<div class="form-group col-sm-6">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">		
			<input type='hidden' name='guardar' value="1">
			<button type="submit" name="boton" class="btn btn-success btn-sm">Guardar</button>		
			<a href="listar.php" class="btn btn-info btn-sm">Cancelar</a>
		</div>
	</div>
</div>
</form>
</div>
</div>
<?php
require_once ("../../template/footer.php");
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#frmUsuario').formValidation({    	    
			message: 'This value is not valid',

			fields: {
				cedula: {
					message: 'La Cédula no es válida',
					validators: {
								notEmpty: {
									message: 'El Número de Cédula no puede ser vacío.'
								},					
								regexp: {
									regexp: /^(?:\+)?\d{10}$/,
									message: 'Ingrese un Número de Cédula válido.'
								},
					
								callback: {
						                message: 'El Número de Cédula no es válido.',
	                         				callback: function (value, validator, $field) {
									    var cedula = value;
									    try {
									        array = cedula.split("");
									    }
									    catch (e) {
									        //array = null;
									    }
									    num = array.length;
									    if (num === 10) {
									        total = 0;
									        digito = (array[9] * 1);
									        for (i = 0; i < (num - 1); i++) {
									            mult = 0;
									            if ((i % 2) !== 0) {
									                total = total + (array[i] * 1);
									            } else {
									                mult = array[i] * 2;
									                if (mult > 9)
									                    total = total + (mult - 9);
									                else
									                    total = total + mult;
									            }
									        }
									        decena = total / 10;
									        decena = Math.floor(decena);
									        decena = (decena + 1) * 10;
									        final = (decena - total);
									        if ((final === 10 && digito === 0) || (final === digito)) {
									
									            return true;
									        } else {
									
									            return false;
									        }
									    } else {
									
									        return false;
									    }
									}
									}
							}
						},
				nombres: {
					message: 'El nombre no es válido',
					validators: {
						notEmpty: {
							message: 'El Nombre no puede ser vacío.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/,
							message: 'Ingrese un Nombre válido.'
						}
					}
				},
				apellidos: {
					message: 'El apellido no es válido',
					validators: {
						notEmpty: {
							message: 'El Apellido no puede ser vacío.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/,
							message: 'Ingrese un Apellido válido.'
						}
					}
				},
				password: {
					message: 'La Contraseña no es válida',
					validators: {
						notEmpty: {
							message: 'La Contraseña no puede ser vacía.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\.\,\_\-]+$/,						
							message: 'Ingrese una Contraseña válido.'
						}
					}
				},
				celular: {
					message: 'El Celular de Teléfono no es válido',
					validators: {
								notEmpty: {
									message: 'El Número de Celular no puede ser vacío.'
								},					
								regexp: {
									regexp: /^(?:\+)?\d{10}$/,
									message: 'Ingrese un Número de Celular válido.'
								}
							}
					
				},	
				telefono: {
					message: 'El Teléfono no es válido',
					validators: {
								notEmpty: {
									message: 'El Número de Teléfono no puede ser vacío.'
								},					
								regexp: {
									regexp: /^(?:\+)?\d{10}$/,
									message: 'Ingrese un Número de Teléfono válido.'
								}
							}
					
				},
				direccion: {
					message: 'La dirección no es válida',
					validators: {
						notEmpty: {
							message: 'La Dirección no puede ser vacía.'
						},					
						regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\.\,\_\-\s]+$/,
							message: 'Ingrese una Dirección válido.'
						}
					}
				},
				email: {
					message: 'El email no es válida',
					validators: {
						notEmpty: {
							message: 'El Email no puede ser vacío.'
						},	
						regexp: {
							regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
							message: 'Ingrese un email válido.'
						}
					}
				},
				
				tipo: {
					message: 'El tipo de Usuario no es válida',
					validators: {
						notEmpty: {
							message: 'Escoja un Tipo de Usuario.'
						}
					}
				}							
			}
		});
    });
</script>
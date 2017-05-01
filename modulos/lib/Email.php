<?php



class Email{
	/*
	public function sendMail($email_to,$email_subject, $message){
		$email_from = EMAIL;		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
		$headers .= 'From: SISTEMA SAM-W&L<'.$email_from.">\r\n".
				'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $message, $headers);
	}
	*/
	public function sendMail($email_to,$email_subject, $message){
	
		require_once 'PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = GUSER;
		$mail->Password = GPWD;
		
		$mail->IsHTML(true);
		$mail->SetFrom(GUSER, 'SISTEMA SAM-W&L');
		$mail->Subject = $email_subject;
		$mail->Body = $message;
		$mail->AddAddress($email_to);
		$mail->CharSet = 'UTF-8';
		if(!$mail->Send()) {
		
			return false;
		} else {
			
			return true;
		}
	}
	
	
	public function sendNotificacionRegistro($name,$email, $activo,$url){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td><br> Se ha registrado un nuevo mantenimiento correctivo en el Activo F&iacute;sico '.$activo.'. Para ingresar al sistema de click en el siguiente <a target="_blank" href="'.$url.'">link</a>
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Notificación de Matenimiento correctivo", $message);
	}
	
	public function sendNotificacionArreglo($name,$email, $activo,$url,$tipo = 'Correctivo'){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td><br> Se ha registrado una atenci&oacute;n de un Mantenimiento '.$tipo.' en el Activo F&iacute;sico '.$activo.'. Para ingresar al sistema de click en el siguiente <a target="_blank" href="'.$url.'">link</a>
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Notificación de Atención de Matenimiento correctivo", $message);
	}
	
	public function sendNotificacionTecnico($name,$email, $activo, $url){		
		
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td><br> Le informámos que se ha registrado un mantenimiento correctivo del Activo F&iacute;sico '.$activo.'. Para poder dar atenci&oacute;n por favor ingrese al sistema con sus credenciales en el siguiente <a target="_blank" href="'.$url.'">link</a>.
					      		
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Notificación de Mantenimiento Correctivo", $message);
	}
	
	public function sendNotificacionOrden($name,$email, $plan, $activo, $url){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td><br> Le informámos que se ha registrado una orden de trabajo para el Activo F&iacute;sico '.$activo.'asociado. Para poder dar atenci&oacute;n por favor ingrese al sistema con sus credenciales en el siguiente <a target="_blank" href="'.$url.'">link</a>.
					  
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Notificación de Orden de Trabajo", $message);
	}
	
	public function sendNotificacionOrdenAlerta($name,$email, $plan, $activo){
		$message = '<table>
					    <tr>
					      <td>Estimado '.$name.',</td>
					    </tr>
					    <tr>
					      <td><br> Le informámos que se ha registrado una alerta de mantenimiento para el Activo F&iacute;sico '.$activo.' asociado con el Plan de Mantenimiento '.$plan.'. Por favor estar atento a la orden de trabajo. 
				
					      	<br><br>
					      	La Administraci&oacute;n.
					      </td>
					    </tr>
					  </table>';
		$this->sendMail($email, "Alerta Notificación de Orden de Trabajo", $message);
	}
	
}

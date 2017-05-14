<?php require_once ("../template/headerPublic.php"); ?>

<?php 

if(isset($_POST['nombre'])){

	$name=$_POST['nombre'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$message=$_POST['message'];
	$message .= " Telefono: ". $phone;
	$from="From: $name<$email>\r\nReturn-path: $email";
	$subject="Formulario de Contactos Portal";
	mail("youremail@yoursite.com", $subject, $message, $from);

}
?>


<link rel="stylesheet" href="css/swipebox.css">
			<script src="js/jquery.swipebox.min.js"></script> 
			    <script type="text/javascript">
					jQuery(function($) {
						$(".swipebox").swipebox();
					});
				</script>


		<!---banner--->
		<div class="banner-section">
			<div class="container">
				<h2>Contactos</h2>
			</div>
		</div>
		<!---banner--->
		<div class="content">
			<div class="contact-section">
				<div class="container">
					<div class="google-map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d249.25827016772956!2d-78.6406125705522!3d-1.6657309244571834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sec!4v1493094309068" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
					<div class="contact-grids">
						<div class="col-md-8 contact-grid">
							<h5>Llene el siguiente formulario y nos contactaremos con usted</h5>
							<p style="color: red;">
							<?php 
							if(isset($_POST['nombre'])){
							if (($name=="")||($email=="")||($message=="")||($phone==""))
							{
								echo "Ingrese todos los campos";
							} else {
								echo "Mensaje Enviado";
							}
							}
							?>
							</p>
							<form action="" method="POST">
								<input type="text" required="required" placeholder="Nombre" name="nombre" id="nombre">
								<input type="email" name="email" required="required" placeholder="Email" id="email">
								<input type="text" required="required" placeholder="Telefono" name="phone" id="phone">
								<textarea   placeholder="Mensaje" name="message" required="required" id="message"></textarea>
								<input type="submit" value="Enviar" >
							</form>
						</div>
						<div class="col-md-4 contact-grid1">
							<h4>Soporte Técnico</h4>
							<div class="contact-top">
								<div class="agent-img">
									<img src="images/t1.png" class="img-responsive" alt="">
								</div>
								<div class="agent-info">
									<h5>Alvaro Vilema</h5>
									<h6>Tnlgo. en Informática</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<ul>
									<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Oficina :032 376-393</li>
									<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Celular : 0982706168</li>
									<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> <a href="#"><a href="mailto:info@example.com">alvarovilemag1993@gmail.com</a></a></li>									
								</ul>

						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>


<?php
require_once ("../template/footerPublic.php");
?>	
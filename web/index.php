<?php require_once ("../template/headerPublic.php"); ?>

<script src="js/responsiveslides.min.js"></script>
	 <script>
		$(function () {
		  $("#slider").responsiveSlides({
			auto:true,
			nav: false,
			speed: 500,
			namespace: "callbacks",
			pager:true,
		  });
		});
	</script>
<link href="css/owl.carousel.css" rel="stylesheet">
<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
		$("#owl-demo").owlCarousel({
			items : 1,
			lazyLoad : true,
			autoPlay : true,
			navigation : false,
			navigationText :  false,
			pagination : true,
		});
		});
	</script>

		<!---banner--->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides" id="slider">
					<div class="slid banner1">
						  					</div>
					<div class="slid banner2">	
						  
					</div>
					<div class="slid banner3">	
						
					</div>
				</ul>
			</div>
		</div>
<!---banner--->
	<div class="content">
		
			<div class="services-section">
				<div class="container">
<div class="main-service">
						<h3>Nuestros Servicios</h3>
						<div class="service-grids">
							<div class="col-md-3 service-grid hvr-bounce-to-bottom">
								<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
								<h4>Lotizaciones</h4>
								
							</div>
							<div class="col-md-3 service-grid hvr-bounce-to-bottom">
								<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
								<h4>Ingenier&iacute;a</h4>
								
								
							</div>
							<div class="col-md-3 service-grid hvr-bounce-to-bottom">
								<i class="glyphicon glyphicon-home" aria-hidden="true"></i>
								<h4>Edificios</h4>
								
								
							</div>
							<div class="col-md-3 service-grid hvr-bounce-to-bottom">
								<i class="glyphicon glyphicon-road" aria-hidden="true"></i>
								<h4>Carreteras</h4>
								
								
							</div>
						<div class="clearfix"></div>
						</div>
					</div>
			
			</div>
			</div>
			<!---Featured Properties--->

			<!---testimonials--->
					<div class="testimonials">
						<div class="container">
							<h3>Nuestros Clientes</h3>
							<span></span>
							<div id="owl-demo" class="owl-carousel">
								<div class="item">
									<div class="col-md-2 testmonial-img">
										<img src="images/cliente1.jpg" class="img-responsive img-circle" alt="" style="height: 125px; width: 125px;"/>
									</div>
									<div class="col-md-10 testmonial-text">
										<p>“Encontrar un lote de terreno en la ciudad de Riobamba no es tan fácil por los elevados precios, pero el Proyecto de Urbanización Donovilsa III, nos ayudó a cumplir con este deseo”.</p>
										<h4><a href="#">Sra. Joselyn Ruiz - Urbanización Donovilsa III</a></h4>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="item">
									<div class="col-md-2 testmonial-img">
										<img src="images/cliente2.jpg" class="img-responsive img-circle" alt="" style="height: 125px; width: 125px;"/>
									</div>
									<div class="col-md-10 testmonial-text">
										<p>“Contar con una casa propia es el sueño de toda familia, gracias a la ayuda y facilidad que brinda la Compañía Nuevo Amanecer Donovilsa S.A. lo he logrado”.</p>
										<h4><a href="#">Lcdo. Javier Nauñay - Urbanización Donovilsa II</a></h4>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="item">
									<div class="col-md-2 testmonial-img">
										<img src="images/cliente3.jpg" class="img-responsive img-circle" alt="" style="height: 125px; width: 125px;"/>
									</div>
									<div class="col-md-10 testmonial-text">
										<p>“Formar parte de una Institución seria, con amplia experiencia y trayectoria ya definida, es una gran ventaja para nosotros como clientes, pues estamos seguros que las inversiones efectuadas son con un buen objetivo, tener una vivienda propia”.</p>
										<h4><a href="#">Lcda. Jimena Parra – Urbanización Donovilsa I</a></h4>
									</div>
									<div class="clearfix"> </div>
								</div>
							</div>
						</div>
					</div>
					<!---testmonials--->
	</div>		
<?php
require_once ("../template/footerPublic.php");
?>		

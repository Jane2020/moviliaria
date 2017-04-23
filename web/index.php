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
							<h3>testimonial</h3>
							<span></span>
							<div id="owl-demo" class="owl-carousel">
								<div class="item">
									<div class="col-md-2 testmonial-img">
										<img src="images/t1.png" class="img-responsive" alt=""/>
									</div>
									<div class="col-md-10 testmonial-text">
										<p>Lorem ipsum dolor sit amet, offendit volutpat sea ex, at omnium scripta pro, at omnium scripta pro, ei mea oratio malorum forensibus. ei mea oratio malorum forensibus. Sed ei omnes laoreet posidonium ei mea oratio malorum forensibus.</p>
										<h4><a href="#">Michael Feng</a></h4>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="item">
									<div class="col-md-2 testmonial-img">
										<img src="images/t2.png" class="img-responsive" alt=""/>
									</div>
									<div class="col-md-10 testmonial-text">
										<p>Lorem ipsum dolor sit amet, offendit volutpat sea ex, at omnium scripta pro, at omnium scripta pro, ei mea oratio malorum forensibus. ei mea oratio malorum forensibus. Sed ei omnes laoreet posidonium ei mea oratio malorum forensibus.</p>
										<h4><a href="#">Stacy Barron</a></h4>
									</div>
									<div class="clearfix"> </div>
								</div>
								<div class="item">
									<div class="col-md-2 testmonial-img">
										<img src="images/t3.png" class="img-responsive" alt=""/>
									</div>
									<div class="col-md-10 testmonial-text">
										<p>Lorem ipsum dolor sit amet, offendit volutpat sea ex, at omnium scripta pro, at omnium scripta pro, ei mea oratio malorum forensibus. ei mea oratio malorum forensibus. Sed ei omnes laoreet posidonium ei mea oratio malorum forensibus.</p>
										<h4><a href="#">Johnson </a></h4>
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

<?php require_once ("../template/headerPublic.php"); ?>
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
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25314.705189576223!2d-122.04163718289803!3d37.52352544242605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fbee225b54b73%3A0xd9e9e38c14446fd!2sReal+Estate+Residential+Homes!5e0!3m2!1sen!2sin!4v1453458032800" ></iframe>
					</div>
					<div class="contact-grids">
						<div class="col-md-8 contact-grid">
							<h5>Fill out the form and we will get back to you within 24 hours</h5>
							<p>Nemo enim ips voluptatem voluptas sitsper natuaut odit aut fugit consequuntur magni dolores eosqratio nevoluptatem  amet eism com odictor ut ligulate cot ameti dapibu</p>
							<form>
								<input type="text" value="Name " onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
								<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
								<input type="text" value="Phone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Phone';}" required="">
								<textarea type="text"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Special Instruction/Comments...';}" required="">Special Instruction/Comments...</textarea>
								<input type="submit" value="Request a showing" >
							</form>
						</div>
						<div class="col-md-4 contact-grid1">
							<h4>Listing Agent</h4>
							<div class="contact-top">
								<div class="agent-img">
									<img src="images/t1.png" class="img-responsive" alt="">
								</div>
								<div class="agent-info">
									<h5>Johnson</h5>
									<h6>Real Space Group</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<ul>
									<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 0041-456-3692</li>
									<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : 0200-123-4567</li>
									<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> <a href="#"><a href="mailto:info@example.com">info@example.com</a></a></li>
									<li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 0091-789-456100</li>
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
<!-- Footer Start -->
	<footer class="footer">
		<div class="footer-first-row">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<ul class="call-email-alt">
							<li><a href="#" class="callemail"><i class="uil uil-dialpad-alt"></i>+91 9324358115</a></li>
							<li><a href="#" class="callemail"><i class="uil uil-envelope-alt"></i>contact@dattaprabodhinee.com</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="social-links-footer">
							<ul>
								<li><a href="https://www.youtube.com/c/dattaprabodhineepublication?sub_confirmation=1%3Fsub_confirmation%3D1"><i class="fab fa-youtube"></i></a></li>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
								<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a href="#"><i class="fab fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
		<div class="footer-second-row">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4>Top Categories</h4>
							<ul>
								<?php foreach($nine_categories as $nine_categories){ ?>
								<li><a href="<?php echo base_url('view-all/'.$nine_categories->id).'/'.strtolower(str_replace(' ', '-',$nine_categories->name)).'/';?>"><?php echo $nine_categories->name; ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4>Useful Links</h4>
							<ul>
								<li><a href="<?php echo base_url('privacy-policy/'); ?>">Privacy Policy</a></li>
								<li><a href="<?php echo base_url('new-products/'); ?>">Latest Products</a></li>
								<li><a href="<?php echo base_url('term-and-conditions/'); ?>">Terms & Conditions</a></li>
								<li><a href="<?php echo base_url('refund-and-return-policy/'); ?>">Return & Return Policy</a></li>
								<li><a href="<?php echo base_url('seller-registration/'); ?>">Seller Regsitration</a></li>
								<li><a href="<?php echo base_url('contact-us/'); ?>">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<!--<h4>Top Cities</h4>
							<ul>
								<li><a href="#">Gurugram</a></li>
								<li><a href="#">New Delhi</a></li>
								<li><a href="#">Bangaluru</a></li>
								<li><a href="#">Mumbai</a></li>
								<li><a href="#">Hyderabad</a></li>
								<li><a href="#">Kolkata</a></li>
								<li><a href="#">Ludhiana</a></li>
								<li><a href="#">Chandigrah</a></li>
							</ul>-->
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item-app">
							<h4>Download App</h4>
							<ul>
								<!--<li><a href="#"><img class="download-btn" src="<?php echo base_url('assets/images/download-1.svg');?>" alt=""></a></li>
								<li><a href="#"><img class="download-btn" src="<?php echo base_url('assets/images/download-2.svg');?>" alt=""></a></li>-->
								<li>Coming Soon..</a></li>
							</ul>
						</div>
						<div class="second-row-item-payment">
							<h4>Payment Method</h4>
							<div class="footer-payments">
								<ul id="paypal-gateway" class="financial-institutes">
									<li class="financial-institutes__logo">
									  <img alt="Visa" title="Visa" src="<?php echo base_url('assets/images/footer-icons/pyicon-6.svg');?>">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="Visa" title="Visa" src="<?php echo base_url('assets/images/footer-icons/pyicon-1.svg');?>">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="MasterCard" title="MasterCard" src="<?php echo base_url('assets/images/footer-icons/pyicon-2.svg');?>">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="American Express" title="American Express" src="<?php echo base_url('assets/images/footer-icons/pyicon-3.svg');?>">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="Discover" title="Discover" src="<?php echo base_url('assets/images/footer-icons/pyicon-4.svg');?>">
									</li>
								</ul>
							</div>
						</div>
						<div class="second-row-item-payment">
							<h4>Newsletter</h4>
							<?php if($this->session->flashdata('msg')){ ?>
							<div class="alert alert-success" role="alert">
							  <?php echo $this->session->flashdata('msg'); ?>
							</div>
							<?php } ?>
							<?php if($this->session->flashdata('err')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php echo $this->session->flashdata('err'); ?>
							</div>
							<?php } ?>
							<div class="newsletter-input">
								<form action="<?php echo base_url('Welcome_controller/newsletter'); ?>" method="post">
								<input id="email" name="email" type="email" placeholder="Email Address" class="form-control input-md" required="">
								<button class="newsletter-btn hover-btn" type="submit"><i class="uil uil-telegram-alt"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-last-row">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="footer-bottom-links">
							<ul>
								<!--<li><a href="about_us.html">About</a></li>-->
								<li><a href="<?php echo base_url('contact-us');?>">Contact</a></li>
								<li><a href="<?php echo base_url('privacy-policy');?>">Privacy Policy</a></li>
								<li><a href="<?php echo base_url('term-and-conditions');?>">Term & Conditions</a></li>
								<li><a href="<?php echo base_url('refund-and-return-policy');?>">Refund & Return Policy</a></li>
							</ul>
						</div>
						<div class="copyright-text">
							<i class="uil uil-copyright"></i>Copyright 2020-2021 <b>Dattaprabodhinee E-store</b> . All rights reserved
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer End -->

	<!-- Javascripts -->
	<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/OwlCarousel/owl.carousel.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/semantic/semantic.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.countdown.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
	<script src="<?php echo base_url('assets/js/product.thumbnail.slider.js');?>"></script>
	<script src="<?php echo base_url('assets/js/offset_overlay.js');?>"></script>
	<script src="<?php echo base_url('assets/js/night-mode.js');?>"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
      <script>
         $(document).ready(function() {
            $("#productSearch").typeahead({
              source:function(query,result)
              {
                  $.ajax({
                     url:"<?php echo base_url('welcome_controller/getproduct/');?>",
                     method:"POST",
                     data:{query:query},
                     dataType:"json",
                     success:function(data)
                     {
                        result($.map(data, function(item){
                          return item;
                        }));
                     }

                  });
              }
            });
         });
            </script>
	<!--<script src="https://apps.elfsight.com/p/platform.js" defer></script>
	<div class="elfsight-app-90a2325f-c214-414f-8e46-8a46f8e61fc0"></div>-->
	
	<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+919324358115", // WhatsApp number
            call_to_action: "Need Help?", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
	
</body>

</html>
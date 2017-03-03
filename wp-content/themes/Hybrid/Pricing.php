<?php 
/*
Template Name: Pricing Page
*/
?>

<?php
get_header();?>


<script>

$(document).ready(function(){
	$(".pricing-plan").hover(function(){
            
		$(this).addClass("pricing-plan-promote");},
            
        function(){
            $(this).removeClass("pricing-plan-promote");
        }
        );


});


</script>

<div class="section" style="height: 50%">
	    	<div class="container">
	        	<div class="row">
	        		<div class="col-md-12">
	        			<!-- Pricing Plans Wrapper -->
	        			<div class="pricing-wrapper">
	        				<!-- Pricing Plan -->
							<div class="pricing-plan">
								<h2 class="pricing-plan-title">Starter</h2>
								<div class="pricing-plan-price">FREE</div>
								<!-- Pricing Plan Features -->
								<ul class="pricing-plan-features">
									<li><strong>1</strong> user</li>
									<li><strong>Unlimited</strong> projects</li>
									<li><strong>2GB</strong> storage</li>
								</ul>
								<a href="index.html" class="btn">Order Now</a>
							</div>
							<!-- End Pricing Plan -->
						    <div class="pricing-plan">
								<h2 class="pricing-plan-title ">Advanced</h2>
								<div class="pricing-plan-price">$49<span>/mo</span></div>
								<ul class="pricing-plan-features">
									<li><strong>10</strong> users</li>
									<li><strong>Unlimited</strong> projects</li>
									<li><strong>20GB</strong> storage</li>
								</ul>
								<a href="index.html" class="btn">Order Now</a>
						    </div>
						    <!-- Promoted Pricing Plan (White Background) -->
						    <div class="pricing-plan ">
									<h2 class="pricing-plan-title">Premium</h2>
									<div class="pricing-plan-price">$99<span>/mo</span></div>
									<ul class="pricing-plan-features">
										<li><strong>Unlimited</strong> users</li>
										<li><strong>Unlimited</strong> projects</li>
										<li><strong>100GB</strong> storage</li>
									</ul>
								<a href="index.html" class="btn">Order Now</a>
						    </div>
						    <div class="pricing-plan">
						    	<!-- Pricing Plan Ribbon -->
								<div class="ribbon-wrapper">
									<div class="price-ribbon ribbon-green">New</div>
								</div>
								<h2 class="pricing-plan-title">Mega</h2>
								<div class="pricing-plan-price">$199<span>/mo</span></div>
								<ul class="pricing-plan-features">
									<li><strong>Unlimited</strong> users</li>
									<li><strong>Unlimited</strong> projects</li>
									<li><strong>100GB</strong> storage</li>
								</ul>
								<a href="index.html" class="btn">Order Now</a>
						    </div>
						</div>
						<!-- End Pricing Plans Wrapper -->
	        		</div>
	        	</div>
	    	</div>
	    </div>

	    <div class="pricing-plans-section section" style="height: 50%">
	    	<div class="container">
	        	<div class="row">
	        		<div class="col-md-12 text-center">
	        			<div class="pricing-wrapper">
							<div class="pricing-plan">
								<h2 class="pricing-plan-title">Starter</h2>
								<div class="pricing-plan-price">FREE</div>
								<ul class="pricing-plan-features">
									<li><strong>1</strong> user</li>
									<li><strong>Unlimited</strong> projects</li>
									<li><strong>2GB</strong> storage</li>
								</ul>
								<a href="index.html" class="btn">Order Now</a>
							</div>
						    <div class="pricing-plan">
								<h2 class="pricing-plan-title">Advanced</h2>
								<div class="pricing-plan-price">$49<span>/mo</span></div>
								<ul class="pricing-plan-features">
									<li><strong>10</strong> users</li>
									<li><strong>Unlimited</strong> projects</li>
									<li><strong>20GB</strong> storage</li>
								</ul>
								<a href="index.html" class="btn">Order Now</a>
						    </div>
						    <div class="pricing-plan">
						    		<div class="ribbon-wrapper">
										<div class="price-ribbon ribbon-red">Sale</div>
									</div>
									<h2 class="pricing-plan-title">Premium</h2>
									<div class="pricing-plan-price">$99<span>/mo</span></div>
									<ul class="pricing-plan-features">
										<li><strong>Unlimited</strong> users</li>
										<li><strong>Unlimited</strong> projects</li>
										<li><strong>100GB</strong> storage</li>
									</ul>
								<a href="index.html" class="btn">Order Now</a>
						    </div>
						</div>
	        		</div>
	        	</div>
	    	</div>
	    </div>


<?php get_footer();
?>

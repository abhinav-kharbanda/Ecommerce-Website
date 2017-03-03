<?php get_header();?>

        <!-- Page Title -->
		<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Proucts Listing (3 Columns)</h1>
					</div>
				</div>
			</div>
		</div>
        
        <div class="section">
	    	<div class="container">
			<?php if ( have_posts() ) { 
					$post_count=0;
				
				 while ( have_posts() ) {  ?>				

					<div class="row">

					<?php while ($post_count%3!=0 ) {
						$post_count++;  ?>					

					<div class="col-sm-4">
						<!-- Product -->
						<div class="shop-item">
							<!-- Product Image -->
							<div class="image">
								<a href="<?php the_permalink(); ?>"><img src="img/product1.jpg" alt="Item Name"></a>
							</div>
							<!-- Product Title -->
							<div class="title">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						
							</div>
							<!-- Product Price-->
							<div class="price">
								<span class="price-was">$959.99</span> $999.99
							</div>
							<!-- Product Description-->
							<div class="description">
								<p><? the_post(); ?></p>
							</div>
							<!-- Add to Cart Button -->
							<div class="actions">
								<a href="<?php the_permalink(); ?>" class="btn"><i class="icon-shopping-cart icon-white"></i> Read More</a>
							</div>
						</div>
						<!-- End Product -->
					</div>
					<? }?>
				</div>
				<? } 
			} ?>
				<div class="pagination-wrapper ">
					<ul class="pagination pagination-lg">
						<li class="disabled"><a href="#">Previous</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">6</a></li>
						<li><a href="#">7</a></li>
						<li><a href="#">8</a></li>
						<li><a href="#">9</a></li>
						<li><a href="#">10</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div>
			</div>
	    </div>

	    <div class="eshop-section section">
	    	<div class="container">
	    		<h2>Listing With No Colors Information</h2>
				<div class="row">
					<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="page-product-details.html"><img src="img/product1.jpg" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
							</div>
							<div class="price">
								<span class="price-was">$959.99</span> $999.99
							</div>
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
							</div>
							<div class="actions">
								<a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="page-product-details.html"><img src="img/product2.jpg" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
							</div>
							<div class="price">
								$999.99
							</div>
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
							</div>
							<div class="actions">
								<a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="page-product-details.html"><img src="img/product3.jpg" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
							</div>
							<div class="price">
								$999.99
							</div>
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
							</div>
							<div class="actions">
								<a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="page-product-details.html"><img src="img/product4.jpg" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
							</div>
							<div class="price">
								$999.99
							</div>
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
							</div>
							<div class="actions">
								<a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="page-product-details.html"><img src="img/product5.jpg" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
							</div>
							<div class="price">
								$999.99
							</div>
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
							</div>
							<div class="actions">
								<a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="page-product-details.html"><img src="img/product6.jpg" alt="Item Name"></a>
							</div>
							<div class="title">
								<h3><a href="page-product-details.html">Lorem ipsum dolor</a></h3>
							</div>
							<div class="price">
								$999.99
							</div>
							<div class="description">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis, nulla id pretium malesuada, dui est laoreet risus, ac rhoncus eros diam id odio.</p>
							</div>
							<div class="actions">
								<a href="page-product-details.html" class="btn"><i class="icon-shopping-cart icon-white"></i> Add to Cart</a> <span>or <a href="page-product-details.html">Read more</a></span>
							</div>
						</div>
					</div>
				</div>
				<div class="pagination-wrapper ">
					<ul class="pagination pagination-lg">
						<li class="disabled"><a href="#">Previous</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">6</a></li>
						<li><a href="#">7</a></li>
						<li><a href="#">8</a></li>
						<li><a href="#">9</a></li>
						<li><a href="#">10</a></li>
						<li><a href="#">Next</a></li>
					</ul>
				</div>
			</div>
	    </div>

<?php get_footer(); ?>

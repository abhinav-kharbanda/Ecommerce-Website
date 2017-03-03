

<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */


get_header( 'shop' ); ?>
	
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */



?>

<style>
    .woocommerce-result-count
    {
        display: none;
    }
    nav.woocommerce-pagination
    {
        margin-top: 15px;
        text-align: center;
    }
    ul.page-numbers
    {
        display: inline-block;
        padding-left: 0px;
        margin: 20px 0px;
        border-radius: 4px;
    }
    ul.page-numbers > li 
    {
        display: inline;
        background-color: white;
        padding: 15px 0px;
        float:left;

font-size: 1.3em;
        
    }
    ul.page-numbers > li:first-child
    {
       border-top-left-radius: 6px;
border-bottom-left-radius: 6px; 
    }
    ul.page-numbers > li:last-child
    {
       border-top-right-radius: 6px;
border-bottom-right-radius: 6px; 
    }
    
    
    ul.page-numbers > li > span, ul.page-numbers > li > a
    {
        padding:15px 20px;
        color:#666;
    }
    ul.page-numbers > li > a:hover
    {
        border-bottom: 3px solid #666;
               
                text-decoration: none;
    }
    ul.page-numbers > li > .current
    {
        color: #666;
        border-bottom: 3px solid #4F8DB3;
    }
   ul.page-numbers > li > span.current:hover, .ul.page-numbers > li > span.current:focus
   {
       z-index: 2;
color: #FFF;
background-color: #428BCA;
cursor: default;
border-color: #428BCA;
        transition: all 0.25s linear 0s;
                   


   }

</style>
		

	    <div class="eshop-section section">
	    	<?php $args = array('post_type' => 'product','paged' => $paged,'post__in' => array());
        $loop = new WP_Query( $args );
        ?>
                <div class="container">
                    <?php WP_Advanced_Search (); ?>
	
                    <?php do_action('get_product_search_form');
                            do_action( 'woocommerce_before_shop_loop' ); 
                            
			if ( $loop->have_posts() ) {       
                              $post_count=0;
                                while ( $loop->have_posts() ) 
                                    { 
                                        if($post_count%3==0)
                                          {?> <div class="row"><?php }
                                                                           
                                            $loop->the_post(); global $product; ?>	
                                       	<div class="col-sm-4">
						<div class="shop-item">
							<div class="image">
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
                                                                   <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, array(344,206)); 
                                                                    else { ?>
                                                                    <img src="<?php woocommerce_placeholder_img_src() ?>" alt="Item Name"/>
                                                                    <?php } ?>
                                                                    
							</div>
                                                    
                                                        
							<div class="title">
								<h3><a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="price">
								Rs.<?php echo get_post_meta( get_the_ID(), '_price', true);?>
							</div>
							<div class="description">
								<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
							</div>
                                                    <div class="actions">
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" class="btn"><i class="icon-shopping-cart icon-white"></i> Read More</a> 
                                                                <span>or <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?></span>
							</div>
							
						</div>
					</div>
                                        <?php
                                        $post_count++;
                                        if($post_count%3==0)
                                          {?> </div><?php }
                                        
                                        ?>
					
				
                                    
                            <?php }?>

                          <?php      }
                          ?>
                    
				
			</div>
	    </div>	
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
            do_action( 'woocommerce_after_shop_loop' );

	?>
<?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */

        do_action('woocommerce_after_main_content');
        
    ?>

	

<?php
get_footer( 'shop' ); 

?>

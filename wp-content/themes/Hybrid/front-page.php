
<?php get_header( 'shop' ); ?>	
	
<script type="text/javascript">
$(document).ready(function()
{var menu = $('a[href="' + 'http://localhost/projects/repply/wordpress/' + '"]');
    $(menu).click(function(){
       alert("yo this works"); 
    });
    
    }
  );
    
        
 



</script>
<div class="eshop-section section">
<br /><br /><br /><br />
<?php $args = array('post_type' => 'product','posts_per_page' => 6);
add_filter('posts_orderby','customorderby');
$args=array(
    'post_type'    => 'product',
    'posts_per_page' => 6,
    'meta_key'     => 'location',
    'meta_query'  => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'location',
                            'value' => $user_location,
                            'compare' => '='
                            ),

                        array(
                            'key' => 'total_sales',
                             ),

                        array(
                            'key' => (('_regular_price'-'_sale_price')/'_regular_price')	
                             ),

                        )
            );                
        $loop = new WP_Query( $args );
        remove_filter('posts_orderby','customorderby');

        ?>
                <div class="container">
	
                    <?php do_action( 'woocommerce_before_shop_loop' ); 
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



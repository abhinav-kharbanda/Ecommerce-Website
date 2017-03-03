<ul class="products">
    <?php
$args = array('post_type' => 'product','posts_per_page' => 9);
        $loop = new WP_Query( $args );
if ( $loop->have_posts() ) {       
 while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

            <h2>Shoes</h2>
 
                <li class="product">    

                    <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                        <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
				else { ?>
				<img src="<?php woocommerce_placeholder_img_src() ?>" alt="Placeholder" width="300px" height="300px" />
				<?php } ?>

                        <h3><?php the_title(); ?></h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>                    

                    </a>

                    <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul><!--/.products-->
<?php
   /**
    * The template for displaying product content within loops.
    *
    */
   if (!defined('ABSPATH'))
       exit; // Exit if accessed directly
     global $product, $woocommerce_loop;
     $classes = array();
// Store loop count we're currently on
       if (empty($woocommerce_loop['loop']))
         $woocommerce_loop['loop'] = 0;
// Store column count for displaying the grid
       if (empty($woocommerce_loop['columns']))
         $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 3);
// Ensure visibility
       if (!$product || !$product->is_visible())
         return;
// Increase loop count
       $woocommerce_loop['loop'] ++;
// Extra post classes
       if (0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
         $classes[] = 'first';
       if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
         $classes[] = 'last';
     $classes[] ='col-md-4';
     ?>
     <li <?php post_class($classes); ?>>
              <a href="<?php echo get_permalink($post->ID) ?>" title="<?php echo esc_attr($post->post_title ? $post->post_title : $post->ID); ?>">
      <div class="shop-item">
        <?php if ($product->is_on_sale() && is_archive()) { ?>
        <?php $percentage = round(( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100);
        ?>
        <span class="onsale"><?php echo $percentage . "% Off"; ?></span>
        <?php }
        ?>
          <span class="image">
            <?php
            if (has_post_thumbnail($post->ID))
            {
             //echo get_the_post_thumbnail($post->ID, array(460, 329));
             
             $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(460, 329) );
// add more attributes if you need
             if(is_archive())
                {
                  printf( '<img class="lazy post-image" data-original="%s"/>', esc_url( $thumbnail_src[0] ) );
                  
            }
              else
                printf( '<img class="slider-image" src="%s"/>', esc_url( $thumbnail_src[0] ) );
           }
           else {
             ?>
             <img src="<?php woocommerce_placeholder_img_src() ?>" alt="Item Name"/>
             <?php } ?>
<!-- <span class="overlay_catalogue">
<span class="overlay_wrap">
<span class="description">
                <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
</span> 
<span class="btn add_to_cart_button btn-green">Add To Cart</span>
</span>
</span> -->
</span> 
<span class="tab_content clearfix">
  <div class="title ">
    <?php the_title(); ?>
  </div>
  <div class="price ">
    <?php echo preg_replace(array('[\.00]', '[<ins>]'), '', $product->get_price_html()); ?>
  </div>
  <span class="description">
    <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
  </span> 
</span>
</div>
</a>
</li>

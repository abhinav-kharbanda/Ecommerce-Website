<?php
   /**
    * The template for displaying Archive pages.
    *
    * Learn more: http://codex.wordpress.org/Template_Hierarchy
    *
    * @package Dokan
    * @subpackage WooCommerce/Templates
    * @version 2.0.0
    */
   get_header();
   function featured($post)
   {
    if (has_post_thumbnail($post->ID)) {
     ?>
     <li>
       <a href="<?php echo get_permalink($post->ID) ?>" title="<?php echo esc_attr($post->post_title ? $post->post_title : $post->ID); ?>">
         <span class="content">
           <div class="title">
             <h1>
               <?php the_title(); ?>
             </h1>
           </div>
           <div class="description">
             <h2>
               <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt) ?>
             </h2>
           </div>
         </span>
         <span class="image">
           <?php echo get_the_post_thumbnail($post->ID, array(460, 329)); ?>
         </span>
       </a>
     </li>
     <?php
   }
 }
 ?>
</div>
</div>
<div id="skrollr-body">
  <div class="slider-shop center" data-0="background-position:0px -30px" data-500="background-position:0px 200px;">
    <div class="overlay">
      <div class="shop-slider center col-md-8">
        <ul class="slides">
          <?php
          $featured_query = dokan_get_featured_products();
          ?>
          <?php
          while ($featured_query->have_posts()) {
           $featured_query->the_post();
           if(empty($GLOBALS['location']))
            featured($post);
          else if(!empty($GLOBALS['location']) && $GLOBALS['location']==get_post_meta( $post->ID, 'location', true ))
            featured($post);
        }
        ?>
      </ul>
    </div>
  </div> <!-- .slider-container -->
</div>
</div>
</div>
<div id="primary" class="home-content-area clearfix">
    <!--   <div class="cat_header">
           <ul class="cat_list">
               <li class="<?php if (is_shop()) echo "current-cat"; ?>"><a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('All Deals'); ?> </a></li>
    <?php wp_list_categories('show_option_all=&depth=1 &taxonomy=product_cat&title_li='); ?>
           </ul>
         </div> -->
         <div class="content-area center container" id="primary">
          <div class="row">
            <div class="site-content center" id="content" role="main">
              <?php
               /**
                * woocommerce_before_main_content hook
                *
                * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                * @hooked woocommerce_breadcrumb - 20
                */
               ?>
               <div class="archive-header clearfix">
                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                 <h1 class="page-title"><?php is_shop() ?_e("Today's Shopping Deals"): woocommerce_page_title(). _e(" Deals")?></h1>
               <?php endif; ?>
               <div class="dropdown archive-filter">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                  <i class="fa fa-2x fa-bars"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                  <form action="" method="post" title="">
                    <?php 
                    $loc_possible = get_unique_post_meta_values('location','product'); ?>
                    <li><button class="location_input  <?php if(empty($GLOBALS['location'])) echo 'selected' ?>" type="submit" name="location" value=""><?php _e('All Locations') ?></button> </li>
                    <li role="presentation" class="divider"></li>
                    <?php foreach($loc_possible as $loc) {
                      if($loc!=''){
                        ?>
                        <li> <button class="location_input  <?php if(!empty($GLOBALS['location']) && $GLOBALS['location']==strtolower($loc)) echo 'selected' ?>" type="submit" name="location" value="<?php echo strtolower($loc) ?>" ><?php echo ucfirst(strtolower($loc)) ?></button> </li>
                        <?php
                      }}
                      ?>
                    </form>               
                  </ul></div>
                  <?php if(!empty($GLOBALS['location'])) { ?>              
                  <h5 class="title-sub-location"><?php _e("Showing results from ".ucfirst($GLOBALS['location']));?></h5>
                  <?php } ?>
                  
                </div>
                <?php 
                $args = array('post_type' => 'product','paged' => $paged, 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => 9);
                if(is_category())
                 $args += array('category_name' => 'cat-slug');
               if(!empty($GLOBALS['location']))
                 $args += array('meta_key' => 'location', 'meta_value' => $GLOBALS['location']);
               global $wp_query, $woocommerce_loop;
               $loop = new WP_Query( $args );
               if ( $loop->have_posts() ) {       
                 ?>
                 <?php woocommerce_product_subcategories(); 
                 $total = $wp_query->found_posts;
                 $pageno = (get_query_var('paged')) ? get_query_var('paged') : 1;
                 $ppp = get_query_var('posts_per_page');
                 $offset = ($pageno * $ppp) - $ppp;
                 $pageitems=$total-$offset;
                 $columns=$woocommerce_loop['columns'] ? $woocommerce_loop['columns']:3;
                 $count=0;
                 ?>
                 <ul class="products-archive clearfix"> 
                   <?php while ($loop->have_posts()) : 
                   $loop->the_post();
                   if($pageitems < $ppp)                                        //if page items is less than posts per page i.e valid only on last page
                   {
                       if(($pageitems) % $columns !=0)                          //if page items are not a multiple of no. of columns (3)
                       { 
                           if(($pageitems)<$columns)                                  //if they are less than no.of columns (3) i.e 1 or 2 then no need to display both
                           {
                             break;
                           }
                           else if(++$count<=(($pageitems)-(($pageitems) % $columns)))  // if more than no. of columns ...count ++ <= 4 - 1 i.e 3... display to fill 3 columns (first row)
                           {
                             wc_get_template_part('content', 'product');
                           }
                         }
                       }
                       else
                         wc_get_template_part('content', 'product');
                       endwhile; // end of the loop.   ?>
                     </ul>
                     <?php woocommerce_product_loop_end(); ?>
                     <?php
                   /**
                    * woocommerce_after_shop_loop hook
                    *
                    * @hooked woocommerce_pagination - 10
                    */
                   do_action('woocommerce_after_shop_loop');
                   ?>
                   <?php
                 }
                 else { ?>
                 <?php get_template_part( 'no-results', 'archive');  ?>
                 <?php } ?>
                 <?php
               /**
                * woocommerce_after_main_content hook
                *
                * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                */
               do_action('woocommerce_after_main_content');
               ?>
             </div><!-- #content .site-content -->
           </div>
         </div><!-- #primary .content-area -->
         <?php get_footer(); ?> 

<?php
   /**
    * The Template for displaying all single products.
    *
    * @package Dokan
    * @subpackage WooCommerce/Templates
    * @version 1.6.4
    */
   
  
  the_post();
  
$scheme = is_ssl() ? 'https' : 'http';
   wp_enqueue_script( 'google-maps', $scheme . '://maps.google.com/maps/api/js?sensor=true' );
  
  
      get_header();
?>
</div>
</div>
<div id="main" class="col-md-8 center clearfix">
<div id="primary" class="content-area col-md-9">
    <div id="content" class="row" role="main">
        
        <?php
           /**
            * woocommerce_before_main_content hook
            *
            * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
            * @hooked woocommerce_breadcrumb - 20
            */
        ?>
        
               <?php wc_get_template_part('content', 'single-product'); ?>
        <?php
           /**
            * woocommerce_after_main_content hook
            *
            * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
            */
        ?>
    </div><!-- #content .site-content -->
    
</div><!-- #primary .content-area -->
<?php 
         wc_get_template_part('sidebar-store');
?>
</div>
<?php
   get_footer(); ?>
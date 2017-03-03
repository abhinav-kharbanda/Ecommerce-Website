<?php
global $woocommerce;
?>
<li class="<?php if (is_shop()) echo "current-cat"; ?>"><a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('All Deals'); ?> </a></li>
<?php wp_list_categories('show_option_all=&depth=1 &taxonomy=product_cat&title_li='); ?>
<?php if (is_user_logged_in()) {
 ?>
 <?php
 global $current_user;
 $user_id = $current_user->ID;
 ?>
 <li class="dropdown ">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo esc_html($current_user->display_name); ?> <b class="caret"></b></a>
   <ul class="dropdown-menu link pull-center">
     <?php
     if (dokan_is_user_seller($user_id)) {
       ?>
       <li>
         <a href="<?php echo dokan_get_page_url('dashboard') ?> "><?php _e('Seller Dashboard', 'dokan'); ?></a>
       </li>
       <?php } ?>
       <li><a href="<?php echo dokan_get_page_url('my_orders'); ?>"><?php _e('My Orders', 'dokan'); ?></a></li>
       <li><a href="<?php echo dokan_get_page_url('myaccount', 'woocommerce'); ?>"><?php _e('My Account', 'dokan'); ?></a></li>
       <li><a href="<?php echo wc_customer_edit_account_url(); ?>"><?php _e('Edit Account', 'dokan'); ?></a></li>
       <li class="divider"></li>
       <li><a href="<?php echo wc_get_endpoint_url('edit-address', 'billing', get_permalink(wc_get_page_id('myaccount'))); ?>"><?php _e('Billing Address', 'dokan'); ?></a></li>
       <li><a href="<?php echo wc_get_endpoint_url('edit-address', 'shipping', get_permalink(wc_get_page_id('myaccount'))); ?>"><?php _e('Shipping Address', 'dokan'); ?></a></li>
       <li><?php wp_loginout(home_url()); ?></li>
     </ul>
   </li>
   <?php } else { ?>
   <li class="login"><a class="lbp-inline-link-1 cboxElement" href="#">Login</a></li>
   <li><a class="lbp-inline-link-2 cboxElement" href="#">Register</a></li>
   <?php } ?>
   <li class="dropdown cart_widget">
    <a href="#" class="dropdown-toggle cart-widget" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i></a>
    <ul class="dropdown-menu pull-center">
      <li>
        <div class="widget_shopping_cart_content" style="width:30em"></div>
      </li>
    </ul>
  </li> 
  <?php if (!is_front_page()) { ?>
  <li class="dropdown search">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-search"></i></a>
   <ul class="dropdown-menu pull-center">
     <li> <?php get_search_form(); ?></li>
   </ul>
 </li>
 <?php } ?>

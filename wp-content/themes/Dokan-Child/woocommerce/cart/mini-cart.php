<?php
   /**
    * Mini-cart
    *
    * Contains the markup for the mini-cart, used by the cart widget
    *
    * @author 		WooThemes
    * @package 	WooCommerce/Templates
    * @version     2.1.0
    */
   if (!defined('ABSPATH'))
       exit; // Exit if accessed directly
     global $woocommerce;
     ?>
     <?php do_action('woocommerce_before_mini_cart'); ?>
     <div class="woocommerce">
      <table class="cart_list product_list_widget <?php echo $args['list_class']; ?>">
        <?php if (sizeof(WC()->cart->get_cart()) > 0) : ?>
         <thead>
           <tr>
             <th class="product-thumbnail"></th>
             <th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
             <th class="product-quantity"><?php _e('Quantity', 'woocommerce'); ?></th>
             <th></th>
             <th class="product-price"><?php _e('Price', 'woocommerce'); ?></th>
           </tr>
         </thead><tbody>
         <?php
         foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
           $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
           $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
           if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
             $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
             $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
             $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
             ?>
             <tr>
               <td class="mini_thumb">
                 <?php
                 $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(array(50, 80)), $cart_item, $cart_item_key);
                 if (!$_product->is_visible())
                   echo $thumbnail;
                 else
                   printf('<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail);
                 ?>
               </td>
               <td class="mini_name">       
                 <a href="<?php echo get_permalink($product_id); ?>">
                   <?php echo $product_name; ?>
                 </a>
               </td>
               <td class="mini_quantity">
                 <?php echo WC()->cart->get_item_data($cart_item); ?>
                 <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
               </td>
               <td class="mini_times">
                 <i class="fa fa-times"></i>
               </td>
               <td class="mini_price">
                 <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                 ?>
               </td>
               <?php }
               ?>  
             </tr>
             <?php }
             ?>
           <?php else : ?>  
             <tr class="empty"><td><?php _e('No products in the cart.', 'woocommerce'); ?></td><tr>
             <?php endif; ?>
           </tbody>
         </table><!-- end product list -->
         <?php if (sizeof(WC()->cart->get_cart()) > 0) : ?>
           <p class="total"><strong><?php _e('Subtotal', 'woocommerce'); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>
           <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
           <p class="mini_actions">
             <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button btn-green wc-forward"><?php _e('View Cart', 'woocommerce'); ?></a>
             <a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button btn-green checkout wc-forward"><?php _e('Checkout', 'woocommerce'); ?></a>
           </p>
         <?php endif; ?>
       </div>
       <?php do_action('woocommerce_after_mini_cart'); ?>

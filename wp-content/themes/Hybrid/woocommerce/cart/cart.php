
 <?php if ( ! defined( 'ABSPATH' ) ) exit;   ?>
<div class="section section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Shopping Cart</h1>
					</div>
				</div>
			</div>
		</div>




<div class="container" style="width:50%;">
                    <?php
                            global $woocommerce;

                            wc_print_notices();

                            do_action( 'woocommerce_bofore_cart' );
                    ?>
				<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>
                          	<?php do_action( 'woocommerce_before_cart_contents' ); ?>
                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        ?>
                                    <div class="row">
					<div class="col-md-12">
						<!-- Shopping Cart Items -->
						<table class="shopping-cart">
							<!-- Shopping Cart Item -->
							<tr>
								<!-- Shopping Cart Item Image -->
								<td class="image">
                                                                    <?php
                                                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                                                            if ( ! $_product->is_visible() )
                                                                                    echo $thumbnail;
                                                                            else
                                                                                    printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
                                                                    ?>
                                                                    
                                                                    
                                                               </td>
								<!-- Shopping Cart Item Description & Features -->
								<td>
									<div class="cart-item-title">
                                                                            <h3>
                                                                            <?php if ( ! $_product->is_visible() )
                                                                            echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                                                            else
                                                                            echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
                                                                            
                                                                           
                                                                            ?>
                                                                                </h3>
                                                                        </div>
									
									<div class="feature">
                                                                            <?php
                                                                            // Backorder notification
                                                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                                                                                echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
                                                                             echo $_product->post->post_excerpt;
                                                                            
                                                                            ?> 
                                                                        </div>
								</td>
								<!-- Shopping Cart Item Quantity -->
								<td>
                                                                        <?php
                                                                        if ( $_product->is_sold_individually() ) {
                                                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                                        } 
                                                                        else {
                                                                            $product_quantity = woocommerce_quantity_input( array(
                                                                            'input_name'  => "cart[{$cart_item_key}][qty]",
                                                                            'input_value' => $cart_item['quantity'],
                                                                            'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                                            'min_value'   => '1'
                                                                            ), $_product, false );
                                                                        }

                                                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                                                                        ?>
                                                                
                                                                </td>
								<!-- Shopping Cart Item Price -->
								<td class="price"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );?>
                                                                </td>
								<!-- Shopping Cart Item Actions -->
								<td class="actions">
                                                                       <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="btn btn-xs btn-grey" title="%s"><i class="glyphicon glyphicon-trash"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );?>

								</td>
							</tr>
							
						</table>
						<!-- End Shopping Cart Items -->
					</div>
				</div>
                                <?php 
                                
                                }
                        
                    }
                    
                    		do_action( 'woocommerce_cart_contents' );
                    ?>
				<div class="row">
					<!-- Promotion Code -->
					<div class="col-md-4  col-md-offset-0 col-sm-6 col-sm-offset-6">
						<div class="cart-promo-code">
							<h6><i class="glyphicon glyphicon-gift"></i> Have a promotion code?</h6>
							<div class="input-group">
								<input type="text" class="form-control input-sm" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>"   name="coupon_code">
                                                                
								<span class="input-group-btn">
                                                                      <input type="submit" class="btn btn-sm btn-grey" name="apply_coupon" value="<?php _e( 'Apply', 'woocommerce' ); ?>" />	
                                                                </span>
                                              <?php do_action('woocommerce_cart_coupon'); ?>
                                                    </div>
						</div>
					</div>
					<!-- Shipment Options -->
					<div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-6">
						<div class="cart-shippment-options">
							<h6><i class="glyphicon glyphicon-plane"></i> Shippment options</h6>
							<div class="input-append">
                                                            
                                                            <?php wc_cart_totals_shipping_html(); ?>
								
                                                        </div>
						</div>
					</div>
					
					<!-- Shopping Cart Totals -->
					<div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-6">
							<?php woocommerce_cart_totals(); ?>

						<!-- Action Buttons -->
						<div class="pull-right">
                                                    <button type="submit" class="btn btn-grey" name="update_cart" ><i class="glyphicon glyphicon-refresh"></i><?php _e( 'Update', 'woocommerce' ); ?> </button>
                                                    <button type="submit" class="btn" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>"><i class="glyphicon glyphicon-shopping-cart icon-white"></i><?php _e( 'CHECK OUT', 'woocommerce' ); ?> </button>
                                                    <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

                                                    <?php wp_nonce_field( 'woocommerce-cart' ); ?>
                                                </div>
                                                
					</div>
				</div>
                                </form>
                    <?php do_action( 'woocommerce_after_cart' ); ?>

			</div>
		

	   
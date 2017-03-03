<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $woocommerce, $product;
if ( ! $product->is_purchasable() ) return;
?>
<?php
	// Availability
$availability = $product->get_availability();
if ( $availability['availability'] )
	echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
?>
<?php if ( $product->is_in_stock() ) : ?>
	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	<form class="cart" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<?php
		if ( ! $product->is_sold_individually() )
			woocommerce_quantity_input( array(
				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
				) );
				?>
				<?php
				$incart=false;
				foreach($woocommerce->cart->get_cart() as $cart_item_key => $values ) {
					$_product = $values['data'];
					
					if( $product->id == $_product->id ) {
						$incart=true;
						break;
					}
				}
				$icon_class = $incart ? 'fa-lg fa-share-square-o' : (($product->product_type == 'variable' ) ? 'fa-bars' : 'fa-shopping-cart');
				echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					sprintf( "<a href='%s' rel='nofollow' data-product_id='%s' data-product_sku='%s' class='cat btn single_add_to_cart_button btn-blue product_type_%s ". ($incart ? " ": "add_to_cart_button")."' title='%s'>%s</a>",
						esc_url( $incart ? WC()->cart->get_cart_url() : $product->add_to_cart_url() ),
						esc_attr( $product->id ),
						esc_attr( $product->get_sku() ),
						esc_attr( $product->product_type ),
						esc_html( $product->add_to_cart_text() ),
						sprintf( "<i class='fa %s'></i>%s", $icon_class,$incart ? "View Cart" : "Add To Cart"  )
						),
					$product );
					do_action( 'woocommerce_after_add_to_cart_button' ); ?>
				</form>
				<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
			<?php endif; ?>
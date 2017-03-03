<?php

class CGD_EER_Jigo {
	var $post_type = "product";

	public function __construct() {
	
		// Remove default reviews feature:
		remove_filter( 'comments_template', 'jigoshop_comments_template' );
		
		add_filter( 'cgd_eer_product_post_types', array( $this, 'add_post_type' ) );
		add_filter( 'cgd_eer_verified_purchases', array( $this, 'verified_purchases' ), 10, 3);
		
		add_action('cgd_eer_instructions', array($this, 'instructions') );
	}

	function add_post_type( $valid_post_types ) {
		if ( ! is_array( $valid_post_types ) ) {
			$valid_post_types = (array) $valid_post_types;
		}

		$valid_post_types[] = $this->post_type;

		return $valid_post_types;
	}

	function verified_purchases( $purchases, $comment) {
		global $wpdb;

		if ( $comment->user_id != 0 ) {
			$jigoshop_orders = new jigoshop_orders();
			$jigoshop_orders->get_customer_orders( $comment->user_id );
			
			foreach($jigoshop_orders->orders as $order) {
				foreach($order->_data['items'] as $item) {
					if ( $item['id'] == $comment->comment_post_ID ) {
						$purchases = 1;
						break;
					}
				}
			}
		}

		return intval( $purchases );
	}

	function rating( $options = array() ) {

		$CGD_EER_Core = CGD_EER_Core::getInstance();
		$product_id = get_the_id();

		$defaults = array(
			'hide_no_rating' => 'true',
			'min_rating'     => '1'
		);

		$options = array_merge( $defaults, $options );
		extract( $options );

		$rating = $CGD_EER_Core->get_post_rating( $product_id );

		if ( $rating === 0 && $hide_no_rating ) {
			return $result;
		}
		if ( $rating < $min_rating ) {
			return $result;
		}

		ob_start();
		?>
		<div id="cgd_eer_product_rating" class="cgd_eer_static_rating" data-rating='<?php echo $rating; ?>'></div>
		<?php
		return ob_get_clean();
	}

	function show_reviews( $options ) {
		ob_start();
		
		comments_template( '', true );
		
		return ob_get_clean();
	}

	function review_form( $options ) {
		ob_start();
		$product_id = get_the_id();

		comment_form( array( 'format' => 'html5' ), $product_id );

		return ob_get_clean();
	}
	
	function instructions() {
		?>
		<h4>Add Average Rating to Product Loop</h4>
		<p>To add an average rating star widget to your product loop, add the following anywhere you would like in your template.</p>
		<code>
		cgd_eer_jigo_print_rating();
		</code>
		
		<h4>Show Reviews</h4>
		<p>If for some reason you want to show a products reviews somewhere other than the default theme location, you can use this.</p>
		<code>
		cgd_eer_jigo_print_reviews();
		</code>
		
		<h4>Review Form</h4>
		<p>Similar to above, show the review form.</p>
		<code>
		cgd_eer_jigo_print_review_form();
		</code>
		<p></p>
		<?php
	}
}

function cgd_eer_jigo_rating( $options = array() ) {
	return CGD_EER_Jigo::rating($options);
}

function cgd_eer_jigo_print_rating( $options = array() ) {
	echo cgd_eer_jigo_rating($options);
}

function cgd_eer_jigo_reviews( $options = array() ) {
	return CGD_EER_Jigo::show_reviews($options);
}

function cgd_eer_jigo_print_reviews( $options = array() ) {
	echo cgd_eer_jigo_reviews($options);
}

function cgd_eer_jigo_review_form( $options = array() ) {
	return CGD_EER_Jigo::review_form($options);
}

function cgd_eer_jigo_print_review_form( $options = array() ) {
	echo cgd_eer_jigo_review_form($options);
}
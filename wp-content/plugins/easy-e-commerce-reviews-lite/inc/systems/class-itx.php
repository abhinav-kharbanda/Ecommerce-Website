<?php

class CGD_EER_ITX extends IT_Theme_API_Product {
	var $post_type = "it_exchange_prod";

	public function __construct() {
		// For iThemes API
		parent::__construct();
		
		add_filter( 'cgd_eer_product_post_types', array( $this, 'add_post_type' ) );
		add_filter( 'cgd_eer_verified_purchases', array( $this, 'verified_purchases' ), 10, 2 );
		add_action( 'it_exchange_product_metabox_callback', array( $this, 'add_discussion_mb' ) );

		// Theme API
		add_filter( 'it_exchange_theme_api_get_extended_tag_functions', array($this,'it_exchange_custom_extend_product_theme_api'), 10, 3 );
		add_filter( 'it_exchange_theme_api_product_rating', array( $this, 'rating' ), 100, 2 );
		add_filter( 'it_exchange_theme_api_product_reviews', array( $this, 'show_reviews' ), 100, 2 );
		add_filter( 'it_exchange_theme_api_product_review-form', array( $this, 'review_form' ), 100, 2 );

		add_action('cgd_eer_instructions', array($this, 'instructions') );
	}

	function add_post_type( $valid_post_types ) {
		if ( ! is_array( $valid_post_types ) ) {
			$valid_post_types = (array) $valid_post_types;
		}

		$valid_post_types[] = $this->post_type;

		return $valid_post_types;
	}

	function verified_purchases( $purchases, $comment ) {
		if ( $comment->user_id !== 0 ) {
			$products = it_exchange_get_customer_products( $comment->user_id );
			
			foreach ( $products as $p ) {
				if ( $p['product_id'] == $comment->comment_post_ID && it_exchange_transaction_is_cleared_for_delivery($p['transaction_id']) ) {
					return intval( $p['count'] );
				}
			}
		}

		return intval( $purchases );
	}

	function add_discussion_mb() {
		add_meta_box( 'commentsstatusdiv', __( 'Reviews' ), 'post_comment_status_meta_box', $this->post_type, 'it_exchange_side', 'low' );
	}
	
	function it_exchange_custom_extend_product_theme_api( $result, $class, $tag ) {
		// We don't want this happening in the admin
		if ( is_admin() ) {
			return;	
		}
		
		if ( 'IT_Theme_API_Product'== $class ) {
			
			switch ( $tag ) {
				case 'rating':
					$result = array($this, 'rating'); 
					break;
				case 'reviews':
					$result = array($this, 'show_reviews');
					break;
				case 'review-form':
					$result = array($this, 'review_form');
					break;
			}
		}   
		
		return $result;
	}

	function rating( $result, $options = array() ) {

		$CGD_EER_Core = CGD_EER_Core::getInstance();
		$product_id = it_exchange_get_the_product_id();

		$defaults = array(
			'hide_no_rating' => 'true',
			'min_rating' => '1'
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

	function show_reviews( $result, $options = array() ) {
	
		ob_start();
		comments_template( '', true );
		return ob_get_clean();
	}

	function review_form( $result, $options = array() ) {

		ob_start();
		$product_id = it_exchange_get_the_product_id();

		comment_form( array( 'format' => 'html5' ), $product_id );

		return ob_get_clean();
	}
	
	function instructions() {
		?>
		<h4>Add Average Rating to Product Loop</h4>
		<p>To add an average rating star widget to your product loop, add the following anywhere you would like in your template.</p>
		<code>
		it_exchange('product', 'rating');
		</code>
		
		<h4>Show Reviews</h4>
		<p>If for some reason you want to show a products reviews somewhere other than the default theme location, you can use this.</p>
		<code>
		it_exchange('product', 'reviews');
		</code>
		
		<h4>Review Form</h4>
		<p>Similar to above, show the review form.</p>
		<code>
		it_exchange('product', 'review-form');
		</code>
		<p></p>
		<?php
	}
}

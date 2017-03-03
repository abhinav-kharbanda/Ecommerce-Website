<?php

class CGD_EER_WPEC {
	var $post_type = "wpsc-product";

	public function __construct() {
		add_filter( 'cgd_eer_product_post_types', array( $this, 'add_post_type' ) );
		add_filter( 'cgd_eer_wpec_product_post_types', array( $this, 'add_post_type' ) );
		add_filter( 'cgd_eer_wpec_verified_purchases', array( $this, 'verified_purchases' ), 10, 3);
		add_action( 'registered_post_type', array( $this, 'add_comments_support' ), 10, 1 );
		add_filter( 'wp_insert_post_data', array( $this,'wpsc_pre_update' ), 100, 2 );
		
		add_action('cgd_eer_wpec_instructions', array($this, 'instructions') );
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

		$purchase_table = WPSC_TABLE_PURCHASE_LOGS;
		$purchased_table = WPSC_TABLE_CART_CONTENTS;

		if ( $comment->user_id !== 0 ) {
			$query = $wpdb->prepare( "SELECT COUNT(pr.id) FROM $purchase_table pr LEFT JOIN $purchased_table pd ON pd.purchaseid = pr.id WHERE pd.prodid = %d AND pr.user_ID = %d", $comment->comment_post_ID, $comment->user_id );

			$purchases = $wpdb->get_var( $query );
		}

		return intval( $purchases );
	}

	function add_comments_support( $post_type ) {
		if ( $post_type === $this->post_type ) {
			add_post_type_support( $post_type, 'comments' );
		}
	}

	function wpsc_pre_update( $data , $postarr ) {
		if ( isset( $_REQUEST['comment_status'] ) ) {
			$data["comment_status"] = $_REQUEST['comment_status'];
		}

		return $data;
	}

	function rating( $options ) {

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
		<div id="cgd_eer_wpec_product_rating" class="cgd_eer_wpec_static_rating" data-rating='<?php echo $rating; ?>'></div>
		<?php
		return ob_get_clean();
	}

	function show_reviews( $result, $options ) {
		ob_start();
		
		comments_template( '', true );
		
		return ob_get_clean();
	}

	function review_form( $result, $options ) {
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
		cgd_eer_wpec_print_rating();
		</code>
		
		<h4>Show Reviews</h4>
		<p>If for some reason you want to show a products reviews somewhere other than the default theme location, you can use this.</p>
		<code>
		cgd_eer_wpec_print_reviews();
		</code>
		
		<h4>Review Form</h4>
		<p>Similar to above, show the review form.</p>
		<code>
		cgd_eer_wpec_print_review_form();
		</code>
		<p></p>
		<?php
	}
}

function cgd_eer_wpec_rating( $options = array() ) {
	return CGD_EER_WPEC::rating($options);
}

function cgd_eer_wpec_print_rating( $options = array() ) {
	echo cgd_eer_wpec_rating($options);
}

function cgd_eer_wpec_reviews( $options = array() ) {
	return CGD_EER_WPEC::show_reviews($options);
}

function cgd_eer_wpec_print_reviews( $options = array() ) {
	echo cgd_eer_wpec_reviews($options);
}

function cgd_eer_wpec_review_form( $options = array() ) {
	return CGD_EER_WPEC::review_form($options);
}

function cgd_eer_wpec_print_review_form( $options = array() ) {
	echo cgd_eer_wpec_review_form($options);
}

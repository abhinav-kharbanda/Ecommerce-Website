<?php

class CGD_EER_Shopp {
	var $post_type = "shopp_product";

	public function __construct(){
		add_filter( 'cgd_eer_product_post_types', array( $this, 'add_post_type' ) );
		add_filter( 'cgd_eer_verified_purchases', array( $this, 'verified_purchases' ), 10, 3);

		// Comment form
		add_filter( 'comment_form_defaults', array( $this, 'custom_comment_form' ), 51 );

		// Theme API
		add_filter( 'shopp_themeapi_product_rating', array( $this, 'rating' ), 10, 3 );
		add_filter( 'shopp_themeapi_product_reviews', array( $this, 'show_reviews' ), 10, 3 );
		add_filter( 'shopp_themeapi_product_reviewform', array( $this, 'review_form' ), 10, 3 );
		
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
		global $wpdb;
		
		$purchase_table = ShoppDatabaseObject::tablename(ShoppPurchase::$table );
		$purchased_table = ShoppDatabaseObject::tablename(ShoppPurchased::$table );
		$user_id_where = "";

		if ( $comment->user_id !== 0 ) {
			$Customer = shopp_customer( $comment->user_id, 'wpuser' );

			if ( $Customer !== false ) {
				$user_id_where = "OR pr.customer = {$Customer->id}";
			}

			unset( $Customer );
		}

		$query = $wpdb->prepare( "SELECT COUNT(pr.id) FROM $purchase_table pr LEFT JOIN $purchased_table pd ON pd.purchase = pr.id WHERE pd.product = %d AND (pr.email = %s $user_id_where)", $comment->comment_post_ID, $comment->comment_author_email );

		$purchases = $wpdb->get_var( $query );
		return intval( $purchases );
	}

	function custom_comment_form( $args ) {
		$current_user = wp_get_current_user();
		
		if ( shopp( 'customer','get-first-name','mode=value' ) != "" ) {
			$name = shopp( 'customer','get-first-name','mode=value' ) . ' ' . shopp( 'customer','get-last-name','mode=value' );
		}
		
		if ( empty($name) ) $name = $current_user->user_login;

		if ( shopp_setting( 'account_system' ) == "wordpress" ) {
			$args['logged_in_as']	= '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), shopp( 'customer','get-account-url' ), $name, shopp( 'customer','get-account-url' ) . "?logout" ) . '</p>';
		}
		
		return $args;
	}

	function rating( $result, $options = array(), $Product ) {
		$CGD_EER_Core = CGD_EER_Core::getInstance();
		
		$defaults = array(
			'hide_no_rating' => 'true',
			'min_rating'     => '1'
		);

		$options = array_merge( $defaults, $options );
		extract( $options );

		$rating = $CGD_EER_Core->get_post_rating( $Product->id );

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

	function show_reviews( $result, $options = array(), $Product ) {
		ob_start();
		
		comments_template( '', true );
		
		return ob_get_clean();
	}

	function review_form( $result, $options = array(), $Product ) {
		ob_start();

		comment_form( array( 'format' => 'html5' ), $Product->id );

		return ob_get_clean();
	}
	
	function instructions() {
		?>
		<h4>Add Average Rating to Product Loop</h4>
		<p>To add an average rating star widget to your product loop, add the following anywhere you would like in your template.</p>
		<code>
		shopp('product', 'rating');
		</code>
		
		<h4>Show Reviews</h4>
		<p>If for some reason you want to show a products reviews somewhere other than the default theme location, you can use this.</p>
		<code>
		shopp('product', 'reviews');
		</code>
		
		<h4>Review Form</h4>
		<p>Similar to above, show the review form.</p>
		<code>
		shopp('product', 'review-form');
		</code>
		<p></p>
		<?php
	}
}

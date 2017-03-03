<?php

class CGD_EER_Admin {

	function start() {
		$CGD_EasyEcommerceReviews = CGD_EasyEcommerceReviews::getInstance();
		
		// Mailing list subscribe
		add_action( $CGD_EasyEcommerceReviews->prefix . '_settings_saved', array( $this, 'subscribe_to_list') );
		
		// Admin menu
		add_action( 'admin_menu', array( $this, 'add_menu' ) );

		// Comment Management
		add_filter( 'manage_edit-comments_columns', array( $this, 'add_review_column' ) );
		add_filter( 'manage_comments_custom_column', array( $this, 'populate_review_column' ), 10, 2 );
		add_filter( 'comment_status_links', array($this, 'add_review_status'), 10, 1 );
		
		if ( isset($_REQUEST['comment_status']) && $_REQUEST['comment_status'] == 'review') {
			add_action('pre_get_comments', array($this, 'filter_review_status'), 10, 1);	
		}
	}

	function add_menu() {
		global $submenu;
		
		add_menu_page('Easy E-commerce Reviews Lite', 'Easy E-commerce Reviews Lite', 'edit_posts', 'easy-ecommerce-reviews', array($this, 'admin_info_page'), 'dashicons-star-half', '26.6');
		add_submenu_page( 'easy-ecommerce-reviews', "Easy E-commerce Reviews", "About", "manage_options", "easy-ecommerce-reviews", array( $this, "admin_info_page" ), 18);
		add_submenu_page( 'easy-ecommerce-reviews', "Easy E-commerce Reviews Settings", "Settings", "manage_options", "cgd_eer", array( $this, "admin_page" ), 20 );
		
		$submenu[ 'edit-comments.php' ][500] = array( __('Product Reviews'), 'edit_posts', 'edit-comments.php?comment_status=review' );
		$submenu[ 'easy-ecommerce-reviews' ][19] = array( __('Product Reviews'), 'edit_posts', 'edit-comments.php?comment_status=review' );
	}
	
	function admin_info_page() {
		include( CGD_EER_PATH . '/cgd-eer-admin-about.php' );
	}

	function admin_page() {
		include( CGD_EER_PATH . '/cgd-eer-admin.php' );
	}

	function add_review_column( $columns ) {
		$response_column = $columns['response'];
		unset( $columns['response'] );

		$columns['cgd_eer_rating'] = __( 'Review Rating' );
		$columns['cgd_eer_verified_purchase'] = __( 'Verified Purchase' );
		$columns['response'] = $response_column;

		return $columns;
	}

	function populate_review_column( $column, $comment_id ) {
		if ( 'cgd_eer_rating' === $column ) {
			$rating = get_comment_meta( $comment_id, 'cgd_eer_rating', true );
			if ( ! empty( $rating) ) {
				echo "<div class='cgd_eer_comment_rating cgd_eer_static_rating' data-rating='$rating'></div>";
			}
		}
		elseif ( 'cgd_eer_verified_purchase' === $column ) {
			$verified = get_comment_meta( $comment_id, 'cgd_eer_verified_purchaser', true );
			if ( intval( $verified ) > 0 ) {
				echo "Yes";
			}
		}
	}
	
	function add_review_status($status_links) {
		global $wpdb;
		
		$status = 'review';
		$count = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->comments} comments LEFT JOIN {$wpdb->commentmeta} AS cmeta ON comments.comment_ID = cmeta.comment_id WHERE cmeta.meta_key = 'cgd_eer_review'" );
		
		$label = _n_noop('Product Reviews <span class="count">(<span class="review-count">%s</span>)</span>', 'Product Reviews <span class="count">(<span class="review-count">%s</span>)</span>');
		$link = 'edit-comments.php';
		$link = add_query_arg( 'comment_status', $status, $link );
		
		$class = '';
		if ( isset($_REQUEST['comment_status']) && $_REQUEST['comment_status'] == $status ) $class = "current";
		
		$status_links[$status] = "<a href='$link' class='$class'>" . sprintf(
				translate_nooped_plural( $label, $count ),
				number_format_i18n( $count )
			) . '</a>';
		return $status_links;
	}
	
	function filter_review_status($comment_query) {
		global $submenu_file, $parent_file;
		
		$parent_file = "edit-comments.php?comment_status=review";
		$submenu_file = "edit-comments.php?comment_status=review";
		$comment_query->query_vars['meta_key'] = 'cgd_eer_review';
		$comment_query->query_vars['meta_value'] = 'true';
		$comment_query->meta_query = new WP_Meta_Query();
		$comment_query->meta_query->parse_query_vars( $comment_query->query_vars );
	}
	
	function subscribe_to_list() {
		$CGD_EasyEcommerceReviews = CGD_EasyEcommerceReviews::getInstance();
		if ( $CGD_EasyEcommerceReviews->get_setting( 'mailing_list_subscribe' ) !== "yes" ) return;
		
		$email = $CGD_EasyEcommerceReviews->get_setting('review_notice_recipient');
		
		$email = empty($email) ? get_option('admin_email') : $email;
		$email = trim( $email );
		
		if ( is_email($email) ) {
			$mailchimp = 'http://clifgriffin.us2.list-manage.com/subscribe/post?u=2b8f419ccd0352278e3485899&amp;id=49ad1e118b';
			$query = array(
				'body' => array(
					'EMAIL' => $email,
				),
			);
			wp_remote_post( $mailchimp, $query );	
		}
	}
}

<?php

class CGD_EER_Core {
	static $instance = false;

	public function __construct() {
		$CGD_EasyEcommerceReviews = CGD_EasyEcommerceReviews::getInstance();

		// Single Product
		add_action( 'wp', array( $this, 'product_hooks' ) );

		// Comment Updates
		add_action( 'comment_post', array( $this, 'save_review' ) );
		add_action( 'trash_comment', array( $this, 'update_rating' ) );
		add_action( 'wp_set_comment_status', array( $this, 'update_rating' ), 10, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ) );
		
		// Comment notifications
		add_filter('comment_notification_recipients', array($this, 'override_comment_email'), 10, 2);
	}

	public static function getInstance() {
		if ( !self::$instance ) {
		  self::$instance = new self;
		}
		return self::$instance;
	}

	function product_hooks() {
		$CGD_EasyEcommerceReviews = CGD_EasyEcommerceReviews::getInstance();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		if ( $this->is_product() && ! is_admin() ) {
			add_filter( 'comment_form_defaults', array( $this, 'comment_form_args' ), 50, 1 );
			add_filter( 'comment_form_default_fields', array( $this, 'modify_comment_fields' ) );
			add_filter( 'genesis_title_comments', array( $this, 'update_comments_list_title' ) ); // Genesis Specific
			
			if ( $CGD_EasyEcommerceReviews->get_setting( 'enable_rating' ) == "yes" ) {
				add_filter( 'comment_form_field_comment', array( $this, 'add_review_stars_input' ), 100 );
				add_filter( 'comment_text', array( $this, 'show_rating_on_review' ) );
			}
			
			// Add review class to comments
			add_filter('comment_class', array($this, 'add_class_to_review_comments') );
			
			// Disable JetPack Comments	
			if ( class_exists('Jetpack_Comments') ) {
				$jpc = Jetpack_Comments::init();	
				
				remove_action( 'comment_form_before', array( $jpc, 'comment_form_before' ) );
				remove_action( 'comment_form_after',  array( $jpc, 'comment_form_after'  ) );

				// Before a comment is posted
				remove_action( 'pre_comment_on_post', array( $jpc, 'pre_comment_on_post' ), 1 );

				// After a comment is posted
				remove_action( 'comment_post', array( $jpc, 'add_comment_meta' ) );
			}
			
			if ( class_exists('Jetpack_Subscriptions') ){
				$jps = Jetpack_Subscriptions::init();
				
				// Set up the comment subscription checkboxes
				remove_action( 'comment_form', array( $jps, 'comment_subscribe_init' ) );
	
				// Catch comment posts and check for subscriptions.
				remove_action( 'comment_post', array( $jps, 'comment_subscribe_submit' ), 50, 2 );	
			}
			
			do_action('cgd_eer_product_hooks');
		}
	}

	function is_product( $post_id = false ) {

		$valid_post_types = apply_filters( 'cgd_eer_product_post_types', array() );

		$valid = false;

		if ( $post_id !== false ) {
			$post = get_post($post_id);
			
			if ( in_array( $post->post_type, $valid_post_types ) ) {
				$valid = true;
			}
		} 
		
		if ( ! $valid && in_array( get_post_type(), $valid_post_types ) ) {
			$valid = true;
		}

		$valid = apply_filters( 'cgd_eer_is_product', $valid );

		return $valid;
	}

	/* Action / Filter Callbacks */
	function enqueue_scripts() {
		$this->load_scripts();
	}

	function save_review( $new_comment_id ) {
		global $wpdb;
		
		$comment = get_comment( $new_comment_id );
		
		if ( ! $this->is_product($comment->comment_post_ID) ) return;
		
		$rating = $_REQUEST['review_rating_input'];
		
		add_comment_meta( $new_comment_id, 'cgd_eer_review', 'true', true );
		
		if ( ! empty( $rating) && $rating > 0 ) {
			add_comment_meta( $new_comment_id, 'cgd_eer_rating', $rating, true );
		}

		$purchases = apply_filters( 'cgd_eer_verified_purchases', 0, $comment );
		add_comment_meta( $new_comment_id, 'cgd_eer_verified_purchaser', $purchases, true );
		
		// In case comment approval is immediate
		$this->update_post_rating( $comment->comment_post_ID );
		
		do_action_ref_array('cgd_eer_save_review', $comment);
		
		unset( $comment);
	}

	function update_rating( $comment_id ) {

		$comment = get_comment( $comment_id );

		$this->update_post_rating( $comment->comment_post_ID );
		unset( $comment );
	}

	function comment_form_args( $args ) {

		global $post;
		$post_id = $post->ID;
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$name = $user_identity;

		$args['title_reply']	= __( 'Leave a Review' );
		$args['logged_in_as']	= '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>';
		$args['comment_field']	= '<p class="comment-form-comment"><label for="comment">' . _x( 'Review', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
		$args['comment_notes_after'] = '';
		$args['label_submit'] = __( 'Submit Review' );
		return $args;
	}

	function modify_comment_fields( $fields ) {
		unset( $fields['url'] );
		return $fields;
	}

	function add_review_stars_input( $comment_field ) {
		ob_start();
		?>
		<p>
			<label>Rating:</label>
			<span id="review_stars_setter"></span>
			<input type="hidden" id="review_rating_input" name="review_rating_input" value="" />
		</p>
		<?php

		return $comment_field . ob_get_clean();
	}

	function update_comments_list_title( $title ) {
		return "<h3>Reviews</h3>";
	}

	function get_post_rating ( $post_id = false ) {
		if ( $post_id === false ) {
			global $post;
			$post_id = $post->ID;
		}
		
		return floatval( get_post_meta( $post_id, '_cgd_eer_avg_rating', true ) );
	}

	function update_post_rating( $post_id = false ) {
		global $post, $wpdb;

		if ( $post_id === false ) {
			$post_id = $post->ID;
		}

		$query = "SELECT AVG(cm.meta_value ) as post_rating " .
				 "FROM {$wpdb->prefix}comments c " .
				 "LEFT JOIN {$wpdb->prefix}commentmeta cm ON c.comment_ID = cm.comment_id " .
				 "WHERE c.comment_post_ID = %d " .
				 "AND c.comment_approved = %d " .
				 "AND cm.meta_key = %s " .
				 "GROUP BY c.comment_post_ID";

		$result = $wpdb->get_var( $wpdb->prepare( $query, $post_id, 1, 'cgd_eer_rating' ) );

		if ( ! empty( $result) ) {
			update_post_meta( $post_id, '_cgd_eer_avg_rating', $result );
		} else {
			update_post_meta( $post_id, '_cgd_eer_avg_rating', 0 );
		}
	}

	function load_scripts() {
		wp_enqueue_script( 'jquery-raty', plugins_url( 'lib/jquery.raty.min.js', dirname( __FILE__ ) ), array( 'jquery' ) );
		wp_enqueue_script( 'cgd-eer', plugins_url( 'js/cgd_eer.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-raty' ) );
		wp_localize_script( 'cgd-eer', 'CGD_EER_Helper', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'path' => plugins_url( 'lib/img/', dirname( __FILE__ ) ) ) );

		// Frontend styling
		if ( ! is_admin() ) {
			wp_enqueue_style( 'cgd-eer-css', plugins_url( 'css/cgd-eer.css', dirname( __FILE__ ) ) );
		}
	}

	function load_admin_scripts( $hook ) {

		if ( $hook !== 'edit-comments.php' ) {
			return;
		}

		$this->load_scripts();
	}

	function show_rating_on_review( $comment_text ) {

		$comment_id = get_comment_ID();
		$rating = get_comment_meta( $comment_id, 'cgd_eer_rating', true );

		if ( ! empty( $rating ) ) {
			$comment_text .= "<div class='cgd_eer_comment_rating cgd_eer_static_rating' data-rating='$rating'></div>";
		}

		return $comment_text;
	}
	
	function override_comment_email($emails, $comment_id) {
		$CGD_EasyEcommerceReviews = CGD_EasyEcommerceReviews::getInstance();
		
		$comment = get_comment( $comment_id );
		
		if ( $this->is_product($comment->comment_post_ID) ) {
			$email = $CGD_EasyEcommerceReviews->get_setting('review_notice_recipient');
			$email = trim ( $email );
			
			if ( is_email($email) ) {
				return array($email);
			}
		}
		
		return $emails;
	}
	
	function add_class_to_review_comments($classes) {
		$classes[] = 'eer-review';
		
		return $classes;
	}
}

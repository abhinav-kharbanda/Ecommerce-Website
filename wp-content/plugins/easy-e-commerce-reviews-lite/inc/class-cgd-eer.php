<?php

class CGD_EasyEcommerceReviews extends WordPress_SimpleSettings {
	var $updater;
	var $prefix;
	var $adminslug;
	var $_plugin_path; // iThemes Workaround
	var $primary_system;
	
	static $instance = false;

	function __construct() {
		$this->adminslug = 'setup-cgd-reviews';
		$this->prefix = "_cgd_eer_";

		parent::__construct();
	}

	public static function getInstance () {
		if ( ! self::$instance ) {
		  self::$instance = new self;
		}
		return self::$instance;
	}

	function start() {
		if ( $this->get_setting('version') !=  CGD_EER_VERSION )  $this->activate( true );
		
		add_action('admin_init', array($this, 'maybe_redirect_to_settings') );
		
		require( 'class-core.php' );
		$CGD_EER_Core = CGD_EER_Core::getInstance();
		
	    
		// Detect E-commerce Systems 
		// and load system classes
				
		// Shopp
		if ( class_exists( 'Shopp' ) && ! class_exists( 'CGD_EER_Shopp' ) ) {
			include( dirname( __FILE__ ) . '/systems/class-shopp.php' );
			$CGD_EER_Shopp = new CGD_EER_Shopp();
			$this->primary_system = "Shopp";
		}

		// iThemes Exchange
		if ( class_exists( 'IT_Exchange' ) && ! class_exists( 'CGD_EER_ITX' ) ) {
			global $IT_Exchange;
			
			if ( ! interface_exists('IT_Theme_API') ) {
				$this->_plugin_path = $IT_Exchange->_plugin_path;
				include( $IT_Exchange->_plugin_path . 'api/theme.php' );
			}
			
			include( dirname( __FILE__ ) . '/systems/class-itx.php' );
			$CGD_EER_ITX = new CGD_EER_ITX();
			$this->primary_system = "iThemes Exchange";
		}
		
		// wpEcommerce
		if ( class_exists( 'WP_eCommerce' ) && ! class_exists( 'CGD_EER_WPEC' ) ) {
			include( dirname( __FILE__ ) . '/systems/class-wpec.php' );
			$CGD_EER_WPEC = new CGD_EER_WPEC();
			$this->primary_system = "WP eCommerce";
		}
		
		// EDD
		if ( class_exists( 'Easy_Digital_Downloads' ) && ! class_exists( 'CGD_EER_EDD' ) ) {
			include( dirname( __FILE__ ) . '/systems/class-edd.php' );
			$CGD_EER_EDD = new CGD_EER_EDD();
			$this->primary_system = "Easy Digital Downloads";
		}
		
		// Jigo
		if ( defined( 'JIGOSHOP_VERSION' ) && ! class_exists( 'CGD_EER_Jigo' ) ) {
			include( dirname( __FILE__ ) . '/systems/class-jigo.php' );
			$CGD_EER_Jigo = new CGD_EER_Jigo();
			$this->primary_system = "Jigo";
		}
			
		// WooCommerce
		if ( class_exists( 'WooCommerce' ) && ! class_exists( 'CGD_EER_WooCommerce' ) ) {
			include( dirname( __FILE__ ) . '/systems/class-woocommerce.php' );
			$CGD_EER_WooCommerce = new CGD_EER_WooCommerce();
			$this->primary_system = "WooCommerce";
		}
	}

	function activate( $updating = false ) {
		$this->add_setting( 'enable_rating', 'yes' );
		$this->add_setting( 'require_rating', 'no' );
		$this->add_setting( 'verified_purchaser', 'no' );
		$this->add_setting( 'show_verified', 'yes' );
		$this->add_setting( 'show_feedback', 'yes' );
		$this->add_setting( 'feedback_intro', 'Was this review helpful?' );
		$this->add_setting( 'feedback_thankyou', 'Thank you for your feedback.' );
		$this->add_setting('review_notice_recipient', get_option('admin_email') );
		$this->add_setting('mailing_list_subscribe', 'undetermined' );
		
		if ( $updating ) {
			$current_version = $this->get_setting('version');
			
			if ( $current_version !== false && version_compare($current_version, '1.0.9') == -1  ) {
				// run upgrader for post meta
				global $wpdb;
				
				$wpdb->query("UPDATE {$wpdb->postmeta} SET meta_key = '_cgd_eer_avg_rating' WHERE meta_key = 'cgd_eer_avg_rating'");
				wp_cache_flush();
			}
		}
		
		$this->update_setting('version', CGD_EER_VERSION);
		
		if ( is_admin() ) $this->update_setting( 'redirect_to_settings', 'yes' );
	}

	function deactivate() {}
	
	function maybe_redirect_to_settings() {
		if ( $this->get_setting('redirect_to_settings') != "yes" ) return;
		
		$this->update_setting( 'redirect_to_settings', 'no' );
		
		wp_redirect( admin_url('admin.php?page=easy-ecommerce-reviews'), 302);
		exit();
	}
}

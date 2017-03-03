<?php
/**
* Plugin Name: Easy E-commerce Reviews Lite
* Version: 1.0.13
* Author: CGD, Inc.
* Author URI: http://cgd.io
* Description: Instantly add reviews and ratings to your favorite e-commerce plugin.
*
*------------------------------------------------------------------------
* Copyright 2009-2014 CGD Inc.
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

define( 'CGD_EER_VERSION', '1.0.13' );
define('CGD_EER_NAME', 'Easy E-commerce Reviews');
define('CGD_EER_URL', 'http://cgd.io');
define('CGD_EER_AUTHOR', 'CGD Inc.');
define('CGD_EER_PATH', dirname(__FILE__) );

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/* WordPress Simple Settings */
if ( ! class_exists( 'WordPress_SimpleSettings' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'lib/wordpress-simple-settings.php' );
}

/* Helper Functions */
require_once( plugin_dir_path( __FILE__ ) . 'inc/helpers.php' );

/* Main Plugin Class */
require_once( plugin_dir_path( __FILE__ ) . 'inc/class-cgd-eer.php' );
$CGD_EasyEcommerceReviews = CGD_EasyEcommerceReviews::getInstance();

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( $CGD_EasyEcommerceReviews, 'activate' ) );
register_deactivation_hook( __FILE__, array( $CGD_EasyEcommerceReviews, 'deactivate' ) );

/* Start The Main Plugin Class */
add_action( 'plugins_loaded', array( $CGD_EasyEcommerceReviews, 'start' ), 100 );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'inc/class-admin.php' );
	$CGD_EER_Admin = new CGD_EER_Admin();
	add_action( 'plugins_loaded', array( $CGD_EER_Admin, 'start' ), 101 );
}

<?php 

function hybrid_scripts_with_jquery()
{	
	wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery  
    	wp_register_script('jquery', ("http://code.jquery.com/jquery-1.11.0.min.js"), false);
    	wp_enqueue_script('jquery');
	
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap' );

	wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ) );
	wp_enqueue_script( 'fitvids' );
	
	wp_register_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'slicknav' );
	

	wp_register_script( 'template-hybrid', get_template_directory_uri() . '/js/template.js', array( 'jquery' ) );
	wp_enqueue_script( 'template-hybrid' );

	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2-respond-1.1.0.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'modernizr' );

	
}
add_action( 'wp_enqueue_scripts', 'hybrid_scripts_with_jquery' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
add_filter('woocommerce_login_redirect', 'wc_login_redirect');


// FOR REDIRECT URL AFTER LOGIN------------------------------------------------------ 
function wc_login_redirect( $redirect_to ) {
     $redirect_to = home_url();
     return $redirect_to;
}
//--------------------------------------------------------------------------------
function my_theme_wrapper_start() {
  echo '<div class="section">
	    	<div class="container">';
}

function my_theme_wrapper_end() {
  echo '</div>
	    	</div>';
}
add_theme_support( 'woocommerce' );

//FOR PRODUCTS PER PAGE --------------------------------------------------------------
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );


/*FOR SORTING BY MULTIPLE META VALUES ------------------------------------------------
 */
function customorderby($orderby) {
    return 'mt2.meta_value, mt3.meta_value DESC';
}

//FOR REMOVING LOGO ----------------------------------------------------

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(http://localhost/projects/repply/themes/logo.jpg);
}
        
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
//-------------------------------------------------------------------------
//FOR ADDING SHIPPING METHOD DISPLAY FORMAT

add_filter( 'woocommerce_shipping_settings', 'add_shipping_display_format_setting' );


function add_shipping_display_format_setting( $settings ) {



  $updated_settings = array();



  foreach ( $settings as $section ) {



    // at the bottom of the Shipping Settings Option

    if ( isset( $section['id'] ) && 'shipping_options' == $section['id'] &&

       isset( $section['type'] ) && 'sectionend' == $section['type'] ) {



      $updated_settings[] = array(

        	array(
			'title' => __( 'Shipping Display Mode', 'woocommerce' ),
			'desc' => __( 'This controls how multiple shipping methods are displayed on the frontend.', 'woocommerce' ),
			'id' => 'woocommerce_shipping_method_format',
			'default' => '',
			'type' => 'radio',
			'options' => array(
			'' => __( 'Display shipping methods with "radio" buttons', 'woocommerce' ),
			'select' => __( 'Display shipping methods in a dropdown', 'woocommerce' ),
			),
			'desc_tip' => true,
			'autoload' => false
			)

      );

    }



    $updated_settings[] = $section;

  }

  return $updated_settings;

}

//-----------------------------------------------------------------

?>



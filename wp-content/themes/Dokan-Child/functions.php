<?php
define('THEMEROOT', get_stylesheet_directory_uri());
function style() {
 wp_enqueue_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:400,700,300', false, null);
 wp_enqueue_style('Roboto Slab', 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700', false, null);
 
 wp_dequeue_style('bootstrap');
 wp_deregister_style('bootstrap');
 wp_enqueue_style('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', false, null);
 wp_enqueue_style('dokan-child-style', THEMEROOT . '/style.css', false, null);
}
add_action('wp_enqueue_scripts', 'style', 99);
function style_parent_override(){
  wp_dequeue_style('fontawesome');
  wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', false, null);
  wp_dequeue_style('dokan-opensans');
}
add_action('wp_enqueue_scripts', 'style_parent_override', 10);
function js_scripts() {
       wp_deregister_script('jquery'); // deregisters the default WordPress jQuery  
       wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false);
       wp_enqueue_script('jquery');
       wp_enqueue_script('jquery-ui-core');
       wp_enqueue_script('jquery-effects-core');
       wp_dequeue_script('bootstrap-min');
       wp_deregister_script('bootstrap-min');
       wp_enqueue_script('bootstrap','//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery') , false);
       wp_enqueue_script('modernizer', THEMEROOT . '/js/modernizr.custom.26633.js', array('jquery'));
       if (is_front_page()) {
         wp_enqueue_script('gridrotator', THEMEROOT . '/js/jquery.gridrotator.js', array('jquery'));
       }
       if (is_archive()) {
         wp_enqueue_script('skrollr', THEMEROOT . '/js/skrollr.js', array('jquery'), false);
         wp_enqueue_script('lazyload', THEMEROOT . '/js/jquery.lazyload.min.js', array('jquery'), false);
       }
       if(is_single())
       {
        wp_dequeue_script('wc-add-to-cart');
        wp_deregister_script('wc-add-to-cart');
        wp_enqueue_script('wc-add-to-cart', THEMEROOT. '/woocommerce/js/add-to-cart-dokan.js' , array( 'jquery' ), false, true);
        wp_localize_script( 'wc-add-to-cart', 'wc_add_to_cart_params', apply_filters( 'wc_add_to_cart_params', array(
          'ajax_url'                => WC()->ajax_url(),
          'ajax_loader_url'         => apply_filters( 'woocommerce_ajax_loader_url', '/images/ajax-loader@2x.gif' ),
          'cart_url'                => get_permalink( wc_get_page_id( 'cart' ) ),
          'is_cart'                 => is_cart(),
          'cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' )
          ) ) );
      }
      
      wp_enqueue_script('dokan_child', THEMEROOT . '/js/template.js', array('jquery'));
    }
    add_action('wp_enqueue_scripts', 'js_scripts',11);
    function load_js_in_footer() {
  //  https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.js
   // https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css
      ?> 
      <script type="text/javascript">
        <?php
        if (is_archive()) {
         ?>
         var s = skrollr.init({
           forceHeight: false
         });
         $("body.archive img.lazy").lazyload({
          effect : "fadeIn",
          threshold : 100
        });
         <?php
       } else if (is_front_page()) {
         ?>
         $(function() {
           $('#ri-grid').gridrotator({
             rows: 6,
             columns: 10,
             w980: {
               rows: 4,
               columns: 8
             },
             w320: {
               rows: 3,
               columns: 4
             },
             w240: {
               rows: 3,
               columns: 3
             },
             preventClick: false,
             step: 'random',
             maxStep: 10,
             animType: 'fadeInOut',
             animSpeed: 500,
             animEasingOut: 'linear',
             animEasingIn: 'linear',
             interval: 2000,
             slideshow: true,
             onhover: false
           });
         });
         <?php
       } 
       global $post;
       if ( get_query_var('edit') ||  $post->post_name=='add-product')
        { ?>
          $('.chosen-location').chosen({no_results_text: "Oops, nothing found!",
            max_selected_options: 3
          });
          <?php }
          ?> </script> 
          <?php
        }
        add_action('wp_footer', 'load_js_in_footer',100);
        function SearchFilter($query) {
         if ($query->is_search) {
           $query->set('post_type', 'product');
         }
         return $query;
       }
       add_filter('pre_get_posts', 'SearchFilter');
       add_filter('dokan_get_dashboard_nav', 'dokan_add_seller_nav');
       function dokan_add_seller_nav($urls) {
         global $current_user;
         $page = dokan_get_store_url($current_user->ID);
         $store = array('store' => array(
           'title' => __('Your Store', 'dokan'),
           'icon' => '<i class="fa fa-users"></i>',
           'url' => "$page"
           )
         );
         $urls = $store + $urls;
         return $urls;
       }
       add_filter('loop_shop_per_page', create_function('$cols', 'return 9;'), 20);
       function dokan_get_readable_seller_rating_child($seller_id) {
         $rating = dokan_get_seller_rating($seller_id);
         if (!$rating['count']) {
           return;
         }
         $width = ( $rating['rating'] / 5 ) * 100;
         ?>
         <span class="seller-rating">
           <span class="star-rating" itemtype="http://schema.org/Rating" itemscope="" itemprop="reviewRating">
             <span class="width" style="width: <?php echo $width; ?>%"></span>
             <span style=""><strong itemprop="ratingValue"><?php echo $rating['rating']; ?></strong></span>
           </span>
           <span class="text"><?php printf($rating['count'] == 1 ? '%d review' : '%d reviews', $rating['count']); ?></span>
         </span>
         <?php
       }
       remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
       function alter_comment_form_fields($fields) {
        $fields['must_log_in']="<p class='must-log-in'>You must be <a href='#' class='lbp-inline-link-1 cboxElement'>logged in</a> to post a comment </p>";
        return $fields;
      }
      add_filter('comment_form_defaults', 'alter_comment_form_fields');
      function redirect2homepage()
      {
        return get_bloginfo('url');
      }
      add_filter('login_redirect', 'redirect2homepage');
      function get_unique_post_meta_values( $key = '', $type = 'post', $status = 'publish' ) {
        global $wpdb;
        if( empty( $key ) )
          return;
        $res = $wpdb->get_col( $wpdb->prepare( "
          SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
          LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
          WHERE pm.meta_key = '%s'
          AND p.post_status = '%s'
          AND p.post_type = '%s'
          Order by pm.meta_value
          ", $key, $status, $type ) );
        return $res;
      }
/**
* start the customisation
*/
   /*  function my_searchwp_live_search_configs($configs) {
     // override some defaults
     $configs['default'] = array(
     'engine' => 'default', //search engine to use (if SearchWP is available)
     'input' => array(
     'delay' => 300, //wait 500ms before triggering a search
     'min_chars' => 2, //wait for at least 3 characters before triggering a search
     ),
     'results' => array(
     'position' => 'bottom', // where to position the results (bottom|top)
     'width' => 'auto', // whether the width should automatically match the input (auto|css)
     'offset' => array(
     'x' => 0, // x offset (in pixels)
     'y' => 8 // y offset (in pixels)
     ),
     ),
     'spinner' => array(//powered by http://fgnass.github.io/spin.js/
     'lines' => 10, //number of lines in the spinner
     'length' => 8, //length of each line
     'width' => 4, //line thickness
     'radius' => 8, //radius of inner circle
     'corners' => 1, // corner roundness (0..1)
     'rotate' => 0, // rotation offset
     'direction' => 1, // 1: clockwise, -1: counterclockwise
     'color' => '#000', //
     #rgb or #rrggbb or array of colors
     'speed' => 1, //rounds per second
     'trail' => 60, // afterglow percentage
     'shadow' => false, // whether to render a shadow
     'hwaccel' => false, // whether to use hardware acceleration
     'className' => 'spinner', // CSS class assigned to spinner
     'zIndex' => 2000000000, // z-index of spinner
     'top' => '50%', // top position (relative to parent)
     'left' => '50%', // left position (relative to parent)
     ),
     );
     return $configs;
     }
     add_filter('searchwp_live_search_configs', 'my_searchwp_live_search_configs');
    */
   // Display Fields
     ?> 

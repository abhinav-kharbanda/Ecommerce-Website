<?php 
if(isset($_COOKIE['location']) || isset($_POST['location']))
  { $GLOBALS['location']= (isset($_POST['location']) ? ($_POST['location']) : ($_COOKIE['location'])) ;
if(isset($_POST['location']))
 setcookie('location',$GLOBALS['location']);
}
else
  $GLOBALS['location']='';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php if(!isset($_GET['no_script'])) { ?> 
  <noscript>
    <meta http-equiv="refresh" content="0;url=<?php echo $_SERVER['REQUEST_URI'].'?no_script=1'?>" />
  </noscript>
  <?php } 
  else { ?>
  <script type="text/javascript">
    window.location.href="<?php echo $_SERVER['PHP_SELF'] ?>";
  </script> 
  <?php }
  ?>
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
        <![endif]-->
        <?php wp_head(); 
        
        
        ?>
      </head>
      <body <?php body_class(); ?>
        <?php do_action('before'); ?>
        <?php global $woocommerce; ?>
        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper clearfix">
          <div class="col-md-8 header-wrapper center">
            <hgroup>
              <div id="site-header" class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Logo" width="HERE" height="HERE" />
                </a>
              </div>
            </hgroup>		
            <nav class="navigation">
              <ul class="top_menu center">
               <?php wc_get_template_part('/includes/header_menu'); ?>
             </ul>
           </nav>
         </div>
         <!--------------------- LOGIN DIV ------------------------ -->
         <?php if (!$user_ID && !is_user_logged_in()) { ?>
         <div style="display:none"> 
           <div id="lbp-inline-href-1" style="padding: 0px; background: #fff;">
             <div class="col-sm-5">
               <div class="basic-login">
                 <form method="post" class="wp-user-form">
                   <?php do_action('woocommerce_login_form_start'); ?>								
                   <div class="form-group">
                     <label for="login-username"><i class="icon-user"></i> <b>Username or Email</b></label>
                     <input type="text" class="form-control" name="username" id="username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
                   </div>
                   <div class="form-group">
                     <label for="login-password"><i class="icon-lock"></i> <b>Password</b></label>
                     <input class="form-control" type="password" name="password" id="password" />
                     <?php do_action('woocommerce_login_form'); ?>
                   </div>
                   <div class="form-group">
                     <label class="checkbox">
                       <input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
                     </label>
                     <a href="<?php echo esc_url(wc_lostpassword_url()); ?>" class="forgot-password">Forgot password?</a>
                     <?php wp_nonce_field('woocommerce-login'); ?>
                     <input type="submit" class="btn btn-blue pull-right" name="login" value="<?php _e('Login'); ?>" tabindex="14"></input>
                     <div class="clearfix"></div>
                   </div>
                   <?php do_action('woocommerce_login_form_end'); ?>
                 </form>
               </div>
             </div>
             <div class="col-sm-7 social-login">
               <p>Or login with your Facebook or Twitter</p>
               <div class="social-login-buttons">
                 <a href="#" class="btn-facebook-login">Login with Facebook</a>
                 <a href="#" class="btn-twitter-login">Login with Twitter</a>
               </div>
               <div class="clearfix"></div>
               <div class="not-member">
                 <p>Not a member? <a class="lbp-inline-link-2 cboxElement" href="#">Register here</a></p>
               </div>
             </div>
           </div>
         </div>
                   <!---------------------------------------------------------------------
                   -------------------------REGISTER-------------------------------------->
                   <div style="display:none"> 
                     <div id="lbp-inline-href-2" style="padding: 0px; background: #fff;">
                       <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') { ?>
                       <div class="col-sm-5">
                         <div class="basic-login">
                           <form method="post" class="wp-user-form">
                             <?php do_action('woocommerce_register_form_start'); ?>
                             <?php if ('no' === get_option('woocommerce_registration_generate_username')) { ?>
                             <div class="form-group">
                               <label for="reg_username"><b>Username</b><span class="required">*</span></label>
                               <input type="text" class="form-control" name="username" id="reg_username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
                             </div>
                             <?php } ?>
                             <div class="form-group">
                               <label for="reg_email">Email<span class="required">*</span></label>
                               <input type="email" class="form-control" name="email" id="reg_email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
                             </div>
                             <?php do_action('woocommerce_login_form'); ?>
                             <?php if ('no' === get_option('woocommerce_registration_generate_password')) { ?>
                             <div class="form-group">
                               <label for="reg_password"><b>Password</b> <span class="required">*</span></label>
                               <input type="password" class="form-control" name="password" id="reg_password" />
                             </div>
                             <?php } ?>
                             <!-- Spam Trap -->
                             <div style="left:-999em; position:absolute;"><label for="trap"><?php _e('Anti-spam', 'woocommerce'); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
                             <?php do_action('woocommerce_register_form'); ?>
                             <?php do_action('register_form'); ?>
                             <?php wp_nonce_field('woocommerce-register', 'register'); ?>
                             <div class="form-group">
                               <input type="submit" class="btn btn-blue pull-right" name="register" value="<?php _e('Register'); ?>" tabindex="14"></input>
                               <div class="clearfix"></div>
                             </div>
                             <?php do_action('woocommerce_register_form_end'); ?>
                           </form>
                         </div>
                       </div>
                       <div class="col-sm-7 social-login">
                         <p>Or login with your Facebook or Twitter</p>
                         <div class="social-login-buttons">
                           <a href="#" class="btn-facebook-login">Login with Facebook</a>
                           <a href="#" class="btn-twitter-login">Login with Twitter</a>
                         </div>
                         <div class="clearfix"></div>
                         <div class="not-member">
                           <p>Already a Member? <a class="lbp-inline-link-1 cboxElement" href="#">Login</a></p>
                         </div>
                       </div>
                       <?php }
                     }
                     ?>
                   </div>
                 </div>
                 <?php /* ?>
       <!---------------------------------------------------------------------
       -------------------------LOCATION------------------------------------->
       <div style="display:none"> 
         <div id="lbp-inline-href-3" style="padding: 0px; background: #fff;">
          <div class="col-md-12">
            <?php
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
                ", $key, $status, $type ) );
              return $res; 
            }
            ?>
            <form action="" method="post" title="">
              <?php 
                $loc_possible = get_unique_post_meta_values('location','product'); ?>
                    <button class="location_input" type="submit" name="location" value=""><?php _e('All Locations') ?></button> 
               <?php foreach($loc_possible as $loc) {
                    if($loc!=''){
                    ?>
                    <button class="location_input" type="submit" name="location" value="<?php echo strtolower($loc) ?>"><?php echo ucfirst(strtolower($loc)) ?></button> 
                    <?php
                }}
              ?>
            </form>
          </div>
        </div>
      </div> ?<?php */?>
    </div> <!-- Mainmenu wrapper end -->
    <nav class="navigation-mob">
      <ul class="mob">
       <?php wc_get_template_part('/includes/header_menu'); ?>
     </ul>
   </nav>
   <div id="main" class="site-main">
    <div class="container content-wrap">
      <div class="row">

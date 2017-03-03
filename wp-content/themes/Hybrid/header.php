<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>

    <head>


    	<?php wp_head(); ?>

        <meta charset="utf-8" />        
        <meta http-ejquery fix footer to bottomquiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            <?php
            global $page, $paged;
            wp_title( '|', true, 'right' );
            // Add the blog name.
            bloginfo( 'name' );
            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
            ?>
        </title>        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
	<link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet" media="all" type="text/css" />
        
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
<?php global $woocommerce; ?>

        <!-- Navigation & Logo-->

        <div class="mainmenu-wrapper">
	        <div class="container">
			<div id="site-header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="Logo" width="HERE" height="HERE" />
				</a>


			</div>
					<nav class="navigation">
					<ul class="top_menu">
					<?php wp_list_pages('exclude=46&title_li='); ?>


					<?php global $user_ID, $user_identity, $display_name; 
					get_currentuserinfo(); 
					if (!$user_ID && !is_user_logged_in()) { ?>
					<li><a class="lbp-inline-link-1 cboxElement" href="#">Login</a></li>
					<li><a class="lbp-inline-link-2 cboxElement" href="#">Register</a></li>
					<?php } 
					else
					{?>

					<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">Hi! <?php echo $user_identity->user_firstname; ?></a></li>
					<li><a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a><li>
					<?php } ?>
			</ul>
				<a class="shopping-cart-items"href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><span class="glyphicon glyphicon-shopping-cart icon-white"></span></a>
                                <a class="search-button" ><span class="glyphicon glyphicon-search"></span></a>
                                <a class="mob_menu_button" ><span class="glyphicon glyphicon-align-justify"></span></a>

                                        
</nav>



		     <?php /*   <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"  rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
<!--<img src="<?php echo get_bloginfo('template_directory');?>/img/logo.png" alt="Multipurpose Twitter Bootstrap Template">-->
</a></li>
						              <?php wp_list_pages('exclude=46&title_li='); ?>
						
					</ul>
				</nav>
			</div>
		
*/ ?>
                    </div>

<!--------------------- LOGIN DIV ------------------------ -->
<?php if (!$user_ID && !is_user_logged_in()) { ?>
<div style="display:none"> 
<div id="lbp-inline-href-1" style="padding: 0px; background: #fff;">

					<div class="col-sm-5">
						<div class="basic-login">
							<form method="post" class="wp-user-form">
			<?php do_action( 'woocommerce_login_form_start' ); ?>								
<div class="form-group">
		        				 	<label for="login-username"><i class="icon-user"></i> <b>Username or Email</b></label>
									
<input type="text" class="form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />


								</div>
								<div class="form-group">
		        				 	<label for="login-password"><i class="icon-lock"></i> <b>Password</b></label>
									<input class="form-control" type="password" name="password" id="password" />
<?php do_action( 'woocommerce_login_form' ); ?>
								</div>
								<div class="form-group">
									<label class="checkbox">
<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
									</label>
									<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>" class="forgot-password">Forgot password?</a>
					<?php wp_nonce_field( 'woocommerce-login' ); ?>
									<input type="submit" class="btn pull-right" name="login" value="<?php _e('Login'); ?>" tabindex="14"></input>
									<div class="clearfix"></div>
								</div>
<?php do_action( 'woocommerce_login_form_end' ); ?>
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
	</div>
<nav class="navigation-mob">
					<ul class="mob">
					<?php wp_list_pages('exclude=46&title_li='); ?>


					<?php global $user_ID, $user_identity, $display_name; 
					get_currentuserinfo(); 
					if (!$user_ID && !is_user_logged_in()) { ?>
					<li><a class="lbp-inline-link-1 cboxElement" href="#">Login</a></li>
					<li><a class="lbp-inline-link-2 cboxElement" href="#">Register</a></li>
					<?php } 
					else
					{?>

					<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">Hi! <?php echo $user_identity->user_firstname; ?></a></li>
					<li><a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a><li>
					<?php } ?>
			</ul>
</nav>
        <div class="search_bar">
               
            
        </div>
<!---------------------------------------------------------------------

-------------------------REGISTER-------------------------------------->

<div style="display:none"> 
<div id="lbp-inline-href-2" style="padding: 0px; background: #fff;">
	    	
<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) { ?>
            <div class="col-sm-5">
                    <div class="basic-login">
                        <form method="post" class="wp-user-form">
                            <?php do_action( 'woocommerce_register_form_start' ); ?>
                            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) { ?>

                                <div class="form-group">
                                    <label for="reg_username"><b>Username</b><span class="required">*</span></label>
                                    <input type="text" class="form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
                                </div>

                            <?php } ?>

                            <div class="form-group">
                                <label for="reg_email">Email<span class="required">*</span></label>
                                <input type="email" class="form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
                            </div>

                            <?php do_action( 'woocommerce_login_form' ); ?>


                            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) { ?>

                                <div class="form-group">
                                    <label for="reg_password"><b>Password</b> <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password" id="reg_password" />
                                </div>

                            <?php } ?>
                                <!-- Spam Trap -->
                            <div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
                            <?php do_action( 'woocommerce_register_form' ); ?>
                            <?php do_action( 'register_form' ); ?>
                            <?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
                                <div class="form-group">
                                        <input type="submit" class="btn pull-right" name="register" value="<?php _e('Register'); ?>" tabindex="14"></input>
                                        <div class="clearfix"></div>
                                </div>
                            <?php do_action( 'woocommerce_register_form_end' ); ?>
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

                           

<?php } }?>
	    
	</div>
</div>

<!----------------------------------------------------------------->
 <?php get_template_part('home_video');?>

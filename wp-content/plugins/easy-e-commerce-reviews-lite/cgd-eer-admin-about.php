<?php 
global $CGD_EasyEcommerceReviews; 
$store = $CGD_EasyEcommerceReviews->primary_system;	
?>
<style>
.cgd-eer-license-wrap h2 {
	display: none;
}
</style>
<div class="wrap about-wrap">
	<img class="alignright" src="<?php echo plugins_url( 'images/logo.png', __FILE__ ); ?>" />
	<h1>Easy E-commerce Reviews</h1>
	
	<div class="about-text">Congratulations! You're now running Easy E-commerce Reviews Lite <?php echo CGD_EER_VERSION; ?>.</div>
	
	<h2 class="nav-tab-wrapper">
		<a href="<?php echo admin_url('admin.php?page=easy-ecommerce-reviews'); ?>" class="nav-tab <?php if ( ! isset($_REQUEST['section']) ) echo 'nav-tab-active'; ?>">
			<?php _e( 'About' ); ?>
		</a>
		<a href="<?php echo admin_url('admin.php?page=easy-ecommerce-reviews&section=changelog'); ?>" class="nav-tab <?php if ( isset($_REQUEST['section']) && $_REQUEST['section'] == "changelog") echo 'nav-tab-active'; ?>">
			<?php _e( 'Changelog' ); ?>
		</a>
	</h2>

	<?php if ( isset($_REQUEST['section']) && $_REQUEST['section'] == "changelog"): ?>
		<?php require('cgd-eer-admin-changelog.php'); ?>
	<?php else: ?>
	
		<?php do_action('cgd_eer_above_about_page'); ?>
		<p><b>NOTICE: You're running Easy E-commerce Reviews Lite! You're missing out on awesome pro features! <a target="_blank"  href="http://cgd.io/easy-e-commerce-reviews/">Click here for more information.</a></b>
		
		<h3>Getting Started</h3>
		
		<p>First things first! We've detected you're running <span class="highlight"><?php echo $store; ?></span>.  We've done the hard lifting to make sure products in <?php echo $store; ?> support reviews!</p>
		
		<h4>Enabling Reviews on Products</h4>
		
		<p>Depending on how your products are configured, they may or may not have reviews enabled on a per product basis. They will likely all be enabled or all be disabled. To enable reviews on a product, you should open the product for editing and look for the "Enable comments" checkbox. This will look like the normal comments metabox on your posts, because it is!</p>
		
		<h4>What else?</h4>
		
		<p>That's it really! After you've enabled reviews on a product, the review form will show up at the bottom of product pages. Woo hoo! If you want more control over how reviews work on your site, keep reading!</p>
		
		<h3>Configuration</h3>
	
		<p>You can control how reviews work on your site on the settings page. The settings page has the following options:</p>
		
		<ul>
			<li>Enable or disable star ratings on products.</li>
			<li><strike>Require ratings for all product reviews.</strike> &mdash; <a href="http://cgd.io/easy-e-commerce-reviews/">PRO ONLY!</a></li>
			<li><strike>Only accept reviews from verified customers.</strike> &mdash; <a href="http://cgd.io/easy-e-commerce-reviews/">PRO ONLY!</a></li>
			<li><strike>Show a badge on reviews from verified customers.</strike> &mdash; <a href="http://cgd.io/easy-e-commerce-reviews/">PRO ONLY!</a></li>
			<li><strike>Allow visitors to rate reviews as helpful or unhelpful.</strike> &mdash; <a href="http://cgd.io/easy-e-commerce-reviews/">PRO ONLY!</a></li>
			<li><strike>Set messaging for feedback controls.</strike>  &mdash; <a href="http://cgd.io/easy-e-commerce-reviews/">PRO ONLY!</a></li>
		</ul>
		
		<h4>That's great, but where are the settings?</h4>
		<p>
		 	<a class="button button-primary" href="<?php echo admin_url("admin.php?page=cgd_eer"); ?>">Manage Settings</a>
		</p>
		
		<h3>Theming</h3>
		
		<?php do_action('cgd_eer_instructions'); ?>	
	<?php endif; ?>
</div>

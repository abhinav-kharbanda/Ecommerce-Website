<?php  global $CGD_EasyEcommerceReviews; ?>
<div class="wrap">
	<h1>Easy E-commerce Reviews Lite Settings</h1>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<?php $CGD_EasyEcommerceReviews->the_nonce(); ?>
		
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row" valign="top">
					New Review Notices
					</th>
					<td>
						<input style="width: 25em;" type="text"name="<?php echo $CGD_EasyEcommerceReviews->get_field_name( 'review_notice_recipient' ); ?>" value="<?php echo $CGD_EasyEcommerceReviews->get_setting('review_notice_recipient'); ?>" /> <br/>
						Who should get notified of new product reviews? (Blank will use default comment behavior)
						<p>
							<input type="hidden" name="<?php echo $CGD_EasyEcommerceReviews->get_field_name( 'mailing_list_subscribe' ); ?>" value="no" />
							<label><input type="checkbox" name="<?php echo $CGD_EasyEcommerceReviews->get_field_name( 'mailing_list_subscribe' ); ?>" value="yes" <?php if ( $CGD_EasyEcommerceReviews->get_setting( 'mailing_list_subscribe' ) == "yes" || $CGD_EasyEcommerceReviews->get_setting( 'mailing_list_subscribe' ) == "undetermined" ) echo 'checked="checked"'; ?> />	Subscribe to mailing list. (No spam. Ever.)</label>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top">
						<label>Review Options</label>
					</th>
					<td>
						<input type="hidden" name="<?php echo $CGD_EasyEcommerceReviews->get_field_name( 'enable_rating' ); ?>" value="no" />
						<label><input type="checkbox" name="<?php echo $CGD_EasyEcommerceReviews->get_field_name( 'enable_rating' ); ?>" value="yes" <?php if ( $CGD_EasyEcommerceReviews->get_setting( 'enable_rating' ) == "yes" ) echo 'checked="checked"'; ?> />	Enable 5-star ratings on reviews?</label><br />
						
						<p>
							<a href="http://cgd.io/easy-e-commerce-reviews/" target="_blank" class="button button-secondary">Unlock Pro Features</a>
						</p>

						<?php do_action('cgd_eer_admin_review_options'); ?>
					</td>
				</tr>
				
				<?php do_action('cgd_eer_admin_settings_footer'); ?>
				
			</tbody>
		</table>

		<?php submit_button(); ?>
	</form>
	
	<?php do_action('cgd_eer_admin_below_settings'); ?>
</div>

<div id="social-setting" class="wrap">
	<h2><?php _e('Social Settings', 'ft-theme'); ?></h2>
	<form method="POST" action="options.php">
<?php
		settings_fields( 'social_settings_group' );
		do_settings_sections( 'social_settings_group' );
?>

		<h3><?php _e('Account Settings', 'ft-theme'); ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Account Settings', 'ft-theme'); ?></th>
				<td><fieldset id="account-set">
					<label for="social_account_facebook">Facebook</label>
					<input type="text" name="social_account_facebook" id="social_account_facebook" placeholder="<?php _e('Please enter Facebook account name or Profile URL', 'ft-theme'); ?>" value="<?php echo esc_attr(get_option('social_account_facebook')); ?>"><br />
					<label for="social_account_twitter">Twitter</label>
					<input type="text" name="social_account_twitter" id="social_account_twitter" placeholder="<?php _e('Please enter Twitter account name or Profile URL', 'ft-theme'); ?>" value="<?php echo esc_attr(get_option('social_account_twitter')); ?>"><br />
					<label for="social_account_gplus">Google+</label>
					<input type="text" name="social_account_gplus" id="social_account_gplus" placeholder="<?php _e('Please enter Google+ Profile URL / ID', 'ft-theme'); ?>" value="<?php echo esc_attr(get_option('social_account_gplus')); ?>"><br />
					<label for="social_account_instagram">Instagram</label>
					<input type="text" name="social_account_instagram" id="social_account_instagram" placeholder="<?php _e('Please enter Instagram account name or Profile URL', 'ft-theme'); ?>" value="<?php echo esc_attr(get_option('social_account_instagram')); ?>"><br />
					</fieldset>
				</td>
			</tr>
		</table>

		<h3><?php _e('Share Button Settings', 'ft-theme'); ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Official Button', 'ft-theme'); ?></th>
				<td><fieldset>
					<input type="checkbox" name="social_share_official" id="social_share_official" <?php if (get_option('social_share_official')) : echo 'checked'; endif; ?> />
					<label for="social_share_official"><?php _e('Use Official Share Button', 'ft-theme'); ?></label>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Services', 'ft-theme'); ?></th>
				<td><fieldset>
					<input type="checkbox" name="social_service_facebook" id="social_service_facebook" <?php echo (get_option('social_service_facebook')) ? 'checked' :  '' ?> />
					<label for="social_service_facebook"><span class="margin-right">Facebook</span></label>
					<input type="checkbox" name="social_service_twitter" id="social_service_twitter" <?php echo (get_option('social_service_twitter')) ? 'checked' :  '' ?> />
					<label for="social_service_twitter"><span class="margin-right">Twitter</span></label>
					<input type="checkbox" name="social_service_line" id="social_service_line" <?php echo (get_option('social_service_line')) ? 'checked' :  '' ?> />
					<label for="social_service_line"><span class="margin-right">Line</span></label>
					<input type="checkbox" name="social_service_gplus" id="social_service_gplus" <?php echo (get_option('social_service_gplus')) ? 'checked' :  '' ?> />
					<label for="social_service_gplus"><span class="margin-right">Google+</span></label>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Display at', 'ft-theme'); ?></th>
				<td><fieldset>
					<input type="checkbox" name="social_display_at_page" id="social_display_at_page" <?php echo (get_option('social_display_at_page')) ? 'checked' :  '' ?> />
					<label for="social_display_at_page"><span class="margin-right"><?php _e('Page', 'ft-theme'); ?></span></label>
					<input type="checkbox" name="social_display_at_post" id="social_display_at_post" <?php echo (get_option('social_display_at_post')) ? 'checked' :  '' ?> />
					<label for="social_display_at_post"><span class="margin-right"><?php _e('Post', 'ft-theme'); ?></span></label>
					<input type="checkbox" name="social_display_at_index" id="social_display_at_index" <?php echo (get_option('social_display_at_index')) ? 'checked' :  '' ?> />
					<label for="social_display_at_index"><span class="margin-right"><?php _e('Index', 'ft-theme'); ?></span></label>
					<input type="checkbox" name="social_display_at_frontpage" id="social_display_at_frontpage" <?php echo (get_option('social_display_at_frontpage')) ? 'checked' :  '' ?> />
					<label for="social_display_at_frontpage"><span class="margin-right"><?php _e('Front Page', 'ft-theme'); ?></span></label>
					</fieldset>
				</td>
			</tr>
		</table>

		<h3><?php _e('Facebook Settings', 'ft-theme'); ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Application ID', 'ft-theme'); ?></th>
				<td><fieldset>
					<input type="text" name="social_facebook_appid" id="social_facebook_appid" placeholder="<?php _e('Please enter Facebook Application ID', 'ft-theme'); ?>" value="<?php echo esc_attr(get_option('social_facebook_appid')); ?>"><br>
					</fieldset>
				</td>
			</tr>
		</table>

		<?php submit_button(); ?>
	</form>
</div>

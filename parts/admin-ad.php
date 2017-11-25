<div id="ad-setting" class="wrap">
	<h2><?php _e('Ad Settings', 'ft-theme'); ?></h2>
	<form method="POST" action="options.php">
<?php
		settings_fields( 'ad_settings_group' );
		do_settings_sections( 'ad_settings_group' );

		$facebook_id = get_option('ad_facebook_id');
		$facebook_name = get_option('ad_facebook_name');
?>

		<!-- <h3><?php _e('Ad Settings', 'ft-theme'); ?></h3> -->
		<table id="ad-settings-block" class="form-table <?php echo (empty($facebook_id)) ? 'disabled' : ''; ?>">
			<tr class="no-activate">
				<th scope="row"></th>
				<td><p class="description">
				<?php _e("It's necessary to log in to facebook to change advertisement settings.", 'ft-theme'); ?>
				</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="ad_hide"><?php _e('Hide Ad', 'ft-theme'); ?></label></th>
				<td><fieldset>
					<input type="checkbox" name="ad_hide" id="ad_hide" <?php echo (get_option('ad_hide')) ? 'checked' :  '' ?> />
					<label for="ad_hide"><span class="margin-right"><?php _e('Hide Ad', 'ft-theme'); ?></span></label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="ad_code_custom"><?php _e('Custom Ad code', 'ft-theme'); ?></label>
					<p class="description"><?php _e('Edit Ad code directly', 'ft-theme'); ?></p>
				</th>
				<td><fieldset>
					<?php
						$code = get_ad_code(false);
					?>
					<textarea name="ad_code_custom" id="ad_code_custom" placeholder="<?php echo _e('Please enter custom ad code here.', 'ft-theme') ?>" rows="10"><?php echo esc_attr($code); ?></textarea>
					</fieldset>
				</td>
			</tr>
			<tr class="activation">
				<th scope="row"><?php _e('Activation', 'ft-theme'); ?></th>
				<td><fieldset>
				<?php if (empty($facebook_id)) : ?>
					<input type="button" class="button-primary" name="facebook_connect" id="facebook_connect" value="&#xf09a;&emsp;<?php _e('Login with Facebook', 'ft-theme'); ?>" />&emsp;
				<?php else : ?>
					<input type="button" class="button-secondary" name="facebook_connect" id="facebook_disconnect" value="&#xf08b;&emsp;<?php _e('Logout from Facebook', 'ft-theme'); ?>" />&emsp;
					<p class="description">
						<?php _e("When you log out from facebook, advertisement settings becomes invalid.", 'ft-theme'); ?>
					</p>
				<?php endif; ?>
					<input type="hidden" name="ad_facebook_id" id="ad_facebook_id" value="<?php echo $facebook_id; ?>" />
					<input type="hidden" name="ad_facebook_name" id="ad_facebook_name" value="<?php echo $facebook_name; ?>" />
					</fieldset>
				</td>
			</tr>
		</table>

		<?php submit_button(); ?>
	</form>

</div>

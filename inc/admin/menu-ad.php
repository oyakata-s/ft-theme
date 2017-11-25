<?php

/*
 * 広告設定
 */

/*
 * 管理画面にメニュー追加
 */
function add_menu_ad_setting() {
	add_options_page(
		__('Ad Settings', 'ft-theme'),
		__('Ad Settings', 'ft-theme'),
		'manage_options',
		'ft_ad_options',
		'create_ad_options');
	add_action('admin_init', 'register_ad_settings');
}

/*
 * 設定項目登録
 */
function register_ad_settings() {
	register_setting('ad_settings_group', 'ad_facebook_id');
	register_setting('ad_settings_group', 'ad_facebook_name');
	register_setting('ad_settings_group', 'ad_hide');
	register_setting('ad_settings_group', 'ad_code_custom');
}

/*
 * 設定画面表示
 */
function create_ad_options() {
	if ( !current_user_can('manage_options') ) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	require TEMPLATE_DIR_PATH . '/parts/admin-ad.php';
}

/*
 * 広告コードを返す
 */
function get_ad_code($use_default = true) {
	$fbid = get_option('ad_facebook_id');
	$code = get_option('ad_code_custom');
	if (empty($fbid) || empty($code)) {
		if ($use_default) {
			$code = @file_get_contents(TEMPLATE_DIR_PATH . '/parts/google_ads.php');
		} else {
			$code = '';
		}
	}
	return $code;
}

/*
 * 広告を隠すかどうか判定
 */
function is_ad_hide() {
	$fbid = get_option('ad_facebook_id');
	$hide = false;
	if (!empty($fbid)) {
		$hide = get_option('ad_hide', false);
	}
	return $hide;
}

?>

<?php

/*
 * ソーシャル設定
 */

/*
 * 管理画面にメニュー追加
 */
function add_menu_social_setting() {
	add_options_page(
		__('Social Settings', 'ft-theme'),
		__('Social Settings', 'ft-theme'),
		'manage_options',
		'ft_social_options',
		'create_social_options');
	add_action('admin_init', 'register_social_settings');
}

/*
 * 設定項目登録
 */
function register_social_settings() {
	register_setting('social_settings_group', 'social_account_facebook');
	register_setting('social_settings_group', 'social_account_twitter');
	register_setting('social_settings_group', 'social_account_gplus');
	register_setting('social_settings_group', 'social_account_instagram');
	register_setting('social_settings_group', 'social_share_official');
	register_setting('social_settings_group', 'social_display_at_frontpage');
	register_setting('social_settings_group', 'social_display_at_page');
	register_setting('social_settings_group', 'social_display_at_post');
	register_setting('social_settings_group', 'social_display_at_index');
	register_setting('social_settings_group', 'social_service_facebook');
	register_setting('social_settings_group', 'social_service_twitter');
	register_setting('social_settings_group', 'social_service_gplus');
	register_setting('social_settings_group', 'social_service_line');
	register_setting('social_settings_group', 'social_facebook_appid');
}

/*
 * 設定画面表示
 */
function create_social_options() {
	if ( !current_user_can('manage_options') ) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	require TEMPLATE_DIR_PATH . '/parts/admin-social.php';
}

?>

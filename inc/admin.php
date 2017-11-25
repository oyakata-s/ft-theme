<?php

/*
 * 管理画面関連
 */
require_once TEMPLATE_DIR_PATH . '/inc/admin/customize-color.php';
require_once TEMPLATE_DIR_PATH . '/inc/admin/customize-sidebar.php';
require_once TEMPLATE_DIR_PATH . '/inc/admin/customize-slider.php';
require_once TEMPLATE_DIR_PATH . '/inc/admin/customize-noimage.php';
require_once TEMPLATE_DIR_PATH . '/inc/admin/menu-social.php';
require_once TEMPLATE_DIR_PATH . '/inc/admin/menu-ad.php';

/*
 * 定数定義
 */
define( 'NOIMAGE_URL', get_noimage_url() );

/*
 * 管理画面セットアップ
 */
function theme_admin_setup() {
	// メニュー追加
	add_action( 'admin_menu', 'add_menu_social_setting' );			// ソーシャル設定
	add_action( 'admin_menu', 'add_menu_ad_setting' );				// 広告設定

	// カスタマイズ追加
	add_action( 'customize_register', 'ft_customize_color_register' );		// 配色
	add_action( 'customize_register', 'ft_customize_sidebar_register' );	// サイドバー
	add_action( 'customize_register', 'ft_customize_slider_register' );		// スライダー
	add_action( 'customize_register', 'ft_customize_noimage_register' );	// NOIMAGE

	// 管理画面用style,script追加
	$hook_sfx = 'settings_page_ft_ad_options';
	add_action( 'admin_print_styles', 'add_admin_print_style' );
	add_action( 'admin_print_scripts-'.$hook_sfx, 'add_admin_print_script' );
	add_action( 'admin_enqueue_scripts', 'add_admin_enqueue_script' );

	// bodyにclassを追加してカスタマイズ反映
	add_filter( 'body_class', 'add_color_scheme' );
	add_filter( 'body_class', 'add_sidebar_setting' );
}
add_action( 'after_setup_theme', 'theme_admin_setup' );

/*
 * 設定値を取得
 */
function ft_get_option($key, $default = false) {
	$value = get_option($key, $default);
	if ($value && !empty($value)) {
		return $value;
	} else {
		return $default;
	}
}

/*
 * カスタマイズ設定値を取得
 */
function get_customize_option($option, $default = null) {
	$options = get_option('ft_customize_options', $default);
	if (!empty($options)) {
		return $options[$option];
	} else {
		return $default;
	}
}

/*
 * 管理画面のみ必要なscript出力
 */
function add_admin_print_script() {
?>
<script type='text/javascript'>
	var wp_hostname = "<?php echo parse_url(get_bloginfo('url'), PHP_URL_HOST); ?>";
	var fb_callback = '<?php echo rawurlencode(get_template_directory_uri() . "/inc/ad_callback.php"); ?>';
	var fb_logout = '<?php echo rawurlencode(get_template_directory_uri() . "/inc/ad_logout.php"); ?>';
</script>
<?php
}

/*
 * 管理画面のみ必要なstyle読み込み
 */
function add_admin_print_style() {
	wp_enqueue_style('fontawesome',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
		array(), '4.7.0', 'all');
	wp_enqueue_style( 'theme-admin',
		TEMPLATE_DIR_URI . '/css/admin-style.css',
		array(), get_theme_version(), 'all' );
}

/*
 * 管理画面のみ必要なJS読み込み
 */
function add_admin_enqueue_script() {
	wp_enqueue_script( 'jq-cookie',
		TEMPLATE_DIR_URI . '/js/jquery.cookie.js',
		array('jquery'), '1.4.1');
	wp_enqueue_script( 'theme-admin-script',
		TEMPLATE_DIR_URI . '/js/admin-script.js',
		array('jquery', 'jq-cookie'), get_theme_version());
}

?>

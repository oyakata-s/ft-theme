<?php
/*
 * テーマ初期化関連
 */

/*
 * 初期設定
 */
function theme_setup() {
	// グローバルナビ登録
	register_nav_menu('gnav', __('Global Navigation', 'ft-theme'));

	// カスタムヘッダー有効化
	$custom_header_defaults = array(
		'width'			=> 1280,
		'flex-width'	=> true,
		'flex-height'	=> true,
		'header-text'	=> false,	//ヘッダー画像上にテキストをかぶせる
	);
	add_theme_support('custom-header', $custom_header_defaults);

	// カスタムロゴ有効化
	$custom_logo_defaults = array(
		'height'	=> 200,
		'width'		=> 200,
		'flex-width' => true,
		'flex-height' => true,
	);
	add_theme_support('custom-logo', $custom_logo_defaults);

	// フォームのHTML5
	add_theme_support( 'html5', array( 'search-form', 'comment-form' ) );

	// タイトルタグ使用
	add_theme_support('title-tag');

	// アイキャッチ画像有効化
	add_theme_support('post-thumbnails');

	// script読込
	add_action( 'wp_enqueue_scripts', 'add_enqueue_jquery' );
	add_action( 'wp_enqueue_scripts', 'add_enqueue_scripts' );
	add_action( 'wp_print_styles', 'add_print_styles' );
	add_action( 'wp_head', 'add_ie_html5shiv' );
	add_action( 'wp_head', 'add_head_scripts' );
	add_action( 'wp_footer', 'add_footer_slider' );		// customize-slider.phpに定義

	// 多言語翻訳用
	load_theme_textdomain( 'ft-theme', TEMPLATE_DIR_PATH.'/languages');

	// wp_headの不要なタグ削除
	remove_action('wp_head', 'wp_generator');						// wordpressのバージョン
	remove_action('wp_head', 'rsd_link');							// 外部編集用
	remove_action('wp_head', 'wlwmanifest_link');					// Windows Live Writer編集用
	remove_action('wp_head', 'wp_shortlink_wp_head');				// 短縮リンク表示
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');	// 前へリンク、次へリンク
	remove_action('wp_head', 'feed_links_extra', 3);				//
	remove_action('wp_head', 'print_emoji_detection_script',7);		// 絵文字
	remove_action('wp_print_styles', 'print_emoji_styles');			// 絵文字
}
add_action( 'after_setup_theme', 'theme_setup' );

/*
 * jqueryの読み込み
 * wordpress標準を無効にし、cdnを利用する
 */
function add_enqueue_jquery() {
	/*
	 * 管理画面ではなにもしない
	 */
	if ( is_admin() ) {
		return;
	}

	// wordpress標準のjqueryを無効にし
	// cdnのjqueryを有効化
	wp_deregister_script('jquery');
	// wp_register_script('jquery',
		// 'http://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js',
		// array(), '2.2.4');
	wp_register_script('jquery',
		TEMPLATE_DIR_URI . '/js/jquery-2.2.4.min.js',
		array(), '2.2.4');
	wp_enqueue_script('jquery');
}

/*
 * js読み込み
 */
function add_enqueue_scripts() {
	/*
	 * 管理画面ではなにもしない
	 */
	if ( is_admin() ) {
		return;
	}

	// 登録
	wp_register_script('object-fit-image',
		TEMPLATE_DIR_URI . '/js/ofi.min.js',
		array('jquery'),
		'3.2.0');
	wp_register_script('custom-scrollbar',
		TEMPLATE_DIR_URI . '/js/CustomScrollbar/jquery.mCustomScrollbar.concat.min.js',
		array('jquery'),
		'3.1.13');
	wp_register_script('flexslider',
		TEMPLATE_DIR_URI . '/js/flexslider/jquery.flexslider-min.js',
		array('jquery'),
		'2.6.1');
	wp_register_script('swiper',
		TEMPLATE_DIR_URI . '/js/swiper/swiper.min.js',
		array('jquery'),
		'3.4.0');
	wp_register_script('streffect',
		TEMPLATE_DIR_URI . '/js/streffect/jquery.streffect.js',
		array('jquery'),
		'0.1');

	wp_register_script('theme-common',
		TEMPLATE_DIR_URI . '/js/common.js',
		array('jquery'),
		get_theme_version());
	wp_register_script('theme-canvas',
		TEMPLATE_DIR_URI . '/js/canvas.js',
		array('jquery'),
		get_theme_version(),
		true);	// in_footer

	// 適用
	wp_enqueue_script('object-fit-image');
	wp_enqueue_script('custom-scrollbar');
	wp_enqueue_script('swiper');
	wp_enqueue_script('streffect');
	wp_enqueue_script('theme-canvas');
	wp_enqueue_script('theme-common');
}

/*
 * css適用
 */
function add_print_styles() {

	// 登録
	wp_register_style('fontawesome',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
		array(), '4.7.0', 'all');
	wp_register_style('font-roboto',
		'https://fonts.googleapis.com/css?family=Roboto:700',
		array(), get_theme_version(), 'all');
	wp_register_style('custom-scrollbar',
		TEMPLATE_DIR_URI . '/js/CustomScrollbar/jquery.mCustomScrollbar.css',
		array(), '3.1.13', 'all');
	wp_register_style('flexslider',
		TEMPLATE_DIR_URI . '/js/flexslider/flexslider.css',
		array(), '2.6.1', 'all');
	wp_register_style('swiper',
		TEMPLATE_DIR_URI . '/js/swiper/swiper.min.css',
		array(), '3.4.0', 'all');
	wp_register_style('streffect',
		TEMPLATE_DIR_URI . '/js/streffect/jquery.streffect.css',
		array(), '0.1', 'all');

	wp_register_style('normalize',
		TEMPLATE_DIR_URI . '/css/normalize.css', array(), '2.1.2', 'all');

	wp_register_style('theme-color',
		TEMPLATE_DIR_URI . '/css/color.css',
		array(), get_theme_version(), 'all');
	wp_register_style('theme-common',
		TEMPLATE_DIR_URI . '/css/common.css',
		array('normalize', 'theme-color','custom-scrollbar', 'flexslider', 'streffect'),
		get_theme_version(), 'all');

	// 適用
	wp_enqueue_style('normalize');
	wp_enqueue_style('theme-common');
	wp_enqueue_style('theme-color');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('font-roboto');
	wp_enqueue_style('custom-scrollbar');
	wp_enqueue_style('swiper');
	wp_enqueue_style('streffect');
}

/*
 * html5shiv
 */
function add_ie_html5shiv() {
	$tag = '<!--[if lt IE9]>';
	$tag .= '<script src="' . TEMPLATE_DIR_URI . '/js/html5shiv.min.js"></script>';
	$tag .= '<script src="' . TEMPLATE_DIR_URI . '/js/respond.min.js"></script>';
	$tag .= '<![endif]-->';
	echo $tag;
}

/*
 * headerに出力するscript
 */
function add_head_scripts() {
?>
<script>
var home_url = '<?php echo get_bloginfo('url'); ?>';
var admin_url = '<?php echo get_bloginfo('url'); ?>/wp-admin';
var color_scheme = '<?php echo get_customize_option('color_scheme', 'color-default'); ?>';
</script>
<?php
}

?>

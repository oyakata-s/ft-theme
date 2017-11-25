<?php

/*
 * ウィジェットクラス読み込み
 */
require_once TEMPLATE_DIR_PATH . '/inc/class/ft-widget-recent-posts.php';
require_once TEMPLATE_DIR_PATH . '/inc/class/ft-widget-archives.php';
require_once TEMPLATE_DIR_PATH . '/inc/class/ft-widget-rss.php';

/*
 * ウィジェット設定
 */
function theme_widget_init() {

	// サイドバー登録
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Side Bar'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>',
	));

	// フッターナビ登録
	register_sidebar(array(
		'id' => 'footer-nav',
		'name' => __('Footer Nav'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>',
	));

	// 拡張ウィジェット登録
	register_widget('Ft_Widget_Archives');
	register_widget('Ft_Widget_Recent_Posts');
	register_widget('Ft_Widget_RSS');

	// ウィジェット出力カスタマイズ
	add_filter('wp_list_categories', 'custom_list_categories');
	add_filter('ft_get_archives', 'custom_get_archives');
}
add_action( 'widgets_init', 'theme_widget_init' );

/*
 * functions
 */

/*
 * アーカイブリンクリストの件数を
 * リンクの中に含める
 */
function custom_get_archives( $html ) {
	$pattern = '/<\/a>&nbsp;\(([0-9,]*)\)/';
	$replace = ' <span class="count">${1}</span></a>';
	return preg_replace( $pattern, $replace, $html );
}

/*
 * カテゴリーリンクリストの件数を
 * リンクの中に含める
 */
function custom_list_categories( $html ) {
	$pattern = '/<\/a> \(([0-9,]*)\)/';
	$replace = ' <span class="count">${1}</span></a>';
	return preg_replace( $pattern, $replace, $html );
}

?>

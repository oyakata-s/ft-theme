<?php

/*
 * 定数
 */
define( 'TEMPLATE_DIR_URI', get_template_directory_uri() );
define( 'TEMPLATE_DIR_PATH', get_template_directory() );

/*
 * ライブラリ読み込み
 */
require_once locate_template('inc/admin.php');		// 管理画面関連
require_once locate_template('inc/utils.php');		// ユーティリティ系
require_once locate_template('inc/widgets.php');	// ウィジェット関連
require_once locate_template('inc/filters.php');	// フィルター関連
require_once locate_template('inc/social.php');		// SNS関連
require_once locate_template('inc/init.php');		// 初期化関連

/*
 * テーマのバージョン番号を取得
 */
function get_theme_version() {
	$data = get_file_data( STYLESHEETPATH . '/style.css', array( 'version' => 'Version' ), 'theme' );
	$version = $data['version' ];
	if ($version < '1.0') {
		return date('0.Ymd.Hi');
	} else {
		return $version;
	}
}

/*
 * テーマのオプション設定を取得
 */
function get_theme_option( $key, $default = false ) {
	$value = get_option($key);
	if ($value && !empty($value)) {
		return $value;
	} else {
		return $default;
	}
}

/*
 * ページ毎のタイトル取得
 */
function get_page_title() {
	if (is_page() || is_single()) {
		$title = get_the_title();
	} else if (is_archive()) {
		$title = get_the_archive_title ();
	} else {
		add_filter( 'document_title_parts', 'custom_document_title_parts' );
		$title = wp_get_document_title();
		remove_filter( 'document_title_parts', 'custom_document_title_parts' );
	}
	return $title;
}

/*
 * フロントページ：description
 * 投稿ページ：作成者、日付
 */
function get_page_description() {
	global $post;
	if (is_front_page()) {
		$desc = get_bloginfo('description');
	} else if (is_single()) {
		$desc = '<span class="author">' . out_of_loop_author(false) . '</span>';
		$desc .= '<span class="post-date">' . out_of_loop_postdate(false) . '</span>';
		$desc .= '<span class="categories">' . get_page_categories() . '</span>';
	} else {
		$desc = '<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a>';
	}
	return $desc;
}

/*
 * 投稿のカテゴリーを取得
 */
function get_page_categories($separator = ' ') {
	global $post;
	$cats = get_the_category($post->ID);
	$cat_list = '';
	foreach ((array)$cats as $cat) {
		$cat_link = get_category_link($cat -> cat_ID);
		$cat_list .= '<a class="button" href="' . $cat_link . '">' . $cat -> name . '</a>' . $separator;
	}
	return $cat_list;
}

/*
 * ページネーション出力関数
 */
function get_pagenavi_link( ) {
	global $wp_query;
	$big = 999999999;
	$arg = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '/page/%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total'   => $wp_query->max_num_pages
	);
	echo '<div class="pagination">';
	echo paginate_links($arg);
	echo '</div>';
}

?>

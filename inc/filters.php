<?php

/*
 * フィルター定義
 */

/*
 * bodyタグのclassにスラッグを追加
 */
function add_pagename_class($classes = '') {
	global $post;
	if (is_page()) {
		$classes[] = get_postname();
	}
	return $classes;
}
add_filter('body_class', 'add_pagename_class');

/*
 * 抜粋の文字数変更(70文字)
 */
function custom_excerpt_length( $length ) {
	return 70;
}
add_filter('excerpt_mblength','custom_excerpt_length');

/*
 * 続きを読むの修正
 */
function custom_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more','custom_excerpt_more');

/*
 * タイトルなしの場合
 */
function custom_title_empty( $title ) {
	if (empty($title)) {
		return __('(No Title)', 'ft-theme');
	} else {
		return $title;
	}
}
add_filter('the_title', 'custom_title_empty');

/*
 * タイトルの長さ変更
 */
function custom_title_length_short( $title ) {
	return ft_substr($title, 40);
}
add_filter('the_title', 'custom_title_length_short');

/*
 * タイトルの区切り線を | にする
 * 未適用
 */
function custom_title_separator( $sep ){
	$sep = '|';
	return $sep;
}

/*
 * タイトルに概要を表示しない
 * 未適用
 */
function custom_document_title_parts( $title ){
	$title['tagline'] = '';
	$title['site'] = '';
	return $title;
}

?>

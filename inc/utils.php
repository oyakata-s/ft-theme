<?php
/*
 * ユーティリティ系
 */

/*
 * get_post_image_urlの戻り値がない場合に
 * noimageを返すフィルター
 */
if ( !function_exists('set_default_noimage') ) {
 function set_default_noimage( $imgsrc ) {
	if (!$imgsrc) {
		$imgsrc = NOIMAGE_URL;
	}
	return $imgsrc;
}
add_filter('post_image_url', 'set_default_noimage', 99);
}

/*
 * 表示中ページのURL
 * ループ内のみ
 */
if ( !function_exists('get_display_url') ) {
function get_display_url() {
	$url = '';
	if(is_front_page()) {
		$url = get_bloginfo('url');
	} else {//それ以外の投稿ページや固定ページなど
		$url = get_the_permalink();
	}
	return $url;
}
}

/*
 * 投稿者表示　ループ外
 */
if ( !function_exists('out_of_loop_author') ) {
function out_of_loop_author( $echo = true ) {
	global $post;
	$author = $post->post_author;
	$link = '<a href="' . get_author_posts_url($author) . '">' . get_userdata($author)->display_name . '</a>';

	if ($echo) {
		echo $link;
	} else {
		return $link;
	}
}
}

/*
 * 投稿日表示　ループ外
 */
if ( !function_exists('out_of_loop_postdate') ) {
 function out_of_loop_postdate( $echo = true ) {
	$archive_year  = get_the_time( 'Y' );
	$archive_month = get_the_time( 'm' );
	$archive_day   = get_the_time( 'd' );
	$link = '<a href="' . get_day_link( $archive_year, $archive_month, $archive_day ) . '">' . get_the_date() . '</a>';

	if ($echo) {
		echo $link;
	} else {
		return $link;
	}
}
}

/*
 * 抜粋表示　ループ外使用
 */
if ( !function_exists('out_of_loop_excerpt') ) {
function out_of_loop_excerpt( $length = 100 ) {
	global $post;

	$text = '';
	$content = $post->post_content;
	$excerpt = $post->post_excerpt;
	if (!$excerpt) {
		$text = strip_tags($content);
		$text = strip_shortcodes($text);
		$text = preg_replace('#<img (.*?)>#i', '', $text);
		$text = str_replace(array("\r\n","\r","\n"), '', $text);
	} else {
		$text = strip_tags($excerpt);
	}

	if(mb_strlen($text) > $length){
		$text = mb_substr($text, 0, $length);
		$text . '...';
	}

	echo $text;
}
}

/*
 * ページのpostname(スラッグ)を取得
 */
if ( !function_exists('get_postname')) {
function get_postname( $post_id = null ) {
	global $post;
	if ( is_null($post_id) ) {
		$obj = $post;
	} else {
		$obj = get_post($post_id);
	}
	return $obj->post_name;
}
}

/*
 * スラッグからパーマリンクを取得
 * ループ内のみ
 */
if ( !function_exists('get_permalink_by_slug') ) {
function get_permalink_by_slug( $slug ) {
	$page = get_page_by_path($slug);
	return get_permalink($page->ID);
}
}

/*
 * ヘッダー画像が存在するか
 * または　アイキャッチ画像が存在するか
 * ループ内のみ
 */
if ( !function_exists('has_page_header_image')) {
function has_page_header_image() {
	$header_image = get_header_image();
	if (!empty($header_image)) {
		return true;
	} else {
		if (is_page() || is_single()) {
			if (has_post_thumbnail()) {
				return true;
			}
		}
	}
	return false;
}
}

/*
 * blogurlからホスト名取得
 */
if ( !function_exists('get_urlhostname') ) {
 function get_urlhostname() {
	$info = parse_url(get_bloginfo('url'));
	return $info['host'];
}
}

/*
 * 投稿にアイキャッチ画像があればURLを返す
 * なければfalse
 * filter post_image_urlでカスタム可
 */
if ( !function_exists('get_post_image_url') ) {
function get_post_image_url( $size = 'thumbnail', $content_search = false, $post_id = null ) {
	global $post;
	if ( is_null($post_id) ) {
		$post_id = $post->ID;
	}

	$imgsrc = get_the_post_thumbnail_url($post_id, $size);
	if ( !$imgsrc ) {
		if ($content_search) {
			$args = array(
				'post_mime_type' => 'image',
				'post_parent' => $post_id,
				'post_type' => 'attachment',
				'numberposts' => 1,
				);
			$image = get_children($args);
			if (!empty($image)) {
				$post_img = wp_get_attachment_image_src( key($image) , $size );
				$imgsrc = $post_img[0];
			} else {
				$imgsrc = get_content_imgsrc($post_id);
			}
		}
	}

	return apply_filters('post_image_url', $imgsrc);
	// return $imgsrc;
}
}

/*
 * 投稿本文にimgタグがあればurlを返す
 * なければfalse
 */
if ( !function_exists('get_content_imgsrc') ) {
function get_content_imgsrc( $post_id = null ) {
	global $post, $posts;

	$obj = $post;
	if ( !is_null($post_id) ) {
		$obj = get_post($post_id);
	}

	// $imgsrc = '';
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $obj -> post_content, $matches);
	$imgsrc = $matches[1][0];

	if (empty($imgsrc)) {//Defines a default image
		$imgsrc = false;
	}

	return $imgsrc;
}
}

/*
 * 文字列トリミング
 */
if ( !function_exists('ft_substr') ) {
function ft_substr($str, $length, $start = 0 ) {
	$encoding = get_bloginfo('charset');
	if (mb_strlen($str, $encoding) <= $length) {
		return $str;
	} else {
		$substr = mb_substr($str, $start, $length, $encoding);
		$substr .= '...';
		return $substr;
	}
}
}

/*
 * テキストからタグやショートコードを除去
 */
if ( !function_exists('clean_text') ) {
function clean_text( $text ) {
	$clean = '';
	$clean = strip_tags($text);
	$clean = strip_shortcodes($clean);
	$clean = preg_replace('#<img (.*?)>#i', '', $clean);
	$clean = str_replace(array("\r\n","\r","\n"), ' ', $clean);
	return $clean;
}
}

?>

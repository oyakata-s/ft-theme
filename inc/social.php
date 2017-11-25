<?php

/*
 * ソーシャル関連
 */
define('OGPIMAGE_URL', NOIMAGE_URL);

/*
 * シェアボタンを表示
 */
function get_share_button() {
	include_once TEMPLATE_DIR_PATH . '/parts/share_button.php';
}

/*
 * OGPタグを出力
 */
function get_ogp_setting() {
	include_once TEMPLATE_DIR_PATH . '/parts/meta-ogp.php';
}

/*
 * シェアボタン用
 */
// facebook
function get_facebook_share_url($url) {
	return 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $url );
}
// twitter
function get_twitter_share_url($url) {
	$twtext = wp_get_document_title();
	return 'https://twitter.com/share?url=' . rawurlencode( $url ) . '&text=' . rawurlencode( $twtext );
}
// line
function get_line_share_url($url) {
	$lntext = wp_get_document_title();
	return 'http://line.me/R/msg/text/?' . rawurlencode($lntext . ' ' . $url);
}
// google+
function get_gplus_share_url($url) {
	return 'https://plus.google.com/share?url=' . rawurlencode($url);
}

/*
 * facebook件シェア数取得
 */
function get_facebook_count( $url ) {
	if ($json = @file_get_contents('https://graph.facebook.com/?id=' . $url . '')) {
		$array = json_decode($json);
  		if ( isset($array->share->share_count) ) {
			return $array->share->share_count;
  		}
	}
	return 0;
}

/*
 * シェアボタンのリンクを表示
 */
function social_share_link($url, $type, $html = null) {

	switch($type) {
		case 'facebook':
			$url = get_facebook_share_url($url);
			break;

		case 'twitter':
			$url = get_twitter_share_url($url);
			break;

		case 'line':
			$url = get_line_share_url($url);
			break;

		case 'gplus':
			$url = get_gplus_share_url($url);
			break;

		default:
			$url = '';
			break;
	}

	if (!empty($url)) {
		$link = '<a href="' . $url . '" class="' . $type . '">';
		$link .= (!is_null($html)) ? $html : '';
		$link .= '</a>';
	}
	echo $link;
}

/*
 * ソーシャルアカウントのプロフィールリンクを表示
 * アカウントが存在すれば
 */
function social_profile_link($type, $html = null) {
	$url = get_social_account_url($type, false);
	if (!empty($url)) {
		$link = '<a href="' . $url . '" class="' . $type . '">';
		$link .= (!is_null($html)) ? $html : '';
		$link .= '</a>';
	}
	echo $link;
}

/*
 * ソーシャルアカウントのプロフィールURL
 */
function get_social_account_url($type, $echo = true) {
	$url = '';
	switch ($type) {
		case 'feed':
			$url = get_bloginfo('rss2_url');
			break;

		case 'facebook':
			$account = get_option('social_account_facebook');
			if (!empty($account)) {
				if (preg_match('/^(http|https)/', $account)) {
					$url = $account;
				} else {
					$url = 'https://www.facebook.com/' . $account;
				}
			}
			break;

		case 'twitter':
			$account = get_option('social_account_twitter');
			if (!empty($account)) {
				if (preg_match('/^(http|https)/', $account)) {
					$url = $account;
				} else {
					$url = 'https://twitter.com/' . $account;
				}
			}
			break;

		case 'gplus':
			$account = get_option('social_account_gplus');
			if (!empty($account)) {
				if (preg_match('/^(http|https)/', $account)) {
					$url = $account;
				} else {
					$url = 'https://plus.google.com/' . $account;
				}
			}
			break;

		case 'instagram':
			$account = get_option('social_account_instagram');
			if (!empty($account)) {
				if (preg_match('/^(http|https)/', $account)) {
					$url = $account;
				} else {
					$url = 'https://www.instagram.com/' . $account;
				}
			}
			break;

		default:
			break;
	}

	if ($echo) {
		echo $url;
	} else {
		return $url;
	}
}

/*
 * OGP用
 */
function ogp_url(){
	$url = get_display_url();
	echo esc_url($url);
}
function ogp_title(){
	$title = wp_get_document_title();
	echo esc_html($title);
}
function ogp_description() {
	$description = '';
	if ( is_front_page() ) {
		$description = bloginfo('description');
	} else {
		$description = out_of_loop_excerpt();
	}
	echo esc_html($description);
}
function ogp_image(){
	$imgUrl = '';
	if( is_front_page() ){
		$header_image = get_header_image();
		if ( !empty($header_image) ) {
			$imgUrl = $header_image;
		} else {
			$imgUrl = OGPIMAGE_URL;
		}
	} else {
		$imgUrl = get_post_image_url('full', true);
	}
	echo esc_url($imgUrl);
}
function ogp_type(){
	$type = '';
	if( is_front_page() ){
		$type = 'website';
	} else {
		$type = 'article';
	}
	echo $type;
}

?>

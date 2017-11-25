<?php

/*
 * カスタマイズ：NOIMAGE設定
 */
function ft_customize_noimage_register( $wp_customize ) {

	// カスタマイズ画面にメニューを追加
	$wp_customize->add_section( 'ft_customize_noimage_section', array(
		'title' => __('No Image', 'ft-theme'),
		'propaty' => 200,
	));

	// 設定項目
	$wp_customize->add_setting('ft_customize_options[noimage_url]', array(
		'default' => TEMPLATE_DIR_URI . '/img/noimage.jpg',
		'transport' => 'postMessage',
		'type' => 'option',
	));

	// コントロール作成
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize, 'ft_customize_options_noimage', array(
			'label' => __('Default No Image', 'ft-theme'),
			'section' => 'ft_customize_noimage_section',
			'settings' => 'ft_customize_options[noimage_url]',
		)
	));

}

/*
 * NOIMAGE画像のURLを取得
 */
function get_noimage_url() {
	$options = get_option('ft_customize_options');
	if (!empty($options['noimage_url'])) {
		return $options['noimage_url'];
	} else {
		return TEMPLATE_DIR_URI . '/img/noimage.jpg';
	}
}

?>

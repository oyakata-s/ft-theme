<?php

/*
 * カスタマイズ：配色設定
 */
function ft_customize_color_register( $wp_customize ) {

	// カスタマイズ画面にメニューを追加
	$wp_customize->add_section( 'ft_customize_color_section', array(
		'title' => __('Color Scheme', 'ft-theme'),
		'propaty' => 200,
	));

	// 設定項目
	$wp_customize->add_setting('ft_customize_options[color_scheme]', array(
		'default' => 'color-default',
		'type' => 'option',
	));

	// コントロール作成
	$wp_customize->add_control('ft_customize_options_color_scheme', array(
		'section' => 'ft_customize_color_section',
		'settings' => 'ft_customize_options[color_scheme]',
		'label' => __('Color Scheme', 'ft-theme'),
		'type' => 'radio',
		'choices' => array(
			'color-default' => __('Default', 'ft-theme'),
			'color-light' => __('Light', 'ft-theme'),
			'color-blue' => __('Blue', 'ft-theme'),
			'color-coffee' => __('Coffee', 'ft-theme'),
			'color-ectoplasm' => __('Ectoplasm', 'ft-theme'),
			'color-midnight' => __('Midnight', 'ft-theme'),
			'color-ocean' => __('Ocean', 'ft-theme'),
			'color-sunrise' => __('Sunrise', 'ft-theme'),
		),
	));

}

/*
 * bodyのclassに設定値を反映
 */
function add_color_scheme( $classes = '' ) {
	$option = get_customize_option('color_scheme', 'color-default');
	$classes[] = (!empty($option)) ? $option : 'color-default';
	return $classes;
}

?>

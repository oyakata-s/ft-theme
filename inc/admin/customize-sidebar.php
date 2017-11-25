<?php

/*
 * カスタマイズ：サイドバー設定
 */
function ft_customize_sidebar_register( $wp_customize ) {

	// カスタマイズ画面にメニューを追加
	$wp_customize->add_section( 'ft_customize_sidebar_section', array(
		'title' => __('Side Bar', 'ft-theme'),
		'propaty' => 200,
	));

	/*
	 * レイアウト
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_options[sidebar_layout]', array(
		'default' => 'side-right',
		'type' => 'option',
	));

	// コントロール作成
	$wp_customize->add_control('ft_customize_options_sidebar_layout', array(
		'section' => 'ft_customize_sidebar_section',
		'settings' => 'ft_customize_options[sidebar_layout]',
		'label' => __('Side Bar Layout', 'ft-theme'),
		'type' => 'radio',
		'choices' => array(
			'side-right' => __('Right', 'ft-theme'),
			'side-left' => __('Left', 'ft-theme'),
		),
	));

	/*
	 * 自動開閉
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_options[sidebar_toggle]', array(
		'default' => true,
		'type' => 'option',
	));

	// コントロール追加
	$wp_customize->add_control('ft_customize_options_sidebar_toggle', array(
		'section' => 'ft_customize_sidebar_section',
		'settings' => 'ft_customize_options[sidebar_toggle]',
		'label' => __('Auto Toggle', 'ft-theme'),
		'type' => 'checkbox',
	));

}

/*
 * bodyのclassに設定値を反映
 */
function add_sidebar_setting( $classes = '' ) {
	$option = get_customize_option('sidebar_layout', 'side-right');
	$classes[] = (!empty($option)) ? $option : 'side-right';
	return $classes;
}

?>

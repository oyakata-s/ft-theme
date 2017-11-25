<?php

/*
 * カスタマイズ：スライダー設定
 */
function ft_customize_slider_register( $wp_customize ) {

	// カスタマイズ画面にメニューを追加
	$wp_customize->add_section( 'ft_customize_slider_section', array(
		'title' => __('Header Slider', 'ft-theme'),
		'propaty' => 200,
	));

	/*
	 * 有効化
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_slider_options[enable]', array(
		'default' => false,
		'type' => 'option',
	));

	// コントロール追加
	$wp_customize->add_control(
		'ft_cutomize_slider_options_enable',
		array(
			'section' => 'ft_customize_slider_section',
			'settings' => 'ft_customize_slider_options[enable]',
			'label' => __('Slider Enable', 'ft-theme'),
			'type' => 'checkbox',
		));

	/*
	 * 方向
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_slider_options[direction]', array(
		'default' => 'horizontal',
		'type' => 'option',
	));
	// 設定コントロール
	$wp_customize->add_control(
		'ft_cutomize_slider_options_direction',
		array(
			'section' => 'ft_customize_slider_section',
			'settings' => 'ft_customize_slider_options[direction]',
			'label' => __('Direction', 'ft-theme'),
			'type' => 'radio',
			'choices' => array(
				'horizontal' => __('Horizontal', 'ft-theme'),
				'vertical' => __('Vertical', 'ft-theme'),
			)
	));

	/*
	 * エフェクト
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_slider_options[effect]', array(
		'default' => 'slide',
		'type' => 'option',
	));
	// 設定コントロール
	$wp_customize->add_control(
		'ft_customize_slider_options_effect',
		array(
			'section' => 'ft_customize_slider_section',
			'settings' => 'ft_customize_slider_options[effect]',
			'label' => __('Effect', 'ft-theme'),
			'type' => 'select',
			'choices' => array(
				'slide' => __('Slide', 'ft-theme'),
				'fade' => __('Fade', 'ft-theme'),
				'cube' => __('Cube', 'ft-theme'),
				'coverflow' => __('CoverFlow', 'ft-theme'),
				'flip' => __('Flip', 'ft-theme'),
			)
	));

	/*
	 * スピード
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_slider_options[speed]', array(
		'default' => 1000,
		'type' => 'option',
	));
	// 設定コントロール
	$wp_customize->add_control(
		'ft_customize_slider_options_speed',
		array(
			'section' => 'ft_customize_slider_section',
			'settings' => 'ft_customize_slider_options[speed]',
			'label' => __('Speed(msec)', 'ft-theme'),
			'type' => 'number'
	));

	/*
	 * 切替間隔
	 */
	// 設定項目
	$wp_customize->add_setting('ft_customize_slider_options[autoplay]', array(
		'default' => 3000,
		'type' => 'option',
	));
	// 設定コントロール
	$wp_customize->add_control(
		'ft_customize_slider_options_autoplay',
		array(
			'section' => 'ft_cosutomize_slider_section',
			'settings' => 'ft_customize_slider_options[autoplay]',
			'label' => __('Autoplay(msec)', 'ft-theme'),
			'type' => 'number'
	));

}

/*
 * スライダーのカスタマイズ設定値を取得
 */
function get_customize_slider_option($option, $default = null) {
	$options = get_option('ft_customize_slider_options', $default);
	if (!empty($options[$option])) {
		return $options[$option];
	} else {
		return $default;
	}
}

/*
 * スライダーが有効の場合、設定を反映させるスクリプトを
 * footerに出力する
 */
function add_footer_slider() {
	if (get_customize_slider_option('enable', false)) :
?>
<script>
jQuery(window).on('load', function($) {
	var args = {
			direction: '<?php echo get_customize_slider_option('direction', 'horizontal'); ?>',
			effect: '<?php echo get_customize_slider_option('effect', 'slide'); ?>',
			speed: <?php echo get_customize_slider_option('speed', 1000); ?>,
			autoplay: <?php echo get_customize_slider_option('autoplay', 3000); ?>,
			autoplayDisableOnInteraction: false,
			onInit: showSlideText,
			onTransitionEnd: showSlideText
	}
	var header_slider = new Swiper('#header .swiper-container', args);
	function showSlideText() {
		jQuery('#header .swiper-slide-active .slide-text.hidden').streffect({
			wait: 500,
			interval: 0
		}).removeClass('hidden');
	}
});
</script>
<?php
	endif;
}

?>

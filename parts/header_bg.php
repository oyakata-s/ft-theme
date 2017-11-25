<?php
/*
 * header背景表示
 */

// 固定ページまたは投稿ページの場合
// アイキャッチ画像優先
global $post;
if ((is_single() || is_page()) && has_post_thumbnail($post->ID)) {
	$header_image = get_the_post_thumbnail_url($post->ID, 'full');
}

// アイキャッチ画像がない場合
// ヘッダー画像取得
$slider_enable = false;
if (!$header_image) {
	if (is_random_header_image() && get_customize_slider_option('enable', false)) {
		$header_images = get_uploaded_header_images();
		shuffle($header_images);
		$slider_enable = true;
	} else {
		$header_image = get_header_image();
	}
}

// スライダーにする場合
if ($slider_enable) {
	$encoding = get_bloginfo('charset');
	if (is_front_page()) {
		$slide_text = array(
			get_bloginfo('name'),
			ft_substr(get_bloginfo('description'), 70)
		);
	} else {
		$slide_text = array();

		$slide_text[] = get_page_title();									// ページタイトル
		if (is_category() && !empty(category_description())) {				// カテゴリ概要
			$slide_text[] = ft_substr(category_description(), 70);
		}
		if (is_author() && !empty(get_the_author_meta('description'))) {	// ユーザープロフィール
			$slide_text[] = ft_substr(get_the_author_meta('description'), 70);
		}
		$slide_text[] = get_bloginfo('name');								// ブログ名
	}
}

/*
 * HTML出力
 */
?>

<?php if ($slider_enable) : ?>
	<div class="header-bg has-image swiper-container">
	<?php if ( $header_images ) : ?>
		<ul class="header-slider slides swiper-wrapper">
		<?php $i=0; foreach( $header_images as $image ) : ?>
			<li class="swiper-slide">
				<img class="header-img object-fit-img" src="<?php echo $image['url']; ?>" alt="<?php bloginfo('name'); ?>" />
				<span class="slide-text hidden">
				<?php
					if ($i <= count($slide_text)-1) {
						echo $slide_text[$i];
					} else {
						$j = $i % count($slide_text);
						echo $slide_text[$j];
					}
					$i++;
				?>
				</span>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</div>
<?php else : ?>
	<?php if ( !empty($header_image) ) : ?>
	<div class="header-bg has-image">
		<ul class="header-img-wrap">
			<li><img class="header-img object-fit-img" src="<?php echo $header_image; ?>" alt="<?php bloginfo('name'); ?>" /></li>
		</ul>
	</div>
	<?php else : ?>
	<div class="header-bg">
		<canvas id="header-canvas"></canvas>
	</div>
	<?php endif; ?>
<?php endif; ?>
	<!-- /.header-bg -->

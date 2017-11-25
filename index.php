<?php
/*
 * デフォルトテンプレート
 */
	wp_enqueue_style('theme-index', TEMPLATE_DIR_URI.'/css/index.css', array('theme-common'), get_theme_version());
	get_header();
?>

		<article id="main" class="posts slidein hidden">

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<a class="post" href="<?php the_permalink(); ?>">
				<div class="head">
					<img class="thumbnail object-fit-img" src="<?php echo get_post_image_url('full', true); ?>" alt="<?php
						remove_filter('the_title', 'custom_title_length_short');
						the_title();
						add_filter('the_title', 'custom_title_length_short');
					?>" />
					<h2 class="title">
						<?php the_title(); ?>
					</h2>
				</div>
				<div class="content">
					<?php the_excerpt(); ?>
				</div>
			</a>
<?php endwhile; ?>
<?php else : ?>
	<?php
		/*
		 * 検索結果なしの場合
		 */
		if (is_search()) :
	?>
		<div class="noresult">
			<p class="message"><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ft-theme'); ?></p>
			<p class="search"><?php get_search_form(); ?></p>
		</div>
	<?php
		/*
		 * 404の場合
		 */
		else :
	?>
		<div class="noresult">
			<p class="message"><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ft-theme'); ?></p>
			<p class="search"><?php get_search_form(); ?></p>
		</div>
	<?php endif; ?>
<?php endif; ?>

		</article>
		<!-- /#main -->

		<?php if ( function_exists( 'get_pagenavi_link' ) ) { get_pagenavi_link(); } ?>
		<?php
			if ( get_option('social_display_at_index') ) {
				if ( function_exists( 'get_share_button' ) ) { get_share_button(); }
			}
		?>
<?php
	get_footer();
?>

<?php
/*
 * 固定ページ用テンプレート
 */
	wp_enqueue_style('theme-page', TEMPLATE_DIR_URI.'/css/single.css', array('theme-common'), get_theme_version());
	get_header();
?>
<?php while( have_posts() ) : the_post(); ?>
		<article id="main">
			<div class="page">
				<div class="content slidein hidden">
					<?php the_content(); ?>
				</div>
			<?php
				if ( get_option('social_display_at_page') ) {
					if ( function_exists( 'get_share_button' ) ) { get_share_button(); }
				}
			?>
			<?php if ( function_exists( 'get_related_pages' ) ) { get_related_pages(); } ?>
			<?php comments_template(); ?>
			</div>
		</article>
		<!-- /#main -->
<?php endwhile; ?>
<?php
	get_footer();
?>

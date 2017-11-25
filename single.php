<?php
/*
 * 投稿ページ用テンプレート
 */
	wp_enqueue_style('theme-single', TEMPLATE_DIR_URI.'/css/single.css', array('theme-common'), get_theme_version());
 	get_header();
?>
<?php while( have_posts() ) : the_post(); ?>
		<article id="main">
			<div class="single">
				<div class="content slidein hidden">
					<?php the_content(); ?>

					<?php
						wp_link_pages(array(
							'before' => '<div class="pagination">',
							'after' => '</div>',
							'link_before' => '<span class="page-numbers">',
							'link_after' => '</span>'
						));
					?>

					<div class="meta">
						<span class="title">「<a href="<?php the_permalink(); ?>"><?php
							remove_filter('the_title', 'custom_title_length_short');
							the_title();
							add_filter('the_title', 'custom_title_length_short')
						?></a>」</span>
						<span class="author">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
						</span>
						<span class="post-date">
							<?php
								$archive_year  = get_the_time( 'Y' );
								$archive_month = get_the_time( 'm' );
								$archive_day   = get_the_time( 'd' );
							?>
							<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php the_date();?></a>
						</span>
						<span class="categories"><?php the_category(','); ?></span>
						<?php if ( !empty(get_the_tags()) ) : ?>
							<span class="tags"><?php the_tags('', ','); ?></span>
						<?php endif; ?>
					</div>
				</div>

				<?php
					if ( get_option('social_display_at_post') ) {
						if ( function_exists( 'get_share_button' ) ) { get_share_button(); }
					}
				?>

				<?php if ( function_exists( 'get_related_pages' ) ) { get_related_pages(); } ?>

				<nav id="prev-next" class="hidden slidein">
				<?php $nextpost = get_adjacent_post(false, '', false); if ($nextpost) : ?>
					<div class="prev-next-post">
						<h3 class="prev-next-title next"><a href="<?php echo get_permalink($nextpost->ID); ?>"><?php _e('Next Post'); ?></a></h3>
						<a class="post clearfix" href="<?php echo get_permalink($nextpost->ID); ?>">
							<img class="thumbnail object-fit-img" src="<?php echo get_post_image_url('thumbnail', true, $nextpost->ID); ?>" alt="" />
							<p><?php echo esc_attr(get_the_title($nextpost->ID)); ?></p>
						</a>
					</div>
				<?php endif; ?>

				<?php $prevpost = get_adjacent_post(false, '', true); if ($prevpost) : ?>
					<div class="prev-next-post">
						<h3 class="prev-next-title prev"><a href="<?php echo get_permalink($prevpost->ID); ?>"><?php _e('Previous Post'); ?></a></h3>
						<a class="post clearfix" href="<?php echo get_permalink($prevpost->ID); ?>">
							<img class="thumbnail object-fit-img" src="<?php echo get_post_image_url('thumbnail', true, $prevpost->ID); ?>" alt="" />
							<p><?php echo esc_attr(get_the_title($prevpost->ID)); ?></p>
						</a>
					</div>
				<?php endif; ?>
				</nav>

				<?php comments_template(); ?>

			</div>
		</article>
		<!-- /#main -->

<?php endwhile; ?>
<?php
	get_footer();
?>

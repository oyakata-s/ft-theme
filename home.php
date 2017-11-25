<?php
/*
 * ホームページ用テンプレート
 */
	wp_enqueue_style('font-boogaloo', 'https://fonts.googleapis.com/css?family=Boogaloo', array(), get_theme_version());
 	wp_enqueue_style('theme-home', TEMPLATE_DIR_URI.'/css/home.css', array('theme-common','swiper','font-boogaloo'), get_theme_version());
	wp_enqueue_script('theme-home', TEMPLATE_DIR_URI.'/js/home.js', array('theme-common'), get_theme_version());
	get_header();
?>
	<article id="main">
		<section class="section pickups slidein hidden">
			<h2 class="title"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php _e('Pick Up!', 'ft-theme'); ?></h2>
			<div class="clearfix">
			<?php
				$sticky_posts = new WP_Query(array(
					'post_status' => 'publish',
					'post__in' => get_option( 'sticky_posts' ),
				));
				$sticky_cnt = 0;
				if ( $sticky_posts->have_posts() ) :
					while ( $sticky_posts->have_posts() ) : $sticky_posts->the_post();
						if ( is_sticky() ) : $sticky_cnt++;
				?>
					<a class="pickup" href="<?php the_permalink(); ?>">
						<img class="thumbnail object-fit-img" src="<?php echo get_post_image_url('full', true); ?>" alt="<?php
							remove_filter('the_title', 'custom_title_length_short');
							the_title();
							add_filter('the_title', 'custom_title_length_short');
						?>" />
						<h2 class="title"><?php the_title(); ?></h2>
					</a>
				<?php
						endif;
					endwhile;
				endif;
				if ( $sticky_cnt === 0) :
			?>
				<p class="nopickup"><?php _e('No Pickup post.', 'ft-theme'); ?></p>
			<?php endif; wp_reset_postdata(); ?>
			</div>
		</section>
		<!-- /.pickup -->

		<section class="section posts slidein hidden">
			<h2 class="title"><?php _e('Entries', 'ft-theme'); ?></h2>
			<div class="swiper-container">
			<div class="swiper-wrapper">

			<?php
				$update_posts = new WP_Query(array(
					'post_status' => 'publish',
					'post__not_in' => get_option( 'sticky_posts' )
				));
				if ( $update_posts->have_posts() ) :
					while ( $update_posts->have_posts() ) : $update_posts->the_post();
			?>
				<a class="post swiper-slide" href="<?php the_permalink(); ?>">
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
				<!-- /.swiper-slide -->
			<?php
					endwhile;
				endif;
				wp_reset_postdata();
			?>
			</div>
			<!-- /.swiper-wrapper -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-scrollbar"></div>
			</div>
			<!-- /.swiper-container -->
		</section>
		<!-- /.posts -->

	</article>
	<!-- /#main -->

		<?php
			if ( get_option('social_display_at_frontpage') ) {
				if ( function_exists( 'get_share_button' ) ) { get_share_button(); }
			}
		?>
<?php
	get_footer();
?>

	<aside id="side" class="<?php echo (get_customize_option('sidebar_toggle', true)) ? 'auto-toggle' : 'manual-toggle' ?>">
		<div class="side-inner">
		<?php if (!is_front_page()) : ?>
			<header class="side-header">
				<div class="site-meta clearfix">
				<?php if (has_custom_logo()) : ?>
					<span class="logo">
						<?php the_custom_logo(); ?>
					</span>
				<?php endif; ?>
					<h1 class="title">
						<?php bloginfo('name'); ?>
					</h1>
					<span class="description">
						<?php bloginfo('description'); ?>
					</span>
				</div>
			</header>
			<!-- /#side-header -->
		<?php endif; ?>

			<section class="widget main-menu">
				<h2 class="title"><?php _e('Main Menu', 'ft-theme'); ?></h2>
				<?php wp_nav_menu( array(
					'theme_location' => 'gnav',
					'menu' => 'gnav',
					'container' => '',
					'items_wrap' => '<ul class="clearfix">%3$s</ul>'
				)); ?>
			</section>
			<!-- /.main-menu -->

			<section class="widget social-menu">
				<h2 class="title"><?php _e('Social Account', 'ft-theme'); ?></h2>
				<ul>
					<li><?php social_profile_link('facebook', 'Facebook'); ?></li>
					<li><?php social_profile_link('twitter', 'Twitter'); ?></li>
					<li><?php social_profile_link('gplus', 'Google+'); ?></li>
					<li><?php social_profile_link('instagram', 'Instagram'); ?></li>
				</ul>
			</section>
			<!-- /.social-menu -->

		<?php
			if ( is_active_sidebar( 'sidebar' ) ) :
				dynamic_sidebar('sidebar');
			else :
		?>
			<section class="widget about">
				<h2 class="title">ABOUT</h2>
				<p><?php _e('If the widget is not set, this will be displayed.', 'ft-theme'); ?></p>
			</section>
		<?php
			endif;
		?>
		</div>
	</aside>
	<!-- /#side -->

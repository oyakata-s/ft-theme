<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns#">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="keywords" content="">
	<?php if ( function_exists( 'get_ogp_setting' ) ) { get_ogp_setting(); } ?>

<?php
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<div class="container">

	<header id="header">
		<?php get_template_part('parts/header_bg'); ?>
		<div class="wrap">
			<h1 class="page-title">
				<?php echo get_page_title(); ?>
			</h1>
			<div class="description">
				<?php echo get_page_description() ?>
			</div>
		</div>

	</header>
	<!-- /#header -->

	<nav id="gnav">
		<div class="wrap">
			<h1 class="gnav-home">
				<a href="<?php bloginfo('url'); ?>"></a>
				<span><?php echo get_page_title(); ?></span>
			</h1>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'gnav',
					'menu' => 'gnav',
					'container_class' => 'gnav-container',
					'items_wrap' => '<ul class="main-menu">%3$s</ul>'
				));
			?>
			<div class="social-link">
				<?php social_profile_link('facebook'); ?>
				<?php social_profile_link('twitter'); ?>
				<?php social_profile_link('gplus'); ?>
				<?php social_profile_link('instagram'); ?>
				<?php social_profile_link('feed'); ?>
			</div>
		</div>

		<div class="menu-btn">
			<a href="#"></a>
		</div>
	</nav>
	<!-- /#gnav -->

	<nav id="gnav-open">
		<div class="wrap">
			<h2 class="title"></h2>
			<ul class="main-menu"></ul>
		</div>
	</nav>
	<!-- /#gnav-open -->

	<div id="contents" class="side-close clearfix">

	<div class="wrap">

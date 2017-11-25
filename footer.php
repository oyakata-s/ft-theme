		<footer id="footer" class="slidein hidden">
			<div class="widget-wrap">
			<?php
				if ( is_active_sidebar( 'footer-nav' ) ) :
					dynamic_sidebar('footer-nav');
				else :
			?>
				<section class="widget about">
					<h2 class="title">ABOUT</h2>
					<p><?php _e('If the widget is not set, this will be displayed.', 'ft-theme'); ?></p>
				</section>
			<?php
				endif;
			?>

			<?php if (is_ad_hide() == false) : ?>
				<section class="widget ads">
					<h2 class="title"><?php _e('Advertisement', 'ft-theme'); ?></h2>
					<?php echo get_ad_code(); ?>
				</section>
			<?php endif; ?>

			</div>

			<small>&copy; <?php bloginfo('name'); ?></small>
		</footer>
		<!-- /#footer -->

	</div>
	<!-- /#contents .wrap -->

	<?php get_sidebar(); ?>

	</div>
	<!-- /#contents -->

</div>
<!-- /.container -->

<!--google+ plugin-->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ja'}
</script>
<!--facebook plugin-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var fb_jssrc = '//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.9&appId=<?php echo get_option( 'social_facebook_appid'); ?>';
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = fb_jssrc;
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
	wp_footer();
?>
</body>

</html>

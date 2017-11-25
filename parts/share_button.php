<?php
/*
 * SNSシェアボタン表示
 */
$url = get_display_url();
// $url = 'http://www.comeluck.jp/';

/*
 * HTML出力
 */
?>
<div class="share-button slidein hidden <?php if (get_option('social_share_official')) : echo 'official'; else: echo 'custom'; endif; ?>">
<?php if (get_option('social_share_official')) : ?>
	<?php if (get_option('social_service_facebook')) : ?>
	<div class="facebook button">
		<div class="fb-like" data-href="<?php echo $url; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
	</div>
	<?php endif; ?>
	<?php if (get_option('social_service_twitter')) : ?>
	<div class="twitter button">
		<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
	<?php endif; ?>
	<?php if (get_option('social_service_line')) : ?>
	<div class="line button">
		<div class="line-it-button" data-lang="ja" data-type="share-a" data-url="<?php echo $url; ?>" style="display: none;"></div>
		<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
	</div>
	<?php endif; ?>
	<?php if (get_option('social_service_gplus')) : ?>
	<div class="gplus button">
		<div class="g-plusone" data-size="medium"></div>
	</div>
	<?php endif; ?>
<?php else : ?>
	<h2 class="share-title">Share</h2>
	<?php if (get_option('social_service_facebook')) : ?>
	<div class="facebook button">
		<?php social_share_link($url, 'facebook', '<p><i class="fa fa-facebook-official" aria-hidden="true"></i>' . __('Share', 'ft-theme') . '</p>'); ?>
	</div>
	<?php endif; ?>
	<?php if (get_option('social_service_twitter')) : ?>
	<div class="twitter button">
		<?php social_share_link($url, 'twitter', '<p><i class="fa fa-twitter" aria-hidden="true"></i>' . __('Tweet', 'ft-theme') . '</p>'); ?>
	</div>
	<?php endif; ?>
	<?php if (get_option('social_service_line')) : ?>
	<div class="line button">
		<?php social_share_link($url, 'line', '<p><img src="' . TEMPLATE_DIR_URI . '/img/logo_line.png" alt="" />LINEで送る</p>'); ?>
	</div>
	<?php endif; ?>
	<?php if (get_option('social_service_gplus')) : ?>
	<div class="gplus button">
		<?php social_share_link($url, 'gplus', '<p><i class="fa fa-google-plus" aria-hidden="true"></i>' . __('Google+', 'ft-theme') . '</p>'); ?>
	</div>
	<?php endif; ?>
<?php endif; ?>
</div>

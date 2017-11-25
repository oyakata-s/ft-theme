<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="submit" class="search-submit" value="&#xf002" />
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'ft-theme' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
</form>

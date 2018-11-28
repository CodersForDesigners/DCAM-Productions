<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="searchform" role="search">
	<div>
		<label for="s" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'vidiho-pro' ); ?></label>
		<input type="search" id="s" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr_x( 'Search', 'search box placeholder', 'vidiho-pro' ); ?>">
		<button class="searchsubmit" type="submit"><i class="fas fa-search"></i><span class="screen-reader-text"> <?php echo esc_html_x( 'Search', 'submit button', 'vidiho-pro' ); ?></span></button>
	</div>
</form>

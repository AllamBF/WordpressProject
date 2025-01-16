<?php get_header(); ?>
	<div class="fullwidth-template">
		<div id="main-content">	
			<div id="primary" class="site-content">
				<article>
					<h1 class="heading-font-1"><?php esc_html_e('404', 'yoome'); ?></h1>
					<h2 class="heading-font-2"><?php esc_html_e('Oops! Page Not Found', 'yoome'); ?></h2>
					<p class="ts-description-2"><?php esc_html_e('The link you clicked might be corrupted, or the page may have been removed. You can back to homepage or seach anything.', 'yoome'); ?></p>
					<?php get_search_form(); ?>
				</article>
			</div>
		</div>
	</div>
<?php
get_footer();
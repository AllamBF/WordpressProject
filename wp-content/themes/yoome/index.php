<?php
get_header();

$theme_options = yoome_get_theme_options();

$page_column_class = yoome_page_layout_columns_class($theme_options['ts_blog_layout'], $theme_options['ts_blog_left_sidebar'], $theme_options['ts_blog_right_sidebar']);
?>
<div class="page-template blog-template index-template page-container">
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
			<?php dynamic_sidebar( $theme_options['ts_blog_left_sidebar'] ); ?>
		</aside>
	<?php endif; ?>			
	
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
		<div id="primary" class="site-content">
			
			<?php	
				if( have_posts() ):
					echo '<div class="list-posts">';
					while( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() ); 
					endwhile;
					echo '</div>';
				else:
					echo '<div class="alert alert-error">'.esc_html__('Sorry. There are no posts to display', 'yoome').'</div>';
				endif;
				
				yoome_pagination();
			?>

		</div>
	</div>
	
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
			<?php dynamic_sidebar( $theme_options['ts_blog_right_sidebar'] ); ?>
		</aside>
	<?php endif; ?>	
		
</div>
<?php get_footer(); ?>
<?php 
get_header();

global $post;

wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_script( 'prettyphoto' );

$theme_options = yoome_get_theme_options();

$show_breadcrumb = apply_filters('yoome_show_breadcrumb_on_single_portfolio', true);
$show_page_title = $theme_options['ts_portfolio_title'];

$container_classes = array();
if( $show_breadcrumb || $show_page_title ){
	$container_classes[] = 'show_breadcrumb_' . $theme_options['ts_breadcrumb_layout'];
}

$video_url = get_post_meta($post->ID, 'ts_video_url', true);

$layout = $theme_options['ts_portfolio_layout'];
$thumbnail_style = $theme_options['ts_portfolio_thumbnail_style'];
$slider_style = $theme_options['ts_portfolio_slider_style'];

$classes = array();
$classes[] = $layout;
$classes[] = $thumbnail_style;
$classes[] = $slider_style;

if( $thumbnail_style == 'gallery' ){
	wp_enqueue_script( 'isotope' );
}

$is_fullwidth = false;
if( $layout == 'top-thumbnail' && $thumbnail_style == 'slider' && ($slider_style == 'fullwidth' || $slider_style == 'center-fullwidth') && empty($video_url) ){
	$is_fullwidth = true;
}
$fullwidth_class = $is_fullwidth?'vc_row wpb_row vc_row-fluid vc_row-no-padding vc_column-gap-default':'';
$fullwidth_data = $is_fullwidth?'data-vc-full-width="true" data-vc-full-width-init="true" data-vc-stretch-content="true"':'';

$container_classes[] = $is_fullwidth?'no-top-padding':'';

$is_slider = false;
if( $thumbnail_style == 'slider' && empty($video_url) ){
	$is_slider = true;
}

yoome_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
?>
<div id="content" class="page-container container-post <?php echo esc_attr(implode(' ', $container_classes)) ?>">
	
	<!-- main-content -->
	<div id="main-content" class="ts-col-24">
		<article class="single single-post single-portfolio <?php echo esc_attr($is_slider?'nav-middle':''); ?> <?php echo esc_attr(implode(' ', $classes)) ?>">
			<!-- Blog Thumbnail -->
			<?php if( $theme_options['ts_portfolio_thumbnail'] ): ?>
			<div class="thumbnail <?php echo esc_attr($is_slider?'loading':''); ?> <?php echo esc_attr($fullwidth_class) ?>" <?php echo trim($fullwidth_data); ?>>
				<?php if( empty($video_url) ): ?>
					<figure>
						<?php
						$gallery = get_post_meta($post->ID, 'ts_gallery', true);
						if( $gallery ){
							$gallery_ids = explode(',', $gallery);
						}
						else{
							$gallery_ids = array();
						}
						
						if( is_array($gallery_ids) && has_post_thumbnail() ){
							array_unshift($gallery_ids, get_post_thumbnail_id());
						}
						foreach( $gallery_ids as $gallery_id ){
							$image_url = '';
							$image_src = wp_get_attachment_image_src($gallery_id, 'full');
							if( $image_src ){
								$image_url = $image_src[0];
							}
								
							echo '<a href="'.$image_url.'" rel="prettyPhoto[portfolio-gallery]">';
							echo wp_get_attachment_image( $gallery_id, 'full' );
							echo '</a>';
						}						
						?>
					</figure>
				<?php 
				else:
					echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
				endif;
				?>
			</div>
			<?php if( $is_fullwidth ): ?>
			<div class="vc_row-full-width"></div>
			<?php endif; ?>
			<?php endif; ?>
			<div class="entry-content">	
				
				<!-- Portfolio Title -->
				<?php if( $theme_options['ts_portfolio_title'] ): ?>
					<h3 class="entry-title"><?php the_title() ?></h3>
				<?php endif; ?>
					
				<!-- Portfolio Content -->
				<?php if( $theme_options['ts_portfolio_content'] ): ?>
					<div class="portfolio-content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
				
				<div class="meta-content">
				
					<!-- Portfolio Custom Field -->
					<?php if( $theme_options['ts_portfolio_custom_field'] ): ?>
						<div class="portfolio-info">
							<span><?php echo esc_html($theme_options['ts_portfolio_custom_field_title']); ?>:</span>
							<div class="custom-field">
								<?php echo do_shortcode( stripslashes( wp_specialchars_decode( $theme_options['ts_portfolio_custom_field_content'] ) ) ) ?>
							</div>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Client -->
					<?php $client = get_post_meta($post->ID, 'ts_client', true); ?>
					<?php if( $theme_options['ts_portfolio_client'] && $client ): ?>
						<div class="portfolio-info">
							<span><?php esc_html_e('Client:', 'yoome') ?></span>
							<span class="client"><?php echo esc_html($client); ?></span>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Year -->
					<?php $year = get_post_meta($post->ID, 'ts_year', true); ?>
					<?php if( $theme_options['ts_portfolio_year'] && $year ): ?>
						<div class="portfolio-info">
							<span><?php esc_html_e('Year:', 'yoome') ?></span>
							<span class="year"><?php echo esc_html($year); ?></span>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Categories -->
					<?php
					$categories_list = get_the_term_list($post->ID, 'ts_portfolio_cat', '', ', ', '');
					if ( $categories_list && $theme_options['ts_portfolio_categories'] ):
					?>
						<div class="portfolio-info">
							<span><?php esc_html_e('Categories:', 'yoome'); ?></span>
							<span class="cat-links"><?php echo wp_kses_post($categories_list); ?></span>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio URL -->
					<?php if( $theme_options['ts_portfolio_url'] ): ?>
						<?php 
						$portfolio_url = get_post_meta($post->ID, 'ts_portfolio_url', true);
						if( $portfolio_url == '' ){
							$portfolio_url = get_the_permalink();
						}
						?>
						<div class="portfolio-info">
							<span><?php esc_html_e('Link:', 'yoome') ?></span>
							<a href="<?php echo esc_url($portfolio_url); ?>" class="portfolio-url"><?php echo esc_url($portfolio_url); ?></a>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Sharing -->
					<?php if( $theme_options['ts_portfolio_sharing'] && function_exists('ts_template_social_sharing') ): ?>
						<div class="portfolio-info">
							<div class="social-sharing">
								<span><?php esc_html_e('Share:', 'yoome'); ?></span>
								<?php ts_template_social_sharing(); ?>
							</div>
						</div>
					<?php endif; ?>
					
					<!-- Portfolio Likes -->
					<?php if( $theme_options['ts_portfolio_likes'] ): ?>
						<div class="portfolio-info like-button">
						<?php
							global $ts_portfolios;
							$like_num = 0;
							$already_like = false;
							if( is_a($ts_portfolios, 'TS_Portfolios') && method_exists($ts_portfolios, 'get_like') ){
								$like_num = $ts_portfolios->get_like($post->ID);
								$already_like = $ts_portfolios->user_already_like($post->ID);
							}
							?>
							<div class="portfolio-like">
								<span class="ic-like <?php echo esc_attr($already_like?'already-like':''); ?>" data-post_id="<?php echo esc_attr($post->ID) ?>"></span>
								<span class="like-num"><?php echo esc_html($like_num); ?></span>
								<?php esc_html_e('Likes', 'yoome'); ?>
							</div>
						</div>
					<?php endif; ?>
				
				</div>
				
			</div>
			
			<!-- Related Posts-->
			<?php 
			if( $theme_options['ts_portfolio_related_posts'] ){
				get_template_part('templates/related-portfolios');
			}
			?>
			
			<!-- Next Prev Portfolio -->
			<div class="single-navigation vc_row wpb_row vc_row-fluid vc_column-gap-default" data-vc-full-width="true" data-vc-full-width-init="true">
				<div class="prev">
					<?php 
					previous_post_link('%link', esc_html__('Prev Project', 'yoome'));
					previous_post_link('%link', '%title');
					?>
				</div>
				<a class="portfolio-page-link" href="<?php echo yoome_get_portfolio_page_info(true); ?>"></a>
				<div class="next">
				<?php
					next_post_link('%link', esc_html__('Next Project', 'yoome'));
					next_post_link('%link', '%title');
				?>
				</div>
			</div>
			<div class="vc_row-full-width"></div>
		</article>
	</div><!-- end main-content -->
	
</div>
<?php get_footer(); ?>
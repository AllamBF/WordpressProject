<?php 
get_header();

global $post;

$theme_options = yoome_get_theme_options();

$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */

$show_blog_thumbnail = $theme_options['ts_blog_details_thumbnail'];

$extra_classes = array();

$page_column_class = yoome_page_layout_columns_class($theme_options['ts_blog_details_layout'], $theme_options['ts_blog_details_left_sidebar'], $theme_options['ts_blog_details_right_sidebar']);

$show_breadcrumb = apply_filters('yoome_show_breadcrumb_on_single_post', true);
$show_page_title = false;

yoome_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());
if( $show_breadcrumb || $show_page_title ){
	$extra_classes[] = 'show_breadcrumb_'.$theme_options['ts_breadcrumb_layout'];
}
?>
<div id="content" class="page-container container-post <?php echo esc_attr(implode(' ', $extra_classes)) ?>">
	<!-- Left Sidebar -->
	<?php if( $page_column_class['left_sidebar'] ): ?>
		<aside id="left-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
			<?php dynamic_sidebar( $theme_options['ts_blog_details_left_sidebar'] ); ?>
		</aside>
	<?php endif; ?>	
	<!-- end left sidebar -->
	
	<!-- main-content -->
	<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">		
		<article class="single single-post">
			<div class="entry-format nav-middle">
				<!-- Blog Thumbnail -->
				<?php if( $show_blog_thumbnail ): ?>
					<?php if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){ ?>
						<figure class="<?php echo ('gallery' == $post_format)?'gallery loading items thumbnail':'thumbnail' ?>">
							<?php 
							
							if( $post_format == 'gallery' ){
								$gallery = get_post_meta($post->ID, 'ts_gallery', true);
								$gallery_ids = explode(',', $gallery);
								if( is_array($gallery_ids) && has_post_thumbnail() ){
									array_unshift($gallery_ids, get_post_thumbnail_id());
								}
								foreach( $gallery_ids as $gallery_id ){
									echo wp_get_attachment_image( $gallery_id, 'yoome_blog_thumb', 0, array('class' => 'thumbnail-blog') );
								}
								
								if( !has_post_thumbnail() && empty($gallery) ){
									$show_blog_thumbnail = 0;
								}
							}
						
							if( ($post_format === false || $post_format == 'standard' || $post_format == 'quote') && !is_singular('ts_feature') ){
								if( has_post_thumbnail() ){
									the_post_thumbnail('yoome_blog_thumb', array('class' => 'thumbnail-blog'));
								}
								else{
									$show_blog_thumbnail = 0;
								}
							}
							
							?>
						</figure>
					<?php 
					}
					
					if( $post_format == 'video' ){
						$video_url = get_post_meta($post->ID, 'ts_video_url', true);
						if( $video_url != '' ){
							echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
						}
					}
					
					if( $post_format == 'audio' ){
						$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
						if( strlen($audio_url) > 4 ){
							$file_format = substr($audio_url, -3, 3);
							if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
								echo do_shortcode('[audio '.$file_format.'="'.esc_url($audio_url).'"]');
							}
							else{
								echo do_shortcode('[ts_soundcloud url="'.esc_url($audio_url).'" width="100%" height="166"]');
							}
						}
					}
					?>
				<?php endif; ?>
			</div>
			<div class="entry-content <?php echo !$show_blog_thumbnail?'no-featured-image':''?>">
				<div class="entry-meta-top <?php echo esc_attr( $theme_options['ts_blog_details_date'] ?'':'hidden-datetime' ); ?>">
					
					<!-- Blog Date Time -->
					<?php if( $theme_options['ts_blog_details_date'] ) : ?>
					<span class="date-time primary-color">
						<?php echo get_the_time( get_option('date_format') ); ?>
					</span>
					<?php endif; ?>
					
					<?php if( $theme_options['ts_blog_details_comment'] || $theme_options['ts_blog_details_like'] ): ?>
					<div class="meta-right">
						<!-- Blog Comment -->
						<?php if( $theme_options['ts_blog_details_comment'] ): ?>
						<span class="comment-count">
							<span class="number">
								<?php yoome_post_comment_count(); ?>
							</span>
						</span>
						<?php endif; ?>
						<!-- Blog Like -->
						<?php
						if( $theme_options['ts_blog_details_like'] && shortcode_exists('ts_post_like_button') ){
							echo do_shortcode( '[ts_post_like_button]' );
						}
						?>
					</div>
					<?php endif; ?>
				
				</div>
				
				<header>
					<!-- Blog Title -->
					<?php if( $theme_options['ts_blog_details_title'] ): ?>
					<h3 class="heading-title entry-title"><?php the_title(); ?></h3>
					<?php endif; ?>
					<!-- Blog Author -->
					<?php if( $theme_options['ts_blog_details_author'] ): ?>
					<span class="vcard author"><?php esc_html_e('Post by ', 'yoome'); ?><?php the_author_posts_link(); ?></span>
					<?php endif; ?>
				</header>
				
				<!-- Blog Content -->
				<?php if( $theme_options['ts_blog_details_content'] ): ?>
				<div class="content-wrapper">
					<div class="full-content"><?php the_content(); ?></div>
					<?php wp_link_pages(); ?>
				</div>
				<?php endif; ?>
			
				<?php 
				$tags_list = get_the_tag_list(' ', '| ');
				$categories_list = get_the_category_list('| ');
				if( !$tags_list ){
					$theme_options['ts_blog_details_tags'] = false;
				}
				if( !$categories_list ){
					$theme_options['ts_blog_details_categories'] = false;
				}
				?>
							
				<div class="entry-meta-bottom">
					<?php if ( $theme_options['ts_blog_details_tags'] || $theme_options['ts_blog_details_categories'] ): ?>
					<div class="meta-bottom-1">
						
						<!-- Blog Tags -->
						<?php if( $theme_options['ts_blog_details_tags'] ): ?>
						<div class="tags-link">
							<?php echo trim($tags_list); ?>
						</div>
						<?php endif; ?>
						
						<!-- Blog Categories -->
						<?php if( $theme_options['ts_blog_details_categories'] ): ?>
						<div class="cats-link">
							<?php echo trim($categories_list); ?>
						</div>
						<?php endif; ?>
						
					</div>
					<?php endif; ?>
					
					
					<div class="meta-bottom-2 <?php echo ( function_exists('ts_template_social_sharing') && $theme_options['ts_blog_details_sharing'] )?'':'hidden-sharing' ?>">
						
						<!-- Next Prev Blog -->
						<div class="single-navigation-1">
						<?php previous_post_link('%link', esc_html__('Prev post', 'yoome')); ?>
						</div>
						
						<!-- Blog Sharing -->
						<?php if( function_exists('ts_template_social_sharing') && $theme_options['ts_blog_details_sharing'] ): ?>
						<div class="social-sharing">
							<?php ts_template_social_sharing(); ?>
						</div>
						<?php endif; ?>
						
						<!-- Next Prev Blog -->
						<div class="single-navigation-2">
						<?php next_post_link('%link', esc_html__('Next post', 'yoome')); ?>
						</div>
						
					</div>
				</div>
			</div>
			
			<!-- Blog Author -->
			<?php if( $theme_options['ts_blog_details_author_box'] && get_the_author_meta('description') ) : ?>
			<div class="entry-author">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 100, 'mystery' ); ?>
				</div>	
				<div class="author-info">		
					<span class="author"><?php the_author_posts_link();?></span>
					<span class="role"><?php echo yoome_get_user_role( get_the_author_meta('ID') ); ?></span>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
			</div>
			<?php endif; ?>	
			
			<!-- Related Posts-->
			<?php 
			if( !is_singular('ts_feature') && $theme_options['ts_blog_details_related_posts'] ){
				get_template_part('templates/related-posts');
			}
			?>
			
			<!-- Comment Form -->
			<?php 
			if( $theme_options['ts_blog_details_comment_form'] && ( comments_open() || get_comments_number() ) ){
				comments_template( '', true );
			}
			?>
		</article>
	</div><!-- end main-content -->
	
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ts-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
			<?php dynamic_sidebar( $theme_options['ts_blog_details_right_sidebar'] ); ?>
		</aside>
	<?php endif; ?>	
	<!-- end right sidebar -->	
</div>
<?php get_footer(); ?>
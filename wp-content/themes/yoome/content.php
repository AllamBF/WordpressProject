<?php 
global $post;
$theme_options = yoome_get_theme_options();
$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
$post_class = 'post-item hentry';
$show_blog_thumbnail = $theme_options['ts_blog_thumbnail'];
$blog_thumb_size = 'yoome_blog_thumb';

if( $theme_options['ts_blog_excerpt_max_words'] == -1 && empty($post->post_excerpt) ){
	$theme_options['ts_blog_read_more'] = 0;
}
?>
<article <?php post_class($post_class) ?> >
	<?php if( $post_format != 'quote' ): ?>
		<div class="<?php echo ( 'gallery' == $post_format )?'nav-middle ':'' ?>entry-format">
			<?php 
			if( $show_blog_thumbnail ){
			
				if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
					if( $post_format != 'gallery' ){
					?>
					<a class="thumbnail <?php echo esc_attr($post_format); ?>" href="<?php the_permalink() ?>">
					<?php }else{ ?>
					<div class="thumbnail gallery loading">	
					<?php } ?>
						<figure>
						<?php 
							if( $post_format == 'gallery' ){
								$gallery = get_post_meta($post->ID, 'ts_gallery', true);
								if( $gallery != '' ){
									$gallery_ids = explode(',', $gallery);
								}
								else{
									$gallery_ids = array();
								}
								
								if( has_post_thumbnail() ){
									array_unshift($gallery_ids, get_post_thumbnail_id());
								}
								foreach( $gallery_ids as $gallery_id ){
									echo '<a class="thumbnail gallery" href="'.esc_url(get_the_permalink()).'">';
									echo wp_get_attachment_image( $gallery_id, $blog_thumb_size, 0, array('class' => 'thumbnail-blog') );
									echo '</a>';
								}
								
								if( empty($gallery_ids) ){
									$show_blog_thumbnail = false;
								}
							}
						
							if( $post_format === false || $post_format == 'standard' ){
								if( has_post_thumbnail() ){
									the_post_thumbnail($blog_thumb_size, array('class' => 'thumbnail-blog'));
								}
								else{
									$show_blog_thumbnail = false;
								}
							}
						?>
						</figure>
					<?php 
					if( $post_format != 'gallery' ){
					?>
					</a>
					<?php }else{ ?>
					</div>
					<?php } ?>
				<?php	
				}
				
				if( $post_format == 'video' ){
					$video_url = get_post_meta($post->ID, 'ts_video_url', true);
					if( $video_url ){
						echo do_shortcode('[ts_video src="'.esc_url($video_url).'"]');
					}
					else{
						$show_blog_thumbnail = false;
					}
				}
				
				if( $post_format == 'audio' ){
					$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
					if( strlen($audio_url) > 4 ){
						$file_format = substr($audio_url, -3, 3);
						if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
							echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
						}
						else{
							echo do_shortcode('[ts_soundcloud url="'.$audio_url.'" width="100%" height="166"]');
						}
					}
					else{
						$show_blog_thumbnail = false;
					}
				}
				
				if( !in_array($post_format, array('gallery', 'standard', 'video', 'audio', 'quote', false)) ){
					$show_blog_thumbnail = false;
				}
			}
			?>
		</div>
		<div class="entry-content <?php echo !$show_blog_thumbnail?'no-featured-image':'' ?>">
			
			<?php if( $theme_options['ts_blog_date'] || $theme_options['ts_blog_comment'] ):  ?>
			<div class="entry-meta-top <?php echo esc_attr( $theme_options['ts_blog_date'] ?'':'hidden-datetime' ); ?>">
			
				<!-- Blog Date Time -->
				<?php if( $theme_options['ts_blog_date'] ) : ?>
				<span class="date-time primary-color">
					<?php echo get_the_time( get_option('date_format') ); ?>
				</span>
				<?php endif; ?>
				
				<?php if( $theme_options['ts_blog_comment'] || $theme_options['ts_blog_like'] ): ?>
				<div class="meta-right">
					<!-- Blog Comment -->
					<?php if( $theme_options['ts_blog_comment'] ): ?>
					<span class="comment-count">
						<span class="number">
							<?php yoome_post_comment_count(); ?>
						</span>
					</span>
					<?php endif; ?>
					<!-- Blog Like -->
					<?php
					if( $theme_options['ts_blog_like'] && shortcode_exists('ts_post_like_button') ){
						echo do_shortcode( '[ts_post_like_button]' );
					}
					?>
				</div>
				<?php endif; ?>
			
			</div>
			<?php endif; ?>
			
			<!-- Blog Title - Author -->
			<?php if( $theme_options['ts_blog_title'] || $theme_options['ts_blog_author'] ): ?>
			<header>
				<?php if( $theme_options['ts_blog_title'] ): ?>
				<h3 class="heading-title entry-title">
					<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
				</h3>
				<?php endif; ?>
				<?php if( $theme_options['ts_blog_author'] ): ?>
				<span class="vcard author"><?php esc_html_e('Post by ', 'yoome'); ?><?php the_author_posts_link(); ?></span>
				<?php endif; ?>
			</header>
			<?php endif; ?>
			
			<!-- Blog Excerpt -->
			<?php if( $theme_options['ts_blog_excerpt'] ): ?>
			<div class="entry-summary">
				<div class="short-content">
					<?php 
					$max_words = (int)$theme_options['ts_blog_excerpt_max_words']?(int)$theme_options['ts_blog_excerpt_max_words']:140;
					$strip_tags = $theme_options['ts_blog_excerpt_strip_tags']?true:false;
					yoome_the_excerpt_max_words($max_words, $post, $strip_tags, '', true); 
					?>
				</div>
				<?php 
				if( $post_format === false || $post_format == 'standard' ){
					wp_link_pages();
				}
				?>
			</div>
			<?php endif; ?>
			
			<!-- Blog Categories -->
			<?php if( $theme_options['ts_blog_categories'] ): ?>
			<div class="entry-meta-middle">
				<div class="cats-link">
					<?php echo get_the_category_list('| '); ?>
				</div>
			</div>	
			<?php endif; ?>
			
			<!-- Blog Read More Button -->
			<?php if( $theme_options['ts_blog_read_more'] ): ?>
			<div class="entry-meta-bottom">
				<a class="button-readmore button-text primary-color" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read More', 'yoome'); ?></a>
			</div>
			<?php endif; ?>
			
		</div>
	
	<?php else: ?>
		<blockquote>
			<?php 
			$quote_content = get_the_excerpt();
			if( !$quote_content ){
				$quote_content = get_the_content();
			}
			echo do_shortcode($quote_content);
			?>
			<!-- Blog Author -->
			<?php if( $theme_options['ts_blog_author'] ): ?>
			<span class="vcard author"><?php the_author_posts_link(); ?></span>
			<?php endif; ?>
		</blockquote>
	<?php endif; ?>
	
</article>
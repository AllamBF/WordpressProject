<?php 
/************************************
*** Custom Post Type Shortcodes
*************************************/
/*** Shortcode Team memmber ***/
function ts_team_members_shortcode($atts){
	extract(shortcode_atts(array(
						'style'				=> 'style-1'
						,'is_slider'		=> 0
						,'limit'			=> 6
						,'ids'				=> ''
						,'columns'			=> 3
						,'target'			=> '_blank'					
						,'show_nav'			=> 1				
						,'auto_play'		=> 1		
						,'margin'			=> 0		
					), $atts ));
	
	$columns = absint($columns);
	if( !in_array($columns, array(1,2,3,4,5,6)) || ($is_slider == 0 && $columns == 5) ){
		$columns = 3;
	}
	
	ob_start();
	global $post, $ts_team_members;
	$thumb_size_name = isset($ts_team_members->thumb_size_name)?$ts_team_members->thumb_size_name:'ts_team_thumb';
	
	$args = array(
				'post_type'				=> 'ts_team'
				,'post_status'			=> 'publish'
				,'posts_per_page'		=> $limit
			);

	if( $ids ){
		$args['post__in'] = array_map('trim', explode(',', $ids));
		$args['orderby'] = 'post__in';
	}
	
	$team = new WP_Query($args);
	if( $team->have_posts() ){
		$classes = array();
		$classes[] = 'ts-team-members ts-shortcode';
		$classes[] = $style;
		$item_class = '';
		$item_extra_class = '';
		if( $is_slider ){
			$classes[] = 'ts-slider';
			if( $show_nav ){
				$classes[] = 'show-nav';
				$classes[] = 'nav-middle';
				$classes[] = 'middle-thumbnail';
			}
			if( $margin ){
				$margin = 30;
				$classes[] = 'has-margin';
			}
		}
		else{
			$item_class = 'ts-col-' . (24/$columns);
		}
		
		$data_attr = array();
		if( $is_slider ){
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-auto_play="'.$auto_play.'"';
			$data_attr[] = 'data-columns="'.$columns.'"';
			$data_attr[] = 'data-margin="'.$margin.'"';
		}
		$key = -1;
		?>
		<div class="<?php echo esc_attr( implode(' ', $classes) ) ?>" <?php echo implode(' ', $data_attr); ?>>
			<div class="items <?php echo $is_slider?'loading':''; ?>">
		<?php
		while( $team->have_posts() ){
			$key ++;
			if( $key == 0 ){
				$item_extra_class = 'first';
			}
			else{
				$item_extra_class = ($key % $columns == 0)?'first':(($key % $columns == $columns - 1)?'last':'');
			}
			$team->the_post();
			$profile_link = get_post_meta($post->ID, 'ts_profile_link', true);
			if( $profile_link == '' ){
				$profile_link = '#';
			}
			$name = get_the_title($post->ID);
			$role = get_post_meta($post->ID, 'ts_role', true);
			
			$facebook_link = get_post_meta($post->ID, 'ts_facebook_link', true);
			$twitter_link = get_post_meta($post->ID, 'ts_twitter_link', true);
			$linkedin_link = get_post_meta($post->ID, 'ts_linkedin_link', true);
			$rss_link = get_post_meta($post->ID, 'ts_rss_link', true);
			$dribbble_link = get_post_meta($post->ID, 'ts_dribbble_link', true);
			$pinterest_link = get_post_meta($post->ID, 'ts_pinterest_link', true);
			$instagram_link = get_post_meta($post->ID, 'ts_instagram_link', true);
			$custom_link = get_post_meta($post->ID, 'ts_custom_link', true);
			$custom_link_icon_class = get_post_meta($post->ID, 'ts_custom_link_icon_class', true);
			
			$social_content = '';
			
			if( $facebook_link ){
				$social_content .= '<a class="facebook" href="'.esc_url($facebook_link).'" target="'.$target.'"><i class="fa fa-facebook"></i></a>';
			}
			if( $twitter_link ){
				$social_content .= '<a class="twitter" href="'.esc_url($twitter_link).'" target="'.$target.'"><i class="fa fa-twitter"></i></a>';
			}
			if( $linkedin_link ){
				$social_content .= '<a class="linked" href="'.esc_url($linkedin_link).'" target="'.$target.'"><i class="fa fa-linkedin"></i></a>';
			}
			if( $rss_link ){
				$social_content .= '<a class="rss" href="'.esc_url($rss_link).'" target="'.$target.'"><i class="fa fa-rss"></i></a>';
			}
			if( $dribbble_link ){
				$social_content .= '<a class="dribbble" href="'.esc_url($dribbble_link).'" target="'.$target.'"><i class="fa fa-dribbble"></i></a>';
			}
			if( $pinterest_link ){
				$social_content .= '<a class="pinterest" href="'.esc_url($pinterest_link).'" target="'.$target.'"><i class="fa fa-pinterest-p"></i></a>';
			}
			if( $instagram_link ){
				$social_content .= '<a class="instagram" href="'.esc_url($instagram_link).'" target="'.$target.'"><i class="fa fa-instagram"></i></a>';
			}
			if( $custom_link ){
				$social_content .= '<a class="custom" href="'.esc_url($custom_link).'" target="'.$target.'"><i class="fa '.esc_attr($custom_link_icon_class).'"></i></a>';
			}
			
			?>
			<div class="item <?php echo $item_class ?> <?php echo (has_post_thumbnail())?'has-thumbnail':'' ?> <?php echo $item_extra_class ?>">
				<div class="team-content">
					<?php if( has_post_thumbnail() ): ?>
					<div class="image-thumbnail">
					
						<div class="image-content">
							<figure>
							<?php the_post_thumbnail($thumb_size_name); ?>
							</figure>
							
							<?php if( $social_content): ?>
							<span class="member-social"><?php echo $social_content; ?></span>
							<?php endif; ?>
						</div>
						
					</div>
					<?php endif; ?>
					
					<div class="team-info">
					
						<header>
							<h3 class="name"><a href="<?php echo esc_url($profile_link); ?>" target="<?php echo esc_attr($target) ?>"><?php echo esc_html($name); ?></a></h3>
							<span class="member-role"><?php echo esc_html($role); ?></span>
						</header>
					
					</div>
				</div>
				
			</div>
			<?php
		}
		?>
			</div>
		</div>
		<?php
	}
	
	wp_reset_postdata();
	
	return ob_get_clean();
}
add_shortcode('ts_team_members', 'ts_team_members_shortcode');

/*** Shortcode Image Box ***/
function ts_image_box_shortcode( $atts ){
	extract(shortcode_atts(array(
						'style'					=> 'style-default'
						,'img_id'				=> ''
						,'img_url'				=> ''
						,'img_size'				=> ''
						,'image_position'		=> 'image-left'
						,'title_small'			=> ''
						,'title'				=> ''
						,'description'			=> ''	
						,'button_text'			=> ''
						,'link' 				=> '#'		
						,'target' 				=> '_blank'
					), $atts ));
	
	ob_start();
	$classes = array();
	$classes[] = 'ts-image-box';
	$classes[] = $style;
	if( $style == 'style-horizontal' ){
		$classes[] = $image_position;
	}
	
	?>
	<div class="<?php echo esc_attr( implode(' ', $classes) ) ?>">
	
		<?php if( $style == 'style-horizontal' && $image_position == 'image-right' ): ?>

		<div class="box-header">
			
			<?php if( strlen($title_small) > 0 && $style== 'style-horizontal' ): ?>
			<h6 class="feature-title-small">
				<?php echo esc_html($title_small); ?>
			</h6>
			<?php endif; ?>
		
			<?php if( strlen($title) > 0 ): ?>
			<h4 class="feature-title heading-title entry-title">
				<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($title); ?></a>
			</h4>
			<?php endif; ?>
			
			<?php if( strlen($description) > 0 ): ?>
			<div class="box-description">
				<?php echo esc_attr($description) ?>
			</div>
			<?php endif; ?>
		
			<?php if( strlen($button_text) > 0): ?>
			<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link)?esc_url($link):'javascript: void(0)' ?>" class="<?php echo($style== 'style-default')?'button button-border':'button-text' ?> see-more"><?php echo esc_html($button_text); ?></a>
			<?php endif; ?>
		
		</div>
		
		<div class="image-thumbnail">
			
			<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link)?esc_url($link):'javascript: void(0)' ?>" class="thumbnail">
				<?php 
				if( $img_url ){
				?>
					<img src="<?php echo esc_url($img_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>''));
				}
				?>
			</a>
			
		</div>
		
		<?php else: ?>
		
		<div class="image-thumbnail">
		
			<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link)?esc_url($link):'javascript: void(0)' ?>" class="thumbnail">
				<?php 
				if( $img_url ){
				?>
					<img src="<?php echo esc_url($img_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>''));
				}
				?>
			</a>
		
		</div>

		<div class="box-header">
			
			<?php if( strlen($title_small) > 0 && $style== 'style-horizontal' ): ?>
			<h6 class="feature-title-small">
				<?php echo esc_html($title_small); ?>
			</h6>
			<?php endif; ?>
		
			<?php if( strlen($title) > 0 ): ?>
			<h4 class="feature-title heading-title entry-title">
				<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($title); ?></a>
			</h4>
			<?php endif; ?>
			
			<?php if( strlen($description) > 0 ): ?>
			<div class="box-description">
				<?php echo esc_attr($description) ?>
			</div>
			<?php endif; ?>
		
			<?php if( strlen($button_text) > 0): ?>
			<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link)?esc_url($link):'javascript: void(0)' ?>" class="<?php echo($style== 'style-default')?'button button-border':'button-text' ?> see-more"><?php echo esc_html($button_text); ?></a>
			<?php endif; ?>
		
		</div>
		
		<?php endif; ?>
		
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_image_box', 'ts_image_box_shortcode');

/*** Shortcode Feature ***/
function ts_feature_shortcode( $atts ){
	extract(shortcode_atts(array(
						'style'						=> 'vertical-icon'
						,'icon_type' 				=> 'fontawesome'
						,'icon_color' 				=> '#666666'
						,'icon_fontawesome' 		=> 'fa fa-laptop'
						,'icon_openiconic'			=> 'vc-oi vc-oi-dial'
						,'icon_typicons'			=> 'typcn typcn-adjust-brightness'
						,'icon_entypo'				=> 'entypo-icon entypo-icon-note'
						,'icon_linecons'			=> 'vc_li vc_li-heart'
						,'icon_monosocial'			=> 'vc-mono vc-mono-fivehundredpx'
						,'icon_material' 			=> 'vc-material vc-material-cake'
						,'icon_linear' 				=> 'lnr lnr-heart'
						,'number_text'				=> '01'
						,'title' 					=> ''
						,'img_id'					=> ''
						,'img_url'					=> ''
						,'excerpt' 					=> ''
						,'link' 					=> ''		
						,'target' 					=> '_blank'
						,'text_style'				=> 'text-default'
						,'extra_class'				=> ''
						,'background_color'			=> '#ffffff'
						,'item_background'			=> ''
					), $atts ));
	
	ob_start();
	
	$icon = $icon_fontawesome;
	if( $icon_type == 'openiconic' && function_exists('vc_icon_element_fonts_enqueue') ){
		$icon = $icon_openiconic;
		vc_icon_element_fonts_enqueue( 'openiconic' );
	}
	elseif( $icon_type == 'typicons' && function_exists('vc_icon_element_fonts_enqueue') ){
		$icon = $icon_typicons;
		vc_icon_element_fonts_enqueue( 'typicons' );
	}
	elseif( $icon_type == 'entypo' && function_exists('vc_icon_element_fonts_enqueue') ){
		$icon = $icon_entypo;
		vc_icon_element_fonts_enqueue( 'entypo' );
	}
	elseif( $icon_type == 'linecons' && function_exists('vc_icon_element_fonts_enqueue') ){
		$icon = $icon_linecons;
		vc_icon_element_fonts_enqueue( 'linecons' );
	}
	elseif( $icon_type == 'monosocial' && function_exists('vc_icon_element_fonts_enqueue') ){
		$icon = $icon_monosocial;
		vc_icon_element_fonts_enqueue( 'monosocial' );
	}
	elseif( $icon_type == 'material' && function_exists('vc_icon_element_fonts_enqueue') ){
		$icon = $icon_material;
		vc_icon_element_fonts_enqueue( 'material' );
	}
	elseif( $icon_type == 'linear' ){
		$icon = $icon_linear;
	}
	
	$classes = array();
	$classes[] = 'ts-feature-wrapper';
	$classes[] = $extra_class;
	$classes[] = $style;
	$classes[] = $text_style;
	$classes[] = $item_background;
	?>
	<div style="<?php echo ($style == 'border-box')?'background:'.esc_attr($background_color):'' ?>" class="<?php echo esc_attr(implode(' ', $classes)) ?>">
	
		<?php if( $style == 'box-image' ): ?>
		<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"></a>
		<?php endif; ?>
		
		<div class="feature-content">
			
			<?php if( $style == 'vertical-icon' || $style == 'horizontal-icon' ): ?>
			<a style="color: <?php echo esc_attr($icon_color); ?>" target="<?php echo esc_attr($target); ?>" class="feature-icon" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>">
				<i class="<?php echo esc_attr($icon); ?>"></i>
			</a>
			<?php elseif( $style == 'box-image' ): ?>
			<div target="<?php echo esc_attr($target); ?>" class="feature-icon" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>">
				<?php 
				if( $img_url != '' ){
				?>
					<img src="<?php echo esc_url($img_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>''));
				}
				?>
			</div>
			<?php else: ?>
			<a target="<?php echo esc_attr($target); ?>" class="feature-icon" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>">
				<?php 
				if( $img_url != '' ){
				?>
					<img src="<?php echo esc_url($img_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>''));
				}
				?>
			</a>
			<?php endif; ?>
			
			<div class="feature-header">
			
				<?php if( $style == 'step-number' ): ?>
					<span class="big-number primary-color">
						<?php echo esc_html($number_text) ?>
					</span>
					
					<?php if( strlen($excerpt) > 0 ): ?>
					<div class="feature-excerpt">
						<?php echo esc_html($excerpt); ?>
					</div>
					<?php endif; ?>
			
					<?php if( strlen($title) > 0 ): ?>
					<h4 class="feature-title heading-title entry-title">
						<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($title); ?></a>
					</h4>
					<?php endif; ?>
					
				<?php else: ?>
				
					<?php if( strlen($title) > 0 ): ?>
					<h4 class="feature-title heading-title entry-title">
						<?php if( $style != 'box-image' ): ?>
							<a target="<?php echo esc_attr($target); ?>" href="<?php echo ($link != '')?esc_url($link):'javascript: void(0)' ?>"><?php echo esc_html($title); ?></a>
						<?php else: 
							echo esc_html($title);
						?>
						<?php endif; ?>
					</h4>
					<?php endif; ?>
				
					<?php if( strlen($excerpt) > 0 ): ?>
					<div class="feature-excerpt">
						<?php echo esc_html($excerpt); ?>
					</div>
					<?php endif; ?>
					
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_feature', 'ts_feature_shortcode');

/*** Shortcode Price Table ***/
function ts_price_table_shortcode( $atts ){
	extract(shortcode_atts(array(
						'active_table' 					=> 0
						,'style'						=> 'style-1'
						,'img_id'						=> ''
						,'img_url'						=> ''
						,'color_scheme'					=> '#27af7d'
						,'title'						=> ''
						,'price' 						=> ''
						,'currency' 					=> ''
						,'during_price' 				=> ''
						,'description'					=> ''
						,'button_text'					=> ''
						,'link'							=> '#'
					), $atts ));
	
	static $ts_price_table_counter = 1;
	$unique_class = 'ts-price-table-' . $ts_price_table_counter;
	$selector = '.' . $unique_class;
	$ts_price_table_counter++;
	
	$inline_style = '<div class="ts-shortcode-custom-style hidden">';
	if( ( $style == 'style-2' ) && $active_table ){
		$inline_style .= $selector.'{background:'.$color_scheme.';}';
	}
	if( $style == 'style-1'){
		$inline_style .= $selector.':before{border-color:'.$color_scheme.';}';
		$inline_style .= $selector.':hover:before{border-color:'.$color_scheme.';}';
		$inline_style .= $selector.' .table-price,'.$selector. '.during-price{color:'.$color_scheme.';}';
		$inline_style .= $selector.' .button-price-table:hover{background:'.$color_scheme.';border-color:'.$color_scheme.';}';
	}
	if($style == 'style-3'){
		$inline_style .= $selector.' header{background:'.$color_scheme.';}';
		if($active_table){
			$inline_style .= $selector.'{border-color:'.$color_scheme.';}';
		}
	}
	if($style == 'style-4'){
		$inline_style .= $selector.' .table-title span{background:'.$color_scheme.';}';
		$inline_style .= $selector.' .button-price-table:hover{background:'.$color_scheme.';border-color:'.$color_scheme.';}';
		$inline_style .= $selector.' .table-title span:before,'.$selector.' .table-title span:after,'.$selector.' .table-title:before,'.$selector.' .table-title:after{border-bottom-color:'.$color_scheme.';border-top-color:'.$color_scheme.';}';
	}
	$inline_style .= '</div>';
	ob_start();
	?>
	<div class="ts-price-table <?php echo esc_attr($unique_class) ?> <?php echo esc_attr($style); ?> <?php echo ($active_table)?'active-table':'' ?>">
		<?php echo trim( $inline_style ); ?>

		<header>
			
			<?php if( ( $style == 'style-2' ) && $title ):?>
			<h3 class="table-title"><?php echo esc_html($title) ?></h3>
			<?php endif; ?>
			
			<?php if( $style == 'style-2' ): ?>
			<div class="group-price">
			<?php endif; ?>
			
				<span class="table-price"><span><?php echo esc_html($currency) ?></span><?php echo esc_html($price) ?></span>
				
				<?php if( $during_price ): ?>
				<span class="during-price"><?php echo esc_html($during_price) ?></span>
				<?php endif;?>
			
			<?php if( $style == 'style-2' ): ?>
			</div>
			<?php endif; ?>
			
			<?php if( ( $style == 'style-1' || $style == 'style-3' ) && $title ):?>
			<h3 class="table-title"><?php echo esc_html($title) ?></h3>
			<?php endif; ?>
			
			<?php if( $style == 'style-4' && $title ):?>
			<h3 class="table-title"><span><?php echo esc_html($title) ?></span></h3>
			<?php endif; ?>
			
			<?php if( $style == 'style-3' && $button_text ): ?>
			<a class="button button-price-table button-border" href="<?php echo esc_url($link) ?>"><?php echo esc_html($button_text) ?></a>
			<?php endif; ?>
			
		</header>
		
		<?php if( $description ): ?>
		<div class="table-description">
			<?php echo strip_tags($description, '<ul></ul><li></li><b></b><strong></strong><i></i>'); ?>
		</div>
		<?php endif; ?>
		
		<?php if( $style != 'style-3' && $button_text ): ?>
		<div class="table-button">
			<a class="button button-price-table button-border" href="<?php echo esc_url($link) ?>"><?php echo esc_html($button_text) ?></a>
		</div>
		<?php endif; ?>
		
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_price_table', 'ts_price_table_shortcode');

/*** Shortcode Testimonial ***/
function ts_testimonial_shortcode($atts){
	extract(shortcode_atts(array(
						'style'					=> 'style-default'
						,'title'				=> ''
						,'categories'			=> ''
						,'per_page'				=> 4
						,'text_color_style'		=> 'text-default'
						,'ids'					=> ''
						,'show_avatar'			=> 1
						,'show_name'			=> 1
						,'show_byline'			=> 1
						,'show_rating'			=> 1
						,'excerpt_words'		=> 40
						,'is_slider'			=> 1
						,'show_nav'				=> 1
						,'show_dots'			=> 0
						,'auto_play'			=> 1
					), $atts ));
	
	if( !is_numeric($excerpt_words) ){
		$excerpt_words = 50;
	}
	
	$classes = array();
	$classes[] = $style;
	$classes[] = $text_color_style;
	if($is_slider){
		$classes[] = 'ts-slider';
		if( $show_dots ){
			$show_nav = 0;
			$classes[] = 'show-dots';
		}
		if( $show_nav ){
			$classes[] = 'show-nav';
			if( $style == 'style-default' ){
				$classes[] = 'nav-bottom';
			}
			else{
				$classes[] = 'nav-middle';
			}
		}
	}
	
	$data_attr = array();
	if( $is_slider ){
		$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
		$data_attr[] = 'data-dots="'.esc_attr($show_dots).'"';
		$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
	}

	global $post, $ts_testimonials;
	
	$args = array(
			'post_type'				=> 'ts_testimonial'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> true
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
		);
		
	$categories = str_replace(' ', '', $categories);
	if( strlen($categories) > 0 ){
		$categories = explode(',', $categories);
	}
	
	if( is_array($categories) && count($categories) > 0 ){
		$field_name = is_numeric($categories[0])?'term_id':'slug';
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'ts_testimonial_cat',
									'terms' => $categories,
									'field' => $field_name,
									'include_children' => false
								)
							);
	}
	
	if( strlen(trim($ids)) > 0 ){
		$ids = array_map('trim', explode(',', $ids));
		if( is_array($ids) && count($ids) > 0 ){
			$args['post__in'] = $ids;
			$args['orderby'] = 'post__in';
		}
	}
	
	$testimonials = new WP_Query($args);
	
	ob_start();
	if( $testimonials->have_posts() ){
		if( isset($testimonials->post_count) && $testimonials->post_count <= 1 ){
			$is_slider = false;
		}
		?>
		<div class="ts-testimonial-wrapper ts-shortcode <?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr); ?>>
	
			<div class="items <?php echo ($is_slider)?'loading':'' ?>">
			<?php
			while( $testimonials->have_posts() ){
				$testimonials->the_post();
				if( function_exists('yoome_the_excerpt_max_words') ){
					$content = yoome_the_excerpt_max_words($excerpt_words, $post, true, '', false);
				}
				else{
					$content = substr(wp_strip_all_tags($post->post_content), 0, 300);
				}
				$byline = get_post_meta($post->ID, 'ts_byline', true);
				$url = get_post_meta($post->ID, 'ts_url', true);
				if( $url == '' ){
					$url = '#';
				}
				$rating = get_post_meta($post->ID, 'ts_rating', true);
				$rating_percent = '0';
				if( $rating != '-1' && $rating != '' ){
					$rating_percent = $rating * 100 / 5;
				}
				
				$show_item_avatar = $show_avatar;
				if( $show_item_avatar ){
					$gravatar_email = get_post_meta($post->ID, 'ts_gravatar_email', true);
					if( !has_post_thumbnail() && ($gravatar_email == '' || !is_email($gravatar_email)) ){
						$show_item_avatar = false;
					}
				}
				?>
				<div class="item">
					<blockquote>
					
						<?php if( $show_item_avatar ): ?>
						<div class="image">
							<?php echo $ts_testimonials->get_image($post->ID); ?>
						</div>
						<?php endif; ?>
						
						<div class="content">
							<?php echo esc_html($content); ?>
						</div>
						
						<p class="author-role">
							<?php if( $show_name ): ?>
							<span class="author">
								<a href="<?php echo esc_url($url); ?>" target="_blank"><?php echo get_the_title($post->ID); ?></a>
							</span>
							<?php endif; ?>
							
							<?php if( $show_byline ): ?>
							<span class="role"><?php echo esc_html($byline); ?></span>
							<?php endif; ?>
							
							<?php if( $show_rating && $rating != '-1' && $rating != ''): ?>
							<div class="rating" title="<?php printf(esc_html__('Rated %s out of 5', 'themesky'), $rating); ?>">
								<span style="width: <?php echo $rating_percent.'%'; ?>"><?php printf(esc_html__('Rated %s out of 5', 'themesky'), $rating); ?></span>
							</div>
							<?php endif; ?>
						</p>
					
					</blockquote>
				</div>
				<?php
			}
			?>
			</div>
		</div>
		<?php
	}
	
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode('ts_testimonial', 'ts_testimonial_shortcode');

/*** Shortcode Portfolio ***/
if( !function_exists('ts_portfolio_shortcode') ){
	function ts_portfolio_shortcode( $atts ){
		extract(shortcode_atts(array(
							'title'				=> ''
							,'title_style'		=> 'title-line-before'
							,'columns'			=> 2
							,'per_page'			=> 8
							,'categories'		=> ''
							,'orderby'			=> 'none'
							,'order'			=> 'DESC'
							,'style'			=> ''
							,'show_filter_bar'	=> 1
							,'show_load_more'	=> 1
							,'load_more_text'	=> 'Show more'
							,'show_title'		=> 1
							,'show_categories'	=> 1
							,'show_like_icon'	=> 1
							,'show_link_icon'	=> 1
							,'margin_item'		=> 1
							,'is_slider'		=> 0
							,'show_nav'			=> 1
							,'nav_position'		=> 'nav-middle'
							,'show_dots'		=> 0
							,'auto_play'		=> 1
							,'include'			=> '' // Used for related portfolio
						), $atts ));
						
		if( $is_slider ){
			$show_filter_bar = 0;
			$show_load_more = 0;
		}
		else{
			wp_enqueue_script( 'isotope' );
		}
		
		$args = array(
			'post_type'				=> 'ts_portfolio'
			,'posts_per_page'		=> $per_page
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'orderby'				=> $orderby
			,'order'				=> $order
		);	
		
		if( $include ){
			$args['post__in'] = array_map('trim', explode(',', $include));
		}
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$ar_categories = explode(',', $categories);
			if( is_array($ar_categories) && count($ar_categories) > 0 ){
				$field_name = is_numeric($ar_categories[0])?'term_id':'slug';
				$args['tax_query']	= array(
							array(
								'taxonomy'	=> 'ts_portfolio_cat'
								,'field'	=> $field_name
								,'terms'	=> $ar_categories
							)
						);
			}
		}
		ob_start();
		global $post, $wp_query, $ts_portfolios;
		$margin = 0;
		$classes = array();
		$classes[] = 'ts-portfolio-wrapper ts-shortcode loading';
		$classes[] = $style;
		if( $is_slider ){
			$classes[] = 'ts-slider';
			$classes[] = $title_style;
			
			if( $show_dots ){
				$show_nav = 0;
				$classes[] = 'show-dots';
			}
			if( $margin_item ){
				$margin = 30;
			}
		}
		else{
			$classes[] = 'ts-masonry columns-' . $columns;
			if( $margin_item ){
				$classes[] = 'has-margin';
			}
			else{
				$classes[] = 'no-margin';
			}
		}
		
		$classes[] = $nav_position;
		
		$posts = new WP_Query( $args );
		if( $posts->have_posts() ){
			if( $posts->max_num_pages == 1 ){
				$show_load_more = 0;
			}
			
			$atts = compact('columns', 'per_page', 'categories', 'orderby', 'order', 'show_filter_bar', 'show_title','show_categories', 'show_like_icon', 'show_link_icon', 'margin', 'is_slider', 'show_nav', 'show_dots', 'auto_play');
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			
			<?php if( strlen($title) > 0 && $is_slider ): ?>
			<header class="shortcode-heading-wrapper">
				<h2 class="heading-title">
					<?php echo esc_html($title); ?>
				</h2>
			</header>
			<?php endif; ?>
			
			<?php
			/* Get filter bar */
			if( $show_filter_bar ){
				$terms = array();
				foreach( $posts->posts as $p ){
					$post_terms = wp_get_post_terms($p->ID, 'ts_portfolio_cat');
					if( is_array($post_terms) ){
						foreach( $post_terms as $term ){
							$terms[$term->slug] = $term->name;
						}
					}
				}
				
				if( !empty($terms) ){
					?>
					<ul class="filter-bar">
						<li data-filter="*" class="current"><?php esc_html_e('All', 'themesky'); ?></li>
						<?php
						foreach( $terms as $slug => $name ){
						?>
						<li data-filter="<?php echo '.'.$slug; ?>"><?php echo esc_attr($name) ?></li>
						<?php
						}
						?>
					</ul>
					<?php
				}
			}
			?>
				<div class="portfolio-inner items">
				<?php
					ts_get_portfolio_items_content_shortcode($atts, $posts);
				?>
				</div>
				
				<?php if( $show_load_more ){ ?>
				<div class="load-more-wrapper">
					<a href="#" class="load-more button" data-total_pages="<?php echo $posts->max_num_pages; ?>" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
				</div>
				<?php } ?>
			</div>
			
			<?php
		}
		
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode('ts_portfolio', 'ts_portfolio_shortcode');

add_action('wp_ajax_ts_portfolio_load_items', 'ts_get_portfolio_items_content_shortcode');
add_action('wp_ajax_nopriv_ts_portfolio_load_items', 'ts_get_portfolio_items_content_shortcode');
if( !function_exists('ts_get_portfolio_items_content_shortcode') ){
	function ts_get_portfolio_items_content_shortcode($atts, $posts = null){
		
		global $post, $ts_portfolios;
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;
			
			extract($atts);
			
			$args = array(
				'post_type'				=> 'ts_portfolio'
				,'posts_per_page'		=> $per_page
				,'post_status'			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'paged' 				=> $paged
				,'orderby'				=> $orderby
				,'order'				=> $order
			);	
			$categories = str_replace(' ', '', $categories);
			if( strlen($categories) > 0 ){
				$categories = explode(',', $categories);
				if( is_array($categories) ){
					$field_name = is_numeric($categories[0])?'term_id':'slug';
					$args['tax_query']	= array(
								array(
									'taxonomy'	=> 'ts_portfolio_cat'
									,'field'	=> $field_name
									,'terms'	=> $categories
								)
							);
				}
			}
			$posts = new WP_Query( $args );
			ob_start();
		}
		
		extract($atts);
		
		if( $posts->have_posts() ):
			while( $posts->have_posts() ): $posts->the_post();
				$classes = '';
				$post_terms = wp_get_post_terms($post->ID, 'ts_portfolio_cat');
				if( is_array($post_terms) ){
					foreach( $post_terms as $term ){
						$classes .= $term->slug . ' ';
					}
				}
				
				$link = esc_url(get_post_meta($post->ID, 'ts_portfolio_url', true));
				if( $link == '' ){
					$link = get_permalink();
				}
				
				/* Get Like */
				$like_num = 0;
				$user_already_like = false;
				if( is_a($ts_portfolios, 'TS_Portfolios') ){
					$like_num = $ts_portfolios->get_like( $post->ID );
					$user_already_like = $ts_portfolios->user_already_like( $post->ID );
				}
				?>
				<div class="item <?php echo esc_attr($classes) ?>">
					<div class="item-wrapper">
						<div class="portfolio-thumbnail">
							<figure>
								<?php 
								if( has_post_thumbnail() ){
									the_post_thumbnail('ts_portfolio_thumb');
								}
								?>							
							</figure>
						</div>
						
						<div class="portfolio-meta">
							<div class="meta-left">
								<?php if( $show_title ){ ?>
								<h3>
									<a href="<?php echo esc_url($link); ?>">
										<?php echo get_the_title(); ?>
									</a>
								</h3>
								<?php } 
								
								$categories_list = get_the_term_list($post->ID, 'ts_portfolio_cat', '', ' / ', '');
								if ( $show_categories && $categories_list ):
								?>
								<div class="cats-portfolio">
									<?php echo $categories_list; ?>
								</div>
								<?php endif; ?>
							</div>
							<div class="icon-group">
								
								<?php if( $show_link_icon ){ ?>
								<a href="<?php echo esc_url($link); ?>" class="link"></a>
								<?php } ?>
								
								<?php if( $show_like_icon ){ ?>
								<a href="#" class="like <?php echo ($user_already_like)?'already-like':'' ?>" 
									data-post_id="<?php echo esc_attr($post->ID) ?>" title="<?php echo ($user_already_like)?esc_html__('You liked it', 'themesky'):esc_html__('Like it', 'themesky') ?>"
									data-liked-title="<?php esc_html_e('You liked it', 'themesky') ?>" data-like-title="<?php esc_html_e('Like it', 'themesky') ?>">
									<?php //echo esc_html($like_num); ?>
								</a>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			<?php
			endwhile;
		endif;
		
		wp_reset_postdata();
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}
		
	}
}

/*** Shortcode Banner ***/
function ts_banner_shortcode( $atts ){
	extract(shortcode_atts(array(
						'text_align'						=> 'text-left'
						,'banner_style'						=> 'style-default'
						,'heading_title'					=> ''
						,'use_theme_fonts'					=> 0
						,'google_fonts'						=> 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal'
						,'heading_title_2'					=> ''
						,'heading_title_3'					=> ''
						,'description'						=> ''
						,'show_button'						=> 0
						,'button_text'						=> 'Shop Now'
						,'heading_text_color'				=> '#ffffff'
						,'heading_text_2_color'				=> '#ffffff'
						,'heading_text_3_color'				=> '#ffffff'
						,'description_text_color'			=> '#ffffff'
						,'button_text_color'				=> '#1f1f1f'
						,'button_text_color_hover'			=> '#ffffff'
						,'button_background_color'			=> '#ffffff'
						,'button_background_hover'			=> '#1f1f1f'
						,'button_border_color'				=> '#ffffff'
						,'button_border_hover'				=> '#1f1f1f'
						,'bg_id'							=> ''
						,'bg_url'							=> ''
						,'img_id'							=> ''
						,'img_url'							=> ''
						,'bg_color'							=> '#000000'
						,'content_position'					=> 'left-top'
						,'content_position_2'				=> 'content-right'
						,'link' 							=> ''
						,'style_effect'						=> 'background-scale'
						,'link_title' 						=> ''						
						,'target' 							=> '_blank'
						,'extra_class'						=> ''
						,'fix_width'						=> 0
						,'image_radius'						=> 0
					), $atts ));

	static $ts_banner_counter = 1;
	$unique_class = 'ts-banner-'.$ts_banner_counter;
	$selector = '.' . $unique_class;
	$ts_banner_counter++;

	
	$style = '<div class="ts-shortcode-custom-style hidden">';
	if( $banner_style == 'style-box-center' || $banner_style == 'style-box-content-shadow'){
		$style .= $selector. ' .box-content{
					background-color: '. $bg_color . ';
				}';
	}
	elseif( $banner_style == 'style-box-image-shadow'){
		$style .= $selector.' .ts-banner-wrapper:before{
					background-color:'.$bg_color.';
				  }';
	}
	elseif( $banner_style == 'style-box-image' ){
		$style .= $selector.' .box-content{
					background-color:'.$bg_color.';
				  }';
	}
	elseif( $banner_style == 'style-simple-text-2-background-color'){
		$style .= $selector.' .box-content:after{
					background-color:'.$bg_color.';
				  }';
	}
	else{
		$style .= $selector.' .ts-banner-wrapper{
					background-color: '. $bg_color . ';
				  }';
	}
	if( $show_button){
		$style .= $selector.' .button, .woocommerce '.$selector.' .button{
					background-color:'.$button_background_color.';
					color:'.$button_text_color.';
					border-color:'.$button_border_color.';
				  }';
		$style .= $selector.' .button:hover, .woocommerce '.$selector.' .button{
					background-color:'.$button_background_hover.';
					color:'.$button_text_color_hover.';
					border-color:'.$button_border_hover.';
				  }';
	}
	$style .= '</div>';
	
	ob_start();
	
	// Google fonts
	$google_fonts_data = array();
	$title_style = array();
	
	if( function_exists('vc_parse_multi_attribute') ){
		$google_fonts_data = vc_parse_multi_attribute( $google_fonts);
	}
	
	$settings = get_option( 'wpb_js_google_fonts_subsets' );
	if ( is_array( $settings ) && ! empty( $settings ) ) {
		$subsets = '&subset=' . implode( ',', $settings );
	} else {
		$subsets = '';
	}
	
	if ( $use_theme_fonts && isset( $google_fonts_data['font_family'] ) ) {
		if( function_exists('vc_build_safe_css_class') ){
			wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['font_family'] ), 'https://fonts.googleapis.com/css?family=' . $google_fonts_data['font_family'] . $subsets, [], WPB_VC_VERSION );
		}
		if( isset( $google_fonts_data['font_style'] ) ){
			$google_fonts_family = explode( ':', $google_fonts_data['font_family'] );
			$title_style[] = 'font-family:' . $google_fonts_family[0].';';
			$google_fonts_styles = explode( ':', $google_fonts_data['font_style'] );
			$title_style[] = 'font-weight:' . $google_fonts_styles[1].';';
			$title_style[] = 'font-style:' . $google_fonts_styles[2].';';
		}
		
	}
	
	if( $banner_style == 'style-box-center'){
		$content_position = 'center-center';
	}
	if( $banner_style == 'style-simple-text-background-color' || $banner_style == 'style-simple-text-2-background-color' ){
		$content_position = $content_position_2;
	}
	if( $banner_style == 'style-simple-text-background-color' || $banner_style == 'style-box-image-shadow' || $banner_style == 'style-box-content-shadow' || $banner_style == 'style-box-border' ){
		$content_position = '';
	}
	
	?>
	<div class="ts-banner <?php echo $fix_width?'fix-width':'' ?> <?php echo esc_attr($banner_style); ?> <?php echo $text_align ?> <?php echo esc_attr($unique_class) ?> <?php echo esc_attr($style_effect) ?> <?php echo esc_attr($content_position) ?> <?php echo $image_radius?'image-radius':''; ?> <?php echo esc_attr($extra_class) ?>">
		<?php echo trim($style); ?>
		<div class="banner-wrapper">
		
			<?php if( $link && !$show_button ): ?>
			<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" class="banner-link" href="<?php echo esc_url($link) ?>" ></a>
			<?php endif;?>
			
			<div class="ts-banner-wrapper">
				<?php if( $banner_style == 'style-box-border' ): ?>
					<div class="box-content">
					
						<header>
							<?php if( $heading_title ): ?>				
							<h2 style="color:<?php echo esc_attr($heading_text_color); ?>"><?php echo esc_attr($heading_title) ?></h2>
							<?php endif; ?>
							
							<?php if( $heading_title_2 ): ?>
							<h3 style="color:<?php echo esc_attr($heading_text_2_color); ?>"><?php echo esc_attr($heading_title_2) ?></h3>
							<?php endif; ?>
							
							<?php if( $description ): ?>
							<div style="color:<?php echo esc_attr($description_text_color); ?>" class="description"><?php echo esc_attr($description) ?></div>
							<?php endif; ?>
							
							<?php if( $show_button ):?>
							<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link) ?>" class="button"><?php echo esc_attr($button_text) ?></a>
							<?php endif; ?>
						</header>
						
						<?php 
						if( $img_url ){
						?>
						<div class="img-content">
							<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($img_url); ?>">
						</div>
						<?php
						}
						else{ ?>
						
						<div class="img-content">
							<?php echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>'img')); ?>
						</div>
						
						<?php
						}
						?>
						
					</div>
					<div class="banner-bg">
						<div class="bg-content">
						<?php 
						if( $bg_url ){
						?>
							<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($bg_url); ?>">
						<?php
						}
						else{
							echo wp_get_attachment_image($bg_id, 'full', 0, array('class'=>'img'));
						}
						?>
						</div>
					</div>
				<?php else: ?>
				
					<?php if( ( $banner_style == 'style-simple-text-background-color' && $content_position_2 == 'content-left' ) || ( $banner_style == 'style-simple-text-2-background-color' ) ): ?>
					
						<div class="box-content">
						
							<header>
								<?php if( $heading_title ): ?>				
								<h2 style="color:<?php echo esc_attr($heading_text_color); ?>; <?php echo ($banner_style == 'style-simple-text-2-background-color')?esc_attr(implode(' ', $title_style)):'' ?>"><?php echo esc_attr($heading_title) ?></h2>
								<?php endif; ?>
								
								<?php if( $heading_title_2 ): ?>
								<h3 style="color:<?php echo esc_attr($heading_text_2_color); ?>"><?php echo esc_attr($heading_title_2) ?></h3>
								<?php endif; ?>
								
								<?php if( $heading_title_3 ) : ?>				
								<h4 style="color:<?php echo esc_attr($heading_text_3_color); ?>"><?php echo esc_attr($heading_title_3) ?></h4>
								<?php endif; ?>
								
								<?php if( $description ): ?>
								<div style="color:<?php echo esc_attr($description_text_color); ?>" class="description"><?php echo esc_attr($description) ?></div>
								<?php endif; ?>
								
								<?php if( $show_button ):?>
								<div class="ts-banner-button">
									<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link) ?>" class="button"><?php echo esc_attr($button_text) ?></a>
								</div>
								<?php endif; ?>
							</header>
							
						</div>
						
						<div class="banner-bg">
							<div class="bg-content">
							<?php 
							if( $bg_url ){
							?>
								<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($bg_url); ?>">
							<?php
							}
							else{
								echo wp_get_attachment_image($bg_id, 'full', 0, array('class'=>'img'));
							}
							?>
							</div>
						</div>
						
					<?php else: ?>
					
						<div class="banner-bg">
							<div class="bg-content">
							<?php 
							if( $bg_url ){
							?>
								<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($bg_url); ?>">
							<?php
							}
							else{
								echo wp_get_attachment_image($bg_id, 'full', 0, array('class'=>'img'));
							}
							?>
							</div>
						</div>
						
						<div class="box-content">
						
							<header>
									<?php if( $heading_title ): ?>				
									<h2 style="color:<?php echo esc_attr($heading_text_color); ?>;<?php echo ($banner_style == 'style-box-center')?esc_attr(implode(' ', $title_style)):'' ?>"><?php echo esc_attr($heading_title) ?></h2>
									<?php endif; ?>
									
									<?php if( $heading_title_2 ): ?>
									<h3 style="color:<?php echo esc_attr($heading_text_2_color); ?>"><?php echo esc_attr($heading_title_2) ?></h3>
									<?php endif; ?>
									
									<?php if( $heading_title_3 && ( $banner_style == 'style-simple-text-3' || $banner_style == 'style-simple-text-background-color' || $banner_style == 'style-simple-text-2-background-color' ) ) : ?>				
									<h4 style="color:<?php echo esc_attr($heading_text_3_color); ?>"><?php echo esc_attr($heading_title_3) ?></h4>
									<?php endif; ?>
									
									<?php if( $description ): ?>
									<div style="color:<?php echo esc_attr($description_text_color); ?>" class="description"><?php echo esc_attr($description) ?></div>
									<?php endif; ?>
									
									
									<?php if( $show_button ):?>
									<div class="ts-banner-button">
										<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link) ?>" class="button"><?php echo esc_attr($button_text) ?></a>
									</div>
									<?php endif; ?>
							</header>
							
							<?php 
							if( $img_url ){
							?>
							<div class="img-product">
								<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($img_url); ?>">
							</div>
							<?php
							}
							else{ ?>
							
							<div class="img-product">
							<?php echo wp_get_attachment_image($img_id, 'full', 0, array('class'=>'img')); ?>
							</div>

							<?php
							}
							?>
							
						</div>
						
					<?php endif; ?>
					
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	<?php
	
	return ob_get_clean();
}
add_shortcode('ts_banner', 'ts_banner_shortcode');

/*** Shortcode Single Image ***/
if( !function_exists('ts_single_image_shortcode') ){
	function ts_single_image_shortcode( $atts ){
		extract(shortcode_atts(array(
							'img_id'			=> ''
							,'img_url'			=> ''
							,'img_size'			=> ''
							,'style_effect'		=> 'eff-widespread-corner-left-right'
							,'effect_color'		=> '#000000'
							,'link' 			=> ''
							,'link_title' 		=> ''						
							,'target' 			=> '_blank'
							,'extra_class' 		=> ''
						), $atts ));
						
		if( $img_size == '' ){
			$img_size = 'full';
		}
		
		ob_start();
		?>
		<div class="ts-single-image ts-effect-image <?php echo esc_attr($style_effect) ?> <?php echo $extra_class ?>">
			<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" class="image-link" href="<?php echo esc_url($link) ?>" >
				<?php 
				if( $img_url != '' ){
				?>
					<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img" src="<?php echo esc_url($img_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_id, $img_size, 0, array('class'=>'img'));
				}
				?> 
				<span class="overlay" style="background:<?php echo esc_attr($effect_color); ?>;border-color:<?php echo esc_attr($effect_color); ?>"></span>
			</a>
		</div>
		<?php
		
		return ob_get_clean();
	}
}
add_shortcode('ts_single_image', 'ts_single_image_shortcode');

/*** Shortcode Banner Image ***/
if( !function_exists('ts_banner_image_shortcode') ){
	function ts_banner_image_shortcode( $atts ){
		extract(shortcode_atts(array(
							'img_bg_id'				=> ''
							,'img_bg_url'			=> ''
							,'img_text_id'			=> ''
							,'img_text_url'			=> ''
							,'img_size'				=> ''
							,'style_effect'			=> 'eff-scale'
							,'img_text_position'	=> 'left-top'
							,'effect_color'			=> '#000000'
							,'link' 				=> ''
							,'link_title' 			=> ''						
							,'target' 				=> '_blank'
							,'fix_width'			=> 0
							,'image_radius'			=> 0
						), $atts ));
						
		if( $img_size == '' ){
			$img_size = 'full';
		}
		if( $style_effect == 'eff-scale' ){
			$effect_color = '#ffffff';
		}
		
		ob_start();
		?>
		<div class="ts-banner-image <?php echo $image_radius?'image-radius':''; ?> <?php echo esc_attr($style_effect) ?> <?php echo esc_attr($img_text_position) ?> <?php echo $fix_width?'fix-width':'' ?>">
			<a title="<?php echo esc_attr($link_title) ?>" target="<?php echo esc_attr($target); ?>" class="image-link" href="<?php echo esc_url($link) ?>" >
				<?php 
				if( $img_bg_url != '' ){
				?>
					<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img bg-image" src="<?php echo esc_url($img_bg_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_bg_id, $img_size, 0, array('class'=>'img bg-image'));
				}
				if( $img_text_url != '' ){
				?>
					<img alt="<?php echo esc_attr($link_title) ?>" title="<?php echo esc_attr($link_title) ?>" class="img text-image" src="<?php echo esc_url($img_text_url); ?>">
				<?php
				}
				else{
					echo wp_get_attachment_image($img_text_id, $img_size, 0, array('class'=>'img text-image'));
				}
				?>
				<span class="overlay" style="background-color:<?php echo esc_attr($effect_color); ?>;border-color:<?php echo esc_attr($effect_color); ?>"></span>
			</a>
		</div>
		<?php
		
		return ob_get_clean();
	}
}
add_shortcode('ts_banner_image', 'ts_banner_image_shortcode');


/*** Shortcode Logo ***/
if( !function_exists('ts_logos_slider_shortcode') ){
	function ts_logos_slider_shortcode( $atts, $content = null ){
		extract(shortcode_atts(array(
					'title'				=> ''
					,'title_style'		=> 'title-line-before'
					,'categories' 		=> ''
					,'style_nav'		=> 'style-default'
					,'per_page' 		=> 7
					,'rows' 			=> 1
					,'active_link'		=> 1
					,'show_nav' 		=> 1
					,'auto_play' 		=> 1
					,'margin_item'		=> 0
					), $atts));
		if( !class_exists('TS_Logos') ){
			return;
		}
		
		$args = array(
			'post_type'				=> 'ts_logo'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
		);
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$categories = explode(',', $categories);
		}
		if( is_array($categories) && count($categories) > 0 ){
			$field_name = is_numeric($categories[0])?'term_id':'slug';
			$args['tax_query'] = array(
									array(
										'taxonomy' => 'ts_logo_cat'
										,'terms' => $categories
										,'field' => $field_name
										,'include_children' => false
									)
								);
		}
		
		$logos = new WP_Query($args);
		
		global $post;
		ob_start();
		if( $logos->have_posts() ):
			$count_posts = $logos->post_count;
			
			$classes = array();
			$classes[] = 'ts-logo-slider-wrapper ts-slider ts-shortcode';
			$classes[] = $style_nav;
			if( !$title ){
				$classes[] = 'nav-middle';
			}
			else{
				$classes[] = 'has-title ' . $title_style;
			}
			if( $count_posts > 1 && $count_posts > $rows ){
				$classes[] = 'loading';
			}
			if( $show_nav ){
				$classes[] = 'show-nav';
			}
			
			$settings_option = get_option('ts_logo_setting', array());
			$data_break_point = isset($settings_option['responsive']['break_point'])?$settings_option['responsive']['break_point']:array();
			$data_item = isset($settings_option['responsive']['item'])?$settings_option['responsive']['item']:array();
			
			$data_attr = array();
			$data_attr[] = 'data-margin="'.absint($margin_item).'"';
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-auto_play="'.$auto_play.'"';
			$data_attr[] = 'data-rows="'.absint($rows).'"';
			$data_attr[] = 'data-break_point="'.htmlentities(json_encode( $data_break_point )).'"';
			$data_attr[] = 'data-item="'.htmlentities(json_encode( $data_item )).'"';
			?>
			<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php if( $title ): ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="heading-title"><?php echo esc_html($title); ?></h2>
				</header>
				<?php endif; ?>
				<div class="content-wrapper">
					<div class="items">
					<?php 
					$count = 0;
					while( $logos->have_posts() ): $logos->the_post(); 
						if( $rows > 1 && $count % $rows == 0 ){
							echo '<div class="logo-group">';
						}
					?>
						<div class="item">
							<?php if( $active_link ):
							$logo_url = get_post_meta($post->ID, 'ts_logo_url', true);
							$logo_target = get_post_meta($post->ID, 'ts_logo_target', true);
							?>
								<a href="<?php echo esc_url($logo_url); ?>" target="<?php echo esc_attr($logo_target); ?>">
							<?php endif; ?>
								<?php 
								if( has_post_thumbnail() ){
									the_post_thumbnail('ts_logo_thumb');
								}
								?>
							<?php if( $active_link ): ?>
								</a>
							<?php endif; ?>
						</div>
					<?php 
						if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $count_posts - 1) ){
							echo '</div>';
						}
						$count++;
					endwhile; 
					?>
					</div>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}
}
add_shortcode('ts_logos_slider', 'ts_logos_slider_shortcode');

/************************************
*** Element Shortcodes
*************************************/

/*** Shortcode Button ***/
function ts_button_shortcode($atts, $content=null){
	extract(shortcode_atts(array(	
					'link'					=> '#'
					,'bg_color'				=> '#ffffff'
					,'bg_color_hover'		=> '#000000'
					,'border_color'			=> '#cccccc'
					,'border_color_hover'	=> '#000000'
					,'border_width'			=> '0'
					,'text_color'			=> '#000000'
					,'text_color_hover'		=> '#ffffff'
					,'font_icon'			=> ''
					,'target'				=> '_self' /* _self, _blank */
					,'size'					=> 'small' /* small, medium, large, x-large */
					,'style'				=> 'square'
					), $atts));
	static $ts_button_counter = 1;		
	$style_css = '';
	$style_hover_css = '';
	$extra_class = '';
	if( $border_width ){
		$extra_class = 'has-border';
	}
	$selector = '.ts-button-wrapper a.ts-button-'.$ts_button_counter;
	
	if( $bg_color ){
		$style_css .= 'background:'.$bg_color.';';
	}
	if( $border_color ){
		$style_css .= 'border-color:'.$border_color.';';
	}
	if( $border_width != '' ){
		$style_css .= 'border-width:'.absint($border_width).'px ;';
	}
	if( $text_color ){
		$style_css .= 'color:'.$text_color.';';
	}
		
	if( $bg_color_hover ){
		$style_hover_css .= 'background:'.$bg_color_hover.';';
	}
	if( $border_color_hover ){
		$style_hover_css .= 'border-color:'.$border_color_hover.';';
	}
	if( $text_color_hover ){
		$style_hover_css .= 'color:'.$text_color_hover.';';
	}
	
	$html = '<div class="ts-button-wrapper '.$extra_class.'">';
	$html .= '<div class="ts-shortcode-custom-style hidden">';
	$html .= $selector.'{';
	$html .= $style_css;
	$html .= '}';
	
	$html .= $selector.':hover{';
	$html .= $style_hover_css;
	$html .= '}';
	$html .= '</div>';
	
	if( $font_icon ){
		$font_icon = 'fa '.$font_icon;
	}
	
	$html .= '<a href="'.esc_url($link).'" target="'.$target.'" class="ts-button ts-button-'.$ts_button_counter.' '.$style.' '.$size.' '.$font_icon.' ">'.do_shortcode($content).'</a>';
	$html .= '</div>';
	
	$ts_button_counter++;
	return $html;
}
add_shortcode('ts_button', 'ts_button_shortcode');

/*** Shortcode MailChimp ***/
if( !function_exists('ts_mailchimp_subscription_shortcode') ){
	function ts_mailchimp_subscription_shortcode( $atts ){
		extract(shortcode_atts(array(	
					'title'				=> ''
					,'intro_text'		=> ''
					,'form'				=> ''
					,'vertical_style'	=> 'vertical-button-icon'
					,'text_style'		=> 'text-default'
					), $atts));
					
		if( !class_exists('TS_Mailchimp_Subscription_Widget') ){
			return;
		}
		
		$intro_html = '';
		if( $intro_text ){
			$intro_html = '<div class="newsletter"><p>'.esc_html($intro_text).'</p></div>';
			$intro_text = '';
		}
		
		$args = array(
			'before_widget' => '<section class="widget-container %s">'
			,'after_widget' => '</section>'
			,'before_title' => '<div class="widget-title-wrapper"><h3 class="widget-title heading-title">'
			,'after_title'  => '</h3>'.$intro_html.'</div>'
		);
		
		$instance = compact('title', 'intro_text', 'form');
		
		ob_start();
		
		$classes = array();
		$classes[] = $vertical_style;
		$classes[] = $text_style;
		
		echo '<div class="ts-mailchimp-subscription-shortcode '.implode(' ', $classes).'" >';
		
		the_widget('TS_Mailchimp_Subscription_Widget', $instance, $args);
		
		echo '</div>';
		
		return ob_get_clean();
	}
}
add_shortcode('ts_mailchimp_subscription', 'ts_mailchimp_subscription_shortcode');

/*** Shortcode Social ***/
if( !function_exists('ts_social_shortcode') ){
	function ts_social_shortcode( $atts ){
		extract(shortcode_atts(array(	
					'title'				=> ''
					,'desc'				=> ''
					,'facebook_url' 	=> ''
					,'twitter_url' 		=> ''
					,'flickr_url' 		=> ''
					,'vimeo_url' 		=> ''
					,'youtube_url' 		=> ''
					,'viber_number' 	=> ''
					,'skype_username' 	=> ''
					,'instagram_url' 	=> ''
					,'pinterest_url' 	=> ''
					,'custom_link' 		=> ''
					,'custom_text' 		=> ''
					,'custom_font' 		=> ''
					,'show_tooltip' 	=> 1
					,'social_style'		=> 'style-square'
					), $atts));
					
		if( !class_exists('TS_Social_Icons_Widget') ){
			return;
		}
		
		$args = array(
			'before_widget' => '<section class="widget-container %s">'
			,'after_widget' => '</section>'
			,'before_title' => '<div class="widget-title-wrapper"><h3 class="widget-title heading-title">'
			,'after_title'  => '</h3></div>'
		);
		
		$instance = compact('title', 'desc', 'facebook_url', 'twitter_url', 'flickr_url', 'vimeo_url', 'youtube_url', 'viber_number', 'skype_username', 'instagram_url', 'pinterest_url', 'custom_link', 'custom_text', 'custom_font', 'show_tooltip', 'social_style');
		
		ob_start();	
		
		the_widget('TS_Social_Icons_Widget', $instance, $args);
			
		return ob_get_clean();
	}
}
add_shortcode('ts_social', 'ts_social_shortcode');

/*** Shortcode Dropcap ***/
function ts_dropcap_shortcode($atts, $content=null){
	extract(shortcode_atts(array(	
					'style'					=> '1'
					), $atts));
	return '<span class="ts-dropcap'.' style-'.$style.'">' .do_shortcode($content). '</span>';
}
add_shortcode('ts_dropcap', 'ts_dropcap_shortcode');

/*** Shortcode Quote ***/
function ts_quote_shortcode($atts, $content = null){
	extract(shortcode_atts(array(
			'style' 			=> 'default'
			,'author' 			=> ''
			,'role' 			=> ''
		), $atts));
	ob_start();
	?>
	<blockquote class="<?php echo esc_attr($style) ?>">
		&ldquo;<?php echo do_shortcode($content); ?>&rdquo;
		<?php if( $author || $role ): ?>
		<p class="author-role">
			<?php if( $author ): ?>
			<span class="author"><?php echo esc_html($author) ?></span>
			<?php endif; ?>
			
			<?php if( $role ): ?>
			<span class="role"><?php echo esc_html($role) ?></span>
			<?php endif; ?>
		</p>
		<?php endif; ?>
	</blockquote>
	<?php
	return ob_get_clean();
}
add_shortcode('ts_quote', 'ts_quote_shortcode');

/*** Shortcode Heading ***/
if( !function_exists('ts_heading_shortcode') ){
	function ts_heading_shortcode($atts, $content = null){
		extract(shortcode_atts(array(
			'style' 				=> 'style-line-before'
			,'size' 				=> '1'
			,'text' 				=> ''
			,'text_style'			=> 'text-default'
		), $atts));
		ob_start();
		$classes = array();
		$classes[] = 'ts-heading';
		$classes[] = 'heading-' . $size;
		$classes[] = $style;
		$classes[] = $text_style;
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
			<h<?php echo esc_attr($size) ?> class="heading"><?php echo do_shortcode($text); ?></h<?php echo esc_attr($size) ?>>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_heading', 'ts_heading_shortcode');

/*** Shortcode Blog ***/
if( !function_exists('ts_blogs_shortcode') ){
	function ts_blogs_shortcode( $atts, $content = null){
		extract(shortcode_atts(array(
					'title'				=> ''
					,'title_style'		=> 'title-line-before'
					,'layout'			=> 'grid'
					,'item_layout'		=> 'grid' /* grid, list */
					,'columns'			=> 3
					,'categories'		=> ''
					,'per_page'			=> 5
					,'orderby'			=> 'none'
					,'order'			=> 'DESC'
					,'show_title'		=> 1
					,'show_thumbnail'	=> 1
					,'show_author'		=> 1
					,'show_date'		=> 1
					,'show_comment'		=> 1
					,'show_like'		=> 1
					,'show_excerpt'		=> 1
					,'show_readmore'	=> 1
					,'excerpt_words'	=> 14
					,'nav_position'		=> 'nav-middle middle-thumbnail'
					,'show_nav'			=> 1
					,'auto_play'		=> 1
					,'margin'			=> 30
					,'show_load_more'	=> 0
					,'load_more_text'	=> 'Show more'
					,'item_background'	=> ''
				), $atts));
		
		if( !is_numeric($excerpt_words) ){
			$excerpt_words = 20;
		}
		
		$is_slider = 0;
		$is_masonry = 0;
		if( $layout == 'slider' ){
			$is_slider = 1;
			if( !$title ){
				$nav_position = 'nav-middle';
			}
		}
		if( $layout == 'masonry' ){
			wp_enqueue_script( 'isotope' );
			$is_masonry = 1;
		}
		
		$columns = absint($columns);
		if( !in_array($columns, array(1, 2, 3, 4, 6)) ){
			$columns = 4;
		}
		
		$args = array(
			'post_type' 			=> 'post'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts' 	=> 1
			,'posts_per_page'		=> $per_page
			,'orderby'				=> $orderby
			,'order'				=> $order
			,'tax_query'			=> array()
		);
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$ar_categories = explode(',', $categories);
			if( is_array($ar_categories) && count($ar_categories) > 0 ){
				$field_name = is_numeric($ar_categories[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' => 'category'
											,'terms' => $ar_categories
											,'field' => $field_name
											,'include_children' => false
										);
			}
		}
		
		if( $item_layout == 'background' ){ // only load the standard posts
			$args['tax_query'][] = array(
					'taxonomy'	=> 'post_format'
					,'field'	=> 'slug'
					,'terms'    => array( 'post-format-audio', 'post-format-gallery', 'post-format-quote', 'post-format-video' )
					,'operator'	=> 'NOT IN'
				);
				
			$show_excerpt = 0;
		}
		
		global $post;
		$posts = new WP_Query($args);
		
		ob_start();
		if( $posts->have_posts() ):
			if( $posts->post_count <= 1 ){
				$is_slider = 0;
			}
			if( $is_slider || $posts->max_num_pages == 1 ){
				$show_load_more = 0;
			}
			
			$classes = array();
			$classes[] = 'ts-blogs-wrapper ts-shortcode ts-blogs';
			$classes[] = 'item-' . $item_layout;
			$classes[] = $item_background;
			$classes[] = $title_style;
			if( $is_slider ){
				$classes[] = 'ts-slider loading';
				if( $show_nav ){
					$classes[] = 'show-nav';
					$classes[] = $nav_position;
				}
			}
			if( $is_masonry ){
				$classes[] = 'ts-masonry';
			}
			
			$atts = compact('layout', 'columns', 'categories', 'per_page', 'orderby', 'order'
							,'item_layout', 'show_title', 'show_thumbnail', 'show_author'
							,'show_date', 'show_comment', 'show_like', 'show_excerpt', 'show_readmore', 'excerpt_words'
							,'is_slider', 'show_nav', 'auto_play', 'margin', 'is_masonry', 'show_load_more', 'item_background');
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			
				<?php if( $title ): ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="heading-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper">
					<div class="blogs items">
						<?php ts_get_blog_items_content_shortcode($atts, $posts); ?>
					</div>
					<?php if( $show_load_more ): ?>
					<div class="load-more-wrapper">
						<a href="#" class="load-more button" data-total_pages="<?php echo $posts->max_num_pages; ?>" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}	
}
add_shortcode('ts_blogs', 'ts_blogs_shortcode');

add_action('wp_ajax_ts_blogs_load_items', 'ts_get_blog_items_content_shortcode');
add_action('wp_ajax_nopriv_ts_blogs_load_items', 'ts_get_blog_items_content_shortcode');
if( !function_exists('ts_get_blog_items_content_shortcode') ){
	function ts_get_blog_items_content_shortcode($atts, $posts = null){
		
		global $post;
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			if( !isset($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$paged = isset($_POST['paged'])?absint($_POST['paged']):1;
			
			extract($atts);
			
			$args = array(
				'post_type' 			=> 'post'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts' 	=> 1
				,'posts_per_page'		=> $per_page
				,'orderby'				=> $orderby
				,'order'				=> $order
				,'paged'				=> $paged
				,'tax_query'			=> array()
			);
			
			$categories = str_replace(' ', '', $categories);
			if( strlen($categories) > 0 ){
				$categories = explode(',', $categories);
			}
			if( is_array($categories) && count($categories) > 0 ){
				$field_name = is_numeric($categories[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' => 'category'
											,'terms' => $categories
											,'field' => $field_name
											,'include_children' => false
										);
			}
			
			if( $item_layout == 'background' ){ // only load the standard posts
				$args['tax_query'][] = array(
						'taxonomy'	=> 'post_format'
						,'field'	=> 'slug'
						,'terms'    => array( 'post-format-audio', 'post-format-gallery', 'post-format-quote', 'post-format-video' )
						,'operator'	=> 'NOT IN'
					);
			}
			
			$posts = new WP_Query($args);
			ob_start();
		}
		
		extract($atts);
		
		$blog_thumb_size = 'yoome_blog_shortcode_thumb';
		
		if( $posts->have_posts() ):
			$item_class = '';
			if( !$is_slider ){
				$item_class = 24/(int)$columns;
				$item_class = 'ts-col-'.$item_class;
			}
			$key = -1;
			$show_thumbnail_old = $show_thumbnail;
			while( $posts->have_posts() ): $posts->the_post();
				$show_thumbnail = $show_thumbnail_old;
			
				$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
				if( $is_slider && $post_format == 'gallery' ){ /* Remove Slider in Slider */
					$post_format = false;
				}
				
				$key++;
				$item_extra_class = ($key % $columns == 0)?'first':(($key % $columns == $columns - 1)?'last':'');
				?>
				<article class="item <?php echo ( $post_format == 'gallery' )?'nav-middle ':'' ?><?php echo esc_attr($post_format); ?> <?php echo esc_attr($item_class.' '.$item_extra_class) ?>">
					<div class="article-content">
					<?php if( $show_thumbnail && $post_format != 'quote' ){ ?>
						<div class="thumbnail-content">
							<?php 
							if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
							?>
								<a class="thumbnail <?php echo esc_attr($post_format); ?> <?php echo ($post_format == 'gallery')?'loading':''; ?>" href="<?php echo ($post_format == 'gallery')?'javascript: void(0)':get_permalink() ?>">
									<figure>
									<?php 
									
									if( $post_format == 'gallery' ){
										$gallery = get_post_meta($post->ID, 'ts_gallery', true);
										$gallery_ids = explode(',', $gallery);
										if( is_array($gallery_ids) && has_post_thumbnail() ){
											array_unshift($gallery_ids, get_post_thumbnail_id());
										}
										foreach( $gallery_ids as $gallery_id ){
											echo wp_get_attachment_image( $gallery_id, $blog_thumb_size );
										}
										
										if( empty($gallery_ids) ){
											$show_thumbnail = false;
										}
									}
									
									if( $post_format === false || $post_format == 'standard' ){
										if( has_post_thumbnail() ){
											the_post_thumbnail( $blog_thumb_size ); 
										}
										else{
											$show_thumbnail = false;
										}
									}
									
									?>
									</figure>
									<div class="effect-thumbnail"></div>
								</a>
								
								
							<?php 
							}
							
							if( $post_format == 'video' ){
								$video_url = get_post_meta($post->ID, 'ts_video_url', true);
								echo do_shortcode('[ts_video src="'.$video_url.'"]');
								$show_thumbnail = false;
							}
							
							if( $post_format == 'audio' ){
								$audio_url = get_post_meta($post->ID, 'ts_audio_url', true);
								$show_thumbnail = false;
								if( strlen($audio_url) > 4 ){
									$file_format = substr($audio_url, -3, 3);
									if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
										echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
									}
									else{
										echo do_shortcode('[ts_soundcloud url="'.$audio_url.'" width="100%" height="122"]');
									}
								}
							}
						?>
						
						</div>
					<?php } ?>
					
					<?php if( $post_format != 'quote' ): ?>
						
						<div class="entry-content">
							
							<?php if( $show_date || $show_comment || $show_like ) : ?>
							
								<div class="entry-meta-top <?php echo( $show_date )?'':'hidden-datetime' ?>">
								
									<!-- Blog Date Time -->
									<?php if( $show_date ) : ?>
									<span class="date-time primary-color">
										<?php echo get_the_time( get_option('date_format') ); ?>
									</span>
									<?php endif; ?>
									
									<?php if( $show_comment || $show_like ): ?>
									<div class="meta-right">
										<!-- Blog Comment -->
										<?php if( $show_comment ): ?>
										<span class="comment-count">
											<span class="number">
												<?php 
												if( function_exists('yoome_post_comment_count') ){
													yoome_post_comment_count();
												}
												?>
											</span>
										</span>
										<?php endif; ?>
										<!-- Blog Like -->
										<?php
										if( $show_like ){
											echo do_shortcode( '[ts_post_like_button]' );
										}
										?>
									</div>
									<?php endif; ?>
									
								</div>
								
							<?php endif; ?>
							
							<?php if( $show_title ): ?>
							<header>
								<h4 class="heading-title entry-title">
									<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
								</h4>
								
								<!-- Blog Author -->
								<?php if( $show_author ): ?>
								<span class="vcard author"><?php esc_html_e('Post by ', 'themesky'); ?><?php the_author_posts_link(); ?></span>
								<?php endif; ?>
								
							</header>
							<?php endif; ?>
							
							<?php if( $show_excerpt && function_exists('yoome_the_excerpt_max_words') ): ?>
							<div class="excerpt"><?php yoome_the_excerpt_max_words($excerpt_words, '', true, '', true); ?></div>
							<?php endif; ?>
							
							<?php if( $show_readmore ): ?>
							<div class="entry-meta-bottom">
								<!-- Blog Read More Button -->
								<a class="button-readmore <?php echo ($item_background)?'button':'button-text' ?>" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read More', 'themesky'); ?></a>
								
							</div>
							<?php endif; ?>
						</div>
							
						<?php else: /* Post format is quote */ ?>
							<div class="quote-wrapper">
								<blockquote>&ldquo; 
									<?php 
									$quote_content = get_the_excerpt();
									if( !$quote_content ){
										$quote_content = get_the_content();
									}
									echo do_shortcode($quote_content);
									?>
								&rdquo;</blockquote>
							</div>
						<?php endif; ?>
					</div>
				</article>
			<?php 
			endwhile;
		endif;
		
		wp_reset_postdata();
		
		if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
			die(ob_get_clean());
		}
		
	}
}

/*** Shortcode Blog ***/
if( !function_exists('ts_blog_videos_shortcode') ){
	function ts_blog_videos_shortcode( $atts, $content = null){
		extract(shortcode_atts(array(
					'title'				=> ''
					,'title_style'		=> 'title-line-before'
					,'categories'		=> ''
					,'orderby'			=> 'none'
					,'order'			=> 'DESC'
					,'show_title'		=> 1
					,'show_author'		=> 1
					,'show_date'		=> 1
					,'show_comment'		=> 1
					,'show_like'		=> 1
					,'show_excerpt'		=> 0
					,'show_readmore'	=> 0
					,'excerpt_words'	=> 14
					,'view_more_text'	=> 'View more'
					,'view_more_link'	=> ''
				), $atts));
		
		if( !is_numeric($excerpt_words) ){
			$excerpt_words = 14;
		}
		
		$args = array(
			'post_type' 			=> 'post'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts' 	=> 1
			,'posts_per_page'		=> 5
			,'orderby'				=> $orderby
			,'order'				=> $order
			,'tax_query'			=> array(
									array(
										'taxonomy'	=> 'post_format'
										,'field'	=> 'slug'
										,'terms'    => array( 'post-format-video' )
										,'operator'	=> 'IN'
									)
			)
			,'meta_query' 			=> array(
									array(
										'key'		=> 'ts_video_url'
										,'value'	=> ''
										,'compare'	=> '!='
									)
			)
		);
		
		$categories = str_replace(' ', '', $categories);
		if( strlen($categories) > 0 ){
			$ar_categories = explode(',', $categories);
			if( is_array($ar_categories) && count($ar_categories) > 0 ){
				$field_name = is_numeric($ar_categories[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' => 'category'
											,'terms' => $ar_categories
											,'field' => $field_name
											,'include_children' => false
										);
			}
		}
		
		global $post;
		$posts = new WP_Query($args);
		
		ob_start();
		if( $posts->have_posts() ):
			add_action('wp_footer', 'ts_blog_videos_popup_modal', 999);
		
			$classes = array();
			$classes[] = 'ts-blog-videos-wrapper ts-shortcode ts-blogs';
			$classes[] = $title_style;
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
			
				<?php if( $title ): ?>
				<header class="shortcode-heading-wrapper">
					<h2 class="heading-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper">
					<div class="blogs items">
					<?php 
					$index = 0;
					$thumb_size_name = 'yoome_blog_thumb';
					while( $posts->have_posts() ){
						$posts->the_post();
						if( ++$index > 1 ){
							$thumb_size_name = 'yoome_blog_shortcode_thumb';
							
							$show_author 	= 0;
							$show_date 		= 0;
							$show_comment 	= 0;
							$show_like 		= 0;
							$show_excerpt 	= 0;
							$show_readmore 	= 0;
						}
						?>
						<article class="item">
							<div class="article-content">
								<div class="thumbnail-content">
									<a class="thumbnail" href="#" data-id="<?php echo esc_attr($post->ID); ?>">
										<figure>
										<?php 
										if( has_post_thumbnail() ){
											the_post_thumbnail( $thumb_size_name ); 
										}
										?>
										</figure>
										<div class="effect-thumbnail"></div>
									</a>
								</div>
								
								<div class="entry-content">
									
									<?php if( $show_date || $show_comment || $show_like ) : ?>
									
										<div class="entry-meta-top">
										
											<!-- Blog Date Time -->
											<?php if( $show_date ) : ?>
											<span class="date-time primary-color">
												<?php echo get_the_time( get_option('date_format') ); ?>
											</span>
											<?php endif; ?>
											
											<?php if( $show_comment || $show_like ): ?>
											<div class="meta-right">
												<!-- Blog Comment -->
												<?php if( $show_comment ): ?>
												<span class="comment-count">
													<span class="number">
														<?php 
														if( function_exists('yoome_post_comment_count') ){
															yoome_post_comment_count();
														}
														?>
													</span>
												</span>
												<?php endif; ?>
												<!-- Blog Like -->
												<?php
												if( $show_like ){
													echo do_shortcode( '[ts_post_like_button]' );
												}
												?>
											</div>
											<?php endif; ?>
											
										</div>
										
									<?php endif; ?>
									
									<?php if( $show_title || $show_author ): ?>
									<header>
										<?php if( $show_title ): ?>
										<h4 class="heading-title entry-title">
											<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
										</h4>
										<?php endif; ?>
										
										<?php if( $show_author ): ?>
										<span class="vcard author"><?php esc_html_e('Post by ', 'themesky'); ?><?php the_author_posts_link(); ?></span>
										<?php endif; ?>
									</header>
									<?php endif; ?>
									
									<?php if( $show_excerpt && function_exists('yoome_the_excerpt_max_words') ): ?>
									<div class="excerpt"><?php yoome_the_excerpt_max_words($excerpt_words, '', true, '', true); ?></div>
									<?php endif; ?>
									
									<?php if( $show_readmore ): ?>
									<div class="entry-meta-bottom">
										<a class="button-readmore button-text" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read More', 'themesky'); ?></a>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</article>
						<?php
					}
					?>	
					</div>
				</div>
				<?php if( $view_more_text && $view_more_link ): ?>
				<div class="view-more">
					<a class="button" href="<?php echo esc_url($view_more_link); ?>"><?php echo esc_html($view_more_text); ?></a>
				</div>
				<?php endif; ?>
			</div>
		<?php
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}	
}
add_shortcode('ts_blog_videos', 'ts_blog_videos_shortcode');

if( !function_exists('ts_blog_videos_popup_modal') ){
	function ts_blog_videos_popup_modal(){
	?>
	<div id="ts-blog-video-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<div class="blog-video-container popup-container">
			<span class="close"></span>
			<div class="blog-video-content"></div>
		</div>
	</div>
	<script>
		jQuery(function($){
			"use strict";
			$('.ts-blog-videos-wrapper a.thumbnail').on('click', function(e){
				e.preventDefault();
				var post_id = $(this).attr('data-id');
				var container = $('#ts-blog-video-modal');
				container.addClass('loading');
				$.ajax({
					type : 'POST'
					,url : ts_shortcode_params.ajax_uri	
					,data : {action : 'ts_load_blog_video', post_id: post_id}
					,success : function(response){
						container.find('.blog-video-content').html( response );
						container.removeClass('loading').addClass('show');
					}
				});
			});
		});
	</script>
	<?php
	}
}

add_action('wp_ajax_ts_load_blog_video', 'ts_load_blog_video' );
add_action('wp_ajax_nopriv_ts_load_blog_video', 'ts_load_blog_video' );
if( !function_exists('ts_load_blog_video') ){
	function ts_load_blog_video(){
		if( isset($_POST['post_id']) ){
			$post_id = $_POST['post_id'];
			$video_url = get_post_meta($post_id, 'ts_video_url', true);
			if( $video_url ){
				wp_die( do_shortcode('[ts_video src="'.esc_url($video_url).'"]') );
			}
		}
		wp_die( esc_html__('Invalid post data', 'themesky') );
	}
}

/* TS Google Map shortcode */
if( !function_exists('ts_google_map_shortcode') ){
	function ts_google_map_shortcode($atts, $content = ''){
		extract(shortcode_atts(array(
						'address'			=> ''
						,'height'			=> 360
						,'zoom'				=> 12
						,'map_type'			=> 'ROADMAP'
						,'title'			=> ''
						,'map_radius'		=> 0
					), $atts));
		$gmap_api_key = function_exists('yoome_get_theme_options')?yoome_get_theme_options('ts_gmap_api_key'):'';
		
		ob_start();	
		
		if( $gmap_api_key ){
			wp_enqueue_script('gmap-api');
			?>
			<div class="<?php echo $map_radius?'map-radius':''; ?> google-map-container" style="height:<?php echo esc_attr($height); ?>px" 
				data-address="<?php echo esc_attr($address) ?>" data-zoom="<?php echo esc_attr($zoom) ?>" data-map_type="<?php echo esc_attr($map_type) ?>" data-title="<?php echo esc_attr($title) ?>">
				<div style="height:<?php echo esc_attr($height); ?>px" class="map-content"></div>
				<?php if( $content ): ?>
				<div class="information">
					<?php echo apply_filters('the_content', $content); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php
		}
		else{
			$params = array(
				rawurlencode( $address )
				,absint( $zoom )
			);
			$url = 'https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$d&amp;output=embed&amp;iwloc=near';
			?>
			<div class="google-map-embed" style="height: <?php echo esc_attr($height); ?>px">
				<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
						src="<?php echo esc_url( vsprintf( $url, $params ) ); ?>"
						height="<?php echo esc_attr($height); ?>"
						width="100%"
						title="<?php echo esc_attr( $address ); ?>"
						aria-label="<?php echo esc_attr( $address ); ?>"
				></iframe>
			</div>
			<?php
		}
		
		return ob_get_clean();
	}
}
add_shortcode('ts_google_map', 'ts_google_map_shortcode');

/* Shortcode Video - Support Youtube and Vimeo video */
if( !function_exists('ts_video_shortcode') ){
	function ts_video_shortcode($atts){
		extract( shortcode_atts(array(
				'src' 		=> '',
				'height' 	=> '450',
				'width' 	=> '800'
			), $atts
		));
	if( $src == '' ){
		return;
	}
	
	$extra_class = '';
	if( !isset($atts['height']) || !isset($atts['width']) ){
		$extra_class = 'auto-size';
	}
	
	$src = ts_parse_video_link($src);
    ob_start();
	?>
		<div class="ts-video <?php echo esc_attr($extra_class); ?>" style="width:<?php echo esc_attr($width) ?>px; height:<?php echo esc_attr($height) ?>px;">
			<iframe width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($src); ?>" allowfullscreen></iframe>
		</div>
	<?php
	return ob_get_clean();
	}
}
add_shortcode('ts_video', 'ts_video_shortcode');

/* Shortcode Video width Placeholder image */
if( !function_exists('ts_video_2_shortcode') ){
	function ts_video_2_shortcode($atts){
		extract( shortcode_atts(array(
				'video_url' 				=> ''
				,'placeholder_image_id' 	=> ''
				,'placeholder_image_url' 	=> ''
			), $atts
		));
		if( $video_url == '' ){
			return;
		}
		
		ob_start();
		if( !$placeholder_image_id && !$placeholder_image_url ){
			echo do_shortcode('[ts_video src="'.$video_url.'"]');
		}
		else{
		?>
		<div class="ts-video-2">
			<a href="#">
				<?php 
				if( $placeholder_image_id ){
					echo wp_get_attachment_image($placeholder_image_id, 'full');
				}
				else{
				?>
				<img src="<?php echo esc_url($placeholder_image_url); ?>" alt="<?php esc_attr_e('Video Placeholder Image', 'themesky'); ?>" />
				<?php } ?>
			</a>
			<div class="ts-popup-modal ts-video-modal">
				<div class="overlay"></div>
				<div class="video-container popup-container">
					<span class="close"></span>
					<div class="video-content">
					<?php echo do_shortcode('[ts_video src="'.$video_url.'"]'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		return ob_get_clean();
	}
}
add_shortcode('ts_video_2', 'ts_video_2_shortcode');

if( !function_exists('ts_parse_video_link') ){
	function ts_parse_video_link( $video_url ){
		if( strstr($video_url, 'youtube.com') || strstr($video_url, 'youtu.be') ){
			preg_match('%(?:youtube\.com/(?:user/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
			if( count($match) >= 2 ){
				return '//www.youtube.com/embed/' . $match[1];
			}
		}
		elseif( strstr($video_url, 'vimeo.com') ){
			preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $match);
			if( count($match) >= 2 ){
				return '//player.vimeo.com/video/' . $match[1];
			}
			else{
				$video_id = explode('/', $video_url);
				if( is_array($video_id) && !empty($video_id) ){
					$video_id = $video_id[count($video_id) - 1];
					return '//player.vimeo.com/video/' . $video_id;
				}
			}
		}
		return $video_url;
	}
}

/* Shortcode SoundCloud */
if( !function_exists('ts_soundcloud_shortocde') ){
	function ts_soundcloud_shortocde( $atts, $content ){
		extract(shortcode_atts(array(
			'params'		=> "color=ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false"
			,'url'			=> ''
			,'width'		=> '100%'
			,'height'		=> '166'
			,'iframe'		=> 1
		),$atts));
		
		$atts = compact( 'params', 'url', 'width', 'height', 'iframe' );
		
		if( $iframe ){
			return ts_soundcloud_iframe_widget( $atts );
		}
		else{ 
			return ts_soundcloud_flash_widget( $atts );
		}
	}
}
add_shortcode('ts_soundcloud','ts_soundcloud_shortocde');


function ts_soundcloud_iframe_widget($options) {
	$url = 'https://w.soundcloud.com/player/?url=' . $options['url'] . '&' . $options['params'];
	$unique_class = 'ts-soundcloud-'.rand();
	$style = '.'.$unique_class.' iframe{width: '.$options['width'].'; height:'.$options['height'].'px;}';
	$style = '<style type="text/css" scoped>'.$style.'</style>';
	return '<div class="ts-soundcloud '.$unique_class.'">'.$style.'<iframe src="'.esc_url( $url ).'"></iframe></div>';
}

function ts_soundcloud_flash_widget( $options ){
	$url = 'https://player.soundcloud.com/player.swf?url=' . $options['url'] . '&' . $options['params'];
	
	return preg_replace('/\s\s+/', '', sprintf('<div class="ts-soundcloud"><object width="%s" height="%s">
							<param name="movie" value="%s"></param>
							<param name="allowscriptaccess" value="always"></param>
							<embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
						  </object></div>', $options['width'], $options['height'], esc_url( $url ), $options['width'], $options['height'], esc_url( $url )));
}

/* Twitter Slider Shortcode */
if( !function_exists('ts_twitter_slider_shortcode') ){
	function ts_twitter_slider_shortcode($atts){
		extract(shortcode_atts(array(
			'title'					=> ''
			,'title_style'			=> 'title-line-before'
			,'username'				=> ''
			,'limit'				=> 4
			,'exclude_replies'		=> 'false'
			,'text_color_style'		=> 'text-default'
			,'show_nav'				=> 1
			,'nav_position'			=> 'nav-middle'
			,'show_dots'			=> 0
			,'auto_play'			=> 1
			,'cache_time'			=> 12
			,'consumer_key'			=> ''
			,'consumer_secret'		=> ''
			,'access_token'			=> ''
			,'access_token_secret'	=> ''
		),$atts));
		
		if( $username == '' ){
			return;
		}
		
		if( $show_dots ){
			$show_nav = 0;
		}
		
		if( $consumer_key == '' || $consumer_secret == '' || $access_token == '' || $access_token_secret == '' ){
			$consumer_key 			= "ZLlLWJ6CXHDMcdWtanbJDqpUL";
			$consumer_secret 		= "1PIVXWtA3bjw32cNQSbrV7Q6bkl4SKDg6LsALDEzkYx8q1u87U";
			$access_token 			= "908339957399351296-UmemaSSE33FO2ZOwkQNmlxm5grBe95T";
			$access_token_secret	= "gVPSftM7oNEiET9q5IVyjehTYO1VZvKtd1HoKimopzQ7P";
		}
		unset($atts['consumer_key']);
		unset($atts['consumer_secret']);
		unset($atts['access_token']);
		unset($atts['access_token_secret']);
		$atts['text_color_style'] = ($text_color_style == 'text-default')? 1: 2;
		$atts['exclude_replies'] = ($exclude_replies == 'false')? 1: 2;
		
		$transient_key = 'twitter_'.implode('', $atts);
		$cache = get_transient($transient_key);
		
		if( $cache !== false ){
			return $cache;
		}
		else{
			if( !class_exists('TwitterOAuth') ){
				require_once THEMESKY_DIR . 'includes/twitteroauth.php';
			}
				
			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
			$tweets = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$username.'&count='.$limit.'&exclude_replies='.$exclude_replies);
			if( !isset($tweets->errors) && is_array($tweets) ){
				ob_start();
				
				$classes = array();
				$classes[] = 'ts-twitter-slider ts-shortcode ts-slider';
				$classes[] = $text_color_style;
				$classes[] = $title_style;
				if( $show_nav ){
					$classes[] = 'show-nav';
					$classes[] = $nav_position;
				}
				if( $show_dots ){
					$classes[] = 'show-dots';
				}
				
				$data_attr = array();
				$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
				$data_attr[] = 'data-dots="'.esc_attr($show_dots).'"';
				$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
				?>
				<div class="ts-shortcode <?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo implode(' ', $data_attr); ?>>
					<?php if( strlen($title) > 0 ): ?>
					<header class="shortcode-heading-wrapper">
						<h2 class="heading-title">
							<?php echo esc_html($title); ?>
						</h2>
					</header>
					<?php endif; ?>
				
					<div class="items loading">
				
					<?php 
					foreach( $tweets as $tweet ){
						$tweet_link = 'http://twitter.com/'.$tweet->user->screen_name.'/statuses/'.$tweet->id;
						$user_link = 'http://twitter.com/'.$tweet->user->screen_name;
						?>
						<div class="item">
							<div class="twitter-content">
								<div class="icon">
									<i class="fa fa-twitter"></i>
								</div>
								<div class="content">
									<?php echo esc_html($tweet->text); ?>
								</div>
								<h4 class="name">
									<a href="<?php echo esc_url($user_link); ?>" target="_blank"><?php echo '@'.esc_html($tweet->user->name); ?></a>
								</h4>
								<div class="date-time">
								<?php 
									echo ts_relative_time($tweet->created_at); 
									esc_html_e(' on ', 'themesky');
								?>
									<a href="<?php echo esc_url($tweet_link); ?>" target="_blank"><?php esc_html_e('Twitter.com', 'themesky') ?></a>
								</div>
							</div>
						</div>
					<?php 
					}
					?>
					</div>
				</div>
				<?php
				
				$output = ob_get_clean();
				set_transient($transient_key, $output, $cache_time * HOUR_IN_SECONDS);
				return $output;
			}
		}
		
	}
}
add_shortcode('ts_twitter_slider', 'ts_twitter_slider_shortcode');

if( !function_exists('ts_relative_time') ){
	function ts_relative_time( $time = '' ){
		if( empty($time) ){
			return '';
		}
		
		$second = 1;
		$minute = 60 * $second;
		$hour = 60 * $minute;
		$day = 24 * $hour;
		$month = 30 * $day;

		$delta = strtotime('+0 hours') - strtotime($time);
		if ($delta < 2 * $minute) {
			return esc_html__('1 min ago', 'themesky');
		}
		if ($delta < 45 * $minute) {
			return floor($delta / $minute) . esc_html__(' min ago', 'themesky');
		}
		if ($delta < 90 * $minute) {
			return esc_html__('1 hour ago', 'themesky');
		}
		if ($delta < 24 * $hour) {
			return floor($delta / $hour) . esc_html__(' hours ago', 'themesky');
		}
		if ($delta < 48 * $hour) {
			return esc_html__('yesterday', 'themesky');
		}
		if ($delta < 30 * $day) {
			return floor($delta / $day) . esc_html__(' days ago', 'themesky');
		}
		if ($delta < 12 * $month) {
			$months = floor($delta / $day / 30);
			return $months <= 1 ? esc_html__('1 month ago', 'themesky') : $months . esc_html__(' months ago', 'themesky');
		} else {
			$years = floor($delta / $day / 365);
			return $years <= 1 ? esc_html__('1 year ago', 'themesky') : $years . esc_html__(' years ago', 'themesky');
		}
	}
}

/* Milestone shortcode */
if( !function_exists('ts_milestone_shortcode') ){
	function ts_milestone_shortcode( $atts ){
		extract( shortcode_atts(array(
				'style'				=> 'style-default'
				,'plus_icon'		=> 0
				,'number'			=> 0
				,'subject'			=> ''
				,'text_color_style'	=> 'text-default'
			), $atts)
		);
		
		wp_enqueue_script( 'jquery-waypoints' );
		wp_enqueue_script( 'jquery-countto' );
		
		if( !is_numeric($number) ){
			$number = 0;
		}
		
		ob_start();
		?>
		<div class="ts-milestone <?php echo esc_attr($text_color_style) ?> <?php echo esc_attr($style) ?>" data-number="<?php echo esc_attr($number); ?>">
			<span class="number">
				<span class="count"><?php echo esc_html($number); ?></span><?php if( $plus_icon ): ?><span class="icon-plus">+</span><?php endif; ?>
			</span>
			<h3 class="subject">
				<?php echo esc_html($subject); ?>
			</h3>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_milestone', 'ts_milestone_shortcode');

/* Countdown shortcode */
if( !function_exists('ts_countdown_shortcode') ){
	function ts_countdown_shortcode( $atts ){
		extract( shortcode_atts(array(
				'style'				=> ''
				,'day'				=> ''
				,'month'			=> ''
				,'year'				=> ''
				,'text_color_style'	=> 'text-default'
				,'seconds'			=> 0 /* Used for product deals */
			), $atts)
		);
		
		if( !$seconds ){
			if( empty($month) || empty($day) || empty($year) ){
				return;
			}
			
			if( !checkdate($month, $day, $year) ){
				return;
			}
			
			$date = mktime(0, 0, 0, $month, $day, $year);
			$current_time = current_time('timestamp');
			$delta = $date - $current_time;
			
			if( $delta <= 0 ){
				return;
			}
		}
		else{
			$delta = $seconds;
		}
		
		$time_day = 60 * 60 * 24;
		$time_hour = 60 * 60;
		$time_minute = 60;
		
		$day = floor( $delta / $time_day );
		$delta -= $day * $time_day;
		
		$hour = floor( $delta / $time_hour );
		$delta -= $hour * $time_hour;
		
		$minute = floor( $delta / $time_minute );
		$delta -= $minute * $time_minute;
		
		if( $delta > 0 ){
			$second = $delta;
		}
		else{
			$second = 0;
		}
		
		$day = zeroise($day, 2);
		$hour = zeroise($hour, 2);
		$minute = zeroise($minute, 2);
		$second = zeroise($second, 2);
		
		ob_start();
		?>
		<div class="ts-countdown <?php echo esc_attr($text_color_style) ?> <?php echo esc_attr($style) ?> ">
			<div class="counter-wrapper days-<?php echo strlen($day); ?>">
				<div class="days">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($day); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Days', 'themesky'); ?>
					</div>
				</div>
				<div class="hours">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($hour); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Hours', 'themesky'); ?>
					</div>
				</div>
				<div class="minutes">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($minute); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Mins', 'themesky'); ?>
					</div>
				</div>
				<div class="seconds">
					<div class="number-wrapper">
						<span class="number"><?php echo esc_html($second); ?></span>
					</div>
					<div class="ref-wrapper">
						<?php esc_html_e('Secs', 'themesky'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_countdown', 'ts_countdown_shortcode');

/* Image Gallery */
if( !function_exists('ts_image_gallery_shortcode') ){
	function ts_image_gallery_shortcode( $atts ){
		extract( shortcode_atts(array(
				'title'					=> ''
				,'title_style' 			=> 'title-line-before'
				,'images' 				=> ''
				,'image_size'			=> 'thumbnail'
				,'is_slider' 			=> 0
				,'columns' 				=> 4
				,'on_click'				=> 'none' /* none, prettyphoto, custom_link */
				,'custom_links' 		=> ''
				,'custom_link_target' 	=> '_self' /* _self, _blank */
				,'show_nav' 			=> 1
				,'nav_position'			=> 'nav-middle'
				,'auto_play' 			=> 1
				,'margin_item' 			=> 0
			), $atts)
		);
		
		$images = str_replace(' ', '', $images);
		if( $images == '' ){
			return;
		}
		$images = explode(',', $images);
		
		if( !$image_size ){
			$image_size = 'full';
		}
		
		if( $custom_links != '' ){
			$custom_links = array_map('trim', explode(',', $custom_links));
		}
		else{
			$custom_links = array();
		}
		
		$columns = absint($columns);
		
		if( $on_click == 'prettyphoto' ){
			wp_enqueue_script( 'prettyphoto' );
			$rel_id = 'ts-gallery-'.mt_rand();
		}
		
		ob_start();
		$margin = 0;
		$classes = array();
		$classes[] = 'ts-image-gallery-wrapper ts-shortcode';
		$classes[] = $title_style;
		$classes[] = $is_slider?'ts-slider':'';
		$classes[] = $margin_item?'has-margin':'';
		$classes[] = 'columns-'.$columns;
		if($margin_item){
			$margin = 20;
		}
		if( !$title ){
			$nav_position = 'nav-middle';
		}
		$data_attr = array();
		if( $is_slider ){
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-autoplay="'.$auto_play.'"';
			$data_attr[] = 'data-columns="'.$columns.'"';
			$data_attr[] = 'data-margin="'.absint($margin).'"';
			if( $show_nav ){
				$classes[] = 'show-nav';
				$classes[] = $nav_position;
			}
		}
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr); ?>>
			<?php if( strlen($title) > 0 ): ?>
			<header class="shortcode-heading-wrapper">
				<h2 class="heading-title">
					<?php echo esc_html($title); ?>
				</h2>
			</header>
			<?php endif; ?>
			<div class="images items <?php echo ($is_slider)?'loading':''; ?>">
				<?php 
				foreach( $images as $index => $image ): 
				$item_classes = array();
				if( !$is_slider){
					if( $columns > 1 ){
						if( $index % $columns == 0 ){
							$item_classes[] = 'first';
						}
						if( $index % $columns == $columns - 1 || $index == count($images) - 1 ){
							$item_classes[] = 'last';
						}
					}
				}
				?>
				<div class="item <?php echo implode(' ', $item_classes); ?>">
					<?php 
					if( $on_click == 'prettyphoto' || $on_click == 'custom_link' ){
						if( $on_click == 'prettyphoto' ){
							$href = wp_get_attachment_url($image);
							$data_rel = 'data-rel="prettyPhoto['.$rel_id.']"';
							$target = '';
						}
						else{
							$href = isset($custom_links[$index])?$custom_links[$index]:'#';
							$data_rel = '';
							$target = 'target="'.$custom_link_target.'"';
						}
						echo '<a class="'.$on_click.'" href="'.esc_url($href).'" '.$data_rel.' '.$target.'>';
					}
					echo wp_get_attachment_image($image, $image_size);
					if( $on_click == 'prettyphoto' || $on_click == 'custom_link' ){
						echo '</a>';
					}
					?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_image_gallery', 'ts_image_gallery_shortcode');

/* Instagram */
if( !function_exists('ts_instagram_shortcode') ){
	function ts_instagram_shortcode( $atts ){
		extract( shortcode_atts(array(
				'title'			=> ''
				,'title_style'	=> 'title-default'
				,'username' 	=> ''
				,'access_token' => ''
				,'number'		=> 9
				,'column' 		=> 5
				,'size' 		=> 'large'
				,'target'		=> '_self'
				,'cache_time' 	=> 12
				,'is_slider'	=> 0
				,'show_nav' 	=> 1
				,'auto_play' 	=> 1
				,'margin_item' 	=> 0
				,'margin' 		=> 0
			), $atts)
		);
		
		if( !class_exists('TS_Instagram_Widget') ){
			return;
		}
		
		$classes = array();
		$classes[] = 'ts-instagram-shortcode ts-shortcode';
		$classes[] = $title_style;
		if( $margin_item ){
			if( !$is_slider ){
				$margin = 30;
			}
			$classes[] = 'has-margin';
		}
		if( $is_slider ){
			$classes[] = 'ts-slider';
			if( $show_nav ){
				$classes[] = 'nav-middle';
			}
		}
		
		$instance = compact('title', 'username', 'access_token', 'number', 'column', 'size', 'target', 'cache_time', 'is_slider', 'show_nav', 'auto_play', 'margin');
		
		$args = array(
			'before_widget' => '<section class="widget-container %s">'
			,'after_widget' => '</section>'
			,'before_title' => '<header class="shortcode-heading-wrapper"><h2 class="widget-title heading-title">'
			,'after_title'  => '</h2></header>'
		);
		
		ob_start();
		
		echo '<div class="'.implode(' ', $classes).'">';
		
		the_widget('TS_Instagram_Widget', $instance, $args);
		
		echo '</div>';
		
		return ob_get_clean();
	}
}
add_shortcode('ts_instagram', 'ts_instagram_shortcode');
?>
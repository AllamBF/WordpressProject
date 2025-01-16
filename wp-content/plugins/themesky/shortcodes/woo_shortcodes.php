<?php
function ts_remove_product_hooks_shortcode( $options = array() ){
	if( isset($options['show_label']) && !$options['show_label'] ){
		remove_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_product_label', 1);
	}
	if( isset($options['show_image']) && !$options['show_image'] ){
		remove_action('woocommerce_before_shop_loop_item_title', 'yoome_template_loop_product_thumbnail', 10);
	}
	
	if( isset($options['show_categories']) && !$options['show_categories'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_categories', 10);
	}
	if( isset($options['show_sku']) && !$options['show_sku'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_sku', 20);
	}
	if( isset($options['show_title']) && !$options['show_title'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_title', 30);
	}
	if( isset($options['show_price']) && !$options['show_price'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 40);
	}
	if( isset($options['show_rating']) && !$options['show_rating'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 45);
	}
	if( isset($options['show_short_desc']) && !$options['show_short_desc'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description', 60);
	}
	if( isset($options['show_add_to_cart']) && !$options['show_add_to_cart'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_add_to_cart', 70);
		remove_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_add_to_cart', 10004 );
	}
	if( isset($options['show_color_swatch']) && $options['show_color_swatch'] && function_exists('yoome_template_loop_product_variable_color') ){
		add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_variable_color', 50);
		if( isset($options['number_color_swatch']) ){
			$number_color_swatch = absint($options['number_color_swatch']);
			add_filter('yoome_loop_product_variable_color_number', function() use ($number_color_swatch){
				return $number_color_swatch;
			});
		}
	}
}

function ts_restore_product_hooks_shortcode(){
	add_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_product_label', 1);
	add_action('woocommerce_before_shop_loop_item_title', 'yoome_template_loop_product_thumbnail', 10);
	
	add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_categories', 10);
	add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_sku', 20);
	add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_title', 30);
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 40);
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 45);
	add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description', 60); 
	add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_add_to_cart', 70); 
	add_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_add_to_cart', 10004 );
	remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_variable_color', 50);
	remove_all_filters('yoome_loop_product_variable_color_number');
}

function ts_filter_product_by_product_type( &$args = array(), $product_type = 'recent' ){
	switch( $product_type ){
		case 'sale':
			$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		break;
		case 'featured':
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);
		break;
		case 'best_selling':
			$args['meta_key'] 	= 'total_sales';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'desc';
		break;
		case 'top_rated':
			$args['meta_key'] 	= '_wc_average_rating';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'desc';
		break;
		case 'mixed_order':
			$args['orderby'] 	= 'rand';
		break;
		default: /* Recent */
			$args['orderby'] 	= 'date';
			$args['order'] 		= 'desc';
		break;
	}
}

function ts_get_product_deals_transient(){
	$key = 'all';
	if( defined('ICL_LANGUAGE_CODE') ){
		$key .= '-' . ICL_LANGUAGE_CODE;
	}
	$transient = get_transient('ts_product_deals_ids');
	if( $transient && isset($transient[$key]) && is_array($transient[$key]) ){
		return $transient[$key];
	}
	return false;
}

function ts_set_product_deals_transient( $value = array() ){
	$key = 'all';
	if( defined('ICL_LANGUAGE_CODE') ){
		$key .= '-' . ICL_LANGUAGE_CODE;
	}
	$transient = get_transient('ts_product_deals_ids');
	if( is_array($transient) ){
		$transient[$key] = $value;
	}
	else{
		$transient = array( $key => $value );
	}
	set_transient( 'ts_product_deals_ids', $transient, MONTH_IN_SECONDS );
}

add_action('wc_after_products_starting_sales', 'ts_delete_product_deals_transient');
add_action('wc_after_products_ending_sales', 'ts_delete_product_deals_transient');
add_action('woocommerce_delete_product_transients', 'ts_delete_product_deals_transient');
function ts_delete_product_deals_transient(){
	set_transient( 'ts_product_deals_ids', false, MONTH_IN_SECONDS );
}

function ts_get_product_deals_ids(){
	$product_ids = ts_get_product_deals_transient();
	if( !is_array($product_ids) ){
		global $post;
		$product_ids = array();
		$args = array(
			'post_type'				=> array('product', 'product_variation')
			,'post_status' 			=> 'publish'
			,'posts_per_page' 		=> -1
			,'meta_query' => array(
				array(
					'key'		=> '_sale_price_dates_to'
					,'value'	=> current_time( 'timestamp', true )
					,'compare'	=> '>'
					,'type'		=> 'numeric'
				)
				,array(
					'key'		=> '_sale_price_dates_from'
					,'value'	=> current_time( 'timestamp', true )
					,'compare'	=> '<'
					,'type'		=> 'numeric'
				)
			)
			,'tax_query'			=> array()
		);
		
		$products = new WP_Query( $args );
		
		if( $products->have_posts() ){
			while( $products->have_posts() ){
				$products->the_post();
				if( $post->post_type == 'product' ){
					$product_ids[] = $post->ID;
				}
				else{ /* Variation product */
					$product_ids[] = $post->post_parent;
				}
			}
		}
		$product_ids = array_unique($product_ids);
		ts_set_product_deals_transient($product_ids);
		wp_reset_postdata();
	}
	
	return $product_ids;
}

/*** Products Shortcode ***/

if( !function_exists('ts_products_shortcode') ){

	function ts_products_shortcode($atts, $content){

		extract(shortcode_atts(array(
				'title'						=> ''
				,'title_style' 				=> 'title-default'
				,'product_type'				=> 'recent'
				,'item_layout' 				=> 'grid'
				,'columns' 					=> 4
				,'per_page' 				=> 4
				,'product_cats'				=> ''
				,'ids'						=> ''
				,'image_border'				=> 0
				,'item_line'				=> 0
				,'text_align'				=> ''
				,'item_background'			=> ''
				,'show_image' 				=> 1
				,'show_title' 				=> 1
				,'show_sku' 				=> 0
				,'show_price' 				=> 1
				,'show_short_desc'  		=> 0
				,'show_rating' 				=> 1
				,'show_label' 				=> 1	
				,'show_categories'			=> 0	
				,'show_add_to_cart' 		=> 1
				,'show_color_swatch'		=> 0
				,'number_color_swatch'		=> 3
				,'shop_more_text'			=> ''
				,'shop_more_link'			=> ''
				,'is_slider'				=> 0
				,'rows' 					=> 1
				,'show_nav'					=> 1
				,'nav_position'				=> 'nav-middle'
				,'auto_play'				=> 0
				,'margin'					=> 30
				,'disable_slider_responsive'=> 0
			), $atts));
			if ( !class_exists('WooCommerce') ){
				return;
			}
			
			$options = array(
					'show_image'			=> $show_image
					,'show_label'			=> $show_label
					,'show_title'			=> $show_title
					,'show_sku'				=> $show_sku
					,'show_price'			=> $show_price
					,'show_short_desc'		=> $show_short_desc
					,'show_categories'		=> $show_categories
					,'show_rating'			=> $show_rating
					,'show_add_to_cart'		=> $show_add_to_cart
					,'show_color_swatch'	=> $show_color_swatch
					,'number_color_swatch'	=> $number_color_swatch
				);
			ts_remove_product_hooks_shortcode( $options );
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page' 		=> $per_page
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			ts_filter_product_by_product_type($args, $product_type);

			$product_cats = str_replace(' ', '', $product_cats);
			if( strlen($product_cats) > 0 ){
				$product_cats = explode(',', $product_cats);
			}
			if( is_array($product_cats) && count($product_cats) > 0 ){
				$field_name = is_numeric($product_cats[0])?'term_id':'slug';
				$args['tax_query'][] = array(
											'taxonomy' => 'product_cat'
											,'terms' => $product_cats
											,'field' => $field_name
											,'include_children' => false
										);
			}
			
			$ids = str_replace(' ', '', $ids);
			if( strlen($ids) > 0 ){
				$ids = explode(',', $ids);
				if( is_array($ids) && count($ids) > 0 ){
					$args['post__in'] = $ids;
					$args['orderby'] = 'post__in';
					if( count($ids) == 1 ){
						$columns = 1;
					}
				}
			}
			
			ob_start();
			global $post;
			if( (int)$columns <= 0 ){
				$columns = 5;
			}
			
			$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
			wc_set_loop_prop('columns', $columns);

			$products = new WP_Query( $args );
			
			$classes = array();
			$classes[] = 'ts-product-wrapper ts-shortcode ts-product';
			$classes[] = $product_type;
			$classes[] = $title_style;
			$classes[] = $text_align;
			$classes[] = 'item-'.$item_layout;
			$classes[] = $item_background;
			if( $item_line ){
				$classes[] = 'item-line';
				$margin = 40;
			}
			if( $show_color_swatch ){
				$classes[] = 'show-color-swatch';
			}
			if( $title_style == 'title-center-line-after' ){
				$classes[] = 'title-center';
			}
			if( $image_border ){
				$classes[] = 'image-border';
			}
			if( $is_slider ){
				$classes[] = 'ts-slider';
				$classes[] = 'rows-'.$rows;
				if( $show_nav ){
					$classes[] = 'show-nav';
					$classes[] = $nav_position;
					if( $nav_position == 'nav-middle' ){
						$classes[] = 'middle-thumbnail';
					}
				}
			}
			
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.$show_nav.'"';
				$data_attr[] = 'data-autoplay="'.$auto_play.'"';
				$data_attr[] = 'data-margin="'.absint($margin).'"';
				$data_attr[] = 'data-columns="'.$columns.'"';
				$data_attr[] = 'data-disable_responsive="'.$disable_slider_responsive.'"';
			}
			
			if( $products->have_posts() ): 
			?>
			<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" <?php echo implode(' ', $data_attr) ?>>
			
				<?php if( strlen($title) > 0 ): ?>
				<header class="shortcode-heading-wrapper">
				
					<?php if( strlen($title) > 0 ): ?>
					<h2 class="heading-title">
						<?php echo esc_html($title); ?>
					</h2>
					<?php endif; ?>
					
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper <?php echo ($is_slider)?'loading':'' ?>">
					<?php
					$count = 0;
					woocommerce_product_loop_start();			

					while( $products->have_posts() ){ 
						$products->the_post();	
						if( $is_slider && $rows > 1 && $count % $rows == 0 ){
							echo '<div class="product-group">';
						}
						wc_get_template_part( 'content', 'product' );
						if( $is_slider && $rows > 1 && ($count % $rows == $rows - 1 || $count == $products->post_count - 1) ){
							echo '</div>';
						}
						$count++;
					}

					woocommerce_product_loop_end();
					?>
				</div>
				
				<?php if( $shop_more_text && $shop_more_link ): ?>
				<div class="shop-more">
					<a class="button-text" href="<?php echo esc_url($shop_more_link); ?>"><?php echo esc_html($shop_more_text) ?></a>
				</div>
				<?php endif; ?>
				
			</div>
			<?php
			endif;
			
			wp_reset_postdata();

			/* restore hooks */
			ts_restore_product_hooks_shortcode();

			wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
			return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';
	}	
}
add_shortcode('ts_products', 'ts_products_shortcode');

/*** Products Widget ***/
if( !function_exists('ts_products_widget_shortcode') ){
	function ts_products_widget_shortcode($atts, $content){
	
		if( !class_exists('TS_Products_Widget') ){
			return;
		}
	
		extract(shortcode_atts(array(
				'product_type'			=> 'recent'
				,'rows' 				=> 3
				,'per_page' 			=> 6
				,'product_cats'			=> ''
				,'title' 				=> ''
				,'title_style' 			=> 'title-line-before'
				,'show_image' 			=> 1
				,'show_title' 			=> 1
				,'show_price' 			=> 1
				,'show_rating' 			=> 1
				,'show_categories'		=> 0
				,'image_border'			=> 0
				,'image_radius'			=> 0
				,'is_slider'			=> 0
				,'show_nav'				=> 1
				,'auto_play'			=> 1
			), $atts));	
		if( trim($product_cats) != '' ){
			$product_cats = array_map('trim', explode(',', $product_cats));
		}
		
		$instance = array(
			'title'					=> $title
			,'title_style'			=> $title_style
			,'product_type'			=> $product_type
			,'product_cats'			=> $product_cats
			,'row'					=> $rows
			,'limit'				=> $per_page
			,'show_thumbnail' 		=> $show_image
			,'show_categories' 		=> $show_categories
			,'show_product_title' 	=> $show_title
			,'show_price' 			=> $show_price
			,'show_rating' 			=> $show_rating
			,'image_border'			=> $image_border
			,'image_radius'			=> $image_radius
			,'is_slider'			=> $is_slider
			,'show_nav' 			=> $show_nav
			,'auto_play' 			=> $auto_play
		);
		
		ob_start();
		the_widget('TS_Products_Widget', $instance);
		return ob_get_clean();
	}
}
add_shortcode('ts_products_widget', 'ts_products_widget_shortcode');

/* Product Category Slider */

if( !function_exists('ts_product_categories_shortcode') ){
	function ts_product_categories_shortcode($atts, $content){
		extract(shortcode_atts(array(
			'title'						=> ''
			,'title_style'				=> 'title-default'
			,'style'					=> 'style-1'
			,'is_slider'				=> 0
			,'per_page' 				=> 5
			,'columns' 					=> 4
			,'first_level' 				=> 0
			,'parent' 					=> ''
			,'child_of' 				=> 0
			,'ids'	 					=> ''
			,'hide_empty'				=> 1
			,'show_title'				=> 1
			,'show_product_count'		=> 0
			,'item_background' 			=> ''
			,'view_shop_button_text'	=> ''
			,'nav_position'				=> 'nav-middle'
			,'show_nav' 				=> 1
			,'auto_play' 				=> 1
			,'margin'					=> 30
		),$atts));

		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( $first_level ){
			$parent = $child_of = 0;
		}

		$args = array(
			'taxonomy'	  => 'product_cat'
			,'orderby'    => 'name'
			,'order'      => 'ASC'
			,'hide_empty' => $hide_empty
			,'include'    => array_map('trim', explode(',', $ids))
			,'pad_counts' => true
			,'parent'     => $parent
			,'child_of'   => $child_of
			,'number'     => $per_page
		);
		if( $ids ){
			$args['orderby'] = 'include';
		}
		$product_categories = get_terms($args);
		
		$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
		wc_set_loop_prop('columns', $columns);
		
		ob_start();
		
		if( count($product_categories) > 0 ):
			$classes = array();
			$classes[] = 'ts-product-category-wrapper ts-product ts-shortcode';
			$classes[] = $title_style;
			$classes[] = $style;
			$classes[] = $is_slider?'ts-slider':'grid';
			$classes[] = $item_background;
			if( $is_slider && $show_nav ){
				$classes[] = 'show-nav';
				$classes[] = $nav_position;
			}
			if( $view_shop_button_text ){
				$classes[] = 'show-button';
			}
		
			$data_attr = array();
			if( $is_slider ){
				$data_attr[] = 'data-nav="'.$show_nav.'"';
				$data_attr[] = 'data-autoplay="'.$auto_play.'"';
				$data_attr[] = 'data-margin="'.$margin.'"';
				$data_attr[] = 'data-columns="'.$columns.'"';
			}
		?>
			<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo implode(' ', $data_attr); ?>>
			
				<?php if( strlen($title) > 0 ): ?>
				<header class="shortcode-heading-wrapper">
				
					<?php if( strlen($title) > 0 ): ?>
					<h2 class="heading-title">
						<?php echo esc_html($title); ?>
					</h2>
					<?php endif; ?>
					
				</header>
				<?php endif; ?>
				
				<div class="content-wrapper <?php echo $is_slider?'loading':''; ?>">
					<?php 
					woocommerce_product_loop_start();
					foreach ( $product_categories as $category ) {
						wc_get_template( 'content-product-cat.php', array(
							'category' 					=> $category
							,'show_title' 				=> $show_title
							,'show_product_count' 		=> $show_product_count
							,'view_shop_button_text' 	=> $view_shop_button_text
						) );
					}
					woocommerce_product_loop_end();
					?>
				</div>
			</div>
		<?php
		endif;
		
		wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
		
		return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';			
	}
}
add_shortcode('ts_product_categories', 'ts_product_categories_shortcode');

/* Product Brands */
if( !function_exists('ts_product_brands_shortcode') ){
	function ts_product_brands_shortcode($atts, $content){
		extract(shortcode_atts(array(
			'title'					=> ''
			,'title_style'			=> ''
			,'use_logo_setting'		=> 1
			,'per_page' 			=> 6
			,'columns' 				=> 5
			,'first_level' 			=> 0
			,'hide_empty'			=> 1
			,'show_title'			=> 1
			,'show_product_count'	=> 0
			,'nav_position'			=> 'nav-middle'
			,'show_nav' 			=> 1
			,'auto_play' 			=> 1
			,'margin'				=> 0
		),$atts));

		if ( !class_exists('WooCommerce') ){
			return;
		}

		$args = array(
			'taxonomy'	  => 'ts_product_brand'
			,'orderby'    => 'name'
			,'order'      => 'ASC'
			,'hide_empty' => $hide_empty
			,'pad_counts' => true
			,'number'     => $per_page
		);
		if( $first_level ){
			$args['parent'] = 0;
		}
		$product_brands = get_terms($args);
		
		ob_start();
		
		if( count($product_brands) > 0 ):
			$classes = array();
			$classes[] = 'ts-product-brand-wrapper ts-product ts-shortcode ts-slider';
			$classes[] = $title_style;
			$classes[] = $use_logo_setting?'use-logo-setting':'';
			if( $show_nav ){
				$classes[] = 'show-nav';
				$classes[] = $nav_position;
			}
		
			$data_attr = array();
			$data_attr[] = 'data-nav="'.$show_nav.'"';
			$data_attr[] = 'data-autoplay="'.$auto_play.'"';
			$data_attr[] = 'data-margin="'.$margin.'"';
			$data_attr[] = 'data-columns="'.$columns.'"';
			
			if( $use_logo_setting ){
				$settings_option = get_option('ts_logo_setting', array());
				$data_break_point = isset($settings_option['responsive']['break_point'])?$settings_option['responsive']['break_point']:array();
				$data_item = isset($settings_option['responsive']['item'])?$settings_option['responsive']['item']:array();
				
				$data_attr[] = 'data-break_point="'.htmlentities(json_encode( $data_break_point )).'"';
				$data_attr[] = 'data-item="'.htmlentities(json_encode( $data_item )).'"';
			}
		?>
			<div class="<?php echo esc_attr(implode(' ', $classes)) ?>" <?php echo implode(' ', $data_attr); ?>>
				<?php if( $title ): ?>
					<header class="shortcode-heading-wrapper">
						<h2 class="heading-title"><?php echo esc_html($title); ?></h2>
					</header>
				<?php endif; ?>
				<div class="content-wrapper loading items">
					<?php 
					foreach( $product_brands as $brand ){
						$brand_link = get_term_link($brand, 'ts_product_brand');
						$thumbnail_id = absint(get_term_meta( $brand->term_id, 'thumbnail_id', true ));
						$image_size = $use_logo_setting?'ts_logo_thumb':'woocommerce_thumbnail';
						?>
						<div class="item">
							<a href="<?php echo esc_url( $brand_link ) ?>">
							<?php
							if( $thumbnail_id ){
								echo wp_get_attachment_image($thumbnail_id, $image_size);
							}
							else{
								echo wc_placeholder_img();
							}
							?>
							</a>
							<div class="meta-wrapper">
								<?php if( $show_title ): ?>
								<h3 class="heading-title">
									<a href="<?php echo esc_url($brand_link); ?>"><?php echo $brand->name; ?></a>
								</h3>
								<?php endif; ?>
								<?php if( $show_product_count ): ?>
								<div class="count"><?php echo sprintf( _n( '%s Product', '%s Products', $brand->count, 'themesky' ), $brand->count ); ?></div>
								<?php endif; ?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		<?php
		endif;
		
		return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';			
	}
}
add_shortcode('ts_product_brands', 'ts_product_brands_shortcode');

/* List of Product Categories */
if( !function_exists('ts_list_of_product_categories_shortcode') ){
	function ts_list_of_product_categories_shortcode( $atts ){
		extract(shortcode_atts(array(
			'title' 				=> ''
			,'banner'				=> ''
			,'parent'				=> ''
			,'direct_child'			=> 1
			,'include_parent'		=> 1
			,'ids'					=> ''
			,'limit'				=> 8
			,'hide_empty'			=> 1
			,'view_more_text'		=> ''
			,'view_more_link'		=> ''
			,'item_background'		=> ''
		), $atts));
		
		if( !class_exists('WooCommerce') ){
			return;
		}
		
		if( $parent && $include_parent ){
			$limit = absint($limit) - 1;
		}
		
		$list_categories = array();
		$args = array(
			'taxonomy'		=> 'product_cat'
			,'hide_empty'	=> $hide_empty
			,'number'		=> $limit
		);
		if( $parent ){
			if( $direct_child ){
				$args['parent'] = $parent;
			}
			else{
				$args['child_of'] = $parent;
			}
		}
		if( $ids ){
			$args['include'] = $ids;
			$args['orderby'] = 'include';
		}
		
		$list_categories = get_terms( $args );
		if( empty($list_categories) ){
			return;
		}
		
		$classes = array();
		$classes[] = 'ts-list-of-product-categories-wrapper ts-shortcode';
		$classes[] = $item_background;
		if( $banner ){
			$classes[] = 'has-banner';
		}
		ob_start();
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
			<div class="list-categories">
				<?php if( $title ): ?>
				<h3 class="heading-title"><?php echo esc_html($title) ?></h3>
				<?php endif; ?>
				<ul>
					<?php 
					if( $parent && $include_parent ){
						$parent_obj = get_term($parent, 'product_cat');
						if( is_object($parent_obj) ){
					?>
						<li><a href="<?php echo get_term_link($parent_obj, 'product_cat'); ?>"><?php echo esc_html($parent_obj->name); ?></a></li>
					<?php
						}
					}
					?>
					
					<?php foreach( $list_categories as $category ): ?>
					<li><a href="<?php echo get_term_link($category, 'product_cat'); ?>"><?php echo esc_html($category->name); ?></a></li>
					<?php endforeach; ?>
					
					<?php if($view_more_text && $view_more_link): ?>
					<a class="button-link" target="_blank" href="<?php echo esc_url($view_more_link) ?>"><?php echo esc_html($view_more_text) ?></a>
					<?php endif; ?>
					
				</ul>
			</div>
			<?php if( $banner ): ?>
			<div class="banner">
				<figure>
				<?php echo wp_get_attachment_image($banner, 'full'); ?>
				</figure>
			</div>
			<?php endif; ?>
		</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode('ts_list_of_product_categories', 'ts_list_of_product_categories_shortcode');

/* TS Product Deals */
if( !function_exists('ts_product_deals_shortcode') ){
	function ts_product_deals_shortcode($atts, $content = null){

		extract(shortcode_atts(array(
				'title'					=> ''
				,'title_style' 			=> 'title-default'
				,'layout' 				=> 'slider'
				,'product_type'			=> 'recent'
				,'columns' 				=> 4
				,'per_page' 			=> 5
				,'product_cats'			=> ''
				,'ids'					=> ''
				,'show_counter'			=> 1
				,'show_image' 			=> 1
				,'show_title' 			=> 1
				,'show_sku' 			=> 0
				,'show_price' 			=> 1
				,'show_short_desc'  	=> 0
				,'short_desc_words'  	=> 8
				,'show_rating' 			=> 1
				,'show_label' 			=> 1	
				,'show_categories'		=> 0	
				,'show_add_to_cart' 	=> 1
				,'shop_more_text'		=> ''
				,'shop_more_link'		=> ''
				,'image_border'			=> 0
				,'text_align'			=> ''
				,'show_nav'				=> 1
				,'nav_position'			=> 'nav-middle'
				,'auto_play'			=> 1
				,'margin'				=> 30
			), $atts));			

			if( !class_exists('WooCommerce') ){
				return;
			}
			
			$product_ids_on_sale = ts_get_product_deals_ids();
			
			if( $ids ){
				$ids = array_map('trim', explode(',', $ids));
				$product_ids_on_sale = array_intersect($product_ids_on_sale, $ids);
			}
			
			if( !$product_ids_on_sale ){
				return;
			}
			
			$per_page = absint($per_page);
			
			add_filter('yoome_grid_short_desc_limit_words', function() use ($short_desc_words){
				return absint($short_desc_words);
			});
			
			if( $show_counter ){
				add_action('woocommerce_after_shop_loop_item', 'ts_template_loop_time_deals', 65);
			}
			
			/* Remove hook */
			$options = array(
					'show_image'		=> $show_image
					,'show_label'		=> $show_label
					,'show_title'		=> $show_title
					,'show_sku'			=> $show_sku
					,'show_price'		=> $show_price
					,'show_short_desc'	=> $show_short_desc
					,'show_categories'	=> $show_categories
					,'show_rating'		=> $show_rating
					,'show_add_to_cart'	=> $show_add_to_cart
				);
			ts_remove_product_hooks_shortcode( $options );

			global $post, $product;
			if( (int)$columns <= 0 ){
				$columns = 5;
			}
			
			$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
			wc_set_loop_prop('columns', $columns);
			
			$args = array(
				'post_type'				=> 'product'
				,'post_status' 			=> 'publish'
				,'posts_per_page' 		=> $per_page
				,'orderby' 				=> 'date'
				,'order' 				=> 'desc'
				,'post__in'				=> $product_ids_on_sale
				,'meta_query' 			=> WC()->query->get_meta_query()
				,'tax_query'           	=> WC()->query->get_tax_query()
			);
			
			ts_filter_product_by_product_type($args, $product_type);
			
			if( $product_cats ){
				$product_cats = array_map('trim', explode(',', $product_cats));
				$args['tax_query'][] = array(
								'taxonomy' 	=> 'product_cat'
								,'terms' 	=> $product_cats
								,'field' 	=> 'term_id'
							);
			}
			
			$products = new WP_Query($args);
			
			ob_start();
			
			if( $products->have_posts() ): 
				$classes = array();
				$classes[] = 'ts-product-deals-wrapper ts-shortcode ts-product';
				$classes[] = $show_image?'':'no-thumbnail';
				$classes[] = $text_align;
				$classes[] = 'layout-' . $layout;
				$classes[] = $title_style;
				if( $image_border ){
					$classes[] = 'image-border';
				}
				if( $layout == 'slider' ){
					$classes[] = 'ts-slider';
					if( $nav_position == 'nav-middle' ){
						$classes[] = 'middle-thumbnail';
					}
					$classes[] = $nav_position;
				}
				$classes = array_filter($classes);
				
				$data_attr = array();
				if( $layout == 'slider' ){
					$data_attr[] = 'data-nav="'.esc_attr($show_nav).'"';
					$data_attr[] = 'data-autoplay="'.esc_attr($auto_play).'"';
					$data_attr[] = 'data-margin="'.esc_attr($margin).'"';
					$data_attr[] = 'data-columns="'.esc_attr($columns).'"';
				}
				?>
				<div class="<?php echo esc_attr( implode(' ', $classes) ); ?>" <?php echo implode(' ', $data_attr); ?>>
				
					<?php if( strlen($title) > 0 ): ?>
					<header class="shortcode-heading-wrapper">
					
						<?php if( strlen($title) > 0 ): ?>
						<h2 class="heading-title">
							<?php echo esc_html($title); ?>
						</h2>
						<?php endif; ?>
						
					</header>
					<?php endif; ?>
					
					<div class="content-wrapper <?php echo ($layout == 'slider')?'loading':''; ?>">
						<?php woocommerce_product_loop_start(); ?>				

						<?php while( $products->have_posts() ): $products->the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>							
						<?php endwhile; ?>			

						<?php woocommerce_product_loop_end(); ?>
					</div>
					
					<?php if( strlen($shop_more_text) > 0 ): ?>
					<div class="shop-more">
						<a class="button-text" href="<?php echo esc_url($shop_more_link); ?>"><?php echo esc_html($shop_more_text) ?></a>
					</div>
					<?php endif; ?>
					
				</div>
				<?php
			endif;
			
			wp_reset_postdata();
			
			/* restore hooks */
			if( $show_counter ){
				remove_action('woocommerce_after_shop_loop_item', 'ts_template_loop_time_deals', 65);
			}
			
			remove_all_filters('yoome_grid_short_desc_limit_words');

			ts_restore_product_hooks_shortcode();

			wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
			
			return '<div class="woocommerce columns-'.$columns.'">' . ob_get_clean() . '</div>';
	}
}
add_shortcode('ts_product_deals', 'ts_product_deals_shortcode');

if( !function_exists('ts_product_availability_bar') ){
	function ts_product_availability_bar(){
		global $product;
		$total_sales = $product->get_total_sales();
		$stock_quantity = $product->get_stock_quantity();
		if( $stock_quantity ){
			$total = $total_sales + $stock_quantity;
			$percent = $stock_quantity * 100 / $total;
		?>
		<div class="availability-bar">
			<span class="available"><?php esc_html_e('Available:', 'themesky') ?> <?php echo esc_html($stock_quantity) ?></span>
			<span class="sold"><?php esc_html_e('Already Sold:', 'themesky') ?> <?php echo esc_html($total_sales) ?></span>
			<div class="progress-bar">
				<span style="width:<?php echo number_format($percent, 2) ?>%"></span>
			</div>
		</div>
		<?php
		}
	}
}

if( !function_exists('ts_template_loop_time_deals') ){
	function ts_template_loop_time_deals(){
		global $product;
		$date_to = '';
		$date_from = '';
		if( $product->get_type() == 'variable' ){
			$children = $product->get_children();
			if( is_array($children) && count($children) > 0 ){
				foreach( $children as $children_id ){
					$date_to = get_post_meta($children_id, '_sale_price_dates_to', true);
					$date_from = get_post_meta($children_id, '_sale_price_dates_from', true);
					if( $date_to != '' ){
						break;
					}
				}
			}
		}
		else{
			$date_to = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
			$date_from = get_post_meta($product->get_id(), '_sale_price_dates_from', true);
		}
		
		$current_time = current_time('timestamp', true);
		
		if( $date_to == '' || $date_from == '' || $date_from > $current_time || $date_to < $current_time ){
			return;
		}
		
		$delta = $date_to - $current_time;
		
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

		?>
		<div class="counter-wrapper days-<?php echo strlen($day); ?>">
			<div class="days">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($day); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('days', 'themesky'); ?>
				</div>
			</div>
			<div class="hours">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($hour); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('hours', 'themesky'); ?>
				</div>
			</div>
			<div class="minutes">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($minute); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('mins', 'themesky'); ?>
				</div>
			</div>
			<div class="seconds">
				<div class="number-wrapper">
					<span class="number"><?php echo esc_html($second); ?></span>
				</div>
				<div class="ref-wrapper">
					<?php esc_html_e('secs', 'themesky'); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

/* Product in category tabs */
if( !function_exists('ts_products_in_category_tabs_shortcode') ){
	function ts_products_in_category_tabs_shortcode($atts, $content){

		extract(shortcode_atts(array(
			'title'							=> ''
			,'tab_heading_style' 			=> 'tab-heading-vertical'
			,'product_type'					=> 'recent'
			,'columns' 						=> 4
			,'per_page' 					=> 8
			,'product_cats'					=> ''
			,'parent_cat' 					=> ''
			,'include_children' 			=> 0
			,'show_general_tab' 			=> 0
			,'general_tab_heading' 			=> ''
			,'product_type_general_tab' 	=> 'recent'
			,'item_layout' 					=> 'grid'
			,'item_background' 				=> ''
			,'show_image' 					=> 1
			,'show_title' 					=> 1
			,'show_sku' 					=> 0
			,'show_price' 					=> 1
			,'show_short_desc'  			=> 0
			,'show_rating' 					=> 1
			,'show_label' 					=> 1
			,'show_categories'				=> 0	
			,'show_add_to_cart' 			=> 1
			,'show_color_swatch' 			=> 0
			,'number_color_swatch' 			=> 3
			,'show_shop_more_button' 		=> 0
			,'show_shop_more_general_tab' 	=> 0
			,'shop_more_button_text' 		=> 'Shop more'
			,'text_align'					=> ''
			,'image_border'					=> 0
			,'item_line'					=> 0
			,'product_area_bg_color'		=> ''
			,'is_slider' 					=> 0
			,'nav_position'					=> 'nav-middle'
			,'rows' 						=> 1
			,'show_nav' 					=> 1
			,'show_dots' 					=> 0
			,'auto_play' 					=> 1
		), $atts));
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( !$product_cats && !$parent_cat ){
			return;
		}
		
		if( !$product_cats ){
			$sub_cats = get_terms(array( 'taxonomy' => 'product_cat', 'parent' => $parent_cat, 'fields' => 'ids', 'orderby' => 'none' ));
			if( is_array($sub_cats) && !empty($sub_cats) ){
				$product_cats = implode(',', $sub_cats);
			}
			else{
				return;
			}
		}
		else{
			$parent_cat = '';
		}
		
		$margin = 30;
		if( $item_line ){
			$margin = 40;
		}
		
		if( $show_dots){
			$show_nav = 0;
		}
		
		
		$atts = compact('product_type', 'columns', 'rows', 'per_page' ,'product_cats', 'include_children'
						,'show_image', 'show_title', 'show_sku', 'show_price', 'show_short_desc', 'show_rating', 'show_label' ,'show_categories', 'show_add_to_cart', 'show_color_swatch', 'number_color_swatch'
						,'show_shop_more_button', 'show_shop_more_general_tab', 'show_general_tab', 'product_type_general_tab', 'is_slider', 'show_nav', 'show_dots', 'auto_play', 'margin');
		
		$classes = array();
		$classes[] = 'ts-product-in-category-tab-wrapper ts-shortcode ts-product';
		$classes[] = $product_type;
		$classes[] = $tab_heading_style;
		$classes[] = $text_align;
		$classes[] = 'item-'.$item_layout;
		if( $product_area_bg_color && $is_slider && $rows == 1 ){
			$classes[] = 'has-background-content';
		}
		$classes[] = $item_background;
		if( $item_line ){
			$classes[] = 'item-line';
		}
		if( $show_color_swatch ){
			$classes[] = 'show-color-swatch';
		}
		if( $image_border ){
			$classes[] = 'image-border';
		}
		if( $show_dots ){
			$classes[] = 'show-dots';
		}
		if( $show_shop_more_button ){
			$classes[] = 'has-shop-more-button';
		}
		else{
			$classes[] = 'no-shop-more-button';
		}
		
		if( $is_slider ){
			$classes[] = 'ts-slider';
			$classes[] = 'rows-'.$rows;
			if( $show_nav ){
				$classes[] = 'show-nav';
				if( $nav_position == 'nav-middle' ){
					$classes[] = 'middle-thumbnail';
				}
				$classes[] = $nav_position;
			}
		}
		$current_cat = '';
		$is_general_tab = false;
		$shop_more_link = '#';
		
		$rand_id = 'ts-product-in-category-tab-'.mt_rand(0, 1000);
		
		ob_start();
		if( $product_area_bg_color && $is_slider && $rows == 1 ){
			echo '<div class="ts-shortcode-custom-style hidden">';
			echo '#'.$rand_id.' .column-content:before{background:'.$product_area_bg_color.';}';
			echo '</div>';
		}
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			<div class="column-tabs">
				
				<?php if( $title ): ?>
				<header class="heading-tab">
					<h2 class="heading-title"><?php echo esc_html($title); ?></h2>
				</header>
				<?php endif; ?>
				
				<div class="list-categories">
					<ul class="tabs">
					<?php 
					if( $show_general_tab ){
						if( $parent_cat ){
							$current_cat = $parent_cat;
							$shop_more_link = get_term_link((int)$parent_cat, 'product_cat');
							if( is_wp_error($shop_more_link) ){
								$shop_more_link = wc_get_page_permalink('shop');
							}
						}
						else{
							$current_cat = $product_cats;
							$shop_more_link = wc_get_page_permalink('shop');
						}
						$is_general_tab = true;
					?>
						<li class="tab-item general-tab current" data-product_cat="<?php echo $current_cat; ?>" data-link="<?php echo esc_url($shop_more_link) ?>">
							<span><?php echo esc_html($general_tab_heading) ?></span>
						</li>
					<?php
					}
					
					$product_cats = array_map('trim', explode(',', $product_cats));
					foreach( $product_cats as $k => $product_cat ):
						$term = get_term_by( 'term_id', $product_cat, 'product_cat');
						if( !isset($term->name) ){
							continue;
						}
						$current_tab = false;
						if( $current_cat == '' ){
							$current_tab = true;
							$current_cat = $product_cat;
							$shop_more_link = get_term_link($term, 'product_cat');
						}
					?>
						<li class="tab-item <?php echo ($current_tab)?'current':''; ?>" data-product_cat="<?php echo esc_attr($product_cat) ?>" data-link="<?php echo esc_url(get_term_link($term, 'product_cat')) ?>">
							<span><?php echo esc_html($term->name) ?></span>
						</li>
					<?php
					endforeach;
					?>
					</ul>
					
				</div>
			</div>
			
			<div class="column-content">
				<div class="column-products loading woocommerce columns-<?php echo esc_attr($columns) ?>">
					<?php echo ts_get_product_content_in_category_tab($atts, $current_cat, $is_general_tab); ?>
				</div>
				
				<?php if( $show_shop_more_button ): ?>
				<div class="shop-more">
					<a class="button shop-more-button" href="<?php echo esc_url($shop_more_link) ?>"><?php echo esc_html($shop_more_button_text) ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		
		return ob_get_clean();
	}	
}
add_shortcode('ts_products_in_category_tabs', 'ts_products_in_category_tabs_shortcode');

add_action('wp_ajax_ts_get_product_content_in_category_tab', 'ts_get_product_content_in_category_tab');
add_action('wp_ajax_nopriv_ts_get_product_content_in_category_tab', 'ts_get_product_content_in_category_tab');
if( !function_exists('ts_get_product_content_in_category_tab') ){
	function ts_get_product_content_in_category_tab( $atts = array(), $product_cat = '', $is_general_tab = false ){
		if( wp_doing_ajax() ){
			if( empty($_POST['atts']) ){
				die('0');
			}
			$atts = $_POST['atts'];
			$product_cat = isset($_POST['product_cat'])?$_POST['product_cat']:'';
			$is_general_tab = (isset($_POST['is_general_tab']) && $_POST['is_general_tab'])?true:false;
		}
		
		if( $is_general_tab ){
			$atts['product_type'] = $atts['product_type_general_tab'];
		}
		
		ob_start();
		extract($atts);
		
		$options = array(
				'show_image'			=> $show_image
				,'show_label'			=> $show_label
				,'show_title'			=> $show_title
				,'show_sku'				=> $show_sku
				,'show_price'			=> $show_price
				,'show_short_desc'		=> $show_short_desc
				,'show_categories'		=> $show_categories
				,'show_rating'			=> $show_rating
				,'show_add_to_cart'		=> $show_add_to_cart
				,'show_color_swatch'	=> $show_color_swatch
				,'number_color_swatch'	=> $number_color_swatch
			);
		ts_remove_product_hooks_shortcode( $options );
		
		$args = array(
			'post_type'				=> 'product'
			,'post_status' 			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page' 		=> $per_page
			,'orderby' 				=> 'date'
			,'order' 				=> 'desc'
			,'meta_query' 			=> WC()->query->get_meta_query()
			,'tax_query'           	=> WC()->query->get_tax_query()
		);

		ts_filter_product_by_product_type($args, $product_type);
		
		if( $product_cat ){
			$args['tax_query'][] = array(
									'taxonomy' => 'product_cat'
									,'terms' => array_map('trim', explode(',', $product_cat))
									,'field' => 'term_id'
									,'include_children' => $include_children
									);
		}
		
		if( (int)$columns <= 0 ){
			$columns = 3;
		}
		
		$old_woocommerce_loop_columns = wc_get_loop_prop('columns');
		wc_set_loop_prop('columns', $columns);

		$products = new WP_Query( $args );
		
		$count = 0;
		
		woocommerce_product_loop_start();
		if( $products->have_posts() ){	

			if( isset($show_shop_more_button, $products->found_posts, $products->post_count) && $products->found_posts == $products->post_count ){
				echo '<div class="hidden hide-shop-more"></div>';
			}

			while( $products->have_posts() ){ 
				$products->the_post();
				
				if( $is_slider && $rows > 1 && $count % $rows == 0 ){
					echo '<div class="product-group">';
				}
				
				wc_get_template_part( 'content', 'product' );
				
				if( $is_slider && $rows > 1 && ($count % $rows == $rows - 1 || $count == $products->post_count - 1) ){
					echo '</div>';
				}
				$count++;
			}

		}
		woocommerce_product_loop_end();
		
		wp_reset_postdata();

		/* restore hooks */
		ts_restore_product_hooks_shortcode();

		wc_set_loop_prop('columns', $old_woocommerce_loop_columns);
		
		if( wp_doing_ajax() ){
			die(ob_get_clean());
		}
		else{
			return ob_get_clean();
		}
	}
}

/* Product in category tabs */
if( !function_exists('ts_products_in_product_type_tabs_shortcode') ){
	function ts_products_in_product_type_tabs_shortcode($atts, $content){

		extract(shortcode_atts(array(
			'title'							=> ''
			,'tab_heading_style'			=> 'tab-heading-default'
			,'tab_1'					    => 1
			,'tab_1_heading'				=> 'Featured'
			,'tab_1_product_type'			=> 'featured'
			,'tab_2'					    => 1
			,'tab_2_heading'				=> 'Best Selling'
			,'tab_2_product_type'			=> 'best_selling'
			,'tab_3'					    => 1
			,'tab_3_heading'				=> 'On Sale'
			,'tab_3_product_type'			=> 'sale'
			,'tab_4'					    => 1
			,'tab_4_heading'				=> 'Top Rated'
			,'tab_4_product_type'			=> 'top_rated'
			,'tab_5'					    => 1
			,'tab_5_heading'				=> 'Recent'
			,'tab_5_product_type'			=> 'recent'
			,'color'						=> '#27af7d'
			,'active_tab'					=> 1
			,'columns' 						=> 4
			,'per_page' 					=> 6
			,'item_layout' 					=> 'grid'
			,'product_cats'					=> ''
			,'include_children' 			=> 1
			,'text_align'					=> ''
			,'image_border'					=> 0
			,'item_background'				=> ''
			,'show_image' 					=> 1
			,'show_title' 					=> 1
			,'show_sku' 					=> 0
			,'show_price' 					=> 1
			,'show_short_desc'  			=> 0
			,'show_rating' 					=> 1
			,'show_label' 					=> 1
			,'show_categories'				=> 0	
			,'show_add_to_cart' 			=> 1
			,'show_color_swatch' 			=> 0
			,'number_color_swatch' 			=> 3
			,'is_slider' 					=> 1
			,'rows' 						=> 1
			,'show_nav' 					=> 1
			,'nav_position'					=> 'nav-middle'
			,'prev_nav_text' 				=> 'Previous post'
			,'next_nav_text' 				=> 'Next post'
			,'auto_play' 					=> 1
			,'margin'						=> 30
		), $atts));
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		if( !$tab_1 && !$tab_2 && !$tab_3 && !$tab_4 && !$tab_5 ){
			return;
		}
		
		$tabs = array();
		for( $i = 1; $i <= 5; $i++ ){
			if( ${'tab_' . $i} ){
				$tabs[] = array(
					'heading'		=> ${'tab_' . $i . '_heading'}
					,'product_type'	=> ${'tab_' . $i . '_product_type'}
				);
			}
		}
		
		if( $active_tab > count($tabs) ){
			$active_tab = 1;
		}
		
		if( !$product_cats ){
			$show_list_categories = 0;
		}
		
		$product_type = $tabs[$active_tab-1]['product_type'];
		
		if( $nav_position != 'nav-top' ){
			$prev_nav_text = '';
			$next_nav_text = '';
		}
		
		$atts = compact('columns', 'rows', 'per_page', 'product_cats', 'include_children', 'product_type'
						,'show_image', 'show_title', 'show_sku', 'show_price', 'show_short_desc', 'show_rating', 'show_label'
						,'show_categories', 'show_add_to_cart', 'show_color_swatch', 'number_color_swatch', 'is_slider', 'show_nav', 'prev_nav_text', 'next_nav_text', 'auto_play', 'margin');
		
		$classes = array();
		$classes[] = 'ts-product-in-product-type-tab-wrapper ts-shortcode ts-product';
		$classes[] = $tab_heading_style;
		$classes[] = $text_align;
		$classes[] = 'item-'.$item_layout;
		$classes[] = $item_background;
		if( $image_border ){
			$classes[] = 'image-border';
		}
		if( $show_color_swatch ){
			$classes[] = 'show-color-swatch';
		}
		if( $is_slider ){
			$classes[] = 'ts-slider';
			$classes[] = 'rows-'.$rows;
			if( $show_nav ){
				$classes[] = 'show-nav';
				if( $nav_position == 'nav-middle' ){
					$classes[] = 'middle-thumbnail';
				}
				$classes[] = $nav_position;
			}
		}
		
		$classes = array_filter($classes);
		
		$rand_id = 'ts-product-in-product-type-tab-'.mt_rand(0, 1000);
		
		ob_start();
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($rand_id) ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
			<div class="column-tabs">
			
				<?php if( strlen($title) > 0 ): ?>
				<header class="heading-tab">
					<h2 class="heading-title">
						<?php echo esc_html($title); ?>
					</h2>
				</header>
				<?php endif; ?>
				
				<ul class="tabs">
				<?php
				foreach( $tabs as $i => $tab ):
				?>
					<li class="tab-item <?php echo ($active_tab == $i + 1)?'active current':''; ?>" data-product_type="<?php echo esc_attr($tab['product_type']) ?>"><?php echo esc_html($tab['heading']) ?></li>
				<?php
				endforeach;
				?>
				</ul>
			</div>
			
			<div class="column-content">
			
				<div class="column-products loading woocommerce columns-<?php echo esc_attr($columns) ?> <?php echo $product_type; ?>">
					<?php echo ts_get_product_content_in_category_tab($atts, $product_cats); ?>
				</div>
				
			</div>
		</div>
		<?php
		
		return ob_get_clean();
	}	
}
add_shortcode('ts_products_in_product_type_tabs', 'ts_products_in_product_type_tabs_shortcode');
?>
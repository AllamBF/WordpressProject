<?php
/*************************************************
* WooCommerce Custom Hook                        *
**************************************************/

/*** Shop - Category ***/

/* Remove hook */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

/* Add new hook */

add_action('woocommerce_before_shop_loop_item_title', 'yoome_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_product_label', 1);

add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_brands', 5);
add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_categories', 10);
add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_sku', 20);
add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_title', 30);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 40);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 45);
add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description', 60);
add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description_listview', 65);
add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_add_to_cart', 70);

add_action('woocommerce_before_shop_loop', 'yoome_product_per_page_form', 40);
add_action('woocommerce_before_shop_loop', 'yoome_add_top_filter_button', 25);
add_filter('loop_shop_per_page', 'yoome_change_products_per_page_shop' ); 

add_action('woocommerce_after_shop_loop', 'yoome_shop_load_more_html', 20);

add_filter('woocommerce_product_get_rating_html', 'yoome_get_empty_rating_html', 10, 2);
add_filter('woocommerce_get_stock_html', 'yoome_empty_woocommerce_stock_html', 10, 2);

add_filter('woocommerce_before_output_product_categories', 'yoome_before_output_product_categories');
add_filter('woocommerce_after_output_product_categories', 'yoome_after_output_product_categories');

function yoome_template_loop_product_label(){
	global $product;
	?>
	<div class="product-label">
	<?php 
	if( $product->is_in_stock() ){
		/* New label */
		if( yoome_get_theme_options('ts_product_show_new_label') ){
			$now = current_time( 'timestamp', true );
			$post_date = get_post_time('U', true);
			$num_day = (int)( ( $now - $post_date ) / ( 3600*24 ) );
			$num_day_setting = absint( yoome_get_theme_options('ts_product_show_new_label_time') );
			if( $num_day <= $num_day_setting ){
				echo '<div><span class="new">'.esc_html( yoome_get_theme_options('ts_product_new_label_text') ).'</span></div>';
			}
		}
		
		/* Sale label */
		if( $product->is_on_sale() ){
			if( yoome_get_theme_options('ts_show_sale_label_as') != 'text' ){
				if( $product->get_type() == 'variable' ){
					$regular_price = $product->get_variation_regular_price('max');
					$sale_price = $product->get_variation_sale_price('min');
				}
				else{
					$regular_price = $product->get_regular_price();
					$sale_price = $product->get_price();
				}
				if( $regular_price ){
					if( yoome_get_theme_options('ts_show_sale_label_as') == 'number' ){
						$_off_price = round($regular_price - $sale_price, wc_get_price_decimals());
						$price_display = '-' . sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), $_off_price);
						echo '<div><span class="onsale amount" data-original="'.$price_display.'">'.$price_display.'</span></div>';
					}
					if( yoome_get_theme_options('ts_show_sale_label_as') == 'percent' ){
						$_off_percent = ( 1 - round($sale_price / $regular_price, 2) ) * 100;
						echo '<div><span class="onsale percent">-'.$_off_percent.'%</span></div>';
					}
				}
			}
			else{
				echo '<div><span class="onsale">'.esc_html( yoome_get_theme_options('ts_product_sale_label_text') ).'</span></div>';
			}
		}
		
		/* Hot label */
		if( $product->is_featured() ){
			echo '<div><span class="featured">'.esc_html( yoome_get_theme_options('ts_product_feature_label_text') ).'</span></div>';
		}
	}
	else{ /* Out of stock */
		echo '<div><span class="out-of-stock">'.esc_html( yoome_get_theme_options('ts_product_out_of_stock_label_text') ).'</span></div>';
	}
	?>
	</div>
	<?php
}

function yoome_template_loop_product_thumbnail(){
	global $product;
	$lazy_load = yoome_get_theme_options('ts_prod_lazy_load') && !( defined( 'DOING_AJAX' ) && DOING_AJAX );
	$placeholder_img_src = yoome_get_theme_options('ts_prod_placeholder_img')['url'];
	
	if( defined( 'YITH_INFS' ) && (is_shop() || is_product_taxonomy()) ){ /* Compatible with YITH Infinite Scrolling */
		$lazy_load = false;
	}
	
	$prod_galleries = $product->get_gallery_image_ids();
	
	$image_size = apply_filters('yoome_loop_product_thumbnail', 'woocommerce_thumbnail');
	
	$dimensions = wc_get_image_size( $image_size );
	
	$has_back_image = yoome_get_theme_options('ts_effect_product');
	
	if( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 ) ){
		$has_back_image = false;
	}
	 
	if( wp_is_mobile() ){
		$has_back_image = false;
	}
	
	echo '<figure class="' . ($has_back_image?'has-back-image':'no-back-image') . '">';
		if( !$lazy_load ){
			echo woocommerce_get_product_thumbnail( $image_size );
			
			if( $has_back_image ){
				echo wp_get_attachment_image( $prod_galleries[0], $image_size, 0, array('class' => 'product-image-back') );
			}
		}
		else{
			$front_img_src = '';
			$alt = '';
			if( has_post_thumbnail( $product->get_id() ) ){
				$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
				$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
				if( isset($image_obj[0]) ){
					$front_img_src = $image_obj[0];
				}
				$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
			}
			else{
				$front_img_src = wc_placeholder_img_src();
			}
			
			echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($front_img_src).'" class="attachment-shop_catalog wp-post-image ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
		
			if( $has_back_image ){
				$back_img_src = '';
				$alt = '';
				$image_obj = wp_get_attachment_image_src($prod_galleries[0], $image_size, 0);
				if( isset($image_obj[0]) ){
					$back_img_src = $image_obj[0];
					$alt = trim(strip_tags( get_post_meta($prod_galleries[0], '_wp_attachment_image_alt', true) ));
				}
				else{
					$back_img_src = wc_placeholder_img_src();
				}
				
				echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($back_img_src).'" class="product-image-back ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			}
		}
	echo '</figure>';
}

function yoome_template_loop_product_variable_color(){
	global $product;
	if( $product->get_type() == 'variable' ){
		$attribute_color = wc_attribute_taxonomy_name( 'color' ); // pa_color
		$attribute_color_name = wc_variation_attribute_name( $attribute_color ); // attribute_pa_color
		
		$color_terms = wc_get_product_terms( $product->get_id(), $attribute_color, array( 'fields' => 'all' ) );
		if( empty($color_terms) || is_wp_error($color_terms) ){
			return;
		}
		$color_term_ids = wp_list_pluck( $color_terms, 'term_id' );
		$color_term_slugs = wp_list_pluck( $color_terms, 'slug' );
		
		$color_html = array();
		$price_html = array();
		
		$added_colors = array();
		$count = 0;
		$number = apply_filters('yoome_loop_product_variable_color_number', 3);
		
		$children = $product->get_children();
		if( is_array($children) && count($children) > 0 ){
			foreach( $children as $children_id ){
				$variation_attributes = wc_get_product_variation_attributes( $children_id );
				foreach( $variation_attributes as $attribute_name => $attribute_value ){
					if( $attribute_name == $attribute_color_name ){
						if( in_array($attribute_value, $added_colors) ){
							break;
						}
						
						$term_id = 0;
						$found_slug = array_search($attribute_value, $color_term_slugs);
						if( $found_slug !== false ){
							$term_id = $color_term_ids[ $found_slug ];
						}
						
						if( $term_id !== false && absint( $term_id ) > 0 ){
							$thumbnail_id = get_post_meta( $children_id, '_thumbnail_id', true );
							if( $thumbnail_id ){
								$image_src = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail');
								if( $image_src ){
									$thumbnail = $image_src[0];
								}
								else{
									$thumbnail = wc_placeholder_img_src();
								}
							}
							else{
								$thumbnail = wc_placeholder_img_src();
							}
							
							$color_datas = get_term_meta( $term_id, 'ts_product_color_config', true );
							if( $color_datas ){
								$color_datas = unserialize( $color_datas );	
							}else{
								$color_datas = array('ts_color_color' => '#ffffff', 'ts_color_image' => 0);
							}
							$color_datas['ts_color_image'] = absint($color_datas['ts_color_image']);
							if( $color_datas['ts_color_image'] ){
								$color_html[] = '<div class="color-image" data-thumb="'.$thumbnail.'" data-term_id="'.$term_id.'"><span>'.wp_get_attachment_image( $color_datas['ts_color_image'], 'ts_prod_color_thumb', true, array('alt' => $attribute_value) ).'</span></div>';
							}
							else{
								$color_html[] = '<div class="color" data-thumb="'.$thumbnail.'" data-term_id="'.$term_id.'"><span style="background-color: '.$color_datas['ts_color_color'].'"></span></div>';
							}
							$variation = wc_get_product( $children_id );
							$price_html[] = '<span class="price" data-term_id="'.$term_id.'">' . $variation->get_price_html() . '</span>';
							$count++;
						}
						
						$added_colors[] = $attribute_value;
						break;
					}
				}
				
				if( $count == $number ){
					break;
				}
			}
		}
		
		if( $color_html ){
			echo '<div class="color-swatch">'. implode('', $color_html) . '</div>';
			echo '<span class="variable-prices hidden">' . implode('', $price_html) . '</span>';
		}
	}
}

function yoome_template_loop_product_title(){
	global $product;
	echo '<h3 class="heading-title product-name">';
	echo '<a href="' . esc_url($product->get_permalink()) . '">' . esc_html($product->get_title()) . '</a>';
	echo '</h3>';
}

function yoome_template_loop_add_to_cart(){
	if( yoome_get_theme_options('ts_enable_catalog_mode') ){
		return;
	}
	
	echo '<div class="loop-add-to-cart">';
	woocommerce_template_loop_add_to_cart();
	echo '</div>';
}

function yoome_template_loop_product_sku(){
	global $product;
	echo '<div class="product-sku">' . esc_html($product->get_sku()) . '</div>';
}

function yoome_template_loop_short_description(){
	global $product;
	$has_grid_list = yoome_get_theme_options('ts_prod_cat_glt');
	$grid_limit_words = absint(yoome_get_theme_options('ts_prod_cat_grid_desc_words'));
	$grid_limit_words = apply_filters('yoome_grid_short_desc_limit_words', $grid_limit_words);
	$show_grid_desc = yoome_get_theme_options('ts_prod_cat_grid_desc');
	
	if( !$product->get_short_description() ){
		return;
	}
	
	if( !(is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product')) ):
	?>
	<div class="short-description">
		<?php yoome_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
	</div>
	<?php
	else:
		if( $show_grid_desc ):
		?>
			<div class="short-description grid" style="<?php echo esc_attr($has_grid_list?'display: none':''); ?>" >
				<?php yoome_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
			</div>
		<?php
		endif;
	endif;
}

function yoome_template_loop_short_description_listview(){
	$has_grid_list = yoome_get_theme_options('ts_prod_cat_glt');
	$list_limit_words = absint(yoome_get_theme_options('ts_prod_cat_list_desc_words'));
	$show_list_desc = yoome_get_theme_options('ts_prod_cat_list_desc');
	$is_archive = is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product');
	if( $has_grid_list && $show_list_desc && $is_archive ):
	?>
		<div class="short-description list" style="display: none" >
			<?php yoome_the_excerpt_max_words($list_limit_words, '', true, '', true); ?>
		</div>
	<?php
	endif;
}

function yoome_template_loop_brands(){
	global $product;
	if( yoome_get_theme_options('ts_prod_cat_brand') ){
		echo get_the_term_list($product->get_id(), 'ts_product_brand', '<div class="product-brands">', ', ', '</div>');
	}
}

function yoome_template_loop_categories(){
	global $product;
	$categories_label = esc_html__('Categories: ', 'yoome');
	echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-categories"><span>'.$categories_label.'</span>', '</div>');
}

function yoome_change_products_per_page_shop(){
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( isset($_GET['per_page']) && absint($_GET['per_page']) > 0 ){
			return absint($_GET['per_page']);
		}
		$per_page = absint( yoome_get_theme_options('ts_prod_cat_per_page') );
        if( $per_page ){
            return $per_page;
        }
    }
}

function yoome_product_per_page_form(){
	if( !yoome_get_theme_options('ts_prod_cat_per_page_dropdown') ){
		return;
	}
	if( function_exists('woocommerce_products_will_display') && !woocommerce_products_will_display() ){
		return;
	}
	
	$per_page = absint( yoome_get_theme_options('ts_prod_cat_per_page') );
	if( !$per_page ){
		return;
	}
	
	$options = array();
	for( $i = 1; $i <= 4; $i++ ){
		$options[] = $per_page * $i;
	}
	$selected = isset($_GET['per_page'])?absint($_GET['per_page']):$per_page;
	
	$action = '';
	$cat 	= get_queried_object();
	if( isset( $cat->term_id ) && isset( $cat->taxonomy ) ){
		$action = get_term_link( $cat->term_id, $cat->taxonomy );
	}
	else{
		$action = wc_get_page_permalink('shop');
	}
?>
	<form method="get" action="<?php echo esc_url($action) ?>" class="product-per-page-form">
		<span><?php esc_html_e('Show', 'yoome'); ?></span>
		<select name="per_page" class="perpage">
			<?php foreach( $options as $option ): ?>
			<option value="<?php echo esc_attr($option) ?>" <?php selected($selected, $option) ?>><?php echo esc_html($option) ?></option>
			<?php endforeach; ?>
		</select>
		<ul class="perpage">
			<li>
				<span class="perpage-current"><?php echo esc_html($selected) ?></span>
				<ul class="dropdown">
					<?php foreach( $options as $option ): ?>
					<li><a href="#" data-perpage="<?php echo esc_attr($option) ?>" class="<?php echo esc_attr($option == $selected?'current':''); ?>"><?php echo esc_html($option) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
		<?php wc_query_string_form_fields( null, array( 'per_page', 'submit', 'paged', 'product-page' ) ); ?>
	</form>
<?php
}

function yoome_is_active_top_filter(){
	return is_active_sidebar('top-filter-widget-area') && yoome_get_theme_options('ts_top_filter_widget_area') && woocommerce_products_will_display();
}

function yoome_add_top_filter_button(){
	if( yoome_is_active_top_filter() ){
		$top_filter_position = yoome_get_theme_options('ts_top_filter_widget_area_position');
	?>
		<div class="top-filter-widget-area-button <?php echo esc_attr('show-' . $top_filter_position); ?>" data-position="<?php echo esc_attr($top_filter_position); ?>">
			<a href="#"><?php esc_html_e('Filter', 'yoome') ?></a>
		</div>
	<?php
		if( $top_filter_position == 'sidebar' ){
		?>
			<div id="ts-top-filter-widget-area-sidebar" class="ts-floating-sidebar">
				<div class="ts-sidebar-content">
					<span class="close"></span>
					<aside class="ts-sidebar top-filter-widget-area">
						<?php dynamic_sidebar( 'top-filter-widget-area' ); ?>
					</aside>
				</div>
			</div>
		<?php
		}
	}
}

function yoome_shop_load_more_html(){
	if( wc_get_loop_prop( 'total_pages' ) == 1 || !woocommerce_products_will_display() ){
		return;
	}
	$loading_type = yoome_get_theme_options('ts_prod_cat_loading_type');
	if( in_array($loading_type, array('infinity-scroll', 'load-more-button')) ){
		$total = wc_get_loop_prop( 'total' );
		$per_page = wc_get_loop_prop( 'per_page' );
		$current = wc_get_loop_prop( 'current_page' );
		$showing = min($current * $per_page, $total);
		$bar_width = round( $showing * 100 / $total, 2 );
	?>
	<div class="ts-shop-result-count">
		<span>
			<?php 
			if( $showing < $total ){
				printf( esc_html__('You\'re viewed %s of %s products', 'yoome'), $showing, $total );
			}
			else{
				printf( esc_html__('You\'re viewed all %s products', 'yoome'), $total );
			}
			?>
		</span>
		<span class="bar"><span style="width: <?php echo esc_attr($bar_width) ?>%"></span></span>
	</div>
	<div class="ts-shop-load-more">
		<?php if( $loading_type == 'load-more-button' ): ?>
		<span class="button load-more"><?php esc_html_e('Load More', 'yoome'); ?></span>
		<?php endif; ?>
	</div>
	<?php
	}
}

function yoome_get_empty_rating_html( $rating_html, $rating ){
	if( $rating == 0 ){
		$rating_html  = '<div class="star-rating no-rating">';
		$rating_html .= '<span style="width:0%"></span>';
		$rating_html .= '</div>';
	}
	return $rating_html;
}

function yoome_empty_woocommerce_stock_html( $html, $product ){
	if( $product->get_type() == 'simple' ){
		return '';
	}
	return $html;
}

function yoome_before_output_product_categories(){
	return '<div class="list-categories">';
}

function yoome_after_output_product_categories(){
	return '</div>';
}
/*** End Shop - Category ***/



/*** Single Product ***/

/* Remove hook */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

/* Add hook */
add_action('woocommerce_before_single_product', 'yoome_single_product_top_thumbnail_slider');

add_action('yoome_before_product_image', 'yoome_template_loop_product_label', 10);
add_action('yoome_after_single_product_thumbnails', 'yoome_template_single_product_video_360_buttons', 10);

add_action('woocommerce_single_product_summary', 'yoome_template_single_navigation', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 25);

add_action('woocommerce_single_product_summary', 'yoome_template_single_meta', 60);

add_action('woocommerce_after_single_product_summary', 'yoome_product_ads_banner', 12);

if( function_exists('ts_template_social_sharing') ){
	add_action('woocommerce_share', 'ts_template_social_sharing', 10);
}

if( function_exists('ts_template_loop_time_deals') ){
	add_action('woocommerce_single_product_summary', 'ts_template_loop_time_deals', 22);
}

add_filter('woocommerce_grouped_product_columns', 'yoome_woocommerce_grouped_product_columns');

add_filter('woocommerce_product_description_heading', '__return_empty_string');
add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

add_filter('woocommerce_output_related_products_args', 'yoome_output_related_products_args_filter');

add_filter('yoome_single_product_thumbnails_class', 'yoome_add_classes_to_single_product_thumbnail');

if( !is_admin() ){ /* Fix for WooCommerce Tab Manager plugin */
	add_filter( 'woocommerce_product_tabs', 'yoome_product_remove_tabs', 999 );
	add_filter( 'woocommerce_product_tabs', 'yoome_add_product_custom_tab', 90 );
}

function yoome_single_product_top_thumbnail_slider(){
	global $product;
	if( yoome_get_theme_options('ts_prod_thumbnail_summary_layout') == 'top_thumbnail_slider' && has_post_thumbnail() ){
		$light_box = !yoome_get_theme_options('ts_prod_cloudzoom');
		$index = 0;
		$image_ids = array();
		$image_ids[] = get_post_thumbnail_id();
		$attachment_ids = $product->get_gallery_image_ids();
		if( is_array($attachment_ids) ){
			$image_ids = array_merge($image_ids, $attachment_ids);
		}
		wp_enqueue_script( 'wpb_composer_front_js' );
	?>
	<div class="vc_row wpb_row vc_row-fluid vc_column-gap-default loading vc_row-no-padding" data-vc-full-width="true" data-vc-full-width-init="true" data-vc-stretch-content="true">
		<div class="single-product-top-thumbnail-slider loading woocommerce-product-gallery">
		<?php foreach( $image_ids as $image_id ):
			$full_size_image  = wp_get_attachment_image_src( $image_id, 'full' );
			$attributes = array(
					'title'                    => get_post_field( 'post_title', $image_id )
					,'data-caption'            => get_post_field( 'post_excerpt', $image_id )
					,'data-src'                => $full_size_image[0]
					,'data-large_image'        => $full_size_image[0]
					,'data-large_image_width'  => $full_size_image[1]
					,'data-large_image_height' => $full_size_image[2]
					,'data-index'			   => $index++
				);
		?>
			<div class="item woocommerce-product-gallery__image">
				<?php if( $light_box ): ?>
					<a href="<?php echo esc_url($full_size_image[0]); ?>">
				<?php endif; ?>
					<?php echo wp_get_attachment_image($image_id, 'woocommerce_single', false, $attributes); ?>
				<?php if( $light_box ): ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
	<div class="vc_row-full-width"></div>
	<?php
	yoome_template_single_product_video_360_buttons();
	}
}

add_action('wp_ajax_yoome_load_product_video', 'yoome_load_product_video_callback' );
add_action('wp_ajax_nopriv_yoome_load_product_video', 'yoome_load_product_video_callback' );
/*** End Product ***/

function yoome_show_buttons_on_single_product_thumbnails(){
	return !in_array(yoome_get_theme_options('ts_prod_thumbnail_summary_layout'), array('scrolling', 'top_thumbnail_slider'));
}

function yoome_template_single_product_video_360_buttons(){
	global $product;
	$show_button = yoome_show_buttons_on_single_product_thumbnails();
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( $video_url ){
		if( $show_button ){
			echo '<a class="ts-product-video-button" href="#" data-product_id="'.$product->get_id().'"></a>';
			add_action('wp_footer', 'yoome_add_product_video_popup_modal', 999);
		}
		else{
			echo do_shortcode('[ts_video src='.esc_url($video_url).']');
		}
	}
	
	$gallery_360 = get_post_meta($product->get_id(), 'ts_prod_360_gallery', true);
	if( $gallery_360 ){
		$galleries = array_map('trim', explode(',', $gallery_360));
		$image_array = array();
		foreach($galleries as $gallery ){
			$image_src = wp_get_attachment_image_url($gallery, 'woocommerce_single');
			if( $image_src ){
				$image_array[] = "'" . $image_src . "'";
			}
		}
		wp_enqueue_script('threesixty');
		wp_add_inline_script('threesixty', 'var _ts_product_360_image_array = ['.implode(',', $image_array).'];');
		if( $show_button ){
			echo '<a class="ts-product-360-button" href="#"></a>';
			add_action('wp_footer', 'yoome_add_product_360_popup_modal', 999);
		}
		else{
			yoome_load_product_360();
		}
	}
}

function yoome_add_product_video_popup_modal(){
	?>
	<div id="ts-product-video-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<div class="product-video-container popup-container">
			<span class="close"></span>
			<div class="product-video-content"></div>
		</div>
	</div>
	<?php
}

function yoome_add_product_360_popup_modal(){
	?>
	<div id="ts-product-360-modal" class="ts-popup-modal">
		<div class="overlay"></div>
		<span class="close"></span>
		<div class="product-360-container popup-container">
			<div class="product-360-content"><?php yoome_load_product_360(); ?></div>
		</div>
	</div>
	<?php
}

function yoome_add_classes_to_single_product_thumbnail( $classes ){
	if( yoome_show_buttons_on_single_product_thumbnails() ){
		global $product;
		$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
		if( $video_url ){
			$classes[] = 'has-video';
		}
		$gallery_360 = get_post_meta($product->get_id(), 'ts_prod_360_gallery', true);
		if( $gallery_360 ){
			$classes[] = 'has-360-gallery';
		}
	}
	return $classes;
}

/* Single Product Video - Register ajax */
function yoome_load_product_video_callback(){
	if( empty($_POST['product_id']) ){
		die( esc_html__('Invalid Product', 'yoome') );
	}
	
	$prod_id = absint($_POST['product_id']);

	if( $prod_id <= 0 ){
		die( esc_html__('Invalid Product', 'yoome') );
	}
	
	$video_url = get_post_meta($prod_id, 'ts_prod_video_url', true);
	ob_start();
	if( !empty($video_url) ){
		echo do_shortcode('[ts_video src='.esc_url($video_url).']');
	}
	die( ob_get_clean() );
}

function yoome_load_product_360(){
	?>
	<div class="threesixty ts-product-360">
		<div class="spinner">
			<span>0%</span>
		</div>
		<ol class="threesixty_images"></ol>
	</div>
	<?php
}

function yoome_template_single_navigation(){
	if( !yoome_get_theme_options('ts_prod_next_prev_navigation') ){
		return;
	}
	$prev_post = get_adjacent_post(false, '', true, 'product_cat');
	$next_post = get_adjacent_post(false, '', false, 'product_cat');
	?>
	<div class="single-navigation">
	<?php 
		if( $prev_post ){
			$post_id = $prev_post->ID;
			$product = wc_get_product($post_id);
			?>
			<div class="prev">
				<a href="<?php echo esc_url(get_permalink($post_id)); ?>" rel="prev"></a>
				<div class="product-info prev-product-info">
					<?php echo wp_kses_post($product->get_image()); ?>
					<div>
						<span><?php echo esc_html($product->get_title()); ?></span>
						<span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
		
		if( $next_post ){
			$post_id = $next_post->ID;
			$product = wc_get_product($post_id);
			?>
			<div class="next">
				<a href="<?php echo esc_url(get_permalink($post_id)); ?>" rel="next"></a>
				<div class="product-info next-product-info">
					<?php echo wp_kses_post($product->get_image()); ?>
					<div>
						<span><?php echo esc_html($product->get_title()); ?></span>
						<span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
	?>
	</div>
	<?php
}

function yoome_template_single_meta(){
	global $product;
	$theme_options = yoome_get_theme_options();
	
	echo '<div class="meta-content">';
		do_action( 'woocommerce_product_meta_start' );
		if( $theme_options['ts_prod_sku'] ){
			yoome_template_single_sku();
		}
		if( $theme_options['ts_prod_availability'] ){
			yoome_template_single_availability();
		}
		if( $theme_options['ts_prod_brand'] ){
			echo get_the_term_list($product->get_id(), 'ts_product_brand', '<div class="brands-link"><span>' . esc_html__( 'Brands:', 'yoome' ) . '</span><span class="brand-links">', ', ', '</span></div>');
		}
		if( $theme_options['ts_prod_cat'] ){
			echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="cats-link"><span>' . esc_html__( 'Categories:', 'yoome' ) . '</span><span class="cat-links">', '</span></div>' );
		}
		if( $theme_options['ts_prod_tag'] ){
			echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tags-link"><span>' . esc_html__( 'Tags:', 'yoome' ) . '</span><span class="tag-links">', '</span></div>' );	
		}
		if( $theme_options['ts_prod_sharing'] ){
			woocommerce_template_single_sharing();
		}
		do_action( 'woocommerce_product_meta_end' );
	echo '</div>';
}

function yoome_template_single_sku(){
	global $product;
	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ){
		echo '<div class="sku-wrapper product_meta"><span>' . esc_html__( 'SKU:', 'yoome' ) . '</span><span class="sku">' . (( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'yoome' )) . '</span></div>';
	}
}
function yoome_template_single_availability(){
	global $product;

	$product_stock = $product->get_availability();
	$availability_text = empty($product_stock['availability'])?esc_html__('In Stock', 'yoome'):esc_attr($product_stock['availability']);
	?>	
		<p class="availability stock <?php echo esc_attr($product_stock['class']); ?>" data-original="<?php echo esc_attr($availability_text) ?>" data-class="<?php echo esc_attr($product_stock['class']) ?>">
			<label><?php esc_html_e('Availability:', 'yoome') ?></label>
			<span><?php echo esc_html($availability_text); ?></span>
		</p>	
	<?php
}


/*** Product tab ***/
function yoome_product_remove_tabs( $tabs = array() ){
	if( !yoome_get_theme_options('ts_prod_tabs') ){
		return array();
	}
	return $tabs;
}

function yoome_add_product_custom_tab( $tabs = array() ){
	global $post;
	if( yoome_get_theme_options('ts_prod_custom_tab') ){
		if( get_post_meta( $post->ID, 'ts_prod_custom_tab', true ) ){
			$custom_tab_title = get_post_meta( $post->ID, 'ts_prod_custom_tab_title', true );
		}
		else{
			$custom_tab_title = yoome_get_theme_options('ts_prod_custom_tab_title');
		}
	
		$tabs['ts_custom'] = array(
			'title'    	=> esc_html( $custom_tab_title )
			,'priority' => 90
			,'callback' => 'yoome_product_custom_tab_content'
		);
	} 
	return $tabs;
}

function yoome_product_custom_tab_content(){
	global $post;
	
	if( get_post_meta( $post->ID, 'ts_prod_custom_tab', true ) ){
		$custom_tab_content = get_post_meta( $post->ID, 'ts_prod_custom_tab_content', true );
	}
	else{
		$custom_tab_content = yoome_get_theme_options('ts_prod_custom_tab_content');
	}
	
	echo do_shortcode( stripslashes( wp_specialchars_decode( $custom_tab_content ) ) );
}

/* Ads Banner */
function yoome_product_ads_banner(){
	if( yoome_get_theme_options('ts_prod_ads_banner') ){
		echo '<div class="ads-banner">';
		echo do_shortcode( stripslashes( wp_specialchars_decode( yoome_get_theme_options('ts_prod_ads_banner_content') ) ) );
		echo '</div>';
	}
}

/* Related Products */
function yoome_output_related_products_args_filter( $args ){
	$args['posts_per_page'] = 6;
	$args['columns'] = 5;
	return $args;
}

/* Change grouped product columns */
function yoome_woocommerce_grouped_product_columns( $columns ){
	$columns = array('label', 'price', 'quantity');
	return $columns;
}

/*** General hook ***/

/*************************************************************
* Custom group button on product (quickshop, wishlist, compare) 
* Begin tag: 	10000
* Quickshop: 	10001
* Compare:   	10002
* Wishlist:  	10003
* Add To Cart: 	10004
* End tag:   	10005
**************************************************************/
add_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_add_to_cart', 10004 );
function yoome_product_group_button_start(){
	$num_icon = 0;
	$extra_classes = '';
	if( has_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_add_to_cart') && !yoome_get_theme_options('ts_enable_catalog_mode') ){
		$num_icon++;
	}
	else{
		$extra_classes = ' no-addtocart';
	}
	if( yoome_get_theme_options('ts_enable_quickshop') ){
		$num_icon++;
	}
	if( class_exists('YITH_WCWL') ){
		$num_icon++;
	}
	if( class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
		$num_icon++;
	}
	
	$classes = array(0 => '', 1 => 'one-button', 2 => 'two-button', 3 => 'three-button', 4 => 'four-button');
	
	echo "<div class=\"product-group-button {$classes[$num_icon]}{$extra_classes}\" >";
}

function yoome_product_group_button_end(){
	echo '</div>';
}

add_action('woocommerce_after_shop_loop_item_title', 'yoome_product_group_button_start', 10000 );
add_action('woocommerce_after_shop_loop_item_title', 'yoome_product_group_button_end', 10005 );

/* Wishlist */
if( class_exists('YITH_WCWL') ){
	function yoome_add_wishlist_button_to_product_list(){
		echo '<div class="button-in wishlist">';
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		echo '</div>';
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'yoome_add_wishlist_button_to_product_list', 10003 );
	add_action( 'woocommerce_after_shop_loop_item', 'yoome_add_wishlist_button_to_product_list', 80 );
	
	add_filter('yith_wcwl_add_to_wishlist_params', 'yoome_yith_wcwl_add_to_wishlist_params');
	function yoome_yith_wcwl_add_to_wishlist_params( $additional_params ){
		if( isset($additional_params['container_classes']) && $additional_params['exists'] ){
			$additional_params['container_classes'] .= ' added';
		}
		$additional_params['label'] = '<span class="ts-tooltip button-tooltip">' . esc_html__('Wishlist', 'yoome') . '</span>';
		return $additional_params;
	}
	
	add_filter('yith-wcwl-browse-wishlist-label', 'yoome_yith_wcwl_browse_wishlist_label');
	function yoome_yith_wcwl_browse_wishlist_label(){
		return '<span class="ts-tooltip button-tooltip">' . esc_html__('Wishlist', 'yoome') . '</span>';
	}
}

/* Compare */
if( class_exists('YITH_Woocompare') ){
	global $yith_woocompare;
	$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	if( $yith_woocompare->is_frontend() || $is_ajax ){
		if( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
			if( $is_ajax ){
				if( defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend') ){
					$compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
					if( file_exists($compare_frontend_class) ){
						require_once $compare_frontend_class;
					}
				}
				$yith_woocompare->obj = new YITH_Woocompare_Frontend();
			}
			remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
			function yoome_add_compare_button_to_product_list(){
				global $yith_woocompare, $product;
				echo '<div class="button-in compare">';
				echo '<a class="compare" href="'.$yith_woocompare->obj->add_product_url( $product->get_id() ).'" data-product_id="'.$product->get_id().'">'.get_option('yith_woocompare_button_text').'</a>';
				echo '</div>';
			}
			add_action( 'woocommerce_after_shop_loop_item_title', 'yoome_add_compare_button_to_product_list', 10002 );
			add_action( 'woocommerce_after_shop_loop_item', 'yoome_add_compare_button_to_product_list', 70 );
		}
		
		add_filter( 'option_yith_woocompare_button_text', 'yoome_compare_button_text_filter', 99 );
		function yoome_compare_button_text_filter( $button_text ){
			return '<span class="ts-tooltip button-tooltip">'.esc_html($button_text).'</span>';
		}
	}
}

/*************************************************************
* Group button on product meta (add to cart, wishlist, compare) 
* Begin tag: 69
* Add to cart: 70
* Compare: 70
* quicklist: 80
* End tag: 81
*************************************************************/
add_action('woocommerce_after_shop_loop_item', 'yoome_product_group_button_meta_start', 69);
add_action('woocommerce_after_shop_loop_item', 'yoome_product_group_button_meta_end', 81);
function yoome_product_group_button_meta_start(){
	echo '<div class="product-group-button-meta">';
}
function yoome_product_group_button_meta_end(){
	echo '</div>';
}
/*** End General hook ***/

/*** Cart - Checkout hooks ***/
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

add_action('woocommerce_proceed_to_checkout', 'yoome_cart_continue_shopping_button', 20);

/* Continue Shopping button */
function yoome_cart_continue_shopping_button(){
	echo '<a href="'.esc_url(wc_get_page_permalink('shop')).'" class="button continue-shopping">'.esc_html__('Continue Shopping', 'yoome').'</a>';
}

add_action('woocommerce_before_checkout_form', 'yoome_before_checkout_form_start', 1);
add_action('woocommerce_before_checkout_form', 'yoome_before_checkout_form_end', 999);
function yoome_before_checkout_form_start(){
	echo '<div class="checkout-login-coupon-wrapper">';
}
function yoome_before_checkout_form_end(){
	echo '</div>';
}
?>
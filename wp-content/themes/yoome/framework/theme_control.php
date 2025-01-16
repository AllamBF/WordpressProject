<?php 
/*** Template Redirect ***/
add_action('template_redirect', 'yoome_template_redirect');
function yoome_template_redirect(){
	global $wp_query, $post;
	
	/* Get Page Options */
	if( is_page() || is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( is_page() ){
			$page_id = $post->ID;
		}
		if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
			$page_id = get_option('woocommerce_shop_page_id', 0);
		}
		$page_options = yoome_set_global_page_options( $page_id );
		
		if( $page_options['ts_layout_fullwidth'] != 'default' ){
			yoome_change_theme_options('ts_layout_fullwidth', $page_options['ts_layout_fullwidth']);
			if( $page_options['ts_layout_fullwidth'] ){
				yoome_change_theme_options('ts_header_layout_fullwidth', $page_options['ts_header_layout_fullwidth']);
				yoome_change_theme_options('ts_main_content_layout_fullwidth', $page_options['ts_main_content_layout_fullwidth']);
				yoome_change_theme_options('ts_footer_layout_fullwidth', $page_options['ts_footer_layout_fullwidth']);
			}
		}
		
		if( $page_options['ts_layout_style'] != 'default' ){
			yoome_change_theme_options('ts_layout_style', $page_options['ts_layout_style']);
		}
		
		if( $page_options['ts_header_layout'] != 'default' ){
			yoome_change_theme_options('ts_header_layout', $page_options['ts_header_layout']);
		}
		
		if( $page_options['ts_breadcrumb_layout'] != 'default' ){
			yoome_change_theme_options('ts_breadcrumb_layout', $page_options['ts_breadcrumb_layout']);
		}
		
		if( $page_options['ts_breadcrumb_bg_parallax'] != 'default' ){
			yoome_change_theme_options('ts_breadcrumb_bg_parallax', $page_options['ts_breadcrumb_bg_parallax']);
		}
		
		if( trim($page_options['ts_bg_breadcrumbs']) != '' ){
			yoome_change_theme_options('ts_bg_breadcrumbs', $page_options['ts_bg_breadcrumbs']);
		}
		
		if( trim($page_options['ts_logo']) != '' ){
			yoome_change_theme_options('ts_logo', $page_options['ts_logo']);
		}
		
		if( trim($page_options['ts_logo_mobile']) != '' ){
			yoome_change_theme_options('ts_logo_mobile', $page_options['ts_logo_mobile']);
		}
		
		if( trim($page_options['ts_logo_mobile_menu']) != '' ){
			yoome_change_theme_options('ts_logo_mobile_menu', $page_options['ts_logo_mobile_menu']);
		}
		
		if( trim($page_options['ts_logo_sticky']) != '' ){
			yoome_change_theme_options('ts_logo_sticky', $page_options['ts_logo_sticky']);
		}
		
		if( $page_options['ts_menu_id'] ){
			add_filter('wp_nav_menu_args', 'yoome_filter_wp_nav_menu_args');
		}
		
		if( $page_options['ts_first_footer_area'] ){
			yoome_change_theme_options('ts_first_footer_area', $page_options['ts_first_footer_area']);
		}
		
		if( $page_options['ts_second_footer_area'] ){
			yoome_change_theme_options('ts_second_footer_area', $page_options['ts_second_footer_area']);
		}
	}
	
	/* Archive - Category product */
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') || (function_exists('dokan_is_store_page') && dokan_is_store_page()) ){
		yoome_set_header_breadcrumb_layout_woocommerce_page( 'shop' );
	
		add_action( 'wp_enqueue_scripts', 'yoome_grid_list_desc_style', 1000 );
		
		yoome_remove_hooks_from_shop_loop();
		
		if( function_exists('dokan_is_store_page') && dokan_is_store_page() && !yoome_get_theme_options('ts_prod_cat_grid_desc') ){
			remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description', 60);
		}
		
		/* Update product category layout */
		if( is_tax('product_cat') ){
			$term = $wp_query->queried_object;
			if( !empty($term->term_id) ){
				$bg_breadcrumbs_id = get_term_meta($term->term_id, 'bg_breadcrumbs_id', true);
				$layout = get_term_meta($term->term_id, 'layout', true);
				$left_sidebar = get_term_meta($term->term_id, 'left_sidebar', true);
				$right_sidebar = get_term_meta($term->term_id, 'right_sidebar', true);
				
				if( $bg_breadcrumbs_id != '' ){
					$bg_breadcrumbs_src = wp_get_attachment_url( $bg_breadcrumbs_id );
					if( $bg_breadcrumbs_src !== false ){
						yoome_change_theme_options('ts_bg_breadcrumbs', $bg_breadcrumbs_src);
					}
				}
				if( $layout != '' ){
					yoome_change_theme_options('ts_prod_cat_layout', $layout);
				}
				if( $left_sidebar != '' ){
					yoome_change_theme_options('ts_prod_cat_left_sidebar', $left_sidebar);
				}
				if( $right_sidebar != '' ){
					yoome_change_theme_options('ts_prod_cat_right_sidebar', $right_sidebar);
				}
			}
		}
	}
	
	/* single post */
	if( is_singular('post') ){
		$post_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$post_data[$key] = $value[0];
			}
		}
		
		if( isset($post_data['ts_post_layout']) && $post_data['ts_post_layout'] != '0' ){
			yoome_change_theme_options('ts_blog_details_layout', $post_data['ts_post_layout']);
		}
		if( isset($post_data['ts_post_left_sidebar']) && $post_data['ts_post_left_sidebar'] != '0' ){
			yoome_change_theme_options('ts_blog_details_left_sidebar', $post_data['ts_post_left_sidebar']);
		}
		if( isset($post_data['ts_post_right_sidebar']) && $post_data['ts_post_right_sidebar'] != '0' ){
			yoome_change_theme_options('ts_blog_details_right_sidebar', $post_data['ts_post_right_sidebar']);
		}
		
		if( isset($post_data['ts_bg_breadcrumbs']) && $post_data['ts_bg_breadcrumbs'] != '' ){
			yoome_change_theme_options('ts_bg_breadcrumbs', $post_data['ts_bg_breadcrumbs']);
		}
	}
	
	/* Single product */
	if( is_singular('product') ){
		/* Remove hooks on Related and Up-Sell products */
		yoome_remove_hooks_from_shop_loop();
		$theme_options = yoome_get_theme_options();
		if( ! $theme_options['ts_prod_cat_grid_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description', 60);
		}
	
		$prod_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$prod_data[$key] = $value[0];
			}
		}
		if( isset($prod_data['ts_prod_layout']) && $prod_data['ts_prod_layout'] != '0' ){
			yoome_change_theme_options('ts_prod_layout', $prod_data['ts_prod_layout']);
		}
		if( isset($prod_data['ts_prod_left_sidebar']) && $prod_data['ts_prod_left_sidebar'] != '0' ){
			yoome_change_theme_options('ts_prod_left_sidebar', $prod_data['ts_prod_left_sidebar']);
		}
		if( isset($prod_data['ts_prod_right_sidebar']) && $prod_data['ts_prod_right_sidebar'] != '0' ){
			yoome_change_theme_options('ts_prod_right_sidebar', $prod_data['ts_prod_right_sidebar']);
		}
		
		if( !$theme_options['ts_prod_thumbnail'] ){
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
		}
		
		if( $theme_options['ts_prod_title'] && $theme_options['ts_prod_title_in_content'] ){
			yoome_change_theme_options('ts_prod_title', 0); /* remove title above breadcrumb */
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);
		}
		
		if( !$theme_options['ts_prod_label'] ){
			remove_action('yoome_before_product_image', 'yoome_template_loop_product_label', 10);
		}
		
		if( !$theme_options['ts_prod_rating'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15);
		}
		
		if( !$theme_options['ts_prod_price'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
			remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
		}
		
		if( !$theme_options['ts_prod_count_down'] ){
			remove_action('woocommerce_single_product_summary', 'ts_template_loop_time_deals', 22);
		}
		
		if( !$theme_options['ts_prod_excerpt'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 25);
		}
		
		if( !$theme_options['ts_prod_add_to_cart'] || $theme_options['ts_enable_catalog_mode'] ){
			$terms        = get_the_terms( $post->ID, 'product_type' );
			$product_type = ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
			if( $product_type != 'variable' ){
				remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			}
			else{
				remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
			}
		}
		
		if( !$theme_options['ts_prod_upsells'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
		}
		
		if( !$theme_options['ts_prod_related'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
		
		/* Breadcrumb */
		if( isset($prod_data['ts_bg_breadcrumbs']) && $prod_data['ts_bg_breadcrumbs'] != '' ){
			yoome_change_theme_options('ts_bg_breadcrumbs', $prod_data['ts_bg_breadcrumbs']);
		}
		
		/* Thumbnail Summary Layout */
		if( $theme_options['ts_prod_thumbnail_summary_layout'] == 'scrolling' ){
			yoome_change_theme_options('ts_prod_thumbnails_style', 'horizontal');
			add_filter('yoome_single_product_shop_thumbnail_size', function(){ return 'woocommerce_single'; });
		}
		
		if( $theme_options['ts_prod_thumbnail_summary_layout'] == 'top_thumbnail_slider' ){
			yoome_change_theme_options('ts_prod_layout', '0-1-0');
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
		}
		
		/* Product tabs position */
		if( $theme_options['ts_prod_tabs_position'] == 'inside_summary' && $theme_options['ts_prod_thumbnail_summary_layout'] != 'top_thumbnail_slider' ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
		}
		
		/* Add extra classes to post */
		add_action('woocommerce_before_single_product', 'yoome_woocommerce_before_single_product');
	}
	
	/* Single Portfolio */
	if( is_singular('ts_portfolio') ){
		$portfolio_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$portfolio_data[$key] = $value[0];
			}
		}
		
		if( isset($portfolio_data['ts_portfolio_custom_field']) && $portfolio_data['ts_portfolio_custom_field'] == 1 ){
			if( isset($portfolio_data['ts_portfolio_custom_field_title']) ){
				yoome_change_theme_options('ts_portfolio_custom_field_title', $portfolio_data['ts_portfolio_custom_field_title']);
			}
			if( isset($portfolio_data['ts_portfolio_custom_field_content']) ){
				yoome_change_theme_options('ts_portfolio_custom_field_content', $portfolio_data['ts_portfolio_custom_field_content']);
			}
		}
	}
	
	/* WooCommerce - Other pages */
	if( class_exists('WooCommerce') ){
		if( is_cart() ){
			yoome_set_header_breadcrumb_layout_woocommerce_page( 'cart' );
			
			yoome_remove_hooks_from_shop_loop();
			
			if( ! yoome_get_theme_options('ts_prod_cat_grid_desc') ){
				remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_short_description', 60);
			}
		}
		
		if( is_checkout() ){
			yoome_set_header_breadcrumb_layout_woocommerce_page( 'checkout' );
		}
		
		if( is_account_page() ){
			yoome_set_header_breadcrumb_layout_woocommerce_page( 'myaccount' );
		}
	}

	/* Header Cart - Wishlist */
	if( !class_exists('WooCommerce') ){
		yoome_change_theme_options('ts_enable_tiny_shopping_cart', 0);
	}
	
	if( !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
		yoome_change_theme_options('ts_enable_tiny_wishlist', 0);
	}
	
	/* Right to left */
	if( is_rtl() ){
		yoome_change_theme_options('ts_enable_rtl', 1);
	}
	
	/* Remove background image if not necessary */
	$load_bg = true;
	if( yoome_get_theme_options('ts_layout_fullwidth') ){
		$load_bg = false;
	}
	if( is_page() && $load_bg && $layout_style = yoome_get_page_options('ts_layout_style') ){
		if( $layout_style == 'wide' || ( $layout_style == 'default' && yoome_get_theme_options('ts_layout_style') == 'wide' ) ){
			$load_bg = false;
		}
	}
	
	if( !$load_bg ){
		add_filter('theme_mod_background_image', '__return_empty_string');
	}
}

function yoome_filter_wp_nav_menu_args( $args ){
	global $post;
	if( is_page() && !is_admin() && !empty($args['theme_location']) && $args['theme_location'] == 'primary' ){
		$menu = get_post_meta($post->ID, 'ts_menu_id', true);
		if( $menu ){
			$args['menu'] = $menu;
		}
	}
	return $args;
}

add_filter('single_template', 'yoome_change_single_portfolio_template');
function yoome_change_single_portfolio_template( $single_template ){
	
	if( is_singular('ts_portfolio') && locate_template('single-portfolio.php') ){
		$single_template = locate_template('single-portfolio.php');
	}
	
	return $single_template;
}

function yoome_remove_hooks_from_shop_loop(){
	$theme_options = yoome_get_theme_options();
	
	if( ! $theme_options['ts_prod_cat_thumbnail'] ){
		remove_action('woocommerce_before_shop_loop_item_title', 'yoome_template_loop_product_thumbnail', 10);
	}
	if( ! $theme_options['ts_prod_cat_label'] ){
		remove_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_product_label', 1);
	}
	
	if( ! $theme_options['ts_prod_cat_cat'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_categories', 10);
	}
	if( ! $theme_options['ts_prod_cat_sku'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_sku', 20);
	}
	if( ! $theme_options['ts_prod_cat_title'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_title', 30);
	}
	if( ! $theme_options['ts_prod_cat_price'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 40);
	}
	if( ! $theme_options['ts_prod_cat_rating'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 45);
	}
	if( ! $theme_options['ts_prod_cat_add_to_cart'] ){
		remove_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_add_to_cart', 70); 
		remove_action('woocommerce_after_shop_loop_item_title', 'yoome_template_loop_add_to_cart', 10004 );
	}
	
	if( $theme_options['ts_prod_cat_color_swatch'] ){
		add_action('woocommerce_after_shop_loop_item', 'yoome_template_loop_product_variable_color', 50);
		$number_color_swatch = absint( $theme_options['ts_prod_cat_number_color_swatch'] );
		add_filter('yoome_loop_product_variable_color_number', function() use ($number_color_swatch){
			return $number_color_swatch;
		});
	}

	if( $theme_options['ts_prod_cat_meta_align'] == 'center' ){
		add_filter('body_class', function( $classes ){
			$classes[] = 'product-meta-center';
			return $classes;
		});
	}
	
	if( $theme_options['ts_prod_cat_thumbnail_border'] ){
		add_filter('body_class', function( $classes ){
			$classes[] = 'image-border';
			return $classes;
		});
	}
	
	$loading_type = $theme_options['ts_prod_cat_loading_type'];
	if( $loading_type != 'default' ){
		add_filter('body_class', function( $classes ) use ($loading_type){
			$classes[] = $loading_type;
			return $classes;
		});
	}
	
	if( in_array($loading_type, array('infinity-scroll', 'load-more-button')) ){
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		yoome_change_theme_options('ts_prod_cat_per_page_dropdown', 0);
	}
}

function yoome_grid_list_desc_style(){
	$custom_css = ".products.list .short-description.list{display: inline-block !important;}";
	$custom_css .= ".products.grid .short-description.grid{display: inline-block !important;}";
    wp_add_inline_style('yoome-reset', $custom_css);
}

function yoome_set_header_breadcrumb_layout_woocommerce_page( $page = 'shop' ){
	/* Header Layout */
	$header_layout = get_post_meta(wc_get_page_id( $page ), 'ts_header_layout', true);
	if( $header_layout != 'default' && $header_layout != '' ){
		yoome_change_theme_options('ts_header_layout', $header_layout);
	}
	
	/* Breadcrumb Layout */
	$breadcrumb_layout = get_post_meta(wc_get_page_id( $page ), 'ts_breadcrumb_layout', true);
	if( $breadcrumb_layout != 'default' && $breadcrumb_layout != '' ){
		yoome_change_theme_options('ts_breadcrumb_layout', $breadcrumb_layout);
	}
}

function yoome_woocommerce_before_single_product(){
	add_filter('post_class', 'yoome_single_product_post_class_filter');
}

function yoome_single_product_post_class_filter( $classes ){
	$theme_options = yoome_get_theme_options();
	if( $theme_options['ts_prod_accordion_tabs'] && $theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
		$classes[] = 'accordion-tab';
	}
	if( $theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
		$classes[] = 'tabs-in-summary';
	}
	if( $theme_options['ts_prod_thumbnails_style'] == 'vertical' ){
		$classes[] = 'vertical-thumbnail';
	}
	$classes[] = 'thumbnail-summary-' . $theme_options['ts_prod_thumbnail_summary_layout'];
	if( $theme_options['ts_prod_thumbnail_border'] ){
		$classes[] = 'thumbnail-border';
	}
	if( !$theme_options['ts_prod_add_to_cart'] || $theme_options['ts_enable_catalog_mode'] ){
		$classes[] = 'no-addtocart';
	}
	if( !$theme_options['ts_prod_rating'] ){
		$classes[] = 'no-rating';
	}
	if( !class_exists('YITH_WCWL') ){
		$classes[] = 'single-no-wishlist';
	}
	if( !class_exists('YITH_Woocompare') || get_option('yith_woocompare_compare_button_in_product_page') != 'yes' ){
		$classes[] = 'single-no-compare';
	}
	remove_filter('post_class', 'yoome_single_product_post_class_filter');
	return $classes;
}
?>
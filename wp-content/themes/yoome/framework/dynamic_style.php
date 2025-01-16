<?php
if( !isset($data) ){
	$data = yoome_get_theme_options();
}

update_option('ts_load_dynamic_style', 0);

$default_options = array(
				'ts_responsive'										=> 1
				,'ts_enable_rtl'									=> 0
				,'ts_layout_fullwidth'								=> 0
				,'ts_logo_width'									=> "140"
				,'ts_device_logo_width'								=> "144"
				,'ts_product_rating_style'							=> 'border'
				,'ts_custom_css_code'								=> ''
				,'ts_custom_font_ttf'								=> array( 'url' => '' )
				,'ts_grid_list_icon'								=> array( 'url' => '' )
				,'ts_grid_list_hover_icon'							=> array( 'url' => '' )
		);
		
foreach( $default_options as $option_name => $value ){
	if( isset($data[$option_name]) ){
		$default_options[$option_name] = $data[$option_name];
	}
}

extract($default_options);
		
$default_colors = array(

				'ts_main_content_background_color'							=> "#ffffff"
				,'ts_text_color'											=> "#888888"
				
				,'ts_input_text_color'										=> "#222222"
				,'ts_input_text_hover'										=> "#222222"
				,'ts_input_border_color'									=> "#e5e5e5"
				,'ts_input_border_color_hover'								=> "#c0c0c0"
				
				,'ts_heading_color'											=> "#222222"
				
				,'ts_link_color'											=> "#f27e01"
				,'ts_link_color_hover'										=> "#f27e01"
				
				,'ts_text_bold_color'										=> "#222222"
				
				// BUTTON NAV
				,'ts_nav_text_color'										=> "#f27e01"
				,'ts_nav_text_hover'										=> "#f27e01"
				,'ts_nav_background_color'									=> "#f1f1f1"
				,'ts_nav_background_hover'									=> "#222222"
				
				,'ts_primary_color'											=> "#f27e01"
				,'ts_text_color_in_bg_primary'								=> "#ffffff"
				
				,'ts_border_color'											=> "#e5e5e5"

				,'ts_button_text_color'										=> "#ffffff"
				,'ts_button_text_hover'										=> "#ffffff"
				,'ts_button_background_color'								=> "#222222"
				,'ts_button_background_hover'								=> "#f27e01"
				
				// BREADCRUMB
				,'ts_breadcrumb_text_color'									=> "#ffffff"
				,'ts_breadcrumb_heading_color'								=> "#ffffff"
				,'ts_breadcrumb_link_color_hover'							=> "#f27e01"
				,'ts_breadcrumb_background_color'							=> "#ffffff"
				
				// HEADER
				,'ts_top_header_background_color'							=> "#ffffff"
				,'ts_top_header_text_color'									=> "#222222"
				,'ts_top_header_border_color'								=> "#e5e5e5"
				
				,'ts_bottom_header_background_color'						=> "#ffffff"
				,'ts_header_icon_hover'										=> "#f27e01"
				
				
				// MENU
				
				,'ts_menu_text_color'										=> "#222222"
				,'ts_menu_text_hover'										=> "#f27e01"
				,'ts_menu_light_text_hover'									=> "#000000"
				,'ts_menu_border_color'										=> "#e5e5e5"

				,'ts_sub_menu_background_color'								=> "#ffffff"
				,'ts_sub_menu_text_color'									=> "#222222"
				,'ts_sub_menu_text_hover'									=> "#f27e01"
				,'ts_sub_menu_heading_color'								=> "#222222"
				
				,'ts_header_menu_mobile_background_color'					=> "#222222"
				,'ts_header_menu_mobile_text_color'							=> "#ffffff"
				,'ts_menu_mobile_text_color'								=> "#222222"
				,'ts_menu_mobile_text_hover'								=> "#f27e01"
				,'ts_menu_mobile_heading_color'								=> "#222222"
				,'ts_menu_mobile_background_color'							=> "#ffffff"
				
				// FOOTER
				,'ts_footer_background_color'								=> "#222222"
				,'ts_footer_text_color'										=> "#ffffff"
				,'ts_footer_text_hover'										=> "#f27e01"
				,'ts_footer_heading_color'									=> "#ffffff"
				,'ts_footer_border_color'									=> "#3f3f3f"
				,'ts_footer_end_background_color'							=> "#222222"
				,'ts_footer_end_text_color'									=> "#cccccc"
				,'ts_footer_end_link_color'									=> "#f27e01"
				,'ts_footer_end_link_hover'									=> "#f27e01"

				// PRODUCT
				,'ts_product_countdown_background_color'					=> "#f7f7f7"
				,'ts_product_countdown_text_color'							=> "#000000"
				,'ts_product_countdown_border_color'						=> "#f7f7f7"
				
				,'ts_rating_color'											=> "#c1bfbf"
				,'ts_rating_fill_color'										=> "#222222"
				
				,'ts_product_name_text_color'								=> "#222222"

				,'ts_product_button_thumbnail_text_color'					=> "#222222"
				,'ts_product_button_thumbnail_text_hover'					=> "#f27e01"
				,'ts_product_button_thumbnail_background_color'				=> "#ffffff"
				,'ts_product_button_thumbnail_background_hover'				=> "#222222"
				,'ts_product_button_thumbnail_tooltip_text_color'			=> "#222222"
				,'ts_product_button_thumbnail_tooltip_background_color'		=> "#ffffff"
				,'ts_product_button_meta_mobile_text_hover'					=> "#f27e01"

				,'ts_product_sale_label_text_color'							=> "#ffffff"
				,'ts_product_sale_label_background_color'					=> "#222222"
				,'ts_product_new_label_text_color'							=> "#ffffff"
				,'ts_product_new_label_background_color'					=> "#3f7bf5"
				,'ts_product_feature_label_text_color'						=> "#ffffff"
				,'ts_product_feature_label_background_color'				=> "#f27e01"
				,'ts_product_outstock_label_text_color'						=> "#ffffff"
				,'ts_product_outstock_label_background_color'				=> "#989898"

				,'ts_product_price_color'									=> "#222222"
				,'ts_product_del_price_color'								=> "#999999"
				,'ts_product_sale_price_color'								=> "#222222"
				
				,'ts_special_button_text_color'								=> "#f27e01"
				
);

$data = apply_filters('yoome_custom_style_data', $data);

foreach( $default_colors as $option_name => $default_color ){
	if( isset($data[$option_name]['rgba']) ){
		$default_colors[$option_name] = $data[$option_name]['rgba'];
	}
	else if( isset($data[$option_name]['color']) ){
		$default_colors[$option_name] = $data[$option_name]['color'];
	}
}

extract( $default_colors );

/* Parse font option. Ex: if option name is ts_body_font, we will have variables below:
* ts_body_font (font-family)
* ts_body_font_weight
* ts_body_font_style
* ts_body_font_size
* ts_body_font_line_height
* ts_body_font_letter_spacing
*/
$font_option_names = array(
							'ts_body_font',
							'ts_body_font_bold',
							'ts_heading_font',
							'ts_heading_font_2',
							'ts_product_name_font',
							'ts_menu_font',
							'ts_menu_font_hover',
							'ts_sub_menu_font',
							);
$font_size_option_names = array( 
							'ts_h1_font', 
							'ts_h2_font', 
							'ts_h3_font', 
							'ts_h4_font', 
							'ts_h5_font', 
							'ts_h6_font',
							'ts_button_font',
							'ts_h1_ipad_font', 
							'ts_h2_ipad_font', 
							'ts_h3_ipad_font', 
							'ts_h4_ipad_font',
							'ts_h1_mobile_font', 
							'ts_h2_mobile_font', 
							'ts_h3_mobile_font', 
							'ts_h4_mobile_font',
							);
$font_option_names = array_merge($font_option_names, $font_size_option_names);
foreach( $font_option_names as $option_name ){
	$default = array(
		$option_name 						=> 'inherit'
		,$option_name . '_weight' 			=> 'normal'
		,$option_name . '_style' 			=> 'normal'
		,$option_name . '_size' 			=> 'inherit'
		,$option_name . '_line_height' 		=> 'inherit'
		,$option_name . '_letter_spacing' 	=> 'inherit'
	);
	if( is_array($data[$option_name]) ){
		if( !empty($data[$option_name]['font-family']) ){
			$default[$option_name] = $data[$option_name]['font-family'];
		}
		if( !empty($data[$option_name]['font-weight']) ){
			$default[$option_name . '_weight'] = $data[$option_name]['font-weight'];
		}
		if( !empty($data[$option_name]['font-style']) ){
			$default[$option_name . '_style'] = $data[$option_name]['font-style'];
		}
		if( !empty($data[$option_name]['font-size']) ){
			$default[$option_name . '_size'] = $data[$option_name]['font-size'];
		}
		if( !empty($data[$option_name]['line-height']) ){
			$default[$option_name . '_line_height'] = $data[$option_name]['line-height'];
		}
		if( !empty($data[$option_name]['letter-spacing']) ){
			$default[$option_name . '_letter_spacing'] = $data[$option_name]['letter-spacing'];
		}
	}
	extract( $default );
}
?>	
	
	/*
	1. FONT FAMILY
	2. FONT SIZE
	3. COLORS
	4. RESPONSIVE
	5. FULLWIDTH LAYOUT
	*/
	header .logo img,
	header .logo-header img,
	.ts-sidebar-content .logo img{
		width: <?php echo absint($ts_logo_width); ?>px;
	}
	.header-v6 .header-middle > .container > .logo-wrapper{
		width: <?php echo absint($ts_logo_width + 50); ?>px;
	}
	<?php if( isset($data['ts_product_rating_style']) && $data['ts_product_rating_style'] == 'fill' ): ?>
		.ts-testimonial-wrapper .rating span:before,
		blockquote .rating span:before,
		.woocommerce .star-rating span:before{
			content: "\53\53\53\53\53";
		}
		.ts-testimonial-wrapper .rating:before,
		blockquote .rating:before,
		.woocommerce .star-rating:before,
		.ts-testimonial-wrapper .rating span:before,
		blockquote .rating span:before,
		.woocommerce .star-rating span:before{
			font-size: 14px;
			line-height: 20px;
		}
		.ts-testimonial-wrapper .rating,
		blockquote .rating,
		.woocommerce .products .star-rating,
		.woocommerce .star-rating{
			height: 20px;
			width: 82px;
		}
	<?php endif; ?>
	
	<?php if( isset($ts_grid_list_icon) && $ts_grid_list_icon['url'] ): ?>
	.gridlist-toggle a#grid,
	.gridlist-toggle a#list{
		background-image: url(<?php echo esc_url($ts_grid_list_icon['url']); ?>);
	}
	<?php endif; ?>
	
	<?php if( isset($ts_grid_list_hover_icon) && $ts_grid_list_hover_icon['url'] ): ?>
	.gridlist-toggle a#grid:hover,
	.gridlist-toggle a#list:hover,
	.gridlist-toggle a#grid.active,
	.gridlist-toggle a#list.active{
		background-image: url(<?php echo esc_url($ts_grid_list_hover_icon['url']); ?>);
	}
	<?php endif; ?>
	
	
	/******* 1. FONT FAMILY *******/
	
	<?php 
	/* Custom Font */
	if( isset($ts_custom_font_ttf) && $ts_custom_font_ttf['url'] ):
	?>
	@font-face {
		font-family: 'CustomFont';
		src:url('<?php echo esc_url($ts_custom_font_ttf['url']); ?>') format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	<?php endif; ?>
	
	html,
	body,
	label,
	input,
	textarea,
	keygen,
	select,
	button,
	.font-body,
	.hotspot-modal,
	.mc4wp-form-fields label,
	.woocommerce-checkout .checkout .create-account label,
	#ship-to-different-address label,
	form table label,
	.ts-button.fa,
	li.fa,
	.avatar-name a,
	#order_review table .product-name strong,
	.breadcrumb-title-wrapper .breadcrumbs,
	.ts-testimonial-wrapper .author-role,
	.product-group-button .button-tooltip, 
	.woocommerce ul.product_list_widget li a,
	.list-posts article.post_format-post-format-quote blockquote,
	article.single-post .entry-format blockquote,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	.ts-testimonial-wrapper .ts-testimonial-wrapper h4.name a,
	.ts-twitter-slider.twitter-content h4.name > a,
	.vc_toggle_default .vc_toggle_title h4,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title,
	.cart_totals table th,
	.woocommerce #order_review table.shop_table tfoot td,
	.woocommerce table.shop_table.order_details tfoot th,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	body .pp_nav .currentTextHolder,
	body .theme-default .nivo-caption,
	.dokan-category-menu .sub-block h3,
	.menu-wrapper nav > ul.menu li .menu-desc,
	body .dataTables_wrapper,
	body .hotspot-moda,
	body .compare-list,
	.ts-milestone h3.subject,
	.ts-banner.style-3 .description,
	body .font-family-body,
	.widget_display_stats > dl dt,
	.ts-banner.style-heading-center .description,
	.ts-banner.style-heading-background .description,
	.rating-wrapper strong.rating,
	.column-tabs ul.tabs li span.count,
	.ts-banner.style-simple-text-2 h3,
	.ts-banner.style-simple-text-3 h3,
	.ts-product-attribute > div.option.text a,
	.ts-banner.style-1 h2,
	.ts-banner .description,
	.step-number .feature-title,
	.default blockquote,
	.ts-banner.style-box-center h3,
	.comment_list_widget blockquote.comment-body,
	table.shop_table.cart .product-subtotal .amount,
	.ts-tiny-cart-wrapper .total > span.amount,
	.ts-tiny-cart-wrapper .subtotal > span.amount,
	.woocommerce .products .product .price,
	.price .amount,
	.product_list_widget .price .amount,
	.total .amount, 
	.cart-subtotal .amount,
	.product-total .amount,
	.product-meta .amount,
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.single-navigation .product-info .price,
	.woocommerce ul#shipping_method li .amount,
	.wishlist_table .product-price .amount,
	.quantity span.amount,
	.ts-product-in-category-tab-wrapper.tab-heading-horizontal-italic .column-tabs ul.tabs li{
		font-family: <?php echo esc_html($ts_body_font); ?>;
		font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
		font-style: <?php echo esc_html($ts_body_font_style); ?>;
		letter-spacing: <?php echo esc_html($ts_body_font_letter_spacing); ?>;
	}
	.woocommerce table.shop_table tbody th, 
	.woocommerce table.shop_table tfoot td, 
	.woocommerce table.shop_table tfoot th,
	.woocommerce-cart .cart-collaterals .cart_totals table td:before,
	.cart_list li .cart-item-wrapper a.remove,
	.woocommerce .widget_shopping_cart .cart_list li a.remove,
	.woocommerce.widget_shopping_cart .cart_list li a.remove,
	.ts-milestone h3.subject{
		font-weight: <?php echo esc_html($ts_body_font_weight); ?>;
	}
	blockquote,
	table thead th,
	form label,
	.comment-detail .reply a,
	.comment-detail .edit a,
	.entry-meta-top .date-time, 
	.comment-meta .date-time,
	.widget_recent_entries .post-date,
	.entry-author .author-info .role,
	.avatar-name a,
	.woocommerce div.product p.availability.stock label,
	.woocommerce div.product .sku-wrapper span:not(.sku),
	.brands-link span:not(.brand-links),
	.cats-link span:not(.cat-links),
	.tags-link span:not(.tag-links),
	.ts-social-sharing span,
	.ts-price-table .table-title,
	.woocommerce form .form-row label.inline,
	.ts-blogs .button-readmore.button-text,
	.widget_calendar caption,
	table#wp-calendar thead th,
	.widget_rss .rsswidget,
	.widget_rss cite,
	.wp-caption p.wp-caption-text,
	body div.ppt,
	.woocommerce #reviews #reply-title,
	.widget_shopping_cart_content p.total strong,
	.wp-caption p.wp-caption-text,
	.woocommerce div.product .entry-title,
	.ts-blogs-widget-wrapper .post-title
	.cart_list .quantity,
	body #yith-woocompare table.compare-list .add-to-cart td a,
	body table.compare-list tr.price td,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
	a.button,
	button,
	input[type^="submit"],
	.shopping-cart p.buttons a,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce-page a.button,
	.woocommerce-page button.button,
	.woocommerce-page input.button,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce-page a.button.alt,
	.woocommerce-page button.button.alt,
	.woocommerce-page input.button.alt,
	#content button.button,
	.woocommerce #respond input#submit, 
	div.button a,
	body .yith-woocompare-widget a.compare,
	.woocommerce .wishlist_table .product-add-to-cart a,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce-page .widget_price_filter .price_slider_amount .button,
	.portfolio-info > span:first-child,
	.single-portfolio .social-sharing > span,
	.woocommerce > form > fieldset legend,
	.cloud-zoom-title,
	.woocommerce .quantity input.qty, 
	.quantity input.qty,
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	body .product-edit-new-container .dokan-btn-lg,
	#ts-search-result-container .view-all-wrapper,
	.ts-search-result-container li a span.hightlight,
	.ts-countdown.style-border .counter-wrapper > div .ref-wrapper,
	.vc_pie_chart .vc_pie_chart_value,
	.ts-button.fa,
	.ts-button,
	body a.button-text,
	.single-navigation-1 a,
	.single-navigation-2 a,
	.entry-author .author a,
	.comment-detail .author,
	.woocommerce #reviews #reply-title,
	.woocommerce #reviews #comments > h2,
	.google-map-container .information > h6,
	.vc_column_container .vc_btn,
	.vc_column_container .wpb_button,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	body.wpb-js-composer .vc_toggle_default .vc_toggle_title h4,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a span,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a span,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a span,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a span,
	.title-contact,
	.single-portfolio .single-navigation > div a:first-child,
	#ts-search-sidebar .ts-search-result-container .view-all-wrapper a,
	.ts-search-result-container > p,
	.comment-form-rating label,
	.ts-banner-image .button-link,
	.ts-team-members h3 a,
	.event .title-time .title,
	.portfolio-inner h3 a,
	body h4.wpb_pie_chart_heading,
	.woocommerce-account-fields > p > label,
	.woocommerce #payment ul.payment_methods > li > label,
	.woocommerce div.product form.cart .quantity span,
	.wishlist_table tr td.product-stock-status span,
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	.woocommerce #order_review table.shop_table tfoot th,
	body table.compare-list th,
	.ts-milestone .number,
	.ts-portfolio-wrapper .filter-bar li,
	.counter-wrapper .number,
	.tab-heading-default .column-tabs ul.tabs li,
	.ts-list-of-product-categories-wrapper .button-link,
	.ts-product-in-category-tab-wrapper .column-tabs ul.tabs li,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a,
	.ts-product-attribute > div:not(.color) a,
	blockquote .author-role .author a,
	.ts-shortcode.title-default .shortcode-heading-wrapper .heading-title,
	.heading-title,
	.woocommerce-shipping-destination strong,
	.ts-shortcode.tab-heading-horizontal .column-tabs ul.tabs li,
	.ts-banner.style-simple-text-2 h2,
	.ts-banner.style-simple-text-4 h3,
	.ts-banner.style-simple-text-4 h2,
	.ts-banner.style-simple-text-3 h2,
	.ts-banner.style-simple-text-3 h4,
	.vc_single_bar .vc_label_units,
	.ts-price-table .table-price,
	.woocommerce div.product form.cart .variations select,
	.ts-active-filters .widget_layered_nav_filters ul li a,
	.widget-title,
	body .widgettitle,
	body .title-categories,
	.ts-banner.style-box-center h2,
	#ts-search-result-container .view-all-wrapper a,
	.ts-feature-wrapper.vertical-image h4,
	.ts-shop-load-more .button,

	.woocommerce span.onsale,
	.woocommerce div.product .images .product-label span.onsale, 
	.woocommerce div.product .images .product-label span.new, 
	.woocommerce div.product .images .product-label span.featured, 
	.woocommerce div.product .images .product-label span.out-of-stock, 
	.woocommerce div.product .images .product-label span,

	.woocommerce .product .product-label .onsale, 
	.woocommerce .product .product-label .new, 
	.woocommerce .product .product-label .featured, 
	.woocommerce .product .product-label .out-of-stock{
		font-family: <?php echo esc_html($ts_body_font_bold); ?>;
		font-weight: <?php echo esc_html($ts_body_font_bold_weight); ?>;
		font-style: <?php echo esc_html($ts_body_font_bold_style); ?>;
		letter-spacing: <?php echo esc_html($ts_body_font_bold_letter_spacing); ?>;
	}
	@media only screen and (max-width: 767px){
		body .my-account-wrapper .account-control > a,
		#group-icon-header .ts-sidebar-content .group-button-header > div > h6,
		#group-icon-header .ts-sidebar-content .group-button-header > .ts-header-social-icons > span{
			font-family: <?php echo esc_html($ts_body_font_bold); ?>;
			font-weight: <?php echo esc_html($ts_body_font_bold_weight); ?>;
			font-style: <?php echo esc_html($ts_body_font_bold_style); ?>;
			letter-spacing: <?php echo esc_html($ts_body_font_bold_letter_spacing); ?>;
		}
	}
	.ts-banner.style-box-content-shadow header h2,
	body.error404 article > h1.heading-font-1,
	body.error404 article > h2.heading-font-2,
	.ts-dropcap,
	.ts-countdown .counter-wrapper .number,
	.ts-countdown .counter-wrapper .ref-wrapper,
	.style-border-bottom .heading,
	.ts-header-intro .ts-feature-wrapper.vertical-image h4{
		font-family: <?php echo esc_html($ts_body_font_bold); ?>;
		font-weight: <?php echo esc_html($ts_body_font_bold_weight); ?>;
		font-style: <?php echo esc_html($ts_body_font_bold_style); ?>;
		letter-spacing: <?php echo esc_html($ts_body_font_bold_letter_spacing); ?>;
	}
	.woocommerce ul.cart_list li a, 
	.woocommerce ul.product_list_widget li a,
	.add-to-cart-popup-content .product-meta a,
	.ts-search-result-container ul li a,
	.widget-container ul.product_list_widget li > a,
	.widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
	.widget.ts-products-widget .ts-wg-meta > a,
	.woocommerce ul.product_list_widget .ts-wg-meta > a,
	h3.product-name > a,
	h3.product-name,
	.product-name a,
	ul.wishlist_table .item-details .product-name h3,
	.woocommerce #order_review table.shop_table tbody td.product-name,
	.woocommerce #order_review table.shop_table tfoot td.product-name,
	body #yith-woocompare table.compare-list tr.title td,
	.single-navigation .product-info,
	.group_table a,
	.woocommerce div.product .entry-title{
		font-family: <?php echo esc_html($ts_product_name_font); ?>;
		font-weight: <?php echo esc_html($ts_product_name_font_weight); ?>;
		font-style: <?php echo esc_html($ts_product_name_font_style); ?>;
		letter-spacing: <?php echo esc_html($ts_product_name_font_letter_spacing); ?>;
	}

	h1,h2,h3,
	.h1,.h2,.h3,
	h1.wpb_heading,
	h2.wpb_heading,
	h4,h5,h6,
	.h4,.h5,.h6,
	h3.wpb_heading,
	h4.wpb_heading,
	h5.wpb_heading,
	h6.wpb_heading,
	.ts-heading > h1,
	.ts-heading > h2,
	.ts-heading > h3,
	.ts-heading > h4,
	.breadcrumb-title-wrapper.breadcrumb-v1 .breadcrumb-title > h1,
	.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-title > h1,
	.table-title-2,
	.table-title,
	.ts-banner.style-2 h2,
	.ts-banner.style-heading-line h2,
	.ts-banner.style-1 h3,
	.ts-testimonial-wrapper .byline,
	.category-name h3,
	.ts-product-brand-wrapper .item h3,
	.widget-container .post_list_widget > li h4.entry-title,
	.heading-tab .heading-title,
	.shortcode-heading-wrapper .heading-title,
	.heading-wrapper > h2, 
	.heading-shortcode > h3,
	html body > h1,
	body div.ppt,
	#order_review_heading,
	.widget.ts-products-widget > .widgettitle,
	.ts-sidebar-content h4.title,
	.theme-title .heading-title,
	.comments-title .heading-title,
	#comment-wrapper .heading-title,
	body .ts-footer-block .widget .widgettitle,
	body .ts-footer-block .widget-title,
	.ts-shortcode.title-default .shortcode-heading-wrapper .heading-title,
	.breadcrumb-title h1,
	#customer_login h2,
	.woocommerce-account div.woocommerce > h2,
	.account-content h2,
	.woocommerce-MyAccount-content > h2,
	.woocommerce div.wishlist-title h2,
	.woocommerce-customer-details > h2,
	.woocommerce-order-details > h2,
	.woocommerce .cross-sells > h2,
	.woocommerce .up-sells > h2,
	.woocommerce .related > h2,
	.woocommerce-additional-fields > h3,
	header.woocommerce-Address-title > h3,
	.wp-caption p.wp-caption-text,
	.cart-collaterals .cart_totals > h2,
	.woocommerce-billing-fields > h3,
	.related > h2,
	.theme-title > h3, 
	.cross-sells > h2, 
	.up-sells > h2, 
	.vertical-number .big-number,
	.ts-banner header h3, 
	.ts-banner header h2,
	.h1-thin strong,
	.step-number .big-number,
	.tab-heading-horizontal-center .column-tabs ul.tabs li{
		font-family: <?php echo esc_html($ts_heading_font); ?>;
		font-weight: <?php echo esc_html($ts_heading_font_weight); ?>;
		font-style: <?php echo esc_html($ts_heading_font_style); ?>;
		letter-spacing: <?php echo esc_html($ts_heading_font_letter_spacing); ?>;
	}
	.h1-thin,
	.ts-banner.style-box-image-shadow h3,
	.ts-banner.style-box-image h3{
		font-family: <?php echo esc_html($ts_heading_font_2); ?>;
		font-weight: <?php echo esc_html($ts_heading_font_2_weight); ?>;
		font-style: <?php echo esc_html($ts_heading_font_2_style); ?>;
		letter-spacing: <?php echo esc_html($ts_heading_font_2_letter_spacing); ?>;
	}

	header .menu-wrapper nav > ul.menu > li > a,
	header .menu-wrapper nav > ul > li > a,
	.mobile-menu-wrapper nav > ul > li > a,
	.ts-menu-widget nav.vertical-menu > ul > li > a{
		font-family: <?php echo esc_html($ts_menu_font); ?>;
		font-weight: <?php echo esc_html($ts_menu_font_weight); ?>;
		font-style: <?php echo esc_html($ts_menu_font_style); ?>;
		letter-spacing: <?php echo esc_html($ts_menu_font_letter_spacing); ?>;
	}
	header .menu-wrapper nav > ul.menu > li:hover > a,
	header .menu-wrapper nav > ul.menu > li.current-menu-item > a,
	header .menu-wrapper nav > ul.menu > li.current_page_parent > a,
	header .menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	header .menu-wrapper nav > ul.menu > li.current_page_item > a,
	header .menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	header .menu-wrapper nav > ul.menu > li.current-page-ancestor > a,
	header .menu-wrapper nav > ul.menu li.current-product_cat-ancestor > a,
	.ts-menu-widget nav.vertical-menu > ul > li:hover > a{
		font-family: <?php echo esc_html($ts_menu_font_hover); ?>;
		font-weight: <?php echo esc_html($ts_menu_font_hover_weight); ?>;
	}
	header .menu-wrapper nav > ul.menu ul.sub-menu > li > a,
	header .menu-wrapper nav div.list-link li > a,
	header .menu-wrapper nav > ul.menu li.widget_nav_menu li > a,
	.widget_nav_menu .menu > li > a,
	.mobile-menu-wrapper .mobile-menu li > a,
	.menu div.list-link li > a{
		font-family: <?php echo esc_html($ts_sub_menu_font); ?>;
		font-weight: <?php echo esc_html($ts_sub_menu_font_weight); ?>;
		font-style: <?php echo esc_html($ts_sub_menu_font_style); ?>;
		letter-spacing: <?php echo esc_html($ts_sub_menu_font_letter_spacing); ?>;
	}
	
	/******* 2. FONT SIZE *******/
	html,
	body,
	select option,
	.ts-testimonial-wrapper .author-role,
	.woocommerce div.product p.price,
	.woocommerce div.product p.availability.stock,
	.mc4wp-form-fields label,
	ul li .ts-megamenu-container,
	.comment-text,
	.woocommerce .order_details li,
	.comment_list_widget .comment-body,
	.post_list_widget .excerpt,
	.list-posts article.post_format-post-format-quote blockquote,
	article.single-post .entry-format blockquote,
	.woocommerce ul.products li.product .price del,
	.woocommerce ul.products li.product .price,
	.ts-tiny-cart-wrapper .form-content > label,
	.shopping-cart-wrapper .ts-tiny-cart-wrapper,
	.widget_calendar th,
	.widget_calendar td,
	.post_list_widget blockquote,
	#ts-search-result-container ul li a,
	#ts-search-result-container .view-all-wrapper a,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.yith-wcwl-share h4.yith-wcwl-share-title,
	.woocommerce-cart .cart-collaterals .cart_totals table td,
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.woocommerce table.wishlist_table,
	body table.compare-list tr.image td,
	body table.compare-list tr.price td,
	h3 > label,
	table.woocommerce-checkout-review-order-table th,
	body.wpb-js-composer .vc_tta.vc_general,
	.dokan-category-menu .sub-block h3,
	.woocommerce div.product .woocommerce-tabs .panel,
	.ts-team-members .team-info,
	.ts-banner.style-3 .description,
	.ts-banner.style-heading-center .description,
	.ts-banner.style-heading-background .description,
	.rating-wrapper strong.rating,
	body .wpml-ls-legacy-list-vertical a,
	body .wpml-ls-legacy-list-horizontal ul li a,
	/* COMPARE TABLE */
	body table.compare-list,
	body table.compare-list tr.image th,
	body table.compare-list tr.image td,
	body table.compare-list tr.title th,
	body table.compare-list tr.title td,
	body table.compare-list th,
	body table.compare-list td,
	body table.compare-list th{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
		line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
	}
	body .wpml-ls-legacy-dropdown .wpml-ls-sub-menu a, 
	body .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu a,
	body .wpml-ls-legacy-dropdown a.wpml-ls-item-toggle, 
	body .wpml-ls-legacy-dropdown-click a.wpml-ls-item-toggle,
	.ts-social-sharing li{
		line-height: <?php echo esc_html($ts_body_font_line_height); ?>;
	}
	.woocommerce .product .product-label .onsale,
	.woocommerce .product .product-label .new,
	.woocommerce .product .product-label .featured,
	.woocommerce .product .product-label .out-of-stock,
	.woocommerce nav.woocommerce-pagination ul li a.next:before,
	.woocommerce nav.woocommerce-pagination ul li a.prev:before,
	.ts-pagination ul li a.prev:before,
	.ts-pagination ul li a.next:before,
	.woocommerce table.my_account_orders td,
	.woocommerce table.shop_table.my_account_orders,
	body .select2-container--default .select2-selection--single .select2-selection__rendered,
	select,
	.item-list .woocommerce .star-rating,
	.woocommerce .item-list .star-rating,
	.woocommerce .list.products .star-rating,
	.vc_toggle_default .vc_toggle_title h4,
	.ts-menu-widget .widget-title-wrapper h3,
	.top-filter-widget-area .widget-title,
	.ts-active-filters .widget_layered_nav_filters .widgettitle{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
	}
	body #pp_full_res{
		line-height: <?php echo esc_html($ts_body_font_line_height); ?> !important;
	}
	.widget-container .tagcloud a{
		font-size: <?php echo esc_html($ts_body_font_size); ?> !important;
		line-height: <?php echo esc_html($ts_body_font_line_height); ?> !important;
	}
	.ts-team-members h3,
	.ts-banner.style-simple-text-3 h2,
	.ts-banner.style-simple-text-3 h4,
	.single-portfolio .single-navigation > div a:first-child,
	.ts-shortcode.title-background-primary .shortcode-heading-wrapper .heading-title,
	.ts-list-of-product-categories-wrapper .heading-title,
	.tab-heading-default .column-tabs ul.tabs li,
	.ts-banner.style-box-border header h2,
	.ts-banner.style-box-content-shadow .description,
	.ts-product-in-category-tab-wrapper .column-tabs ul.tabs li,
	.portfolio-inner .item h3,
	.woocommerce div.product form.cart .variations label,
	.ts-blog-videos-wrapper.ts-blogs .blogs > article:not(:first-child) .entry-title,
	.ts-image-box .box-header h4,
	.ts-blogs-wrapper .blogs article.quote blockquote,
	table th{
		font-size: <?php echo esc_html($ts_heading_font_size); ?>;
	}
	input,
	textarea,
	keygen,
	.single-portfolio .single-navigation > div a,
	.woocommerce form .form-row input.input-text,
	.woocommerce form .form-row textarea,
	.dokan-form-control,
	#add_payment_method table.cart td.actions .coupon .input-text,
	.woocommerce-cart table.cart td.actions .coupon .input-text,
	.woocommerce-checkout table.cart td.actions .coupon .input-text,
	.mailchimp-subscription .mc4wp-alert,
	.cats-portfolio,
	.vc_progress_bar .vc_single_bar .vc_label,
	.woocommerce-columns > h3,
	.mailchimp-subscription .mc4wp-alert{
		font-size: <?php echo esc_html($ts_body_font_size); ?>;
		line-height: 30px;/* default */
	}
	footer .widget-container .tagcloud a{
		font-size: <?php echo esc_html($ts_body_font_size); ?> !important;
		line-height: 20px;/* default */
	}
	ol li,
	ul li{
		line-height: 22px;/* default */
	}

	dt,
	dd,
	.woocommerce form .form-row label{
		line-height: 18px;/* default */
	}

	h1,
	.h1,
	.ts-milestone .number,
	.step-number .big-number{
		font-size: <?php echo esc_html($ts_h1_font_size); ?>;
		line-height: <?php echo esc_html($ts_h1_font_line_height); ?>;
	}

	h2,
	.h2,
	h1.wpb_heading,
	.ts-heading h1,
	.ts-banner h2,
	.breadcrumb-title-wrapper .breadcrumb-title h1,
	.vc_col-sm-12 .style-vertical .widget-title-wrapper h3,
	.breadcrumb-title-wrapper.breadcrumb-v3 .breadcrumb-title > h1,
	.breadcrumb-title-wrapper.breadcrumb-v4 .breadcrumb-title > h1,
	.ts-shortcode .shortcode-heading-wrapper .heading-title,
	.ts-banner.style-box-image-shadow h3,
	.ts-banner.style-simple-text h3,
	.ts-banner.style-simple-text-3 h3{
		font-size: <?php echo esc_html($ts_h2_font_size); ?>;
		line-height: <?php echo esc_html($ts_h2_font_line_height); ?>;
	}
	.ts-banner.style-default h3,
	.ts-heading.style-big-center h2,
	.ts-banner.style-box-border header h3,
	.ts-shortcode.title-big-center .shortcode-heading-wrapper .heading-title,
	.ts-heading.style-center h1,
	.ts-banner.style-simple-text-4 h3,
	.h3-big{
		font-size: <?php echo esc_html($ts_heading_font_2_size); ?>;
		line-height: <?php echo esc_html($ts_heading_font_2_line_height); ?>;
	}
	h3,
	.h3,
	h2.wpb_heading,
	.ts-heading h2,
	.column-tabs .heading-tab .heading-title,
	.ts-shortcode.title-line-before .shortcode-heading-wrapper .heading-title,
	.title-center-line-before .shortcode-heading-wrapper .heading-title,
	.title-line-before .widgettitle,
	.search-no-results .blog-template .alert,
	.breadcrumb-title-wrapper .breadcrumb-title > h1,
	.ts-instagram-shortcode .heading-title,
	.ts-instagram-shortcode .widget-title-wrapper i,
	.ts-product-deals-wrapper .ts-countdown .number,
	.ts-banner.style-box-center h2,
	.ts-banner.style-box-center h3,
	.ts-feature-wrapper.border-box h4,
	.style-box-content-shadow h2,
	.vc_col-sm-12 .vertical-rounded.vertical-button-icon .widget-title,
	.ts-banner.style-simple-text-2 h3,
	body.error404 article > h2.heading-font-2,
	.style-simple-text-background-color .box-content h2,
	.style-simple-text-background-color .box-content h3,
	.vertical-button-text .widget-title,
	.ts-banner.style-box-image h3{
		font-size: <?php echo esc_html($ts_h3_font_size); ?>;
		line-height: <?php echo esc_html($ts_h3_font_line_height); ?>;
	}

	h4,
	.h4,
	h3.wpb_heading,
	.heading-shortcode > h3,
	.heading-wrapper > h2,
	.ts-heading h3,
	#customer_login h2,
	#order_review_heading,
	.theme-title .heading-title,
	.woocommerce-account div.woocommerce > h2,
	.account-content h2,
	.woocommerce-MyAccount-content > h2,
	.woocommerce-customer-details > h2,
	.woocommerce-order-details > h2,
	.woocommerce-billing-fields > h3,
	.woocommerce-additional-fields > h3,
	header.woocommerce-Address-title > h3,
	.woocommerce div.wishlist-title h2,
	.woocommerce .cross-sells > h2, 
	.woocommerce .up-sells > h2, 
	.woocommerce .related > h2,
	.cart-collaterals .cart_totals > h2,
	.ts-price-table.style-1 .table-title,
	.ts-banner h3,
	div.product p.price ins .amount,
	div.product p.price > .amount,
	.order-total .amount,
	.woocommerce div.product .single_variation_wrap p.price, 
	.woocommerce div.product .single_variation_wrap span.price,
	.step-number .feature-title,
	.ts-banner.style-box-image-shadow h2,
	.ts-banner.style-default h2,
	.ts-testimonial-wrapper.style-big blockquote .content,
	.vertical-rounded.text-light .widget-title,
	.vertical-rounded.vertical-button-icon.circle-icon .widget-title,
	.tab-heading-horizontal-center .column-tabs ul.tabs li,
	.ts-shortcode.title-center .shortcode-heading-wrapper .heading-title{
		font-size: <?php echo esc_html($ts_h4_font_size); ?>;
		line-height: <?php echo esc_html($ts_h4_font_line_height); ?>;
	}

	h5,
	.h5,
	h4.wpb_heading,
	h5.wpb_heading,
	.ts-heading h4,
	.ts-price-table.style-1 .table-price,
	.event .title-time .title,
	.ts-price-table .table-title,
	.ts-shortcode.title-default .shortcode-heading-wrapper .heading-title,
	.vc_col-sm-12 .ts-mailchimp-subscription-shortcode .widget-title-wrapper h3,
	.woocommerce .product .category-name h3,
	.woocommerce .list .product .category-name h3,
	.ts-product-brand-wrapper .item .meta-wrapper h3,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,

	.widget-title,
	body footer .widget .widgettitle,
	body footer .widget-title,
	.total .amount,
	.quantity span.amount,
	.entry-content h1.blog-title,
	.ts-tiny-cart-wrapper .total > span.total-title,
	body h4.wpb_pie_chart_heading,
	h3.wpb_heading,
	.mc4wp-form-fields > h2.title,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title a,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	html body > h1,
	.woocommerce div.product .entry-title,
	.woocommerce-account .addresses .title h3, 
	.woocommerce-account .addresses h2, 
	.woocommerce-customer-details .addresses h2,
	.ts-portfolio-wrapper .shortcode-heading-wrapper .heading-title,
	.dropdown-container .cart-number,
	.box-image h4,
	.price,
	.counter-wrapper .number,
	.products.list .product h3,
	.ts-sidebar-content > h2,
	#vertical-menu-sidebar .vertical-menu-heading,
	.ts-testimonial-wrapper blockquote .content,
	table.shop_table.cart:not(.wishlist_table) .amount,
	table.wishlist_table .product-price,
	body table.compare-list tr.price .amount,
	body table.compare-list tr.price del .amount,
	body table.compare-list tr.price td,
	.ts-blogs.item-list .entry-title,
	.title-simple .widgettitle,
	.ts-shortcode.title-simple .shortcode-heading-wrapper .heading-title,
	.tab-heading-horizontal .column-tabs .heading-tab .heading-title,
	.ts-shortcode.title-rotate .shortcode-heading-wrapper > .heading-title,
	.ts-shortcode.title-rotate .heading-tab .heading-title,
	.ts-banner.style-simple-text-2-background-color h3,
	.ts-banner.style-simple-text-2-background-color h4,
	.ts-header-intro .ts-feature-wrapper.vertical-image h4{
		font-size: <?php echo esc_html($ts_h5_font_size); ?>;
		line-height: <?php echo esc_html($ts_h5_font_line_height); ?>;
	}
	.ts-banner.style-simple-text-4 h2,
	.ts-banner.style-simple-text-2 h2,
	body footer h4.widget-title,
	.style-simple-text-background-color .box-content h4,
	h6,.h6{
		font-size: <?php echo esc_html($ts_h6_font_size); ?>;
		line-height: <?php echo esc_html($ts_h6_font_line_height); ?>;
	}
	
	@media only screen and (max-width: 1279px){
		header .logo img,
		header .logo-header img,
		.ts-sidebar-content .logo img{
			width: <?php echo absint($ts_device_logo_width); ?>px;
		}
		.header-v6 .header-middle > .container > .logo-wrapper{
			width: <?php echo absint($ts_logo_width + 30); ?>px;
		}
		h1,
		.h1,
		.ts-milestone .number{
			font-size: <?php echo esc_html($ts_h1_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h1_ipad_font_line_height); ?>;
		}

		h2,
		.h2,
		h1.wpb_heading,
		.ts-heading h1,
		.step-number .big-number,
		.ts-banner h2,
		.breadcrumb-title-wrapper .breadcrumb-title h1,
		.vc_col-sm-12 .style-vertical .widget-title-wrapper h3,
		.breadcrumb-title-wrapper.breadcrumb-v3 .breadcrumb-title > h1,
		.breadcrumb-title-wrapper.breadcrumb-v4 .breadcrumb-title > h1,
		.ts-shortcode .shortcode-heading-wrapper .heading-title,
		.ts-banner.style-box-image-shadow h3,
		.ts-banner.style-default h3,
		.vertical-button-text .widget-title,
		.ts-banner.style-simple-text h3,
		.ts-banner.style-simple-text-3 h3{
			font-size: <?php echo esc_html($ts_h2_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h2_ipad_font_line_height); ?>;
		}
		h3,
		.h3,
		h2.wpb_heading,
		.ts-heading h2,
		.heading-wrapper > h2,
		.column-tabs .heading-tab .heading-title,
		.ts-shortcode.title-line-before .shortcode-heading-wrapper .heading-title,
		.title-center-line-before .shortcode-heading-wrapper .heading-title,
		.title-line-before .widgettitle,
		.search-no-results .blog-template .alert,
		.breadcrumb-title-wrapper .breadcrumb-title > h1,
		.ts-instagram-shortcode .heading-title,
		.ts-instagram-shortcode .widget-title-wrapper i,
		.ts-product-deals-wrapper .ts-countdown .number,
		.ts-banner.style-box-center h2,
		.ts-banner.style-box-center h3,
		.ts-feature-wrapper.border-box h4,
		.style-box-content-shadow h2,
		.vc_col-sm-12 .vertical-rounded.vertical-button-icon .widget-title,
		.ts-banner.style-simple-text-2 h3,
		body.error404 article > h2.heading-font-2,
		.style-simple-text-background-color .box-content h2,
		.style-simple-text-background-color .box-content h3,
		.ts-banner.style-default h3,
		.ts-heading.style-big-center h2,
		.ts-banner.style-box-border header h3,
		.ts-shortcode.title-big-center .shortcode-heading-wrapper .heading-title,
		.ts-heading.style-center h1,
		.ts-banner.style-simple-text-4 h3,
		.h3-big{
			font-size: <?php echo esc_html($ts_h3_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h3_ipad_font_line_height); ?>;
		}

		h4,
		.h4,
		h3.wpb_heading,
		.heading-shortcode > h3,
		.ts-heading h3,
		#customer_login h2,
		#order_review_heading,
		.woocommerce-account div.woocommerce > h2,
		.account-content h2,
		.woocommerce-MyAccount-content > h2,
		.woocommerce-customer-details > h2,
		.woocommerce-order-details > h2,
		.woocommerce-billing-fields > h3,
		.woocommerce-additional-fields > h3,
		header.woocommerce-Address-title > h3,
		.woocommerce div.wishlist-title h2,
		.woocommerce .cross-sells > h2, 
		.woocommerce .up-sells > h2, 
		.woocommerce .related > h2,
		.cart-collaterals .cart_totals > h2,
		.ts-price-table.style-1 .table-title,
		.ts-banner h3,
		div.product p.price ins .amount,
		div.product p.price > .amount,
		.order-total .amount,
		.woocommerce div.product .single_variation_wrap p.price, 
		.woocommerce div.product .single_variation_wrap span.price,
		.ts-product-brand-wrapper .item .meta-wrapper h3,
		.step-number .feature-title,
		.ts-banner.style-box-image-shadow h2,
		.ts-banner.style-default h2,
		.ts-testimonial-wrapper.style-big blockquote .content,
		.vertical-rounded.text-light .widget-title,
		.tab-heading-horizontal-center .column-tabs ul.tabs li,
		.ts-shortcode.title-center .shortcode-heading-wrapper .heading-title,
		.ts-feature-wrapper.vertical-image h4{
			font-size: <?php echo esc_html($ts_h4_ipad_font_size); ?>;
			line-height: <?php echo esc_html($ts_h4_ipad_font_line_height); ?>;
		}
		
	}
	<?php if( isset($data['ts_responsive']) && $data['ts_responsive'] == 1 ): ?>
	@media only screen and (max-width: 767px){
		h1,
		.h1,
		.ts-milestone .number{
			font-size: <?php echo esc_html($ts_h1_mobile_font_size); ?>;
			line-height: <?php echo esc_html($ts_h1_mobile_font_line_height); ?>;
		}

		h2,
		.h2,
		h1.wpb_heading,
		.ts-heading h1,
		.step-number .big-number,
		.ts-banner h2,
		.breadcrumb-title-wrapper .breadcrumb-title h1,
		.vc_col-sm-12 .style-vertical .widget-title-wrapper h3,
		.breadcrumb-title-wrapper.breadcrumb-v3 .breadcrumb-title > h1,
		.breadcrumb-title-wrapper.breadcrumb-v4 .breadcrumb-title > h1,
		.ts-shortcode .shortcode-heading-wrapper .heading-title,
		.ts-banner.style-box-image-shadow h3,
		.ts-banner.style-default h3,
		.vertical-button-text .widget-title,
		.ts-banner.style-simple-text h3,
		.ts-banner.style-simple-text-3 h3{
			font-size: <?php echo esc_html($ts_h2_mobile_font_size); ?>;
			line-height: <?php echo esc_html($ts_h2_mobile_font_line_height); ?>;
		}
		h3,
		.h3,
		h2.wpb_heading,
		.ts-heading h2,
		.heading-wrapper > h2,
		.column-tabs .heading-tab .heading-title,
		.ts-shortcode.title-line-before .shortcode-heading-wrapper .heading-title,
		.title-center-line-before .shortcode-heading-wrapper .heading-title,
		.title-line-before .widgettitle,
		.search-no-results .blog-template .alert,
		.breadcrumb-title-wrapper .breadcrumb-title > h1,
		.ts-instagram-shortcode .heading-title,
		.ts-instagram-shortcode .widget-title-wrapper i,
		.ts-product-deals-wrapper .ts-countdown .number,
		.ts-banner.style-box-center h2,
		.ts-banner.style-box-center h3,
		.ts-feature-wrapper.border-box h4,
		.style-box-content-shadow h2,
		.vc_col-sm-12 .vertical-rounded.vertical-button-icon .widget-title,
		.ts-banner.style-simple-text-2 h3,
		body.error404 article > h2.heading-font-2,
		.style-simple-text-background-color .box-content h2,
		.style-simple-text-background-color .box-content h3,
		.ts-banner.style-default h3,
		.ts-heading.style-big-center h2,
		.ts-banner.style-box-border header h3,
		.ts-shortcode.title-big-center .shortcode-heading-wrapper .heading-title,
		.ts-heading.style-center h1,
		.ts-banner.style-simple-text-4 h3,
		.h3-big{
			font-size: <?php echo esc_html($ts_h3_mobile_font_size); ?>;
			line-height: <?php echo esc_html($ts_h3_mobile_font_line_height); ?>;
		}

		h4,
		.h4,
		h3.wpb_heading,
		.heading-shortcode > h3,
		.ts-heading h3,
		#customer_login h2,
		#order_review_heading,
		.woocommerce-account div.woocommerce > h2,
		.account-content h2,
		.woocommerce-MyAccount-content > h2,
		.woocommerce-customer-details > h2,
		.woocommerce-order-details > h2,
		.woocommerce-billing-fields > h3,
		.woocommerce-additional-fields > h3,
		header.woocommerce-Address-title > h3,
		.woocommerce div.wishlist-title h2,
		.woocommerce .cross-sells > h2, 
		.woocommerce .up-sells > h2, 
		.woocommerce .related > h2,
		.cart-collaterals .cart_totals > h2,
		.ts-price-table.style-1 .table-title,
		.ts-banner h3,
		div.product p.price ins .amount,
		div.product p.price > .amount,
		.order-total .amount,
		.woocommerce div.product .single_variation_wrap p.price, 
		.woocommerce div.product .single_variation_wrap span.price,
		.ts-product-brand-wrapper .item .meta-wrapper h3,
		.step-number .feature-title,
		.ts-banner.style-box-image-shadow h2,
		.ts-banner.style-default h2,
		.ts-testimonial-wrapper.style-big blockquote .content,
		.vertical-rounded.text-light .widget-title,
		.tab-heading-horizontal-center .column-tabs ul.tabs li,
		.ts-shortcode.title-center .shortcode-heading-wrapper .heading-title{
			font-size: <?php echo esc_html($ts_h4_mobile_font_size); ?>;
			line-height: <?php echo esc_html($ts_h4_mobile_font_line_height); ?>;
		}
		<?php endif; ?>
		
	}
	
	<?php update_option('ts_load_dynamic_style', 1); ?>

	/* MENU */
	.mobile-menu-wrapper .mobile-menu li a,
	.mobile-menu-wrapper nav > ul li:before,
	.mobile-menu span.ts-menu-drop-icon{
		font-size: <?php echo esc_html($ts_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
	}
	@media only screen and (max-width: 767px){
		.group-button-header > div > *,
		.header-language,
		.header-currency,
		body .wpml-ls-legacy-dropdown a.wpml-ls-item-toggle, 
		body .wpml-ls-legacy-dropdown-click a.wpml-ls-item-toggle,
		body .wpml-ls-legacy-dropdown .wpml-ls-sub-menu a,
		body .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu a,
		.header-currency ul li a,
		.wpml-ls .wpml-ls-sub-menu{
			font-size: <?php echo esc_html($ts_menu_font_size); ?>;
			line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
		}
	}
	.menu-wrapper nav > ul.menu > li > a,
	.menu-wrapper nav > ul > li > a,
	.menu-wrapper nav > ul.menu li:before{
		font-size: <?php echo esc_html($ts_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_menu_font_line_height); ?>;
	}
	.menu-wrapper nav > ul.menu ul.sub-menu > li > a,
	.menu-wrapper nav div.list-link li > a,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li > a,
	.ts-menu nav .widgettitle,
	.list-link .widgettitle,
	.widget_nav_menu .widgettitle,
	.widget_nav_menu .menu > li > a,
	.menu div.list-link li > a{
		font-size: <?php echo esc_html($ts_sub_menu_font_size); ?>;
		line-height: <?php echo esc_html($ts_sub_menu_font_line_height); ?>;
	}

	/* PRODUCT */
	h3.product-name,
	body table.compare-list tr.title td,
	.single-navigation .product-info > div > span:first-child,
	ul.wishlist_table .item-details .product-name h3{
		font-size: <?php echo esc_html($ts_product_name_font_size); ?>;
		line-height: <?php echo esc_html($ts_product_name_font_line_height); ?>;
	}
	body .products.list .product h3,
	h3.product-name,
	body table.compare-list tr.title td,
	.product-brands, 
	.woocommerce .products .product .product-categories, 
	.widget.ts-products-widget .product-categories,
	.products .product .product-sku,
	body table.compare-list tr.price .amount,
	body table.compare-list tr.price del .amount,
	body table.compare-list tr.price th,
	body table.compare-list tr.price td,
	.woocommerce .products .product .price,
	.single-navigation .product-info > div > span:first-child,
	ul.wishlist_table .item-details .product-name h3{
		line-height: <?php echo esc_html($ts_product_name_font_line_height); ?>;
	}
	/* BUTTON */
	.woocommerce a.button.added:before,
	.woocommerce button.button.added:before,
	.woocommerce input.button.added:before,
	a.ts-button,
	a.button,
	button, 
	input[type^="submit"], 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,  
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,  
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce #respond input#submit, 
	.woocommerce .wishlist_table .product-add-to-cart a,
	.shopping-cart p.buttons a,
	html body.woocommerce table.compare-list tr.add-to-cart td a:before,
	html body #yith-woocompare table.compare-list tr.add-to-cart td a:before,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	body .product-edit-new-container .dokan-btn-lg,
	body .yith-woocompare-widget a.compare,
	#ts-search-sidebar .ts-search-result-container .view-all-wrapper a,
	.ts-active-filters .widget_layered_nav_filters ul li a,
	.ts-milestone h3.subject,
	.ts-portfolio-wrapper .filter-bar li,
	.ts-shop-load-more .button,
	/* Compare */
	body #yith-woocompare table.compare-list .add-to-cart td a,
	/* Dokan */
	input[type="submit"].dokan-btn,
	a.dokan-btn,
	.dokan-btn{
		font-size: <?php echo esc_html($ts_button_font_size); ?>;
		line-height: 30px;/* default */
	}
	
	/******* 3. COLORS *******/
	
	/* Background Content Color */
	body #main,
	.quantity,
	body.dokan-store #main:before,
	#cboxLoadedContent,
	.shopping-cart-wrapper .dropdown-container:before,
	.header-top .my-account-wrapper .dropdown-container:before,
	body .header-top .wpml-ls-legacy-dropdown .wpml-ls-sub-menu:before,
	body .header-top .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu:before,
	.header-top .header-currency ul:before,
	.header-vertical .header-left .wpml-ls-legacy-dropdown .wpml-ls-sub-menu:before,
	.header-vertical .header-left .wpml-ls-legacy-dropdown-click .wpml-ls-sub-menu:before,
	.header-vertical .header-left .header-currency ul:before,
	#vertical-menu-sidebar,
	form.checkout div.create-account,
	#main > .page-container,
	body .flexslider .slides,
	body .wpb_gallery_slides.wpb_slider_nivo,
	.ts-floating-sidebar .ts-sidebar-content,
	.ts-popup-modal .popup-container,
	body #ts-search-result-container:before,
	.active-table.style-2 .group-price,
	body .select2-container--default .select2-selection--single .select2-selection__rendered,
	#yith-wcwl-popup-message,
	.image-gallery.loading:before,
	.thumbnail-wrapper .button-in.wishlist a.loading:before,
	.meta-wrapper .button-in.wishlist a.loading:before,
	.thumbnail-wrapper .button-in.compare a.loading:before,
	.meta-wrapper .button-in.compare a.loading:before,
	.woocommerce .add_to_wishlist.loading:before,
	.woocommerce .meta-background .product-wrapper .meta-wrapper,
	.ts-blogs-wrapper.meta-background .entry-content,
	.dataTables_wrapper,
	body > .compare-list,
	.header-v3 .header-bottom:before,
	.single-navigation > div .product-info:before,
	.woocommerce .woocommerce-ordering .orderby ul:before,
	.product-per-page-form ul.perpage ul:before,
	.single-navigation .product-info:before,
	.fashion-slide-bg:before,
	.vc_row .top-filter-widget-area .widget-container > *:not(.widget-title-wrapper),
	#primary > .top-filter-widget-area .widget-container > *:not(.widget-title-wrapper),
	.archive.ajax-pagination .woocommerce > .products.loading:after,

	.dropdown-container ul.cart_list li.loading:before,
	.thumbnail-wrapper .button-in.wishlist > a.loading:before,
	.meta-wrapper .button-in.wishlist > a.loading:before,
	.woocommerce a.button.loading:before,
	.woocommerce button.button.loading:before,
	.woocommerce input.button.loading:before,
	div.blockUI.blockOverlay:before,
	.woocommerce .blockUI.blockOverlay:before,
	.ts-menu-widget nav.vertical-menu,
	.ts-masonry.ts-blogs .article-content,
	.widget-container.ts-menu-widget,
	.google-map-container .information,
	.woocommerce .wishlist_table .product-add-to-cart a.loading:before{
		background-color: <?php echo esc_html($ts_main_content_background_color); ?>;
	}
	body .prev-button,
	body .next-button{
		background-color: <?php echo esc_html($ts_main_content_background_color); ?> !important;
	}

	/* BODY COLOR */
	.ts-tiny-cart-wrapper ul li div.blockUI.blockOverlay:after,
	.widget_shopping_cart ul li div.blockUI.blockOverlay:after,
	.dropdown-container ul.cart_list li.loading:after,
	.thumbnail-wrapper .button-in.wishlist > a.loading,
	.meta-wrapper .button-in.wishlist > a.loading:after,
	.thumbnail-wrapper .button-in a.loading div.blockUI.blockOverlay:after,
	.meta-wrapper .button-in a.loading div.blockUI.blockOverlay:after,
	.woocommerce a.button.loading:after,
	.woocommerce button.button.loading:after,
	.woocommerce input.button.loading:after,
	.woocommerce .product-wrapper .button-in div.blockUI.blockOverlay:after,
	.woocommerce .summary .yith-wcwl-add-to-wishlist  div.blockUI.blockOverlay:after,
	.woocommerce .wishlist_table .product-add-to-cart a.loading:after,

	body,
	.woocommerce .woocommerce-ordering ul li a, 
	.product-per-page-form ul.perpage ul li a,
	.woocommerce-account-fields > p > label,
	.woocommerce #payment ul.payment_methods > li > label,
	.woocommerce div.product p.stock span,
	.wishlist_table tr td.product-stock-status span,
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	body.wpb-js-composer .vc_toggle .vc_toggle_icon:before,
	.woocommerce div.product .summary .woocommerce-product-details__short-description,
	.cats-link,
	.tags-link,
	.brands-link,
	.cats-link a,
	.tags-link a,
	.brands-link a,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a,
	/* Widget */
	.comment_list_widget .comment-body,
	.woocommerce table.shop_attributes td,
	.woocommerce table.shop_attributes th,
	.woocommerce p.stars a,
	.woocommerce-product-rating .woocommerce-review-link,
	table tfoot th,
	.woocommerce-checkout #payment div.payment_box,
	body .pp_nav .currentTextHolder,
	.dashboard-widget.products ul li a, 
	.single-portfolio .portfolio-info a,
	.woocommerce div.product p.availability.stock label,
	.brands-link span:not(.brand-links),
	.cats-link span:not(.cat-links),
	.tags-link span:not(.tag-links),
	.ts-social-sharing span,
	.list-cats li a,
	.product-categories .count,
	.ts-team-members .member-social a,
	.single-portfolio .single-navigation > div a,
	.single-portfolio .single-navigation > a,
	.horizontal-box-border .feature-content > a,
	.woocommerce-product-rating .woocommerce-review-link,
	.dataTables_wrapper,
	.woocommerce ul#shipping_method li label,
	#add_payment_method table.cart td.actions .coupon .input-text,
	.woocommerce-cart table.cart td.actions .coupon .input-text,
	.woocommerce-checkout table.cart td.actions .coupon .input-text,
	.tagcloud a,
	.ts-social-sharing li a,
	.comment-detail .comment-meta-bottom a,
	div.product .ts-product-video-button, 
	div.product .ts-product-360-button, 
	.quantity .number-button:before,
	.quantity .number-button:after,
	.ts-tiny-cart-wrapper .subtotal > span:first-child,
	.tab-heading-horizontal-center .column-tabs ul.tabs li,
	.tab-heading-default .column-tabs ul.tabs li,
	.ts-shortcode.nav-top .owl-nav > div,
	.ts-product-attribute > div.option.text a,
	.list-categories li > a,
	body a.button-text.primary-color:hover,
	body .button-text.primary-color a:hover,
	p.lost_password a, 
	.my-account-wrapper .forgot-pass a, 
	body .my-account-wrapper .form-content a.sign-up,
	.ts-product-in-category-tab-wrapper.tab-heading-horizontal-italic ul.tabs li,
	.ts-testimonial-wrapper.style-default blockquote,
	.yith-wcwl-share ul li a{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.ts-shortcode.nav-top .owl-nav > div.owl-prev:after{
		border-color: <?php echo esc_html($ts_text_color); ?>;
	}
	/* Quick view */
	#ts-search-popup .ts-button-close{
		color: <?php echo esc_html($ts_text_color); ?> !important;
	}

	select,
	textarea,
	html input[type="search"],
	html input[type="text"],
	html input[type="email"],
	html input[type="password"],
	html input[type="date"],
	html input[type="number"],
	html input[type="tel"],
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	body .select2-container--default .select2-selection--single,
	body .select2-dropdown,
	body .select2-container--default .select2-selection--single,
	body .select2-container--default .select2-search--dropdown .select2-search__field,
	.woocommerce form .form-row.woocommerce-validated .select2-container,
	.woocommerce form .form-row.woocommerce-validated input.input-text,
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--default .select2-selection--multiple{
		color: <?php echo esc_html($ts_text_color); ?>;
		border-color: <?php echo esc_html($ts_input_border_color); ?>;
	}
	body .select2-container--default .select2-selection--single .select2-selection__rendered{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	html input[type="search"]:hover,
	html input[type="text"]:hover,
	html input[type="email"]:hover,
	html input[type="password"]:hover,
	html input[type="date"],
	html input[type="number"]:hover,
	html input[type="tel"]:hover,
	html textarea:hover,
	html input[type="search"]:focus,
	html input[type="text"]:focus,
	html input[type="email"]:focus,
	html input[type="password"]:focus,
	html input[type="date"]:focus,
	html input[type="number"]:focus,
	html input[type="tel"]:focus,
	input:-webkit-autofill,
	textarea:-webkit-autofill,
	select:-webkit-autofill,
	html textarea:focus,
	.woocommerce form .form-row textarea:hover,
	.woocommerce form .form-row textarea:focus,
	body .select2-container--default.select2-container--focus .select2-selection--multiple,
	.woocommerce form .form-row.woocommerce-validated .select2-container,
	.woocommerce form .form-row.woocommerce-validated input.input-text,
	.woocommerce form .form-row.woocommerce-validated select,
	body .select2-container--open .select2-selection--single,
	body .select2-container--open .select2-dropdown--below{
		color: <?php echo esc_html($ts_input_text_hover); ?>;
		border-color: <?php echo esc_html($ts_input_border_color_hover); ?>;
	}
	.woocommerce .woocommerce-ordering ul.orderby:hover,
	.product-per-page-form ul.perpage:hover{
		border-color: <?php echo esc_html($ts_input_border_color_hover); ?>;
	}
	body .select2-container--open .select2-selection--single .select2-selection__rendered{
		color: <?php echo esc_html($ts_input_text_hover); ?>;
	}

	/* HEADING COLOR */

	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	.woocommerce > form > fieldset legend{
		color: <?php echo esc_html($ts_heading_color); ?>;
	}

	/* LINK COLOR */

	a,
	blockquote:before,
	blockquote span.author a,
	span.author a{
		color: <?php echo esc_html($ts_link_color); ?>;
	}
	a:hover,
	a:active,
	body a.button-text:hover,
	body .button-text a:hover,
	.single-navigation-1 a:hover,
	.single-navigation-2 a:hover,
	.horizontal-box-border .feature-content > a:hover,
	.comments-area .reply a:hover,
	/* Portfolio */
	.portfolio-inner .item h3 a:hover,
	.portfolio-inner .item .cats-portfolio a:hover,
	.list-posts .heading-title a:hover,
	.blogs .heading-title a:hover,
	.ts-testimonial-wrapper.text-light .ts-testimonial-wrapper h4.name a:hover,
	.ts-twitter-slider.text-light .twitter-content h4.name > a:hover,
	blockquote .author-role .author a:hover,
	.widget_recent_entries ul li > a:hover,
	.widget_recent_comments ul li > a:hover,
	.widget_rss .rsswidget:hover,
	body .style-3 .mailchimp-subscription.text-light button.button:hover,
	label a:hover,
	.widget-container ul > li a:hover,
	.dokan-widget-area .widget ul li > a:hover,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li.active a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li:hover a,
	.dokan-dashboard .dokan-dashboard-content li.active > a,
	.widget_nav_menu > div > ul > li > a:hover,
	.widget-container ul ul li > a:hover,
	.widget-container ul li .product-categories a:hover,
	.widget.ts-products-widget .product-categories a:hover,
	.woocommerce .product-filter-by-brand ul li label:hover,
	.ts-product-categories-widget ul.product-categories li span.icon-toggle:hover,
	.ts-product-categories-widget ul.product-categories li.current > a,
	.ts-product-categories-widget ul.product-categories li > a:hover,
	.widget_categories > ul li.current-cat > a,
	.widget_categories > ul li a:hover,
	.shipping-calculator-button:hover,
	.widget-container .post_list_widget > li a.post-title:hover,
	.single-portfolio .portfolio-info a:hover,
	.ts-shortcode.nav-top .owl-nav > div:hover,
	/* Product search */
	.dashboard-widget.products ul li a:hover,
	.add-to-cart-popup-content .product-meta a:hover,
	.ts-list-of-product-categories-wrapper .button-link:hover,
	.ts-list-of-product-categories-wrapper ul li a:hover,

	.ts-product-attribute > div.option.text.selected a,
	.list-categories li > a:hover,
	.ts-product-attribute > div.option.text a:hover,

	.comment-detail .author a:hover,
	.feature-title a:hover,
	.vertical-button-icon .subscribe-email .button:hover, 
	.woocommerce .vertical-button-icon .subscribe-email .button:hover, 
	.product .product-brands a:hover,
	.woocommerce .products .product .product-categories a:hover,
	.woocommerce .widget-container il li .product-categories a:hover,
	.widget-container ul li .product-categories a:hover,
	.widget.ts-products-widget .product-categories a:hover,
	.widget-container ul.product_list_widget li > a:hover,
	.widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
	.widget.ts-products-widget .ts-wg-meta > a:hover,
	.woocommerce ul.product_list_widget .ts-wg-meta > a:hover,
	h3.product-name > a:hover,
	h3.product-name:hover,
	.product-name a:hover,
	.ts-search-result-container ul li a:hover,
	.group_table a:hover,
	.group-button-header > div > a:hover,
	.group-button-header .my-wishlist-wrapper a:hover, 
	.group-button-header .header-currency a:hover, 
	.group-button-header .header-language a:hover, 
	.group-button-header .my-account-wrapper a:hover,
	.group-button-header .wpml-ls-legacy-dropdown a:hover, 
	.group-button-header .wpml-ls-legacy-dropdown a:focus, 
	.group-button-header .wpml-ls-legacy-dropdown-click a:hover, 
	.group-button-header .wpml-ls-legacy-dropdown-click a:focus, 
	.group-button-header .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover > a,
	.group-button-header .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a,
	.yith-wcwl-share ul li a:hover{
		color: <?php echo esc_html($ts_link_color_hover); ?>;
	}

	/* TEXT BOLD COLOR */
	dt,
	table thead th,
	.woocommerce table.shop_table th,
	label ,
	p > label,
	fieldset div > label,
	blockquote,
	.wpcf7 p,
	.primary-text,
	/* Widget */
	.widget_recent_entries ul li > a,
	.widget_recent_comments ul li > a,
	.widget_rss .rsswidget,
	.widget_rss cite,
	table#wp-calendar thead th,
	h4.heading-title > a,
	.ts-heading h1,
	.ts-heading h2,
	.ts-heading h3,
	.ts-heading h4,
	.avatar-name a,
	blockquote .author-role .author a,
	h1 > a,
	h2 > a,
	h3 > a,
	h4 > a,
	h5 > a,
	h6 > a,
	.comment-detail .author a,
	.woocommerce div.product form.cart .quantity span,
	.secondary-color,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
	.ts-countdown .counter-wrapper > div .ref-wrapper,
	.ts-product-attribute > div a,
	.availability-bar > span,
	.ts-team-members h3,
	.ts-sidebar-content h4.title,
	p.author-role > span,
	.ts-price-table .table-description,
	body a.button-text,
	body .button-text a,
	.single-navigation-1 a,
	.single-navigation-2 a,
	.ts-search-result-container > p,
	.single-portfolio .single-navigation > div a:first-child,
	.title-contact,
	.ts-price-table.style-4 header *,
	.ts-price-table.style-2 header *,
	.woocommerce .button.button-border,
	.button.button-border,
	.ts-milestone .number,
	.widget-title,
	.ts-product-categories-widget ul.product-categories li > a,
	.ts-product-categories-widget ul.product-categories li span.icon-toggle,
	.widget_categories > ul li > a,
	.ts-countdown.text-light .counter-wrapper > div,
	.total .total-title,
	.cart_list .icon,
	.woocommerce div.product .entry-title,
	/* Portfolio */
	.widget-container .post_list_widget > li a.post-title,
	.entry-author .author-info .role,
	.vc_progress_bar .vc_single_bar .vc_label,
	.vc_toggle .vc_toggle_icon:before,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.woocommerce p.stars a:hover,
	.woocommerce-cart .cart-collaterals .cart_totals table td,
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.shipping-calculator-button,
	.wp-caption p.wp-caption-text,
	#order_review_heading,
	.woocommerce form.login,
	.woocommerce form.register,
	.woocommerce .checkout #order_review table th,
	.mailchimp-subscription .widgettitle,
	.dashboard-widget.products ul li a,
	.row-heading-tabs ul li,
	.row-heading-tabs ul li a,
	.heading-title,
	.woocommerce .widget_layered_nav ul li a,
	.woocommerce .product-filter-by-brand ul li label,
	.woocommerce table.shop_table.order_details tfoot th,
	.woocommerce table.shop_table.customer_details th,
	.woocommerce #reviews #reply-title,
	.widget-title-wrapper a.block-control,
	fieldset legend,
	.woocommerce ul.order_details li strong,
	.ts-list-of-product-categories-wrapper ul li a,
	.column-tabs ul.tabs li,
	/* Portfolio */
	.portfolio-info > span:first-child,
	.single-portfolio .social-sharing > span,
	.single-portfolio .info-content .entry-title,
	.vc_pie_chart .vc_pie_chart_value,
	.quantity .number-button:hover:before,
	.quantity .number-button:hover:after,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info a,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info:before,
	.vertical-button-icon .subscribe-email .button, 
	.woocommerce .vertical-button-icon .subscribe-email .button, 
	.ts-blogs .button-readmore-button-text,
	.product-per-page-form ul.perpage ul li a.current,
	.woocommerce .woocommerce-ordering .orderby li a.current,
	.woocommerce .woocommerce-ordering ul.orderby:hover .orderby-current,
	.product-per-page-form ul.perpage:hover > li span,
	.ts-list-of-product-categories-wrapper .button-link,
	.widget-container.ts-social-icons ul li > a,
	.entry-meta-top span,
	.widget-container ul li > a,
	.dokan-widget-area .widget ul li > a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li a,
	.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li.active > a,
	.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li > a:hover,
	span.author a:hover,
	.group-button-header > div > a:hover,
	.group-button-header .my-wishlist-wrapper a, 
	.group-button-header .header-currency a, 
	.group-button-header .header-language a, 
	.group-button-header .my-account-wrapper a,
	.ts-tiny-cart-wrapper .price .amount,
	.ts-product-in-category-tab-wrapper.tab-heading-horizontal-italic ul.tabs li:hover,
	.ts-product-in-category-tab-wrapper.tab-heading-horizontal-italic ul.tabs li.current,
	.woocommerce div.product .summary .yith-wcwl-add-to-wishlist a,
	.woocommerce div.product .summary a.compare,
	/* Compare table */
	body table.compare-list th,
	body table.compare-list tr.title th,
	body table.compare-list tr.image th,
	body table.compare-list tr.price th{
		color: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	.cart_list li .cart-item-wrapper a.remove, 
	.woocommerce .widget_shopping_cart .cart_list li a.remove, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove,
	body table.compare-list tr.remove td > a,
	.woocommerce table.shop_table .product-remove a{
		color: <?php echo esc_html($ts_text_bold_color); ?> !important;
	}
	.product-wrapper .color-swatch > div:before,
	.ts-image-box.style-horizontal .see-more:after,
	#customer_login h2:after,
	.woocommerce .checkout #order_review,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
		border-color: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	.list-posts article.post_format-post-format-quote blockquote{
		color: <?php echo esc_html($ts_main_content_background_color); ?>;
	}
	.list-posts article.post_format-post-format-quote,
	.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range:before{
		background-color: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .product figure .color-image.active span:before,
	.woocommerce .product figure .color.active span:before{
		border-color: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	/* Slider */
	.owl-dots > div > span, body .flex-control-paging li a, 
	body .theme-default .nivo-controlNav a, 
	body .theme-default .nivo-controlNav a.active{
		border-color: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	.owl-dots > div.active > span:before,
	.owl-dots > div:hover > span:before,
	.owl-dots > div.active > span,
	.owl-dots > div:hover > span,
	body .theme-default .nivo-controlNav a.active,
	body .theme-default .nivo-controlNav a.active:before,
	body .theme-default .nivo-controlNav a.hover:before{
		background: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	.product-filter-by-color ul li,
	.ts-product-attribute > div.color,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item a,
	.woocommerce table.cart td.actions .coupon .button,
	.cart_totals .wc-proceed-to-checkout a.button.continue-shopping:hover,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.portfolio-inner .icon-group a,
	.single-portfolio .ic-like,
	.ts-product-attribute > div:not(.color) a,
	.woocommerce div.product form.cart .variations select,
	body #yith-woocompare table.compare-list .add-to-cart td a,
	.cart_totals .wc-proceed-to-checkout a.continue-shopping.button:hover,
	.ts-tiny-cart-wrapper .dropdown-footer .button.view-cart:hover,
	#ts-add-to-cart-popup-modal .action .button:hover,
	.woocommerce.widget_shopping_cart .buttons .button:hover,
	.woocommerce .widget_shopping_cart .buttons .button:hover{
		background-color:transparent;
		color: <?php echo esc_html($ts_text_bold_color); ?>;
		border-color: <?php echo esc_html($ts_text_bold_color); ?>;
	}
	/* Button Dots Slider */
	.owl-nav > div,
	.prev-button,
	.next-button,
	div.product .single-navigation > div >  a,
	.nav-bottom .owl-nav:before,
	.nav-bottom .owl-nav:after{
		color: <?php echo esc_html($ts_nav_text_color); ?>;
		background: <?php echo esc_html($ts_nav_background_color); ?>;
	}
	div.product .single-navigation > div >  a:hover,
	.owl-nav > div:hover,
	.prev-button:hover,
	.next-button:hover,
	.single-portfolio .thumbnail .owl-nav > div:hover{
		background: <?php echo esc_html($ts_nav_background_hover); ?>;
		color: <?php echo esc_html($ts_nav_text_hover); ?>;
	}

	/* PRIMARY COLOR */
	html body > h1 a.close,
	.header-v3 header .menu-wrapper nav > ul.menu > li > a{
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
	}

	body .select2-container--default .select2-results__option[aria-selected=true],
	body .select2-container--default .select2-results__option--highlighted[aria-selected],
	.order-number a,
	body a.button-text.primary-color,
	body .button-text.primary-color a,
	.ol-style.icon-primary li:before,
	.ul-style.icon-primary > li:before,
	.ts-dropcap,
	.ts-shortcode.title-default .shortcode-heading-wrapper .heading-title,
	.account-content h2,
	.woocommerce-MyAccount-content > h2,
	.woocommerce-customer-details > h2,
	.woocommerce-order-details > h2,
	.woocommerce-additional-fields > h3,
	header.woocommerce-Address-title > h3,
	.woocommerce div.wishlist-title h2,
	footer#colophon .title-primary .mailchimp-subscription .widget-title,
	.title-primary .mailchimp-subscription .widget-title,
	.ts-countdown .counter-wrapper > div .number-wrapper,
	.vc_single_bar .vc_label_units,
	body.error404 article > h1.heading-font-1,
	.woocommerce .vertical-button-text.text-light button.button,
	.vertical-button-text.text-light button.button,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info a,
	.ts-shortcode.title-default .shortcode-heading-wrapper .heading-title,
	.widget_recent_entries .post-date,
	.entry-meta-top > span:before,
	.entry-meta-top span.date-time,
	.primary-color,
	.tab-heading-horizontal-center .column-tabs ul.tabs li:hover,
	.tab-heading-horizontal-center .column-tabs ul.tabs li.current,
	.tab-heading-default .column-tabs ul.tabs li:hover,
	.tab-heading-default .column-tabs ul.tabs li.current,
	p.lost_password a:hover, 
	.my-account-wrapper .forgot-pass a:hover, 
	body .my-account-wrapper .form-content a.sign-up:hover,
	span.comment-author-link a,
	.style-2 .ts-testimonial-wrapper .content:before,
	.column-tabs ul.tabs li:hover,
	.column-tabs ul.tabs li.current,
	.ts-product-category-wrapper .category-name h3 > a:hover,
	body.wpb-js-composer .vc_toggle_default .vc_toggle_title:hover h4,
	h1 > a:hover,
	h2 > a:hover,
	h3 > a:hover,
	h4 > a:hover,
	h5 > a:hover,
	h6 > a:hover,
	.single-portfolio .single-navigation > a:hover,
	.single-portfolio .single-navigation > div a:hover,
	.ts-header-social-icons li a:hover,
	.ts-floating-sidebar .close:hover i,
	body.wpb-js-composer .vc_toggle_default.vc_toggle_active .vc_toggle_title h4,
	body.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-title > a:focus,
	body.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel-title > a:hover,
	body.wpb-js-composer .vc_tta.vc_tta-accordion .vc_active .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta-tabs:not(.vc_tta-style-2) .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_tta-tabs:not(.vc_tta-style-2) .vc_tta-tab > a:hover,
	.woocommerce .woocommerce-ordering ul li a:hover,
	.product-per-page-form ul.perpage ul li a:hover,
	.tagcloud a:hover,
	ul.product_list_widget li .product-categories a:hover,
	.brands-link a:hover,
	.cats-link a:hover,
	.tags-link a:hover,
	.woocommerce-product-rating .woocommerce-review-link:hover,
	.woocommerce-checkout #payment .payment_method_paypal .about_paypal:hover,
	p.lost_password a:hover,
	.product .product-brands a:hover,
	.woocommerce .products .product .product-categories a:hover,
	.ts-sidebar-content .close:hover,
	.wpml-ls-legacy-dropdown a:hover, 
	.wpml-ls-legacy-dropdown a:focus, 
	.wpml-ls-legacy-dropdown-click a:hover, 
	.wpml-ls-legacy-dropdown-click a:focus, 
	.wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover > a,
	.wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a:hover,
	.woocommerce div.product .summary .yith-wcwl-add-to-wishlist a:hover,
	.woocommerce div.product .summary a.compare:hover,
	.ts-testimonial-wrapper.style-default blockquote .content:before,
	/* Social */
	.ts-social-icons .social-icons li a:hover,
	footer#colophon .ts-social-icons .social-icons li a:hover,
	.ts-social-icons .social-icons.style-circle-multicolor li.custom a:hover,
	footer#colophon .ts-social-icons .social-icons.style-circle-multicolor li.custom a:hover,
	.ts-social-icons .style-vertical-multicolor li.custom a:hover i,
	.ts-social-icons .social-icons:not(.style-vertical) li.custom .ts-tooltip:before{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}
	header .header-template .my-account-wrapper .forgot-pass a:hover,
	body .my-account-wrapper .form-content a.sign-up:hover,
	body .pp_nav .pp_play:hover:before,
	body .pp_nav .pp_pause:hover:before,
	body .pp_arrow_previous:hover:before,
	body .pp_arrow_next:hover:before,
	/* Quick view hover */
	#ts-search-popup .ts-button-close:hover{
		color: <?php echo esc_html($ts_primary_color); ?> !important;
	}
	/* Cart */
	.title-line-before .widgettitle:after,
	.ts-shortcode.title-line-before .shortcode-heading-wrapper .heading-title:after,
	.style-line-before .heading:after,
	.style-center-line-before .heading:after,
	.woocommerce form.checkout_coupon,

	body.wpb-js-composer .vc_tta-accordion.vc_tta-style-1 .vc_tta-panel-title > a:before,
	body.wpb-js-composer .vc_tta-tabs.vc_tta-style-3 .vc_tta-tab.vc_active > a:before,
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-style-3.vc_tta-tabs-position-top .vc_tta-tab.vc_active > a:before,
	body.wpb-js-composer .vc_tta-tabs.vc_tta-style-4 .vc_tta-tab > a:before,
	body.wpb-js-composer .vc_tta-tabs.vc_tta-style-4 .vc_tta-tab.vc_active > a:before,
	body.wpb-js-composer .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-style-4.vc_tta-tabs-position-top .vc_tta-tab.vc_active > a:before,
	.woocommerce div.product .woocommerce-tabs ul.tabs li > a:before,
	.wpb-js-composer .vc_tta.vc_tta-style-4 .vc_tta-panel:before,

	.woocommerce .checkout-login-coupon-wrapper .checkout_coupon,
	.woocommerce .cart-collaterals .cart_totals,
	.widget-container:before,
	.menu-wrapper > .ic-close-menu-button:hover,
	.woocommerce div.product div.thumbnails li:hover a img,
	.mobile-menu-wrapper nav > ul > li > ul,
	.style-2 .ts-testimonial-wrapper .content:after,
	.horizontal-box-border .feature-content > a:after,
	.shortcode-heading-wrapper .heading-title:after,
	.column-tabs .heading-tab .heading-title:after,
	.ts-heading .heading:after,
	.woocommerce ul.product_list_widget li > a.ts-wg-thumbnail:before, 
	.ts-shortcode.tab-heading-horizontal .column-tabs ul.tabs li:before,
	.tab-heading-default .column-tabs ul.tabs li:before,
	.tab-heading-horizontal-center .column-tabs ul.tabs li:before,
	.ts-shop-result-count > span.bar > span,
	.ts-image-box.style-horizontal .see-more:hover:before,
	.style-border-bottom .heading,
	/* Social */
	.ts-social-icons .style-circle-multicolor li.custom a:hover,
	.ts-social-icons .style-vertical-multicolor li.custom a:hover i,
	.ts-social-icons .social-icons:not(.style-vertical) li.custom .ts-tooltip:before{
		border-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.heading-bg-primary,
	.bg-primary,
	.ts-social-icons .social-icons:not(.style-vertical) li.custom .ts-tooltip,
	body .custom .tp-bullet:hover, 
	body .custom .tp-bullet.selected,
	.portfolio-inner .item figure span.bg-hover,
	.style-2 .product-category:hover > a:before,
	.image-gallery > div a:before,
	.ts-blog-videos-wrapper .blogs > article:first-child .thumbnail-content:before,
	/* Header */
	.ts-tiny-cart-wrapper .ic-cart:after{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	.shopping-cart-wrapper .cart-number,
	.widget_calendar #today,
	.ts-dropcap.style-2,
	.ts-shortcode.title-background-primary .shortcode-heading-wrapper .heading-title,
	.ts-menu-widget .widget-title-wrapper h3,
	.header-v3 header .menu-wrapper nav > ul.menu > li,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active a, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a:hover, 
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a:hover,
	
	/* Social */
	.ts-team-members .member-social a:hover,
	body .ts-social-icons .social-icons.style-circle-opacity li.custom a:hover,
	body footer#colophon .ts-social-icons .social-icons.style-circle-opacity li.custom a:hover,
	body .ts-social-icons .social-icons.style-square li.custom a:hover,
	body footer#colophon .ts-social-icons .social-icons.style-square li.custom a:hover,
	body .ts-social-icons .social-icons.style-circle li.custom a:hover,
	body footer#colophon .ts-social-icons .social-icons.style-circle li.custom a:hover,
	body .ts-social-icons .social-icons.style-circle-multicolor li.custom a,
	body footer#colophon .ts-social-icons .social-icons.style-circle-multicolor li.custom a,
	body .ts-social-icons .style-vertical-multicolor li.custom a i,
	body .ts-social-icons .social-icons:not(.style-vertical) li.custom .ts-tooltip{
		background-color: <?php echo esc_html($ts_primary_color); ?>;
		color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
		border-color: <?php echo esc_html($ts_primary_color); ?>;
	}
	<?php if( $ts_primary_color == $ts_bottom_header_background_color ): ?>
	.shopping-cart-wrapper .cart-number{
		background-color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;
		color: <?php echo esc_html($ts_primary_color); ?>;
		border-color: <?php echo esc_html($ts_text_color_in_bg_primary); ?>;	
	}
	<?php endif; ?>


	/* BORDER COLOR */
	*,
	*:before,
	*:after,
	.image-border .add-to-cart-popup-content .product-image img,
	.image-border .thumbnail-wrapper img,
	body #yith-woocompare table.compare-list tbody th,
	body #yith-woocompare table.compare-list tbody td,
	.vertical-icon-square > a,
	.woocommerce .button.button-border,
	.button.button-border,
	.woocommerce table.shop_table,
	.woocommerce-page table.shop_table,
	.woocommerce ul.order_details li,
	.woocommerce div.product form.cart .group_table td,
	#add_payment_method table.cart td.actions .coupon .input-text,
	.woocommerce-cart table.cart td.actions .coupon .input-text,
	.woocommerce-checkout table.cart td.actions .coupon .input-text,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tab a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_toggle_default .vc_toggle_content,
	body.wpb-js-composer .vc_toggle_size_md.vc_toggle_default .vc_toggle_content,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel-body,
	body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a,
	.widget.ts-products-widget li > a.ts-wg-thumbnail,
	.woocommerce ul.product_list_widget li > a.ts-wg-thumbnail,
	.dokan-dashboard .dokan-dashboard-content .edit-account fieldset,
	body > table.compare-list,
	.woocommerce div.product .summary .yith-wcwl-add-to-wishlist a,
	.woocommerce div.product .summary a.compare,
	.woocommerce table.my_account_orders tbody tr:first-child td:first-child,
	body .woocommerce table.my_account_orders td.order-actions,
	body.wpb-js-composer .vc_separator.border-color .vc_sep_line,
	.woocommerce table.shop_attributes th,
	.woocommerce table.shop_attributes td,
	.woocommerce .widget_layered_nav ul,
	.woocommerce table.shop_table,
	.woocommerce table.shop_table td,
	body .wpb_flexslider.flexslider,
	.woocommerce table.wishlist_table tbody td,
	.widget_product_search,
	.widget_search,
	.widget_display_search,
	.widget-container.widget_calendar,
	.woocommerce p.stars a.star-1,
	.woocommerce p.stars a.star-2,
	.woocommerce p.stars a.star-3,
	.woocommerce p.stars a.star-4,
	.woocommerce p.stars a.star-5,
	.woocommerce #reviews #comments ol.commentlist li .comment-text,
	.woocommerce table.shop_attributes,
	.woocommerce #reviews #comments ol.commentlist li ,
	.dataTables_wrapper,
	.woocommerce div.product div.thumbnails li a img,
	.woocommerce div.product div.images-thumbnails img,
	.woocommerce ul.cart_list li img,
	.woocommerce ul.product_list_widget li img{
		border-color: <?php echo esc_html($ts_border_color); ?>;
	}
	.ts-product-attribute > div:before{
		background-color: <?php echo esc_html($ts_border_color); ?>;
		border-color: <?php echo esc_html($ts_border_color); ?>;
	}
	.availability-bar .progress-bar{
		background-color: <?php echo esc_html($ts_border_color); ?>;
	}

	/* BUTTON */
	a.button,
	button, 
	input[type^="submit"], 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,  
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt,  
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce #respond input#submit, 
	.shopping-cart p.buttons a,
	.threesixty .nav_bar a,
	#to-top a,
	.woocommerce .wishlist_table .product-add-to-cart a,

	.woocommerce a.button.alt.disabled,
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled,
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled],
	.woocommerce a.button.alt:disabled[disabled]:hover,
	.woocommerce button.button.alt.disabled,
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt:disabled,
	.woocommerce button.button.alt:disabled:hover,
	.woocommerce button.button.alt:disabled[disabled],
	.woocommerce button.button.alt:disabled[disabled]:hover,
	.woocommerce input.button.alt.disabled,
	.woocommerce input.button.alt.disabled:hover,
	.woocommerce input.button.alt:disabled,
	.woocommerce input.button.alt:disabled:hover,
	.woocommerce input.button.alt:disabled[disabled],
	.woocommerce input.button.alt:disabled[disabled]:hover,
	.woocommerce div.product form.cart .button:hover,

	.ts-popup-modal span.close,
	body #cboxClose,
	body .pp_pic_holder a.pp_close,
	body .pp_pic_holder a.pp_expand,
	body .pp_pic_holder a.pp_contract,
	.ts-portfolio-wrapper .filter-bar li,
	body .yith-woocompare-widget a.compare,
	.woocommerce .button.button-border:hover,
	.button.button-border:hover,
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce div.product form.cart table .button:hover,
	body.wpb-js-composer .vc_tta-accordion.vc_tta-style-3 .vc_tta-panel .vc_tta-controls-icon,
	#ts-search-sidebar .ts-search-result-container .view-all-wrapper a:hover,
	.ts-active-filters .widget_layered_nav_filters ul li a,
	.ts-shop-load-more .button,
	/* Pagination */
	.dokan-pagination-container .dokan-pagination li a,
	.woocommerce nav.woocommerce-pagination ul li a,
	.woocommerce nav.woocommerce-pagination ul li span,
	.ts-pagination ul li a,
	.gridlist-toggle a,
	.shopping-cart-wrapper.cart-primary a > .ic-cart,
	.woocommerce .button.button-border-secondary:hover,
	.button.button-border-secondary:hover,
	.portfolio-inner .icon-group a:hover,
	.single-portfolio .ic-like:hover,
	.woocommerce .woocommerce-form-register .button:hover{
		background-color: <?php echo esc_html($ts_button_background_color); ?>;
		color: <?php echo esc_html($ts_button_text_color); ?>;
	}
	.vertical-button-icon.circle-icon .subscribe-email .button{
		background-color: <?php echo esc_html($ts_button_background_color); ?> !important;
		color: <?php echo esc_html($ts_button_text_color); ?> !important;
	}
	.cart_totals .wc-proceed-to-checkout a.continue-shopping.button,
	.ts-tiny-cart-wrapper .dropdown-footer .button.view-cart,
	#ts-add-to-cart-popup-modal .action .button,
	.woocommerce.widget_shopping_cart .buttons .button,
	.woocommerce .widget_shopping_cart .buttons .button{
		background-color:<?php echo esc_html($ts_button_background_color); ?>;
		color: <?php echo esc_html($ts_button_text_color); ?>;
		border-color: <?php echo esc_html($ts_button_background_color); ?>;
	}
	html body > h1,
	.quantity .minus:hover,
	.quantity .plus:hover,
	.quantity .minus:focus,
	.quantity .plus:focus,
	.woocommerce-account .woocommerce-MyAccount-navigation li:hover a,
	.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover a,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a,
	.ts-product-attribute > div:not(.color):hover a,
	.ts-product-attribute > div:not(.color).selected a,
	body #yith-woocompare table.compare-list .add-to-cart td a:hover,

	.woocommerce table.cart td.actions .coupon .button:hover,
	.horizontal-button-text .subscribe-email .button,
	.woocommerce .horizontal-button-text .subscribe-email .button{
		background-color: <?php echo esc_html($ts_button_background_color); ?>;
		color: <?php echo esc_html($ts_button_text_color); ?>;
		border-color: <?php echo esc_html($ts_button_background_color); ?>;
	}
	#to-top a:hover,
	a.button:hover,
	button:hover, 
	input[type^="submit"]:hover, 
	.woocommerce a.button:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover,  
	.woocommerce a.button.alt:hover, 
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover,  
	.woocommerce #respond input#submit:hover, 
	.woocommerce form.register .button,
	.woocommerce div.product form.cart .button,
	.threesixty .nav_bar a:hover,
	.ts-shop-load-more .button:hover,
	.shopping-cart p.buttons a:hover,
	.top-filter-widget-area-button a,
	.top-filter-widget-area-button a:hover,
	.top-filter-widget-area-button a.active,
	.woocommerce .wishlist_table .product-add-to-cart a:hover,
	body.wpb-js-composer .vc_tta-tabs.vc_tta-style-2 .vc_tta-tab:hover > a,
	body.wpb-js-composer .vc_tta-tabs.vc_tta-style-2 .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_tta-accordion.vc_tta-style-2 .vc_tta-panel.vc_active .vc_tta-controls-icon,
	body.wpb-js-composer .vc_tta-accordion.vc_tta-style-2 .vc_tta-panel.vc_active .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta-accordion.vc_tta-style-3 .vc_tta-panel.vc_active .vc_tta-controls-icon,
	body .mfp-close-btn-in .mfp-close:hover,
	#ts-search-sidebar .ts-search-result-container .view-all-wrapper a,
	.ts-portfolio-wrapper .filter-bar li:hover,
	.ts-portfolio-wrapper .filter-bar li.current,
	.ts-popup-modal span.close:hover,
	body #cboxClose:hover,
	body .pp_pic_holder a.pp_close:hover,
	body .pp_pic_holder a.pp_expand:hover,
	body .pp_pic_holder a.pp_contract:hover,
	.gridlist-toggle a:hover,
	.gridlist-toggle a.active,
	.ts-search-by-category .search-content input[type="submit"],
	.woocommerce .woocommerce-form-register .button,
	/* Pagination */
	.woocommerce nav.woocommerce-pagination ul li a.next:hover,
	.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
	.ts-pagination ul li a.prev:hover,
	.ts-pagination ul li a.next:hover,

	.woocommerce nav.woocommerce-pagination ul li a.next:focus,
	.woocommerce nav.woocommerce-pagination ul li a.prev:focus,
	.ts-pagination ul li a.prev:focus,
	.ts-pagination ul li a.next:focus,

	.dokan-pagination-container .dokan-pagination li:hover a,
	.dokan-pagination-container .dokan-pagination li.active a,
	.ts-pagination ul li a:hover,
	.ts-pagination ul li a:focus,
	.ts-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:focus{
		background-color: <?php echo esc_html($ts_button_background_hover); ?>;
		color: <?php echo esc_html($ts_button_text_hover); ?>;
	}
	.vertical-button-icon.circle-icon .subscribe-email .button:hover{
		background-color: <?php echo esc_html($ts_button_background_hover); ?> !important;
		color: <?php echo esc_html($ts_button_text_hover); ?> !important;
	}
	.horizontal-button-text .subscribe-email .button:hover,
	.woocommerce .horizontal-button-text .subscribe-email .button:hover,
	.ts-tiny-cart-wrapper .dropdown-footer .button.checkout-button,
	.cart_totals .wc-proceed-to-checkout a.button.checkout-button,
	#ts-add-to-cart-popup-modal .action .button.checkout,
	.woocommerce.widget_shopping_cart .buttons .button.checkout,
	.woocommerce .widget_shopping_cart .buttons .button.checkout{
		background-color: <?php echo esc_html($ts_button_background_hover); ?>;
		color: <?php echo esc_html($ts_button_text_hover); ?>;
		border-color: <?php echo esc_html($ts_button_background_hover); ?>;
	}
	<?php 
	if( esc_html( $ts_button_text_color ) != 'rgba(255,255,255,1)' && esc_html( $ts_button_text_color ) != '#ffffff' ):
	?>
	.cart_totals .wc-proceed-to-checkout a.button.checkout-button:hover,
	.ts-tiny-cart-wrapper .dropdown-footer .button.checkout-button:hover,
	#ts-add-to-cart-popup-modal .action .button.checkout:hover,
	.woocommerce.widget_shopping_cart .buttons .button.checkout:hover,
	.woocommerce .widget_shopping_cart .buttons .button.checkout:hover{
		background-color: transparent;
		color:<?php echo esc_html($ts_button_text_color); ?>;
		border-color: <?php echo esc_html($ts_button_text_color); ?>;
	}
	<?php else: ?>
	.cart_totals .wc-proceed-to-checkout a.button.checkout-button:hover,
	.ts-tiny-cart-wrapper .dropdown-footer .button.checkout-button:hover,
	#ts-add-to-cart-popup-modal .action .button.checkout:hover,
	.woocommerce.widget_shopping_cart .buttons .button.checkout:hover,
	.woocommerce .widget_shopping_cart .buttons .button.checkout:hover{
		background-color: transparent;
		color:<?php echo esc_html($ts_button_background_hover); ?>;
		border-color: <?php echo esc_html($ts_button_background_hover); ?>;
	}
	<?php endif; ?>

	/* BREADCRUMB */
	.breadcrumb-title-wrapper{
		background-color: <?php echo esc_html($ts_breadcrumb_background_color); ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title *{
		color: <?php echo esc_html($ts_breadcrumb_text_color); ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title a:hover{
		color: <?php echo esc_html($ts_breadcrumb_link_color_hover); ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title h1{
		color: <?php echo esc_html($ts_breadcrumb_heading_color); ?>;
	}

	/* HEADER COLOR */
	.my-wishlist-wrapper a,
	.header-currency a,
	.header-language a,
	.my-account-wrapper a,
	#vertical-menu-sidebar nav > ul li > a{
		color: <?php echo esc_html($ts_text_color); ?>;
	}
	.my-wishlist-wrapper a:hover,
	.header-currency a:hover,
	.header-language a:hover,
	.my-account-wrapper a:hover,
	#vertical-menu-sidebar nav > ul li > a:hover,
	.group-button-header > div > a:hover{
		color: <?php echo esc_html($ts_primary_color); ?>;
	}

	/* Header Top */
	.header-top,
	.header-v5 .header-left{
		background: <?php echo esc_html($ts_top_header_background_color); ?>;
		border-color: <?php echo esc_html($ts_top_header_border_color); ?>;
		color: <?php echo esc_html($ts_top_header_text_color); ?>;
	}
	.ts-header-social-icons li a{
		color: <?php echo esc_html($ts_top_header_text_color); ?>;
	}
	@media only screen and (min-width: 991px){
		.header-v5 header .search-button .icon,
		.header-v5 .shopping-cart-wrapper a > .ic-cart,
		.header-v5 .my-wishlist-wrapper a,
		.header-v5 .header-currency > div > a,
		.header-v5 .header-language > div > ul > li > a,
		.header-v5 .my-account-wrapper a{
			color: <?php echo esc_html($ts_top_header_text_color); ?>;
		}
	}

	/* Header Middle */
	.header-middle,
	.ts-header,
	body.header-v5 .header-container{
		background-color: <?php echo esc_html($ts_bottom_header_background_color); ?>;
	}

	/* Header Group */
	header .search-button .icon,
	.ts-group-meta-icon-toggle .icon,
	.shopping-cart-wrapper a > .ic-cart,
	.vertical-menu-button{
		color: <?php echo esc_html($ts_menu_text_color); ?>;
	}
	header .search-button .icon:hover,
	.ts-group-meta-icon-toggle .icon:hover,
	.shopping-cart-wrapper a > .ic-cart:hover{
		color: <?php echo esc_html($ts_header_icon_hover); ?>;
	}
	@media only screen and (min-width: 991px){
		.header-v5 header .search-button .icon:hover,
		.header-v5 .shopping-cart-wrapper a:hover > .ic-cart,
		.header-v5 .my-wishlist-wrapper a:hover,
		.header-v5 .header-currency > div > a:hover,
		.header-v5 .header-language > div > ul > li > a:hover,
		.header-v5 .my-account-wrapper a:hover{
			color: <?php echo esc_html($ts_header_icon_hover); ?>;
		}
	}

	/* Menu */
	.header-v3 .header-bottom:before{
		border-color: <?php echo esc_html($ts_menu_border_color); ?>;
	}
	.ts-menu > nav.main-menu > ul.menu > li > .ts-menu-drop-icon,
	header .menu-wrapper nav > ul.menu > li > a,
	header .menu-wrapper nav > ul > li > a,
	header .menu-wrapper nav > ul.menu > li.fa:before{
		color: <?php echo esc_html($ts_menu_text_color); ?>;
	}
	header .menu-wrapper nav > ul.menu > li.fa:hover:before,
	header .menu-wrapper nav > ul.menu > li.fa.current-menu-item:before,
	header .menu-wrapper nav > ul.menu > li.fa.current_page_parent:before,
	header .menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	header .menu-wrapper nav > ul.menu > li.fa.current_page_item:before,
	header .menu-wrapper nav > ul.menu > li.fa.current-menu-ancestor:before,
	header .menu-wrapper nav > ul.menu > li.fa.current-page-ancestor:before,

	.ts-menu > nav.main-menu > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu > li.current_page_parent > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu > li.current_page_item > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu > li.current-menu-ancestor > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu > li.current-page-ancestor > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
	header .menu-wrapper nav > ul.menu > li:hover > a,
	header .menu-wrapper nav > ul.menu > li.current-menu-item > a,
	header .menu-wrapper nav > ul.menu > li.current_page_parent > a,
	header .menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	header .menu-wrapper nav > ul.menu > li.current_page_item > a,
	header .menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	header .menu-wrapper nav > ul.menu > li.current-page-ancestor > a,
	header .menu-wrapper nav > ul.menu li.current-product_cat-ancestor > a{
		color: <?php echo esc_html($ts_menu_text_hover); ?>;
	}
	.header-v1 header .menu-wrapper nav > ul.menu > li > a:after,
	.header-v4 header .menu-wrapper nav > ul.menu > li > a:after{
		border-color: <?php echo esc_html($ts_menu_text_hover); ?>;
	}
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .ts-menu > nav.main-menu > ul.menu > li:hover > .ts-menu-drop-icon,
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu > li:hover > a,
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .menu-wrapper nav > ul.menu li.fa:hover:before,
	.header-transparent.header-text-light .header-template > div:not(.is-sticky) .header-middle .vertical-menu-button:hover{
		color: <?php echo esc_html($ts_menu_light_text_hover); ?>;
	}
	.ts-menu-widget nav.vertical-menu ul.sub-menu:before,
	header .menu-wrapper nav > ul.menu li ul.sub-menu:before,
	header .menu-wrapper .ts-menu > nav > ul.menu > li > a:after{
		background-color: <?php echo esc_html($ts_sub_menu_background_color); ?>;
	}

	/* Menu sub text */
	header .menu-wrapper nav > ul.menu ul.sub-menu > li:before,
	header .menu-wrapper nav > ul.menu ul.sub-menu > li > a,
	header .menu-wrapper nav div.list-link li > a,
	header .menu-wrapper nav > ul.menu li.widget_nav_menu li > a,
	.ts-menu nav > ul.menu ul li > .ts-menu-drop-icon{
		color: <?php echo esc_html($ts_sub_menu_text_color); ?>;
	}

	/* Menu sub hover */
	.ts-menu > nav.main-menu > ul.menu ul li:hover > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current_page_item > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current-menu-item > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current_page_parent > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current-menu-parent > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current-menu-ancestor > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current-page-ancestor > .ts-menu-drop-icon,
	.ts-menu > nav.main-menu > ul.menu ul li.current-product_cat-ancestor > .ts-menu-drop-icon,
	header .menu-wrapper nav > ul.menu ul.sub-menu > li > a:hover,
	header .menu-wrapper nav > ul.menu ul.sub-menu > li:hover:before,
	header .menu-wrapper nav div.list-link li > a:hover,
	header .menu-wrapper nav > ul.menu li.widget_nav_menu li > a:hover,
	header .menu-wrapper nav > ul.menu li.widget_nav_menu li.current-menu-item > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-item > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current_page_parent > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-parent > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current_page_item > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-ancestor > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current-page-ancestor > a,
	header .menu-wrapper nav > ul.menu ul.sub-menu li.current-product_cat-ancestor > a{
		color: <?php echo esc_html($ts_sub_menu_text_hover); ?>;
	}

	/* Heading menu */
	.menu-wrapper nav > ul.menu ul.sub-menu h1,
	.menu-wrapper nav > ul.menu ul.sub-menu h2,
	.menu-wrapper nav > ul.menu ul.sub-menu h3,
	.menu-wrapper nav > ul.menu ul.sub-menu h4,
	.menu-wrapper nav > ul.menu ul.sub-menu h5,
	.menu-wrapper nav > ul.menu ul.sub-menu h6,
	.menu-wrapper nav > ul.menu ul.sub-menu .h1,
	.menu-wrapper nav > ul.menu ul.sub-menu .h2,
	.menu-wrapper nav > ul.menu ul.sub-menu .h3,
	.menu-wrapper nav > ul.menu ul.sub-menu .h4,
	.menu-wrapper nav > ul.menu ul.sub-menu .h5,
	.menu-wrapper nav > ul.menu ul.sub-menu .h6,
	.menu-wrapper h1.wpb_heading,
	.menu-wrapper h2.wpb_heading,
	.menu-wrapper h3.wpb_heading,
	.menu-wrapper h4.wpb_heading,
	.menu-wrapper h5.wpb_heading,
	.menu-wrapper h6.wpb_heading{
		color: <?php echo esc_html($ts_sub_menu_heading_color); ?>;
	}

	/* Mobile */
	@media only screen and (max-width: 767px){
		.ts-sidebar-content{
			background: <?php echo esc_html($ts_menu_mobile_background_color); ?>;
		}
		#group-icon-header .close{
			color: <?php echo esc_html($ts_header_menu_mobile_text_color); ?>;
		}
	}
	.ts-sidebar-content .logo-wrapper{
		background: <?php echo esc_html($ts_header_menu_mobile_background_color); ?>;
	}
	
	.ic-mobile-menu-close-button,
	.mobile-menu-wrapper .mobile-menu li > a,
	.mobile-menu-wrapper .mobile-menu li:before,
	.mobile-menu-wrapper .mobile-menu li > .ts-menu-drop-icon,
	.mobile-menu-wrapper nav > ul.menu ul li > .ts-menu-drop-icon{
		color: <?php echo esc_html($ts_menu_mobile_text_color); ?>;
	}
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu h1,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu h2,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu h3,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu h4,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu h5,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu h6,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h1,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h2,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h3,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h4,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h5,
	.mobile-menu-wrapper nav > ul.menu ul.sub-menu .h6,
	.mobile-menu-wrapper h1.wpb_heading,
	.mobile-menu-wrapper h2.wpb_heading,
	.mobile-menu-wrapper h3.wpb_heading,
	.mobile-menu-wrapper h4.wpb_heading,
	.mobile-menu-wrapper h5.wpb_heading,
	.mobile-menu-wrapper h6.wpb_heading{
		color: <?php echo esc_html($ts_menu_mobile_heading_color); ?>;
	}
	.ic-mobile-menu-close-button:hover,
	.ic-close-menu-button:hover,
	.ts-menu-drop-icon.active,
	.ts-menu-drop-icon:hover,
	.ts-menu-widget nav.vertical-menu > ul > li:hover > .ts-menu-drop-icon,
	.menu-wrapper nav > ul.menu li.fa:hover:before,
	.mobile-menu-wrapper .mobile-menu ul li > a:hover,
	.mobile-menu-wrapper ul ul li > a:hover,
	.mobile-menu-wrapper .mobile-menu ul li:before,
	.mobile-menu-wrapper .mobile-menu ul li > .ts-menu-drop-icon:hover,
	
	.mobile-menu-wrapper ul.menu li:hover > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current_page_item > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current-menu-item > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current_page_parent > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current-menu-parent > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current-menu-ancestor > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current-page-ancestor > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
	.mobile-menu-wrapper ul.menu ul.sub-menu > li > a:hover,
	.mobile-menu-wrapper div.list-link li > a:hover,
	.mobile-menu-wrapper ul.menu li.widget_nav_menu li > a:hover,
	.mobile-menu-wrapper ul.menu li.widget_nav_menu li.current-menu-item > a,
	.mobile-menu-wrapper ul.menu li.current-menu-item > a,
	.mobile-menu-wrapper ul.menu li.current_page_parent > a,
	.mobile-menu-wrapper ul.menu li.current-menu-parent > a,
	.mobile-menu-wrapper ul.menu li.current_page_item > a,
	.mobile-menu-wrapper ul.menu li.current-menu-ancestor > a,
	.mobile-menu-wrapper ul.menu li.current-page-ancestor > a,
	.mobile-menu-wrapper ul.menu li.current-product_cat-ancestor > a{
		color: <?php echo esc_html($ts_menu_mobile_text_hover); ?>;
	}

	/* FOOTER COLOR */
	footer .footer-container{
		background-color: <?php echo esc_html($ts_footer_background_color); ?>;
	}
	footer *,
	footer input[type="text"], 
	footer input[type="search"], 
	footer input[type="text"], 
	footer input[type="email"], 
	footer input[type="password"], 
	footer input[type="date"], 
	footer input[type="number"], 
	footer input[type="tel"],
	footer .footer-container input[type="text"], 
	footer .footer-container input[type="search"], 
	footer .footer-container input[type="text"], 
	footer .footer-container input[type="email"], 
	footer .footer-container input[type="password"], 
	footer .footer-container input[type="date"], 
	footer .footer-container input[type="number"], 
	footer .footer-container input[type="tel"]{
		border-color: <?php echo esc_html($ts_footer_border_color); ?>;
	}
	footer .footer-container input[type="text"]:focus, 
	footer .footer-container input[type="search"]:focus, 
	footer .footer-container input[type="text"]:focus, 
	footer .footer-container input[type="email"]:focus, 
	footer .footer-container input[type="password"]:focus, 
	footer .footer-container input[type="date"]:focus, 
	footer .footer-container input[type="number"]:focus, 
	footer .footer-container input[type="tel"]:focus{
		border-color: <?php echo esc_html($ts_footer_text_color); ?>;
	}
	footer#colophon .social-icons li > a,
	.first-footer-area a,
	.first-footer-area,
	.first-footer-area dt,
	footer .mc4wp-form-fields label,
	footer .footer-container input[type="text"], 
	footer .footer-container input[type="search"], 
	footer .footer-container input[type="text"], 
	footer .footer-container input[type="email"], 
	footer .footer-container input[type="password"], 
	footer .footer-container input[type="date"], 
	footer .footer-container input[type="number"], 
	footer .footer-container input[type="tel"],
	footer#colophon .mailchimp-subscription .newsletter,
	footer .mailchimp-subscription .newsletter,
	footer#colophon .vertical-button-icon .subscribe-email .button,

	footer .footer-container input[type="text"]:hover, 
	footer .footer-container input[type="search"]:hover, 
	footer .footer-container input[type="text"]:hover, 
	footer .footer-container input[type="email"]:hover, 
	footer .footer-container input[type="password"]:hover, 
	footer .footer-container input[type="date"]:hover, 
	footer .footer-container input[type="number"]:hover, 
	footer .footer-container input[type="tel"]:hover,
	footer .footer-container input[type="text"]:focus, 
	footer .footer-container input[type="search"]:focus, 
	footer .footer-container input[type="text"]:focus, 
	footer .footer-container input[type="email"]:focus, 
	footer .footer-container input[type="password"]:focus, 
	footer .footer-container input[type="date"]:focus, 
	footer .footer-container input[type="number"]:focus, 
	footer .footer-container input[type="tel"]:focus
	{
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}

	.footer-container ::-webkit-input-placeholder{
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}

	.footer-container :-moz-placeholder{ /* Firefox 18- */
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}

	.footer-container ::-moz-placeholder{  /* Firefox 19+ */
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}

	.footer-container :-ms-input-placeholder{
		color: <?php echo esc_html($ts_footer_text_color); ?>;
	}

	footer .mc4wp-form-fields h2.title,
	footer#colophon h1,
	footer#colophon h2,
	footer#colophon h3,
	footer#colophon h4,
	footer#colophon h5,
	footer#colophon h6,
	footer#colophon .h1,
	footer#colophon .h2,
	footer#colophon .h3,
	footer#colophon .h4,
	footer#colophon .h5,
	footer#colophon .h6,
	footer#colophon h1.wpb_heading,
	footer#colophon h2.wpb_heading,
	footer#colophon h3.wpb_heading,
	footer#colophon h4.wpb_heading,
	footer#colophon h5.wpb_heading,
	footer#colophon h6.wpb_heading,

	footer#colophon .wp-caption p.wp-caption-text,
	footer#colophon .woocommerce ul.cart_list li span.amount,
	footer#colophon .woocommerce ul.product_list_widget li span.amount,
	footer#colophon .ts-blogs-widget-wrapper ul li a,
	footer#colophon .ts-recent-comments-widget-wrapper ul li a{
		color: <?php echo esc_html($ts_footer_heading_color); ?>;
	}
	footer#colophon a:hover,
	footer#colophon .vertical-button-icon .subscribe-email .button:hover{
		color: <?php echo esc_html($ts_footer_text_hover); ?>;
	}
	footer#colophon .text-light.vertical-button-icon .subscribe-email .button:hover{
		color: <?php echo esc_html($ts_footer_text_hover); ?> !important;
	}
	footer#colophon .end-footer{
		color: <?php echo esc_html($ts_footer_end_text_color); ?>;
		background-color: <?php echo esc_html($ts_footer_end_background_color); ?>;
	}
	footer#colophon .end-footer a{
		color: <?php echo esc_html($ts_footer_end_link_color); ?>;
	}
	footer#colophon .end-footer a:hover{
		color: <?php echo esc_html($ts_footer_end_link_hover); ?>;
	}

	/* PRODUCT COLOR */
	.counter-wrapper > div{
		background-color: <?php echo esc_html($ts_product_countdown_background_color); ?>;
		border-color: <?php echo esc_html($ts_product_countdown_border_color); ?>;
		color: <?php echo esc_html($ts_product_countdown_text_color); ?>;
	}

	/* Rating Product */
	body .star-rating.no-rating:before,
	.star-rating:before,
	.woocommerce .star-rating:before,
	.ts-testimonial-wrapper .rating:before{
		color: <?php echo esc_html($ts_rating_color); ?>;
	}
	.star-rating span:before,
	.ts-testimonial-wrapper .rating span:before{
		color: <?php echo esc_html($ts_rating_fill_color); ?>;
	}

	/* Name Product */
	.add-to-cart-popup-content .product-meta a,
	.ts-search-result-container ul li a,
	#ts-search-result-container .view-all-wrapper a,
	.widget-container ul.product_list_widget li > a,
	.widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
	.widget.ts-products-widget .ts-wg-meta > a,
	.woocommerce ul.product_list_widget .ts-wg-meta > a,
	h3.product-name > a,
	h3.product-name,
	.product-name a,
	ul.wishlist_table .item-details .product-name h3,
	.woocommerce #order_review table.shop_table tbody td.product-name,
	.woocommerce #order_review table.shop_table tfoot td.product-name,
	.single-navigation .product-info,
	.group_table a,
	body table.compare-list tr.title td,
	.product .product-brands a,
	.woocommerce .products .product .product-categories a,
	.woocommerce .widget-container il li .product-categories a,
	.widget-container ul li .product-categories a,
	.widget.ts-products-widget .product-categories a{
		color: <?php echo esc_html($ts_product_name_text_color); ?>;
	}
	
	/* Button Product */
	.thumbnail-wrapper .product-group-button .loop-add-to-cart a,
	.woocommerce .product .product-group-button-meta .loop-add-to-cart a,
	.product-group-button > div a,
	.meta-wrapper div.wishlist a,
	.meta-wrapper div.compare a,
	.woocommerce .product .meta-wrapper a.added_to_cart,
	.woocommerce .product .meta-wrapper .wishlist a{
		background-color: <?php echo esc_html($ts_product_button_thumbnail_background_color); ?>;
		color:<?php echo esc_html($ts_product_button_thumbnail_text_color); ?>;
	}
	.thumbnail-wrapper .product-group-button .loop-add-to-cart a:hover,
	.button-in a:hover,
	.meta-wrapper .button-in.wishlist a:hover,
	.meta-wrapper .button-in.compare a:hover,
	.product-group-button > div a:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:focus,
	.woocommerce .product .meta-wrapper .wishlist a:hover,
	.woocommerce .product .meta-wrapper .wishlist a:focus,
	.meta-wrapper div.wishlist a:hover,
	.meta-wrapper div.compare a:hover,
	.woocommerce .product .product-group-button-meta .loop-add-to-cart a:hover,
	.woocommerce .product .product-group-button-meta .loop-add-to-cart a:focus{
		background-color: <?php echo esc_html($ts_product_button_thumbnail_background_hover); ?>;
		color: <?php echo esc_html($ts_product_button_thumbnail_text_hover); ?>;
	}
	.meta-wrapper .button-in.wishlist a:hover,
	.meta-wrapper .button-in.compare a:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:focus,
	.woocommerce .product .meta-wrapper .wishlist a:hover,
	.woocommerce .product .meta-wrapper .wishlist a:focus,
	.meta-wrapper div.wishlist a:hover,
	.meta-wrapper div.compare a:hover,
	.woocommerce .product .product-group-button-meta .loop-add-to-cart a:hover,
	.woocommerce .product .product-group-button-meta .loop-add-to-cart a:focus{
		color: <?php echo esc_html($ts_product_button_meta_mobile_text_hover); ?>;
	}
	.thumbnail-wrapper .product-group-button a .button-tooltip,
	.ts-product-attribute .button-tooltip{
		color: <?php echo esc_html($ts_product_button_thumbnail_tooltip_text_color); ?>;
	}
	.product-group-button .button-tooltip:after,
	.ts-product-attribute .button-tooltip:after{
		border-top-color: <?php echo esc_html($ts_product_button_thumbnail_tooltip_background_color); ?>;/* rtl */
	}
	body.product-style-2 .product-group-button .button-tooltip:after{
		border-left-color: <?php echo esc_html($ts_product_button_thumbnail_tooltip_background_color); ?>;/* rtl */
		border-right-color: <?php echo esc_html($ts_product_button_thumbnail_tooltip_background_color); ?>;/* rtl */
	}
	.product-group-button .button-tooltip:before,
	.ts-product-attribute .button-tooltip:before{
		background-color: <?php echo esc_html($ts_product_button_thumbnail_tooltip_background_color); ?>;
	}
	/* Label Product */
	.woocommerce .product .product-label .onsale{
		color: <?php echo esc_html($ts_product_sale_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_sale_label_background_color); ?>;
	}
	.woocommerce .product .product-label .onsale.amount{
		color: <?php echo esc_html($ts_product_new_label_text_color); ?>;
	}
	.woocommerce .product .product-label .new{
		color: <?php echo esc_html($ts_product_new_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_new_label_background_color); ?>;
	}
	.woocommerce .product .product-label .featured{
		color: <?php echo esc_html($ts_product_feature_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_feature_label_background_color); ?>;
	}
	.woocommerce .product .product-label .out-of-stock{
		color: <?php echo esc_html($ts_product_outstock_label_text_color); ?>;
		background: <?php echo esc_html($ts_product_outstock_label_background_color); ?>;
	}

	/* Amount Product */
	.woocommerce-checkout-review-order-table .amount,
	.price .amount,
	.ts-tiny-cart-wrapper .subtotal > span.amount,
	.woocommerce .products .product .price,
	.woocommerce .product_list_widget .price,
	.woocommerce .product_list_widget .amount,
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.single-navigation .product-info .price,
	.shop_table .amount,
	/* Compare table */
	body table.compare-list tr.price td{
		color: <?php echo esc_html($ts_product_price_color); ?>;
	}
	del .amount,
	.price del .amount,
	.add-to-cart-popup-content del .amount,
	.woocommerce .products .product del .amount,
	.woocommerce .product_list_widget del .amount,
	.shop_table del .amount{
		color: <?php echo esc_html($ts_product_del_price_color); ?>;
	}
	ins .amount,
	.woocommerce .products .product ins .amount,
	.woocommerce .product_list_widget ins .amount,
	div.product p.price .amount{
		color: <?php echo esc_html($ts_product_sale_price_color); ?>;
	}

	/* Special Button */
	div.product .woocommerce-variation-price .amount,
	.woocommerce div.product form.cart .reset_variations,
	.woocommerce div.product .woocommerce-variation-price .amount,
	.woocommerce .products .product .price.variation-price .amount,
	.ts-tiny-cart-wrapper .total > span.amount,
	.widget_shopping_cart .total .amount{
		color: <?php echo esc_html($ts_special_button_text_color); ?>;
	}
	
	/******* 4. RESPONSIVE *******/
	<?php if( isset($data['ts_responsive']) && $data['ts_responsive'] == 1 ): ?>
		@media only screen and (max-width: 767px){
			body #yith-woocompare table.compare-list tr th:first-child{
				display: none;
			}
		}
	<?php else: ?>
		/* VISUAL COMPOSER */
		.vc_col-xs-1, .vc_col-sm-1, .vc_col-md-1, .vc_col-lg-1, .vc_col-xs-2, .vc_col-sm-2, .vc_col-md-2, .vc_col-lg-2, .vc_col-xs-3, .vc_col-sm-3, .vc_col-md-3, .vc_col-lg-3, .vc_col-xs-4, .vc_col-sm-4, .vc_col-md-4, .vc_col-lg-4, .vc_col-xs-5, .vc_col-sm-5, .vc_col-md-5, .vc_col-lg-5, .vc_col-xs-6, .vc_col-sm-6, .vc_col-md-6, .vc_col-lg-6, .vc_col-xs-7, .vc_col-sm-7, .vc_col-md-7, .vc_col-lg-7, .vc_col-xs-8, .vc_col-sm-8, .vc_col-md-8, .vc_col-lg-8, .vc_col-xs-9, .vc_col-sm-9, .vc_col-md-9, .vc_col-lg-9, .vc_col-xs-10, .vc_col-sm-10, .vc_col-md-10, .vc_col-lg-10, .vc_col-xs-11, .vc_col-sm-11, .vc_col-md-11, .vc_col-lg-11, .vc_col-xs-12, .vc_col-sm-12, .vc_col-md-12, .vc_col-lg-12{
			padding-left: 0;
			padding-right: 0;
		}
		.vc_column-gap-default > .vc_col-xs-1,.vc_column-gap-default > .vc_col-sm-1,.vc_column-gap-default > .vc_col-md-1,.vc_column-gap-default > .vc_col-lg-1,.vc_column-gap-default > .vc_col-xs-2,.vc_column-gap-default > .vc_col-sm-2,.vc_column-gap-default > .vc_col-md-2,.vc_column-gap-default > .vc_col-lg-2,.vc_column-gap-default > .vc_col-xs-3,.vc_column-gap-default > .vc_col-sm-3,.vc_column-gap-default > .vc_col-md-3,.vc_column-gap-default > .vc_col-lg-3,.vc_column-gap-default > .vc_col-xs-4,.vc_column-gap-default > .vc_col-sm-4,.vc_column-gap-default > .vc_col-md-4,.vc_column-gap-default > .vc_col-lg-4,.vc_column-gap-default > .vc_col-xs-5,.vc_column-gap-default > .vc_col-sm-5,.vc_column-gap-default > .vc_col-md-5,.vc_column-gap-default > .vc_col-lg-5,.vc_column-gap-default > .vc_col-xs-6,.vc_column-gap-default > .vc_col-sm-6,.vc_column-gap-default > .vc_col-md-6,.vc_column-gap-default > .vc_col-lg-6,.vc_column-gap-default > .vc_col-xs-7,.vc_column-gap-default > .vc_col-sm-7,.vc_column-gap-default > .vc_col-md-7,.vc_column-gap-default > .vc_col-lg-7,.vc_column-gap-default > .vc_col-xs-8,.vc_column-gap-default > .vc_col-sm-8,.vc_column-gap-default > .vc_col-md-8,.vc_column-gap-default > .vc_col-lg-8,.vc_column-gap-default > .vc_col-xs-9,.vc_column-gap-default > .vc_col-sm-9,.vc_column-gap-default > .vc_col-md-9,.vc_column-gap-default > .vc_col-lg-9,.vc_column-gap-default > .vc_col-xs-10,.vc_column-gap-default > .vc_col-sm-10,.vc_column-gap-default > .vc_col-md-10,.vc_column-gap-default > .vc_col-lg-10,.vc_column-gap-default > .vc_col-xs-11,.vc_column-gap-default > .vc_col-sm-11,.vc_column-gap-default > .vc_col-md-11,.vc_column-gap-default > .vc_col-lg-11,.vc_column-gap-default > .vc_col-xs-12,.vc_column-gap-default > .vc_col-sm-12,.vc_column-gap-default > .vc_col-md-12,.vc_column-gap-default > .vc_col-lg-12{
			padding-left: 15px;
			padding-right: 15px;
		}
		.ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-13, .ts-col-14, .ts-col-15, .ts-col-16, .ts-col-17, .ts-col-18, .ts-col-19, .ts-col-20, .ts-col-21, .ts-col-22, .ts-col-23, .ts-col-24{
			float: left;
		}
		.ts-col-24{
			width: 100%;
		}
		.ts-col-23{
			width: 95.83333333%;
		}
		.ts-col-22{
			width: 91.66666667%;
		}
		.ts-col-21{
			width: 87.5%;
		}
		.ts-col-20{
			width: 83.33333333%;
		}
		.ts-col-19{
			width: 79.16666667%;
		}
		.ts-col-18{
			width: 75%;
		}
		.ts-col-17{
			width: 70.83333333%;
		}
		.ts-col-16{
			width: 66.66666667%;
		}
		.ts-col-15{
			width: 62.5%;
		}
		.ts-col-14{
			width: 58.33333333%;
		}
		.ts-col-13{
			width: 54.16666667%;
		}
		.ts-col-12{
			width: 50%;
		}
		.ts-col-11{
			width: 45.83333333%;
		}
		.ts-col-10{
			width: 41.66666667%;
		}
		.ts-col-9{
			width: 37.5%;
		}
		.ts-col-8{
			width: 33.33333333%;
		}
		.ts-col-7{
			width: 29.16666667%;
		}
		.ts-col-6{
			width: 25%;
		}
		.ts-col-5{
			width: 20.83333333%;
		}
		.ts-col-4{
			width: 16.66666667%;
		}
		.ts-col-3{
			width: 12.5%;
		}
		.ts-col-2{
			width: 8.33333333%;
		}
		.ts-col-1{
			width: 4.16666667%;
		}
		.ts-col-44per{
			width: 44%;
		}
		.ts-col-56per{
			width: 56%;
		}
		@media only screen and (max-width: 991px){
			body.boxed #page,
			.page-container,
			.container{
				width: 760px;
				max-width: 100%;
			}
			.ts-banner-image.fix-width,
			.ts-banner.fix-width,
			.ts-blog-videos-wrapper,
			.dokan-store #page > #main,
			.breadcrumb-title-wrapper .breadcrumb-content,
			body.boxed header.ts-header .header-sticky{
				max-width: 760px;
				width: 100%;
			}
		}
	<?php endif; ?>
	
	/* Custom CSS */
	<?php 
	if( !empty($ts_custom_css_code) ){
		echo html_entity_decode( trim( $ts_custom_css_code ) );
	}
	?>
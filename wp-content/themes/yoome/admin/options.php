<?php
$redux_url = '';
if( class_exists('ReduxFramework') ){
	$redux_url = ReduxFramework::$_url;
}

$logo_url 					= get_template_directory_uri() . '/images/logo.png'; 
$logo_menu_mobile_url 		= get_template_directory_uri() . '/images/logo-menu-mobile.png';
$favicon_url 				= get_template_directory_uri() . '/images/favicon.ico';
$grid_list_icon_url 		= get_template_directory_uri() . '/images/grid-list-icon.png';
$grid_list_icon_hover_url 	= get_template_directory_uri() . '/images/grid-list-icon-hover.png';

$color_image_folder = get_template_directory_uri() . '/admin/assets/images/colors/';
$list_colors = array('orange', 'pink', 'blue', 'pink2' , 'yellow', 'black', 'yellow2', 'red');
$preset_colors_options = array();
foreach( $list_colors as $color ){
	$preset_colors_options[$color] = array(
					'alt'      => $color
					,'img'     => $color_image_folder . $color . '.jpg'
					,'presets' => yoome_get_preset_color_options( $color )
	);
}

$family_fonts = array(
	"Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif"
	,"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif"
	,"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif"
	,"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive"
	,"Courier, monospace"                                   => "Courier, monospace"
	,"Garamond, serif"                                      => "Garamond, serif"
	,"Georgia, serif"                                       => "Georgia, serif"
	,"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif"
	,"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace"
	,"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"
	,"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif"
	,"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif"
	,"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif"
	,"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif"
	,"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif"
	,"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif"
	,"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif"
	,"CustomFont"                          					=> "CustomFont"
);

$header_layout_options = array();
$header_image_folder = get_template_directory_uri() . '/admin/assets/images/headers/';
for( $i = 1; $i <= 6; $i++ ){
	$header_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Header Layout %s', 'yoome'), $i)
		,'img' => $header_image_folder . 'header_v'.$i.'.jpg'
	);
}

$loading_screen_options = array();
$loading_image_folder = get_template_directory_uri() . '/images/loading/';
for( $i = 1; $i <= 10; $i++ ){
	$loading_screen_options[$i] = array(
		'alt'  => sprintf(esc_html__('Loading Image %s', 'yoome'), $i)
		,'img' => $loading_image_folder . 'loading_'.$i.'.svg'
	);
}

$footer_block_options = yoome_get_footer_block_options();

$breadcrumb_layout_options = array();
$breadcrumb_image_folder = get_template_directory_uri() . '/admin/assets/images/breadcrumbs/';
for( $i = 1; $i <= 3; $i++ ){
	$breadcrumb_layout_options['v' . $i] = array(
		'alt'  => sprintf(esc_html__('Breadcrumb Layout %s', 'yoome'), $i)
		,'img' => $breadcrumb_image_folder . 'breadcrumb_v'.$i.'.jpg'
	);
}

$sidebar_options = array();
$default_sidebars = yoome_get_list_sidebars();
if( is_array($default_sidebars) ){
	foreach( $default_sidebars as $key => $_sidebar ){
		$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
	}
}

$product_loading_image = get_template_directory_uri() . '/images/prod_loading.gif';

$option_fields = array();

/*** General Tab ***/
$option_fields['general'] = array(
	array(
		'id'        => 'section-logo-favicon'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Logo - Favicon', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_logo'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Logo', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select an image file for the main logo', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => $logo_url )
	)
	,array(
		'id'        => 'ts_logo_mobile'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Logo On Mobile', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Leave blank to display the main logo on mobile', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_mobile_menu'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Logo On Mobile Menu', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on the top of mobile menu', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => $logo_menu_mobile_url )
	)
	,array(
		'id'        => 'ts_logo_sticky'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Sticky Logo', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Display this logo on sticky header', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'yoome' )
		,'default'  => '160'
	)
	,array(
		'id'        => 'ts_device_logo_width'
		,'type'     => 'text'
		,'url'      => true
		,'title'    => esc_html__( 'Logo Width on Device', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Set width for logo (in pixels)', 'yoome' )
		,'default'  => '144'
	)
	,array(
		'id'        => 'ts_favicon'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Favicon', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a PNG, GIF or ICO image', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => $favicon_url )
	)
	,array(
		'id'        => 'ts_text_logo'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Text Logo', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Yoome'
	)
	
	,array(
		'id'        => 'section-layout-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Layout Style', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Layout Fullwidth', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_header_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Layout Fullwidth', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_main_content_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Main Content Layout Fullwidth', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_footer_layout_fullwidth'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Footer Layout Fullwidth', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '1' )
	)
	,array(
		'id'       	=> 'ts_layout_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout Style', 'yoome' )
		,'subtitle' => esc_html__( 'You can override this option for the individual page', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'wide' 		=> 'Wide'
			,'boxed' 	=> 'Boxed'
		)
		,'default'  => 'wide'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_layout_fullwidth', 'equals', '0' )
	)
	
	,array(
		'id'        => 'section-rtl'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Right To Left', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_rtl'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Right To Left', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-responsive'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Responsive', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_responsive'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Responsive', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-smooth-scroll'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Smooth Scroll', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_smooth_scroll'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Smooth Scroll', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-back-to-top-button'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Back To Top Button', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_back_to_top_button'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_back_to_top_button_on_mobile'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Back To Top Button On Mobile', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-button-style'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Button Style', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_button_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Button Style', 'yoome' )
		,'subtitle' => esc_html__( 'Set style for all pre-defined buttons', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'' 					=> esc_html__( 'Default', 'yoome' )
			,'button-radius' 	=> esc_html__( 'Radius', 'yoome' )
		)
		,'default'  => ''
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-loading-screen'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Loading Screen', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_loading_screen'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Loading Screen', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'        => 'ts_loading_image'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Loading Image', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $loading_screen_options
		,'default'  => '1'
	)
	,array(
		'id'        => 'ts_custom_loading_image'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Custom Loading Image', 'yoome' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'       	=> 'ts_display_loading_screen_in'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Display Loading Screen In', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'all-pages' 		=> esc_html__( 'All Pages', 'yoome' )
			,'homepage-only' 	=> esc_html__( 'Homepage Only', 'yoome' )
			,'specific-pages' 	=> esc_html__( 'Specific Pages', 'yoome' )
		)
		,'default'  => 'all-pages'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_loading_screen_exclude_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Exclude Pages', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'all-pages' )
	)
	,array(
		'id'       	=> 'ts_loading_screen_specific_pages'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Specific Pages', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'data'     => 'pages'
		,'multi'    => true
		,'default'	=> ''
		,'required'	=> array( 'ts_display_loading_screen_in', 'equals', 'specific-pages' )
	)
	
	,array(
		'id'        => 'section-google-map-api'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Google Map API Key', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_gmap_api_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Enter Your API Key', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
	)
);

/*** Color Scheme Tab ***/
$option_fields['color-scheme'] = array(
	array(
		'id'          => 'ts_color_scheme'
		,'type'       => 'image_select'
		,'presets'    => true
		,'full_width' => false
		,'title'      => esc_html__( 'Select Color Scheme of Theme', 'yoome' )
		,'subtitle'   => ''
		,'desc'       => ''
		,'options'    => $preset_colors_options
		,'default'    => 'orange'
	)
	,array(
		'id'        => 'section-general-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'General Colors', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-primary-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Primary Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_primary_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Primary Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color_in_bg_primary'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color In Background Primary Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-heading-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Heading Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Heading Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-main-content-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Main Content Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_main_content_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Main Content Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#707070'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_text_bold_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Text Bold Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_link_color_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Link Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Border Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-input-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Input Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_input_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Border Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_input_border_color_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Input Border Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c0c0c0'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Button Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_button_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_button_background_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Background Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-special-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Special Button Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_special_button_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Special Button Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-breadcrumb-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Breadcrumb Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_breadcrumb_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Heading Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_breadcrumb_link_color_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Breadcrumb Link Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-header-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Colors', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_top_header_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_top_header_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header Border Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_top_header_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Top Header Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_bottom_header_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Bottom Header Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_icon_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Icon Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-menu-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Menu Colors', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-main-menu-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Main Menu Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_menu_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Border Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#e5e5e5'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_text_light_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Text Light Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-sub-menu-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Sub Menu Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_sub_menu_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_sub_menu_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_sub_menu_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu Heading Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_sub_menu_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sub Menu Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-menu-mobile-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Menu Mobile Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_header_menu_mobile_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Menu Mobile Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_header_menu_mobile_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Header Menu Mobile Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Heading Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_menu_mobile_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Menu Mobile Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'        => 'section-footer-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Footer Colors', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_footer_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_heading_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Heading Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer Border Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#3f3f3f'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-footer-end-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Footer End Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_footer_end_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer End Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_end_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer End Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#cccccc'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_end_link_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer End Link Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_footer_end_link_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Footer End Link Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'        => 'section-product-colors'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Colors', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       => 'ts_product_name_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Name Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Price Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#848484'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_del_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Del Price Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#848484'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_price_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Sale Price Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Rating Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#c1bfbf'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_rating_fill_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Product Rating Fill Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-product-countdown-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Countdown Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_countdown_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Countdown Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f7f7f7'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_countdown_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Countdown Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#000000'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_countdown_border_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Countdown Border Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f7f7f7'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'      => 'info-product-button-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Thumbnail Product Button Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button Text Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_background_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Thumbnail Button Background Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_tooltip_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Tooltip Thumbnail Button Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_thumbnail_tooltip_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Tooltip Thumbnail Button Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_button_meta_mobile_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Meta Product Button Mobile Colors Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-product-label-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Label Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_product_sale_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_sale_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Sale Label Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_new_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'New Label Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#2c54c2'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_feature_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Feature Label Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label Text Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#ffffff'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_product_outstock_label_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'OutStock Label Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#989898'
			,'alpha'	=> 1
		)
	)
	
	,array(
		'id'      => 'info-product-nav-colors'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Product Navigation Colors', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       => 'ts_nav_text_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Navigation Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_nav_background_color'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Navigation Background Color', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f1f1f1'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_nav_text_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Navigation Color Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#f27e01'
			,'alpha'	=> 1
		)
	)
	,array(
		'id'       => 'ts_nav_background_hover'
		,'type'     => 'color_rgba'
		,'title'    => esc_html__( 'Button Navigation Background Hover', 'yoome' )
		,'subtitle' => ''
		,'default'  => array(
			'color' 	=> '#222222'
			,'alpha'	=> 1
		)
	)
);

/*** Typography Tab ***/
$option_fields['typography'] = array(
	array(
		'id'        => 'section-fonts'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Fonts', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       			=> 'ts_body_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '14px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_body_font_bold'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Body Font Bold', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'font-size'  		=> false
		,'letter-spacing' 	=> true
		,'color'   			=> false
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '700'
			,'letter-spacing' 	=> '0.5px'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_heading_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading Font', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-size'    	=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'line-height'  	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '700'
			,'font-size'   		=> '16px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_heading_font_2'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Heading Font 2', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'font-size'    	=> true
		,'line-height'  	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '300'
			,'font-size'   		=> '36px'
			,'line-height'		=> '40px'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_product_name_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Product Name Font', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  		=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '600'
			,'font-size'   		=> '14px'
			,'letter-spacing' 	=> '0.25px'
			,'line-height'		=> '20px'
			,'google'	  		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Menu Font', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '600'
			,'font-size'   		=> '14px'
			,'line-height' 		=> '20px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_menu_font_hover'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Menu Font Active', 'yoome' )
		,'subtitle' 		=> ''
		,'font-size'		=> false
		,'line-height'		=> false
		,'google'   		=> true
		,'font-style'   	=> false
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> false
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '600'
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'       			=> 'ts_sub_menu_font'
		,'type'     		=> 'typography'
		,'title'    		=> esc_html__( 'Sub Menu Font', 'yoome' )
		,'subtitle' 		=> ''
		,'google'   		=> true
		,'font-style'   	=> true
		,'text-align'   	=> false
		,'color'   			=> false
		,'letter-spacing' 	=> true
		,'preview'			=> array('always_display' => true)
		,'default'  			=> array(
			'font-family'  		=> 'Montserrat'
			,'font-weight' 		=> '500'
			,'font-size'   		=> '14px'
			,'line-height' 		=> '20px'
			,'letter-spacing' 	=> '0'
			,'font-style'   	=> ''
			,'google'	   		=> true
		)
		,'fonts'	=> $family_fonts
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 20)
	)
	,array(
		'id'        => 'section-custom-font'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Custom Font', 'yoome' )
		,'subtitle' => esc_html__( 'If you get the error message \'Sorry, this file type is not permitted for security reasons\', you can add this line define(\'ALLOW_UNFILTERED_UPLOADS\', true); to the wp-config.php file', 'yoome' )
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_custom_font_ttf'
		,'type'     => 'media'
		,'url'      => true
		,'preview'  => false
		,'title'    => esc_html__( 'Custom Font ttf', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Upload the .ttf font file. To use it, you select CustomFont in the Standard Fonts group', 'yoome' )
		,'default'  => array( 'url' => '' )
		,'mode'		=> 'application'
	)
	
	,array(
		'id'        => 'section-font-sizes'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Font Sizes', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'      => 'info-font-size-pc'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on PC', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '60px'
			,'line-height' => '60px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '48px'
			,'line-height' => '54px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h3_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '30px'
			,'line-height' => '36px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h4_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '24px'
			,'line-height' => '30px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h5_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H5 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  		=> ''
			,'font-weight'		=> ''
			,'font-size'   		=> '18px'
			,'line-height' 		=> '24px'
			,'letter-spacing' 	=> '4px'
			,'google'	   		=> false
		)
	)
	,array(
		'id'       		=> 'ts_h6_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H6 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '14px'
			,'line-height' => '20px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_button_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'Button Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'line-height'  => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '14px'
			,'google'	   => false
		)
	)
	,array(
		'id'      => 'info-font-size-ipad'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on Ipad', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '50px'
			,'line-height' => '54px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '40px'
			,'line-height' => '44px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h3_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '24px'
			,'line-height' => '28px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h4_ipad_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '22px'
			,'line-height' => '26px'
			,'google'	   => false
		)
	)
	,array(
		'id'      => 'info-font-size-mobile'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Font size on Mobile', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'       		=> 'ts_h1_mobile_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H1 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '36px'
			,'line-height' => '40px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h2_mobile_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H2 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '28px'
			,'line-height' => '32px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h3_mobile_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H3 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '24px'
			,'line-height' => '28px'
			,'google'	   => false
		)
	)
	,array(
		'id'       		=> 'ts_h4_mobile_font'
		,'type'     	=> 'typography'
		,'title'    	=> esc_html__( 'H4 Font Size', 'yoome' )
		,'subtitle' 	=> ''
		,'class' 		=> 'typography-no-preview'
		,'google'   	=> false
		,'font-family'  => false
		,'font-weight'  => false
		,'font-style'   => false
		,'text-align'   => false
		,'color'   		=> false
		,'preview'		=> array('always_display' => false)
		,'default'  	=> array(
			'font-family'  => ''
			,'font-weight' => ''
			,'font-size'   => '20px'
			,'line-height' => '24px'
			,'google'	   => false
		)
	)
);

/*** Header Tab ***/
$option_fields['header'] = array(
	array(
		'id'        => 'section-header-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Header Options', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_header_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Header Layout', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $header_layout_options
		,'default'  => 'v6'
	)
	,array(
		'id'        => 'ts_enable_sticky_header'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Sticky Header', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_header_contact_information'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Header Contact Information', 'yoome' )
		,'subtitle' => esc_html__( 'You can add your email, phone number', 'yoome' )
		,'desc'     => 'Welcome to Yoome'
		,'validate' => 'html'
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_enable_tiny_wishlist'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Wishlist', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_header_currency'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Currency', 'yoome' )
		,'subtitle' => esc_html__( 'If you don\'t install WooCommerce Multilingual plugin, it will display demo html', 'yoome' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_header_language'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Language', 'yoome' )
		,'subtitle' => esc_html__( 'If you don\'t install WPML plugin, it will display demo html', 'yoome' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_enable_tiny_account'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'My Account', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_menu_header_content_custom'
		,'type'     => 'textarea'
		,'title'    => esc_html__( 'Sidebar Header Custom Content', 'yoome' )
		,'subtitle' => esc_html__( 'Add custom content below Wishlist/Language/Currency/My Account menu. It does not support some header layouts', 'yoome' )
		,'desc'     => ''
		,'validate' => 'html'
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_enable_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Search Bar', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_enable_tiny_shopping_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_shopping_cart_sidebar'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Shopping Cart Sidebar', 'yoome' )
		,'subtitle' => esc_html__( 'Show shopping cart in sidebar instead of dropdown. You need to update cart after changing', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
		,'required'	=> array( 'ts_enable_tiny_shopping_cart', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_show_shopping_cart_after_adding'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Show Shopping Cart After Adding Product To Cart', 'yoome' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
		,'required'	=> array( 'ts_shopping_cart_sidebar', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_add_to_cart_effect'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Add To Cart Effect', 'yoome' )
		,'subtitle' => esc_html__( 'You need to enable Ajax add to cart in WooCommerce > Settings > Products. If "Show Shopping Cart After Adding Product To Cart" is enabled, this option will be disabled', 'yoome' )
		,'options'  => array(
			''				=> esc_html__( 'None', 'yoome' )
			,'fly_to_cart'	=> esc_html__( 'Fly To Cart', 'yoome' )
			,'show_popup'	=> esc_html__( 'Show Popup', 'yoome' )
		)
		,'default'  => ''
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'      => 'info-social-header'
		,'type'   => 'info'
		,'notice' => false
		,'title'  => esc_html__( 'Header Social Icons', 'yoome' )
		,'desc'   => ''
	)
	,array(
		'id'        => 'ts_enable_header_social_icons'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Header Social Icons', 'yoome' )
		,'subtitle' => esc_html__( 'Some header layouts don\'t include the social icons', 'yoome' )
		,'default'  => false
		,'on'		=> esc_html__( 'Enable', 'yoome' )
		,'off'		=> esc_html__( 'Disable', 'yoome' )
	)
	,array(
		'id'        => 'ts_facebook_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Facebook URL', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_twitter_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Twitter URL', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_youtube_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Youtube URL', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_instagram_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Instagram URL', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_linkedin_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'LinkedIn URL', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => '#'
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_url'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Icon URL', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_custom_social_class'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Custom Icon Class', 'yoome' )
		,'subtitle' => esc_html__( 'Use FontAwesome. Ex: fa-facebook', 'yoome' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_enable_header_social_icons', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-breadcrumb-options'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Breadcrumb Options', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_breadcrumb_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Breadcrumb Layout', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $breadcrumb_layout_options
		,'default'  => 'v3'
	)
	,array(
		'id'        => 'ts_enable_breadcrumb_background_image'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Image', 'yoome' )
		,'subtitle' => esc_html__( 'You can set background color by going to Color Scheme tab > Breadcrumb Colors section', 'yoome' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_bg_breadcrumbs'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Breadcrumbs Background Image', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a new image to override the default background image', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => '' )
	)
	,array(
		'id'        => 'ts_breadcrumb_bg_parallax'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Breadcrumbs Background Parallax', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
);

/*** Footer Tab ***/
$option_fields['footer'] = array(
	array(
		'id'       	=> 'ts_first_footer_area'
		,'type'     => 'select'
		,'title'    => esc_html__( 'First Footer Area', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $footer_block_options
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_second_footer_area'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Second Footer Area', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $footer_block_options
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
);

/*** Menu Tab ***/
$option_fields['menu'] = array(
	array(
		'id'             => 'ts_menu_num_widget'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Mega Menu Widget Area', 'yoome' )
		,'subtitle'      => esc_html__( 'Number Of Widget Areas Available', 'yoome' )
		,'desc'          => esc_html__( 'Min: 1, max: 30, step: 1, default value: 6', 'yoome' )
		,'default'       => 12
		,'min'           => 1
		,'step'          => 1
		,'max'           => 30
		,'display_value' => 'text'
	)
	,array(
		'id'             => 'ts_menu_thumb_width'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Width', 'yoome' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 50, step: 1, default value: 46', 'yoome' )
		,'default'       => 46
		,'min'           => 5
		,'step'          => 1
		,'max'           => 50
		,'display_value' => 'text'
	)
	,array(
		'id'             => 'ts_menu_thumb_height'
		,'type'          => 'slider'
		,'title'         => esc_html__( 'Menu Thumbnail Height', 'yoome' )
		,'subtitle'      => ''
		,'desc'          => esc_html__( 'Min: 5, max: 50, step: 1, default value: 46', 'yoome' )
		,'default'       => 46
		,'min'           => 5
		,'step'          => 1
		,'max'           => 50
		,'display_value' => 'text'
	)
	,array(
		'id'       	=> 'ts_menu_hover_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Menu Hover Style', 'yoome' )
		,'subtitle' => esc_html__( 'Do not support transparent header', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'default'				=> esc_html__( 'Default', 'yoome' )
			,'background-overlay'	=> esc_html__( 'Background Overlay', 'yoome' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
);

/*** Blog Tab ***/
$option_fields['blog'] = array(
	array(
		'id'        => 'section-blog'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Layout', 'yoome' )
		,'subtitle' => esc_html__( 'This option is available when Front page displays the latest posts', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'yoome')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_blog_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Blog Style', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0'			=> esc_html__( 'Default', 'yoome' )
			,'list'		=> esc_html__( 'List', 'yoome' )
		)
		,'default'  => '0'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_like'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Like', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_read_more'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Read More Button', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_excerpt'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_excerpt_strip_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Excerpt Strip All Tags', 'yoome' )
		,'subtitle' => esc_html__( 'Strip all html tags in Excerpt', 'yoome' )
		,'default'  => false
	)
	,array(
		'id'        => 'ts_blog_excerpt_max_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Excerpt Max Words', 'yoome' )
		,'subtitle' => esc_html__( 'Input -1 to show full excerpt', 'yoome' )
		,'desc'     => ''
		,'default'  => '-1'
	)
	
	,array(
		'id'        => 'section-blog-details'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Blog Details', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_blog_details_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Blog Details Layout', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'yoome')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_blog_details_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_blog_details_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'blog-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_blog_details_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Thumbnail', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_date'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Date', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Title', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_author'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_comment'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_like'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Like', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Content', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_tags'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Tags', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Categories', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Sharing - Use ShareThis', 'yoome' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'yoome')
		,'default'  => true
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Blog Sharing - ShareThis Key', 'yoome' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'yoome' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_blog_details_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_blog_details_author_box'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Author Box', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Related Posts', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_blog_details_comment_form'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Blog Comment Form', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
);

/*** Portfolio Details Tab ***/
$option_fields['portfolio-details'] = array(
	array(
		'id'       	=> 'ts_portfolio_page'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Portfolio Page', 'yoome' )
		,'subtitle' => esc_html__( 'Select the page which displays the list of portfolios. You also need to add our portfolio shortcode to that page', 'yoome' )
		,'desc'     => ''
		,'data'     => 'pages'
		,'default'	=> ''
	)
	,array(
		'id'       	=> 'ts_portfolio_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Layout', 'yoome' )
		,'subtitle' => esc_html__( 'Display thumbnail at the top or left of content', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'top-thumbnail'		=> esc_html__( 'Top Thumbnail', 'yoome' )
			,'left-thumbnail'	=> esc_html__( 'Left Thumbnail', 'yoome' )
		)
		,'default'	=> 'top-thumbnail'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_portfolio_thumbnail_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Thumbnail Style', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'slider'	=> esc_html__( 'Slider', 'yoome' )
			,'gallery'	=> esc_html__( 'Gallery', 'yoome' )
		)
		,'default'	=> 'slider'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_portfolio_slider_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Slider Style', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'			=> esc_html__( 'Default', 'yoome' )
			,'center'			=> esc_html__( 'Center', 'yoome' )
			,'fullwidth'		=> esc_html__( 'Fullwidth', 'yoome' )
			,'center-fullwidth'	=> esc_html__( 'Center Fullwidth', 'yoome' )
		)
		,'default'	=> 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array(
			array( 'ts_portfolio_layout', 'equals', 'top-thumbnail' )
			,array( 'ts_portfolio_thumbnail_style', 'equals', 'slider' )
		)
	)
	,array(
		'id'        => 'ts_portfolio_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Thumbnail', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Title', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_likes'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Likes', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Content', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_client'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Client', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_year'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Year', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_url'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio URL', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_categories'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Categories', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Sharing', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_related_posts'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Related Posts', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Portfolio Custom Field', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Portfolio Custom Field Title', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom Field'
		,'required'	=> array( 'ts_portfolio_custom_field', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_portfolio_custom_field_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Portfolio Custom Field Content', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom content goes here'
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => false
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => false
		)
		,'required'	=> array( 'ts_portfolio_custom_field', 'equals', '1' )
	)
);

/*** WooCommerce Tab ***/
$option_fields['woocommerce'] = array(
	array(
		'id'        => 'section-product-label'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Label', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_label_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Label Style', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'circle' 		=> esc_html__( 'Circle', 'yoome' )
			,'square' 		=> esc_html__( 'Square', 'yoome' )
			,'rectangle' 	=> esc_html__( 'Rectangle', 'yoome' )
		)
		,'default'  => 'rectangle'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_product_show_new_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product New Label', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_product_new_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Text', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'New'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_show_new_label_time'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product New Label Time', 'yoome' )
		,'subtitle' => esc_html__( 'Number of days which you want to show New label since product is published', 'yoome' )
		,'desc'     => ''
		,'default'  => '30'
		,'required'	=> array( 'ts_product_show_new_label', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_product_sale_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sale Label Text', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sale'
	)
	,array(
		'id'        => 'ts_product_feature_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Feature Label Text', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Hot'
	)
	,array(
		'id'        => 'ts_product_out_of_stock_label_text'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Out Of Stock Label Text', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Sold out'
	)
	,array(
		'id'       	=> 'ts_show_sale_label_as'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Show Sale Label As', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'text' 		=> esc_html__( 'Text', 'yoome' )
			,'number' 	=> esc_html__( 'Number', 'yoome' )
			,'percent' 	=> esc_html__( 'Percent', 'yoome' )
		)
		,'default'  => 'text'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-rating'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Rating', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_rating_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Rating Style', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'border' 		=> esc_html__( 'Border', 'yoome' )
			,'fill' 		=> esc_html__( 'Fill', 'yoome' )
		)
		,'default'  => 'border'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-hover'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Hover', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_product_hover_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Hover Style', 'yoome' )
		,'subtitle' => esc_html__( 'Select the style of buttons/icons when hovering on product', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'style-1' 		=> esc_html__( 'Horizontal Style', 'yoome' )
			,'style-2' 		=> esc_html__( 'Vertical Style', 'yoome' )
			,'style-3' 		=> esc_html__( 'Rubik Style', 'yoome' )
		)
		,'default'  => 'style-2'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_effect_product'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Back Product Image', 'yoome' )
		,'subtitle' => esc_html__( 'Show another product image on hover. It will show an image from Product Gallery', 'yoome' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_product_tooltip'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tooltip', 'yoome' )
		,'subtitle' => esc_html__( 'Show tooltip when hovering on buttons/icons on product', 'yoome' )
		,'default'  => true
	)
	
	,array(
		'id'        => 'section-lazy-load'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Lazy Load', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_lazy_load'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Lazy Load', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_placeholder_img'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Placeholder Image', 'yoome' )
		,'desc'     => ''
		,'subtitle' => ''
		,'readonly' => false
		,'default'  => array( 'url' => $product_loading_image )
	)
	
	,array(
		'id'        => 'section-quickshop'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Quickshop', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_quickshop'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Activate Quickshop', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'       	=> 'ts_quickshop_image_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Image Layout', 'yoome' )
		,'subtitle' => esc_html__( 'If you select Small Thumbnails, it will use the Thumbnails Style option of Product Details', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'full-slider' 		=> esc_html__( 'Full Slider', 'yoome' )
			,'small-thumbnails' => esc_html__( 'Small Thumbnails', 'yoome' )
		)
		,'default'  => 'full-slider'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_enable_quickshop', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-catalog-mode'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Catalog Mode', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_enable_catalog_mode'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Catalog Mode', 'yoome' )
		,'subtitle' => esc_html__( 'Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off', 'yoome' )
		,'default'  => false
	)
	
	,array(
		'id'        => 'section-ajax-search'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ajax Search', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_ajax_search'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Enable Ajax Search', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'        => 'ts_ajax_search_number_result'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Number Of Results', 'yoome' )
		,'subtitle' => esc_html__( 'Input -1 to show all results', 'yoome' )
		,'desc'     => ''
		,'default'  => '3'
	)
);

/*** Shop/Product Category Tab ***/
$option_fields['shop-product-category'] = array(
	array(
		'id'        => 'ts_prod_cat_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Shop/Product Category Layout', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'yoome')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_cat_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-category-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_columns'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Columns', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			3	=> 3
			,4	=> 4
			,5	=> 5
			,6	=> 6
		)
		,'default'  => '4'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_per_page'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Products Per Page', 'yoome' )
		,'subtitle' => esc_html__( 'Number of products per page', 'yoome' )
		,'desc'     => ''
		,'default'  => '16'
	)
	,array(
		'id'       	=> 'ts_prod_cat_meta_align'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Meta Align', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'yoome' )
			,'center'	=> esc_html__( 'Center', 'yoome' )
		)
		,'default'  => 'center'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_cat_loading_type'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Loading Type', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'yoome' )
			,'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'yoome' )
			,'load-more-button'	=> esc_html__( 'Load More Button', 'yoome' )
			,'ajax-pagination'	=> esc_html__( 'Ajax Pagination', 'yoome' )
		)
		,'default'  => 'load-more-button'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cat_per_page_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Products Per Page Dropdown', 'yoome' )
		,'subtitle' => esc_html__( 'Allow users to select number of products per page', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_glt'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Grid/List Toggle', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_glt_default'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Grid/List Toggle Default', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'grid'	=> esc_html__( 'Grid', 'yoome' )
			,'list'	=> esc_html__( 'List', 'yoome' )
		)
		,'default'  => 'grid'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_glt', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_grid_list_icon'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Icon Grid /List', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a PNG image ( 100 x 50 )', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => $grid_list_icon_url )
	)
	,array(
		'id'        => 'ts_grid_list_hover_icon'
		,'type'     => 'media'
		,'url'      => true
		,'title'    => esc_html__( 'Icon Grid /List Hover', 'yoome' )
		,'desc'     => ''
		,'subtitle' => esc_html__( 'Select a PNG image ( 100 x 50 )', 'yoome' )
		,'readonly' => false
		,'default'  => array( 'url' => $grid_list_icon_hover_url )
	)
	,array(
		'id'        => 'ts_sidebar_filter_widget_area'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Sidebar Filter Widget Area', 'yoome' )
		,'subtitle' => esc_html__( 'Display Sidebar Filter Widget Area at the top of Left or Right Sidebar. If there is no sidebar on the Shop/Product Category page, it will also be disabled', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_top_filter_widget_area'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Top Filter Widget Area', 'yoome' )
		,'subtitle' => esc_html__( 'Display the Filter button at the top of the Shop/Product Category page. It shows widgets in Top Filter Widget Area', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'       	=> 'ts_top_filter_widget_area_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Top Filter Widget Area Position', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'default'	=> esc_html__( 'Default', 'yoome' )
			,'sidebar'	=> esc_html__( 'Sidebar', 'yoome' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_top_filter_widget_area', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_cat_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_thumbnail_border'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail Border', 'yoome' )
		,'subtitle' => esc_html__( 'Add border to product thumbnail', 'yoome' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_cat_thumbnail', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_cat_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'yoome' )
		,'subtitle' => esc_html__( 'Add brands to product list on all pages', 'yoome' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_color_swatch'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Color Swatches', 'yoome' )
		,'subtitle' => esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'yoome' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'       	=> 'ts_prod_cat_number_color_swatch'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Number Of Color Swatches', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			2	=> 2
			,3	=> 3
			,4	=> 4
			,5	=> 5
			,6	=> 6
		)
		,'default'  => '3'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
		,'required'	=> array( 'ts_prod_cat_color_swatch', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_cat_grid_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description - Grid View', 'yoome' )
		,'subtitle' => esc_html__( 'Show product description on grid view', 'yoome' )
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_grid_desc_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Short Description - Grid View - Limit Words', 'yoome' )
		,'subtitle' => esc_html__( 'Number of words to show product description on grid view. It is also used for product shortcode', 'yoome' )
		,'desc'     => ''
		,'default'  => '8'
	)
	,array(
		'id'        => 'ts_prod_cat_list_desc'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Short Description - List View', 'yoome' )
		,'subtitle' => esc_html__( 'Show product description on list view', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat_list_desc_words'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Short Description - List View - Limit Words', 'yoome' )
		,'subtitle' => esc_html__( 'Number of words to show product description on list view', 'yoome' )
		,'desc'     => ''
		,'default'  => '50'
	)
);

/*** Product Details Tab ***/
$option_fields['product-details'] = array(
	array(
		'id'        => 'ts_prod_layout'
		,'type'     => 'image_select'
		,'title'    => esc_html__( 'Product Layout', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'0-1-0' => array(
				'alt'  => esc_html__('Fullwidth', 'yoome')
				,'img' => $redux_url . 'assets/img/1col.png'
			)
			,'1-1-0' => array(
				'alt'  => esc_html__('Left Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cl.png'
			)
			,'0-1-1' => array(
				'alt'  => esc_html__('Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/2cr.png'
			)
			,'1-1-1' => array(
				'alt'  => esc_html__('Left & Right Sidebar', 'yoome')
				,'img' => $redux_url . 'assets/img/3cm.png'
			)
		)
		,'default'  => '0-1-0'
	)
	,array(
		'id'       	=> 'ts_prod_left_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Left Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'       	=> 'ts_prod_right_sidebar'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Right Sidebar', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => $sidebar_options
		,'default'  => 'product-detail-sidebar'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_breadcrumb'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Breadcrumb', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
	)
	,array(
		'id'       	=> 'ts_prod_thumbnail_summary_layout'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Thumbnail Summary Layout', 'yoome' )
		,'subtitle' => esc_html__( 'The Top Thumbnail Slider layout does not support sidebar', 'yoome' )
		,'desc'     => ''
		,'options'  => array(
			'default'		=> esc_html__( 'Default', 'yoome' )
			,'fullwidth'	=> esc_html__( 'Fullwidth', 'yoome' )
			,'scrolling'	=> esc_html__( 'Scrolling', 'yoome' )
			,'top_thumbnail_slider'	=> esc_html__( 'Top Thumbnail Slider', 'yoome' )
		)
		,'default'  => 'default'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_cloudzoom'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Cloud Zoom', 'yoome' )
		,'subtitle' => esc_html__( 'If you turn it off, product gallery images will open in a lightbox', 'yoome' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_dropdown'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Attribute Dropdown', 'yoome' )
		,'subtitle' => esc_html__( 'If you turn it off, the dropdown will be replaced by image or text label', 'yoome' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_attr_color_text'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Attribute Color Text', 'yoome' )
		,'subtitle' => esc_html__( 'Show text for the Color attribute instead of color/color image', 'yoome' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_attr_dropdown', 'equals', '0' )
	)
	,array(
		'id'        => 'ts_prod_next_prev_navigation'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Next/Prev Product Navigation', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_thumbnail'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_thumbnail_border'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Thumbnail Border', 'yoome' )
		,'subtitle' => esc_html__( 'Add border to main thumbnail and gallery', 'yoome' )
		,'default'  => false
		,'required'	=> array( array( 'ts_prod_thumbnail', 'equals', '1' ), array( 'ts_prod_thumbnail_summary_layout', '!=', 'top_thumbnail_slider' ) )
	)
	,array(
		'id'        => 'ts_prod_label'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Label', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_title'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_title_in_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Title In Content', 'yoome' )
		,'subtitle' => esc_html__( 'Display the product title in the page content instead of above the breadcrumbs', 'yoome' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_rating'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Rating', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_sku'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product SKU', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_availability'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Availability', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_excerpt'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Excerpt', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_count_down'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Count Down', 'yoome' )
		,'subtitle' => esc_html__( 'You have to activate ThemeSky plugin', 'yoome' )
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_price'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Price', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_add_to_cart'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Add To Cart Button', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_brand'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Brands', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_cat'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Categories', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_tag'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tags', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_more_less_content'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product More/Less Content', 'yoome' )
		,'subtitle' => esc_html__( 'Show more/less content in the Description tab', 'yoome' )
		,'default'  => true
	)
	,array(
		'id'        => 'ts_prod_sharing'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Sharing - Use ShareThis', 'yoome' )
		,'subtitle' => esc_html__( 'Use share buttons from sharethis.com. You need to add key below', 'yoome' )
		,'default'  => false
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	,array(
		'id'        => 'ts_prod_sharing_sharethis_key'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Sharing - ShareThis Key', 'yoome' )
		,'subtitle' => esc_html__( 'You get it from script code. It is the value of "property" attribute', 'yoome' )
		,'desc'     => ''
		,'default'  => ''
		,'required'	=> array( 'ts_prod_sharing', 'equals', '1' )
	)
	
	,array(
		'id'        => 'section-product-thumbnails'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Thumbnails', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'       	=> 'ts_prod_thumbnails_style'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Thumbnails Style', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'vertical'		=> esc_html__( 'Vertical', 'yoome' )
			,'horizontal'	=> esc_html__( 'Horizontal', 'yoome' )
		)
		,'default'  => 'vertical'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	
	,array(
		'id'        => 'section-product-tabs'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Product Tabs', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_tabs'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tabs', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_accordion_tabs'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Tabs As Accordion', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
	)
	,array(
		'id'       	=> 'ts_prod_tabs_position'
		,'type'     => 'select'
		,'title'    => esc_html__( 'Product Tabs Position', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'options'  => array(
			'after_summary'		=> esc_html__( 'After Summary', 'yoome' )
			,'inside_summary'	=> esc_html__( 'Inside Summary', 'yoome' )
		)
		,'default'  => 'after_summary'
		,'select2'	=> array('allowClear' => false, 'minimumResultsForSearch' => 'Infinity')
	)
	,array(
		'id'        => 'ts_prod_custom_tab'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Product Custom Tab', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_custom_tab_title'
		,'type'     => 'text'
		,'title'    => esc_html__( 'Product Custom Tab Title', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => 'Custom tab'
	)
	,array(
		'id'        => 'ts_prod_custom_tab_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Product Custom Tab Content', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => esc_html__( 'Your custom content goes here. You can add the content for individual product', 'yoome' )
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => false
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => false
		)
	)
	
	,array(
		'id'        => 'section-ads-banner'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Ads Banner', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_ads_banner'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Ads Banner', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_ads_banner_content'
		,'type'     => 'editor'
		,'title'    => esc_html__( 'Ads Banner Content', 'yoome' )
		,'subtitle' => ''
		,'desc'     => ''
		,'default'  => ''
		,'args'     => array(
			'wpautop'        => false
			,'media_buttons' => false
			,'textarea_rows' => 5
			,'teeny'         => false
			,'quicktags'     => false
		)
	)
	
	,array(
		'id'        => 'section-related-up-sell-products'
		,'type'     => 'section'
		,'title'    => esc_html__( 'Related - Up-Sell Products', 'yoome' )
		,'subtitle' => ''
		,'indent'   => false
	)
	,array(
		'id'        => 'ts_prod_upsells'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Up-Sell Products', 'yoome' )
		,'subtitle' => ''
		,'default'  => true
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
	,array(
		'id'        => 'ts_prod_related'
		,'type'     => 'switch'
		,'title'    => esc_html__( 'Related Products', 'yoome' )
		,'subtitle' => ''
		,'default'  => false
		,'on'		=> esc_html__( 'Show', 'yoome' )
		,'off'		=> esc_html__( 'Hide', 'yoome' )
	)
);

/*** Custom Code Tab ***/
$option_fields['custom-code'] = array(
	array(
		'id'        => 'ts_custom_css_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom CSS Code', 'yoome' )
		,'subtitle' => ''
		,'mode'     => 'css'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
	,array(
		'id'        => 'ts_custom_javascript_code'
		,'type'     => 'ace_editor'
		,'title'    => esc_html__( 'Custom Javascript Code', 'yoome' )
		,'subtitle' => ''
		,'mode'     => 'javascript'
		,'theme'    => 'monokai'
		,'desc'     => ''
		,'default'  => ''
	)
);
<?php 
function yoome_get_list_sidebars(){
	$default_sidebars = array(
						array(
							'name' => esc_html__( 'Home Sidebar', 'yoome' ),
							'id' => 'home-sidebar',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Blog Sidebar', 'yoome' ),
							'id' => 'blog-sidebar',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Blog Detail Sidebar', 'yoome' ),
							'id' => 'blog-detail-sidebar',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Product Category Sidebar', 'yoome' ),
							'id' => 'product-category-sidebar',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Sidebar Filter Widget Area', 'yoome' ),
							'id' => 'sidebar-filter-widget-area',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Top Filter Widget Area', 'yoome' ),
							'id' => 'top-filter-widget-area',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => esc_html__( 'Product Detail Sidebar', 'yoome' ),
							'id' => 'product-detail-sidebar',
							'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</section>',
							'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
					);
					
	$custom_sidebars = yoome_get_custom_sidebars();
	if( is_array($custom_sidebars) && !empty($custom_sidebars) ){
		foreach( $custom_sidebars as $name ){
			$default_sidebars[] = array(
								'name' => ''.$name.'',
								'id' => sanitize_title($name),
								'description' => '',
								'class'			=> 'ts-custom-sidebar',
								'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
								'after_widget' => '</section>',
								'before_title' => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
								'after_title' => '</h3></div>',
							);
		}
	}
	
	return $default_sidebars;
}

function yoome_register_widget_area(){
	$default_sidebars = yoome_get_list_sidebars();
	foreach( $default_sidebars as $sidebar ){
		register_sidebar($sidebar);
	}
}
add_action( 'widgets_init', 'yoome_register_widget_area' );

/* Custom Sidebar */
add_action( 'sidebar_admin_page', 'yoome_custom_sidebar_form' );
function yoome_custom_sidebar_form(){
?>
	<form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="ts-form-add-sidebar">
        <input type="text" name="sidebar_name" id="sidebar_name" placeholder="<?php esc_attr_e('Custom Sidebar Name', 'yoome'); ?>" />
		<input type="hidden" id="ts_custom_sidebar_nonce" value="<?php echo wp_create_nonce('ts-custom-sidebar'); ?>" />
        <button class="button-primary" id="ts-add-sidebar"><?php esc_html_e('Add Sidebar', 'yoome'); ?></button>
    </form>
<?php
}

function yoome_get_custom_sidebars(){
	$option_name = 'ts_custom_sidebars';
	$custom_sidebars = get_option($option_name);
    return is_array($custom_sidebars)?$custom_sidebars:array();
}

add_action('wp_ajax_yoome_add_custom_sidebar', 'yoome_add_custom_sidebar');
function yoome_add_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		check_ajax_referer('ts-custom-sidebar', 'sidebar_nonce');
		
		$option_name = 'ts_custom_sidebars';
		if( !get_option($option_name) || get_option($option_name) == '' ){
			delete_option($option_name);
		}
		
		$sidebar_name = sanitize_text_field($_POST['sidebar_name']);
		
		if( get_option($option_name) ){
			$custom_sidebars = yoome_get_custom_sidebars();
			if( !in_array($sidebar_name, $custom_sidebars) ){
				$custom_sidebars[] = $sidebar_name;
			}
			$result = update_option($option_name, $custom_sidebars);
		}
		else{
			$custom_sidebars = array();
			$custom_sidebars[] = $sidebar_name;
			$result = add_option($option_name, $custom_sidebars);
		}
		
		if( $result ){
			die( esc_html__('Successfully added the sidebar', 'yoome') );
		}
		else{
			die( esc_html__('Error! It seems that the sidebar exists. Please try again!', 'yoome') );
		}
	}
	die('');
}

add_action('wp_ajax_yoome_delete_custom_sidebar', 'yoome_delete_custom_sidebar');
function yoome_delete_custom_sidebar(){
	if( isset($_POST['sidebar_name']) ){
		check_ajax_referer('ts-custom-sidebar', 'sidebar_nonce');
		
		$option_name = 'ts_custom_sidebars';
		$del_sidebar = trim( sanitize_text_field($_POST['sidebar_name']) );
		$custom_sidebars = yoome_get_custom_sidebars();
		foreach( $custom_sidebars as $key => $value ){
			if( $value == $del_sidebar ){
				unset($custom_sidebars[$key]);
				break;
			}
		}
		$custom_sidebars = array_values($custom_sidebars);
		update_option($option_name, $custom_sidebars);
		die( esc_html__('Successfully deleted the sidebar', 'yoome') );
	}
	die('');
}
?>
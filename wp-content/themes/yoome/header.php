<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php 
	$yoome_theme_options = yoome_get_theme_options();
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php if( $yoome_theme_options['ts_responsive'] ): ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<?php endif; ?>

	<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php 
	yoome_theme_favicon();
	wp_head(); 
	?>
</head>
<body <?php body_class(); ?>>
<?php
if( function_exists('wp_body_open') ){
	wp_body_open();
}
?>

<div id="page" class="hfeed site">

	<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>
		<!-- Page Slider -->
		<?php if( is_page() ): ?>
			<?php if( yoome_get_page_options('ts_page_slider') && yoome_get_page_options('ts_page_slider_position') == 'before_header' ): ?>
			<div class="top-slideshow">
				<div class="top-slideshow-wrapper">
					<?php yoome_show_page_slider(); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<!-- Search -->
		<?php if( $yoome_theme_options['ts_enable_search'] ): ?>
		<div id="ts-search-sidebar" class="ts-floating-sidebar">
			<div class="overlay"></div>
			<div class="ts-search-by-category ts-sidebar-content woocommerce">
				<h2 class="title"><?php esc_html_e('Search ', 'yoome'); ?></h2>
				<span class="close"></span>
				<?php get_search_form(); ?>
				<div class="ts-search-result-container"></div>
			</div>
		</div>
		<?php endif; ?>
		
		<!-- Group Header Button -->
		<div id="group-icon-header" class="ts-floating-sidebar">
		
			<div class="ts-sidebar-content">
				<span class="close"></span>
				
				<div class="logo-wrapper visible-phone"><?php echo yoome_theme_logo(); ?></div>
				
				<div class="mobile-menu-wrapper ts-menu visible-phone">
					<div class="menu-main-mobile">
						<?php 
						if( has_nav_menu( 'mobile' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'mobile', 'walker' => new Yoome_Walker_Nav_Menu() ) );
						}else if( has_nav_menu( 'primary' ) ){
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu', 'theme_location' => 'primary', 'walker' => new Yoome_Walker_Nav_Menu() ) );
						}
						else{
							wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mobile-menu' ) );
						}
						?>
					</div>
					
				</div>
				
				<div class="group-button-header">
					<?php if( class_exists('YITH_WCWL') && $yoome_theme_options['ts_enable_tiny_wishlist'] ): ?>
					<div class="my-wishlist-wrapper"><h6 class="title visible-phone"><?php esc_html_e('Wishlist ', 'yoome'); ?></h6><?php echo yoome_tini_wishlist(); ?></div>
					<?php endif; ?>
					
					<?php if( $yoome_theme_options['ts_header_currency'] ): ?>
					<div class="header-currency"><h6 class="title visible-phone"><?php esc_html_e('Currency ', 'yoome'); ?></h6><?php yoome_woocommerce_multilingual_currency_switcher(); ?></div>
					<?php endif; ?>
					
					<?php if( $yoome_theme_options['ts_header_language'] ): ?>
					<div class="header-language"><h6 class="title visible-phone"><?php esc_html_e('Language ', 'yoome'); ?></h6><?php yoome_wpml_language_selector(); ?></div>
					<?php endif; ?>	
					
					<?php if( $yoome_theme_options['ts_enable_tiny_account'] ): ?>
					<div class="my-account-wrapper"><?php echo yoome_tiny_account(); ?></div>
					<?php endif; ?>
					
					<?php if( $yoome_theme_options['ts_menu_header_content_custom'] ): ?>
						<?php echo do_shortcode(stripslashes($yoome_theme_options['ts_menu_header_content_custom'])); ?>
					<?php endif; ?>
					
					<?php if( function_exists('ts_header_social_icons') ){ ts_header_social_icons(); } ?>
				</div>
				
			</div>
			

		</div>
		
		
		<!-- Shopping Cart Floating Sidebar -->
		<?php if( $yoome_theme_options['ts_enable_tiny_shopping_cart'] && $yoome_theme_options['ts_shopping_cart_sidebar'] ): ?>
		<div id="ts-shopping-cart-sidebar" class="ts-floating-sidebar">
			<div class="overlay"></div>
			<div class="ts-sidebar-content">
				<span class="close"></span>
				<div class="ts-tiny-cart-wrapper"></div>
			</div>
		</div>
		<?php endif; ?>
		
		<?php yoome_get_header_template(); ?>
		
	<?php endif; ?>
	
	<?php do_action('yoome_before_main_content'); ?>

	<div id="main" class="wrapper">
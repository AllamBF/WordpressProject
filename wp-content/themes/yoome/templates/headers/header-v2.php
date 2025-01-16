<?php
$yoome_theme_options = yoome_get_theme_options();

$header_classes = array();
if( $yoome_theme_options['ts_enable_sticky_header'] ){
	$header_classes[] = 'has-sticky';
}

if( !$yoome_theme_options['ts_enable_tiny_shopping_cart'] ){
	$header_classes[] = 'hidden-cart';
}
else{
	$header_classes[] = 'show-cart';
}

if( !$yoome_theme_options['ts_enable_tiny_wishlist'] || !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
	$header_classes[] = 'hidden-wishlist';
}
else{
	$header_classes[] = 'show-wishlist';
}

if( !$yoome_theme_options['ts_enable_search'] ){
	$header_classes[] = 'hidden-search';
}
else{
	$header_classes[] = 'show-search';
}

if( yoome_get_page_options('ts_header_transparent') ){
	$header_classes[] = 'header-transparent';
	$header_classes[] = 'header-text-' . yoome_get_page_options('ts_header_text_color');
}

?>

<div id="vertical-menu-sidebar" class="menu-wrapper">
	<span class="close"></span>
	<div class="ts-menu">
		<?php 
		if ( has_nav_menu( 'vertical' ) ) {
		?>
		<div class="ts-vertical-menu">
			<div class="vertical-menu-wrapper">
				<h2 class="vertical-menu-heading"><?php echo yoome_get_vertical_menu_heading(); ?></h2>
				<?php
				wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Yoome_Walker_Nav_Menu() ) );
				?>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>

<header class="ts-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="header-container">
		<div class="header-template">
			<div class="header-middle header-sticky">
				<div class="container">
					<div class="header-left">
						<?php 
						if ( has_nav_menu( 'vertical' ) ) {
						?>
						<span class="vertical-menu-button"><span><?php echo yoome_get_vertical_menu_heading(); ?></span></span>
						<?php 
						}
						?>
						
						<?php if( $yoome_theme_options['ts_enable_search'] ): ?>
						<div class="search-sidebar-icon search-button">
							<span class="icon "></span>
						</div>
						<?php endif; ?>
					</div>
					
					<div class="logo-wrapper"><?php echo yoome_theme_logo(); ?></div>
					
					<div class="menu-wrapper menu-center hidden-phone">							
						<div class="ts-menu">
							<?php 
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Yoome_Walker_Nav_Menu() ) );
								}
								else{
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper' ) );
								}
							?>
						</div>
					</div>
					
					<div class="header-right">
						
						<div class="ic-mobile-menu-button visible-phone"></div>
						
						<div class="ts-group-meta-icon-toggle">
							<span class="icon "></span>
						</div>
						
						<?php if( $yoome_theme_options['ts_enable_search'] ): ?>
						<div class="search-sidebar-icon search-button">
							<span class="icon "></span>
						</div>
						<?php endif; ?>
						
						<?php if( $yoome_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
						<div class="shopping-cart-wrapper"><?php echo yoome_tiny_cart(); ?></div>
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>	
	</div>
</header>
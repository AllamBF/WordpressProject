<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	$vertical_thumbnail = yoome_get_theme_options('ts_prod_thumbnails_style') == 'vertical';
	$thumbnail_summary_scrolling = yoome_get_theme_options('ts_prod_thumbnail_summary_layout') == 'scrolling';

	if( has_post_thumbnail() && !$thumbnail_summary_scrolling && yoome_get_theme_options('ts_prod_cloudzoom') ){
		array_unshift($attachment_ids, get_post_thumbnail_id());
	}
	$thumbnails_extra_classes = apply_filters('yoome_single_product_thumbnails_class', array());
	?>
	<div class="thumbnails ts-slider <?php echo esc_attr(implode(' ', $thumbnails_extra_classes)) ?>">
		<div class="thumbnails-container <?php echo (count($attachment_ids) > 1 && !$thumbnail_summary_scrolling)?'loading':''; ?>">
			<ul class="product-thumbnails">
			<?php
			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			$thumbnail_size = apply_filters('yoome_single_product_shop_thumbnail_size', 'woocommerce_thumbnail');
			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop === 0 || $loop % $columns === 0 ) {
					$classes[] = 'first';
				}

				if ( ( $loop + 1 ) % $columns === 0 ) {
					$classes[] = 'last';
				}
				$image_class 	= esc_attr( implode( ' ', $classes ) );
				
				$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail        = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
				
				if( yoome_get_theme_options('ts_prod_cloudzoom') ){
					$single_thumbnail = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
					$image_class 	.= ' cloud-zoom-gallery';
					$data_rel = 'useZoom: \'product_zoom\', smallImage: \''.esc_url( $single_thumbnail[0] ).'\'';
					if( $thumbnail_summary_scrolling ){
						$data_rel = 'position:\'inside\',showTitle:0,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72,adjustX: 0, adjustY:'.(wp_is_mobile()?'0':'-4');
						$image_class 	.= ' cloud-zoom';
					}
					$attributes = array(
						'title'                   => get_post_field( 'post_title', $attachment_id )
					);
					$html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="'.esc_attr($image_class).'" data-rel="'.$data_rel.'">';
					$html .= wp_get_attachment_image( $attachment_id, $thumbnail_size, false, $attributes );
					$html .= '</a></li>';
				}
				else{
					$attributes = array(
						'title'                   => get_post_field( 'post_title', $attachment_id ),
						'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
						'data-index' 			  => $loop + 1,
					);
					$html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="'.esc_attr($image_class).'">';
					$html .= wp_get_attachment_image( $attachment_id, $thumbnail_size, false, $attributes );
					$html .= '</a></li>';
				}
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );

				$loop++;
			}
		?>
			</ul>
			
			<?php if( $vertical_thumbnail ): ?>
			<div class="owl-controls">
				<div class="owl-nav">
					<div class="owl-prev"></div>
					<div class="owl-next"></div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		
		<?php do_action('yoome_after_single_product_thumbnails'); ?>
	</div>
	<?php
	
	if( $thumbnail_summary_scrolling ){
		echo '<div class="owl-controls hidden"><div class="owl-dots">';
		for( $i = 0; $i <= count($attachment_ids); $i++ ){
			echo '<div class="owl-dot'.($i == 0?' active':'').'"><span></span></div>';
		}
		echo '</div></div>';
	}
}
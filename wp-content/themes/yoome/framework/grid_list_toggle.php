<?php 
if( !class_exists('Yoome_Grid_List') && class_exists('WooCommerce') ){
	class Yoome_Grid_List{
		function __construct(){
			add_action('wp', array($this, 'setup_gridlist'), 20);
		}
		
		function setup_gridlist(){
			if( !yoome_get_theme_options('ts_prod_cat_glt') ){
				return;
			}
			if( ( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ) && woocommerce_products_will_display() ){
				add_action( 'woocommerce_before_shop_loop', array( $this, 'gridlist_toggle_button' ), 10);
				add_action('wp_footer', array($this, 'gridlist_set_default_view'));
			}
		}
		
		function gridlist_set_default_view() {
			$default = yoome_get_theme_options('ts_prod_cat_glt_default');
			if( !$default ){
				$default = 'grid';
			}
			?>
				<script type="text/javascript">
					jQuery(function($){
						"use strict";
						var glt_default = '<?php echo esc_js($default); ?>';
						if ( typeof $.cookie == 'function' && $.cookie('tsgridlisttoggle') != null ) {
							glt_default = $.cookie('tsgridlisttoggle');
						}
						$('#main-content div.products').addClass(glt_default);
						$('.gridlist-toggle #' + glt_default).addClass('active');
						
						$('#grid, #list').on('click', function(){
							if( $(this).hasClass('active') ){
								return false;
							}
							var id = $(this).attr('id');
							var removed_class = id=='list'?'grid':'list';
							$('#grid, #list').removeClass('active');
							$(this).addClass('active');
							$('#main-content div.products').fadeOut(300, function() {
								$(this).removeClass(removed_class).addClass(id).fadeIn(300);
							});
							if( typeof $.cookie == 'function' ){
								$.cookie('tsgridlisttoggle',id, { path: '/' });
							}
							return false;
						});
					});
				</script>
			<?php
		}
		
		/* Toggle button */
		function gridlist_toggle_button() {
			if( !woocommerce_products_will_display() ){
				return;
			}
			wp_enqueue_script('cookie');
			?>
				<nav class="gridlist-toggle">
					<a href="#" id="grid" title="<?php esc_attr_e('Grid view', 'yoome'); ?>">&#8862; <span><?php esc_html_e('Grid view', 'yoome'); ?></span></a>
					<a href="#" id="list" title="<?php esc_attr_e('List view', 'yoome'); ?>">&#8863; <span><?php esc_html_e('List view', 'yoome'); ?></span></a>
				</nav>
			<?php
		}
			
	}
	new Yoome_Grid_List();
}
?>
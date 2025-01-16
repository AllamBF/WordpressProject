<?php
add_action('widgets_init', 'ts_menu_load_widgets');

function ts_menu_load_widgets()
{
	register_widget('TS_Menu_Widget');
}

if( !class_exists('TS_Menu_Widget') ){
	class TS_Menu_Widget extends WP_Widget {

		function __construct() {
			$widgetOps = array('classname' => 'ts-menu-widget', 'description' => esc_html__('Display a vertical menu, support Mega Menu', 'themesky'));
			parent::__construct('ts_menu', esc_html__('TS - Menu', 'themesky'), $widgetOps);
		}

		function widget( $args, $instance ) {
			if( !class_exists('Yoome_Walker_Nav_Menu') ){
				return;
			}
			
			extract($args);
			$title 	= apply_filters('widget_title', $instance['title']);
			$menu 	= $instance['menu'];
			
			if( empty($menu) ){
				return;
			}
			
			if( empty($title) ){
				$menu_obj = wp_get_nav_menu_object($menu);
				if( isset( $menu_obj->name ) ){
					$title = $menu_obj->name;
				}
			}
			
			echo $before_widget;
			echo $before_title . $title . $after_title;
			
			wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu ts-mega-menu-wrapper', 'menu' => $menu, 'walker' => new Yoome_Walker_Nav_Menu() ) );
			
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 		= strip_tags($new_instance['title']);			
			$instance['menu'] 		= $new_instance['menu'];			
			
			return $instance;
		}

		function form( $instance ) {
			
			$defaults = array(
				'title' 		=> 'Shop By Category'
				,'menu' 		=> ''
			);
		
			$instance = wp_parse_args( (array) $instance, $defaults );	
			
			$menus = array('' => '');
			$nav_terms = get_terms( array( 'taxonomy' => 'nav_menu', 'hide_empty' => true ) );
			if( is_array($nav_terms) ){
				foreach( $nav_terms as $term ){
					$menus[$term->term_id] = $term->name;
				}
			}
			
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Enter your title', 'themesky'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('menu'); ?>"><?php esc_html_e('Menu', 'themesky'); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id('menu'); ?>" name="<?php echo $this->get_field_name('menu'); ?>">
					<?php foreach( $menus as $id => $name ): ?>
					<option value="<?php echo esc_attr($id) ?>" <?php selected($id, $instance['menu']) ?>><?php echo esc_html($name) ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php 
		}
	}
}
<?php 
class TS_Post_Like{
	function __construct(){
		add_shortcode('ts_post_like_button', array($this, 'like_button'));
		add_action('wp_ajax_ts_like_post', array($this, 'like_post'));
	}
	
	function like_button(){
		global $post;
		$classes = array('ts-post-like-button');
		$classes[] = $this->is_liked()?'liked':'';
		$classes[] = is_user_logged_in()?'allow-like':'';
		$classes = array_filter( $classes );
		
		$title = !is_user_logged_in()?__('You need to login first', 'themesky'):'';
		ob_start();
		?>
		<span class="<?php echo implode(' ', $classes); ?>" data-id="<?php echo esc_attr($post->ID); ?>" title="<?php echo esc_attr($title); ?>">
			<span class="icon"></span>
			<span class="number"><?php echo $this->get_number_like(); ?></span>
		</span>
		<?php
		return ob_get_clean();
	}
	
	function like_post(){
		if( is_user_logged_in() && isset($_POST['post_id']) ){
			$post_id = $_POST['post_id'];
			$action = 1; /* 1: like, -1: unlike */
			$liked_users = get_post_meta($post_id, 'ts_post_like_users', true);
			$user_id = get_current_user_id();
			if( !is_array($liked_users) ){
				$liked_users = array();
			}
			if( !in_array($user_id, $liked_users) ){
				$liked_users[] = $user_id;
			}
			else{
				unset( $liked_users[ array_search($user_id, $liked_users) ] );
				$action = -1;
			}
			update_post_meta($post_id, 'ts_post_like_users', $liked_users);
			$number_like = $this->update_number_like($post_id, $action);
			wp_die( json_encode( array('action' => $action, 'number_like' => $number_like ) ) );
		}
		wp_die(0);
	}
	
	function get_number_like( $post_id = 0 ){
		global $post;
		if( !$post_id ){
			$post_id = $post->ID;
		}
		return absint( get_post_meta($post_id, 'ts_post_like_number', true) );
	}
	
	function update_number_like( $post_id, $action ){
		$number_like = $this->get_number_like( $post_id );
		if( !$number_like ){
			$number_like = 0;
		}
		$number_like += $action;
		update_post_meta($post_id, 'ts_post_like_number', $number_like);
		return $number_like;
	}
	
	function is_liked(){
		global $post;
		if( is_user_logged_in() ){
			$liked_users = get_post_meta($post->ID, 'ts_post_like_users', true);
			if( !is_array($liked_users) ){
				return false;
			}
			$user_id = get_current_user_id();
			return in_array($user_id, $liked_users);
		}
		return false;
	}
}
new TS_Post_Like();
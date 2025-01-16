<?php 
global $post;
$cat_list = get_the_terms($post, 'ts_portfolio_cat');
$cat_ids = array();
if( is_array($cat_list) ){
	foreach( $cat_list as $cat ){
		$cat_ids[] = $cat->term_id;
	}
}

$args = array(
		'post_type' 		=> $post->post_type
		,'post__not_in' 	=> array($post->ID)
		,'posts_per_page' 	=> 6
		,'fields'			=> 'ids'
	);

if( !empty($cat_ids) ){
	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'ts_portfolio_cat'
			,'field'	=> 'term_id'
			,'terms'	=> $cat_ids
		)
	);
}

$related_posts = new WP_Query($args);

if( $related_posts->have_posts() ){
	$post_ids = $related_posts->posts;
	$post_ids = implode(',', $post_ids);
	$shortcode_str = '[ts_portfolio include="'.$post_ids.'" title2="'.esc_attr__('RELATED PROJECTS', 'yoome').'" columns="3" is_slider="1" show_categories="0"]';
	echo do_shortcode( $shortcode_str );
}
wp_reset_postdata();
?>
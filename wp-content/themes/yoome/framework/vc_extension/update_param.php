<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Remove param from vc_row and vc_row_inner */
vc_remove_param('vc_row_inner', 'gap');

vc_remove_param('vc_column', 'parallax');
vc_remove_param('vc_column', 'parallax_image');
vc_remove_param('vc_column', 'parallax_speed_bg');
vc_remove_param('vc_column', 'video_bg');
vc_remove_param('vc_column', 'video_bg_url');
vc_remove_param('vc_column', 'video_bg_parallax');
vc_remove_param('vc_column', 'parallax_speed_video');

vc_remove_param('vc_row', 'gap');
vc_remove_param('vc_row', 'parallax');
vc_remove_param('vc_row', 'parallax_image');
vc_remove_param('vc_row', 'parallax_speed_bg');
vc_remove_param('vc_row', 'video_bg');
vc_remove_param('vc_row', 'video_bg_url');
vc_remove_param('vc_row', 'video_bg_parallax');
vc_remove_param('vc_row', 'parallax_speed_video');

/* Remove param from vc_tabs */
vc_remove_param('vc_tta_accordion', 'style');
vc_remove_param('vc_tta_accordion', 'shape');
vc_remove_param('vc_tta_accordion', 'color');
vc_remove_param('vc_tta_accordion', 'no_fill');
vc_remove_param('vc_tta_accordion', 'spacing');
vc_remove_param('vc_tta_accordion', 'gap');
vc_remove_param('vc_tta_accordion', 'c_align');
vc_remove_param('vc_tta_accordion', 'c_position');

vc_remove_param('vc_tta_tour', 'style');
vc_remove_param('vc_tta_tour', 'shape');
vc_remove_param('vc_tta_tour', 'color');
vc_remove_param('vc_tta_tour', 'spacing');
vc_remove_param('vc_tta_tour', 'gap');
vc_remove_param('vc_tta_tour', 'no_fill_content_area');
vc_remove_param('vc_tta_tour', 'controls_size');
vc_remove_param('vc_tta_tour', 'pagination_style');
vc_remove_param('vc_tta_tour', 'pagination_color');
vc_remove_param('vc_tta_tour', 'alignment');

vc_remove_param('vc_tta_tabs', 'shape');
vc_remove_param('vc_tta_tabs', 'style');
vc_remove_param('vc_tta_tabs', 'color');
vc_remove_param('vc_tta_tabs', 'alignment');
vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
vc_remove_param('vc_tta_tabs', 'spacing');
vc_remove_param('vc_tta_tabs', 'gap');
vc_remove_param('vc_tta_tabs', 'pagination_style');
vc_remove_param('vc_tta_tabs', 'pagination_color');

/* Add param for vc_row and vc_row_inner */
vc_add_param('vc_row_inner', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Columns gap', 'yoome')
	,'param_name' 	=> 'gap'
	,'value' 		=> array(
				esc_html__('Default', 'yoome') 	=> 'default'
				,'0px' 	=> '0'
				,'1px' 	=> '1'
				,'2px' 	=> '2'
				,'3px' 	=> '3'
				,'4px' 	=> '4'
				,'5px' 	=> '5'
				,'10px' => '10'
				,'15px' => '15'
				,'20px' => '20'
				,'25px' => '25'
				,'30px' => '30'
				,'35px' => '35'
			)
	,'description' 	=> esc_html__('Select gap between columns in row.', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Columns gap', 'yoome')
	,'param_name' 	=> 'gap'
	,'value' 		=> array(
				esc_html__('Default', 'yoome') 	=> 'default'
				,'0px' 	=> '0'
				,'1px' 	=> '1'
				,'2px' 	=> '2'
				,'3px' 	=> '3'
				,'4px' 	=> '4'
				,'5px' 	=> '5'
				,'10px' => '10'
				,'15px' => '15'
				,'20px' => '20'
				,'25px' => '25'
				,'30px' => '30'
				,'35px' => '35'
			)
	,'description' 	=> esc_html__('Select gap between columns in row.', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Layout', 'yoome')
	,'param_name' 	=> 'layout'
	,'value' 		=> array(
				esc_html__('Wide', 'yoome') 		=> 'ts-row-wide'
				,esc_html__('Boxed', 'yoome') 	=> 'ts-row-boxed'
	)
	,'description' 	=> esc_html__('Only support Fullwidth Template', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Type', 'yoome')
	,'param_name' 	=> 'bg_type'
	,'value' 		=> array(
					esc_html__('Default', 'yoome')		=> 'no_bg'
					,esc_html__('Parallax', 'yoome')		=> 'image'
					,esc_html__('Youtube Video', 'yoome')	=> 'u_iframe'
					,esc_html__('Hosted Video', 'yoome')	=> 'video'
	)
	,'group'		=> esc_html__('Background', 'yoome')
	,'description' 	=> esc_html__('Note: Youtube Video does not work on mobile', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'attach_image'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Image', 'yoome')
	,'param_name' 	=> 'bg_image_new'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('image'))
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Youtube Video URL', 'yoome')
	,'param_name' 	=> 'u_video_url'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('MP4 Video URL', 'yoome')
	,'param_name' 	=> 'video_url'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('video'))
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('WebM / Ogg Video URL', 'yoome')
	,'param_name' 	=> 'video_url_2'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('video'))
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'attach_image'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Placeholder Image', 'yoome')
	,'param_name' 	=> 'video_poster'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe', 'video'))
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Start Time', 'yoome')
	,'param_name' 	=> 'u_start_time'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'description' 	=> esc_html__('In seconds', 'yoome')
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Stop Time', 'yoome')
	,'param_name' 	=> 'u_stop_time'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'description' 	=> esc_html__('In seconds', 'yoome')
	,'group'		=> esc_html__('Background', 'yoome')
));

vc_add_param('vc_row', array(
	'type' 			=> 'checkbox'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Extra Options', 'yoome')
	,'param_name' 	=> 'video_opts'
	,'value' 		=> array(
					esc_html__('Loop', 'yoome') 			=> 'loop'
					,esc_html__('Muted', 'yoome') 		=> 'muted'
					,esc_html__('Auto Play', 'yoome') 	=> 'auto_play'
	)
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe', 'video'))
	,'group'		=> esc_html__('Background', 'yoome')
));

/* Tabs - Accordion */
vc_add_param('vc_tta_tabs', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Style', 'yoome')
	,'param_name' 	=> 'style'
	,'value' 		=> array(
				esc_html__('Style 1', 'yoome') 	=> '1'
				,esc_html__('Style 2', 'yoome') 	=> '2'
				,esc_html__('Style 3', 'yoome') 	=> '3'
				,esc_html__('Style 4', 'yoome') 	=> '4'
			)
	,'description' 	=> ''
));

vc_add_param('vc_tta_tabs', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Text Style', 'yoome')
	,'param_name' 	=> 'text_style'
	,'value' 		=> array(
				esc_html__('Default', 'yoome') 	=> ''
				,esc_html__('Light', 'yoome') 	=> 'text-light'
			)
	,'description' 	=> ''
	,'dependency' 	=> array('element' => 'style', 'value' => array('3'))
));

vc_add_param('vc_tta_accordion', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Style', 'yoome')
	,'param_name' 	=> 'style'
	,'value' 		=> array(
				esc_html__('Style 1', 'yoome') 	=> '1'
				,esc_html__('Style 2', 'yoome') 	=> '2'
				,esc_html__('Style 3', 'yoome') 	=> '3'
				,esc_html__('Style 4', 'yoome') 	=> '4'
			)
	,'description' 	=> ''
));

add_filter('vc_tta_accordion_general_classes', 'yoome_add_text_style_class_to_tabs', 10, 2);
function yoome_add_text_style_class_to_tabs( $classes, $atts ){
	if( !empty($atts['text_style']) ){
		$classes[] = $atts['text_style'];
	}
	return $classes;
}
?>
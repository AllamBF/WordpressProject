<?php 
add_action( 'vc_before_init', 'yoome_integrate_with_vc' );
function yoome_integrate_with_vc() {
	
	if( !function_exists('vc_map') ){
		return;
	}

	/********************** Content Shortcodes ***************************/
	/*** TS Heading ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Heading', 'yoome' ),
		'base' 		=> 'ts_heading',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Heading Size', 'yoome' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'				=> '1'
						,'2'			=> '2'
						,'3'			=> '3'
						,'4'			=> '4'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Heading Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')					=>  'style-line-before'
							,esc_html__('Center Line After', 'yoome')			=>  'style-center-line-before'
							,esc_html__('Center', 'yoome')						=>  'style-center'
							,esc_html__('Simple', 'yoome')						=>  'style-simple'
							,esc_html__('Rotate', 'yoome')						=>  'style-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Text', 'yoome' )
				,'param_name' 	=> 'text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Style', 'yoome' )
				,'param_name' 	=> 'text_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')			=> 'text-default'
							,esc_html__('Light', 'yoome')			=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Button ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Button', 'yoome' ),
		'base' 		=> 'ts_button',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Text', 'yoome' )
				,'param_name' 	=> 'content'
				,'admin_label' 	=> true
				,'value' 		=> 'Button text'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Self', 'yoome')				=> '_self'
						,esc_html__('New Window Tab', 'yoome')		=> '_blank'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text color', 'yoome' )
				,'param_name' 	=> 'text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Text color hover', 'yoome' )
				,'param_name' 	=> 'text_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color', 'yoome' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background color hover', 'yoome' )
				,'param_name' 	=> 'bg_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color', 'yoome' )
				,'param_name' 	=> 'border_color'
				,'admin_label' 	=> false
				,'value' 		=> '#cccccc'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Border color hover', 'yoome' )
				,'param_name' 	=> 'border_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Border width', 'yoome' )
				,'param_name' 	=> 'border_width'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('In pixels. Ex: 1', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Size', 'yoome' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Small', 'yoome')		=> 'small'
						,esc_html__('Medium', 'yoome')		=> 'medium'
						,esc_html__('Large', 'yoome')		=> 'large'
						,esc_html__('X-Large', 'yoome')	=> 'x-large'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Square', 'yoome')		=> 'square'
						,esc_html__('Round', 'yoome')		=> 'round'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Font icon', 'yoome' )
				,'param_name' 	=> 'font_icon'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'settings' 	=> array(
					'emptyIcon' 	=> true /* default true, display an "EMPTY" icon? */
					,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
				)
				,'description' 	=> esc_html__('Add an icon before the text. Ex: fa-lock', 'yoome')
			)
		)
	) );
	
	/*** TS Features ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Feature', 'yoome' ),
		'base' 		=> 'ts_feature',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Vertical Icon', 'yoome')				=>  'vertical-icon'
						,esc_html__('Vertical Image', 'yoome')				=>  'vertical-image'
						,esc_html__('Horizontal Icon', 'yoome')			=>  'horizontal-icon'
						,esc_html__('Step Number', 'yoome')				=>  'step-number'
						,esc_html__('Box Image', 'yoome')					=>  'box-image'
						,esc_html__('Border Box', 'yoome')					=>  'border-box'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background Color', 'yoome' )
				,'param_name' 	=> 'background_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('border-box'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number Text', 'yoome' )
				,'param_name' 	=> 'number_text'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('1, 2, 3,..', 'yoome')
				,'dependency' => array('element' => 'style', 'value' => array('step-number'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Icon library', 'yoome' )
				,'param_name' 	=> 'icon_type'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Font Awesome', 'yoome')	=>  'fontawesome'
						,esc_html__('Open Iconic', 'yoome')	=>  'openiconic'
						,esc_html__('Typicons', 'yoome')		=>  'typicons'
						,esc_html__('Entypo', 'yoome')			=>  'entypo'
						,esc_html__('Linecons', 'yoome')		=>  'linecons'
						,esc_html__('Mono Social', 'yoome')	=>  'monosocial'
						,esc_html__('Material', 'yoome')		=>  'material'
						,esc_html__('Linear', 'yoome')			=>  'linear'
						)
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('vertical-icon', 'horizontal-icon'))
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_fontawesome'
				,'admin_label' 	=> false
				,'value' 		=> 'fa fa-laptop'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'fontawesome')
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_openiconic'
				,'admin_label' 	=> false
				,'value' 		=> 'vc-oi vc-oi-dial'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'type' 		=> 'openiconic'
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'openiconic')
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_typicons'
				,'admin_label' 	=> false
				,'value' 		=> 'typcn typcn-adjust-brightness'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'type' 		=> 'typicons'
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'typicons')
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_entypo'
				,'admin_label' 	=> false
				,'value' 		=> 'entypo-icon entypo-icon-note'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'type' 		=> 'entypo'
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'entypo')
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_linecons'
				,'admin_label' 	=> false
				,'value' 		=> 'vc_li vc_li-heart'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'type' 		=> 'linecons'
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'linecons')
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_monosocial'
				,'admin_label' 	=> false
				,'value' 		=> 'vc-mono vc-mono-fivehundredpx'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'type' 		=> 'monosocial'
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'monosocial')
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_material'
				,'admin_label' 	=> false
				,'value' 		=> 'vc-material vc-material-cake'
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'type' 		=> 'material'
					,'iconsPerPage' => 4000
				)
				,'dependency' => array('element' => 'icon_type', 'value' => 'material')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Icon', 'yoome' )
				,'param_name' 	=> 'icon_linear'
				,'admin_label' 	=> false
				,'value' 		=> 'lnr lnr-heart'
				,'description' 	=> esc_html__( 'https://linearicons.com/free', 'yoome' )
				,'dependency' => array('element' => 'icon_type', 'value' => 'linear')
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Icon Color', 'yoome' )
				,'param_name' 	=> 'icon_color'
				,'admin_label' 	=> false
				,'value' 		=> '#666666'
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('horizontal-icon', 'vertical-icon'))
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image', 'yoome' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('step-number', 'box-image', 'vertical-image'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image URL', 'yoome' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
				,'dependency' => array('element' => 'style', 'value' => array('step-number', 'box-image', 'vertical-image'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Feature title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Short description', 'yoome' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('vertical-icon', 'horizontal-icon', 'step-number', 'box-image', 'vertical-image'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('New Window Tab', 'yoome')	=>  '_blank'
						,esc_html__('Self', 'yoome')			=>  '_self'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Style', 'yoome' )
				,'param_name' 	=> 'text_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')			=> 'text-default'
							,esc_html__('Light', 'yoome')			=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')				=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for content. Background color is white', 'yoome' )
				,'dependency' 	=> array('element' => 'style', 'value' => array('box-image', 'border-box', 'vertical-image'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class', 'yoome' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Social Icons ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Social Icons', 'yoome' ),
		'base' 		=> 'ts_social',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Description', 'yoome' )
				,'param_name' 	=> 'desc'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'social_style'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Square', 'yoome')					=> 'style-square'
							,esc_html__('Icon', 'yoome')					=> 'style-icon'
							,esc_html__('Circle', 'yoome')					=> 'style-circle'
							,esc_html__('Circle Opacity', 'yoome')			=> 'style-circle-opacity'
							,esc_html__('Circle Multicolor', 'yoome')		=> 'style-circle-multicolor'
							,esc_html__('Vertical', 'yoome')				=> 'style-vertical'
							,esc_html__('Vertical Multicolor', 'yoome')	=> 'style-vertical-multicolor'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Facebook URL', 'yoome' )
				,'param_name' 	=> 'facebook_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Twitter URL', 'yoome' )
				,'param_name' 	=> 'twitter_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Flickr URL', 'yoome' )
				,'param_name' 	=> 'flickr_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Vimeo URL', 'yoome' )
				,'param_name' 	=> 'vimeo_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Youtube URL', 'yoome' )
				,'param_name' 	=> 'youtube_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Viber Number', 'yoome' )
				,'param_name' 	=> 'viber_number'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Skype Username', 'yoome' )
				,'param_name' 	=> 'skype_username'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Instagram URL', 'yoome' )
				,'param_name' 	=> 'instagram_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Pinterest URL', 'yoome' )
				,'param_name' 	=> 'pinterest_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Custom Link', 'yoome' )
				,'param_name' 	=> 'custom_link'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Custom Text', 'yoome' )
				,'param_name' 	=> 'custom_text'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'iconpicker'
				,'heading' 		=> esc_html__( 'Custom Icon', 'yoome' )
				,'param_name' 	=> 'custom_font'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'settings' 	=> array(
					'emptyIcon' 	=> true
					,'iconsPerPage' => 4000
				)
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Tooltip', 'yoome' )
				,'param_name' 	=> 'show_tooltip'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')		=> 1
							,esc_html__('No', 'yoome')		=> 0
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Mailchimp Subscription ***/
	$mc_forms = yoome_get_mailchimp_forms();
	$mc_form_option = array('' => '');
	foreach( $mc_forms as $mc_form ){
		$mc_form_option[$mc_form['title']] = $mc_form['id'];
	}
	vc_map( array(
		'name' 		=> esc_html__( 'TS Mailchimp Subscription', 'yoome' ),
		'base' 		=> 'ts_mailchimp_subscription',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'vertical_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')								=> 'vertical-button-icon'
							,esc_html__('Button Text', 'yoome')							=> 'vertical-button-text'
							,esc_html__('Horizontal Button Text', 'yoome')				=> 'horizontal-button-text'
							,esc_html__('Rounded', 'yoome')								=> 'vertical-button-icon vertical-rounded'
							,esc_html__('Rounded Circle Icon', 'yoome')					=> 'vertical-button-icon vertical-rounded circle-icon'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Form', 'yoome' )
				,'param_name' 	=> 'form'
				,'admin_label' 	=> true
				,'value' 		=> $mc_form_option
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Intro Text', 'yoome' )
				,'param_name' 	=> 'intro_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Style', 'yoome' )
				,'param_name' 	=> 'text_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> 'text-default'
							,esc_html__('Light', 'yoome')		=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Instagram ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Instagram', 'yoome' ),
		'base' 		=> 'ts_instagram',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')				=>  'title-default'
							,esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Username', 'yoome' )
				,'param_name' 	=> 'username'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access Token', 'yoome' )
				,'param_name' 	=> 'access_token'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of photos', 'yoome' )
				,'param_name' 	=> 'number'
				,'admin_label' 	=> true
				,'value' 		=> '9'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'column'
				,'admin_label' 	=> true
				,'value' 		=> array(
							2	=> 2
							,3	=> 3
							,4	=> 4
							,5	=> 5
							,6	=> 6
							)
				,'description' 	=> ''
				,'std'			=> 6
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Size', 'yoome' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Thumbnail', 'yoome')	=> 'thumbnail'
							,esc_html__('Small', 'yoome')		=> 'small'
							,esc_html__('Large', 'yoome')		=> 'large'
							,esc_html__('Original', 'yoome')	=> 'original'
							)
				,'description' 	=> ''
				,'std'			=> 'large'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Margin item', 'yoome' )
				,'param_name' 	=> 'margin_item'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')	=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> esc_html__( 'Default margin item is 30px', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Self', 'yoome')			=> '_self'
							,esc_html__('New window tab', 'yoome')=> '_blank'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Cache time (hours)', 'yoome' )
				,'param_name' 	=> 'cache_time'
				,'admin_label' 	=> false
				,'value' 		=> '12'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('Set margin between items', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Twitter Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Twitter Slider', 'yoome' ),
		'base' 		=> 'ts_twitter_slider',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Username', 'yoome' )
				,'param_name' 	=> 'username'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit tweets', 'yoome' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Exclude Replies', 'yoome' )
				,'param_name' 	=> 'exclude_replies'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('No', 'yoome')		=> 'false'
								,esc_html__('Yes', 'yoome')	=> 'true'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'yoome' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')	=> 'text-default'
							,esc_html__('Light', 'yoome')		=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show dot navigation', 'yoome' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__('Show dot navigation at the bottom. If it is enabled, the navigation buttons will be removed', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Cache time (hours)', 'yoome' )
				,'param_name' 	=> 'cache_time'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Consumer key', 'yoome' )
				,'param_name' 	=> 'consumer_key'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Consumer secret', 'yoome' )
				,'param_name' 	=> 'consumer_secret'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access token', 'yoome' )
				,'param_name' 	=> 'access_token'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Access token secret', 'yoome' )
				,'param_name' 	=> 'access_token_secret'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'group' 		=> esc_html__('API Keys', 'yoome')
			)
		)
	) );
	
	/*** TS Testimonial ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Testimonial', 'yoome' ),
		'base' 		=> 'ts_testimonial',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')				=>  'style-default'
							,esc_html__('Big', 'yoome')					=>  'style-big default'
							,esc_html__('Big Bold', 'yoome')			=>  'style-big bold'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'yoome' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_testimonial'
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Testimonial IDs', 'yoome' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of testimonial ids', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '4'
				,'description' 	=> esc_html__('Number of Posts', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show avatar', 'yoome' )
				,'param_name' 	=> 'show_avatar'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show name', 'yoome' )
				,'param_name' 	=> 'show_name'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Byline', 'yoome' )
				,'param_name' 	=> 'show_byline'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show rating', 'yoome' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'yoome' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> true
				,'value' 		=> '40'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'yoome' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> 'text-default'
							,esc_html__('Light', 'yoome')		=> 'text-light'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show dot navigation', 'yoome' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> esc_html__('Show dot navigation at the bottom. If it is enabled, the navigation buttons will be removed', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Single Image ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Single Image', 'yoome' ),
		'base' 		=> 'ts_single_image',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image', 'yoome' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Size', 'yoome' )
				,'param_name' 	=> 'img_size'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image URL', 'yoome' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'yoome')	=> '_blank'
						,esc_html__('Self', 'yoome')			=> '_self'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'yoome' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hover Effect', 'yoome' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Widespread Left Right', 'yoome')		=> 'eff-widespread-corner-left-right'
						,esc_html__('Border', 'yoome')						=> 'eff-border'
						,esc_html__('Image Scale', 'yoome')				=> 'eff-image-scale'
						,esc_html__('Image Gray', 'yoome')					=> 'eff-image-gray'
						,esc_html__('Translate Left', 'yoome')				=> 'eff-image-translate-left'
						,esc_html__('Translate Right', 'yoome')			=> 'eff-image-translate-right'
						,esc_html__('None', 'yoome')						=> 'no-eff'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Effect Color', 'yoome' )
				,'param_name' 	=> 'effect_color'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'style_effect', 'value' => array('eff-widespread-corner-left-right', 'eff-border'))
			)
		)
	) );
	
	/*** TS Image Gallery ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Image Gallery', 'yoome' ),
		'base' 		=> 'ts_image_gallery',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Images', 'yoome' )
				,'param_name' 	=> 'images'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image size', 'yoome' )
				,'param_name' 	=> 'image_size'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Thumbnail', 'yoome')	=> 'thumbnail'
							,esc_html__('Medium', 'yoome')	=> 'medium'
							,esc_html__('Large', 'yoome')		=> 'large'
							,esc_html__('Full', 'yoome')		=> 'full'
						)
				,'description' 	=> esc_html__('You go to Settings > Media to change image size', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> array(
							1 	=> 1
							,2 	=> 2
							,3 	=> 3
							,4 	=> 4
							,5 	=> 5
							,6 	=> 6
							)
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
				,'std'			=> 4
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Margin item', 'yoome' )
				,'param_name' 	=> 'margin_item'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> esc_html__( 'Default margin item is 20px', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'On click', 'yoome' )
				,'param_name' 	=> 'on_click'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')					=> 'none'
							,esc_html__('Open prettyPhoto', 'yoome')		=> 'prettyphoto'
							,esc_html__('Open custom links', 'yoome')		=> 'custom_link'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Custom links', 'yoome' )
				,'param_name' 	=> 'custom_links'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('A comma separated list of links. Ex: if you have 3 images, the value of this field should be "link1, link2, link3"', 'yoome')
				,'dependency'	=> array( 'element' => 'on_click', 'value' => array('custom_link') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Custom link target', 'yoome' )
				,'param_name' 	=> 'custom_link_target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Self', 'yoome')				=> '_self'
							,esc_html__('New Window Tab', 'yoome')		=> '_blank'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'on_click', 'value' => array('custom_link') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Image Box ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Image Box', 'yoome' ),
		'base' 		=> 'ts_image_box',
		'class' 	=> '',
		'icon' 		=> 'ts_icon_vc',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Default', 'yoome')					=>  'style-default'
						,esc_html__('Horizontal', 'yoome')				=>  'style-horizontal'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image', 'yoome' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image URL', 'yoome' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image position', 'yoome' )
				,'param_name' 	=> 'image_position'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Left', 'yoome')				=>  'image-left'
						,esc_html__('Right', 'yoome')				=>  'image-right'
						)
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('style-horizontal'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title small', 'yoome' )
				,'param_name' 	=> 'title_small'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency' => array('element' => 'style', 'value' => array('style-horizontal'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Description', 'yoome' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button text', 'yoome' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'yoome')	=>  '_blank'
						,esc_html__('Self', 'yoome')			=>  '_self'	
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Logos Slider ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Logos Slider', 'yoome' ),
		'base' 		=> 'ts_logos_slider',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> '7'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Rows', 'yoome' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> 1
				,'description' 	=> esc_html__( 'Number of Rows', 'yoome' )
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'yoome' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_logo'
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin_item'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('Set margin between items', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Activate link', 'yoome' )
				,'param_name' 	=> 'active_link'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style navigation', 'yoome' )
				,'param_name' 	=> 'style_nav'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> 'text-default'
							,esc_html__('Light', 'yoome')		=> 'text-light'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Banner ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Banner', 'yoome' ),
		'base' 		=> 'ts_banner',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner Style', 'yoome' )
				,'param_name' 	=> 'banner_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')							=> 	'style-default'
							,esc_html__('Simple Text', 'yoome')						=> 	'style-simple-text'
							,esc_html__('Simple Text 2', 'yoome')					=> 	'style-simple-text-2'
							,esc_html__('Simple Text 3', 'yoome')					=> 	'style-simple-text-3'
							,esc_html__('Simple Text 4', 'yoome')					=> 	'style-simple-text-4'
							,esc_html__('Simple Text Background Color', 'yoome')	=> 	'style-simple-text-background-color'
							,esc_html__('Simple Text Background Color 2', 'yoome')	=> 	'style-simple-text-2-background-color'
							,esc_html__('Box Center', 'yoome')						=> 	'style-box-center'
							,esc_html__('Box Image Content', 'yoome')				=> 	'style-box-image'
							,esc_html__('Box Content Shadow', 'yoome')				=> 	'style-box-content-shadow'
							,esc_html__('Box Image Shadow', 'yoome')				=> 	'style-box-image-shadow'
							,esc_html__('Box Border', 'yoome')						=> 	'style-box-border'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background Image', 'yoome' )
				,'param_name' 	=> 'bg_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Background Image Url', 'yoome' )
				,'param_name' 	=> 'bg_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Content', 'yoome' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-box-image') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Url', 'yoome' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-box-image') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Background Color', 'yoome' )
				,'param_name' 	=> 'bg_color'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text', 'yoome' )
				,'param_name' 	=> 'heading_title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Use custom font family for Heading Text', 'yoome' )
				,'param_name' 	=> 'use_theme_fonts'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('No', 'yoome')		=> 0
								,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-simple-text-2-background-color', 'style-box-center') )
			)
			,array(
				'type' => 'google_fonts'
				,'param_name' => 'google_fonts'
				,'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal'
				,'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'yoome' )
						,'font_style_description' => esc_html__( 'Select font styling.', 'yoome' )
					)
				)
				,'dependency' => array('element' => 'use_theme_fonts', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Heading Text Color', 'yoome' )
				,'param_name' 	=> 'heading_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text 2', 'yoome' )
				,'param_name' 	=> 'heading_title_2'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array( 'style-default', 'style-simple-text', 'style-simple-text-2', 'style-simple-text-3', 'style-simple-text-background-color', 'style-simple-text-2-background-color', 'style-box-center', 'style-box-image', 'style-box-image-shadow', 'style-box-border', 'style-simple-text-4') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Heading Text 2 Color', 'yoome' )
				,'param_name' 	=> 'heading_text_2_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array( 'style-default', 'style-simple-text', 'style-simple-text-2', 'style-simple-text-3', 'style-simple-text-background-color', 'style-simple-text-2-background-color', 'style-box-center', 'style-box-image', 'style-box-image-shadow', 'style-box-border', 'style-simple-text-4') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Heading Text 3', 'yoome' )
				,'param_name' 	=> 'heading_title_3'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-simple-text-3', 'style-simple-text-background-color', 'style-simple-text-2-background-color') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Heading Text 3 Color', 'yoome' )
				,'param_name' 	=> 'heading_text_3_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-simple-text-3', 'style-simple-text-background-color', 'style-simple-text-2-background-color') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Description', 'yoome' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array( 'style-default','style-simple-text', 'style-box-center', 'style-box-image', 'style-box-image-shadow', 'style-box-content-shadow') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Description Text Color', 'yoome' )
				,'param_name' 	=> 'description_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array( 'style-default','style-simple-text', 'style-box-center', 'style-box-image', 'style-box-image-shadow', 'style-box-content-shadow') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Align', 'yoome' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Left', 'yoome')		=> 	'text-left'
							,esc_html__('Center', 'yoome')		=>  'text-center'
							,esc_html__('Right', 'yoome')		=> 	'text-right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Button', 'yoome' )
				,'param_name' 	=> 'show_button'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array( 'style-default','style-simple-text', 'style-simple-text-2', 'style-simple-text-background-color', 'style-simple-text-4', 'style-box-center', 'style-box-image', 'style-box-image-shadow', 'style-box-content-shadow', 'style-box-border') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button Text', 'yoome' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Shop Now'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Text Color', 'yoome' )
				,'param_name' 	=> 'button_text_color'
				,'admin_label' 	=> false
				,'value' 		=> '#1f1f1f'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Background Color', 'yoome' )
				,'param_name' 	=> 'button_background_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Border Color', 'yoome' )
				,'param_name' 	=> 'button_border_color'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Text Color Hover', 'yoome' )
				,'param_name' 	=> 'button_text_color_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#ffffff'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Background Color Hover', 'yoome' )
				,'param_name' 	=> 'button_background_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#1f1f1f'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Button Border Color Hover', 'yoome' )
				,'param_name' 	=> 'button_border_hover'
				,'admin_label' 	=> false
				,'value' 		=> '#1f1f1f'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_button', 'value' => array('1') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner Text Position', 'yoome' )
				,'param_name' 	=> 'content_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Left Top', 'yoome')			=>  'left-top'
						,esc_html__('Left Bottom', 'yoome')		=>  'left-bottom'
						,esc_html__('Left Center', 'yoome')		=>  'left-center'
						,esc_html__('Right Top', 'yoome')		=>  'right-top'
						,esc_html__('Right Bottom', 'yoome')	=>  'right-bottom'
						,esc_html__('Right Center', 'yoome')	=>  'right-center'
						,esc_html__('Center Top', 'yoome')		=>  'center-top'
						,esc_html__('Center Bottom', 'yoome')	=>  'center-bottom'
						,esc_html__('Center Center', 'yoome')	=>  'center-center'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-default', 'style-simple-text', 'style-simple-text-2', 'style-simple-text-3', 'style-box-image', 'style-simple-text-4') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Banner Text Position', 'yoome' )
				,'param_name' 	=> 'content_position_2'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Right', 'yoome')		=>  'content-right'
						,esc_html__('Left', 'yoome')		=>  'content-left'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'banner_style', 'value' => array('style-simple-text-background-color', 'style-simple-text-2-background-color') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'yoome' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('New Window Tab', 'yoome')	=>  '_blank'
							,esc_html__('Self', 'yoome')			=>  '_self'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Effect', 'yoome' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Background Scale', 'yoome')					=>  'background-scale'
						,esc_html__('Background Scale Opacity', 'yoome')			=>  'background-scale-opacity'
						,esc_html__('Background Scale Dark', 'yoome')				=>	'background-scale-dark'
						,esc_html__('Background Scale and Line', 'yoome')			=>  'background-scale-and-line'
						,esc_html__('Background Scale Opacity and Line', 'yoome')	=>  'background-scale-opacity-line'
						,esc_html__('Background Scale Dark and Line', 'yoome')		=>  'background-scale-dark-line'
						,esc_html__('Background Opacity and Line', 'yoome')		=>	'background-opacity-and-line'
						,esc_html__('Background Dark and Line', 'yoome')			=>	'background-dark-and-line'
						,esc_html__('Background Opacity', 'yoome')					=>	'background-opacity'
						,esc_html__('Background Dark', 'yoome')					=>	'background-dark'
						,esc_html__('Line', 'yoome')								=>	'eff-line'
						,esc_html__('Gray', 'yoome')								=>  'eff-image-gray'
						,esc_html__('None', 'yoome')								=>  'no-effect'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Fix Width', 'yoome' )
				,'param_name' 	=> 'fix_width'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> esc_html__('Fix max width is 1170px', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Radius', 'yoome' )
				,'param_name' 	=> 'image_radius'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra Class', 'yoome' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Banner 2 ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Banner 2', 'yoome' ),
		'base' 		=> 'ts_banner_image',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Background Image', 'yoome' )
				,'param_name' 	=> 'img_bg_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Background Image URL', 'yoome' )
				,'param_name' 	=> 'img_bg_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Background Image Size', 'yoome' )
				,'param_name' 	=> 'img_size'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'yoome' )
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Text', 'yoome' )
				,'param_name' 	=> 'img_text_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display this image before, after or over the main image', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Text URL', 'yoome' )
				,'param_name' 	=> 'img_text_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Text Position', 'yoome' )
				,'param_name' 	=> 'img_text_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Left Top', 'yoome')		=>  'left-top'
						,esc_html__('Left Bottom', 'yoome')	=>  'left-bottom'
						,esc_html__('Left Center', 'yoome')	=>  'left-center'
						,esc_html__('Right Top', 'yoome')		=>  'right-top'
						,esc_html__('Right Bottom', 'yoome')	=>  'right-bottom'
						,esc_html__('Right Center', 'yoome')	=>  'right-center'
						,esc_html__('Center Top', 'yoome')	=>  'center-top'
						,esc_html__('Center Bottom', 'yoome')	=>  'center-bottom'
						,esc_html__('Center Center', 'yoome')	=>  'center-center'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link Title', 'yoome' )
				,'param_name' 	=> 'link_title'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'yoome')	=> '_blank'
						,esc_html__('Self', 'yoome')			=> '_self'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hover Effect', 'yoome' )
				,'param_name' 	=> 'style_effect'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Scale', 'yoome')					=> 'eff-scale'
						,esc_html__('Opacity', 'yoome')				=> 'eff-opacity'
						,esc_html__('Border', 'yoome')				=> 'eff-border'
						,esc_html__('Image Gray', 'yoome')			=> 'eff-image-gray'
						,esc_html__('Translate Left', 'yoome')		=> 'eff-image-translate-left'
						,esc_html__('Translate Right', 'yoome')		=> 'eff-image-translate-right'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Effect Color', 'yoome' )
				,'param_name' 	=> 'effect_color'
				,'admin_label' 	=> false
				,'value' 		=> '#000000'
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'style_effect', 'value' => array('eff-opacity', 'eff-border'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Fix Width', 'yoome' )
				,'param_name' 	=> 'fix_width'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> esc_html__('Fix max width is 1170px', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Radius', 'yoome' )
				,'param_name' 	=> 'image_radius'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Blogs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Blogs', 'yoome' ),
		'base' 		=> 'ts_blogs',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'yoome' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Grid', 'yoome')		=> 'grid'
							,esc_html__('Slider', 'yoome')		=> 'slider'
							,esc_html__('Masonry', 'yoome')	=> 'masonry'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item Layout', 'yoome' )
				,'param_name' 	=> 'item_layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Grid', 'yoome')			=> 'grid'
							,esc_html__('List', 'yoome')			=> 'list'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('grid', 'slider', 'masonry') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'1'				=> '1'
							,'2'			=> '2'
							,'3'			=> '3'
							,'4'			=> '4'
							)
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
				,'std'			=> '3'
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('grid', 'slider', 'masonry') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Posts', 'yoome' )
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('grid', 'slider', 'masonry') )
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'yoome' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'post_cat'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'yoome' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('None', 'yoome')		=> 'none'
						,esc_html__('ID', 'yoome')		=> 'ID'
						,esc_html__('Date', 'yoome')		=> 'date'
						,esc_html__('Name', 'yoome')		=> 'name'
						,esc_html__('Title', 'yoome')		=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'yoome' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Descending', 'yoome')	=> 'DESC'
						,esc_html__('Ascending', 'yoome')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post title', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show thumbnail', 'yoome' )
				,'param_name' 	=> 'show_thumbnail'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show author', 'yoome' )
				,'param_name' 	=> 'show_author'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show comment', 'yoome' )
				,'param_name' 	=> 'show_comment'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show like', 'yoome' )
				,'param_name' 	=> 'show_like'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show date', 'yoome' )
				,'param_name' 	=> 'show_date'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'yoome' )
				,'param_name' 	=> 'show_excerpt'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show read more button', 'yoome' )
				,'param_name' 	=> 'show_readmore'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'yoome' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> 14
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'yoome' )
				,'param_name' 	=> 'show_load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')	=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('grid', 'masonry') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'yoome' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('grid', 'masonry') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')				=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for content. Background color is white', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> 30
				,'description' 	=> esc_html__('Set margin between items', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Blog Videos ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Blog Videos', 'yoome' ),
		'base' 		=> 'ts_blog_videos',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'yoome' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'post_cat'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'yoome' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('None', 'yoome')		=> 'none'
						,esc_html__('ID', 'yoome')			=> 'ID'
						,esc_html__('Date', 'yoome')		=> 'date'
						,esc_html__('Name', 'yoome')		=> 'name'
						,esc_html__('Title', 'yoome')		=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'yoome' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Descending', 'yoome')	=> 'DESC'
						,esc_html__('Ascending', 'yoome')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post title', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show author', 'yoome' )
				,'param_name' 	=> 'show_author'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show comment', 'yoome' )
				,'param_name' 	=> 'show_comment'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show like', 'yoome' )
				,'param_name' 	=> 'show_like'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show date', 'yoome' )
				,'param_name' 	=> 'show_date'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'yoome' )
				,'param_name' 	=> 'show_excerpt'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show read more button', 'yoome' )
				,'param_name' 	=> 'show_readmore'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'yoome' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> 14
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'View more button text', 'yoome' )
				,'param_name' 	=> 'view_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'View more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'View more button link', 'yoome' )
				,'param_name' 	=> 'view_more_link'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Video ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Video', 'yoome' ),
		'base' 		=> 'ts_video_2',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Video Url', 'yoome' )
				,'param_name' 	=> 'video_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Enter a Youtube, Vimeo or hosted video url', 'yoome')
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Placeholder Image', 'yoome' )
				,'param_name' 	=> 'placeholder_image_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Placeholder Image Url', 'yoome' )
				,'param_name' 	=> 'placeholder_image_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
			)
		)
	) );
	
	/*** TS Portfolio ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Portfolio', 'yoome' ),
		'base' 		=> 'ts_portfolio',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'2'		=> '2'
							,'3'	=> '3'
							,'4'	=> '4'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 8
				,'description' 	=> esc_html__('Number of Posts', 'yoome')
			)
			,array(
				'type' 			=> 'ts_category'
				,'heading' 		=> esc_html__( 'Categories', 'yoome' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'ts_portfolio'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'yoome' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')	=> 'none'
							,esc_html__('ID', 'yoome')		=> 'ID'
							,esc_html__('Date', 'yoome')	=> 'date'
							,esc_html__('Name', 'yoome')	=> 'name'
							,esc_html__('Title', 'yoome')	=> 'title'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'yoome' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Descending', 'yoome')	=> 'DESC'
							,esc_html__('Ascending', 'yoome')	=> 'ASC'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show portfolio title', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show categories', 'yoome' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show like icon', 'yoome' )
				,'param_name' 	=> 'show_like_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show link icon', 'yoome' )
				,'param_name' 	=> 'show_link_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show filter bar', 'yoome' )
				,'param_name' 	=> 'show_filter_bar'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'yoome' )
				,'param_name' 	=> 'show_load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'yoome' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Margin item', 'yoome' )
				,'param_name' 	=> 'margin_item'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> esc_html__( 'Default margin item is 30px', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')	=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> esc_html__('If slider is enabled, the filter bar and load more button will be removed', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show dot navigation', 'yoome' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__('Show dot navigation at the bottom. If it is enabled, the navigation buttons will be removed', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=>  1
							,esc_html__('No', 'yoome')	=>  0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Price Table ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Price Table', 'yoome' ),
		'base' 		=> 'ts_price_table',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('style 1', 'yoome')		=> 'style-1'
							,esc_html__('style 2', 'yoome')		=> 'style-2'
							,esc_html__('style 3', 'yoome')		=> 'style-3'
							,esc_html__('style 4', 'yoome')		=> 'style-4'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image', 'yoome' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency' 	=> array('element' => 'style', 'value' => array('style-5', 'style-7'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image URL', 'yoome' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'yoome')
				,'dependency' 	=> array('element' => 'style', 'value' => array('style-5', 'style-7'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title Table', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Color Scheme', 'yoome' )
				,'param_name' 	=> 'color_scheme'
				,'admin_label' 	=> false
				,'value' 		=> '#27af7d'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Price', 'yoome' )
				,'param_name' 	=> 'price'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Currency', 'yoome' )
				,'param_name' 	=> 'currency'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'During Price', 'yoome' )
				,'param_name' 	=> 'during_price'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Ex: /day, /mon, /year', 'yoome')
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Description', 'yoome' )
				,'param_name' 	=> 'description'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Button text', 'yoome' )
				,'param_name' 	=> 'button_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'yoome' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> false
				,'value' 		=> '#'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Active Table', 'yoome' )
				,'param_name' 	=> 'active_table'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Team Members ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Team Members', 'yoome' ),
		'base' 		=> 'ts_team_members',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of members', 'yoome' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Include these members', 'yoome' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
							'1'				=> '1'
							,'2'			=> '2'
							,'3'			=> '3'
							,'4'			=> '4'
							,'5'			=> '5'
							,'6'			=> '6'
							)
				,'description' 	=> esc_html__( 'Number of Columns. 5 columns is not available on the Grid layout', 'yoome' )
				,'std'			=> '3'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'yoome' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('New Window Tab', 'yoome')	=> '_blank'
						,esc_html__('Self', 'yoome')			=> '_self'	
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=>  0
							,esc_html__('Yes', 'yoome')	=>  1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__('Set margin between items is 30px', 'yoome')
				,'dependency'	=> array( 'element' => 'layout', 'value' => array('slider') )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Milestone ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Milestone', 'yoome' ),
		'base' 		=> 'ts_milestone',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number', 'yoome' )
				,'param_name' 	=> 'number'
				,'admin_label' 	=> true
				,'value' 		=> '0'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Plus Icon', 'yoome' )
				,'param_name' 	=> 'plus_icon'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Subject', 'yoome' )
				,'param_name' 	=> 'subject'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'yoome' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')	=> 'text-default'
							,esc_html__('Light', 'yoome')		=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Countdown ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Countdown', 'yoome' ),
		'base' 		=> 'ts_countdown',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Day', 'yoome' )
				,'param_name' 	=> 'day'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Month', 'yoome' )
				,'param_name' 	=> 'month'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Year', 'yoome' )
				,'param_name' 	=> 'year'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text Color Style', 'yoome' )
				,'param_name' 	=> 'text_color_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> 'text-default'
							,esc_html__('Light', 'yoome')		=> 'text-light'
						)
				,'description' 	=> ''
			)
		)
	) );
	
	/*** TS Google Map ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Google Map', 'yoome' ),
		'base' 		=> 'ts_google_map',
		'icon' 		=> 'ts_icon_vc',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Address', 'yoome' )
				,'param_name' 	=> 'address'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('You have to input your API Key in Appearance > Theme Options > General tab', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Height', 'yoome' )
				,'param_name' 	=> 'height'
				,'admin_label' 	=> true
				,'value' 		=> 360
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Zoom', 'yoome' )
				,'param_name' 	=> 'zoom'
				,'admin_label' 	=> true
				,'value' 		=> 12
				,'description' 	=> esc_html__('Input a number between 0 and 22', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Map Type', 'yoome' )
				,'param_name' 	=> 'map_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
								esc_html__('ROADMAP', 'yoome')	=> 'ROADMAP'
								,esc_html__('SATELLITE', 'yoome')	=> 'SATELLITE'
								,esc_html__('HYBRID', 'yoome')	=> 'HYBRID'
								,esc_html__('TERRAIN', 'yoome')	=> 'TERRAIN'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Map Radius', 'yoome' )
				,'param_name' 	=> 'map_radius'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea_html'
				,'heading' 		=> esc_html__( 'Information', 'yoome' )
				,'param_name' 	=> 'content'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__('Display some information over map', 'yoome')
			)
		)
	) );
	
	/********************** TS Product Shortcodes ************************/

	/*** TS Products ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products', 'yoome' ),
		'base' 		=> 'ts_products',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')				=>  'title-default'
							,esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'yoome' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item layout', 'yoome' )
				,'param_name' 	=> 'item_layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Grid', 'yoome')	=> 'grid'
							,esc_html__('List', 'yoome')	=> 'list'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text align', 'yoome' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> ''
							,esc_html__('Center', 'yoome')		=> 'text-center'
							)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'item_layout', 'value' => array('grid') )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Products', 'yoome' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'yoome' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'yoome' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Enter product name or slug to search', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'yoome' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image border', 'yoome' )
				,'param_name' 	=> 'image_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')			=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')				=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for each product item. Background color is white', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item line', 'yoome' )
				,'param_name' 	=> 'item_line'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__( 'Add a line between items', 'yoome' )
				,'dependency'	=> array( 'element' => 'image_border', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'yoome' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'yoome' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'yoome' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'yoome' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')		=> 1
							,esc_html__('No', 'yoome')		=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'yoome' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'yoome' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'yoome' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show color swatches', 'yoome' )
				,'param_name' 	=> 'show_color_swatch'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Number of color swatches', 'yoome' )
				,'param_name' 	=> 'number_color_swatch'
				,'admin_label' 	=> false
				,'value' 		=> array(
							2		=> 2
							,3		=> 3
							,4		=> 4
							,5		=> 5
							,6		=> 6
							)
				,'description' 	=> ''
				,'std'			=> 3
				,'dependency' 	=> array('element' => 'show_color_swatch', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button text', 'yoome' )
				,'param_name' 	=> 'shop_more_text'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more link', 'yoome' )
				,'param_name' 	=> 'shop_more_link'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Row', 'yoome' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> false
				,'value' 		=> array(
								1 	=> 1
								,2 	=> 2
								,3 	=> 3
							)
				,'description' 	=> esc_html__( 'Number of Rows for slider', 'yoome' )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation position', 'yoome' )
				,'param_name' 	=> 'nav_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Middle', 'yoome')	=> 'nav-middle'
							,esc_html__('Bottom', 'yoome')	=> 'nav-bottom'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_nav', 'value' => array('1') )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> true
				,'value' 		=> 30
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Disable slider responsive', 'yoome' )
				,'param_name' 	=> 'disable_slider_responsive'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__('You should only enable this option when Columns is 1 or 2', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Product Deals ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Deals', 'yoome' ),
		'base' 		=> 'ts_product_deals',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')						=>  'title-default'
							,esc_html__('Line After', 'yoome')					=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')			=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')						=>  'title-center'
							,esc_html__('Big Center', 'yoome')					=>  'title-big-center'
							,esc_html__('Simple', 'yoome')						=>  'title-simple'
							,esc_html__('Background Primary', 'yoome')			=>  'title-background-primary'
							,esc_html__('Rotate', 'yoome')						=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'yoome' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Slider', 'yoome')	=>  'slider'
							,esc_html__('Grid', 'yoome')	=>  'grid'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text align', 'yoome' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> ''
							,esc_html__('Center', 'yoome')		=> 'text-center'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'yoome' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Products', 'yoome' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'yoome' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product IDs', 'yoome' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Enter product name or slug to search', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show counter', 'yoome' )
				,'param_name' 	=> 'show_counter'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> esc_html__( 'Show counter on each product', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'yoome' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image border', 'yoome' )
				,'param_name' 	=> 'image_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')			=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'yoome' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'yoome' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'yoome' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in short description', 'yoome' )
				,'param_name' 	=> 'short_desc_words'
				,'admin_label' 	=> false
				,'value' 		=> 8
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'yoome' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')		=> 1
							,esc_html__('No', 'yoome')		=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'yoome' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'yoome' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'yoome' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button text', 'yoome' )
				,'param_name' 	=> 'shop_more_text'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more link', 'yoome' )
				,'param_name' 	=> 'shop_more_link'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation position', 'yoome' )
				,'param_name' 	=> 'nav_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Middle', 'yoome')	=> 'nav-middle'
							,esc_html__('Bottom', 'yoome')	=> 'nav-bottom'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_nav', 'value' => array('1') )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> true
				,'value' 		=> 30
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Products In Category Tabs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products In Category Tabs', 'yoome' ),
		'base' 		=> 'ts_products_in_category_tabs',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab heading style', 'yoome' )
				,'param_name' 	=> 'tab_heading_style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Vertical', 'yoome')					=> 'tab-heading-vertical'
						,esc_html__('Horizontal', 'yoome')				=> 'tab-heading-horizontal'
						,esc_html__('Horizontal Center', 'yoome')		=> 'tab-heading-horizontal-center'
						,esc_html__('Horizontal Italic', 'yoome')		=> 'title-rotate tab-heading-horizontal-italic'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'yoome' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')	=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 8
				,'description' 	=> esc_html__( 'Number of Products', 'yoome' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'yoome' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent Category', 'yoome' )
				,'param_name' 	=> 'parent_cat'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> false
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Each tab will be a sub category of this category. This option is available when the Product Categories option is empty', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Include children', 'yoome' )
				,'param_name' 	=> 'include_children'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('No', 'yoome')		=> 0
						,esc_html__('Yes', 'yoome')	=> 1
						)
				,'description' 	=> esc_html__( 'Load the products of sub categories in each tab', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show general tab', 'yoome' )
				,'param_name' 	=> 'show_general_tab'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> esc_html__('Get products from all categories or sub categories', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'General tab heading', 'yoome' )
				,'param_name' 	=> 'general_tab_heading'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type of general tab', 'yoome' )
				,'param_name' 	=> 'product_type_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item layout', 'yoome' )
				,'param_name' 	=> 'item_layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Grid', 'yoome')	=> 'grid'
							,esc_html__('List', 'yoome')	=> 'list'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text align', 'yoome' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> ''
							,esc_html__('Center', 'yoome')		=> 'text-center'
							)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'item_layout', 'value' => array('grid') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'yoome' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image border', 'yoome' )
				,'param_name' 	=> 'image_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item line', 'yoome' )
				,'param_name' 	=> 'item_line'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> esc_html__( 'Add a line between items', 'yoome' )
				,'dependency'	=> array( 'element' => 'image_border', 'value' => array('0') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')					=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for each product item. Background color is white', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'yoome' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'yoome' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'yoome' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'yoome' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')		=> 1
							,esc_html__('No', 'yoome')		=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'yoome' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'yoome' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'yoome' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show color swatches', 'yoome' )
				,'param_name' 	=> 'show_color_swatch'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Number of color swatches', 'yoome' )
				,'param_name' 	=> 'number_color_swatch'
				,'admin_label' 	=> false
				,'value' 		=> array(
							2		=> 2
							,3		=> 3
							,4		=> 4
							,5		=> 5
							,6		=> 6
							)
				,'description' 	=> ''
				,'std'			=> 3
				,'dependency' 	=> array('element' => 'show_color_swatch', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show shop more button', 'yoome' )
				,'param_name' 	=> 'show_shop_more_button'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show shop more button in general tab', 'yoome' )
				,'param_name' 	=> 'show_shop_more_general_tab'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button label', 'yoome' )
				,'param_name' 	=> 'shop_more_button_text'
				,'admin_label' 	=> true
				,'value' 		=> 'Shop more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'yoome' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'			=> '1'
						,'2'		=> '2'
						)
				,'description' 	=> esc_html__( 'Number of Rows in slider', 'yoome' )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'colorpicker'
				,'heading' 		=> esc_html__( 'Product Area Background Color', 'yoome' )
				,'param_name' 	=> 'product_area_bg_color'
				,'admin_label' 	=> false
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Set background for part of product area', 'yoome' )
				,'dependency' 	=> array('element' => 'rows', 'value' => array('1'))
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation position', 'yoome' )
				,'param_name' 	=> 'nav_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Middle', 'yoome')	=> 'nav-middle'
							,esc_html__('Bottom', 'yoome')	=> 'nav-bottom'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_nav', 'value' => array('1') )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show dot navigation', 'yoome' )
				,'param_name' 	=> 'show_dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')	=> 1
							)
				,'description' 	=> esc_html__('Show dot navigation at the bottom. If it is enabled, the navigation buttons will be removed', 'yoome')
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Products In Product Type Tabs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Products In Product Type Tabs', 'yoome' ),
		'base' 		=> 'ts_products_in_product_type_tabs',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab heading style', 'yoome' )
				,'param_name' 	=> 'tab_heading_style'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Default', 'yoome')					=> 'tab-heading-default'
						,esc_html__('Horizontal Center', 'yoome')		=> 'tab-heading-horizontal-center'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 1', 'yoome' )
				,'param_name' 	=> 'tab_1'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Tab 1 heading', 'yoome' )
				,'param_name' 	=> 'tab_1_heading'
				,'admin_label' 	=> false
				,'value' 		=> 'Featured'
				,'description' 	=> ''
				,'dependency' => array('element' => 'tab_1', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 1 product type', 'yoome' )
				,'param_name' 	=> 'tab_1_product_type'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')		=> 'mixed_order'
						)
				,'std'			=> 'featured'
				,'dependency' 	=> array('element' => 'tab_1', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 2', 'yoome' )
				,'param_name' 	=> 'tab_2'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Tab 2 heading', 'yoome' )
				,'param_name' 	=> 'tab_2_heading'
				,'admin_label' 	=> false
				,'value' 		=> 'Best Selling'
				,'description' 	=> ''
				,'dependency' => array('element' => 'tab_2', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 2 product type', 'yoome' )
				,'param_name' 	=> 'tab_2_product_type'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')	=> 'mixed_order'
						)
				,'std'			=> 'best_selling'
				,'dependency' 	=> array('element' => 'tab_2', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 3', 'yoome' )
				,'param_name' 	=> 'tab_3'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Tab 3 heading', 'yoome' )
				,'param_name' 	=> 'tab_3_heading'
				,'admin_label' 	=> false
				,'value' 		=> 'On Sale'
				,'description' 	=> ''
				,'dependency' => array('element' => 'tab_3', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 3 product type', 'yoome' )
				,'param_name' 	=> 'tab_3_product_type'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')	=> 'mixed_order'
						)
				,'std'			=> 'sale'
				,'dependency' 	=> array('element' => 'tab_3', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 4', 'yoome' )
				,'param_name' 	=> 'tab_4'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Tab 4 heading', 'yoome' )
				,'param_name' 	=> 'tab_4_heading'
				,'admin_label' 	=> false
				,'value' 		=> 'Top Rated'
				,'description' 	=> ''
				,'dependency' => array('element' => 'tab_4', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 4 product type', 'yoome' )
				,'param_name' 	=> 'tab_4_product_type'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')	=> 'mixed_order'
						)
				,'std'			=> 'top_rated'
				,'dependency' 	=> array('element' => 'tab_4', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 5', 'yoome' )
				,'param_name' 	=> 'tab_5'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Tab 5 heading', 'yoome' )
				,'param_name' 	=> 'tab_5_heading'
				,'admin_label' 	=> false
				,'value' 		=> 'Recent'
				,'description' 	=> ''
				,'dependency' => array('element' => 'tab_5', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tab 5 product type', 'yoome' )
				,'param_name' 	=> 'tab_5_product_type'
				,'admin_label' 	=> false
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')	=> 'mixed_order'
						)
				,'std'			=> 'recent'
				,'dependency' 	=> array('element' => 'tab_5', 'value' => '1')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Active tab', 'yoome' )
				,'param_name' 	=> 'active_tab'
				,'admin_label' 	=> false
				,'value' 		=> array(
						1		=> 1
						,2		=> 2
						,3		=> 3
						,4		=> 4
						,5		=> 5
						)
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item layout', 'yoome' )
				,'param_name' 	=> 'item_layout'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Grid', 'yoome')	=> 'grid'
							,esc_html__('List', 'yoome')	=> 'list'
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> esc_html__( 'Number of Products', 'yoome' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'yoome' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Text align', 'yoome' )
				,'param_name' 	=> 'text_align'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')		=> ''
							,esc_html__('Center', 'yoome')		=> 'text-center'
							)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'item_layout', 'value' => array('grid') )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'yoome' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image border', 'yoome' )
				,'param_name' 	=> 'image_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')				=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for each product item. Background color is white', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product SKU', 'yoome' )
				,'param_name' 	=> 'show_sku'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'yoome' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product short description', 'yoome' )
				,'param_name' 	=> 'show_short_desc'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'yoome' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')		=> 1
							,esc_html__('No', 'yoome')		=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product label', 'yoome' )
				,'param_name' 	=> 'show_label'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'yoome' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show add to cart button', 'yoome' )
				,'param_name' 	=> 'show_add_to_cart'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show color swatches', 'yoome' )
				,'param_name' 	=> 'show_color_swatch'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> esc_html__( 'Show the color attribute of variations. The slug of the color attribute has to be "color"', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Number of color swatches', 'yoome' )
				,'param_name' 	=> 'number_color_swatch'
				,'admin_label' 	=> false
				,'value' 		=> array(
							2		=> 2
							,3		=> 3
							,4		=> 4
							,5		=> 5
							,6		=> 6
							)
				,'description' 	=> ''
				,'std'			=> 3
				,'dependency' 	=> array('element' => 'show_color_swatch', 'value' => array('1'))
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__( 'Slider Options', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Rows', 'yoome' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'			=> '1'
						,'2'		=> '2'
						)
				,'description' 	=> esc_html__( 'Number of Rows in slider', 'yoome' )
				,'group'		=> esc_html__( 'Slider Options', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__( 'Slider Options', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Navigation position', 'yoome' )
				,'param_name' 	=> 'nav_position'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Middle', 'yoome')	=> 'nav-middle'
							,esc_html__('Top', 'yoome')		=> 'nav-top'
							,esc_html__('Bottom', 'yoome')	=> 'nav-bottom'
						)
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'show_nav', 'value' => array('1') )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Previous navigation button text', 'yoome' )
				,'param_name' 	=> 'prev_nav_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Previous'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'nav_position', 'value' => array('nav-top') )
				,'group'		=> esc_html__( 'Slider Options', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Next navigation button text', 'yoome' )
				,'param_name' 	=> 'next_nav_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Next'
				,'description' 	=> ''
				,'dependency'	=> array( 'element' => 'nav_position', 'value' => array('nav-top') )
				,'group'		=> esc_html__( 'Slider Options', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__( 'Slider Options', 'yoome' )
			)
		)
	) );
	
	/*** TS Products Widget ***/
	vc_map( array(
		'name' 			=> esc_html__( 'TS Products Widget', 'yoome' ),
		'base' 			=> 'ts_products_widget',
		'icon' 			=> 'ts_icon_vc_shop',
		'class' 		=> '',
		'description' 	=> '',
		'category' 		=> esc_html__('Theme-Sky', 'yoome'),
		'params' 		=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Product type', 'yoome' )
				,'param_name' 	=> 'product_type'
				,'admin_label' 	=> true
				,'value' 		=> array(
						esc_html__('Recent', 'yoome')			=> 'recent'
						,esc_html__('Sale', 'yoome')			=> 'sale'
						,esc_html__('Featured', 'yoome')		=> 'featured'
						,esc_html__('Best Selling', 'yoome')	=> 'best_selling'
						,esc_html__('Top Rated', 'yoome')		=> 'top_rated'
						,esc_html__('Mixed Order', 'yoome')		=> 'mixed_order'
						)
				,'description' 	=> esc_html__( 'Select type of product', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> esc_html__( 'Number of Products', 'yoome' )
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'yoome' )
				,'param_name' 	=> 'product_cats'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product image', 'yoome' )
				,'param_name' 	=> 'show_image'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image border', 'yoome' )
				,'param_name' 	=> 'image_border'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image radius', 'yoome' )
				,'param_name' 	=> 'image_radius'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product name', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product price', 'yoome' )
				,'param_name' 	=> 'show_price'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product rating', 'yoome' )
				,'param_name' 	=> 'show_rating'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')		=> 1
							,esc_html__('No', 'yoome')		=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product categories', 'yoome' )
				,'param_name' 	=> 'show_categories'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Row', 'yoome' )
				,'param_name' 	=> 'rows'
				,'admin_label' 	=> false
				,'value' 		=> 3
				,'description' 	=> esc_html__( 'Number of Rows for slider', 'yoome' )
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS Product Brands ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Brands Slider', 'yoome' ),
		'base' 		=> 'ts_product_brands',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Use logo\'s settings', 'yoome' )
				,'param_name' 	=> 'use_logo_setting'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> esc_html__( 'If enabled, you go to Logos > Settings to configure image size and slider responsive', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> false
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
				,'dependency' 	=> array('element' => 'use_logo_setting', 'value' => array('0'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 6
				,'description' 	=> esc_html__( 'Number of Product Brands', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Only display the first level', 'yoome' )
				,'param_name' 	=> 'first_level'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hide empty product brands', 'yoome' )
				,'param_name' 	=> 'hide_empty'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product brand title', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product count', 'yoome' )
				,'param_name' 	=> 'show_product_count'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '0'
				,'description' 	=> esc_html__('Set margin between items', 'yoome')
			)
		)
	) );
	
	/*** TS Product Categories ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS Product Categories', 'yoome' ),
		'base' 		=> 'ts_product_categories',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Title style', 'yoome' )
				,'param_name' 	=> 'title_style'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Default', 'yoome')				=>  'title-default'
							,esc_html__('Line After', 'yoome')			=>  'title-line-before'
							,esc_html__('Center Line After', 'yoome')	=>  'title-center-line-before'
							,esc_html__('Center', 'yoome')				=>  'title-center'
							,esc_html__('Big Center', 'yoome')			=>  'title-big-center'
							,esc_html__('Simple', 'yoome')				=>  'title-simple'
							,esc_html__('Rotate', 'yoome')				=>  'title-rotate'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'yoome' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('Style 1', 'yoome')		=>  'style-1'
							,esc_html__('Style 2', 'yoome')	=>  'style-2'
						)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'yoome' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> 4
				,'description' 	=> esc_html__( 'Number of Columns', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'per_page'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Product Categories', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Only display the first level', 'yoome' )
				,'param_name' 	=> 'first_level'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent', 'yoome' )
				,'param_name' 	=> 'parent'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Select a category. Get direct children of this category', 'yoome' )
				,'dependency' 	=> array('element' => 'first_level', 'value' => array('0'))
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Child Of', 'yoome' )
				,'param_name' 	=> 'child_of'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Select a category. Get all descendents of this category', 'yoome' )
				,'dependency' 	=> array('element' => 'first_level', 'value' => array('0'))
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Product Categories', 'yoome' )
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Include these categories', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hide empty product categories', 'yoome' )
				,'param_name' 	=> 'hide_empty'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product category title', 'yoome' )
				,'param_name' 	=> 'show_title'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show product count', 'yoome' )
				,'param_name' 	=> 'show_product_count'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')				=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for content. Background color is white', 'yoome' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Shop more button text', 'yoome' )
				,'param_name' 	=> 'view_shop_button_text'
				,'admin_label' 	=> false
				,'description' 	=> ''
				,'value' 		=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show in a carousel slider', 'yoome' )
				,'param_name' 	=> 'is_slider'
				,'admin_label' 	=> true
				,'value' 		=> array(
							esc_html__('No', 'yoome')		=> 0
							,esc_html__('Yes', 'yoome')		=> 1
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'yoome' )
				,'param_name' 	=> 'show_nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'yoome' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
						)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'yoome' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> true
				,'value' 		=> 30
				,'group'		=> esc_html__('Slider Options', 'yoome')
			)
		)
	) );
	
	/*** TS List Of Product Categories ***/
	vc_map( array(
		'name' 		=> esc_html__( 'TS List Of Product Categories', 'yoome' ),
		'base' 		=> 'ts_list_of_product_categories',
		'icon' 		=> 'ts_icon_vc_shop',
		'class' 	=> '',
		'category' 	=> esc_html__('Theme-Sky', 'yoome'),
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'yoome' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Banner', 'yoome' )
				,'param_name' 	=> 'banner'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__( 'Parent Category', 'yoome' )
				,'param_name' 	=> 'parent'
				,'admin_label' 	=> true
				,'settings' => array(
					'multiple' 			=> false
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Display children of this category', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Direct child categories', 'yoome' )
				,'param_name' 	=> 'direct_child'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> esc_html__('Only display direct children of Parent Category', 'yoome')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Include Parent Category', 'yoome' )
				,'param_name' 	=> 'include_parent'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> esc_html__('Show Parent Category at the top of list', 'yoome')
			)
			,array(
				'type' 			=> 'autocomplete'
				,'heading' 		=> esc_html__('Product categories', 'yoome')
				,'param_name' 	=> 'ids'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'settings' => array(
					'multiple' 			=> true
					,'sortable' 		=> true
					,'unique_values' 	=> true
				)
				,'description' 	=> esc_html__('Include these categories. If you select a Parent Category, you will only be able to include the child categories of Parent Category', 'yoome')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'yoome' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 8
				,'description' 	=> esc_html__( 'Number of product categories', 'yoome' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Hide empty product categories', 'yoome' )
				,'param_name' 	=> 'hide_empty'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('Yes', 'yoome')	=> 1
							,esc_html__('No', 'yoome')	=> 0
							)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'View more text', 'yoome' )
				,'param_name' 	=> 'view_more_text'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> 'Ex: View more'
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'View more link', 'yoome' )
				,'param_name' 	=> 'view_more_link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Item background', 'yoome' )
				,'param_name' 	=> 'item_background'
				,'admin_label' 	=> false
				,'value' 		=> array(
							esc_html__('None', 'yoome')				=> ''
							,esc_html__('Background', 'yoome')			=> 'item-background'
							,esc_html__('Background Radius', 'yoome')	=> 'item-background item-radius'
							)
				,'description' 	=> esc_html__( 'Set background color for content. Background color is white', 'yoome' )
			)
		)
	) );
}

/*** Add Shortcode Param ***/
WpbakeryShortcodeParams::addField('ts_category', 'yoome_product_catgories_shortcode_param');
if( !function_exists('yoome_product_catgories_shortcode_param') ){
	function yoome_product_catgories_shortcode_param($settings, $value){
		$categories = yoome_get_list_categories_shortcode_param(0, $settings);
		$arr_value = explode(',', $value);
		ob_start();
		?>
		<input type="hidden" class="wpb_vc_param_value wpb-textinput product_cats textfield ts-hidden-selected-categories" name="<?php echo esc_attr($settings['param_name']); ?>" value="<?php echo esc_attr($value); ?>" />
		<div class="categorydiv">
			<div class="tabs-panel">
				<ul class="categorychecklist">
					<?php foreach($categories as $cat){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ts-select-category" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($cat->name); ?>
						</label>
						<?php yoome_get_list_sub_categories_shortcode_param($cat->term_id, $arr_value, $settings); ?>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			jQuery('.ts-select-category').bind('change', function(){
				"use strict";
				
				var selected = jQuery('.ts-select-category:checked');
				jQuery('.ts-hidden-selected-categories').val('');
				var selected_id = new Array();
				selected.each(function(index, ele){
					selected_id.push(jQuery(ele).val());
				});
				selected_id = selected_id.join(',');
				jQuery('.ts-hidden-selected-categories').val(selected_id);
			});
		</script>
		<?php
		return ob_get_clean();
	}
}

if( !function_exists('yoome_get_list_categories_shortcode_param') ){
	function yoome_get_list_categories_shortcode_param( $cat_parent_id, $settings ){
		$taxonomy = 'product_cat';
		if( isset($settings['class']) ){
			if( $settings['class'] == 'post_cat' ){
				$taxonomy = 'category';
			}
			if( $settings['class'] == 'ts_testimonial' ){
				$taxonomy = 'ts_testimonial_cat';
			}
			if( $settings['class'] == 'ts_portfolio' ){
				$taxonomy = 'ts_portfolio_cat';
			}
			if( $settings['class'] == 'ts_logo' ){
				$taxonomy = 'ts_logo_cat';
			}
			if( $settings['class'] == 'tribe_events_cat' ){
				$taxonomy = 'tribe_events_cat';
			}
		}
		
		$args = array(
				'taxonomy' 			=> $taxonomy
				,'hierarchical'		=> 1
				,'hide_empty'		=> 0
				,'parent'			=> $cat_parent_id
				,'title_li'			=> ''
				,'child_of'			=> 0
			);
		$cats = get_categories($args);
		return $cats;
	}
}

if( !function_exists('yoome_get_list_sub_categories_shortcode_param') ){
	function yoome_get_list_sub_categories_shortcode_param( $cat_parent_id, $arr_value, $settings ){
		$sub_categories = yoome_get_list_categories_shortcode_param($cat_parent_id, $settings); 
		if( count($sub_categories) > 0){
		?>
			<ul class="children">
				<?php foreach( $sub_categories as $sub_cat ){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ts-select-category" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($sub_cat->name); ?>
						</label>
						<?php yoome_get_list_sub_categories_shortcode_param($sub_cat->term_id, $arr_value, $settings); ?>
					</li>
				<?php } ?>
			</ul>
		<?php }
	}
}

function yoome_team_member_autocomplete_suggester( $query ){
	$args = array(
			'post_type'				=> 'ts_team'
			,'post_status'			=> 'publish'
			,'posts_per_page'		=> -1
			,'s'					=> $query
			);
	$results = array();
	$teams = new WP_Query($args);
	if( !empty( $teams->posts ) && is_array( $teams->posts ) ){
		foreach( $teams->posts as $p ){
			$data = array();
			$data['value'] = $p->ID;
			$data['label'] = esc_html__( 'ID', 'yoome' ) . ': ' . $p->ID . ( ( strlen( $p->post_title ) > 0 ) ? ' - ' . esc_html__( 'Name', 'yoome' ) . ': ' . $p->post_title : '' );
			$results[] = $data;
		}
	}
	return $results;
}

function yoome_team_member_autocomplete_render( $query ){
	$query = trim( $query['value'] );
	if ( ! empty( $query ) ) {
		
		$args = array(
			'post_type'				=> 'ts_team'
			,'post_status'			=> 'publish'
			,'posts_per_page'		=> 1
			,'p'					=> (int) $query
			);
		$teams = new WP_Query($args);
		if( isset($teams->post) ){
			$team = $teams->post;
			
			$team_id_display = esc_html__( 'ID', 'yoome' ) . ': ' . $team->ID;
			$team_title_display = '';
			if ( ! empty( $team->post_title ) ) {
				$team_title_display = ' - ' . esc_html__( 'Name', 'yoome' ) . ': ' . $team->post_title;
			}
			
			$data = array();
			$data['value'] = $team->ID;
			$data['label'] = $team_id_display . $team_title_display;

			wp_reset_postdata();
			
			return $data;
		}
		return false;
	}
	return false;
}

if( class_exists('Vc_Vendor_Woocommerce') ){
	$vc_woo_vendor = new Vc_Vendor_Woocommerce();

	/* autocomplete callback */
	add_filter( 'vc_autocomplete_ts_products_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_products_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	add_filter( 'vc_autocomplete_ts_product_deals_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ts_product_deals_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );
	
	add_filter( 'vc_autocomplete_ts_team_members_ids_callback', 'yoome_team_member_autocomplete_suggester' );
	add_filter( 'vc_autocomplete_ts_team_members_ids_render', 'yoome_team_member_autocomplete_render' );
	
	$shortcode_field_cats = array();
	$shortcode_field_cats[] = array('ts_products', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_widget', 'product_cats');
	$shortcode_field_cats[] = array('ts_product_deals', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs', 'product_cats');
	$shortcode_field_cats[] = array('ts_products_in_category_tabs', 'parent_cat');
	$shortcode_field_cats[] = array('ts_products_in_product_type_tabs', 'product_cats');
	$shortcode_field_cats[] = array('ts_product_categories', 'parent');
	$shortcode_field_cats[] = array('ts_product_categories', 'child_of');
	$shortcode_field_cats[] = array('ts_product_categories', 'ids');
	$shortcode_field_cats[] = array('ts_list_of_product_categories', 'parent');
	$shortcode_field_cats[] = array('ts_list_of_product_categories', 'ids');
		
	foreach( $shortcode_field_cats as $shortcode_field ){
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_callback', array($vc_woo_vendor, 'productCategoryCategoryAutocompleteSuggester') );
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_render', array($vc_woo_vendor, 'productCategoryCategoryRenderByIdExact') );
	}
}
?>
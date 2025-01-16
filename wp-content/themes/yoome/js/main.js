jQuery(function($){
	"use strict";
	var on_touch = !$('body').hasClass('ts_desktop');
	
	/** Remove loading from fullwidth row **/
	$(document).on('vc-full-width-row-single', function(e, data){
		data.el.removeClass('loading');
	});
	
	/** Mega menu **/
	ts_mega_menu_change_state($('body').innerWidth());
	$('.widget_nav_menu .menu-item-has-children .sub-menu').before('<span class="ts-menu-drop-icon"></span>');
	
	/** Menu on IPAD **/
	if( on_touch || $(window).width() < 768 ){
		ts_menu_action_on_ipad();
	}
	
	/** Sticky Menu **/
	if( typeof yoome_params != 'undefined' && yoome_params.sticky_header == 1 ){
		ts_sticky_menu();
	}
	
	/** Menu Hover Style **/
	if( typeof yoome_params != 'undefined' && yoome_params.menu_hover_style == 'background-overlay' ){
		$('.ts-header .ts-menu').on('mouseenter', function(){
			$('.ts-header').addClass('menu-background-overlay');
		});
		
		$('.ts-header .ts-menu').on('mouseleave', function(){
			$('.ts-header').removeClass('menu-background-overlay');
		});
	}
	
	/** Vertical Menu Sidebar **/
	$('.vertical-menu-button').on('click', function(){
		$('#vertical-menu-sidebar').toggleClass('active');
		$(this).toggleClass('active');
		
		/* Reset Dropdown Icon Class On Ipad */
		$('.ts-menu-drop-icon').removeClass('active');
		if( on_touch || $(window).width() < 768 ){
			$('.ts-menu .sub-menu').hide();
		}
		/* Reset Click Widget TS Menu */
		$('.ts-menu-widget .widget-title-wrapper').parent().removeClass('active');
		/* Reset Dropdown Cart */
		$('header .shopping-cart-wrapper').removeClass('active');
		/* Reset Button Header Account/Language/Currency */
		$('#group-icon-header, .ts-group-meta-icon-toggle .icon').removeClass('active');
	});
	
	$('#vertical-menu-sidebar .close').on('click', function(){
		$('#vertical-menu-sidebar, .vertical-menu-button').removeClass('active');
	});
	
	$('#vertical-menu-sidebar .ts-menu-drop-icon').on('click', function(){
		var parent_li = $(this).parent();
		if( parent_li.hasClass('active') ){
			parent_li.find('.sub-menu').slideUp();
			parent_li.find('li.active').removeClass('active');
			parent_li.removeClass('active');
		}
		else{
			$(this).siblings('.sub-menu').slideDown();
			parent_li.addClass('active');
		}
	});
	
	/** Device - Resize action **/
	$(window).on('resize orientationchange', $.throttle(250, function(){
		ts_mega_menu_change_state($('body').innerWidth());
	}));
	
	/** Shopping cart on ipad **/
	if( on_touch ){
		$(document).on('click', '.ts-tiny-cart-wrapper span.drop-icon', function(){
			$(this).parent().parent().parent().toggleClass('active');
			/* Reset Dropdown Icon Class On Ipad */
			$('.ts-menu-drop-icon').removeClass('active');
			$('.ts-menu .sub-menu').hide();
			/* Reset Click Widget TS Menu */
			$('.ts-menu-widget .widget-title-wrapper').parent().removeClass('active');
			/* Vertical Menu Sidebar */
			$('#vertical-menu-sidebar, .vertical-menu-button').removeClass('active');
			/* Reset Button Header Account/Language/Currency */
			$('#group-icon-header, .ts-group-meta-icon-toggle .icon').removeClass('active');
		});
	}
	
	/** Header Currency - Language on sidebar **/
	$('#group-icon-header .header-currency, #group-icon-header .header-language').find('ul:last').siblings('a').on('click', function(e){
		e.preventDefault();
		$(this).siblings('ul').slideToggle();
		$(this).toggleClass('active');
	});
	
	/** To Top button **/
	$(window).on('scroll', function(){
		if( $(this).scrollTop() > 100 ){
			$('#to-top').addClass('on');
		} else {
			$('#to-top').removeClass('on');
		}
	});
	
	$('#to-top .scroll-button').on('click', function(){
		$('body,html').animate({
			scrollTop: '0px'
		}, 1000);
		return false;
	});
	
	/** Quickshop **/
	var quickshop_created_vertical_slider = false;
	$(document).on('click', 'a.quickshop', function( e ){
		e.preventDefault();
		
		var product_id = $(this).data('product_id');
		if( product_id === undefined ){
			return;
		}
		
		var container = $('#ts-quickshop-modal');
		container.addClass('loading');
		container.find('.quickshop-content').html('');
		$.ajax({
			type : 'POST'
			,url : yoome_params.ajax_url	
			,data : {action : 'yoome_load_quickshop_content', product_id: product_id}
			,success : function(response){
				container.find('.quickshop-content').html( response );
				
				var full_slider = container.find('.ts-quickshop-wrapper.full-slider').length > 0;
				if( full_slider ){
					var thumbnail_height = parseInt( container.find('.image-items').data('height') );
					var thumbnail_width = parseInt( container.find('.image-items').data('width') );
					if( thumbnail_height ){
						var thumbnail_col_width = window.innerWidth >= 1500 ? 585 : 477;
						var thumbnail_col_height = window.innerWidth >= 1500 ? 710 : 580;
						var min_height = thumbnail_height * thumbnail_col_width / thumbnail_width;
						min_height = min_height > thumbnail_col_height ? thumbnail_col_height : Math.floor( min_height );
						container.find('.image-items').css('min-height', min_height + 'px');
					}
					
					container.find('img:first').on('load', function(){
						var height_content = Math.floor(container.find('.images-slider-wrapper').height()/2)*2;
						container.find('.popup-container').css({'height': height_content});
						container.find('.summary').css({'max-height': height_content});
						container.find('.image-items').removeClass('loading');
						
						container.removeClass('loading').addClass('show');
					});
				}
				
				quickshop_created_vertical_slider = false;
				
				var images = container.find('img');
				var count = 0;
				var timeout = setTimeout(function(){
					if( container.hasClass('loading') ){
						container.removeClass('loading').addClass('show');
						if( !full_slider ){
							images.off('load');
						}
					}
				}, 1000);
				
				images.on('load', function(){
					if( ++count == images.length && container.hasClass('loading') ){
						container.removeClass('loading').addClass('show');
						clearTimeout( timeout );
						if( container.find('.vertical-thumbnail').length > 0 ){
							quickshop_vertical_thumbnail_slider(container);
						}
					}
				});
				
				container.find('form.variations_form').wc_variation_form();
				container.find('form.variations_form .variations select').change();
				$('body').trigger('wc_fragments_loaded');
				
				container.find('form.variations_form').on('click', '.reset_variations', function(){
					$(this).parents('.variations').find('.ts-product-attribute .option').removeClass('selected');
				});
			
				if( full_slider ){
					if( container.find('.image-item').length <= 1 ){
						return;
					}
					
					container.find('.image-items').owlCarousel({
							items: 1
							,loop: true
							,nav: true
							,navText: [,]
							,dots: false
							,navSpeed: 1000
							,rtl: $('body').hasClass('rtl')
							,navRewind: false
						});
				}
				else{
					var thumbnails = container.find('.thumbnails');
					var slider_wrapper = thumbnails.find('.product-thumbnails');
					if( slider_wrapper.find('li').length > 1 ){
						if( container.find('.vertical-thumbnail').length > 0 ){
							setTimeout(function(){
								quickshop_vertical_thumbnail_slider(container);
							}, 1500);
						}
						else{
							slider_wrapper.owlCarousel({
								items: 4
								,loop: false
								,nav: true
								,navText: [,]
								,dots: false
								,rtl: $('body').hasClass('rtl')
								,margin: 20
								,navRewind: false
								,onInitialized: function(){
									thumbnails.addClass('loaded').removeClass('loading');
								}
							});
						}
					}
					else{
						thumbnails.removeClass('loading');
					}
					
					container.find('.images img').removeAttr('srcset sizes');
					$('.ts-qs-zoom, .ts-qs-zoom-gallery').CloudZoom({});
					$('.ts-quickshop-wrapper form.variations_form').on('found_variation reset_image', function(){
						container.find('.images img').removeAttr('srcset sizes');
						$('.ts-qs-zoom, .ts-qs-zoom-gallery').CloudZoom({});
					});
				}
			}
		});
	});
	
	$(document).on('click', '.ts-popup-modal .close, .ts-popup-modal .overlay', function(){
		$('.ts-popup-modal').removeClass('show');
		$('.ts-popup-modal .quickshop-content').html(''); /* prevent conflict with lightbox on single product */
	});
	
	function quickshop_vertical_thumbnail_slider( container ){
		var thumbnails = container.find('.thumbnails');
		var slider_wrapper = thumbnails.find('.product-thumbnails');
		if( quickshop_created_vertical_slider || !thumbnails.hasClass('loading') ){
			return;
		}
		quickshop_created_vertical_slider = true;
		
		slider_wrapper.carouFredSel({
					items: 4
					,direction: 'up'
					,prev: thumbnails.find('.owl-prev')
					,next: thumbnails.find('.owl-next')
					,auto: {
						duration: 800
					}
					,scroll: {
						items: 1
					}
					,onCreate: function(){
						thumbnails.addClass('loaded').removeClass('loading');
					}
				});
	}
	
	/** Wishlist **/
	$(document).on('click', '.add_to_wishlist, .product a.compare:not(.added)', function(){
		$(this).addClass('loading');
	});
	
	$('body').on('added_to_wishlist', function(){
		ts_update_tini_wishlist();
		$('.add_to_wishlist').removeClass('loading');
		$('.yith-wcwl-wishlistaddedbrowse.show, .yith-wcwl-wishlistexistsbrowse.show').parent('.button-in.wishlist').addClass('added');
	});
	
	$('body').on('removed_from_wishlist added_to_cart', function(){
		if( $('.wishlist_table').length ){
			ts_update_tini_wishlist();
		}
	});
	
	/** Compare **/
	$('body').on('yith_woocompare_open_popup', function(){
		$('.product a.compare').removeClass('loading');
	});
	
	/*** Color Swatch ***/
	$(document).on('click', '.products .product .color-swatch > div', function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		/* Change thumbnail */
		var image_src = $(this).data('thumb');
		$(this).closest('.product').find('figure img:first').attr('src', image_src).removeAttr('srcset sizes');
		/* Change price */
		var term_id = $(this).data('term_id');
		var variable_prices = $(this).parent().siblings('.variable-prices');
		var price_html = variable_prices.find('[data-term_id="'+term_id+'"]').html();
		$(this).parent().siblings('.price').html( price_html ).addClass('variation-price');
	});
	
	/*** Product Stock - Variable Product ***/
	function single_variable_product_reset_stock( wrapper ){
		var stock_html = wrapper.find('p.availability').data('original');
		var classes = wrapper.find('p.availability').data('class');
		if( classes == '' ){
			classes = 'in-stock';
		}
		wrapper.find('p.availability span').html(stock_html);
		wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
	}
	
	$(document).on('found_variation', 'form.variations_form', function(){
		var wrapper = $(this).parents('.summary');
		if( wrapper.find('.single_variation .stock').length > 0 ){
			var stock_html = wrapper.find('.single_variation .stock').html();
			var classes = wrapper.find('.single_variation .stock').hasClass('out-of-stock')?'out-of-stock':'in-stock';
			wrapper.find('p.availability span').html(stock_html);
			wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
		}
		else{
			single_variable_product_reset_stock( wrapper );
		}
	});
	
	$(document).on('reset_image', 'form.variations_form', function(){
		var wrapper = $(this).parents('.summary');
		single_variable_product_reset_stock( wrapper );
	});
	
	/*** Hide product attribute if not available ***/
	$(document).on('update_variation_values', 'form.variations_form', function(){
		if( $(this).find('.ts-product-attribute').length > 0 ){
			$(this).find('.ts-product-attribute').each(function(){
				var attr = $(this);
				var values = [];
				attr.siblings('select').find('option').each(function(){
					if( $(this).attr('value') ){
						values.push( $(this).attr('value') );
					}
				});
				attr.find('.option').removeClass('hidden');
				attr.find('.option').each(function(){
					if( $.inArray($(this).attr('data-value'), values) == -1 ){
						$(this).addClass('hidden');
					}
				});
			});
		}
	});
	
	/*** Custom Orderby on Product Page ***/
	$('form.woocommerce-ordering ul.orderby ul a').on('click', function(e){
		e.preventDefault();
		if( $(this).hasClass('current') ){
			return;
		}
		var form = $('form.woocommerce-ordering');
		var data = $(this).attr('data-orderby');
		form.find('select.orderby').val(data).trigger('change');
	});
	
	/*** Per page on Product page ***/
	$('form.product-per-page-form ul.perpage ul a').on('click', function(e){
		e.preventDefault();
		if( $(this).hasClass('current') ){
			return;
		}
		var form = $('form.product-per-page-form');
		var data = $(this).attr('data-perpage');
		form.find('select.perpage').val(data);
		form.submit();
	});
	
	/*** Widget toggle ***/
	$('.widget-title-wrapper a.block-control').on('click', function(e){
		e.preventDefault();
		if( $(this).parents('.top-filter-widget-area').length == 0 ){
			$(this).parent().siblings(':not(script)').slideToggle(400);
		}
		else{
			$(this).parent().siblings(':not(script)').fadeToggle(200);
		}
        $(this).toggleClass('active');
	});
	
	ts_widget_toggle();
	if( !on_touch ){
		$(window).on('resize', $.throttle(250, function(){
			ts_widget_toggle();
		}));
	}
	
	/*** Sort by toggle ***/
	$('.woocommerce-ordering li .orderby-current , .product-per-page-form li .perpage-current').on('click', function(e){
		$(this).parent().find('.dropdown').fadeToggle(200);
        $(this).toggleClass('active');
		$(this).parent().parent().toggleClass('active');
	});
	
	/* Product Image Lazy Load */
	$('img.ts-lazy-load').on('load', function(){
		$(this).parents('.lazy-loading').removeClass('lazy-loading').addClass('lazy-loaded');
	});
	
	$('img.ts-lazy-load:not(.product-image-back)').each(function(){
		if( $(this).data('src') ){
			$(this).attr('src', $(this).data('src'));
		}
	});
	
	/* Load back image after */
	$('img.ts-lazy-load.product-image-back').each(function(){
		if( $(this).data('src') ){
			$(this).attr('src', $(this).data('src'));
		}
	});
	
	/* WooCommerce Quantity Increment */
	$( document ).on( 'click', '.plus, .minus', function() {
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		if ( $( this ).is( '.plus' ) ) {
			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}
		} else {
			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}
		}

		$qty.trigger( 'change' );
	});
	
	/* Ajax Search */
	if( typeof yoome_params != 'undefined' && yoome_params.ajax_search == 1 ){
		ts_ajax_search();
	}
	/* Search - Shopping Cart Sidebar */
	$(document).on('click', '.search-sidebar-icon .icon, .shopping-cart-wrapper .cart-control', function(e){
		$('.ts-floating-sidebar .close').trigger('click');
		var is_cart = $(this).is('.cart-control');
		if( is_cart ){
			if( $('#ts-shopping-cart-sidebar').length > 0 ){
				e.preventDefault();
				$('#ts-shopping-cart-sidebar').addClass('active');
				$('#page').addClass('floating-sidebar-active');
				
				/* Reset Dropdown Icon Class On Ipad */
				jQuery('.ts-menu-drop-icon').removeClass('active');
				var on_touch = !jQuery('body').hasClass('ts_desktop');
				if( on_touch || jQuery(window).width() < 768 ){
					jQuery('.ts-menu-drop-icon').removeClass('active');
					jQuery('.ts-menu .sub-menu').hide();
				}
				/* Reset Click Widget TS Menu */
				jQuery('.ts-menu-widget .widget-title-wrapper').parent().removeClass('active');
				/* Vertical Menu Sidebar */
				jQuery('#vertical-menu-sidebar').removeClass('active');
				jQuery('.vertical-menu-button').removeClass('active');
				/* Reset Button Header Account/Language/Currency */
				jQuery('#group-icon-header').removeClass('active');
				jQuery('.ts-group-meta-icon-toggle .icon').removeClass('active');
			}
		}
		else{
			$('#ts-search-sidebar').addClass('active');
			$('#page').addClass('floating-sidebar-active');
			setTimeout(function(){
				$('#ts-search-sidebar input[name="s"]').focus();
			}, 600);
			/* Reset Dropdown Icon Class On Ipad */
			jQuery('.ts-menu-drop-icon').removeClass('active');
			var on_touch = !jQuery('body').hasClass('ts_desktop');
			if( on_touch || jQuery(window).width() < 768 ){
				jQuery('.ts-menu-drop-icon').removeClass('active');
				jQuery('.ts-menu .sub-menu').hide();
			}
			/* Reset Click Widget TS Menu */
			jQuery('.ts-menu-widget .widget-title-wrapper').parent().removeClass('active');
			/* Reset Dropdown Cart */
			jQuery('header .shopping-cart-wrapper').removeClass('active');
			/* Vertical Menu Sidebar */
			jQuery('#vertical-menu-sidebar').removeClass('active');
			jQuery('.vertical-menu-button').removeClass('active');
			/* Reset Button Header Account/Language/Currency */
			jQuery('#group-icon-header').removeClass('active');
			jQuery('.ts-group-meta-icon-toggle .icon').removeClass('active');
		}
	});
	$('.ts-floating-sidebar .overlay, .ts-floating-sidebar .close').on('click', function(){
		$('.ts-floating-sidebar').removeClass('active');
		$('#page').removeClass('floating-sidebar-active');
		$('.top-filter-widget-area-button.show-sidebar a').removeClass('active');
	});
	if( $('body').hasClass('ts_desktop') && $('.ts-floating-sidebar').length > 0 ){
		var is_rtl = $('body').hasClass('rtl');
		var scrollbar_width = ts_get_scrollbar_width();
		if( !is_rtl ){
			$('.ts-floating-sidebar .ts-sidebar-content').css({'right': -scrollbar_width + 'px'});
		}
		else{
			$('.ts-floating-sidebar .ts-sidebar-content').css({'left': -scrollbar_width + 'px'});
		}
	}
	
	/* Add To Cart Effect */
	if( !$('body').hasClass('woocommerce-cart') ){
		$(document.body).on('adding_to_cart', function( e, $button, data ){
			if( wc_add_to_cart_params.cart_redirect_after_add == 'no' ){
				if( typeof yoome_params != 'undefined' && yoome_params.add_to_cart_effect == 'show_popup' && typeof $button != 'undefined' ){
					var product_id = $button.attr('data-product_id');
					var container = $('#ts-add-to-cart-popup-modal');
					container.addClass('adding');
					$.ajax({
						type : 'POST'
						,url : yoome_params.ajax_url
						,data : {action : 'yoome_load_product_added_to_cart', product_id: product_id}
						,success : function(response){
							container.find('.add-to-cart-popup-content').html( response );
							if( container.hasClass('loading') ){
								container.removeClass('loading').addClass('show');
							}
							container.removeClass('adding');
						}
					});
				}
			}
		});
		
		$(document.body).on('added_to_cart', function( e, fragments, cart_hash, $button ){
			/* Show Cart Sidebar */
			if( typeof yoome_params != 'undefined' && yoome_params.show_cart_after_adding == 1 ){
				$('.shopping-cart-wrapper .cart-control').trigger('click');
				return;
			}
			/* Cart Fly Effect */
			if( typeof yoome_params != 'undefined' && typeof $button != 'undefined' ){
				if( yoome_params.add_to_cart_effect == 'fly_to_cart' ){
					var cart = $('.shopping-cart-wrapper');
					if( cart.length == 2 ){
						if( $(window).width() > 991 ){
							cart = $('.header-vertical .shopping-cart-wrapper');
						}
						else{
							cart = $('.header-ipad .shopping-cart-wrapper');
						}
					}
					if( cart.length == 1 ){
						var product_img = $button.closest('section.product').find('figure img').eq(0);
						if( product_img.length == 1 ){
							var effect_time = 800;
							var cart_in_sticky = $('.is-sticky .shopping-cart-wrapper').length;
							if( cart_in_sticky ){
								effect_time = 500;
							}
							
							var imgclone_height = product_img.width()?150 * product_img.height() / product_img.width():150;
							var imgclone_small_height = product_img.width()?75 * product_img.height() / product_img.width():75;
							
							var imgclone = product_img.clone().offset({top: product_img.offset().top, left: product_img.offset().left})
								.css({'opacity': '0.6', 'position': 'absolute', 'height': imgclone_height + 'px', 'width': '150px', 'z-index': '99999999'})
								.appendTo($('body'))
								.animate({'top': cart.offset().top + cart.height()/2, 'left': cart.offset().left + cart.width()/2, 'width': 75, 'height': imgclone_small_height}, effect_time, 'linear');
							
							if( !cart_in_sticky && cart.parents('.header-vertical').length == 0 ){
								$('body,html').animate({
									scrollTop: '0px'
								}, effect_time);
							}
							
							imgclone.animate({
								'width': 0
								,'height': 0
							}, function(){
								$(this).detach()
							});
						}
					}
				}
				if( yoome_params.add_to_cart_effect == 'show_popup' ){
					var container = $('#ts-add-to-cart-popup-modal');
					if( container.hasClass('adding') ){
						container.addClass('loading');
					}
					else{
						container.addClass('show');
					}
				}
			}
		});
	}
	
	/* Disable Ajax Remove Cart Item on Cart and Checkout page */
	if( $('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout') ){
		$(document.body).off('click', '.remove_from_cart_button');
	}
	
	/* Show cart after removing item */
	$(document.body).on('click', '.shopping-cart-wrapper .remove_from_cart_button', function(){
		$('.shopping-cart-wrapper').addClass('updating');
	});
	$(document.body).on('removed_from_cart', function(){
		if( !$('.shopping-cart-wrapper').is(':hover') ){
			$('.shopping-cart-wrapper').removeClass('updating');
		}
	});
	
	/* Change cart item quantity */
	$(document).on('change', '.ts-tiny-cart-wrapper .qty', function(){
		var qty = parseFloat($(this).val());
		var max = parseFloat($(this).attr('max'));
		if( max !== 'NaN' && max < qty ){
			qty = max;
			$(this).val( max );
		}
		var cart_item_key = $(this).attr('name').replace('cart[', '').replace('][qty]', '');
		$(this).parents('.woocommerce-mini-cart-item').addClass('loading');
		$('.shopping-cart-wrapper').addClass('updating');
		$('.woocommerce-message').remove();
		$.ajax({
			type : 'POST'
			,url : yoome_params.ajax_url
			,data : {action : 'yoome_update_cart_quantity', qty: qty, cart_item_key: cart_item_key}
			,success : function(response){
				if( !response ){
					return;
				}
				$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash ] );
				if( !$('.shopping-cart-wrapper').is(':hover') ){
					$('.shopping-cart-wrapper').removeClass('updating');
				}
			}
		});
	});
	
	$(document).on('mouseleave', '.shopping-cart-wrapper.updating',function(){ 
		$(this).removeClass('updating');
	});
	
	/* Top Filter Widget Area */
	$('.top-filter-widget-area-button a').on('click', function(){
		$(this).toggleClass('active');
		var filter_position = $(this).parent().data('position');
		if( filter_position == 'sidebar' ){
			$('#ts-top-filter-widget-area-sidebar').toggleClass('active');
			$('#page').toggleClass('floating-sidebar-active');
		}
		else{
			$('.top-filter-widget-area').slideToggle();
		}
		return false;
	});
	
	/* Single post - Related posts - Gallery slider */
	ts_single_related_post_gallery_slider();
	
	/* Single Product - Variable Product options */
	$(document).on('click', '.variations_form .ts-product-attribute .option a', function(){
		var _this = $(this);
		var val = _this.closest('.option').data('value');
		var selector = _this.closest('.ts-product-attribute').siblings('select');
		if( selector.length > 0 ){
			if( selector.find('option[value="' + val + '"]').length > 0 ){
				selector.val(val).change();
				_this.closest('.ts-product-attribute').find('.option').removeClass('selected');
				_this.closest('.option').addClass('selected');
			}
		}
		return false;
	});
	
	$('.variations_form').on('click', '.reset_variations', function(){
		$(this).closest('.variations').find('.ts-product-attribute .option').removeClass('selected');
	});
	
	/* Related - Upsell - Crosssell products slider */
	$('.single-product .related .products, .single-product .upsells .products, .woocommerce .cross-sells .products').each(function(){
		var _this = $(this);
		if( _this.find('.product').length > 1 ){
			_this.owlCarousel({
				loop: true
				,nav: true
				,navText: [,]
				,dots: false
				,navSpeed: 1000
				,rtl: $('body').hasClass('rtl')
				,margin: 30
				,navRewind: false
				,responsiveBaseElement: _this
				,responsiveRefreshRate: 1000
				,responsive:{0:{items:1},330:{items:2},570:{items:3},871:{items:4},1400:{items:5}}
			});
		}
	});
	
	/* Background Video - Youtube Video */
	if( typeof $.fn.YTPlayer == 'function' ){
		$('.ts-youtube-video-bg').each(function(index, element){
			var selector = $(this);
			var poster = selector.data('poster');
			var property = selector.data('property') && typeof selector.data('property') == 'string' ? eval('(' + selector.data('property') + ')') : selector.data('property');
			
			if( ! on_touch ) {
				var player = selector.YTPlayer();
				
				player.on('YTPPlay', function(){
					selector.removeClass('pausing').addClass('playing');
					selector.closest('.vc_row').addClass('playing');
					if( poster ){
						selector.css({'background-image':''});
						selector.find('.mbYTP_wrapper').css({'opacity':1});
					}
				});
				
				player.on('YTPPause YTPEnd', function(){
					selector.removeClass('playing').addClass('pausing');
					selector.closest('.vc_row').removeClass('playing');
					if( poster ){
						selector.css({'background-image':'url(' + poster + ')'});
						selector.find('.mbYTP_wrapper').css({'opacity':0});
					}
				});
				
				player.on('YTPChanged', function(){
					if( !property.autoPlay && poster ){
						selector.css({'background-image':'url(' + poster + ')'});
					}
				});
			}
			else if( poster ) {
				selector.css({'background-image':'url(' + poster + ')'});
			}
		});
	}
	
	/* Background Video - Hosted Video */
	$('.ts-hosted-video-bg').each(function(){
		var selector = $(this);
		var video = selector.find('video');
		var video_dom = selector.find('video').get(0);
		if( video.hasClass('loop') ){
			video_dom.loop = true;
		}
		if( video.hasClass('muted') ){
			video_dom.muted = true;
		}
		
		var poster = selector.data('poster');
		if( poster ){
			selector.css({'background-image':'url(' + poster + ')'});
		}
		
		var control = selector.find('.video-control');
		control.on('click', function(){
			if( ! selector.hasClass('playing') ){
				video_dom.play();
				selector.css({'background-image':''});
				selector.removeClass('pausing').addClass('playing');
				selector.closest('.vc_row').addClass('playing');
			}
			else{
				video_dom.pause();
				if( poster ){
					selector.css({'background-image':'url(' + poster + ')'});
				}
				selector.removeClass('playing').addClass('pausing');
				selector.closest('.vc_row').removeClass('playing');
			}
		});
		if( ! on_touch ){
			selector.addClass('pausing');
			if( video.hasClass('autoplay') ){
				control.trigger('click');
			}
		}
	});
	
	/* Single Portfolio Scrolling */
	ts_scrolling_fixed($('.single-portfolio.left-thumbnail.gallery .thumbnail'), $('.single-portfolio .entry-content'));
	
	/* Single Portfolio Lightbox */
	if( typeof $.fn.prettyPhoto == 'function' ){
		$('.single-portfolio .thumbnail a[rel^="prettyPhoto"]').prettyPhoto({
			show_title: false
			,deeplinking: false
			,social_tools: false
		});
	}
	
	/* Single Portfolio Gallery */
	if( typeof $.fn.isotope == 'function' ){
		setTimeout(function(){
			$('.single-portfolio.gallery .thumbnail figure').isotope();
		}, 200);
	}
	
	/* Single Portfolio Slider */
	setTimeout(function(){
		ts_generate_single_portfolio_slider();
	}, 200);
	
	/* Padding section Home Electronic Yoome */
	if( jQuery(window).width() > 767 ){
		ts_section_padding();
		$(window).on('resize', $.throttle(250, function(){
			ts_section_padding();
		}));
	}
	
	/* Click vertical menu heading Home Supermarket Yoome */
	if( on_touch || $(window).width() < 992 ){
		jQuery('.ts-menu-widget .widget-title-wrapper').on('click', function(){
			
			/* Reset Dropdown Icon Class On Ipad */
			jQuery('.ts-menu-drop-icon').removeClass('active');
			jQuery('.ts-menu .sub-menu').hide();
			/* Reset Dropdown Cart */
			jQuery('header .shopping-cart-wrapper').removeClass('active');
			/* Vertical Menu Sidebar */
			jQuery('#vertical-menu-sidebar').removeClass('active');
			jQuery('.vertical-menu-button').removeClass('active');
			/* Reset Button Header Account/Language/Currency */
			jQuery('#group-icon-header').removeClass('active');
			jQuery('.ts-group-meta-icon-toggle .icon').removeClass('active');
			
			jQuery(this).parent().toggleClass('active');
		});
	}
});

/*** Slideshow Revolution YOOME Furniture ***/
function ts_section_padding(){
	var body_size = jQuery('body').innerWidth();
	var content_size = jQuery('#primary').innerWidth();
	var padding_size = Math.round(( body_size - content_size ) / 2 );
	if( jQuery('body').hasClass('rtl') ){
		jQuery('#section-padding').css({'padding-right':padding_size+'px'});
	}
	else{
		jQuery('#section-padding').css({'padding-left':padding_size+'px'});
	}
}

/*** Mega menu ***/
function ts_mega_menu_change_state(case_size){
	if( typeof case_size == 'undefined' ){
		var case_size = jQuery('body').innerWidth();
	}
	case_size += ts_get_scrollbar_width();
	
	jQuery('.ts-group-meta-icon-toggle .icon').off('click');
	jQuery('.ts-group-meta-icon-toggle .icon').on('click', function(){
		
		/* Reset Dropdown Icon Class On Ipad */
		jQuery('.ts-menu-drop-icon').removeClass('active');
		var on_touch = !jQuery('body').hasClass('ts_desktop');
		if( on_touch || jQuery(window).width() < 768 ){
			jQuery('.ts-menu-drop-icon').removeClass('active');
			jQuery('.ts-menu-drop-icon').siblings('.sub-menu').hide();
		}
		/* Reset Click Widget TS Menu */
		jQuery('.ts-menu-widget .widget-title-wrapper').parent().removeClass('active');
		/* Reset Dropdown Cart */
		jQuery('header .shopping-cart-wrapper').removeClass('active');
		/* Vertical Menu Sidebar */
		jQuery('#vertical-menu-sidebar').removeClass('active');
		jQuery('.vertical-menu-button').removeClass('active');
		
		jQuery('#group-icon-header').toggleClass('active');
		jQuery(this).toggleClass('active');
	});
	
	/* Reset Dropdown Icon Class On Ipad */
	jQuery('.ts-menu-drop-icon').removeClass('active');
	
	/* Vertical Header */
	jQuery('.header-v5 ul.menu li.menu-item').removeClass('hide');
	
	jQuery('.header-v5 .pc-menu ul.menu > li.menu-item').each(function(){
		var sub_menu = jQuery(this).find('> .sub-menu');
		if( sub_menu.length > 0 ){
			var window_height = jQuery(window).height();
			var header_top = jQuery('header.ts-header.header-vertical').offset().top;
			var sub_menu_height = sub_menu.outerHeight();
			var item_top = jQuery(this).offset().top;
			item_top -= header_top; /* Fixed header */
			item_top += jQuery('body').hasClass('admin-bar')?32:0;
			
			if( item_top + sub_menu_height > window_height ){
				var top = item_top + sub_menu_height - window_height + 20;
				sub_menu.css({'top': -top, 'bottom': 'auto'});
			}
		}
	});
	
	if( case_size > 767 ){
	
		var padding_left = 0, container_width = 0;
		var container = jQuery('.header-sticky .container:first');
		var container_stretch = jQuery('.header-sticky');
		if( container.length <= 0 ){
			container = jQuery('.header-sticky');
			if( container.length <= 0 ){
				return;
			}
			container_width = container.outerWidth();
		}
		else{
			container_width = container.width();
			padding_left = parseInt(container.css('padding-left'));
		}
		var container_offset = container.offset();
		
		var container_stretch_width = container_stretch.outerWidth();
		var container_stretch_offset = container_stretch.offset();
		
		setTimeout(function(){
			jQuery('.ts-menu nav.main-menu > ul.menu > .ts-megamenu-fullwidth').each(function(index, element){
				var current_offset = jQuery(element).offset();
				if( jQuery(element).hasClass('ts-megamenu-fullwidth-stretch') ){
					var left = current_offset.left - container_stretch_offset.left;
					jQuery(element).children('ul.sub-menu').css({'width':container_stretch_width+'px','left':-left+'px','right':'auto'});
				}
				else{
					var left = current_offset.left - container_offset.left - padding_left;
					jQuery(element).children('ul.sub-menu').css({'width':container_width+'px','left':-left+'px','right':'auto'});
				}
			});
			
			jQuery('.ts-menu nav.main-menu > ul.menu').children('.ts-megamenu-columns-1, .ts-megamenu-columns-2, .ts-megamenu-columns-3, .ts-megamenu-columns-4').each(function(index, element){	
				jQuery(element).children('ul.sub-menu').css({'max-width':container_width+'px'});
				var sub_menu_width = jQuery(element).children('ul.sub-menu').outerWidth();
				var item_width = jQuery(element).outerWidth();
				jQuery(element).children('ul.sub-menu').css({'left':'-'+(sub_menu_width/2 - item_width/2)+'px','right':'auto'});
				
				var container_left = container_offset.left;
				var container_right = container_left + container_width;
				var item_left = jQuery(element).offset().left;
				
				var overflow_left = (sub_menu_width/2 > (item_left + item_width/2 - container_left));
				var overflow_right = ((sub_menu_width/2 + item_left + item_width/2) > container_right);
				if( overflow_left ){
					var left = item_left - container_left - padding_left;
					jQuery(element).children('ul.sub-menu').css({'left':-left+'px','right':'auto'});
				}
				if( overflow_right && !overflow_left ){
					var left = item_left - container_left - padding_left;
					left = left - ( container_width - sub_menu_width );
					jQuery(element).children('ul.sub-menu').css({'left':-left+'px','right':'auto'});
				}
			});
			
			/* Remove hide class after loading */
			jQuery('ul.menu li.menu-item').removeClass('hide');
			
		},800);
		
	}
	else{ /* Mobile menu action */
		jQuery('.ic-mobile-menu-button').off('click');
		jQuery('.ic-mobile-menu-button').on('click', function(){
			jQuery('#page').addClass('menu-mobile-active');
		});
		
		jQuery('.ic-mobile-menu-close-button').off('click');
		jQuery('.ic-mobile-menu-close-button').on('click', function(){
			jQuery('#page').removeClass('menu-mobile-active');
		});
		
		jQuery('#wpadminbar').css('position', 'fixed');
		
		/* Remove hide class after loading */
		jQuery('ul.menu li.menu-item').removeClass('hide');
	}
	
}

function ts_menu_action_on_ipad(){
	/* Main Menu Drop Icon */
	jQuery('.ts-menu nav.main-menu .ts-menu-drop-icon, .ts-menu-widget .ts-menu-drop-icon').on('click', function(){
		
		/* Reset Dropdown Cart */
		jQuery('header .shopping-cart-wrapper').removeClass('active');
		/* Reset Button Header Account/Language/Currency */
		jQuery('#group-icon-header').removeClass('active');
		jQuery('.ts-group-meta-icon-toggle .icon').removeClass('active');
		/* Vertical Menu Sidebar */
		jQuery('#vertical-menu-sidebar').removeClass('active');
		jQuery('.vertical-menu-button').removeClass('active');
		
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		
		jQuery('.ts-menu nav.main-menu .ts-menu-drop-icon, .ts-menu-widget .ts-menu-drop-icon').removeClass('active');
		jQuery('.ts-menu nav.main-menu .sub-menu, .ts-menu-widget .sub-menu').hide();
		
		jQuery(this).parents('.sub-menu').show();
		jQuery(this).parents('.sub-menu').siblings('.ts-menu-drop-icon').addClass('active');
		
		if(!jQuery(this).parents('.ts-menu-widget').length){
			/* Reset Click Widget TS Menu */
			jQuery('.ts-menu-widget .widget-title-wrapper').parent().removeClass('active');
		}
		/* Reset Dropdown Cart */
		jQuery('header .shopping-cart-wrapper').removeClass('active');
		
		if( sub_menu.length > 0 ){
			if( is_active ){
				sub_menu.fadeOut(250);
				jQuery(this).removeClass('active');
			}
			else{
				sub_menu.fadeIn(250);
				jQuery(this).addClass('active');
			}
		}
	});
	
	/* Mobile Menu Drop Icon */
	if( jQuery('.ts-menu nav.mobile-menu .ts-menu-drop-icon').length > 0 ){
		jQuery('.ts-menu nav.mobile-menu .sub-menu').hide();
	}
	jQuery('.ts-menu nav.mobile-menu .ts-menu-drop-icon').on('click', function(){
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		
		if( is_active ){
			sub_menu.slideUp(250);
			sub_menu.find('.sub-menu').hide();
			sub_menu.find('.ts-menu-drop-icon').removeClass('active');
		}
		else{
			sub_menu.slideDown(250);
		}
		jQuery(this).toggleClass('active');
	});
	
}

/*** End Mega menu ***/
function ts_get_scrollbar_width() {
    var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
        $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
        inner = $inner[0],
        outer = $outer[0];
     
    jQuery('body').append(outer);
    var width1 = inner.offsetWidth;
    $outer.css('overflow', 'scroll');
    var width2 = outer.clientWidth;
    $outer.remove();
 
    return (width1 - width2);
}

/*** Sticky Menu ***/
function ts_sticky_menu(){	
	if( jQuery(window).width() > 1270 ){
		var top_spacing = 0;
		if( jQuery('body').hasClass('logged-in') && jQuery('body').hasClass('admin-bar') && jQuery('#wpadminbar').length > 0 ){
			top_spacing = jQuery('#wpadminbar').height();
		}
		var top_begin = jQuery('header.ts-header').height() + 100;
		
		setTimeout( function(){
			jQuery('.header-sticky').sticky({
					topSpacing: top_spacing
					,topBegin: top_begin
					,scrollOnTop : function (){
						ts_mega_menu_change_state();
						jQuery('body > .select2-container--open').removeClass('sticky');
					}
					,scrollOnBottom : function (){
						ts_mega_menu_change_state();
						jQuery('body > .select2-container--open').addClass('sticky');
					}					
				});
		}, 200);
	}
}

/*** Custom Wishlist ***/
function ts_update_tini_wishlist(){
	if( typeof yoome_params == 'undefined' ){
		return;
	}
		
	var wishlist_wrapper = jQuery('.my-wishlist-wrapper');
	if( wishlist_wrapper.length == 0 ){
		return;
	}
	
	wishlist_wrapper.addClass('loading');
	
	jQuery.ajax({
		type : 'POST'
		,url : yoome_params.ajax_url
		,data : {action : 'yoome_update_tini_wishlist'}
		,success : function(response){
			var first_icon = wishlist_wrapper.children('i.fa:first');
			wishlist_wrapper.html(response);
			if( first_icon.length > 0 ){
				wishlist_wrapper.prepend(first_icon);
			}
			wishlist_wrapper.removeClass('loading');
		}
	});
}

/*** End Custom Wishlist***/

/*** Set Cloud Zoom ***/
function ts_set_cloud_zoom(){
	jQuery('.cloud-zoom-wrap .cloud-zoom-big').remove();
	jQuery('.cloud-zoom, .cloud-zoom-gallery').off('click');
	var clz_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').width();
	var clz_img_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').children('img').width();
	var cl_zoom = jQuery('.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
	var temp = (clz_width-clz_img_width)/2;
	if(cl_zoom.length > 0 ){
		cl_zoom.data('zoom',null).siblings('.mousetrap').off().remove();
		cl_zoom.CloudZoom({ 
			adjustX:temp	
		});
	}
}

/*** Widget toggle ***/
function ts_widget_toggle(){
	if( typeof yoome_params != 'undefined' && yoome_params.responsive == 0 ){
		return;
	}
	jQuery('.wpb_widgetised_column .widget-title-wrapper a.block-control, .footer-container .widget-title-wrapper a.block-control, .filter-widget-area > section .widget-title-wrapper a.block-control').remove();
	var window_width = jQuery(window).width();
	window_width += ts_get_scrollbar_width();
	if( window_width >= 768 ){
		jQuery('.widget-title-wrapper a.block-control').removeClass('active').hide();
		jQuery('.widget-title-wrapper a.block-control').parent().siblings(':not(script)').show();
		jQuery('.top-filter-widget-area.dropdown-filter .widget-title-wrapper a.block-control').parent().siblings(':not(script)').hide();
	}
	else{
		jQuery('.widget-title-wrapper a.block-control').removeClass('active').show();
		jQuery('.widget-title-wrapper a.block-control').parent().siblings(':not(script)').hide();
		jQuery('.wpb_widgetised_column .widget-title-wrapper, .footer-container .widget-title-wrapper, .filter-widget-area > section .widget-title-wrapper').siblings(':not(script)').show();
	}
}

/*** Ajax search ***/
function ts_ajax_search(){
	var search_string = '';
	var search_previous_string = '';
	var search_timeout;
	var search_delay = 500;
	var search_input;
	var search_cache_data = {};
	jQuery('body').append('<div id="ts-search-result-container" class="ts-search-result-container"></div>');
	var search_result_container = jQuery('#ts-search-result-container');
	var search_result_container_sidebar = jQuery('#ts-search-sidebar .ts-search-result-container');
	var header_search_wrapper = jQuery('.ts-header .search-wrapper');
	var is_sidebar = false;
	
	jQuery('.ts-header .search-content input[name="s"], #ts-search-sidebar input[name="s"]').on('keyup', function(e){
		is_sidebar = jQuery(this).parents('#ts-search-sidebar').length > 0;
		search_input = jQuery(this);
		search_result_container.hide();
		header_search_wrapper.removeClass('active');
		
		search_string = jQuery(this).val().trim();
		if( search_string.length < 2 ){
			search_input.parents('.search-content').removeClass('loading');
			return;
		}
		
		if( search_cache_data[search_string] ){
			if( !is_sidebar ){
				search_result_container.html(search_cache_data[search_string]);
				search_result_container.show();
				header_search_wrapper.addClass('active');
			}
			else{
				search_result_container_sidebar.html(search_cache_data[search_string]);
			}
			search_previous_string = '';
			search_input.parents('.search-content').removeClass('loading');
			
			if( !is_sidebar ){
				search_result_container.find('.view-all-wrapper a').on('click', function(e){
					e.preventDefault();
					search_input.parents('form').submit();
				});
			}
			else{
				search_result_container_sidebar.find('.view-all-wrapper a').on('click', function(e){
					e.preventDefault();
					search_input.parents('form').submit();
				});
			}
			
			return;
		}
		
		clearTimeout(search_timeout);
		search_timeout = setTimeout(function(){
			if( search_string == search_previous_string || search_string.length < 2 ){
				return;
			}
			
			search_previous_string = search_string;
		
			search_input.parents('.search-content').addClass('loading');
			
			/* check category */
			var category = '';
			var select_category = search_input.parents('.search-content').siblings('.select-category');
			if( select_category.length > 0 ){
				category = select_category.find(':selected').val();
			}
			
			jQuery.ajax({
				type : 'POST'
				,url : yoome_params.ajax_url
				,data : {action : 'yoome_ajax_search', search_string: search_string, category: category}
				,error : function(xhr,err){
					search_input.parents('.search-content').removeClass('loading');
				}
				,success : function(response){
					if( response != '' ){
						response = JSON.parse(response);
						if( response.search_string == search_string ){
							search_cache_data[search_string] = response.html;
							if( !is_sidebar ){
								search_result_container.html(response.html);
								var top = search_input.offset().top + search_input.outerHeight(true);
								var left = Math.ceil(search_input.offset().left);
								var width = search_input.outerWidth(true);
								var border_width = parseInt(search_input.parent('.search-content').css('border-left-width'));
								var window_width = jQuery(window).width();
								left -= border_width;
								width += border_width;
								if( width < 330 && window_width > 420 && search_input.parents('.search-round').length == 0 ){
									width = 330;
								}
								
								if( (left + width) > window_width ){ /* Overflow window */
									left -= (width - search_input.outerWidth(true));
								}
								
								search_result_container.css({
									'position': 'absolute'
									,'top': top
									,'left': left
									,'width': width
									,'display': 'block'
								});
								header_search_wrapper.addClass('active');
							}
							else{
								search_result_container_sidebar.html(response.html);
							}
							
							search_input.parents('.search-content').removeClass('loading');
							
							if( !is_sidebar ){
								search_result_container.find('.view-all-wrapper a').on('click', function(e){
									e.preventDefault();
									search_input.parents('form').submit();
								});
							}
							else{
								search_result_container_sidebar.find('.view-all-wrapper a').on('click', function(e){
									e.preventDefault();
									search_input.parents('form').submit();
								});
							}
						}
					}
					else{
						search_input.parents('.search-content').removeClass('loading');
					}
				}
			});
		}, search_delay);
	});
	
	search_result_container.on('mouseleave', function(){
		search_result_container.hide();
		header_search_wrapper.removeClass('active');
	});
	
	jQuery('body').on('click', function(){
		search_result_container.hide();
		header_search_wrapper.removeClass('active');
	});
	
	jQuery('.ts-search-by-category select.select-category').on('change', function(){
		search_previous_string = '';
		search_cache_data = {};
		jQuery(this).parents('.ts-search-by-category').find('.search-content input[name="s"]').trigger('keyup');
	});
}

/*** Single post - Related posts - Gallery slider ***/
function ts_single_related_post_gallery_slider(){
	if( jQuery('.single-post figure.gallery, .list-posts .post-item .gallery figure, .ts-blogs-widget .thumbnail.gallery figure').length > 0 ){
		var _this = jQuery('.single-post figure.gallery, .list-posts .post-item .gallery figure, .ts-blogs-widget .thumbnail.gallery figure');
		var slider_data = {
			items: 1
			,loop: true
			,nav: true
			,dots: false
			,animateIn: 'fadeIn'
			,animateOut: 'fadeOut'
			,navText: [,]
			,navSpeed: 1000
			,rtl: jQuery('body').hasClass('rtl')
			,margin: 10
			,navRewind: false
			,autoplay: true
			,autoplayTimeout: 4000
			,autoplayHoverPause: true
			,autoplaySpeed: false
			,autoHeight: true
			,mouseDrag: false
			,responsive:{0:{items:1}}
			,onInitialized: function(){
				_this.removeClass('loading');
				_this.parent('.gallery').addClass('loaded').removeClass('loading');
			}
		};
		_this.each(function(){
			var validate_slider = true;
			
			if( jQuery(this).find('img').length <= 1 ){
				validate_slider = false;
			}
			
			if( validate_slider ){
				jQuery(this).owlCarousel(slider_data);
			}
			else{
				jQuery(this).removeClass('loading');
				jQuery(this).parent('.gallery').removeClass('loading');
			}
		});
	}
	
	if( jQuery('.single-post .related-posts.loading').length > 0 ){
		var _this = jQuery('.single-post .related-posts.loading');
		var slider_data = {
			loop: true
			,nav: true
			,navText: [,]
			,dots: false
			,navSpeed: 1000
			,rtl: jQuery('body').hasClass('rtl')
			,margin : 30
			,navRewind: false
			,responsiveBaseElement: _this
			,responsiveRefreshRate: 400
			,responsive:{0:{items:1},640:{items:2},1150:{items:3},1400:{items:4}}
			,onInitialized: function(){
				_this.addClass('loaded').removeClass('loading');
			}
		};
		_this.find('.content-wrapper .blogs').owlCarousel(slider_data);
	}
	
}

/*** Single Portfolio Slider ***/
function ts_generate_single_portfolio_slider(){
	if( jQuery('.single-portfolio.slider .thumbnail figure img').length > 1 ){
		var wrapper = jQuery('.single-portfolio.slider');
		var element = jQuery('.single-portfolio.slider .thumbnail figure');
		var center  = (wrapper.hasClass('center') || wrapper.hasClass('center-fullwidth')) && wrapper.hasClass('top-thumbnail');
		var items   = center?2:1;
		element.owlCarousel({
					items: items
					,center: center
					,loop: true
					,nav: true
					,navText: [,]
					,dots: false
					,navSpeed: 1000
					,rtl: jQuery('body').hasClass('rtl')
					,navRewind: false
					,autoplay: true
					,autoplayHoverPause: true
					,autoplaySpeed: 1000
					,onInitialized: function(){
						wrapper.find('.thumbnail').addClass('loaded').removeClass('loading');
					}
				});
	}
	else{
		jQuery('.single-portfolio.slider .thumbnail').removeClass('loading');
	}
}

/*** Scrolling Fixed ***/
function ts_scrolling_fixed(scrolling_element, fixed_element, middle){
	if( scrolling_element.length == 0 || fixed_element.length == 0 || jQuery(window).width() < 768
		|| fixed_element.height() >= scrolling_element.height() ){
		return;
	}
	
	var fixed_left = fixed_element.offset().left;
	var fixed_width = fixed_element.outerWidth();
	var admin_bar_height = jQuery('#wpadminbar').length > 0?jQuery('#wpadminbar').outerHeight():0;
	var window_height = jQuery(window).height();
	
	jQuery(window).on('scroll', function(){
		var window_scroll_top = jQuery(this).scrollTop();
		var sticky_height = 0;
		if( jQuery('.is-sticky .header-sticky').length > 0 ){
			sticky_height = jQuery('.is-sticky .header-sticky').outerHeight();
		}
		
		var fixed_height = fixed_element.height();
		var scrolling_height = scrolling_element.height();
		var scrolling_top = scrolling_element.offset().top;
		var start_scroll = fixed_height > window_height?fixed_height - window_height:0;
		
		if( window_scroll_top > scrolling_top + start_scroll ){
			var top = sticky_height + admin_bar_height + 20;
			
			if( typeof middle != 'undefined' ){
				top -= 20;
				top += (window_height - top - fixed_height)/2;
			}
			if( start_scroll ){
				top = -start_scroll;
			}
			if( window_scroll_top + top + fixed_height > scrolling_top + scrolling_height ){
				top = scrolling_height - fixed_height + scrolling_top - window_scroll_top;
			}
			fixed_element.css({'position': 'fixed', 'left': fixed_left, 'top': top, 'width': fixed_width});
		}
		else{
			fixed_element.attr('style', '');
		}
	});
}
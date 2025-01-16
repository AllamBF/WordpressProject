jQuery(function($){
	"use strict";
	var on_touch = !$('body').hasClass('ts_desktop');
	
	/*** Set Cloud Zoom ***/
	$(window).on('resize orientationchange', $.throttle(250, function(){
		ts_set_cloud_zoom();
	}));
	
	if( $('.cloud-zoom, .cloud-zoom-gallery').length > 0 ){
		$(document).on('found_variation reset_image', 'form.variations_form', function(){
			$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({});
		});
	}
	
	/*** Product Image Lightbox ***/
	if( typeof PhotoSwipe !== 'undefined' ){
		function ts_get_single_product_gallery_items(){
			var items = [];
			$('.images-thumbnails .woocommerce-product-gallery__image a').each(function(index, ele){
				if( $(ele).parents('.owl-item.cloned').length == 0 ){
					var img = $(ele).find('img');
					var large_image_src = img.attr( 'data-large_image' );
					var large_image_w   = img.attr( 'data-large_image_width' );
					var large_image_h   = img.attr( 'data-large_image_height' );
					var item            = {
						src: large_image_src,
						w:   large_image_w,
						h:   large_image_h,
						title: img.attr( 'title' )
					};
					items.push( item );
				}
			});
			
			if( $('.vertical-thumbnail').length > 0 && items.length > 1 ){
				var main_thumbnail = items.pop();
				items.unshift( main_thumbnail );
				
				$('.images-thumbnails > .thumbnails img').each(function(index, ele){
					$(ele).attr('data-index', index + 1);
				});
			}
			
			return items;
		}
		
		$('.images-thumbnails').on('click', '.woocommerce-product-gallery__image a', function( e ){
			e.preventDefault();
			var items = ts_get_single_product_gallery_items();
			var index = $(this).find('img').attr('data-index');
			var pswpElement = $( '.pswp' )[0];
			var options = typeof wc_single_product_params != 'undefined' && typeof wc_single_product_params.photoswipe_options != 'undefined'?wc_single_product_params.photoswipe_options:{};
			options['index'] = parseInt(index);
			
			var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
			photoswipe.init();
		});
	}
	
	/*** Thumbnails Slider ***/
	/* Horizontal slider */
	var wrapper = $('.single-product .product:not(.vertical-thumbnail) .images-thumbnails .thumbnails-container.loading');
	wrapper.find('.product-thumbnails').owlCarousel({
			loop: true
			,nav: true
			,navText: [,]
			,dots: false
			,navSpeed: 1000
			,rtl: $('body').hasClass('rtl')
			,margin: 20
			,navRewind: false
			,autoplay: true
			,autoplayHoverPause: true
			,autoplaySpeed: 1000
			,responsiveBaseElement: wrapper
			,responsiveRefreshRate: 1000
			,responsive:{0:{items:2},280:{items:3},400:{items:4},520:{items:5},650:{items:6}}
			,onInitialized: function(){
				wrapper.addClass('loaded').removeClass('loading');
			}
		});
		
	/* Vertical slider */
	var wrapper = $('.single-product .product.vertical-thumbnail .images-thumbnails .thumbnails-container.loading');
	
	if( wrapper.length > 0 && typeof $.fn.carouFredSel == 'function' ){
		var has_360_gallery = $('.ts-product-360-button').length > 0;
		var items = $(window).width() < 500?(has_360_gallery?2:3):4;
		
		var _slider_data = {
				items: items
				,direction: 'up'
				,prev: wrapper.find('.owl-prev')
				,next: wrapper.find('.owl-next')
				,auto: {
					duration: 800
				}
				,scroll: {
					items: 1
				}
				,onCreate: function(){
					wrapper.addClass('loaded').removeClass('loading');
				}
			};
			
		wrapper.find('.product-thumbnails').carouFredSel(_slider_data);
		
		$(window).on('resize orientationchange', $.debounce( 250, function(){
			_slider_data.items = $(window).width() < 500?(has_360_gallery?2:3):4;
			wrapper.find('.product-thumbnails').trigger('configuration', _slider_data);
		} ));
	}
	
	/*** Product Video ***/
	$('a.ts-product-video-button').on('click', function(e){
		e.preventDefault();
		var product_id = $(this).data('product_id');
		var container = $('#ts-product-video-modal');
		if( container.find('.product-video-content').html() ){
			container.addClass('show');
		}
		else{
			container.addClass('loading');
			$.ajax({
				type : 'POST'
				,url : yoome_params.ajax_url
				,data : {action : 'yoome_load_product_video', product_id: product_id}
				,success : function(response){
					container.find('.product-video-content').html( response );
					container.removeClass('loading').addClass('show');
				}
			});
		}
	});
	
	/*** Product 360 ***/
	if( typeof $.fn.ThreeSixty == 'function' ){
		if( $('.ts-product-360-button').length == 0 ){
			setTimeout(function(){
				generate_product_360();
			}, 1000);
		}
		
		$('.ts-product-360-button').on('click', function(){
			$('#ts-product-360-modal').addClass('loading');
			generate_product_360();
			return false;
		});
	}
	
	function generate_product_360(){
		if( !$('.ts-product-360').hasClass('loaded') ){
			$('.ts-product-360').ThreeSixty({
				currentFrame: 1
				,imgList: '.threesixty_images'
				,imgArray: _ts_product_360_image_array
				,totalFrames: _ts_product_360_image_array.length
				,endFrame: _ts_product_360_image_array.length
				,progress: '.spinner'
				,navigation: true
				,responsive: true
				,onReady: function(){
					$('#ts-product-360-modal').removeClass('loading').addClass('show');
					$('.ts-product-360').addClass('loaded');
				}
			});
		}
		else{
			$('#ts-product-360-modal').removeClass('loading').addClass('show');
		}
	}
	
	/*** Show more/less product content ***/
	if( $('.single-product .more-less-buttons').length > 0 ){
		var product_content = $('.single-product .more-less-buttons').siblings('.product-content');
		if( product_content.height() < 250 ){
			$('.single-product .more-less-buttons').remove();
			product_content.removeClass('closed show-more-less');
		}
		else{
			var timeout = 200 + ( product_content.find('img').length * 200 );
			setTimeout(function(){
				var scrollheight = product_content.get(0).scrollHeight;
				var speed = scrollheight / 1000;
				var style = '<style>'
							+ '.product-content.show-more-less{transition:'+speed+'s ease;}'
							+ '.product-content.opened{max-height:'+scrollheight+'px;}'
							+ '</style>';
				$('head').append( style );
			}, timeout);
		}
	}
	
	$('.single-product .more-less-buttons a').on('click', function(e){
		e.preventDefault();
		$(this).hide();
		$(this).siblings('a').show();
		var action = $(this).data('action');
		$(this).parent().siblings('.product-content').removeClass('opened closed').addClass(action);
		
		if( action == 'closed' ){
			var top = $(this).parent().siblings('.product-content').offset().top;
			if( !on_touch && $('.is-sticky .header-sticky').length > 0 ){
				top -= $('.is-sticky .header-sticky').height();
			}
			$('body, html').animate({
				scrollTop: top - 75
			}, 1000);
		}
	});
	
	/*** Top thumbnail slider ***/
	if( $('.single-product-top-thumbnail-slider').length > 0 ){
		setTimeout(function(){
			var slider_data = {
				loop: true
				,nav: true
				,navText: [,]
				,dots: false
				,navSpeed: 1000
				,center: true
				,rtl: $('body').hasClass('rtl')
				,margin: 30
				,navRewind: false
				,autoplay: true
				,autoplayHoverPause: true
				,responsive:{0:{items:1},768:{items:2}}
				,onInitialized: function(){
					$('.single-product-top-thumbnail-slider').removeClass('loading');
				}
			};
			$(document).trigger('single_product_top_thumbnail_slider_data', slider_data);
			$('.single-product-top-thumbnail-slider').owlCarousel(slider_data);
		}, 200);
		
		if( typeof wc_single_product_params.photoswipe_options != 'undefined' ){
			$('.woocommerce-product-gallery__image a img').on('mouseenter', function(){
				wc_single_product_params.photoswipe_options.index = parseInt($(this).attr('data-index'));
			});
		}
	}
	
	/*** Single product scrolling ***/
	if( $(window).width() > 767 && $('.thumbnail-summary-scrolling').length > 0 ){
		$('.images-thumbnails > .owl-controls').removeClass('hidden');
		ts_scrolling_fixed($('.thumbnail-summary-scrolling > .images-thumbnails'), $('.product > .summary'));
		ts_scrolling_fixed($('.thumbnail-summary-scrolling > .images-thumbnails'), $('.images-thumbnails > .owl-controls'), true);
		
		$('.thumbnail-summary-scrolling > .images-thumbnails > .owl-controls .owl-dot').on('click', function(){
			var index = $(this).index();
			if( index == 0 ){ /* Scroll to main image */
				$('body, html').animate({
					scrollTop: $('.thumbnail-summary-scrolling .images-thumbnails > .images').offset().top - get_fixed_header_height()
				}, 1000);
			}
			else{
				$('body, html').animate({
					scrollTop: $('.thumbnail-summary-scrolling .product-thumbnails > li').eq(index-1).offset().top - get_fixed_header_height()
				}, 1000);
			}
		});
		
		$(window).on('scroll', function(){
			var scroll_top = $(this).scrollTop() + get_fixed_header_height() + 1;
			var images_height = $('.thumbnail-summary-scrolling .images').height();
			var thumbnails_height = $('.thumbnail-summary-scrolling .thumbnails').height();
			var images_top = $('.thumbnail-summary-scrolling .images').offset().top;
			var thumbnails_top = $('.thumbnail-summary-scrolling .thumbnails').offset().top;
			
			if( scroll_top >= images_top && scroll_top <= images_top + images_height ){
				$('.images-thumbnails > .owl-controls .owl-dot').removeClass('active');
				$('.images-thumbnails > .owl-controls .owl-dot').eq(0).addClass('active');
			}
			else if( scroll_top >= thumbnails_top && scroll_top <= thumbnails_top + thumbnails_height ){
				$('.thumbnail-summary-scrolling .product-thumbnails > li').each(function(index, element){
					$('.images-thumbnails > .owl-controls .owl-dot').removeClass('active');
					if( $(element).offset().top > scroll_top ){
						$('.images-thumbnails > .owl-controls .owl-dot').eq(index).addClass('active');
						return false;
					}
					else{
						$('.images-thumbnails > .owl-controls .owl-dot').last().addClass('active');
					}
				});
			}
		});
		$(window).trigger('scroll');
	}
	
	function get_fixed_header_height(){
		var admin_bar_height = $('#wpadminbar').length > 0?$('#wpadminbar').outerHeight():0;
		var sticky_height = $('.is-sticky .header-sticky').length > 0?$('.is-sticky .header-sticky').outerHeight():0;
		return admin_bar_height + sticky_height;
	}
	
	/*** Accordion - scroll to activated tab ***/
	$('.single-product .vc_tta-accordion .vc_tta-panel-heading').on('click', function(){
		if( $(this).parents('.vc_tta-panel').hasClass('vc_active') ){
			return;
		}
		var acc_header = $(this);
		
		setTimeout(function(){
			$('body,html').animate({
				scrollTop: acc_header.offset().top - get_fixed_header_height()
			}, 500);
		}, 800);
	});
	
	if( $('.woocommerce-tabs.accordion-tabs').length > 0 ){
		$('a.woocommerce-review-link').on('click', function(){
			var acc_header = $('#reviews').parents('.vc_tta-panel-body').siblings('.vc_tta-panel-heading');
			if( !acc_header.parents('.vc_tta-panel').hasClass('vc_active') ){
				setTimeout(function(){
					acc_header.trigger('click');
					acc_header.find('.vc_tta-panel-title a').trigger('click');
				}, 100);
			}
		});
	}
});
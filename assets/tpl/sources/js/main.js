// import "_modernizr";
// import "../bower_components/svg4everybody/svg4everybody";

// import "../bower_components/fastclick/lib/fastclick";

// import "../bower_components/foundation/js/foundation/foundation";
// import "../bower_components/foundation/js/foundation/foundation.offcanvas";

// import "../bower_components/masonry/dist/masonry.pkgd";
// import "../bower_components/slick.js/slick/slick";


// Lighweight wrapper for console.log
// http://paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console){
    console.log( Array.prototype.slice.call(arguments) );
  }
};


// init foundation js stuff
$(document).foundation();


// ready
$(function(){

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	fix 0.5px transforms in webkit where needed
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	function transformFix(){
		$('.transformfix').each(function(){
			$(this).css("-webkit-transform", '');
			var matrix = $(this).css("-webkit-transform");
			if (matrix && matrix != 'none') {
				matrix = matrix.replace(".5","");
				$(this).css("-webkit-transform",matrix);
				//log('Changed matrix to: ' + matrix);
			}
		});
	}
	
	// re-run function on resize
	$(window).on('resize', Foundation.utils.throttle(function(e){
		transformFix();
	}, 500));
	
	// fire function on 1st page load
	transformFix();




/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	add data-equalizer-watch attribute to children
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	var attr_name = 'data-equalizer';
	var eq_i = $('['+attr_name+']').length;

	$('['+attr_name+']').each(function(index, wrapper){
		eq_i--;
		
		if (!$(wrapper).find('[data-equalizer-watch]').length) {
			$(wrapper).find('> *').each(function(index,item){
				$(item).attr('data-equalizer-watch', true);
			});
		}
		
		if (eq_i === 0) setTimeout(function(){
			//console.log('equlizer reflow');
			$(document).foundation('equalizer', 'reflow');
		},100);
	});
	
	// reflow equalizer on resize (throttled)
	$(window).on('resize', Foundation.utils.throttle(function(e){
		//console.log('resize trigger (equlizer)');
		$(document).foundation('equalizer', 'reflow');
	}, 1000));




/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	Sticky Off-Canvas
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 

 	$(document)
	.on('open.fndtn.offcanvas', '[data-offcanvas]', function(e) {
		checkMinHeight();
		offcanvasScroll(true);
		$(window).on('scroll', offcanvasScroll);
	})
	.on('close.fndtn.offcanvas', '[data-offcanvas]', function(e) {
		$('#wrapper').css('min-height', 0);
		$(window).off('scroll', offcanvasScroll);
	});

	function offcanvasScroll(click){
		var scrollpos = $(window).scrollTop();
		var docheight = parseInt($('body').height(), 10);
		var freespace = docheight - scrollpos;
		var currentpos = 0, height = 0;
		
		if ($('.right-off-canvas-menu').length) {
            currentpos = parseInt($('.right-off-canvas-menu').css('margin-top'), 10);
			
			if (click === true || (currentpos > scrollpos && scrollpos >= 0)) {
				
				height = parseInt($('.right-off-canvas-menu > .content').height(), 10);
				if( freespace > height) {
					$('.right-off-canvas-menu').css('margin-top', scrollpos);
				} else {
					$('.right-off-canvas-menu').css('margin-top', docheight - height);
				}
			}
		}
		
		
		if ($('.left-off-canvas-menu').length) {
			currentpos = parseInt($('.left-off-canvas-menu > .content').css('margin-top'), 10);
			
			if (click === true || (currentpos > scrollpos && scrollpos >= 0)) {
			
				height = parseInt($('.left-off-canvas-menu > .content').height(), 10);
				if( freespace > height) {
					$('.left-off-canvas-menu > .content').css('margin-top', scrollpos);
				} else {
					$('.left-off-canvas-menu > .content').css('margin-top', docheight - height);
				}
			}
		}
	}
	
	
	function checkMinHeight(){
		var minheight = 0;
		if ($('.right-off-canvas-menu').length) minheight = $('.right-off-canvas-menu .content').height();
		if ($('.left-off-canvas-menu').length && $('.left-off-canvas-menu .content').height() > minheight) minheight = $('.left-off-canvas-menu .content').height();
		$('#wrapper').css('min-height', minheight+'px');
	}





/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	Slider
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	$('[data-slider]').each(function(index, slider){
	
		var options = Foundation.utils.data_options($(this));
		
		if ($('.custom-controls', slider).length) {
			//options.prevArrow = $('.custom-controls .prev', slider);
			//options.nextArrow = $('.custom-controls .next', slider);
			
			
		}
		
		var controls = $('<div class="custom-controls"></div>').appendTo(slider);
		options.prevArrow = $('<button class="prev"><svg role="presentation"><use xlink:href="'+window.projectvars.svgsprite+'#slider-arrow-prev"/></svg></button>').appendTo(controls);
		options.nextArrow = $('<button class="next"><svg role="presentation"><use xlink:href="'+window.projectvars.svgsprite+'#slider-arrow-next"/></svg></button>').appendTo(controls);
		
		options.lazyLoad = 'ondemand'; //'progressive';
		
		if (typeof options.slide == 'undefined') {
			options.slide = 'section';
		}
		
		if ($('.custom-controls', slider).length && $('> '+options.slide, slider).length == 1) {
			$('.custom-controls', slider).hide();
		}
		
		if (typeof options.autoplay == 'undefined') {
			options.autoplay = true;
		}
		if (typeof options.autoplaySpeed == 'undefined') {
			options.autoplaySpeed = 6000;
		}
		if (typeof options.speed == 'undefined') {
			options.speed = 700;
		}
		if (typeof options.dots == 'undefined') {
			options.dots = true;
		}
		
		if ($(this).data('thumbs') === true ) {
			options.customPaging = function(slider, j) {
				if (typeof $(slider.$slides[j]).find('img').first().attr('src') == "undefined") {
				    src = $(slider.$slides[j]).find('img').first().attr('data-lazy');
				} else {
					src = $(slider.$slides[j]).find('img').first().attr('src');
				}
				return '<img alt="Slide '+(j+1)+'" src="'+ src +'" class="thumbnail">';
			};
		}
				
		$(this).slick(options);
	});
	
	
	
    

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	scroll to id from url hash
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	
	if (window.location.hash !== '' && window.location.hash.charAt(1) != '&' && $(window.location.hash).length > 0) {
		var padding = $('.pageheader').height();
		$("html, body").animate({ scrollTop: $(window.location.hash).offset().top - padding }, 1000);
	}
	
	
	
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	process link tags
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	$('body').on('click', 'a', function(e){
		var href = $(this).attr('href');
		
		// scroll to id if hash link clicked
		if (href.charAt(0) == '#' && href.length > 1 && $(this).attr('role') != 'tab' && !$(this).hasClass('accordion-tab')) {
			e.preventDefault();
			var padding = 0;
			if ($('.pageheader').hasClass('fixed')) padding += $('.pageheader').height();
			
		    $('html, body').animate({
		        scrollTop: $(href).offset().top - padding
		    }, 1000);
		    return false;
	    }
	    	    
	    return true;
	});




});
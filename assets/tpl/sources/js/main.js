// import "_modernizr.js";

// import "../bower_components/svg4everybody/svg4everybody.js";

// import "../bower_components/fastclick/lib/fastclick.js";

// import "../bower_components/foundation/js/foundation/foundation.js";
// import "../bower_components/foundation/js/foundation/foundation.abide.js";
// import "../bower_components/foundation/js/foundation/foundation.reveal.js";
// import "../bower_components/foundation/js/foundation/foundation.offcanvas.js";

// import "../bower_components/masonry/dist/masonry.pkgd.js";

// import "../bower_components/slick.js/slick/slick.js";

// import "_garlic.min.js";
// import "_prism.js";


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
 *	Prism.js
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    Prism.highlightAll();
    
    
    
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
		//checkMinHeight();
		offcanvasScroll(true);
		$(window).on('scroll', offcanvasScroll);
	})
	.on('close.fndtn.offcanvas', '[data-offcanvas]', function(e) {
		//$('#wrapper').css('min-height', 0);
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
		$('#wrapper').css('min-height', '100vh');//minheight+'px');
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
		$("html, body").animate({ scrollTop: $(window.location.hash).offset().top }, 1000);
	}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	process link tags
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	$('body').on('click', 'a', function(e){
		var href = $(this).attr('href');

		// scroll to id if hash link clicked
		if (href.charAt(0) == '#' && href.length > 1 && $(this).attr('role') != 'tab' && !$(this).hasClass('accordion-tab')) {
			e.preventDefault();
		    $('html, body').animate({
		        scrollTop: $(href).offset().top
		    }, 1000);
		    return false;
	    }

	    return true;
	});


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	Infinite scrolling on articles overview
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    var $container = $('#articles-grid'),
        $body = $('body'),
        url = location.href,
        isSearchPage = url.search('search') !== -1;

    // init scroll handler
    if ($container.length > 0) {
        $body.append('<div id="loading"><div class="spinner"></div></div>');

        $container.masonry({
            'stamp': '.fixed'
        });
        
        var masonry = $container.data('masonry');

        $container[0].addEventListener('load', function(){
            //console.log('load triggered');
            masonry.layout();
        }, true);
        
        $(document).on('modxtoday.jwplayer.rendered', function(e){
            setTimeout(function(){
                masonry.layout();
            },0);
        });

        addArticlesScrollHandler();
        $(document).trigger('scroll');
    }

    function addArticlesScrollHandler(){
        $(document).on('scroll', Foundation.utils.throttle(infiniteArticlesScrollHandler, 500));
    }

    function infiniteArticlesScrollHandler () {
        if ($(window).scrollTop() + $(window).height() >= ($container.height() - 700)) {
            if (isSearchPage) {
                var searchOffset = $container.data('search-offset') || 0;
                searchOffset = searchOffset + 10;
                $container.data('search-offset', 10);
                loadMoreArticles(false, searchOffset);
            }
            else {
                var page = $container.data('page') || 1;
                page = page + 1;
                $container.data('page', page);
                loadMoreArticles(page);
            }
        }
    }

    function loadMoreArticles(page, searchOffset){
        $body.addClass('loading');

        // disable scroll handler until done loading
        $(document).off('scroll');

        var data = {};
        if (page) {
            data.page = page;
        }
        else {
            data.search_offset = searchOffset;
        }

        $.ajax({
            url: url,
            dataType: "html",
            data: data,
            success: function (response) {
                $body.removeClass('loading');
                if (response && response.length > 0) {
                    var $response = $('<div>' + response + '</div>');

                    if (isSearchPage) {
                        $response = $response.find('#articles-grid');
                    }
                    else {
                        $response = $response.find('#container');
                    }
                    var $items = $response.find('> .columns').not('.fixed');
                    if ($items.length > 0) {
                        
                        $container.append($items);
                        $container.masonry('appended', $items);
                        masonry.layout();
                        
                        // init jwplayers
                        renderJWPlayers();
                        
                        // load comment counts
                        if (typeof DISQUSWIDGETS !== 'undefined') DISQUSWIDGETS.getCount();
                        
                        // re-add scroll handler
                        addArticlesScrollHandler();
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Do something if there was an error
                alert('Oops, could not load any more articles.');
                log('error', textStatus);
            }
        });
    }




    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     *	Instantiate Slick galleries
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    var $galleries = $('.gallery');
    if ($galleries.length > 0) {
        $galleries.each(function(i, gal) { $(gal).slick({
            slide: 'div'
        }); });
    }
 });




/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	Render JWPlayers of this page
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    function renderJWPlayers(){
        var players = window.jwp;
        
        for (i=0; i < players.length; i++) {
            // init player
            var player = players[i];
            
            if (typeof player.beforeInit == 'function') player.beforeInit();
            
            /* jshint ignore:start */
            jwplayer(player.id).setup(player.options).onReady(function(){
                // trigger event that might re-layout the grid
                $(document).trigger('modxtoday.jwplayer.rendered');
                
                if (typeof player.onReady == 'function') player.onReady();
            });
            /* jshint ignore:end */
            
            if (typeof player.afterInit == 'function') player.afterInit();
            
            // remove player from array
            window.jwp.splice(i,1);
        }
    }


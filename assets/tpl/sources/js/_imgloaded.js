(function($){
    'use strict';
    $.fn.imagesLoaded = (function(){
        var imageLoaded = function (img, cb, delay){
            console.log(' tracking', img);
            var timer;
            var isReponsive = false;
            var  $parent = $(img).parent();
            var $img = $('<img />');
            var srcset = $(img).attr('srcset');
            var src = $(img).attr('src');
            var onload = function(){
                $img.off('load error', onload);
                clearTimeout(timer);
                cb();
            };

            if(delay){
                timer = setTimeout(onload, delay);
            }

            $img.on('load error', onload);

            if($parent.is('picture')){
                $parent = $parent.clone();
                $parent.find('img').remove().end();
                $parent.append($img);
                isReponsive = true;
            }

            if(srcset){
                $img.attr('srcset', srcset);
                if(!isReponsive){
                    $img.appendTo(document.createElement('div'));
                }
                isReponsive = true;
            } else if(src){
                $img.attr('src', src);
            }

            if(isReponsive && !window.HTMLPictureElement){
                if(window.respimage){
                    window.respimage({elements: [$img[0]]});
                } else if(window.picturefill){
                    window.picturefill({elements: [$img[0]]});
                } else if(src){
                    $img.attr('src', src);
                }
            }
        };

        return function(cb){
            var i = 0;
            var $imgs = $('img', this).add(this.filter('img'));
            var ready = function(){
                i++;
                if(i >= $imgs.length){
                    cb();
                }
            };
            $imgs.each(function(){
                imageLoaded(this, ready);
            });
            return this;
        };
    })();
})(jQuery);
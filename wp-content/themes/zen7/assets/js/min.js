(function(){

    jQuery(document).ready(function($){

        NProgress.start();
        NProgress.done();

        /**
         * TODO : Add these plugins
         */

        //jQuery('#myTabContent > .tab-pane').first().addClass('in active');
        jQuery('.tab-content').each(function(index) {
            jQuery(this).find('.tab-pane').first().addClass('in active');
        });

        jQuery("html").slideDown(function(){
            jQuery("html").getNiceScroll().resize();
        });

        jQuery('body').removeClass('category');

        jQuery('.select-product').ddslick();

        $(".post-container").fitVids();

        jQuery('.rsZenPortfolioSingle').royalSlider({
            arrowsNavAutoHide: false,
            autoScaleSliderHeight: 450,
            thumbsFitInViewport: false,
            startSlideId: 0,
            globalCaption: false,
            autoScaleSlider: true,
            loop: false,
            navigateByClick: true,
            arrowsNav:true,
            arrowsNavAutoHide: true,
            arrowsNavHideOnTouch: true,
            controlNavigation: false,
            arrowsNav: true,
            preloadNearbyImages:true,
            imageScalePadding: 0,
            video: {
                // video options go gere
                autoHideBlocks: false,
                autoHideArrows: true,
                youTubeCode: '<iframe src="http://www.youtube.com/embed/%id%?rel=1&autoplay=1&showinfo=0" frameborder="no"></iframe>',
                vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
            }
        });

        if (jQuery(window).width() <= 768){
            jQuery('.post-share').click(function(){

                jQuery( ".social-tipsy" ).toggleClass( "show-ts" );

            });
        } else {
            jQuery(window).resize(function(){
                if (jQuery(window).width() <= 768){
                    jQuery('.post-share').click(function(){

                        jQuery( ".social-tipsy" ).toggleClass( "show-ts" );

                    });
                }
            });
        }

        $('nav.menu > ul > li > a').each(function(){

            var color = $(this).find('span.entypo').data("file");

            $(this).find('i').css("color",color,"border-color",color)
            $(this).find('i').css("border-color",color)

        });

        $('.woocommerce-tabs .entry-content .comment-respond .comment-form span a').click(function(event){

            event.preventDefault();

            $('.woocommerce-tabs .entry-content .comment-respond .comment-form span a').removeClass('active');

            $(this).addClass('active')

        });

        $('.payment_methods li').click(function() {
            $('.payment_methods li').find('.payment_box').removeClass('active-box');
            $(this).find('.payment_box').addClass('active-box');
        });

        $("#shiptobilling .input-checkbox").change(function() {
           if(this.checked) {
               $(this).prev().attr("src", "assets/img/content/shop/checked.png");
               $('.shipping_address').slideUp();
           } else {
               $(this).prev().attr("src", "assets/img/content/shop/check.png");
               $('.shipping_address').slideDown();
           }
        });

        $('.btn').popover();

        $("#createaccount").change(function() {
           if(this.checked) {
               $('.create-account').slideDown();
           } else {
               $('.create-account').slideUp();
           }
        });

        $(window).resize(function(){
            if ($(window).width() <= 480){
                $('.post-link-bg').click(function(){

                    window.location.href = $(this).find('a:first').attr('href');

                });
            }
        });

        $('.chzn-done').chosen();

        $('.settings-panel').click(function(){

            $('.options-panel').toggleClass('options-panel-left');

            $(this).toggleClass('settings-panel-left')

        });

        $(".post-link-bg a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
        $(".portfolio-items a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
        $(".gallery a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
        $(".woocommerce .images a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});

        $("html , .btn-group-vertical").niceScroll();

        $(".chosen-container .chosen-results").niceScroll();

        if ($.browser.version == 8) {
            $("html , .btn-group-vertical , .chosen-container .chosen-results").getNiceScroll().remove();
        };

        $(function(){

              var $container = $('.posts-list > ul');

              $container.imagesLoaded(function() {
                $container.isotope();
              });

              $container.isotope();

              var $optionSets = $('.categories-portfolio .option-set'),
                  $optionLinks = $optionSets.find('a');

              $optionLinks.click(function(){
                var $this = $(this);
                if ( $this.hasClass('selected') ) {
                  return false;
                }
                var $optionSet = $this.parents('.option-set');
                $optionSet.find('.selected').removeClass('selected');
                $this.addClass('selected');

                var options = {},
                    key = $optionSet.attr('data-option-key'),
                    value = $this.attr('data-option-value');
                value = value === 'false' ? false : value;
                options[ key ] = value;
                if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                  changeLayoutMode( $this, options )
                } else {
                  $container.isotope( options );
                }

                return false;
              });
        });

        $(function(){

            var $container = $('.posts-masonry');

            $container.imagesLoaded( function(){
              $(this).masonry({
                columnWidth: 0,
                itemSelector: '.post-masonry'
              });
            });

        });

        function showNextArticle(){

            $(this).find('.tipsy-next').fadeIn(450);

        };

        function hideNextArticle(){

            $(this).find('.tipsy-next').fadeOut(450);

        };

        function showPrevArticle(){

            $(this).find('.tipsy-prev').fadeIn(450);

        };

        function hidePrevArticle(){

            $(this).find('.tipsy-prev').fadeOut(450);

        };

        function showSocial(){

            $(this).find('.social-tipsy').fadeIn(200);

        };

        function hideSocial(){

            $(this).find('.social-tipsy').fadeOut(50);

        };

        $('.btn-next-article').hover(showNextArticle,hideNextArticle);

        $('.btn-prev-article').hover(showPrevArticle,hidePrevArticle);

        $('.post-share').hover(showSocial,hideSocial);

        $('.post-share-02').hover(showSocial,hideSocial);

        var fadeL = jQuery('.fadeInL');
        var fadeR = jQuery('.fadeInR');
        var fadeDown = jQuery('.fadeInDown');
        var fadeIn = jQuery('.fadeInIn');
        var fadeUp = jQuery('.fadeInUp');
        var fadeLBig = jQuery('.fadeInL-Big');
        var fadeRBig = jQuery('.fadeInR-Big');
        var fadeDownBig = jQuery('.fadeInDown-Big');
        var fadeInBig = jQuery('.fadeInIn-Big');
        var fadeUpBig = jQuery('.fadeInUp-Big');

        var browser = false;
        p = navigator.platform;

        if (p === 'iPad' || p === 'iPhone' || p === 'iPod') {
            browser = true;
        }

        if (browser === false) {

            /*fadeL.css({visibility: 'hidden'});
            fadeR.css({visibility: 'hidden'});
            fadeDown.css({visibility: 'hidden'});
            fadeIn.css({visibility: 'hidden'});
            fadeUp.css({visibility: 'hidden'});
            fadeLBig.css({visibility: 'hidden'});
            fadeRBig.css({visibility: 'hidden'});
            fadeDownBig.css({visibility: 'hidden'});
            fadeInBig.css({visibility: 'hidden'});
            fadeUpBig.css({visibility: 'hidden'});

            fadeL.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeL');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeDown.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeDown');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeIn.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeIn');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeUp.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeUp');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeR.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeR');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeLBig.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeL-Big');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeDownBig.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeDown-Big');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeInBig.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeIn-Big');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeUpBig.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeUp-Big');
                    jQuery(this).css({visibility: 'visible'});
                }
            });
            fadeRBig.on('inview', function (event, visible) {
                if (visible) {
                    jQuery(this).addClass('fadeR-Big');
                    jQuery(this).css({visibility: 'visible'});
                }
            });*/
        }

        jQuery('.carousel').swipe( {
            swipeLeft: function() {
                jQuery(this).carousel('next');
            },
            swipeRight: function() {
                jQuery(this).carousel('prev');
            },
            allowPageScroll: 'vertical'
        });

        jQuery('.circle-skills').each(function(){

            var parent = jQuery(this).parent().parent().parent();

            parent.css("text-align","center");

            parent.find('> div').css("display","inline-block");

        });

        jQuery('.one-feature-slider').each(function(){

            var height = jQuery(this).height();

            jQuery(this).css("top", -height + 25 )

        });

        jQuery(window).resize(function(){
            jQuery('.one-feature-slider').each(function(){

                var height = jQuery(this).height();

                jQuery(this).css("top", -height + 25 )

            });
        });

        /**
         * @since 1.2.0
         *
         * mega-menu
         */

        jQuery('.big-sub-menu > ul').each(function(){

            var count = jQuery(this).find('> li').size();

            jQuery(this).css("width", count * 131)

        });

        if (jQuery('.current-menu-ancestor').length) {
            jQuery('.current-menu-ancestor').addClass('selected');
        } else {
            jQuery('.current-menu-item').addClass('selected');
        }

        function starRate() {
            jQuery('.woocommerce-tabs .entry-content .comment-respond .comment-form span a.active').each(function(){

                jQuery(this).prev().addClass('hover-02')
                jQuery(this).prev().prev().addClass('hover-02')
                jQuery(this).prev().prev().prev().addClass('hover-02')
                jQuery(this).prev().prev().prev().prev().addClass('hover-02')

                jQuery(this).next().removeClass('hover-02')
                jQuery(this).next().next().removeClass('hover-02')
                jQuery(this).next().next().next().removeClass('hover-02')
                jQuery(this).next().next().next().next().removeClass('hover-02')

            });
        }

        setInterval(starRate, 10);

        function hover5() {
            jQuery(this).prev().addClass('hover')
            jQuery(this).prev().prev().addClass('hover')
            jQuery(this).prev().prev().prev().addClass('hover')
            jQuery(this).prev().prev().prev().prev().addClass('hover')
        }

        function unHover5() {
            jQuery(this).prev().removeClass('hover')
            jQuery(this).prev().prev().removeClass('hover')
            jQuery(this).prev().prev().prev().removeClass('hover')
            jQuery(this).prev().prev().prev().prev().removeClass('hover')
        }

        jQuery('.woocommerce-tabs .entry-content .comment-respond .comment-form span a').hover(hover5,unHover5);

        jQuery('nav.menu > ul > li > ul').each(function( index ){

            jQuery(this).parent().children('a').on('click', function(e){
                e.preventDefault();
            });

        });

    });

})(jQuery);

(function( jQuery ) {
    jQuery.fn.showUp = function(ele, options) {
        options = options || {};

        var target         = jQuery(ele);
        var down           = options.down        || 'navbar-hide';
        var up             = options.up          || 'navbar-show';
        var btnHideShow    = options.btnHideShow || '.btn-hide-show';
        var hideOffset     = options.offset      || 110;
        var previousScroll = 0;

        jQuery(window).scroll(function () {
            // var currentScroll = jQuery(this).scrollTop();
            if (jQuery(this).scrollTop() > hideOffset) {
                if (jQuery(this).scrollTop() > previousScroll) {
                    // Action on scroll down
                    target.removeClass(up).addClass(down);
                } else {
                    // Action on scroll up
                    target.removeClass(down).addClass(up);
                }
            }
            previousScroll = jQuery(this).scrollTop();
        });

        // Toggle visibility of target on click
        jQuery(btnHideShow).click(function () {
            if (target.hasClass(down)) {
                target.removeClass(down).addClass(up);
            } else {
                target.removeClass(up).addClass(down);
            }
        });
    };
})( jQuery );

var duration      = 420;
var showOffset    = 220;
var btnFixed      = '.back-to-top';
var btnToTopClass = '.back-to-top';

jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > showOffset) {
        jQuery(btnFixed).fadeIn(duration);
    } else {
        jQuery(btnFixed).fadeOut(duration);
    }
});

jQuery(btnToTopClass).click(function (event) {
    event.preventDefault();
    jQuery('html, body').animate({
        scrollTop: 0
    }, duration);
    return false;
});
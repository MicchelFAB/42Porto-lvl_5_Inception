(function($) {
	'use strict';
	
	$(document).ready(function() {
		/*
			* Slider Script
		*/
		var $owlHome    = $('.main-slider-daizy');
		var $owlHomeParent  = $('.slider-wrapper-daizy');
		$owlHome.owlCarousel({
			rtl: $("html").attr("dir") == 'rtl' ? true : false,
			// nav:  $owlHome.children().length > 1,
			nav: true,
			navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			dots: false,
			loop: $owlHome.children().length > 1,
			autoplayTimeout:10000,
			margin: 0,
			autoplay:true,
			autoHeight: true,	  
			items:1,
			smartSpeed:450,
			responsive: {
				0: {
					items: 1,
					nav: false,
					dots: false
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
		$owlHome.owlCarousel();
		$owlHome.on('translate.owl.carousel', function (event) {
			var data_anim = $("[data-animation]");
			data_anim.each(function() {
				var anim_name = $(this).data('animation');
				$(this).removeClass('animated ' + anim_name).css('opacity', '0');
			});
		});
		$("[data-delay]").each(function() {
			var anim_del = $(this).data('delay');
			$(this).css('animation-delay', anim_del);
		});
		$("[data-duration]").each(function() {
			var anim_dur = $(this).data('duration');
			$(this).css('animation-duration', anim_dur);
		});
		$owlHome.on('translated.owl.carousel', function() {
			var data_anim = $owlHome.find('.owl-item.active').find("[data-animation]");
			data_anim.each(function() {
				var anim_name = $(this).data('animation');
				$(this).addClass('animated ' + anim_name).css('opacity', '1');
			});
		});
		
		//Navigation Menu Image
      function owlHomeThumb() {
        $('.owl-item').removeClass('prev next');
        var currentSlide = $('.main-slider-daizy .owl-item.active');
        currentSlide.next('.owl-item').addClass('next');
        currentSlide.prev('.owl-item').addClass('prev');
        var nextSlideImg = $('.owl-item.next').find('.item img').attr('src');
        var prevSlideImg = $('.owl-item.prev').find('.item img').attr('src');
        $('.owl-nav .owl-prev').css({
          backgroundImage: 'url(' + prevSlideImg + ')',
		  backgroundSize: 'cover'
        });
        $('.owl-nav .owl-next').css({
          backgroundImage: 'url(' + nextSlideImg + ')',
		  backgroundSize: 'cover'
        });
      }
      owlHomeThumb();
      $owlHome.on('translated.owl.carousel', function() {
        owlHomeThumb();
      });
	  
	  var $window = $(window);
        var lastScrollTop = 0;
        var $stickyNav  = $(".sticky-nav");
        var headerBottom = $stickyNav.position().top + $stickyNav.outerHeight(true) + 60;
        $window.scroll(function () {
            var windowTop = $window.scrollTop();
            if (windowTop >= headerBottom) {
                $stickyNav.addClass("sticky-menu");
                $stickyNav.addClass("swingOutX");
                $stickyNav.removeClass("swingInX");
            } else {
                $stickyNav.removeClass("is-sticky");
                $stickyNav.removeClass("show");
                $stickyNav.removeClass("swingOutX");
                $stickyNav.addClass("swingInX");
            }
            if ($stickyNav.hasClass("sticky-menu")) {
                if (windowTop <= headerBottom || windowTop < lastScrollTop) {
                    $stickyNav.addClass("show");
                    $stickyNav.addClass("swingInX");
                    $stickyNav.removeClass("swingOutX");
                } else {
                    $stickyNav.removeClass("show");
                    $stickyNav.removeClass("swingInX");
                    $stickyNav.addClass("swingOutX");
                }
            }
            lastScrollTop = windowTop;
        });
   
		
	});
	
}(jQuery));
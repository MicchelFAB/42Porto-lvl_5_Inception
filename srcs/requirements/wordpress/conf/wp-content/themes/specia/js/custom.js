(function($) {
  'use strict';

$(document).ready(function() {
    /*
    * Slider Script
    */
    var $owlHome    = $('.main-slider');
    var $owlHomeParent  = $('.slider-wrapper');
    $owlHome.owlCarousel({
      rtl: $("html").attr("dir") == 'rtl' ? true : false,
      nav: $owlHomeParent.hasClass("slider-section-twelve") || $owlHomeParent.hasClass("slider-section-eleven") || $owlHomeParent.hasClass("slider-section-ten") ? false : $owlHome.children().length > 1,
      navText: ["<i class='fa fa-angle-double-left'></i>","<i class='fa fa-angle-double-right'></i>"],
      dots: true,
      loop: $owlHome.children().length > 1,
      autoplayTimeout:5000,
      margin: 0,
      animateIn: $owlHomeParent.hasClass("slider-section-three") ? false : false,
      animateOut: $owlHomeParent.hasClass("slider-section-three") ? false : false,
      //autoplay: 7000,
      autoplay: true,
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
    if ($owlHomeParent.hasClass('slider-section-six')) {
      function owlHomeThumb() {
        $('.owl-item').removeClass('prev next');
        var currentSlide = $('.main-slider .owl-item.active');
        currentSlide.next('.owl-item').addClass('next');
        currentSlide.prev('.owl-item').addClass('prev');
        var nextSlideImg = $('.owl-item.next').find('.item img').attr('data-img-url');
        var prevSlideImg = $('.owl-item.prev').find('.item img').attr('data-img-url');
        $('.owl-nav .owl-prev').css({
          backgroundImage: 'url(' + prevSlideImg + ')'
        });
        $('.owl-nav .owl-next').css({
          backgroundImage: 'url(' + nextSlideImg + ')'
        });
      }
      owlHomeThumb();
      $owlHome.on('translated.owl.carousel', function() {
        owlHomeThumb();
      });
    }
    //First Word for
    if ($owlHomeParent.hasClass('slider-section-twelve')) {
        $(".specia-content h6").html(function(){
          var text= $(this).text().trim().split(" ");
          var first = text.shift();
          return (text.length > 0 ? "<span>"+ first + "</span> " : first) + text.join(" ");
        });
    }
    var owlHeaderCarousel = $('.header-carousel');
    owlHeaderCarousel.owlCarousel({
      rtl: $("html").attr("dir") == 'rtl' ? true : false,
      autoplay: 7000,
      items:3,
          margin: 13,
      nav: false,
      dots: false,
      loop: true,
      smartSpeed:450,
      autoHeight: true,
      autoHeightClass: 'owl-height100',
      responsive: {
        0: {
        items: 1
        },
        992: {
        items: 3
        },
        1200: {
        items: 3
        }
      }
    });
    var owl_widget_single = $('.header-single-carousel');
    owl_widget_single.owlCarousel({
      rtl: $("html").attr("dir") == 'rtl' ? true : false,
      autoplay:true,
      autoplay: 5000,
      items : 1,
          margin: 13,
      nav: false,
      dots: false,
      //loop: true,
      //loop: owl.children().length > 1,
      loop: (owl_widget_single.children().length)==1 ? false:true,
      smartSpeed: 450,
      autoWidth:true,     
      autoHeight: true,
      autoHeightClass: 'owl-height100',
      responsiveClass: true,
      responsive: {
        0: {
        items: 1
        },
        992: {
        items: 1
        },
        1200: {
        items: 1
        }
      }
    });

    // Add/Remove focus classess for accessibility
    $('.menubar, .widget_nav_menu').find('a').on('focus blur', function() {
      $( this ).parents('ul, li').toggleClass('focus');
    });
    // Mobile Menu Clone
    $(".menubar .menu-wrap").clone().appendTo(".mobile-menu .mobile-menu-shift");if($('.bt-primary').hasClass('bt-effect-2') || $('.bt-primary').hasClass('bt-effect-3')){document.querySelectorAll('.bt-primary:not(.header-vertical-btn):not(.bt-effect-1)').forEach(btu => btu.innerHTML = '<div><span>' + btu.textContent.trim().split('').join('</span><span>') + '</span></div>');}else{document.querySelectorAll('.bt-primary:not(.header-vertical-btn).bt-effect-1').forEach(btu => btu.innerHTML = '<span>' + btu.textContent + '</span>');}
    // Header Widget
    if( !$('.header-widget').children().length > 0 ) {
      $(".header-widget").hide();
      $(".headtop-mobi").hide();
    } else {
      $(".headtop-mobi").show();
      $(".header-top-info .header-widget").clone().appendTo(".mobi-head-top");
        var $mob_h_topMain = $(".headtop-mobi");
        var $mob_h_top = $("#mob-h-top");
        $('.header-sidebar-toggle').on('click', function(e) {
          if ( $mob_h_topMain.hasClass("active") ) {
            $mob_h_topMain.removeClass("active");
            $mob_h_top.removeClass("active");
            $('.header-sidebar-toggle.open-toggle').show().focus();
            $('.header-sidebar-toggle.close-button').hide();
            $('.header-sidebar-toggle').removeClass("active");
          } else {
            $('.header-sidebar-toggle.open-toggle').hide();
            $('.header-sidebar-toggle.close-button').show().focus();
            $mob_h_topMain.addClass("active");
            $mob_h_top.addClass("active");
            $('.header-sidebar-toggle').addClass("active");
            if ( $mob_h_topMain.hasClass("active") ) {
              var links,i,len,headtopItem=document.querySelector('.headtop-mobi'),fieldToggle=document.querySelector('.header-sidebar-toggle.close-button');let focusableElements='button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';let firstFocusableElement=fieldToggle;let focusableContent=headtopItem.querySelectorAll(focusableElements);let lastFocusableElement=focusableContent[focusableContent.length-1];if(!headtopItem){return!1}
              links=headtopItem.getElementsByTagName('a');for(i=0,len=links.length;i<len;i++){links[i].addEventListener('focus',toggleFocus,!0);links[i].addEventListener('blur',toggleFocus,!0)}
              function toggleFocus(){var self=this;while(-1===self.className.indexOf('headtop-shift')){if('input'===self.tagName.toLowerCase()){if(-1!==self.className.indexOf('focus')){self.className=self.className.replace('focus','')}else{self.className+=' focus'}}
              self=self.parentElement}}
              document.addEventListener('keydown',function(e){let isTabPressed=e.key==='Tab'||e.keyCode===9;if(!isTabPressed){return}
              if(e.shiftKey){if(document.activeElement===firstFocusableElement){lastFocusableElement.focus();e.preventDefault()}}else{if(document.activeElement===lastFocusableElement){firstFocusableElement.focus();e.preventDefault()}}})
            }
          }
          e.preventDefault();
        });
    }

    /*
    Text Rotator Function
    */
    $(".demo1 .rotate").textrotator({
      animation: "fade",
      speed: 1000
    });

    /*
    Sticky Header Function
    */
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        var nav_height = $('.navbar').innerHeight();
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - nav_height
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    /*
    Top Scroller Function
    */
    $(".top-scroll").hide();
    $(window).scroll(function () {
      if ($(this).scrollTop() > 500) {
    	$('.top-scroll').fadeIn();
      } else {
    	$('.top-scroll').fadeOut();
      }
    });
    $("a.top-scroll").on('click', function(event) {
      if (this.hash !== "") {
        event.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
          scrollTop: $(hash).offset().top
        }, 2000, function(){
          window.location.hash = hash;
        });
      }
    });

    /*
    //wow-animated
    */
    var wow = new WOW({
      boxClass:     'wow',      // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated)
      offset:       100,        // distance to the element when triggering the animation (default is 0)
      mobile: true,             // trigger animations on mobile devices (true is default)
      live: true                // consatantly check for new WOW elements on the page (true is default)
    })
    wow.init();
});

}(jQuery));
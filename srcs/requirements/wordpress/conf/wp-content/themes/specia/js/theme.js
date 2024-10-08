var SpeciaThemeJs;
    
(function( $, speciaConfig ) {
  'use strict';

  SpeciaThemeJs = {

    eventID: 'SpeciaThemeJs',

    $document: $( document ),
    $window:   $( window ),
    $body:     $( 'body' ),

    classes: {
      toggled:              'toggled',
      isOverlay:            'overlay-enabled',
      headerMenuActive:     'header-menu-active',
      headerSearchActive:   'header-search-active'
    },

    init: function() {
      // Document ready event check
      this.$document.on( 'ready', this.documentReadyRender.bind( this ) );
      this.$document.on( 'ready', this.processAutoheight.bind( this ) );
      this.$window.on( 'ready', this.documentReadyRender.bind( this ) );
    },

    documentReadyRender: function() {

      // Document Events
      this.$document
        .on( 'click.' + this.eventID, '.menu-toggle',   this.menuToggleHandler.bind( this ) )
        .on( 'click.' + this.eventID, '.close-menu',    this.menuToggleHandler.bind( this ) )

        .on( 'click.' + this.eventID, this.hideHeaderMobilePopup.bind( this ) )

        .on( 'resize.' + this.eventID, this.processAutoheight.bind( this ) )

        .on( 'click.' + this.eventID, '.header-search-toggle', this.searchToggleHandler.bind( this ) )
        .on( 'click.' + this.eventID, '.header-search-close',  this.searchToggleHandler.bind( this ) )

        .on( 'click.' + this.eventID, this.hideSearchHeader.bind( this ) )

        .on( 'click.' + this.eventID, '.mobile-menu .mobi_drop',  this.verticalMobileSubMenuLinkHandle.bind( this ) )

        // Mobile Menu
        .on( 'click.' + this.eventID, '.close-menu', this.resetVerticalMobileMenu.bind( this ) )

        .on( 'hideHeaderMobilePopup.' + this.eventID, this.resetVerticalMobileMenu.bind( this ) );

      // Window Events
      this.$window
        .on('scroll.' + this.eventID, this.scrollToTop.bind( this ) )

        .on( 'resize.' + this.eventID, this.processAutoheight.bind( this ) );
    },

    // Sticky Header
    scrollToTop: function( event ) {
      var self        = this,
          $stickyNav  = $( '.sticky-nav' );
      if (self.$window.scrollTop() >= 220) {
          $stickyNav.addClass('sticky-menu');
      }
      else {
          $stickyNav.removeClass('sticky-menu');
      }
    },

    // Process Navigation Auto Height
    processAutoheight: function( event ) {
      var self                = this;
      var $naviWrap           = $( '.navigator-wrapper' );
      var $naviWrapAll        = $( '.navigator-wrapper > .theme-mobile-nav' );
      var $naviWrapAllDesk    = $( '.navigator-wrapper > .xl-nav-area *:not(.logo):not(.navbar-brand):not(.dropdown-menu):not(.cart-wrapper *):not(.header-vertical-toggle *):not(.header-search-popup)' );
      var maxHeight           = 0;

      // This will check first level children ONLY as intended.
      if ($('body').find('div').hasClass("sticky-nav")) {
        if ($('div.theme-mobile-nav').css('display') == 'block') {
            $naviWrapAll.each(function(){
              var height              = $(this).outerHeight(true); // outerHeight will add padding and margin to height total
              if (height > maxHeight ) {
                  maxHeight = height;
              }
            });
            $naviWrap.css('min-height', maxHeight);
        } else {
            $naviWrapAllDesk.each(function(){
              var height              = $(this).outerHeight(true); // outerHeight will add padding and margin to height total
              if (height > maxHeight ) {
                  maxHeight = height;
              }
            });
            $naviWrap.css('min-height', maxHeight);
        }
      }
    },

    // Mobile Menu Toggle Handler
    menuToggleHandler: function( event ) {
      var self    = this,
        $toggle = $( '.menu-toggle' );

      self.$body.toggleClass( self.classes.headerMenuActive );
      self.$body.toggleClass( self.classes.isOverlay );
      $toggle.toggleClass( self.classes.toggled );

      if ( ! self.$body.hasClass( self.classes.headerMenuActive ) ) {
        $toggle.focus();
      } else {
        $( '.close-menu' ).focus();
        self.menuAccessibility();
      }
    },

    // Mobile Menu Popup Hide
    hideHeaderMobilePopup: function( event ) {
      var self     = this,
        $toggle  = $( '.menu-toggle' ),
        $sidebar = $( '.mobile-menu' );

      if ( $( event.target ).closest( $toggle ).length || $( event.target ).closest( $sidebar ).length ) {
        return;
      }

      if ( ! self.$body.hasClass( self.classes.headerMenuActive ) ) {
        return;
      }

      self.$body.removeClass( self.classes.headerMenuActive );
      self.$body.removeClass( self.classes.isOverlay );
      $toggle.removeClass( self.classes.toggled );

      self.$document.trigger( 'hideHeaderMobilePopup.' + self.eventID );

      event.stopPropagation();
    },

    // Mobile Sub Menu Link Handler
    verticalMobileSubMenuLinkHandle: function( event ) {
      event.preventDefault();

      var self      = this,
        $target   = $( event.currentTarget ),
        $menu     = $target.closest( '.mobile-menu .menu-wrap' ),
        deep      = $target.parents( '.dropdown-menu' ).length,
        direction = self.isRTL ? 1 : -1,
        translate = direction * deep * 100;

      //$menu.css( 'transform', 'translateX(' + translate + '%)' );

      setTimeout( function() {
        $target.parent().toggleClass("current");
        $target.next().slideToggle();
      }, 250 );
    },

    // Reset Mobile Menu Popup
    resetVerticalMobileMenu: function( event ) {
      var self        = this,
        $menu         = $( '.mobile-menu .menu-wrap' ),
        $menuItems    = $( '.mobile-menu  .menu-item' ),
        $deep         = $( '.mobile-menu .dropdown-menu');

      setTimeout( function() {
        $menuItems.removeClass("current");
        $deep.hide();
      }, 250 );
    },

    // Search Box Toggle Handler
    searchToggleHandler: function( event ) {
      var self    = this,
        $toggle   = $( '.header-search-toggle' ),
        $field    = $( '.header-search-field' );

      self.$body.toggleClass( self.classes.headerSearchActive );

      if ( self.$body.hasClass( self.classes.headerSearchActive ) ) {
        $field.focus();
      } else {
        $toggle.focus();
      }

      self.searchPopupAccessibility();
    },

    // Search Box Hide
    hideSearchHeader: function( event ) {
      var self    = this,
        $toggle   = $( '.header-search-toggle' ),
        $popup    = $( '.header-search-popup' );

      if ( $( event.target ).closest( $toggle ).length || $( event.target ).closest( $popup ).length ) {
        return;
      }

      if (  ! self.$body.hasClass( self.classes.headerSearchActive ) ) {
        return;
      }

      self.$body.removeClass( self.classes.headerSearchActive );
      $toggle.focus();

      event.stopPropagation();
    },

    // Active focus on menu popup
    menuAccessibility: function() {
      var links,i,len,menuItem=document.querySelector('.mobile-menu'),fieldToggle=document.querySelector('.close-menu');let focusableElements='button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';let firstFocusableElement=fieldToggle;let focusableContent=menuItem.querySelectorAll(focusableElements);let lastFocusableElement=focusableContent[focusableContent.length-1];if(!menuItem){return!1}
        links=menuItem.getElementsByTagName('button');for(i=0,len=links.length;i<len;i++){links[i].addEventListener('focus',toggleFocus,!0);links[i].addEventListener('blur',toggleFocus,!0)}
        function toggleFocus(){var self=this;while(-1===self.className.indexOf('mobile-menu-shift')){if('input'===self.tagName.toLowerCase()){if(-1!==self.className.indexOf('focus')){self.className=self.className.replace('focus','')}else{self.className+=' focus'}}
        self=self.parentElement}}
        document.addEventListener('keydown',function(e){let isTabPressed=e.key==='Tab'||e.keyCode===9;if(!isTabPressed){return}
        if(e.shiftKey){if(document.activeElement===firstFocusableElement){lastFocusableElement.focus();e.preventDefault()}}else{if(document.activeElement===lastFocusableElement){firstFocusableElement.focus();e.preventDefault()}}})
    },

    // Active focus on search popup
    searchPopupAccessibility: function() {
      var links,i,len,searchItem=document.querySelector('.header-search-popup'),fieldToggle=document.querySelector('.header-search-field');let focusableElements='button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';let firstFocusableElement=fieldToggle;let focusableContent=searchItem.querySelectorAll(focusableElements);let lastFocusableElement=focusableContent[focusableContent.length-1];if(!searchItem){return!1}
        links=searchItem.getElementsByTagName('button');for(i=0,len=links.length;i<len;i++){links[i].addEventListener('focus',toggleFocus,!0);links[i].addEventListener('blur',toggleFocus,!0)}
        function toggleFocus(){var self=this;while(-1===self.className.indexOf('search-form')){if('input'===self.tagName.toLowerCase()){if(-1!==self.className.indexOf('focus')){self.className=self.className.replace('focus','')}else{self.className+=' focus'}}
        self=self.parentElement}}
        document.addEventListener('keydown',function(e){let isTabPressed=e.key==='Tab'||e.keyCode===9;if(!isTabPressed){return}
        if(e.shiftKey){if(document.activeElement===firstFocusableElement){lastFocusableElement.focus();e.preventDefault()}}else{if(document.activeElement===lastFocusableElement){firstFocusableElement.focus();e.preventDefault()}}})
    }
  };

  SpeciaThemeJs.init();

}( jQuery, window.speciaConfig ));
/*
 * The ArchitectScripts File
 *
 *
*/

(function ( $ ) {
  "use strict";

  /**
  ** Caching
  */
  var $body = $('body'),
  $mainContent = $("body.single-projects #content"),
  $imageContainerLinks = $(".gallery-icon a"),
  $gallery = $(".gallery-icon");


  /**
  ** Preload
  */
  function preload(){
	setTimeout(function(){
		$body.addClass('pace-done');
	},500);
	$('.project-cover img').sbwpBackStretch('body');
	$('.entry-header img').sbwpBackStretch('.entry-header');
  }

  /**
  ** Mobile Navigation
  */
  function initMobileMenu(){

	$(".mobile_menu_button span").click(function () {
	  if ($(".mobile_menu ul.mobile").is(":visible")){
		$(".mobile_menu ul.mobile").slideUp(200);
	  } else {
		$(".mobile_menu ul.mobile").slideDown(200);
	  }
	});

	$(".mobile_menu ul.mobile li").click(function () {
		$(this).find("ul.mobile").stoggle(300,"easeInOutExpo");
	});

  }
  /**
  ** FlexSlider
  */
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider({
			animation: "fade",
			animationLoop: true,
			pauseOnAction: true,
			pauseOnHover: true,
			controlNav: false,
			start: function(slider) {
				jQuery( '.flexslider' ).removeClass('loading');
			}
		});
	});


  /**
  ** initHero
  */
  function initHero() {

	var $windowHeight = $(window).height();
	$mainContent.css({'height' : $windowHeight-129});

	$('#down_button a').click(function() {
	  $.scrollTo( this.hash, 800, { easing:'easeOutQuint', offset: {top:-24} });
	  return false;
	});

  }

  /**
  ** Projects
  */
  function initProjects() {

	var e = jQuery(".full-width").width(),
		b = jQuery(".quarter-width").width(),
		a = jQuery(".third-width").width(),
		o = jQuery(".half-width").width();
	$(".full-height").height(e - 100);
	$(".quarter-height").height(b - 100);
	$(".third-height").height(a - 100);
	$(".half-height").height(o - 100);

	$imageContainerLinks.each(function () {
		jQuery(this).addClass("fresco");
		jQuery(this).attr("data-fresco-group", "gal-1");
	});

	$gallery.each(function() {
	  jQuery(this).find('a.fresco')
		.attr('data-fresco-group', jQuery(this).attr('id'));
	});

  }

  /**
  ** Backstretch
  */
  $.fn.sbwpBackStretch = function(container) {

	if ($.fn.backstretch) {
	  $(this).each(function(){
		var $this       = $(this),
			$url        = $this.attr('src'),
			$container  = $this.closest(container);

		$this.remove();
		$container.backstretch($url, { fade: 500 });

	  });
	}

  };

  /**
  ** Toggle
  */
  $.fn.stoggle  = function(speed, easing) {
	  return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing);
  };

  /**
  ** Initialize all scripts here
  */
  $.fn.sbwpScripts = function() {

	preload();
	initMobileMenu();
	initProjects();
	initHero();

	/* Dropdown Navigation ****************************/
	$('nav li').hoverIntent(function(){
		  $(this).find("a:first").addClass("active");
		  $(this).find("ul.sub-menu").stoggle(300,"easeInOutExpo");
	},

	function(){
	  $(this).find("a:first").removeClass("active");
	  $(this).find("ul.sub-menu").stoggle(300,"easeInOutExpo");
	});

	/* Filter Categories ****************************/
	$('.filter li').hoverIntent(function(){
		  $(this).find("ul.sectors").stoggle(0,"easeInOutExpo");
                  $(this).find("ul.locations").stoggle(0,"easeInOutExpo");
	},

	function(){
	  $(this).find("ul.sectors").stoggle(300,"easeInOutExpo");
	  $(this).find("ul.locations").stoggle(300,"easeInOutExpo");
	});

	$('input, textarea').each(function(){

	  $(this).focus(function(){
		$(this).addClass('focusInput');
		  if($(this).val() === $(this).attr('data-value')){
			$(this).val('');
		  } else {
			$(this).select();
		  }
		})
		.blur(function(){
		$(this).removeClass('focusInput');
		if(
		  $(this).val() === ''){
			$(this).val($(this).attr('data-value'));
		  }
		});
	});

	// FitVids
	$(".video-container").fitVids();

    // Google Maps
	if( $( '.wplook-google-map' ).length > 0 ) {
		$( '.wplook-google-map' ).each( function( index, element ) {
		   $( element ).wplGoogleMaps();
		} );
	}

  };

  $(document).ready(function() {

	$('body').sbwpScripts();

  });

  $(window).resize(function() {

	initHero();
	initProjects();

  });

})( jQuery );

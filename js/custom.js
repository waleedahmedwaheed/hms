jQuery(function($) {
  "use strict";
  
  /**
   * Table of Contents:
   *
   * 01 - Preloader
   * 02 - Wow initialize
   * 03 - owlCarousel
   * 04 - Typed Text Slider
   * 05 - One Page Nav
   * 06 - scrollToTop
   * 07 - Background Parallax
   * 08 - Smart Resize Banner
   * 09 - progress bar / horizontal skill bar
   * 10 - pie chart / circle skill bar
   * 11 - Funfact Number Counter
   * 12 - Tooltip
   * 13 - Fit Vids
   * 14 - YT Player for Video
   * 15 - Flickr Feed
   * 16 - Contact Form
   * 17 - Google prettyMaps
   * 18 - Load More Posts
   * -----------------------------------------------
   */
   
  //window load  
  $(window).on('load', function() {	  
	  /* ---------------------------------------------------------------------- */
	  /* -------------------------- 01 - Preloader ---------------------------- */
	  /* ---------------------------------------------------------------------- */
	  jQuery("#spinner").fadeOut();
	  $('#preloader').delay(200).fadeOut('slow');
	  
	  /* ---------------------------------------------------------------------- */
	  /* ------------------------- 02 - Wow initialize  ----------------------- */
	  /* ---------------------------------------------------------------------- */
	  new WOW().init();
	  
	  ////////////////////////////////////////////////////////
		///////////////Floating menu///////////////////////////
		////////////////////////////////////////////////////////
		
		
		var num = 50; //number of pixels before modifying styles
		
		$(window).on('scroll', function () {
			if (jQuery(window).scrollTop() > num) {
				jQuery('.navbar-default').addClass('floating-menu');
			} else {
				jQuery('.navbar-default').removeClass('floating-menu');
			}
		});
////////////////////////////////////////////////////////
///////////////back to top ///////////////////////////
////////////////////////////////////////////////////////
				var offset = 220;
				var duration = 500;
				jQuery(window).on('scroll', function() {
					if (jQuery(this).scrollTop() > offset) {
						jQuery('.back-to-top').fadeIn(duration);
					} else {
						jQuery('.back-to-top').fadeOut(duration);
					}
				});
				
				jQuery('.back-to-top').on("click", function(){
					event.preventDefault();
					jQuery('html, body').animate({scrollTop: 0}, duration);
					return false;
			});
	  /* ---------------------------------------------------------------------- */
	  /* ---------------------------- 03 - owlCarousel  ----------------------- */
	  /* ---------------------------------------------------------------------- */	
	  $(".testimonials").owlCarousel({


			loop:true,
			margin:0,
			nav:true,
			dots:false,
			navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
			responsive:{
			    0:{
			        items:1
			    },
			    600:{
			        items:1
			    },
			    1000:{
			        items:1
			    }
			}

	  });
	  $(".open-hours-slider").owlCarousel({
		  
			loop:true,
			margin:0,
			nav:true,
			dots:false,
			navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
			responsive:{
			    0:{
			        items:1
			    },
			    600:{
			        items:1
			    },
			    1000:{
			        items:1
			    }
			}
	  });
	  $(".client-logos-slider").owlCarousel({
		  
		  	loop:true,
			margin:30,
			nav:false,
			dot:true,
			autoWidth: true,
			responsive:{
			    0:{
			        items:1
			    },
			    600:{
			        items:3
			    },
			    1000:{
			        items:4
			    }
			}
	  });
	  $(".client-logos-slider-colored").owlCarousel({
		  	loop:true,
			margin:0,
			nav:false,
			dots:false,
			responsive:{
			    0:{
			        items:1
			    },
			    600:{
			        items:3
			    },
			    1000:{
			        items:4
			    }
			}
	  });
	  /* ---------------------------------------------------------------------- */
	  /* --------------------------- 18 - Load More Posts ----------------------*/
	  /* ---------------------------------------------------------------------- */
		$(document).on('ready', function() {
		 
		var sync1 = $("#sync1");
		var sync2 = $("#sync2");
		 
		sync1.owlCarousel({
		singleItem : true,
		slideSpeed : 1000,
		navigation: false,
		pagination:false,
		afterAction : syncPosition,
		responsiveRefreshRate : 200,
		});
		 
		sync2.owlCarousel({
		items : 3,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3],
		itemsTablet : [768,3],
		itemsMobile : [479,3],
		pagination:false,
		responsiveRefreshRate : 100,
		afterInit : function(el){
		el.find(".owl-item").eq(0).addClass("synced");
		}
		});
		 
		function syncPosition(el){
		var current = this.currentItem;
		$("#sync2")
		.find(".owl-item")
		.removeClass("synced")
		.eq(current)
		.addClass("synced")
		if($("#sync2").data("owlCarousel") !== undefined){
		center(current)
		}
		}
		 
		$("#sync2").on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).data("owlItem");
		sync1.trigger("owl.goTo",number);
		});
		 
		function center(number){
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in sync2visible){
		if(num === sync2visible[i]){
		var found = true;
		}
		}
		 
		if(found===false){
		if(num>sync2visible[sync2visible.length-1]){
		sync2.trigger("owl.goTo", num - sync2visible.length+2)
		}else{
		if(num - 1 === -1){
		num = 0;
		}
		sync2.trigger("owl.goTo", num);
		}
		} else if(num === sync2visible[sync2visible.length-1]){
		sync2.trigger("owl.goTo", sync2visible[1])
		} else if(num === sync2visible[0]){
		sync2.trigger("owl.goTo", num-1)
		}
		}
		});
	  /* ---------------------------------------------------------------------- */
	  /* --------------------------- 18 - Load More Posts ----------------------*/
	  /* ---------------------------------------------------------------------- */
	  jQuery('.tp-banner').show().revolution(
	  {
		  dottedOverlay:"none",
		  delay:16000,
		  startwidth:1170,
		  startheight:700,
		  hideThumbs:200,
	
		  thumbWidth:100,
		  thumbHeight:50,
		  thumbAmount:5,
	
		  navigationType:"bullet",
		  navigationArrows:"solo",
		  navigationStyle:"preview1",
	
		  touchenabled:"on",
		  onHoverStop:"on",
	
		  swipe_velocity: 0.7,
		  swipe_min_touches: 1,
		  swipe_max_touches: 1,
		  drag_block_vertical: false,
	
		  parallax:"mouse",
		  parallaxBgFreeze:"on",
		  parallaxLevels:[7,4,3,2,5,4,3,2,1,0],
	
		  keyboardNavigation:"off",
	
		  navigationHAlign:"center",
		  navigationVAlign:"bottom",
		  navigationHOffset:0,
		  navigationVOffset:20,
	
		  soloArrowLeftHalign:"left",
		  soloArrowLeftValign:"center",
		  soloArrowLeftHOffset:20,
		  soloArrowLeftVOffset:0,
	
		  soloArrowRightHalign:"right",
		  soloArrowRightValign:"center",
		  soloArrowRightHOffset:20,
		  soloArrowRightVOffset:0,
	
		  shadow:0,
		  fullWidth:"on",
		  fullScreen:"off",
	
		  spinner:"spinner4",
	
		  stopLoop:"off",
		  stopAfterLoops:-1,
		  stopAtSlide:-1,
	
		  shuffle:"off",
	
		  autoHeight:"off",
		  forceFullWidth:"off",
	
	
	
		  hideThumbsOnMobile:"off",
		  hideNavDelayOnMobile:1500,
		  hideBulletsOnMobile:"off",
		  hideArrowsOnMobile:"off",
		  hideThumbsUnderResolution:0,
	
		  hideSliderAtLimit:0,
		  hideCaptionAtLimit:0,
		  hideAllCaptionAtLilmit:0,
		  startWithSlide:0,
		  videoJsPath:"rs-plugin/videojs/",
		  fullScreenOffsetContainer: ""
	  });
	 
  });  
  
  /* ---------------------------------------------------------------------- */
  /* --------------------------- 05 - Select ------------------------ */
  /* ---------------------------------------------------------------------- */
 	 $('.selectpicker').selectpicker();
	 $('.datepickerbox').datepicker();
      $('.rm-mustard').on("click", function(){
        $('.remove-example').find('[value=Mustard]').remove();
        $('.remove-example').selectpicker('refresh');
      });
  
  /* ---------------------------------------------------------------------- */
  /* ---------------------- 07 - Background Parallax ---------------------- */
  /* ---------------------------------------------------------------------- */    
  //Mobile Detect
  var testMobile;
  var isMobile = {
	 Android: function() {
		 return navigator.userAgent.match(/Android/i);
	 },
	 BlackBerry: function() {
		 return navigator.userAgent.match(/BlackBerry/i);
	 },
	 iOS: function() {
		 return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	 },
	 Opera: function() {
		 return navigator.userAgent.match(/Opera Mini/i);
	 },
	 Windows: function() {
		 return navigator.userAgent.match(/IEMobile/i);
	 },
	 any: function() {
		 return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	 }
  };  
  
    
  function parallaxInit() {
	 testMobile = isMobile.any();
	 if (testMobile == null) {
		 $('.parallax').each(function() {
			 $(this).parallax("30%", 0.2);
		 });
	 }
  }
  
  parallaxInit();

  /* ---------------------------------------------------------------------- */
  /* ---------------------------- 08 - CountDown -------------------------- */
  /* ---------------------------------------------------------------------- */ 
  //$('#countdown-timer').countdown({until: liftoffTime, compact: true, description: ''});

  /* ---------------------------------------------------------------------- */
  /* ---------------------------- 08 - CountDown -------------------------- */
  /* ---------------------------------------------------------------------- */ 
    
    $('.countdown').downCount({
        date: '12/16/2016 12:00:00' // m/d/y
    });
  
  /* ---------------------------------------------------------------------- */
  /* -------------------------- 16 - Contact Form ------------------------- */
  /* ---------------------------------------------------------------------- */  
  // Needed variables
  var $contactform = $('#contact-form'),
      $response = '';
	  
  // After contact form submit
  $contactform.submit(function() {
    // Hide any previous response text
    $contactform.children(".alert").remove();

    // Are all the fields filled in? 
    if (!$('#contact_name').val()) {
      $response = '<div class="alert alert-danger">Please enter your name.</div>';
	  $('#contact_name').focus();
      $contactform.prepend($response);

    } else if (!$('#contact_message').val()) {
      $response = '<div class="alert alert-danger">Please enter your message.</div>';
	  $('#contact_message').focus();
      $contactform.prepend($response);

    } else if (!$('#contact_email').val()) {
      $response = '<div class="alert alert-danger">Please enter valid e-mail.</div>';
	  $('#contact_email').focus();
      $contactform.prepend($response);

    } else {
      // Yes, submit the form to the PHP script via Ajax 
	  $contactform.children('button[type="submit"]').button('loading');
      $.ajax({
        type: "POST",
        url: "php/contact-form.php",
        data: $(this).serialize(),
        success: function(msg) {
          if (msg == 'sent') {
            $response = '<div class="alert alert-success">Your message has been sent. Thank you!</div>';
			$contactform[0].reset();
          } else {
            $response = '<div class="alert alert-danger">' + msg + '</div>';
          }
          // Show response message
          $contactform.prepend($response);
		  $contactform.children('button[type="submit"]').button('reset');
        }
      });
    }
    return false;
  });
  
  /* ---------------------------------------------------------------------- */
  /* --------------------------- 18 - Date Picker ----------------------*/
  /* ---------------------------------------------------------------------- */
  $('.datepicker').datepicker({ dateFormat: 'DD mm/dd/yy' }).datepicker("setDate", new Date());
  
  /* ---------------------------------------------------------------------- */
  /* ---------------------------- 14 - Tooltip  --------------------------- */
  /* ---------------------------------------------------------------------- */
  $('[data-toggle="tooltip"]').tooltip();

  /* ---------------------------------------------------------------------- */
  /* ---------------------------- 14 - Tooltip  --------------------------- */
  /* ---------------------------------------------------------------------- */
  jQuery('.tiles-masonry-picker').on('change', function (e) {
	  var mealicons = jQuery(this).data('related-meal-icons');
	  var optionSelected = $("option:selected", this);
	  var valueSelected = this.value;
	  jQuery('#' + mealicons + ' > div > div').hide();
	  console.log(jQuery('#' + mealicons + ' > div > div'));
	  jQuery('#' + mealicons + ' > div > '+valueSelected).show();
  });
		
	});
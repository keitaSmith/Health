"use strict";

(function ($) {

	$(window).on('load', function () {
		$(".preloader").fadeOut(1000);

	});

	/*----------------------------------------------
	 -----------menu bar cloning Function  --------------------
	 -------------------------------------------------*/
	$(window).on('resize', function () {
		if ($(window).width() > 768) {
			var $cloned_menu = $('.menubar > .container').clone();
			$('.menu_slider').html($cloned_menu);
		}
	});

	/*----------------------------------------------
	 -----------scroll buttn effect Function  --------------------
	 -------------------------------------------------*/

	// var nav = $('ul.navbar-nav');
	// nav.find('a').on('click', function () {
	// 	var $el = $(this)
	// 	var id = $el.attr('href');
	// 	$('html, body').animate({
	// 		scrollTop: $(id).offset().top
	// 	}, 500);
	// 	return false;
	// });



	/*----------------------------------------------
	    ----------- Slick Nav  --------------------
	-------------------------------------------------*/
	$(window).load(function(){
		 var logo_path = $('.brand-logo').html();
        $('#primary-menu').slicknav({
            appendTo: 'header',
            removeClasses: true,
            label: '',
            brand: logo_path 
        });
});



	/*----------------------------------------------
	 -----------go to top Function  --------------------
	 -------------------------------------------------*/
	 $(window).load(function(){
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 250) {
			$('#to-top').fadeIn(200);
		} else {
			$('#to-top').fadeOut(200);
		}
	});
	$("#to-top").on('click', function () {
		$("html, body").animate({
			scrollTop: 0
		}, "slow");
		return false;
	});

});

	// bootstrap tool tip initialization

	$('[data-toggle="tooltip"]').tooltip()


	if ($(".reply").length > 0) {


		$(".reply").on('click', function (e) {
			e.preventDefault();

			$("#comment-form").insertAfter($(this));
		});
	}

	$(document).ready(function() {
	    $(".main-navigation").accessibleDropDown();
	});

	$.fn.accessibleDropDown = function () {
	    var el = $(this);

	    /* Make dropdown menus keyboard accessible */

	    $("a", el).focus(function() {
	        $(this).parents("li").addClass("main-focus");
	    }).blur(function() {
	        $(this).parents("li").removeClass("main-focus");
	    });
	}


})(jQuery);




// google map code


function initMap() {
	var
		// Your geo coordinates
		bigdream = {
			lat: -37.817037,
			lng: 144.955709
		},
		 
		styles = [{
			"stylers": [{
				"hue": "#ee278d"
			}]
		}, {
			"featureType": "road",
			"elementType": "labels",
			"stylers": [{
				"visibility": "off"
			}]
		}, {
			"featureType": "road",
			"elementType": "geometry",
			"stylers": [{
				"lightness": 100
			}, {
				"visibility": "simplified"
			}]
		}],
		options = {
			// Center position for Google Maps
			center: {
				lat: -37.817037,
				lng: 144.955709
			},
			zoom: 15,
			disableDefaultUI: false,
			scrollwheel: true,
			draggable: true,
			maxZoom: 20,
			minZoom: 10,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_BOTTOM,
				style: google.maps.ZoomControlStyle.DEFAULT
			},
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_BOTTOM
			},
			styles: styles
		},
		map, marker,
		container = document.getElementById('map');
	var goldStar = '';
	if (container !== null) {
		map = new google.maps.Map(container, options);
		marker = new google.maps.Marker({
			position: map.getCenter(),
			icon: goldStar,
			map: map
		});
	}
}


// map initialization code  ends
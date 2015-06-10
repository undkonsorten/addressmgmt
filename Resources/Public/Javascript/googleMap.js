jQuery(function($) {
	"use strict";
	var element = $('.map');
	var latitude = parseFloat(element.data('latitude') || 0);
	var longitude = parseFloat(element.data('longitude') || 0);
	var mapZoom = parseInt(element.data('mapzoom') || 0);
	var center = new google.maps.LatLng(latitude, longitude);
	console.log(latitude, longitude, mapZoom);
	var mapOptions = {
		center: center,
		zoom: mapZoom,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(element[0], mapOptions);
	if (parseInt(element.data('markeratcenter'))) {
		var marker = new google.maps.Marker({
			position: center,
			map:map,
			title: element.data('markertitle')
		});
	}
	$(window).on('map:resize', function(e) {
		var center = map.getCenter();
		google.maps.event.trigger(map, 'resize');
		map.setCenter(center);
	});
	$(document).on('tabs:animationEnd', function(e) {
		$(document).trigger('map:resize');
	});
	$(window).on('resize', function(e) {
		$(document).trigger('map:resize');
	});
});
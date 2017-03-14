(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['leaflet', 'leafletMarkerCluster', 'jquery', 'map/mapConfigurationParser', 'map/tileLayerParser', 'map/poiConfigurationParser', 'map/popupMarkupCreator'], factory);
    } else {
        // Browser globals
        root.map = factory(root.L, root.leafletMarkerCluster, root.jQuery, root.mapConfigurationParser, root.tileLayerParser, root.poiConfigurationParser, root.popupMarkupCreator);
    }
}(this, function (L, leafletMarkerCluster, $, mapConfigurationParser, tileLayerParser, poiConfigurationParser, popupMarkupCreator) {
  "use strict";

  var INFO_LAYER_MARKUP = '<span class="close">×</span><div class="info-layer-content"></div>';
  var INFO_LAYER_CLOSE_SELECTOR = 'span.close';
  var INFO_LAYER_CONTENT_SELECTOR = '.info-layer-content';

  var markerIcon = {
    default: new L.Icon.Default(),
    active: L.icon({iconUrl: '/typo3conf/ext/addressmgmt/Resources/Public/Icons/marker-icon-active.png'})
  };
  var areaStyle = {
    default: {color: '#0033ff'},
    active: {color: '#269d14'}
  }

  $('[data-is-map=true]').each(function() {
    var pois = [];
    var mapConfiguration = mapConfigurationParser(this);
    var tileLayerConfiguration = tileLayerParser(this);
    var fitBoundConfiguration = mapConfiguration.padding
      ? {padding: [parseInt(mapConfiguration.padding),parseInt(mapConfiguration.padding)] }
      : null;
    var map = L.map(this, mapConfiguration);
    var poiLayerGroup;
    if ($(this).data('map-clusters')) {
		poiLayerGroup = L.markerClusterGroup().addTo(map);
	} else {
		poiLayerGroup = L.featureGroup().addTo(map);
	}
    var tileLayer = L.tileLayer(tileLayerConfiguration.urlTemplate, tileLayerConfiguration.options).addTo(map);
    var mapWrap = $($(this).data('map-wrap'));
    var infoLayer = $($(this).data('map-info-layer'));
    map.mapWrap = mapWrap;
    map.infoLayer = infoLayer;
    infoLayer.html(INFO_LAYER_MARKUP);
    infoLayer.find(INFO_LAYER_CLOSE_SELECTOR).on('click', function() {
      map.closePopup();
    })
    $($(this).attr('data-poi-list')).find('[data-poi]').each(function() {
      var poiConfiguration = poiConfigurationParser(this);
      var poi = createPoi(this, poiConfiguration);
      poi.element = this;
      poi.map = map;
      $(this).data('poi-object', poi);
      var popup = L.popup().setContent(createPopup(this, poi));
      popup.poi = poi;
      poi.bindPopup(popup);
      pois.push(poi);
    });
    // Call fitbounds event on map element when adding or removing marker to adopt zoom
    $(this).on('fitbounds.map', function(e, additionalConfiguration) {
      if (poiLayerGroup.getLayers().length) {
        map.fitBounds(poiLayerGroup.getBounds(), $.extend({}, fitBoundConfiguration, additionalConfiguration || {}));
      }
    });
    $(this).on('update-list.map', function(e) {
      pois.forEach(function(poi) {
        if ($(poi.element).hasClass('hide')) {
          poiLayerGroup.removeLayer(poi);
        } else {
          poi.addTo(poiLayerGroup);
        }
      });
    })
    map.on('popupopen', function(e) {
      $(document).triggerHandler('popupopen', getArgumentsForHandler(e.popup));
      var poi = e.popup && e.popup.poi;
      if (isMarker(poi)) {
        poi.setIcon(markerIcon.active);
      }
      if (isGeoJson(poi)) {
        poi.setStyle(areaStyle.active);
      }
    });
    map.on('popupclose', function(e) {
      $(document).triggerHandler('popupclose', getArgumentsForHandler(e.popup));
      var poi = e.popup && e.popup.poi;
      if (isMarker(poi)) {
        poi.setIcon(markerIcon.default);
      }
      if (isGeoJson(poi)) {
        poi.setStyle(areaStyle.default);
      }

    })
    $(this).trigger('update-list.map');
    $(this).trigger('fitbounds.map', {animate:false});
  });

  $(document).on('popupopen', function(e, poi, element, map) {
    map.mapWrap.addClass('show-info');
    map.infoLayer.find(INFO_LAYER_CONTENT_SELECTOR).html($(element).html());
    map.invalidateSize();
  });

  $(document).on('popupclose', function(e, poi, element, map) {
    map.mapWrap.removeClass('show-info');
    map.invalidateSize();
  });


  function createPoi(element, configuration) {
    if (configuration.type === "marker") {
      return createMarker(element, configuration);
    }
    if (configuration.type === "geoJson") {
      return createGeoJson(element, configuration);
    }
  }

  function createPopup(element, poi) {
    return popupMarkupCreator(element, poi);
  }

  function createMarker(element, configuration) {
    return L.marker(configuration.coordinates);
  }

  function createGeoJson(element, configuration) {
    return L.geoJson(configuration.geoJson);
  }

  function isMarker(poi) {
    return (poi instanceof L.Marker);
  }

  function isGeoJson(poi) {
    return (poi instanceof L.GeoJSON);
  }

  function getArgumentsForHandler(popup) {
    return [popup.poi, popup.poi.element, popup.poi.map];
  }

}));

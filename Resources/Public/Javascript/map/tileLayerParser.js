(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        root.tileLayerParser = factory(root.jQuery);
    }
}(this, function ($) {
  "use strict";
  return function(node) {
    return $(node).data('map-tilelayer');
  }
}));

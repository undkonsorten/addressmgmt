(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals
        root.popupMarkupCreator = factory(root.jQuery);
    }
}(this, function ($) {
  "use strict";
  return function(node, poi) {
    return $(node).find('h4.title').html();
  }
}));
